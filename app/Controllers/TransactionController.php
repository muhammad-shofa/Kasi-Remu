<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\TmpTransactionModel;
use App\Models\TransactionModel;
use App\Models\TxnDetailModel;
use CodeIgniter\HTTP\ResponseInterface;
use Ramsey\Uuid\Uuid;

class TransactionController extends BaseController
{
    protected $tmpTransactionModel;
    protected $transactionModel;
    protected $txnDetailModel;
    protected $itemModel;

    public function __construct()
    {
        $this->tmpTransactionModel = new TmpTransactionModel();
        $this->transactionModel = new TransactionModel();
        $this->txnDetailModel = new TxnDetailModel();
        $this->itemModel = new ItemModel();
    }

    public function addCatalogItem()
    {
        $item_id = (int) $this->request->getPost('item_id');
        $user_id = (int) session()->get('user_id');

        // alternative
        // $data['item_id'] = (int) $this->request->getPost('item_id');
        // $data['user_id'] = (int) session()->get('user_id');
        // $data['quantity'] = 1;

        $data = [
            'user_id' => $user_id,
            'item_id' => $item_id,
            'quantity' => 1
        ];

        // cek apakah di db sudah ada item_id yang sama
        $isAvailable = $this->tmpTransactionModel->where('item_id', $item_id)->first();

        if (!empty($isAvailable)) {
            $data['quantity'] = $isAvailable['quantity'] + 1;

            if ($this->tmpTransactionModel->update($isAvailable['tmp_txn_id'], $data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Success updated data',
                    'message' => 'Success updated data'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to updated data',
                ]);
            }
        } else {
            if ($this->tmpTransactionModel->save($data)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Success saved data',

                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to save data',
                ]);
            }
        }
    }

    function getTmpTransaction()
    {
        // $data = $this->tmpTransactionModel->findAll();
        $data = $this->tmpTransactionModel->select('items.name, items.price, tmp_transactions.tmp_txn_id, tmp_transactions.quantity')->join('items', 'items.item_id = tmp_transactions.item_id')->orderBy('tmp_txn_id', 'ASC')->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data,
            'message' => 'Transaction data retrieved successfully'
        ]);
    }

    function minQty()
    {
        $tmp_txn_id = $this->request->getPost();

        $data_tmp = $this->tmpTransactionModel->where('tmp_txn_id', $tmp_txn_id)->first();

        // cek apakah quantity lebih besar dari 1
        if (!empty($data_tmp) && $data_tmp['quantity'] > 1) {
            $data_tmp['quantity'] = $data_tmp['quantity'] - 1;

            if ($this->tmpTransactionModel->update($tmp_txn_id, $data_tmp)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Success updated quantity data'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update quantity data'
                ]);
            }
        } else {
            return $this->deleteItemCart($tmp_txn_id);
        }
    }

    function addQty()
    {
        $tmp_txn_id = $this->request->getPost();

        $data_tmp = $this->tmpTransactionModel->where('tmp_txn_id', $tmp_txn_id)->first();

        // cek apakah data tmp tidak kosong
        if (!empty($data_tmp)) {
            $data_tmp['quantity'] = $data_tmp['quantity'] + 1;

            if ($this->tmpTransactionModel->update($tmp_txn_id, $data_tmp)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Success updated quantity data'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update quantity data'
                ]);
            }
        }
    }

    public function resetCart()
    {
        $this->tmpTransactionModel->truncate();
        // $this->tmpTransactionModel->delete();

        /* note:
        truncate = hapus data beserta reset increment, menghapus semua data
        delete = hapus data tidak dengan increment, bisa data tertentu
        */

        /*
        future update: 
        gunakan delete() untuk reset cart dan berikan pengecekan untuk user_id yang sedang melakukan aksi reset,
        karena kedepannya bisa saja ada kasir lebih dari 1 dan truncate tidak cocok digunakan 
        */

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Successfully delete all data'
        ]);
    }

    public function deleteItemCart($tmp_txn_id = 0)
    {
        $this->tmpTransactionModel->delete($tmp_txn_id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Item deleted successfully'
        ]);
    }

    public function completeTransaction()
    {
        $transactionData = $this->request->getPost();
        $user_id = session()->get('user_id');
        $txn_code = 'TXN-' . Uuid::uuid4()->toString();;
        $transactionData['user_id'] = $user_id;
        $transactionData['txn_code'] = $txn_code;

        if (!$this->transactionModel->insert($transactionData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to complete transaction'
            ]);

            // $this->tmpTransactionModel->truncate();

            // return $this->response->setJSON([
            //     'success' => true,
            //     'message' => 'Transaction completed successfully'
            // ]);
        }

        // ambil transaction_id yang dihasilkan
        $transaction_id = $this->transactionModel->getInsertID();
        if (!isset($transaction_id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Transaction ID not found',
                'transaction_id' => $transaction_id
            ]);
        }

        // ambil semua data berdasarkan user_id dari tmp_transactions
        $tmpTransactionData = $this->tmpTransactionModel
            ->select('items.price, tmp_transactions.*')
            ->join('items', 'items.item_id = tmp_transactions.item_id')
            ->where('user_id', $user_id)->findAll();
        if (empty($tmpTransactionData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keranjang kosong.'
            ]);
        }

        // simpan data ke transaction_details
        foreach ($tmpTransactionData as $tmpItem) {
            $price = $tmpItem['price'];

            $detailData = [
                'transaction_id' => $transaction_id,
                'item_id' => $tmpItem['item_id'],
                'quantity' => $tmpItem['quantity'],
                'subtotal' => $tmpItem['quantity'] * $price,
            ];

            $this->txnDetailModel->insert($detailData);

            // kurangi quantity dari table items
            $item = $this->itemModel->where('item_id', $tmpItem['item_id'])->first();
            if ($item) {
                $item['stock'] -= $tmpItem['quantity'];
                if ($item['stock'] <= 0) {
                    $this->itemModel->delete($tmpItem['item_id']);
                } else {
                    $this->itemModel->update($tmpItem['item_id'], $item);
                }
            }
        }

        // kosongkan data
        $this->tmpTransactionModel->where('user_id',)->truncate();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Transaction completed successfully'
        ]);
    }

    public function getMyTransactions()
    {
        $user_id = session()->get('user_id');

        // $data = $this->transactionModel->select('transactions.*, users.name as user_name')->join('users', 'users.user_id = transactions.user_id')->where('transactions.user_id', $user_id)->orderBy('created_at', 'ASC')->findAll();
        $data = $this->transactionModel
            ->select('transactions.*, SUM(transaction_details.quantity) as total_items')
            ->join('transaction_details', 'transaction_details.transaction_id = transactions.transaction_id', 'left')
            ->where('transactions.user_id', $user_id)
            ->groupBy('transactions.transaction_id')
            ->orderBy('transactions.created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data,
            'message' => 'My Transaction data retrieved successfully'
        ]);
    }

    public function getAllTransactions()
    {
        $data = $this->transactionModel
            ->select('transactions.*, users.name as cashier_name, SUM(transaction_details.quantity) as total_items')
            ->join('transaction_details', 'transaction_details.transaction_id = transactions.transaction_id', 'left')
            ->join('users', 'users.user_id = transactions.user_id')
            ->groupBy('transactions.transaction_id')
            ->orderBy('transactions.created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data,
            'message' => 'All Transaction data retrieved successfully'
        ]);
    }

    public function getTransactionDetail($transaction_id = 0)
    {
        $data = $this->txnDetailModel
            ->select('users.name as cashier_name, items.name, items.price, categories.category_name, transaction_details.*, transactions.txn_code, transactions.created_at, transactions.status')
            ->join('items', 'items.item_id = transaction_details.item_id')
            ->join('categories', 'categories.category_id = items.category_id')
            ->join('transactions', 'transactions.transaction_id = transaction_details.transaction_id')
            ->join('users', 'users.user_id = transactions.user_id')
            ->where('transaction_details.transaction_id', $transaction_id)
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data,
            'message' => 'Transaction detail data retrieved successfully'
        ]);
    }
}
