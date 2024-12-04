<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<style>
    .checkout-process-bar ul:before {
        width: 94%;
    }

    .checkout-process-bar .active+.active::after {
        position: absolute;
        height: 4px;
        background-color: #221f20;
        content: "";
        width: 225%;
        top: 10px;
        right: 40px;
    }
</style>

<main id="main">
    <section class="container">
        <div class="checkout-process-bar block-border">
            <ul>
                <li id="Pending" class="active"><span>Chờ xác nhận</span></li>
                <li id="Confirmed"><span>Đã xác nhận</span></li>
                <li id="Processing"><span>Đang xử lý</span></li>
                <li id="Shipped"><span>Đang vận chuyển</span></li>
                <li id="Delivered"><span>Đã giao</span></li>
                <li id="PendingPayment"><span>Chờ thanh toán</span></li>
                <li style="display: none;" id="Failed"><span>Thanh toán thất bại</span></li>
                <li id="Completed"><span>Hoàn thành</span></li>
                <li style="display: none;" id="Canceled"><span>Đã hủy</span></li>
                <li style="display: none;" id="Returned"><span>Đã trả lại</span></li>
                <li style="display: none;" id="Refunded"><span>Đã hoàn tiền</span></li>
                <li style="display: none;" class="active"><span>Đã hủy</span></li>
            </ul>
        </div>

        <!-- <button class="btn btn-danger">Hủy</button>
        <button style="display: none;" class="btn btn-warning">Hoàn trả</button> -->
    </section>
</main>

<script>
    const statusPending = document.getElementById('Pending');
    const statusConfirmed = document.getElementById('Confirmed');
    const statusProcessing = document.getElementById('Processing');
    const statusShipped = document.getElementById('Shipped');
    const statusDelivered = document.getElementById('Delivered');
    const statusPendingPayment = document.getElementById('PendingPayment');
    const statusFailed = document.getElementById('Failed');
    const statusCompleted = document.getElementById('Completed');
    const statusCanceled = document.getElementById('Canceled');
    const statusReturned = document.getElementById('Returned');
    const statusRefunded = document.getElementById('Refunded');

    const currentStatus = '<?php echo $status ?>';

    if (currentStatus && currentStatus == 'Confirmed') {
        statusConfirmed.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Processing') {
        statusConfirmed.classList.add('active');
        statusProcessing.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Shipped') {
        statusConfirmed.classList.add('active');
        statusProcessing.classList.add('active');
        statusShipped.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Delivered') {
        statusConfirmed.classList.add('active');
        statusProcessing.classList.add('active');
        statusShipped.classList.add('active');
        statusDelivered.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Pending Payment') {
        statusConfirmed.classList.add('active');
        statusProcessing.classList.add('active');
        statusShipped.classList.add('active');
        statusPendingPayment.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Failed') {
        statusFailed.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Completed') {
        statusConfirmed.classList.add('active');
        statusProcessing.classList.add('active');
        statusShipped.classList.add('active');
        statusPendingPayment.classList.add('active');
        statusCompleted.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Canceled') {
        statusCanceled.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Returned') {
        statusReturned.classList.add('active');
    }

    if (currentStatus && currentStatus == 'Refunded') {
        statusRefunded.classList.add('active');
    }
</script>