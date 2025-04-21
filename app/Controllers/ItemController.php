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

    public function addItem()
    {
        $formData = $this->request->getPost();

        $this->itemModel->save($formData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'New item successfully added'
        ]);
    }

    public function getEdit($item_id = 0)
    {
        $data = $this->itemModel->find($item_id);

        return $this->response->setJSON(['success' => true, 'data' => $data]);
    }

    public function deleteItem($item_id = 0)
    {
        $this->itemModel->delete($item_id);

        return $this->response->setJSON(['success' => true, 'message' => 'Item deleted successfully']);
    }
}
