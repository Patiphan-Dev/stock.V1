<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">กราฟแสดงสินค้าขายดีในช่วง 1 ปี</h3>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        // ดึงข้อมูลเดือนและจำนวนสินค้าจาก Blade มาใช้ใน JavaScript
        var months = @json($months);
        var quantities = @json($quantities);

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
        
        var lineChartData = {
            labels: months.map(month => new Date(0, month - 1).toLocaleString('default', { month: 'long' })), // แปลงเลขเดือนเป็นชื่อเดือน
            datasets: [{
                label: 'จำนวนสินค้าที่ขายได้',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: quantities // ใช้จำนวนสินค้าที่ส่งจาก Controller
            }]
        };

        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        };

        new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        });

    });
</script>
