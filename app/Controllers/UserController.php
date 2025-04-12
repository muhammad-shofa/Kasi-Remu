<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
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

    public function getEdit($user_id = 0)
    {
        $data = $this->userModel->find($user_id);

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }

    public function saveEdit($user_id = 0)
    {
        $formData = $this->request->getPost();

        // $this->userModel->update($user_id, $formData);
        $updateDataStatus = $this->userModel->update($user_id, $formData);
        if ($updateDataStatus) {
            return $this->response->setJSON(['success' => true, 'message' => 'User updated successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update user']);
        }
    }
}
