<?php
require_once BASE_PATH . '/models/StatisticModel.php';

class StatisticController
{
    public $statisticModel;

    public function __construct()
    {
        $this->statisticModel = new StatisticModel();
    }

    public function showStatisticPage()
    {
        $view = BASE_PATH . '/views/statistic.php';

        $page_title = 'Trạng thái đơn hàng | IVY moda';

        if (isset($_SESSION['userId'])) {
            $status = $this->statisticModel->getStatusStatisticLatest($_SESSION['userId']);
        }

        $cssPaths = [
            BASE_URL . '/public/css/style.css',
            BASE_URL . '/public/css/cart.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }
}
