<div class="col-md-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">สินค้าขายดี 3 เดือน</h3>
        </div>
        <div class="card-body">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">สินค้าขายดี 6 เดือน</h3>
        </div>
        <div class="card-body">
            <canvas id="pieChartSixMonths" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>

<script>
    $(function() {

        // ดึงข้อมูลจาก Blade มาใช้ใน JavaScript
        var productNames = @json($productNames);
        var productQuantities = @json($productQuantities);

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieData = {
            labels: productNames, // ใช้ชื่อสินค้าจาก Controller
            datasets: [{
                data: productQuantities, // ใช้จำนวนสินค้าจาก Controller
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });
    });
</script>

<script>
    $(function() {

        // ดึงข้อมูลสินค้าขายดีช่วง 6 เดือนจาก Blade มาใช้ใน JavaScript
        var productNamesSixMonths = @json($productNamesSixMonths);
        var productQuantitiesSixMonths = @json($productQuantitiesSixMonths);

        var pieChartCanvasSixMonths = $('#pieChartSixMonths').get(0).getContext('2d');
        var pieDataSixMonths = {
            labels: productNamesSixMonths, // ใช้ชื่อสินค้าจาก Controller
            datasets: [{
                data: productQuantitiesSixMonths, // ใช้จำนวนสินค้าจาก Controller
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        };
        var pieOptionsSixMonths = {
            maintainAspectRatio: false,
            responsive: true,
        };

        new Chart(pieChartCanvasSixMonths, {
            type: 'pie',
            data: pieDataSixMonths,
            options: pieOptionsSixMonths
        });
    });
</script>
