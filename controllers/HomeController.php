<?php
require_once BASE_PATH . '/models/UserModel.php';
require_once BASE_PATH . '/models/ProductModel.php';
require_once BASE_PATH . '/models/CategoryModel.php';
class HomeController
{
    public $userModel;
    public $productModel;
    public $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function showHomePage()
    {
        if (isset($_SESSION['userId'])) {
            $id = $_SESSION['userId'];

            $usercurrent = $this->userModel->user_selectById($id);
        }

        $ds = $this->categoryModel->loai_selectAll();

        if (isset($_GET['list'])) {
            $products = $this->productModel->hang_selectByLoaiHang($_GET['list']);
        } else {
            $products = $this->productModel->hang_selectFirstLoaiHang();
        }

        $view = BASE_PATH . '/views/home.php';

        $page_title = 'Trang chủ | IVY moda';

        $cssPaths = [
            BASE_URL . '/public/css/style.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/banner.js',
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }
}
