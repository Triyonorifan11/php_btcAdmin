<?php
include_once __DIR__ . "/../../koneksi.php";
include_once __DIR__ . "/../../function/chartJS.php";

$dataChart_jenis = chart_filter_volIDR();
?>

<script>
    const id_filter_jenis = document.getElementById("chart_vol_idr");

    const tanggal_jenis = <?= json_encode($dataChart_jenis['tanggal']); ?>;

    const level_data_volidr = <?= json_encode($dataChart_jenis['volidr']); ?>;


    const chartLaslevel = new Chart(
        id_filter_jenis, {
            type: 'line',
            data: {
                labels: tanggal_jenis,
                datasets: [{
                    label: 'Volume IDR BTC',
                    backgroundColor: 'rgba(255, 201, 60, 0.3)',
                    borderColor: 'rgb(255, 201, 60)',
                    data: level_data_volidr,
                    fill: 'start',
                }, ]
            },
            options: {}
        }
    );
</script>