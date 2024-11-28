<?php
include_once './includes/connect_db.php';

class ProductModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function hang_selectByLoaiHang($ma_loai_hang)
    {
        $sql = "SELECT * FROM hang_hoa WHERE ma_loai_hang = $ma_loai_hang";
        return pdo_query($sql);
    }

    public function hang_selectFirstLoaiHang()
    {
        $sql = "SELECT * FROM hang_hoa WHERE ma_loai_hang = (SELECT ma_loai_hang FROM loai_hang LIMIT 1)";
        return pdo_query($sql);
    }

    public function hang_getNameById($id)
    {
        $sql = "SELECT ten_hang_hoa FROM hang_hoa WHERE ma_hang_hoa = ?";
        return pdo_query_value($sql, $id);
    }
}
