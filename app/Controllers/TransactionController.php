<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TmpTransactionModel;
use CodeIgniter\HTTP\ResponseInterface;

class TransactionController extends BaseController
{
    protected $tmpTransactionModel;

    public function __construct()
    {
        $this->tmpTransactionModel = new TmpTransactionModel();
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

        // cek apakah quantity tidak lebih besar dari 1
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
}
