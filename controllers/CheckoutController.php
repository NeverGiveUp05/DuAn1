<?php
require_once BASE_PATH . '/models/CheckoutModel.php';

class CheckoutController
{
    public $checkoutModel;

    public function __construct()
    {
        $this->checkoutModel = new CheckoutModel();
    }

    public function showCheckoutPage()
    {
        $view = BASE_PATH . '/views/checkout.php';

        $page_title = 'Thanh toán | IVY moda';

        $cssPaths = [
            BASE_URL . '/public/css/style.css',
            BASE_URL . '/public/css/cart.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }

    public function handleCheckout()
    {
        $this->checkoutModel->checkout();
    }
}
