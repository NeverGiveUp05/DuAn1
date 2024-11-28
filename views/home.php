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
                                <?php if ($_GET['list'] == $value['ma_loai_hang']) { ?>
                                    <li class='tab active' onClick='change(<?php echo $value["ma_loai_hang"] ?>)'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php   } else { ?>
                                    <li class='tab' onClick='change(<?php echo $value["ma_loai_hang"] ?>)'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php } ?>
                            <?php   } else { ?>
                                <?php if ($key == 0) { ?>
                                    <li class='tab active' onClick='change(<?php echo $value["ma_loai_hang"] ?>)'>
                                        <?php echo $value['ten_loai_hang'] ?>
                                    </li>
                                <?php   } else { ?>
                                    <li class='tab' onClick='change(<?php echo $value["ma_loai_hang"] ?>)'>
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
                            <div class="cart">NEW</div>
                            <a class="img-container" href="<?php echo BASE_URL . '/?action=viewDetail&detail=' . $product['ma_hang_hoa'] ?>">
                                <img class="cart-img" src="<?php echo $product['hinh_anh'] ?>" alt="" />
                                <img class="pseudo-img" src="<?php echo $product['hinh_anh_nen'] ?>" alt="" />
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
                                    </div>
                                </div>

                                <div class="detail-desp"><?php echo $product['ten_hang_hoa'] ?></div>

                                <div class="detail-foot">
                                    <div class="price">
                                        <span><?php if (isset($product['muc_giam_gia'])) {
                                                    $cost = $product['don_gia'] * (100 - $product['muc_giam_gia']) / 100;
                                                } else {
                                                    $cost = $product['don_gia'];
                                                }

                                                $formattedCost = number_format($cost, max(3 - strlen(substr(strrchr($cost, "."), 1)), 0), ",", ".");

                                                if (strpos($formattedCost, ",000")) {
                                                    echo number_format($cost, 0, ",", ".");
                                                } else {
                                                    echo $formattedCost;
                                                }
                                                ?>đ</span>
                                        <?php if (isset($product['muc_giam_gia'])) { ?>
                                            <del><?php echo number_format($product['don_gia'], 0, '', '.'); ?>đ</del>
                                        <?php   } ?>
                                    </div>
                                    <div class="add-to-cart" onClick="addPro({name: '<?php echo $product['ten_hang_hoa'] ?>', price: <?php echo $cost ?>, img:'<?php echo $product['hinh_anh'] ?>'})">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php    }
                    ?>

                </div>
                <div class="show-all">
                    <div id="more-pro" class="show-text">Xem thêm</div>
                </div>
            </div>
        </section>
    </div>
    <div class="shopping" id="shopping">
        <div class="top-shop">
            <h3>Giỏ hàng<span class="number-cart">0</span></h3>
        </div>
        <div class="main-shop" id="main-shop"></div>
        <div class="bottom-shop">
            <div class="total-price">Tổng cộng: <strong id="total">0đ</strong></div>
            <div class="box-action">
                <div class="box-title">Thanh toán</div>
            </div>
        </div>
        <div class="close-shop" id="close" onClick="closeShop()"><i class="fa-solid fa-xmark"></i></div>
    </div>
</main>

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
</script>