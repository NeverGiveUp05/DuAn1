<?php
require_once BASE_PATH . '/models/UserModel.php';

class CartController
{
    public $cartModel;

    public function __construct()
    {
        // $this->cartModel = new CartModel();
    }

    public function showCartPage()
    {
        $view = BASE_PATH . '/views/cart.php';

        $page_title = 'Giỏ hàng | IVY moda';

        $cssPaths = [
            BASE_URL . '/public/css/style.css',
            BASE_URL . '/public/css/cart.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }
}
