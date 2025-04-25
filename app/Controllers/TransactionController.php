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

    function getTmpTransaction()
    {
        // $data = $this->tmpTransactionModel->findAll();
        $data = $this->tmpTransactionModel->select('items.name, items.price, tmp_transactions.quantity')->join('items', 'items.item_id = tmp_transactions.item_id')->orderBy('tmp_txn_id', 'ASC')->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data,
            'message' => 'Transaction data retrieved successfully'
        ]);
    }
}
