<?php
require_once BASE_PATH . '/admin/models/CommentsModel.php';

class CommentsController
{
    public $commentsModel;

    public function __construct()
    {
        $this->commentsModel = new CommentsModel();
    }

    public function showCommentsList()
    {
        $view = BASE_PATH . '/admin/views/comments/list.php';

        $breadcrumb = 'Comments';

        $list = $this->commentsModel->hang_selectAll();

        foreach ($list as $item) {
            $data[] = [
                'idProduct' => $item['id'],
                'nameProduct' => $item['ten_san_pham'],
                'count' => count($this->commentsModel->comment_getAllByLoaiHang($item['id'])),
                'newCommentAt' => $this->commentsModel->comment_newCommentAt($item['id']),
                'oldCommentAt' => $this->commentsModel->comment_oldCommentAt($item['id']),
            ];
        };

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }

    public function showCommentsDetail()
    {
        $view = BASE_PATH . '/admin/views/comments/detail.php';

        $breadcrumb = 'Comments / Details';

        $nameProduct = $this->commentsModel->getNameProductById($_GET['id']);

        $list = $this->commentsModel->comment_getAllByLoaiHang($_GET['id']);

        foreach ($list as $item) {
            $data[] = [
                'idComment' => $item['id'],
                'content' => $item['noi_dung'],
                'createAt' => $item['ngay_binh_luan'],
                'nameUser' => $this->commentsModel->getNameUserById($item['nguoi_dung_id']),
                'status' => $item['trang_thai']
            ];
        };

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
