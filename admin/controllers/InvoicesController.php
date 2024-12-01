<?php
require_once BASE_PATH . '/admin/models/InvoicesModel.php';

class InvoicesController
{
    public $invoicesModel;

    public function __construct()
    {
        $this->invoicesModel = new InvoicesModel();
    }

    public function showInvoicesPage()
    {
        $view = BASE_PATH . '/admin/views/invoices/list.php';

        $breadcrumb = 'Invoices';

        $list = $this->invoicesModel->invoices_getAll();

        if (isset($list)) {
            foreach ($list as $item) {
                $data[] = [
                    'ma_hoa_don' => $item['id'],
                    'ten_khach_hang' => $this->invoicesModel->user_getName($item['nguoi_dung_id']),
                    'tong_tien' => $item['tong_tien'],
                    'ngay_tao' => $item['ngay_tao'],
                    'trang_thai' => $this->invoicesModel->invoices_getStatus($item['id'])
                ];
            }
        }

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }

    public function handleUpdateInvoices()
    {
        $hoa_don_id = $_POST['ma_hoa_don'];
        $trang_thai = $_POST['status' . $_POST['ma_hoa_don']];

        if ($trang_thai == 'Completed') {
            $result = $this->invoicesModel->invoices_check($hoa_don_id);

            if ($result == 0) {
                $this->invoicesModel->invoices_updateDoanhThu($hoa_don_id);
            }
        }

        if ($_POST['note'] == '') {
            $ghi_chu = null;
        } else {
            $ghi_chu = $_POST['note'];
        }
        $thoi_gian = date("Y-m-d H:i:s");
        $nguoi_sua_id = $_SESSION['userId'];

        $this->invoicesModel->invoices_upDate($hoa_don_id, $trang_thai, $ghi_chu, $thoi_gian, $nguoi_sua_id);

        header('location: ' . BASE_URL . '/admin/?action=invoices');
    }

    public function showInvoicesDetailPage()
    {
        $view = BASE_PATH . '/admin/views/invoices/detail.php';

        $breadcrumb = 'Invoices';

        require_once BASE_PATH . '/admin/views/layoutAdmin.php';
    }
}
