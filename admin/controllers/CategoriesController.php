<?php
require_once BASE_PATH . '/admin/models/CategoriesModel.php';

class CategoriesController
{
    public $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }

    public function showCategoriesList()
    {
        $view = BASE_PATH . '/admin/views/categories/list.php';

        $breadcrumb = 'Categories';

        $categories = $this->categoriesModel->loai_selectAll();

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
