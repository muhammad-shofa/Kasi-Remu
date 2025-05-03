<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{

    protected $userModel;
    protected $itemModel;
    protected $transaction;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
        $this->transaction = new TransactionModel();
    }

    // count data user, item, my transactions and all transaction
    public function countData()
    {
        $userCount = $this->userModel->countAllResults();
        $itemCount = $this->itemModel->countAllResults();
        $myTransactionCount = $this->transaction->where('user_id', session()->get('user_id'))->countAllResults();
        $allTransaction = $this->transaction->countAllResults();

        if ($userCount && $itemCount) {
            return $this->response->setJSON([
                'success' => true,
                'userCount' => $userCount,
                'itemCount' => $itemCount,
                'myTransactionCount' => $myTransactionCount,
                'allTransactionCount' => $allTransaction,
                'message' => 'Success to count data'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to count data'
            ]);
        }
    }
}
