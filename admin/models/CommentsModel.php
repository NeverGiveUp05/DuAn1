<?php
include_once BASE_PATH . '/includes/connect_db.php';

class CommentsModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function hang_selectAll()
    {
        $sql = "SELECT * FROM san_pham";
        return pdo_query($sql);
    }

    public function comment_getAllByLoaiHang($id)
    {
        $sql = "SELECT * FROM binh_luan WHERE san_pham_id = $id";
        return pdo_query($sql);
    }

    public function comment_add($comment, $date, $ma_hang_hoa, $ma_khach_hang)
    {
        $sql = "INSERT INTO binh_luan VALUES (null, '$comment', '$date', '$ma_hang_hoa', '$ma_khach_hang')";
        pdo_execute($sql);
    }

    public function comment_delete($id)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_binh_luan = $id";
        pdo_execute($sql);
    }

    public function comment_multipleDelete($ids)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_binh_luan IN ($ids)";
        pdo_execute($sql);
    }

    public function comment_newCommentAt($id)
    {
        $sql = "SELECT MAX(ngay_binh_luan) FROM binh_luan WHERE san_pham_id = $id";
        return pdo_query_value($sql);
    }

    public function comment_oldCommentAt($id)
    {
        $sql = "SELECT MIN(ngay_binh_luan) FROM binh_luan WHERE san_pham_id = ?";
        return pdo_query_value($sql, $id);
    }

    public function comment_getAllBySanPham($id)
    {
        $sql = "SELECT * FROM comments WHERE san_pham_id = ?";
        return pdo_query($sql, $id);
    }

    public function getNameUserById($id)
    {
        $sql = "SELECT ten FROM nguoi_dung WHERE id = ?";
        return pdo_query_value($sql, $id);
    }

    public function getNameProductById($id)
    {
        $sql = "SELECT ten_san_pham FROM san_pham WHERE id = ?";
        return pdo_query_value($sql, $id);
    }
}
