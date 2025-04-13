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

    // add user
    public function addUser()
    {
        $data = $this->request->getPost();

        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

        $data['password'] = $password_hash;

        $addDataStatus = $this->userModel->save($data);

        if ($addDataStatus) {
            return $this->response->setJSON(['success' => true, 'message' => 'New user successfully added']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add user']);
        }
    }

    // get all user
    public function getUsers()
    {
        $data = $this->userModel->findAll();

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }

    // get specified user for edit
    public function getEdit($user_id = 0)
    {
        $data = $this->userModel->find($user_id);

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }

    // save edit user
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

    public function deleteUser($user_id = 0)
    {
        $this->userModel->delete($user_id);

        return $this->response->setJSON(['success' => true, 'message' => 'User deleted successfully']);
    }
}
