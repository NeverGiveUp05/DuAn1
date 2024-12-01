<?php
require_once BASE_PATH . '/admin/models/ProductsModel.php';

class ProductsController
{
    public $productsModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
    }

    public function showProductsList()
    {
        $view = BASE_PATH . '/admin/views/products/list.php';

        $breadcrumb = 'Products';

        $types = $this->productsModel->loai_selectAll();

        if (isset($_GET['select']) && $_GET['select'] !== 'all') {
            $list = $this->productsModel->hang_selectByLoaiHang($_GET['select']);
        } else {
            $list = $this->productsModel->hang_selectAll();
        }

        $categories = $this->productsModel->loai_selectAll();

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
