<main id="main">
    <div class="container">
        <div class="nav infinite-slider">
            <div class="nav-info left-nav">
                <a href="#"><span>SALE all 50% + thêm 10% HĐ từ 2 SP</span></a>
            </div>
            <div class="nav-info center-nav">
                <a href="#"><span>SALE UPTO 75% </span></a>
            </div>
            <div class="nav-info right-nav">
                <a href="#"><span>NEW ARRIVAL + giảm 10% HĐ từ 2 SP</span></a>
            </div>
        </div>

        <section id="banner">
            <div class="wrapper">
                <i class="fa-solid fa-arrow-left-long arrow-left" onClick="prev()"></i>

                <img id="slide-img" src="<?php echo BASE_URL . '/public/images/banner2.jpg'; ?>" alt="" />

                <div id="slide-banner">
                    <img class="slide-img" src="<?php echo BASE_URL . '/public/images/banner2.jpg'; ?>" alt="" />
                    <img class="slide-img" src="<?php echo BASE_URL . '/public/images/banner3.png'; ?>" alt="" />
                    <img class="slide-img" src="<?php echo BASE_URL . '/public/images/banner4.jpg'; ?>" alt="" />
                </div>

                <i class="fa-solid fa-arrow-right-long arrow-right" onClick="next()"></i>

                <div id="list-dot">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </section>

        <section id="product">
            <div class="title-section">NEW ARRIVAL</div>
            <div class="wrap">
                <div class="head">
                    <ul>

                        <?php
                        foreach ($ds as $key => $value) { ?>
                            <?php if (isset($_GET['list'])) { ?>
                                <?php if ($_GET['list'] == $value['id']) { ?>
                                    <li class='tab active'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php   } else { ?>
                                    <li class='tab' onClick='change(<?php echo $value["id"] ?>)'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php } ?>
                            <?php   } else { ?>
                                <?php if ($key == 0) { ?>
                                    <li class='tab active'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php   } else { ?>
                                    <li class='tab' onClick='change(<?php echo $value["id"] ?>)'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        <?php    }
                        ?>
                    </ul>
                </div>

                <div class="content">

                    <?php
                    foreach ($products as $product) { ?>
                        <div class="box">
                            <div class="cart">
                                <?php if (isset($product['phan_tram_giam']) && $product['phan_tram_giam'] > 0) {
                                    echo '- ' . $product['phan_tram_giam'] . '%';
                                } else {
                                    echo 'NEW';
                                } ?>
                            </div>
                            <a class="img-container" href="<?php echo BASE_URL . '/?action=viewDetail&detail=' . $product['san_pham_chi_tiet_id'] ?>">
                                <img class="cart-img" src="<?php echo $product['hinh_anh'] ?>" alt="" />
                                <img class="pseudo-img" src="<?php echo $product['hinh_anh_chi_tiet_1'] ?>" alt="" />
                            </a>

                            <div class="detail">
                                <div class="detail-head">
                                    <div class="list-color">
                                        <div class="color color-c5a782"></div>
                                        <div class="color color-a3784e"></div>
                                        <div class="color color-ec6795 checked"></div>
                                    </div>
                                    <div class="heart">
                                        <span style="font-size: 13px; margin-right: 4px; color: #57585a;"><?php echo $product['so_luot_xem'] ?></span>
                                        <i class="fa-solid fa-eye" style="font-size: 12px; color: #57585a; margin-right: 12px"></i>

                                        <!-- <i class="fa-regular fa-heart"></i> -->
                                    </div>
                                </div>

                                <div class="detail-desp"><?php echo $product['ten_san_pham'] ?></div>

                                <div class="detail-foot">
                                    <div class="price">
                                        <span><?php echo number_format($product['gia_sau_giam'], 0, '', '.'); ?>đ</span>
                                        <?php if (isset($product['phan_tram_giam']) && $product['phan_tram_giam'] !== 0) { ?>
                                            <del><?php echo number_format($product['gia_ban'], 0, '', '.'); ?>đ</del>
                                        <?php   } ?>
                                    </div>
                                    <div class="add-to-cart" onClick="addPro({id: <?php echo $product['san_pham_chi_tiet_id'] ?>, ten_san_pham: '<?php echo $product['ten_san_pham'] ?>', gia_ban: <?php echo $product['gia_ban'] ?>, hinh_anh: '<?php echo $product['hinh_anh'] ?>', phan_tram_giam: <?php echo $product['phan_tram_giam'] ?>})">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php    }
                    ?>

                </div>
                <div class="show-all">
                    <a href="<?php echo '?action=category&list=';
                                if (isset($_GET['list'])) {
                                    echo $_GET['list'];
                                } else {
                                    echo $ds[0]['id'];
                                } ?>" id="more-pro" class="show-text">Xem thêm</a>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
if (isset($_SESSION['cart'])) {
    $cartJson = json_encode($_SESSION['cart']);

    unset($_SESSION['cart']);
} else {
    $cartJson = null;
}
?>

<script>
    let scroll = localStorage.getItem('scroll');

    if (scroll) {
        window.scrollTo(0, scroll);

        localStorage.removeItem('scroll');
    }

    function change(maLoaiHang) {

        let currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;

        localStorage.setItem('scroll', currentScrollPosition);

        window.location.href = '?list=' + maLoaiHang;
    }

    // Lấy dữ liệu từ PHP (JSON)
    const sessionCart = <?php if (isset($cartJson)) {
                            echo $cartJson;
                        } else {
                            echo '[]';
                        }  ?>;

    // Lấy dữ liệu hiện tại trong localStorage
    let localCart = JSON.parse(localStorage.getItem('cart'));

    if (!localCart) {
        // Nếu chưa có giỏ hàng trong localStorage, lưu thẳng từ session
        localStorage.setItem('cart', JSON.stringify(sessionCart));
    } else {
        // Nếu đã có, push thêm dữ liệu từ session vào localStorage
        sessionCart.forEach(product => {
            // Kiểm tra xem sản phẩm đã tồn tại hay chưa
            const existingProduct = localCart.find(item => item.id === product.id);

            if (existingProduct) {
                // Nếu tồn tại, tăng số lượng
                existingProduct.so_luong += product.so_luong;
            } else {
                // Nếu chưa tồn tại, thêm sản phẩm mới
                localCart.push(product);
            }
        });

        // Lưu lại giỏ hàng đã cập nhật vào localStorage
        localStorage.setItem('cart', JSON.stringify(localCart));
    }
</script>