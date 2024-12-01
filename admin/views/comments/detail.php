<?php
if (isset($_SESSION['comment_delete']) && $_SESSION['comment_delete'] == 'success') { ?>
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
    $_SESSION['comment_delete'] = null;
}; ?>

<?php
if (isset($_GET['id'])) {
    $_SESSION['current-pro'] = $_GET['id']; ?>

    <h3 style="font-size: 22px; font-weight: 500; color: #000000cc; margin: 12px 0 10px; border: 1px solid #ccc; padding: 12px;">Hàng hóa: <?php echo ($nameProduct); ?></h3>
<?php  } ?>

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
                <th scope="col" style="font-weight: 600;"></th>
                <th scope="col" style="font-weight: 600;">NỘI DUNG</th>
                <th scope="col" style="font-weight: 600;">NGÀY BÌNH LUẬN</th>
                <th scope="col" style="font-weight: 600;">NGƯỜI BÌNH LUẬN</th>
                <th scope="col" style="font-weight: 600;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $item) { ?>
                    <tr>
                        <th><input style="cursor: pointer;" type="checkbox" name="" id="" class="checkbox" value="<?php echo $item['idComment'] ?>"></th>
                        <td style="width: 500px; max-width: 500px; min-width: 200px">
                            <p style="word-wrap: break-word; overflow-wrap: break-word; overflow: hidden; -webkit-line-clamp: 3; -webkit-box-orient: vertical; display: -webkit-box; margin-bottom: 0"><?php echo $item['content'] ?></p>
                        </td>
                        <td style="min-width: 162px;"><?php echo $item['createAt'] ?></td>
                        <td style="min-width: 195px;"><?php echo $item['nameUser'] ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm" style="color: #fff" href="?delete&id=<?php echo $item['idComment'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php    }
            } else { ?>
                <td colspan="5">Hiện chưa có bình luận nào</td>
            <?php  } ?>
        </tbody>
    </table>
</div>

<button id="btn-select" class="btn btn-outline-primary btn-sm mb-3 ms-2">Chọn tất cả</button>
<button id="btn-unselect" class="btn btn-outline-primary btn-sm mb-3 ms-2">Bỏ chọn tất cả</button>
<button id="deleteBtn" class="btn btn-outline-danger btn-sm mb-3 ms-2">Xoá các mục đã chọn</button>
<a class="btn btn-primary btn-sm mb-3 ms-2" href="./">Quay lại</a>

<script>
    const allBtnCheck = document.querySelectorAll('.checkbox');
    const btnSelectAll = document.getElementById('btn-select');
    const btnUnSelectAll = document.getElementById('btn-unselect');
    const deleteBtn = document.getElementById('deleteBtn');
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
</script>