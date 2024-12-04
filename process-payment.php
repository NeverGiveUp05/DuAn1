<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

error_reporting(E_ALL);  // Báo lỗi đầy đủ
ini_set('display_errors', 1);
// Lấy dữ liệu JSON từ body của yêu cầu
// $data = json_decode(file_get_contents('php://input'), true);

// // Kiểm tra nếu dữ liệu hợp lệ
// if ($data) {
//     // Giả sử bạn đã xử lý thanh toán và lưu thông tin vào cơ sở dữ liệu
//     // Ở đây bạn có thể thực hiện các bước như lưu đơn hàng, giảm số lượng sản phẩm trong kho, gửi email, v.v.

//     // Trả về phản hồi cho client
//     $response = [
//         'status' => 'success',
//         'message' => 'Thanh toán thành công!',
//         'orderId' => '12345'  // ID đơn hàng (có thể thay đổi tùy vào hệ thống của bạn)
//     ];

//     // Trả dữ liệu JSON về client
//     header('Content-Type: application/json');
//     echo json_encode($response);
// } else {
//     // Nếu không có dữ liệu hợp lệ
//     $response = [
//         'status' => 'error',
//         'message' => 'Dữ liệu không hợp lệ'
//     ];

//     // Trả về lỗi
//     header('Content-Type: application/json');
//     echo json_encode($response);
// }
/// cái trên để tham khảo


//////////////////////////////////////////////////////////////////////////////
// Kết nối tới cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "tacong09032005", "duan");

if ($mysqli->connect_error) {
    die("Kết nối không thành công: " . $mysqli->connect_error);
}

// Lấy dữ liệu từ POST (dữ liệu giỏ hàng)
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['nguoi_dung_id']) || !isset($data['tong_tien']) || !isset($data['san_pham'])) {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
    exit;
}

$nguoi_dung_id = $data['nguoi_dung_id'];
$tong_tien = $data['tong_tien'];
$ngay_tao = date('Y-m-d');
$san_pham = $data['san_pham']; // Đây là mảng các sản phẩm với thông tin chi tiết (ID, giá, số lượng)

// Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
$mysqli->begin_transaction();

try {
    // 1. Thêm vào bảng `hoa_don`
    $stmt = $mysqli->prepare("INSERT INTO hoa_don (nguoi_dung_id, tong_tien, ngay_tao) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $nguoi_dung_id, $tong_tien, $ngay_tao);
    $stmt->execute();

    // Lấy ID của đơn hàng mới
    $hoa_don_id = $stmt->insert_id;

    // 2. Thêm các sản phẩm chi tiết vào bảng `hoa_don_chi_tiet`
    $stmt = $mysqli->prepare("INSERT INTO hoa_don_chi_tiet (hoa_don_id, san_pham_chi_tiet_id, so_luong, gia) VALUES (?, ?, ?, ?)");

    foreach ($san_pham as $san_pham_detail) {
        $san_pham_chi_tiet_id = $san_pham_detail['san_pham_chi_tiet_id'];
        $so_luong = $san_pham_detail['so_luong'];
        $gia = $san_pham_detail['gia_ban'];

        $stmt->bind_param("iiii", $hoa_don_id, $san_pham_chi_tiet_id, $so_luong, $gia);
        $stmt->execute();
    }

    // 3. Thêm vào bảng `lich_su_hoa_don` để lưu trạng thái và thông tin người sửa
    $trang_thai = 'Pending'; // Trạng thái mặc định là "Pending"
    $thoi_gian = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

    $stmt = $mysqli->prepare("INSERT INTO lich_su_hoa_don (hoa_don_id, trang_thai, thoi_gian, nguoi_sua_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $hoa_don_id, $trang_thai, $thoi_gian, $nguoi_dung_id);
    $stmt->execute();

    // Commit transaction nếu không có lỗi
    $mysqli->commit();

    // Trả về phản hồi thành công
    echo json_encode(['status' => 'success', 'message' => 'Đơn hàng đã được lưu', 'order_id' => $hoa_don_id]);
} catch (Exception $e) {
    // Rollback nếu có lỗi
    $mysqli->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
}

// Đóng kết nối
$mysqli->close();
