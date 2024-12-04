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
        $sql = "SELECT 
        sp.id,
        sp.ten_san_pham,
        sp.mo_ta,
        sp.hinh_anh,
        sp.hinh_anh_chi_tiet_1,
        spct.gia_ban,
        (spct.so_luong_nhap - spct.so_luong_ban) AS so_luong_con,
        sp.so_luot_xem,
        -- spct.id AS san_pham_chi_tiet_id,
        ms.ten_mau AS mau_sac,                   
        sz.ten_size AS size,                     
        COALESCE(gg.phan_tram_giam, 0) AS phan_tram_giam,
        ROUND(spct.gia_ban * (1 - COALESCE(gg.phan_tram_giam, 0) / 100), 0) AS gia_sau_giam
        FROM 
        san_pham sp
        JOIN 
        san_pham_chi_tiet spct 
        ON sp.id = spct.san_pham_id 
        LEFT JOIN 
        giam_gia gg 
        ON sp.id = gg.san_pham_id AND NOW() BETWEEN gg.ngay_bat_dau AND gg.ngay_ket_thuc
        LEFT JOIN 
        mau_sac ms
        ON spct.mau_sac_id = ms.id           
        LEFT JOIN 
        size sz
        ON spct.size_id = sz.id             
        WHERE loai_hang_id = ?";

        return pdo_query($sql, $ma_loai_hang);
    }

    public function hang_selectFirstLoaiHang()
    {

        $sql = "SELECT 
            spct.id,
            sp.ten_san_pham,
            sp.mo_ta,
            sp.hinh_anh,
            sp.hinh_anh_chi_tiet_1,
            spct.gia_ban,
            (spct.so_luong_nhap - spct.so_luong_ban) AS so_luong_con,
            sp.so_luot_xem,
            ms.ma_mau,
            sz.ten_size,
            COALESCE(gg.phan_tram_giam, 0) AS phan_tram_giam,
            ROUND(spct.gia_ban * (1 - COALESCE(gg.phan_tram_giam, 0) / 100), 0) AS gia_sau_giam
        FROM 
            san_pham sp
        JOIN 
            san_pham_chi_tiet spct 
            ON sp.id = spct.san_pham_id 
        LEFT JOIN 
            giam_gia gg 
            ON sp.id = gg.san_pham_id AND NOW() BETWEEN gg.ngay_bat_dau AND gg.ngay_ket_thuc
        LEFT JOIN 
            mau_sac ms
            ON spct.mau_sac_id = ms.id            
        LEFT JOIN 
            size sz
            ON spct.size_id = sz.id                
        WHERE sp.loai_hang_id = (SELECT id FROM loai_hang LIMIT 1)";

        return pdo_query($sql);
    }

    public function hang_getNameById($id)
    {
        $sql = "SELECT ten_san_pham FROM san_pham WHERE loai_hang_id = ?";
        return pdo_query_value($sql, $id);
    }

    public function hang_selectById($id)
    {
        $sql = "SELECT 
        sp.id,
        sp.ten_san_pham,
        sp.mo_ta,
        sp.hinh_anh,
        sp.hinh_anh_chi_tiet_1,
        sp.hinh_anh_chi_tiet_2,
        sp.hinh_anh_chi_tiet_3,
        spct.gia_ban,
        (spct.so_luong_nhap - spct.so_luong_ban) AS so_luong_con,
        sp.so_luot_xem,
        -- spct.id AS san_pham_chi_tiet_id,
        ms.ten_mau AS mau_sac,                   
        sz.ten_size AS size,                     
        COALESCE(gg.phan_tram_giam, 0) AS phan_tram_giam,
        ROUND(spct.gia_ban * (1 - COALESCE(gg.phan_tram_giam, 0) / 100), 0) AS gia_sau_giam
        FROM 
        san_pham sp
        JOIN 
        san_pham_chi_tiet spct 
        ON sp.id = spct.san_pham_id 
        LEFT JOIN 
        giam_gia gg 
        ON sp.id = gg.san_pham_id AND NOW() BETWEEN gg.ngay_bat_dau AND gg.ngay_ket_thuc
        LEFT JOIN 
        mau_sac ms
        ON spct.mau_sac_id = ms.id           
        LEFT JOIN 
        size sz
        ON spct.size_id = sz.id             
        WHERE sp.id = ?";

        return pdo_query($sql, $id);
    }

    public function hang_upView($id)
    {
        $sql = "UPDATE san_pham SET so_luot_xem = so_luot_xem + 1 WHERE id = ?";
        pdo_execute($sql, $id);
    }
}
