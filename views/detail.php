<?php

if (isset($_POST['submit'])) {
    // comment_add($_POST['comment'], date("Y-m-d"), $_GET['detail'], $_SESSION['userId']);
}
?>

<?php

function format_number($number)
{
    $number_str = (string) $number;

    $length = strlen($number_str);

    if ($length < 7) {
        $formatted_number = str_pad($number_str, 7, '0', STR_PAD_LEFT);
    } else {
        $formatted_number = $number_str;
    }

    return $formatted_number;
}

$currentImg = $detailProduct['hinh_anh'];
?>

<main id="main">
    <section class="container">
        <div class="product-detail">
            <div class="pro-left">
                <div class="pro-left_top">
                    <div class="wrap">
                        <img id="image" src="<?php echo $detailProduct['hinh_anh'] ?>" alt="" class="main-img" onMouseOver="handleAddPosition()" />
                        <div id="pseudoImg" class="pseudo"></div>
                    </div>

                    <div class="slide-show">
                        <div class="prev" onClick="prev()">
                            <i class="fa-solid fa-angle-up"></i>
                        </div>
                        <div class="wrapper-image">
                            <img src="<?php echo $detailProduct['hinh_anh'] ?>" alt="" class="slide-img" onClick="setCurrentImg('<?php echo $detailProduct['hinh_anh'] ?>')" />
                            <img src="<?php echo $detailProduct['hinh_anh_chi_tiet_1'] ?>" alt="" class="slide-img" onClick="setCurrentImg('<?php echo $detailProduct['hinh_anh_chi_tiet_1'] ?>')" />
                            <img src="<?php echo $detailProduct['hinh_anh_chi_tiet_2'] ?>" alt="" class="slide-img" onClick="setCurrentImg('<?php echo $detailProduct['hinh_anh_chi_tiet_2'] ?>')" />
                            <img src="<?php echo $detailProduct['hinh_anh_chi_tiet_3'] ?>" alt="" class="slide-img" onClick="setCurrentImg('<?php echo $detailProduct['hinh_anh_chi_tiet_3'] ?>')" />
                        </div>
                        <div class="next" onClick="next()">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['userId'])) {
                    $id = $_SESSION['userId'];

                    // $usercurrent = user_selectById($id);
                }
                ?>

                <div class="pro-left_bottom">
                    <div class="tb-comment_top">
                        <p class="tb-title">Bình luận</p>
                    </div>

                    <div class="tb-comment_content">
                        <ul>
                            <?php
                            // $comments = comment_getAllByLoaiHang($_GET['detail']);

                            if (!empty($comments)) {
                                foreach ($comments as $comment) { ?>
                                    <li>
                                        <p class="text-comment"><?php echo $comment['noi_dung'] ?></p>
                                        <div class="info">
                                            <span class="info-name"><?php
                                                                    //  echo user_selectById($comment['ma_khach_hang'])['ho_ten'] 
                                                                    ?></span>
                                            <span class="info-time"><?php echo $comment['ngay_dang'] ?></span>
                                        </div>
                                    </li>
                                <?php }
                            } else { ?>
                                <li>Chưa có bình luận nào</li>
                            <?php  } ?>
                        </ul>
                    </div>

                    <div class="tb-comment_bottom">
                        <?php if (isset($_SESSION['userId'])) { ?>
                            <form id="comment-form" action="" method="POST">
                                <input autocomplete="off" type="text" name="comment" id="commentInput">
                                <button id="commentBtn" type="submit" name="submit">Gửi</button>
                            </form>
                        <?php } else { ?>
                            <p>Bạn cần đăng nhập để bình luận</p>
                        <?php   } ?>
                    </div>
                </div>
            </div>

            <div class="wrapper">
                <h1 class="prod-name"><?php echo $detailProduct['ten_san_pham'] ?></h1>

                <div class="sub-info">
                    <p>SKU: <span><?php echo format_number($detailProduct['id']) ?></span></p>

                    <div class="star_dis-flex">
                        <div class="rating">
                            <span class="star">
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span class="star">
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span class="star">
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span class="star">
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span class="star">
                                <i class="fa-regular fa-star"></i>
                            </span>
                        </div>

                        <span class="evaluate">(0 đánh giá)</span>
                    </div>
                </div>

                <div class="price">
                    <b><?php
                        if (isset($detailProduct['phan_tram_giam']) && $detailProduct['phan_tram_giam'] > 0) {
                            $cost = $detailProduct['gia_ban'] * (100 - $detailProduct['phan_tram_giam']) / 100;
                        } else {
                            $cost = $detailProduct['gia_ban'];
                        }
                        echo number_format($cost, 0, '', '.'); ?>đ</b>
                    <?php if (isset($detailProduct['phan_tram_giam']) && $detailProduct['phan_tram_giam'] > 0) { ?>
                        <del><?php echo number_format($detailProduct['gia_ban'], 0, '', '.'); ?>đ</del>
                        <div class="price-sale"><?php echo $detailProduct['phan_tram_giam'] ?><span>%</span></div>
                    <?php   } ?>
                </div>

                <div class="color">
                    <p>Màu sắc: Họa tiết Hồng nhạt</p>
                    <div class="wrap-color">
                        <div class="color-df8230"></div>
                        <div class="color-d2a0ad checked"></div>
                    </div>
                </div>

                <div class="size">
                    <div class="info-size">S</div>
                    <div class="info-size">M</div>
                    <div class="info-size">L</div>
                    <div class="info-size">XL</div>
                    <div class="info-size">XXL</div>
                </div>

                <div class="check-size">
                    <i class="fa-solid fa-ruler"></i>
                    &nbsp;
                    <span> Kiểm tra size của bạn</span>
                </div>

                <div class="quantity">
                    <p>Số lượng</p>
                    <div class="quantity-option">
                        <input id="inputBox" class="quantity-input" type="number" value="1" name="quantity" />
                        <div class="quantity-increase" onClick="increaseValue()">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="quantity-decrease" onClick="decreaseValue()">
                            <i class="fa-solid fa-minus"></i>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-add" onClick="addProPass({id: <?php echo $detailProduct['id'] ?>,ten_san_pham: '<?php echo $detailProduct['ten_san_pham'] ?>', gia_ban: <?php echo $detailProduct['gia_ban'] ?>, hinh_anh: '<?php echo $detailProduct['hinh_anh'] ?>', discount: <?php echo $detailProduct['phan_tram_giam'] ?>})">Thêm vào giỏ</button>
                    <button class="btn-buy">Mua hàng</button>
                </div>

                <div class="detail-tab">
                    <div class="tab-header">
                        <div class="tab-item active">
                            <span>GIỚI THIỆU</span>
                        </div>
                        <div class="tab-item">
                            <span>CHI TIẾT SẢN PHẨM</span>
                        </div>
                        <div class="tab-item">
                            <span>BẢO QUẢN</span>
                        </div>
                    </div>
                    <div class="tab-body">
                        <div id="content" class="tab-content active">
                            <p>
                                <?php echo $detailProduct['mo_ta'] ?>
                            </p>

                            <p>
                                Chất liệu tơ voan mềm mại tạo cảm giác dễ chịu khi tiếp xúc với da cũng như giúp
                                bạn luôn cảm thấy thoải mái và mát mẻ trong suốt cả ngày dài.
                            </p>

                            <p>
                                Đầm có họa tiết hoa bắt mắt, có thể đi kèm với các phụ kiện như khuyên tai và
                                một đôi giày cao gót, hoặc có thể được kết hợp với một chiếc mũ vành rộng cùng
                                đôi sandal để tạo ra một vẻ ngoài năng lượng và phong cách.
                            </p>

                            <p>
                                <strong>Thông tin mẫu:</strong>
                            </p>

                            <p><strong>Chiều cao: </strong>167 cm</p>

                            <p><strong>Cân nặng: </strong>50 kg</p>

                            <p><strong>Số đo 3 vòng: </strong>83-65-93 cm</p>

                            <p>Mẫu mặc size M</p>

                            <p>
                                Lưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện
                                ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.
                            </p>
                        </div>
                        <div class="tab-content">
                            <table class="" width="70%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>Dòng sản phẩm</b>
                                        </td>
                                        <td>Ladies</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Nhóm sản phẩm</b>
                                        </td>
                                        <td>Đầm</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Cổ áo</b>
                                        </td>
                                        <td>Cổ thuyền</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Tay áo</b>
                                        </td>
                                        <td>Tay liền</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Kiểu dáng</b>
                                        </td>
                                        <td>Chữ A</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Độ dài</b>
                                        </td>
                                        <td>Qua gối</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Họa tiết</b>
                                        </td>
                                        <td>Hoa</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Chất liệu</b>
                                        </td>
                                        <td>Voan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-content">
                            <p>Chi tiết bảo quản sản phẩm :</p>

                            <p>
                                <strong>
                                    * Các sản phẩm thuộc dòng cao cấp (Senora) và áo khoác (dạ, tweed, lông,
                                    phao) chỉ giặt khô, tuyệt đối không giặt ướt.
                                </strong>
                            </p>

                            <p>* Vải dệt kim: sau khi giặt sản phẩm phải được phơi ngang tránh bai giãn.</p>

                            <p>* Vải voan, lụa, chiffon nên giặt bằng tay.</p>

                            <p>
                                * Vải thô, tuytsi, kaki không có phối hay trang trí đá cườm thì có thể giặt máy.
                            </p>

                            <p>
                                * Vải thô, tuytsi, kaki có phối màu tương phản hay trang trí voan, lụa, đá cườm
                                thì cần giặt tay.
                            </p>

                            <p>
                                * Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm phai màu jeans. Nếu giặt thì
                                nên lộn trái sản phẩm khi giặt, đóng khuy, kéo khóa, không nên giặt chung cùng
                                đồ sáng màu, tránh dính màu vào các sản phẩm khác.
                            </p>

                            <p>
                                * Các sản phẩm cần được giặt ngay không ngâm tránh bị loang màu, phân biệt màu
                                và loại vải để tránh trường hợp vải phai. Không nên giặt sản phẩm với xà phòng
                                có chất tẩy mạnh, nên giặt cùng xà phòng pha loãng.
                            </p>

                            <p>
                                * Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế độ giặt nhẹ, vắt mức
                                trung bình và nên phân các loại sản phẩm cùng màu và cùng loại vải khi giặt.
                            </p>

                            <p>
                                * Nên phơi sản phẩm tại chỗ thoáng mát, tránh ánh nắng trực tiếp sẽ dễ bị phai
                                bạc màu, nên làm khô quần áo bằng cách phơi ở những điểm gió sẽ giữ màu vải tốt
                                hơn.
                            </p>

                            <p>
                                * Những chất vải 100% cotton, không nên phơi sản phẩm bằng mắc áo mà nên vắt
                                ngang sản phẩm lên dây phơi để tránh tình trạng rạn vải.
                            </p>

                            <p>
                                * Khi ủi sản phẩm bằng bàn là và sử dụng chế độ hơi nước sẽ làm cho sản phẩm dễ
                                ủi phẳng, mát và không bị cháy, giữ màu sản phẩm được đẹp và bền lâu hơn. Nhiệt
                                độ của bàn là tùy theo từng loại vải.
                            </p>
                        </div>
                        <div class="show-more">
                            <div id="btn-more" class="circle-caret">
                                <i id="angle-down" class="fa-solid fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    const image = document.getElementById("image");
    const pseudoImg = document.getElementById("pseudoImg");
    let currentImage = "<?php echo $currentImg ?>";
    const content = document.getElementById("content");
    const btnMore = document.getElementById("btn-more");
    const angleDown = document.getElementById("angle-down");

    let heightImg = image.height;
    pseudoImg.style.height = heightImg + "px";

    pseudoImg.addEventListener("mousemove", (e) => {
        handlePosition(e);
    });

    pseudoImg.addEventListener("mouseleave", (e) => {
        handleRemovePosition();
    });

    const handlePosition = (e) => {
        const percentX = (e.offsetX / image.clientWidth) * 100;
        const percentY = (e.offsetY / image.clientHeight) * 100;

        pseudoImg.style.backgroundPosition = `${percentX}% ${percentY}%`;
    };

    const handleAddPosition = () => {
        pseudoImg.classList.add("active");
        pseudoImg.style.backgroundImage = `url(${currentImage})`;
    };

    const handleRemovePosition = () => {
        pseudoImg.classList.remove("active");
    };

    const setCurrentImg = (img) => {
        image.src = img;
        currentImage = img;
        heightImg = image.height;
        pseudoImg.style.height = heightImg + "px";
    }

    // btnMore.addEventListener('click', function() {
    //     content.classList.toggle('heightauto');
    //     angleDown.classList.toggle('d-none');
    //     angleUp.classList.toggle('d-none');
    // })

    // shop
    const inputBox = document.getElementById('inputBox');

    const addProPass = (item) => {
        let so_luong = Number(inputBox.value);

        if (so_luong > 99 || so_luong <= 0) {
            Swal.fire({
                title: "Error!",
                text: "Số lượng không hợp lệ",
                icon: "error",
                confirmButtonText: "Xác nhận",
            });
        } else {
            addPro(item, so_luong);
        }

        inputBox.value = 1;
    }

    const increaseValue = () => {
        if (Number(inputBox.value) > 99) {
            Swal.fire({
                title: "Error!",
                text: "Vượt quá số lượng",
                icon: "error",
                confirmButtonText: "Xác nhận",
            });
        } else {
            inputBox.value = Number(inputBox.value) + 1;
        }
    }

    const decreaseValue = () => {
        if (Number(inputBox.value) > 1) {
            inputBox.value = Number(inputBox.value) - 1;
        }
    }

    // show more information product
    btnMore.addEventListener('click', function() {

        angleDown.classList.toggle('rotate');

        if (angleDown.classList.contains('rotate')) {

            content.style.height = 'auto';

            let height = content.offsetHeight;

            content.style.height = '5em';

            setTimeout(() => {
                content.style.height = height + 'px';
            }, 0)

        } else {

            content.style.height = '5em';

        }
    })
</script>