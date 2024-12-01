<?php
include_once BASE_PATH . '/includes/connect_db.php';

class UserModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function user_selectAll()
    {
        $sql = "SELECT * FROM khach_hang";
        return pdo_query($sql);
    }

    public function client_selectAll()
    {
        $sql = "SELECT * FROM khach_hang WHERE vai_tro = 0";
        return pdo_query($sql);
    }

    public function user_selectById($id)
    {
        $sql = "SELECT * FROM nguoi_dung WHERE id = ?";
        return pdo_query_one($sql, $id);
    }

    public function user_selectByEmail($email)
    {
        $sql = "SELECT * FROM khach_hang WHERE email = '$email'";
        return pdo_query_one($sql);
    }

    public function checkUserLogin($account, $password)
    {
        $sql = "SELECT id, quyen_id FROM nguoi_dung WHERE (email = ? OR so_dien_thoai = ?) AND mat_khau = ?";
        return pdo_query_one($sql, $account, $account, $password);
    }

    public function checkUserRegister($email, $so_dien_thoai)
    {
        $sql = "SELECT ma_khach_hang FROM khach_hang WHERE email = ? OR so_dien_thoai = ?";
        return pdo_query_value($sql, $email, $so_dien_thoai);
    }

    public function getIdUser($email, $so_dien_thoai, $trang_thai)
    {
        $sql = "SELECT ma_khach_hang FROM khach_hang WHERE email = ? AND so_dien_thoai = ? AND kich_hoat = ?";
        return pdo_query_value($sql, $email, $so_dien_thoai, $trang_thai);
    }

    public function user_delete($id)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_khach_hang = $id";

        pdo_execute($sql);

        $sql = "DELETE FROM khach_hang WHERE ma_khach_hang = ?";

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
            $sql = "INSERT INTO khach_hang VALUES (null, '$email', '$so_dien_thoai', '$mat_khau', '$ho_ten', '$hinh_anh', b'$kich_hoat', DEFAULT)";
        } else {
            $sql = "INSERT INTO khach_hang VALUES (null, '$email', '$so_dien_thoai', '$mat_khau', '$ho_ten', null, b'$kich_hoat', DEFAULT)";
        };

        pdo_execute($sql);

        return $this->user_selectByEmail($email);
    }

    public function user_update($id, $email, $so_dien_thoai, $mat_khau, $ho_ten, $hinh_anh, $kich_hoat)
    {
        if (isset($hinh_anh)) {
            $sql = "UPDATE khach_hang SET email = '$email', so_dien_thoai = '$so_dien_thoai', mat_khau = '$mat_khau', ho_ten = '$ho_ten', hinh_anh = '$hinh_anh', kich_hoat = b'$kich_hoat' WHERE ma_khach_hang = '$id'";
        } else {
            $sql = "UPDATE khach_hang SET email = '$email', so_dien_thoai = '$so_dien_thoai', mat_khau = '$mat_khau', ho_ten = '$ho_ten', hinh_anh = null, kich_hoat = b'$kich_hoat' WHERE ma_khach_hang = '$id'";
        };

        pdo_execute($sql);
    }

    public function user_multipleDelete($ids)
    {
        $sql = "DELETE FROM binh_luan WHERE ma_khach_hang IN ($ids)";

        pdo_execute($sql);

        $sql = "DELETE FROM khach_hang WHERE ma_khach_hang IN ($ids)";

        pdo_execute($sql);
    }
}
