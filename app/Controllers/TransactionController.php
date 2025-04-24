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

        // $this->tmpTransactionModel->save($data);
        // return $this->response->setJSON([
        //     'success' => true,
        //     'message' => 'tmp_txn saved',
        //     'saved_data' => $data
        // ]);

        // return $this->response->setJSON([
        //     'success' => false,
        //     'message' => 'Gagal menyimpan data',
        //     'errors' => $this->tmpTransactionModel->errors(), // ini akan kasih tahu error CI
        //     'data' => $data
        // ]);
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
        // return $this->response->setJSON([
        //     'success' => true,
        //     'message' => 'debug user_id',
        //     'item_id' => $item_id,
        //     'user_id' => $user_id
        // ]);
    }
}
