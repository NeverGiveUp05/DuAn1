<main id="main">
    <section class="container">
        <div class="cart-page">
            <div class="col-lg-8 left-info">
                <div class="checkout-process-bar">
                    <ul>
                        <li class="active"><span>Giỏ hàng </span></li>
                        <li class=""><span>Đặt hàng</span></li>
                        <li class=""><span>Thanh toán</span></li>
                        <li><span>Hoàn thành đơn</span></li>
                    </ul>
                </div>

                <div class="cart-list">
                    <h2 class="cart-title">Giỏ hàng của bạn <b><span id="cart-total" class="cart-total"></span> Sản Phẩm</b></h2>

                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Tên Sản phẩm</th>
                                <th>Chiết khấu</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="table-body">
                            <!-- đang dùng js localStorage, phải dùng MVC lấy dữ liệu từ giỏ hàng -->
                        </tbody>
                    </table>
                </div>

                <a href="javascript: window.history.back();" class="btn-cart-continue">
                    <i style="margin-right: 8px" class="fa-solid fa-arrow-left"></i>
                    Tiếp tục mua hàng
                </a>
            </div>

            <div class="col-lg-4 right-info">
                <div id="statistic" class="cart-summary">
                    <!-- đang dùng js localStorage, phải dùng MVC lấy dữ liệu từ giỏ hàng -->
                </div>

                <a href="<?php echo BASE_URL . '?action=checkout' ?>" class="cart-summary-button">Đặt hàng</a>
            </div>
        </div>
    </section>
</main>

<script>
    const data = localStorage.getItem('cart');
    const cart = JSON.parse(data);

    const tBody = document.getElementById('table-body');

    cart.forEach((item) => {
        let discount = item.gia_ban * item.phan_tram_giam / 100;
        let cost = item.gia_ban * (1 - item.phan_tram_giam / 100);
        let total = cost * item.so_luong;

        tBody.innerHTML += `
            <tr>
                                <td>
                                    <div class="cart-product">
                                        <div class="product-img">
                                            <a href="#">
                                                <img src="${item.hinh_anh}" alt="">
                                            </a>
                                        </div>

                                        <div class="product-info">
                                            <a href="#">
                                                <h3 class="product-name">
                                                    ${item.ten_san_pham}
                                                </h3>
                                            </a>
                                            <div class="product-properties">
                                                <p>Màu sắc: <span>Đỏ mận</span></p>
                                                <p>Size: <span style="text-transform: uppercase">xxl</span></p>
                                            </div>

                                            <div class="product-properties">
                                                <p>Giá gốc: <span>${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(item.gia_ban)}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-sale-price">
                                    
                                    <p class="cart-sale_item">
                                        ( ${item.phan_tram_giam}% )
                                    </p>
                                </td>
                                <td>
                                    <div class="product_quantity-input">
                                        <input type="number" value="${item.so_luong}" min="0">
                                        <div class="product_quantity-increase">
                                            +
                                        </div>
                                        <div class="product_quantity-decrease">
                                            -
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="product-price">${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(total)}</div>
                                </td>
                                <td>
                                    <a href="#" class="button-delete">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
        `;
    });

    // statistic
    const statistic = document.getElementById('statistic');

    let tongSanPham = 0;
    let tongCu = 0;
    let tongMoi = 0;

    cart.forEach((item) => {
        tongSanPham += Number(item.so_luong);

        tongCu += (item.gia_ban * item.so_luong);

        // tong khi co giam gia
        cost = item.gia_ban * (1 - item.phan_tram_giam / 100);
        tongMoi += cost * item.so_luong;
    })

    statistic.innerHTML = `
         <h3>Tổng tiền giỏ hàng</h3>
                    <div class="cart-summary-info">
                        <p>Tổng sản phẩm</p>
                        <p class="total-product">
                            ${tongSanPham}
                        </p>
                    </div>
                    <div class="cart-summary-info">
                        <p>Tổng tiền hàng</p>
                        <p class="total-not-discount">
                            ${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(tongCu)}
                        </p>
                    </div>
                    <div class="cart-summary-info">
                        <p>Thành tiền</p>
                        <p>
                            <b class="order-price-total">
                                ${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(tongMoi)}
                            </b>
                        </p>
                    </div>
                    <div class="cart-summary-info">
                        <p>Tạm tính</p>
                        <p>
                            <b class="order-price-total">
                                ${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(tongMoi)}
                            </b>
                        </p>
                    </div>
    `;

    const cartTotal = document.getElementById('cart-total');
    cartTotal.innerHTML = tongSanPham;
</script>