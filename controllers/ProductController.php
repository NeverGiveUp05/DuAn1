<?php
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

        require BASE_PATH . '/views/layout.php';
    }
}
