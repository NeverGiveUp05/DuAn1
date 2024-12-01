<style>
    td,
    th {
        align-content: center;
        text-align: center;
    }
</style>

<div class="table-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="font-weight: 600;">Mã hóa đơn</th>
                <th scope="col" style="font-weight: 600;">Khách hàng</th>
                <th scope="col" style="font-weight: 600;">Tổng tiền</th>
                <th scope="col" style="font-weight: 600;">Ngày tạo</th>
                <th scope="col" style="font-weight: 600;">Trạng thái</th>
                <th scope="col" style="font-weight: 600;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data)) { ?>

                <tr>
                    <td colspan="12">Hiện chưa có bản ghi nào</td>
                </tr>

                <?php  } else {
                foreach ($data as $item) {
                ?>
                    <tr>
                        <td><?php echo $item['ma_hoa_don'] ?></td>
                        <td><?php echo $item['ten_khach_hang'] ?></td>
                        <td><?php echo $item['tong_tien'] ?></td>
                        <td><?php echo $item['ngay_tao'] ?></td>
                        <td>
                            <?php echo $item['trang_thai'] ?>
                            <?php if ($item['trang_thai'] !== "Canceled" && $item['trang_thai'] !== "Completed") { ?>

                                <button style="float: right;" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="<?php echo '#exampleModal' . $item['ma_hoa_don'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                            <?php  } ?>
                        </td>
                        <td><a href="<?php echo BASE_URL . '/admin/?action=invoicesDetail&id=' . $item['ma_hoa_don'] ?>">Xem chi tiết</a></td>

                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo 'exampleModal' . $item['ma_hoa_don'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật trạng thái hóa đơn</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="<?php echo 'statusForm' . $item['ma_hoa_don'] ?>" action="<?php echo BASE_URL . '/admin/?action=invoicesUpdateStatus' ?>" method="POST" enctype="application/x-www-form-urlencoded">

                                            <input type="hidden" name="ma_hoa_don" value="<?php echo $item['ma_hoa_don'] ?>">

                                            <label for="<?php echo 'status' . $item['ma_hoa_don'] ?>">Chọn trạng thái:</label>
                                            <select id="<?php echo 'status' . $item['ma_hoa_don'] ?>" name="<?php echo 'status' . $item['ma_hoa_don'] ?>" class="custom-select custom-select-sm">
                                                <option
                                                    <?php if ($item['trang_thai'] == 'Pending') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Pending">Chờ xác nhận
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Confirmed') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Confirmed">Đã xác nhận
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Processing') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Processing">Đang xử lý
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Shipped') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Shipped">Đang vận chuyển
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Delivered') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Delivered">Đã giao
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Canceled') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Canceled">Đã hủy
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Returned') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Returned">Đã trả lại
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Refunded') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Refunded">Đã hoàn tiền
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Pending Payment') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Pending Payment">Chờ thanh toán
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Failed') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Failed">Thanh toán thất bại
                                                </option>

                                                <option
                                                    <?php if ($item['trang_thai'] == 'Completed') {
                                                        echo 'selected';
                                                    } ?>
                                                    value="Completed">Hoàn thành
                                                </option>
                                            </select>
                                            <label style="margin-top: 12px; margin-bottom: 6px" for="note">Ghi chú (Không bắt buộc):</label>
                                            <textarea style="width: 100%;" id="note" name="note"></textarea>

                                            <div id="<?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>" style="display: none; margin-top: 10px;">
                                                <input type="checkbox" id="<?php echo 'confirmation' . $item['ma_hoa_don'] ?>">
                                                <label for="<?php echo 'confirmation' . $item['ma_hoa_don'] ?>">Tôi chắc chắn muốn thực hiện hành động này</label>
                                            </div>

                                            <label style="color: red; display: none" id="<?php echo 'warning' . $item['ma_hoa_don'] ?>">*Bạn chưa xác nhận</label>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="upLoad<?php echo $item['ma_hoa_don'] ?>()" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
            <?php    }
            }  ?>
        </tbody>
    </table>
</div>

<script>
    <?php foreach ($data as $item) { ?>
        const <?php echo 'statusForm' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'statusForm' . $item['ma_hoa_don'] ?>");
        const <?php echo 'statusSelect' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'status' . $item['ma_hoa_don'] ?>");
        const <?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>");
        const <?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'confirmation' . $item['ma_hoa_don'] ?>");
        const <?php echo 'warning' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'warning' . $item['ma_hoa_don'] ?>");
        const <?php echo 'exampleModal' . $item['ma_hoa_don'] ?> = document.getElementById("<?php echo 'exampleModal' . $item['ma_hoa_don'] ?>");

        <?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.addEventListener('change', function() {
            if (<?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Canceled' || <?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Completed') {
                <?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>.style.display = 'block';
            } else {
                <?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>.style.display = 'none';
            }

            <?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?>.checked = false;
        })

        function upLoad<?php echo $item['ma_hoa_don'] ?>() {
            if (<?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Canceled' || <?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Completed') {
                if (<?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?>.checked) {
                    <?php echo 'statusForm' . $item['ma_hoa_don'] ?>.submit();
                } else {
                    <?php echo 'warning' . $item['ma_hoa_don'] ?>.style.display = 'block';
                }
            } else {
                <?php echo 'statusForm' . $item['ma_hoa_don'] ?>.submit();
            }
        }

        <?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?>.addEventListener('change', () => {
            if (<?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?>.checked) {
                <?php echo 'warning' . $item['ma_hoa_don'] ?>.style.display = 'none';
            }
        })

        let <?php echo 'currentStatus' . $item['ma_hoa_don'] ?>

        $('#<?php echo 'exampleModal' . $item['ma_hoa_don'] ?>').on('show.bs.modal', function() {
            <?php echo 'currentStatus' . $item['ma_hoa_don'] ?> = "<?php echo ($item['trang_thai']) ?>";

            if (<?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Canceled' || <?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value == 'Completed') {
                <?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>.style.display = 'block';
            } else {
                <?php echo 'confirmationDiv' . $item['ma_hoa_don'] ?>.style.display = 'none';
            }

            <?php echo 'confirmationCheckBox' . $item['ma_hoa_don'] ?>.checked = false;
        });

        $('#<?php echo 'exampleModal' . $item['ma_hoa_don'] ?>').on('hidden.bs.modal', function() {
            <?php echo 'statusSelect' . $item['ma_hoa_don'] ?>.value = <?php echo 'currentStatus' . $item['ma_hoa_don'] ?>;
        });

    <?php } ?>
</script>