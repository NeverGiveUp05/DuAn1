<main id="main">
    <section class="container">
        <?php if (isset($_SESSION['userId'])) { ?>
            <!-- <a href="http://localhost/DuAn?action=handleCheckout" class="cart-summary-button">Thanh toán</a> -->
            <button id="checkoutButton" class="cart-summary-button">Thanh toán</button>
        <?php } else { ?>
            <a href="http://localhost/DuAn?action=login" class="cart-summary-button">Đăng nhập để thanh toán</a>
        <?php } ?>
    </section>
</main>

<script>
    document.getElementById('checkoutButton').addEventListener('click', async function() {
        // Lấy giỏ hàng từ localStorage (hoặc từ bất kỳ nơi nào bạn lưu trữ)
        let cartData = JSON.parse(localStorage.getItem('cart'));

        let total = 0;

        cartData.forEach((item) => {
            cost = item.gia_ban * (1 - item.phan_tram_giam / 100);
            total += cost * item.so_luong;
        })

        console.log(total);


        cartData = cartData.map(product => ({
            san_pham_chi_tiet_id: product.id,
            so_luong: product.so_luong,
            gia_ban: product.gia_ban
        }));

        console.log(cartData);

        if (cartData) {
            const requestData = {
                nguoi_dung_id: <?php echo $_SESSION['userId'] ?>, // ID người dùng (có thể lấy từ session hoặc cookie)
                tong_tien: total, // Tổng tiền từ giỏ hàng
                san_pham: cartData // Mảng sản phẩm, mỗi sản phẩm có gia_ban, san_pham_chi_tiet_id, so_luong
            };

            console.log(requestData);

            // try {
            //     const response = await fetch("<?php echo BASE_URL . '/process-payment.php' ?>", {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //         },
            //         body: JSON.stringify(requestData),
            //     });

            //     const responseData = await response.json();

            //     if (responseData.status === 'success') {
            //         console.log('Thanh toán thành công!', responseData);
            //         alert('Thanh toán thành công!');
            //         // Bạn có thể chuyển hướng người dùng đến trang xác nhận đơn hàng, hoặc trang cảm ơn
            //     } else {
            //         alert('Có lỗi xảy ra: ' + responseData.message);
            //     }
            // } catch (error) {
            //     console.error('Lỗi kết nối:', error);
            //     alert('Đã xảy ra lỗi trong quá trình thanh toán.');
            // }

            try {
                const response = await fetch("<?php echo BASE_URL . '/process-payment.php' ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(requestData),
                });

                // Kiểm tra nếu phản hồi không phải là JSON (có thể là lỗi HTML)
                const responseText = await response.text(); // Đọc phản hồi dưới dạng text thay vì JSON
                console.log('Raw response:', responseText); // Kiểm tra nội dung của phản hồi

                // Kiểm tra mã trạng thái HTTP trước khi parse JSON
                if (response.ok) {
                    try {
                        const responseData = JSON.parse(responseText); // Chuyển phản hồi thành JSON nếu nó hợp lệ
                        if (responseData.status === 'success') {
                            console.log('Thanh toán thành công!', responseData);
                            if (window.confirm('Thanh toán thành công!')) {
                                localStorage.clear();
                                window.location.href = "<?php echo BASE_URL . '/?action=statusStatistic' ?>";
                            }

                        } else {
                            alert('Có lỗi xảy ra: ' + responseData.message);
                        }
                    } catch (jsonError) {
                        console.error('Lỗi parse JSON:', jsonError);
                        alert('Dữ liệu trả về không hợp lệ.');
                    }
                } else {
                    console.error('Lỗi kết nối:', response.status);
                    alert('Đã xảy ra lỗi trong quá trình thanh toán.');
                }
            } catch (error) {
                console.error('Lỗi kết nối:', error);
                alert('Đã xảy ra lỗi trong quá trình thanh toán.');
            }

        } else {
            alert('Giỏ hàng của bạn trống.');
        }
    });
</script>