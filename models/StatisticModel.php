<?php
include_once BASE_PATH . '/includes/connect_db.php';

class StatisticModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getStatusStatisticLatest($id)
    {
        $sql = "SELECT
        lshd.trang_thai
    FROM 
        hoa_don hd
    INNER JOIN 
        nguoi_dung nd ON hd.nguoi_dung_id = nd.id
    INNER JOIN 
        lich_su_hoa_don lshd ON hd.id = lshd.hoa_don_id
    WHERE 
        nd.id = ?
    ORDER BY 
        lshd.thoi_gian DESC
    LIMIT 1";

        return pdo_query_value($sql, $id);
    }
}
