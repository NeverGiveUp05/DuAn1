<?php
require_once BASE_PATH . '/models/ProductModel.php';

class ProductController
{
    public $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function showViewDetail()
    {
        $view = BASE_PATH . '/views/detail.php';

        $idDetail = $_GET['detail'];
        $page_title = $this->productModel->hang_getNameById($idDetail) . ' | IVY moda';

        $detailProduct = $this->productModel->hang_selectById($idDetail);

        $this->productModel->hang_upView($idDetail);

        $cssPaths = [
            BASE_URL . '/public/css/style.css',
            BASE_URL . '/public/css/detail.css',
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }
}
