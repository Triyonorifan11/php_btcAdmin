<?php
include_once __DIR__ . "/../../koneksi.php";
include_once __DIR__ . "/../../function/chartJS.php";

$dataChart = chart_idr_dashboard();


?>
<script>
    const test_chart = document.getElementById("chart_harga_idr");
    const date = <?= json_encode($dataChart['tanggal']); ?>;
    const data = <?= json_encode($dataChart['harga']); ?>;

    const myChart = new Chart(
        test_chart, {
            type: 'line',
            data: {
                labels: date,
                datasets: [{
                    label: 'Data Harga IDR',
                    backgroundColor: 'rgba(255, 201, 60, 0.3)',
                    borderColor: 'rgba(255, 201, 60, 1)',
                    data: data,
                    fill: 'start'
                }]
            },
            options: {}
        }
    );
</script>