<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class ItemController extends BaseController
{
    protected $itemModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function getItems()
    {
        // ambil data dari function di itemModel
        $data = $this->itemModel->getItemsWithCategory();

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }
}
