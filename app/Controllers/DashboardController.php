<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{

    protected $userModel;
    protected $itemModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
    }

    // count data user, item, my transactions and all transaction
    public function countData()
    {
        $userCount = $this->userModel->countAll();
        $itemCount = $this->itemModel->countAll();

        if ($userCount && $itemCount) {
            return $this->response->setJSON([
                'success' => true,
                'userCount' => $userCount,
                'itemCount' => $itemCount,
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
