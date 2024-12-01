<?php
if (isset($_SESSION['hang_delete']) && $_SESSION['hang_delete'] == 'success') { ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Xóa thành công',
            icon: 'success',
            confirmButtonText: 'Xác nhận',
        })
    </script>
<?php
    $_SESSION['hang_delete'] = null;
}; ?>

<?php
if (isset($_SESSION['update_hang']) && $_SESSION['update_hang'] == 'success') { ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Cập nhật dữ liệu thành công',
            icon: 'success',
            confirmButtonText: 'Xác nhận',
        })
    </script>

<?php
    $_SESSION['update_hang'] = null;
} ?>

<?php
if (isset($_SESSION['hang_multiDelete']) && $_SESSION['hang_multiDelete'] == 'success') { ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Xóa bản ghi thành công',
            icon: 'success',
            confirmButtonText: 'Xác nhận',
        })
    </script>

<?php
    $_SESSION['hang_multiDelete'] = null;
} ?>

<select style="width: 250px;" class="form-select mb-3 ms-auto" aria-label="Default select example" id="selectBtn">
    <?php
    $select = $_GET['select'] ? $_GET['select'] : null;
    ?>

    <option value="all" <?php if (isset($select)) {
                            if ($select == 'all') {
                                echo 'selected';
                            } else {
                                echo '';
                            }
                        } else {
                            echo 'selected';
                        } ?>>Lọc theo loại hàng</option>

    <?php
    foreach ($types as $type) { ?>
        <option <?php if ($select == $type['id']) {
                    echo 'selected';
                } ?> value="<?php echo $type['id'] ?>">
            <?php echo $type['ten_loai_hang'] ?>
        </option>
    <?php    } ?>
</select>

<style>
    td,
    th {
        align-content: center;
        text-align: center;
    }
</style>

<div class="table-container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="font-weight: 600;"></th>
                <th scope="col" style="font-weight: 600;">Tên hàng hóa</th>
                <th scope="col" style="font-weight: 600;">Loại hàng</th>
                <th scope="col" style="font-weight: 600;">Đơn giá</th>
                <th scope="col" style="font-weight: 600;">Giảm giá</th>
                <th scope="col" style="font-weight: 600;">Mô tả</th>
                <th scope="col" style="font-weight: 600;">Hình ảnh</th>
                <th scope="col" style="font-weight: 600;"></th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (empty($list)) { ?>

                <tr>
                    <td colspan="12">Hiện chưa có bản ghi nào</td>
                </tr>

                <?php  } else {
                foreach ($list as $item) { ?>
                    <tr>
                        <td style="width: 50px;"><input style="cursor: pointer" type="checkbox" name="" id="" class="checkbox" value="<?php echo $item['id'] ?>"></td>
                        <td style="max-width: 263px; min-width: 263px">
                            <p style=" word-wrap: break-word; overflow-wrap: break-word; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box; margin-bottom: 0"><?php echo $item['ten_san_pham'] ?></p>
                        </td>
                        <td style="min-width: 100px;">
                            <?php
                            foreach ($categories as $category) {
                                if ($category['id'] == $item['loai_hang_id']) {
                                    echo $category['ten_loai_hang'];
                                }
                            }
                            ?>
                        </td>
                        <td><?php
                            $money = number_format($item['gia_ban'], 0, '', '.');
                            echo $money;
                            ?></td>
                        <td style="width: 100px; min-width: 92px"><?php if (isset($item['muc_giam_gia'])) {
                                                                        echo $item['muc_giam_gia'] . '%';
                                                                    } ?></td>
                        <td style="max-width: 450px; min-width: 300px">
                            <p style="word-wrap: break-word; overflow-wrap: break-word; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box; margin-bottom: 0"> <?php echo $item['mo_ta'] ?></p>
                        </td>
                        <td><img style="margin: 0 18px; object-fit: cover" width="50" height="75" src="<?php echo $item['hinh_anh'] ?>" alt=""></td>
                        <td>
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <a class="btn btn-warning btn-sm" style="color: #000" href="?edit&id=<?php echo $item['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger btn-sm" style="color: #fff" href="?delete&id=<?php echo $item['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </td>
                    </tr>
            <?php    }
            }

            ?>
        </tbody>
    </table>
</div>

<button id="btn-select" class="btn btn-outline-primary btn-sm mb-3 ms-2">Chọn tất cả</button>
<button id="btn-unselect" class="btn btn-outline-primary btn-sm mb-3 ms-2">Bỏ chọn tất cả</button>
<button id="deleteBtn" class="btn btn-outline-danger btn-sm mb-3 ms-2">Xoá các mục đã chọn</button>
<a href="./" class="btn btn-primary btn-sm mb-3 ms-2">Nhập thêm</a>

<script>
    const allBtnCheck = document.querySelectorAll('.checkbox');
    const btnSelectAll = document.getElementById('btn-select');
    const btnUnSelectAll = document.getElementById('btn-unselect');
    const deleteBtn = document.getElementById('deleteBtn');
    const selectBtn = document.getElementById('selectBtn');
    let ids = [];

    allBtnCheck.forEach(item => {
        item.addEventListener('click', function() {
            if (item.checked) {
                ids.push(item.value);
            } else {
                let index = ids.indexOf(item.value);
                ids.splice(index, 1);
            }
        })
    })

    btnSelectAll.addEventListener('click', function() {
        allBtnCheck.forEach(item => {
            item.checked = true;
            ids.push(item.value);
        });

        ids = [...new Set(ids)];
    })

    btnUnSelectAll.addEventListener('click', function() {
        allBtnCheck.forEach(item => {
            item.checked = false;
        });

        while (ids.length > 0) {
            ids.pop();
        }
    })

    deleteBtn.addEventListener('click', function() {
        if (ids.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Không có loại hàng nào được chọn',
                icon: 'error',
                confirmButtonText: 'Xác nhận',
            })
        } else {
            let selectedIds = ids.join(',');
            window.location.href = `./multiDelete.php?ids=${selectedIds}`;
        }
    })

    selectBtn.addEventListener('change', function() {
        window.location.href = `?btn_list&select=${this.value}`;
    })
</script>