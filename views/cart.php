<link rel="stylesheet" href="<?php echo BASE_URL . '/public/css/category6.css' ?>" />
<link rel="stylesheet" href="<?php echo BASE_URL . '/public/css/category13.css' ?>" />
<link rel="stylesheet" href="<?php echo BASE_URL . '/public/css/category17.css' ?>" />
<link rel="stylesheet" href="<?php echo BASE_URL . '/public/css/category35.css' ?>" />



<!-- <link rel="stylesheet" href="../content/css/category.css"> -->

<main id="main" class="site-main">
    <div class="container">
        <form name="frm_cart" id="frm_cart" method="post" action="" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="is_cart_page" value="1">
            <div class="cart pt-40 cart-page">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-process-bar block-border">
                            <ul>
                                <li class="active"><span>Giỏ hàng </span></li>
                                <li class=""><span>Đặt hàng</span></li>
                                <li class=""><span>Thanh toán</span></li>
                                <li><span>Hoàn thành đơn</span></li>
                            </ul>
                            <p class="checkout-process-bar__title">Giỏ hàng</p>
                        </div>
                        <div id="box_product_total_cart">
                            <div class="cart__list">
                                <h2 class="cart-title">Giỏ hàng của bạn <b><span class="cart-total"> 0 </span> Sản Phẩm</b></h2>
                                <table class="cart__table">
                                    <thead>
                                        <tr>
                                            <th>Tên Sản phẩm</th>
                                            <th>Chiết khấu</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <div class="cart__list--attach">
                            </div>
                        </div>
                        <a href="javascript: window.history.back();" class="btn btn--large btn--outline btn-cart-continue mb-3">
                            <span class="icon-ic_left-arrow"></span>
                            Tiếp tục mua hàng
                        </a>
                    </div>
                    <div class="col-lg-4 cart-page__col-summary">
                        <div class="cart-summary" id="cart-page-summary">
                            <div class="cart-summary__overview">
                                <h3>Tổng tiền giỏ hàng</h3>
                                <div class="cart-summary__overview__item">
                                    <p>Tổng sản phẩm</p>
                                    <p class="total-product"> </p>
                                </div>
                                <div class="cart-summary__overview__item">
                                    <p>Tổng tiền hàng</p>
                                    <p class="total-not-discount"> </p>
                                </div>
                                <div class="cart-summary__overview__item">
                                    <p>Thành tiền</p>
                                    <p>
                                        <b class="order-price-total"> </b>
                                    </p>
                                </div>
                                <div class="cart-summary__overview__item">
                                    <p>Tạm tính</p>
                                    <p>
                                        <b class="order-price-total"> </b>
                                    </p>
                                </div>
                            </div>
                            <div class="cart-summary__note">
                                <div class="inner-note d-flex">
                                    <div class="left-inner-note">
                                        <span class="icon-ic_alert"></span>
                                    </div>
                                    <div class="content-inner-note">
                                        <!-- Sản phẩm nằm trong chương trình đồng giá, giảm giá trên 50% không hỗ trợ đổi trả -->
                                    </div>
                                    <div class="left-inner-note left-inner-note-shipping d-none">
                                        <span class="icon-ic_alert"></span>
                                    </div>
                                    <div class="content-inner-note content-inner-note-shipping d-none">
                                        <!-- <p>Miễn phí ship đơn hàng có tổng gía trị trên 2.000.000đ</p> -->
                                        <div class="sub-note"> <strong> </strong> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-summary__button">
                            <a href="/" class="btn btn--large" id="purchase-step-1">Đặt hàng</a>
                        </div>
                        <div class="cart-summary__vouchers">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            fbq("track", "AddToCart", {
                contents: [{
                    "id": "6740M89170490023",
                    "quantity": 1,
                    "item_price": "1743000"
                }],
                content_name: "product_name",
                content_ids: ["6740M89170490023"],
                content_type: "product",
                currency: "VND",
                value: 1743000,
                num_items: 1
            });
        </script>

    </div>
</main>