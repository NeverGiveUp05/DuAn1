<?php
session_start();

require_once "../configs.php";
require_once BASE_PATH . "/includes/functions.php";

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require_once BASE_PATH .  "/admin/controllers/HomeController.php";
        $homeController = new HomeController();

        $homeController->showHomePage();
        break;

    case 'categories':
        require_once BASE_PATH .  "/admin/controllers/CategoriesController.php";
        $categoriesController = new CategoriesController();

        $categoriesController->showCategoriesList();
        break;

    case 'products':
        require_once BASE_PATH .  "/admin/controllers/ProductsController.php";
        $productsController = new ProductsController();

        $productsController->showProductsList();
        break;

    case 'users':
        require_once BASE_PATH .  "/admin/controllers/UsersController.php";
        $productsController = new UsersController();

        $productsController->showUsersList();
        break;

    case 'comments':
        require_once BASE_PATH .  "/admin/controllers/CommentsController.php";
        $commentsController = new CommentsController();

        $commentsController->showCommentsList();
        break;

    case 'commentsDetail':
        require_once BASE_PATH .  "/admin/controllers/CommentsController.php";
        $commentsController = new CommentsController();

        $commentsController->showCommentsDetail();
        break;

    case 'invoices':
        require_once BASE_PATH .  "/admin/controllers/InvoicesController.php";
        $invoicesController = new InvoicesController();

        $invoicesController->showInvoicesPage();
        break;

    case 'invoicesDetail':
        require_once BASE_PATH .  "/admin/controllers/InvoicesController.php";
        $invoicesController = new InvoicesController();

        $invoicesController->showInvoicesDetailPage();
        break;

    case 'invoicesUpdateStatus':
        require_once BASE_PATH .  "/admin/controllers/InvoicesController.php";
        $invoicesController = new InvoicesController();

        $invoicesController->handleUpdateInvoices();
        break;

    case 'statistics':
        require_once BASE_PATH .  "/admin/controllers/StatisticsController.php";
        $statisticsController = new StatisticsController();

        $statisticsController->showStatisticsPage();
        break;

    default:
        require BASE_PATH . '/views/404.php';
        break;
}
