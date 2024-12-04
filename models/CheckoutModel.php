<?php
include_once BASE_PATH . '/includes/connect_db.php';

class CheckoutModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkout() {}
}
