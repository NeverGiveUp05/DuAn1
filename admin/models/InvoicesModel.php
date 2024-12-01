<?php
include_once BASE_PATH . '/includes/connect_db.php';

class InvoicesModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function invoices_getAll()
    {
        $sql = "SELECT * FROM hoa_don";
        return pdo_query($sql);
    }

    public function user_getName($id)
    {
        $sql = "SELECT ten FROM nguoi_dung WHERE id = ?";
        return pdo_query_value($sql, $id);
    }

    public function invoices_getStatus($id)
    {
        $sql = "SELECT trang_thai 
            FROM lich_su_hoa_don 
            WHERE hoa_don_id = ? 
            ORDER BY thoi_gian DESC 
            LIMIT 1";
        return pdo_query_value($sql, $id);
    }

    public function invoices_upDate($hoa_don_id, $trang_thai, $ghi_chu, $thoi_gian, $nguoi_sua_id)
    {
        $sql = "INSERT INTO lich_su_hoa_don VALUES ( null, ?, ?, ?, ?, ?)";
        pdo_execute($sql, $hoa_don_id, $trang_thai, $ghi_chu, $thoi_gian, $nguoi_sua_id);
    }

    function invoices_check($id)
    {
        $sql = "SELECT COUNT(*) 
        FROM lich_su_hoa_don 
        WHERE hoa_don_id = ? AND trang_thai IN ('Refunded', 'Returned', 'Canceled')";
        return pdo_query_value($sql, $id);
    }

    function invoices_updateDoanhThu($id)
    {
        $sql = "UPDATE hoa_don SET doanh_thu = tong_tien WHERE id = ?";
        pdo_execute($sql, $id);
    }
}
