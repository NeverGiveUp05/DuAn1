<?php
include_once BASE_PATH . '/includes/connect_db.php';

class StatisticsModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function layDoanhThuTheoThang()
    {
        $sql = "SELECT 
                DATE_FORMAT(lshd.thoi_gian, '%Y-%m') AS thang,
                SUM(hd.doanh_thu) AS tong_doanh_thu
                FROM 
                hoa_don hd
                JOIN 
                lich_su_hoa_don lshd
                ON 
                hd.id = lshd.hoa_don_id
                WHERE 
                lshd.trang_thai = 'Completed'
                GROUP BY 
                thang
                ORDER BY 
                thang DESC LIMIT 3";
        return pdo_query($sql);
    }
}
