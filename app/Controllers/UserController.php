<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getUsers()
    {
        $data = $this->userModel->findAll();

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }
}
