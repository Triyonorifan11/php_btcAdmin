<?php
include_once __DIR__ . "/../../koneksi.php";
include_once __DIR__ . "/../../function/chartJS.php";

$dataChart = chart_filter_last_buy_sell();
?>

<script>
    const id_filter_jenis = document.getElementById("chart_last_buy_sell");
    const tanggal_jenis = <?= json_encode($dataChart['tanggal']); ?>;
    const data_last_buy = <?= json_encode($dataChart['lastbuy']); ?>;
    const data_last_sell = <?= json_encode($dataChart['lastsell']); ?>;

    const chartLaslevel = new Chart(
        id_filter_jenis, {
            type: 'line',
            data: {
                labels: tanggal_jenis,
                datasets: [{
                        label: 'Last Buy',
                        data: data_last_buy,
                        backgroundColor: 'rgba(255, 201, 60, 0.3)',
                        borderColor: 'rgb(255, 201, 60)',
                        borderWidth: 2,
                        fill: 'start'
                    },

                    {
                        label: 'Last Sell',
                        data: data_last_sell,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: 'start'
                    },
                ]
            },
            options: {}
        }
    );
</script>