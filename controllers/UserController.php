<?php
require_once BASE_PATH . '/models/UserModel.php';

class UserController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLoginPage()
    {
        $view = BASE_PATH . '/views/login.php';

        $page_title = 'Đăng nhập | IVY moda';

        $cssPaths = [
            BASE_URL . '/public/css/style.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }

    public function handleUserLogin($postData)
    {
        $account = $postData['account'];
        $password = $postData['password'];

        $infoUser = $this->userModel->checkUserLogin($account, $password);

        if (isset($infoUser) && $infoUser['quyen_id'] == 1) {
            $_SESSION['userId'] =  $infoUser['id'];

            header('location: ' . BASE_URL . '/admin');
        } else if (isset($infoUser) && $infoUser['quyen_id'] == 2) {
            $_SESSION['userId'] =  $infoUser['id'];

            header('location: ' . BASE_URL . '/staff');
        } else if (isset($infoUser) && $infoUser['quyen_id'] == 3) {
            $_SESSION['userId'] =  $infoUser['id'];

            header('location: ' . BASE_URL . '/');
        } else {
            $_SESSION['resultLogin'] = 'error';

            header('location: ' . BASE_URL . '/?action=login');
        }
    }

    public function showRegisterPage()
    {
        $view = BASE_PATH . '/views/register.php';

        $page_title = 'Đăng ký tài khoản | IVY moda';

        $cssPaths = [
            BASE_URL . '/public/css/style.css'
        ];

        $jsPaths = [
            BASE_URL . '/public/js/shop.js'
        ];

        require_once BASE_PATH . '/views/layout.php';
    }

    public function handleUserRegister($postData, $postFile)
    {
        $email = $postData['email'];
        $phone = $postData['phone'];
        $password = $postData['password'];
        $name = $postData['name'];
        $image = $postFile['image'];
        $status = 1;

        $idUser = $this->userModel->checkUserRegister($email, $phone);

        if (!$idUser) {
            $img_path = uploadFile($image, $_SERVER['DOCUMENT_ROOT'] . "/DuAn/public/images/");

            $this->userModel->user_add($email, $phone, $password, $name, $img_path, $status);

            $_SESSION['resultRegister'] = 'success';

            $_SESSION['userId'] = $this->userModel->getIdUser($email, $phone, $status);
        } else {
            $_SESSION['resultRegister'] = 'error';
        }

        header('location: ' . BASE_URL . '/?action=register');
    }

    public function handleUserLogout()
    {
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
            header('location: ' . BASE_URL . '/?action=home');
        }
    }
}
