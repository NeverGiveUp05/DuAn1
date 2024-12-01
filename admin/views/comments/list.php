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
                <th scope="col" style="font-weight: 600;">MÃ SẢN PHẨM</th>
                <th scope="col" style="font-weight: 600;">TÊN SẢN PHẨM</th>
                <th scope="col" style="font-weight: 600;">SỐ BÌNH LUẬN</th>
                <th scope="col" style="font-weight: 600;">MỚI NHẤT</th>
                <th scope="col" style="font-weight: 600;">CŨ NHẤT</th>
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
                foreach ($data as $item) { ?>
                    <tr>
                        <td><?php echo $item['idProduct'] ?></td>
                        <td style="width: 565px; max-width: 565px; min-width: 320px">
                            <p style="word-wrap: break-word; overflow-wrap: break-word; overflow: hidden; -webkit-line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box; margin-bottom: 0"><?php echo $item['nameProduct'] ?></p>
                        </td>
                        <td style="min-width: 140px;">
                            <?php echo $item['count']; ?>
                        </td>
                        <td style="min-width: 130px;"><?php echo $item['newCommentAt']; ?></td>

                        <td style="min-width: 130px;"><?php echo $item['oldCommentAt']; ?></td>

                        <td><a style="min-width: 70px;" class="btn btn-outline-primary btn-sm" href="?action=commentsDetail&id=<?php echo $item['idProduct'] ?>">Chi tiết</a></td>
                    </tr>
            <?php }
            } ?>

        </tbody>
    </table>
</div>