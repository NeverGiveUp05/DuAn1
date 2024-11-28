<?php
session_start();

require "./configs.php";

require BASE_PATH .  "/includes/functions.php";

require BASE_PATH .  "/controllers/HomeController.php";
require BASE_PATH .  "/controllers/ProductController.php";
require BASE_PATH .  "/controllers/UserController.php";

require BASE_PATH . '/models/UserModel.php';
require BASE_PATH . '/models/ProductModel.php';
require BASE_PATH . '/models/CategoryModel.php';

$homeController = new HomeController();
$userController = new UserController();
$productController = new ProductController();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $homeController->showHomePage();
        break;

    case 'login':
        $userController->showLoginPage();
        break;

    case 'userLogin':
        $userController->handleUserLogin($_POST);
        break;

    case 'register':
        $userController->showRegisterPage();
        break;

    case 'userRegister':
        $userController->handleUserRegister($_POST, $_FILES);
        break;

    case 'logout':
        $userController->handleUserLogout();
        break;

    case 'viewDetail':
        $productController->showViewDetail();
        break;

    default:
        require BASE_PATH . '/views/404.php';
        break;
}
