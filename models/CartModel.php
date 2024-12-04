<?php
include_once BASE_PATH . '/includes/connect_db.php';

class CartModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function selectCartByUserId($id)
    {
        $sql = "SELECT 
        spct.id,
        sp.ten_san_pham,
        spct.gia_ban,
        sp.hinh_anh,
        ghct.so_luong,
        COALESCE(gg.phan_tram_giam, 0) AS phan_tram_giam
        FROM 
        gio_hang gh 
        JOIN 
        gio_hang_chi_tiet ghct ON gh.id = ghct.gio_hang_id  
        JOIN 
        san_pham_chi_tiet spct ON ghct.san_pham_chi_tiet_id = spct.id 
        JOIN 
        san_pham sp ON spct.san_pham_id = sp.id 
        LEFT JOIN  
        giam_gia gg ON sp.id = gg.san_pham_id AND NOW() BETWEEN gg.ngay_bat_dau AND gg.ngay_ket_thuc
        WHERE 
        gh.nguoi_dung_id = ?
        AND gh.trang_thai = 'New'";

        return pdo_query($sql, $id);
    }

    public function getCartId($id)
    {
        $sql = "SELECT id FROM gio_hang WHERE nguoi_dung_id = ? AND trang_thai = 'New'";

        pdo_query_value($sql, $id);
    }

    public function deleteCart($id)
    {
        $sql = "DELETE FROM gio_hang WHERE user_id = ?";

        pdo_execute($sql, $id);
    }

    public function updateCart() {}
}
