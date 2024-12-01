<?php
include_once BASE_PATH . '/includes/connect_db.php';

class ProductModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function hang_selectByLoaiHang($ma_loai_hang)
    {
        $sql = "SELECT * FROM san_pham WHERE loai_hang_id = $ma_loai_hang";
        return pdo_query($sql);
    }

    public function hang_selectFirstLoaiHang()
    {
        $sql = "SELECT * FROM san_pham WHERE loai_hang_id = (SELECT id FROM loai_hang LIMIT 1)";
        return pdo_query($sql);
    }

    public function hang_getNameById($id)
    {
        $sql = "SELECT ten_san_pham FROM san_pham WHERE loai_hang_id = ?";
        return pdo_query_value($sql, $id);
    }

    public function hang_selectById($id)
    {
        $sql = "SELECT * FROM san_pham WHERE id = $id";
        return pdo_query_one($sql);
    }

    public function hang_upView($id)
    {
        $sql = "UPDATE san_pham SET so_luot_xem = so_luot_xem + 1 WHERE id = ?";
        pdo_execute($sql, $id);
    }
}
