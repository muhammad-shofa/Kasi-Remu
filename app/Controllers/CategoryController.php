<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getCategories()
    {
        $dataCategories = $this->categoryModel->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $dataCategories
        ]);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $data = $this->categoryModel->like('category_name', $keyword)->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }
}
