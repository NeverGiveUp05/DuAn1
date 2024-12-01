<!-- Thông Tin Người Mua Hàng -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5>Thông Tin Người Mua Hàng</h5>
    </div>
    <div class="card-body">
        <p><strong>Họ Tên:</strong> Nguyễn Văn A</p>
        <p><strong>Email:</strong> nguyenvana@example.com</p>
        <p><strong>Số Điện Thoại:</strong> 0123456789</p>
        <p><strong>Địa Chỉ:</strong> 123 Đường ABC, Quận X, TP. Hồ Chí Minh</p>
    </div>
</div>

<!-- Chi Tiết Hóa Đơn -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <h5>Chi Tiết Hóa Đơn</h5>
    </div>
    <div class="card-body">
        <p><strong>Mã Đơn Hàng:</strong> #123456</p>
        <p><strong>Ngày Tạo:</strong> 01/12/2024</p>
        <p><strong>Phương Thức Thanh Toán:</strong> Thanh toán khi nhận hàng (COD)</p>
        <p><strong>Tổng Tiền:</strong> 1,500,000 VND</p>
        <hr>
        <h6>Sản Phẩm:</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sản phẩm A</td>
                    <td>2</td>
                    <td>500,000 VND</td>
                    <td>1,000,000 VND</td>
                </tr>
                <tr>
                    <td>Sản phẩm B</td>
                    <td>1</td>
                    <td>500,000 VND</td>
                    <td>500,000 VND</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Lịch Sử Hóa Đơn -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h5>Lịch Sử Hóa Đơn</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Thời Gian</th>
                    <th>Trạng Thái</th>
                    <th>Người Cập Nhật</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01/12/2024 10:00</td>
                    <td>Đã đặt hàng</td>
                    <td>Admin A</td>
                </tr>
                <tr>
                    <td>02/12/2024 14:30</td>
                    <td>Đang xử lý</td>
                    <td>Admin B</td>
                </tr>
                <tr>
                    <td>03/12/2024 09:15</td>
                    <td>Đã giao hàng</td>
                    <td>Admin A</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Nút Hành Động -->
<div class="text-end">
    <button class="btn btn-primary">Chỉnh Sửa Trạng Thái</button>
    <button class="btn btn-secondary">In Hóa Đơn</button>
</div>