<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h3 class="mb-3 text-center">Thống kê doanh thu</h3>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Row for Chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Biểu đồ doanh thu theo tháng</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết doanh thu</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Doanh thu (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) {
                                    $month = explode('-', $row['thang'])[1];
                                    $revenue = number_format($row['tong_doanh_thu'], 0, ',', '.');

                                    echo '<tr>';
                                    echo '<td>Tháng ' . $month . '</td>';
                                    echo '<td>' . $revenue . '</td>';
                                    echo '</tr>';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php foreach ($data as $row) {
                        $months[] = 'Tháng' . ' ' . explode('-', $row['thang'])[1];;
                    }
                    echo json_encode($months); ?>,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: <?php foreach ($data as $row) {
                            $array[] = $row['tong_doanh_thu'];
                        }
                        echo json_encode($array); ?>,
                backgroundColor: 'rgba(60,141,188,0.8)',
                borderColor: 'rgba(60,141,188,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>