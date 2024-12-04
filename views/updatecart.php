<?php
require_once BASE_PATH . '/models/UserModel.php';
$cartModel = new CartModel();

if ($isset($_SESSION['userId'])) {
    $cartModel->deleteCart($_SESSION['userId']);
}

// Lấy dữ liệu JSON từ body của yêu cầu
$data = json_decode(file_get_contents('php://input'), true);

$placeholders = [];
$values = [];

foreach ($data as $sanPham) {
    $placeholders[] = "(?, ?, ?)";
    $values[] = $userId; // Thêm `user_id` cho từng sản phẩm
    $values[] = $sanPham['san_pham_id'];
    $values[] = $sanPham['so_luong'];
}

// Kiểm tra dữ liệu
if (true) {
    // Thực hiện cập nhật giỏ hàng trong cơ sở dữ liệu
    // Giả sử cập nhật thành công

    $response = [
        'status' => 'success',
        $data
    ];
} else {
    $response = [
        'status' => 'error',
        $data
    ];
}

// Trả về phản hồi JSON cho client
header('Content-Type: application/json');
echo json_encode($response);
