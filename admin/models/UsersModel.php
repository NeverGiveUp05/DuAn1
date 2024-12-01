<?php
include_once BASE_PATH . '/includes/connect_db.php';

class UsersModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function user_selectAll()
    {
        $sql = "SELECT * FROM nguoi_dung";
        return pdo_query($sql);
    }

    public function client_selectAll()
    {
        $sql = "SELECT * FROM nguoi_dung WHERE quyen_id = 3";
        return pdo_query($sql);
    }

    public function user_selectById($id)
    {
        $sql = "SELECT * FROM nguoi_dung WHERE ma_nguoi_dung = $id";
        return pdo_query_one($sql);
    }

    public function user_selectByEmail($email)
    {
        $sql = "SELECT * FROM nguoi_dung WHERE email = '$email'";
        return pdo_query_one($sql);
    }

    public function user_delete($id)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_nguoi_dung = $id";

        pdo_execute($sql);

        $sql = "DELETE FROM nguoi_dung WHERE ma_nguoi_dung = ?";

        pdo_execute($sql, $id);
    }

    public function user_add($email, $so_dien_thoai, $mat_khau, $ho_ten, $hinh_anh, $kich_hoat)
    {
        $users = $this->user_selectAll();

        foreach ($users as $user) {
            if ($user['email'] == $email) {
                return false;
            }
        }

        if (isset($hinh_anh)) {
            $sql = "INSERT INTO nguoi_dung VALUES (null, '$email', '$so_dien_thoai', '$mat_khau', '$ho_ten', '$hinh_anh', b'$kich_hoat', DEFAULT)";
        } else {
            $sql = "INSERT INTO nguoi_dung VALUES (null, '$email', '$so_dien_thoai', '$mat_khau', '$ho_ten', null, b'$kich_hoat', DEFAULT)";
        };

        pdo_execute($sql);
    }

    public function user_update($id, $email, $so_dien_thoai, $mat_khau, $ho_ten, $hinh_anh, $kich_hoat)
    {
        if (isset($hinh_anh)) {
            $sql = "UPDATE nguoi_dung SET email = '$email', so_dien_thoai = '$so_dien_thoai', mat_khau = '$mat_khau', ho_ten = '$ho_ten', hinh_anh = '$hinh_anh', kich_hoat = b'$kich_hoat' WHERE ma_nguoi_dung = '$id'";
        } else {
            $sql = "UPDATE nguoi_dung SET email = '$email', so_dien_thoai = '$so_dien_thoai', mat_khau = '$mat_khau', ho_ten = '$ho_ten', hinh_anh = null, kich_hoat = b'$kich_hoat' WHERE ma_nguoi_dung = '$id'";
        };

        pdo_execute($sql);
    }

    public function user_multipleDelete($ids)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_nguoi_dung IN ($ids)";

        pdo_execute($sql);

        $sql = "DELETE FROM nguoi_dung WHERE ma_nguoi_dung IN ($ids)";

        pdo_execute($sql);
    }
}
