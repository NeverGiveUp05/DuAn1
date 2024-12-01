<?php
require_once BASE_PATH . '/admin/models/StatisticsModel.php';

class StatisticsController
{
    public $statisticsModel;

    public function __construct()
    {
        $this->statisticsModel = new StatisticsModel();
    }

    public function showStatisticsPage()
    {
        $view = BASE_PATH . '/admin/views/statistics/index.php';

        $breadcrumb = 'Statistics';

        $data = $this->statisticsModel->layDoanhThuTheoThang();

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
