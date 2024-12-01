<?php
require_once BASE_PATH . '/admin/models/UsersModel.php';

class UsersController
{
    public $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function showUsersList()
    {
        $view = BASE_PATH . '/admin/views/users/list.php';

        $breadcrumb = 'Users';

        $list = $this->usersModel->client_selectAll();

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
