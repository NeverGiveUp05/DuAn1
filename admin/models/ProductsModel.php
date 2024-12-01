<?php
include_once BASE_PATH . '/includes/connect_db.php';

class ProductsModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function loai_selectAll()
    {
        $sql = "SELECT * FROM loai_hang";
        return  pdo_query($sql);
    }

    public function hang_selectAll()
    {
        $sql = "SELECT * FROM san_pham";
        return pdo_query($sql);
    }

    public function hang_selectByLoaiHang($id)
    {
        $sql = "SELECT * FROM san_pham WHERE loai_hang_id = $id";
        return pdo_query($sql);
    }

    public function hang_selectById($id)
    {
        $sql = "SELECT * FROM san_pham WHERE id = $id";
        return pdo_query_one($sql);
    }

    public function hang_upView($id)
    {
        $sql = "UPDATE san_pham SET so_luot_xem = so_luot_xem + 1 WHERE id = $id";
        pdo_execute($sql);
    }

    public function hang_add($name, $img_path, $img_path1, $img_path2, $img_path3, $cost, $discount, $type, $description)
    {
        if ($discount != null) {
            $sql = "INSERT INTO san_pham VALUES (null, '$name', '$img_path', '$img_path1', '$img_path2', '$img_path3', '$cost', '$discount', '$type', '$description', DEFAULT)";
        } else {
            $sql = "INSERT INTO san_pham VALUES (null, '$name', '$img_path', '$img_path1', '$img_path2', '$img_path3', '$cost', null, '$type', '$description', DEFAULT)";
        }

        pdo_execute($sql);
    }

    public function hang_update($id, $name, $img_path, $img_path1, $img_path2, $img_path3, $cost, $discount, $type, $description)
    {
        if ($discount != null) {
            $sql = "UPDATE san_pham SET ten_san_pham = '$name', hinh_anh = '$img_path', hinh_anh_nen = '$img_path1', hinh_anh_1 = '$img_path2', hinh_anh_2 = '$img_path3', don_gia = '$cost', muc_giam_gia = '$discount', loai_hang_id = '$type', mo_ta_san_pham = '$description' WHERE id = $id";
        } else {
            $sql = "UPDATE san_pham SET ten_san_pham = '$name', hinh_anh = '$img_path', hinh_anh_nen = '$img_path1', hinh_anh_1 = '$img_path2', hinh_anh_2 = '$img_path3', don_gia = '$cost', muc_giam_gia = NULL, loai_hang_id = '$type', mo_ta_san_pham = '$description' WHERE id = $id";
        }

        pdo_execute($sql);
    }

    public function hang_delete($id)
    {
        $sql = "DELETE FROM binh_luan WHERE id = $id";

        pdo_execute($sql);

        $sql = "DELETE FROM san_pham WHERE id = ?";

        pdo_execute($sql, $id);
    }

    public function hang_multipleDelete($ids)
    {
        $sql = "DELETE FROM binh_luan WHERE id IN ($ids)";

        pdo_execute($sql);

        $sql = "DELETE FROM san_pham WHERE id IN ($ids)";

        pdo_execute($sql);
    }

    public function hang_getMinPriceByLoaiHang($id)
    {
        $sql = "SELECT * FROM san_pham WHERE loai_hang_id = ? ORDER BY don_gia ASC LIMIT 1";
        return pdo_query_one($sql, $id);
    }

    public function hang_getMaxPriceByLoaiHang($id)
    {
        $sql = "SELECT * FROM san_pham WHERE loai_hang_id = $id ORDER BY don_gia desc LIMIT 1";
        return pdo_query_one($sql);
    }
}
