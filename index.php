<?php
session_start();

require "./configs.php";
require BASE_PATH .  "/includes/functions.php";

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require_once BASE_PATH .  "/controllers/HomeController.php";
        $homeController = new HomeController();

        $homeController->showHomePage();
        break;

    case 'login':
        require_once BASE_PATH .  "/controllers/UserController.php";
        $userController = new UserController();

        $userController->showLoginPage();
        break;

    case 'userLogin':
        require_once BASE_PATH .  "/controllers/UserController.php";
        $userController = new UserController();

        $userController->handleUserLogin($_POST);
        break;

    case 'register':
        require_once BASE_PATH .  "/controllers/UserController.php";
        $userController = new UserController();

        $userController->showRegisterPage();
        break;

    case 'userRegister':
        require_once BASE_PATH .  "/controllers/UserController.php";
        $userController = new UserController();

        $userController->handleUserRegister($_POST, $_FILES);
        break;

    case 'logout':
        require_once BASE_PATH .  "/controllers/UserController.php";
        $userController = new UserController();

        $userController->handleUserLogout();
        break;

    case 'viewDetail':
        require_once BASE_PATH .  "/controllers/ProductController.php";
        $productController = new ProductController();

        $productController->showViewDetail();
        break;

    case 'cart':
        require_once BASE_PATH .  "/controllers/CartController.php";
        $cartController = new CartController();

        $cartController->showCartPage();
        break;

    case 'search':

    default:
        require BASE_PATH . '/views/404.php';
        break;
}
