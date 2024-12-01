<?php
require_once BASE_PATH . '/admin/models/HomeModel.php';

class HomeController
{
    public $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function showHomePage()
    {
        $view = BASE_PATH . '/admin/views/home/home.php';

        $breadcrumb = 'Dashboard';

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
