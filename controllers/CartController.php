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

    public function handleUpdateCart()
    {
        $cartData = json_decode(file_get_contents("php://input"), true);

        echo '<pre>';
        print_r($cartData);
        echo '</pre>';

        die();

        $cartModel = new CartModel();
        $result = $cartModel->updateCart($cartData);

        // Trả phản hồi JSON về client
        echo json_encode([
            'success' => true,
            'message' => 'Giỏ hàng đã được cập nhật',
            'data' => $result,
        ]);


        $data = json_decode(file_get_contents('php://input'), true);

        // Kiểm tra dữ liệu
        if (isset($data['productId']) && isset($data['quantity'])) {
            // Thực hiện cập nhật giỏ hàng trong cơ sở dữ liệu
            // Giả sử cập nhật thành công

            $response = [
                'status' => 'success',
                'message' => 'Giỏ hàng đã được cập nhật'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ'
            ];
        }

        // Trả về phản hồi JSON cho client
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
