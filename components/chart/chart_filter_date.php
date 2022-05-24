<?php
include_once __DIR__ . "/../../koneksi.php";
include_once __DIR__ . "/../../function/chartJS.php";

$dataChart_jenis = chart_filter_date();
?>

<script>
    const id_filter_jenis = document.getElementById("chart_datePicker");

    const tanggal_jenis = <?= json_encode($dataChart_jenis['tanggal']); ?>;

    const level_data_jenis = <?= json_encode($dataChart_jenis['level']); ?>;
    console.log(level_data_jenis);

    const uniqLevel = [...new Set(level_data_jenis)];

    const chartLaslevel = new Chart(
        id_filter_jenis, {
            type: 'line',
            data: {
                labels: tanggal_jenis,
                datasets: [{
                    label: 'Level BTC',
                    backgroundColor: 'rgba(255, 201, 60, 0.3)',
                    borderColor: 'rgb(255, 201, 60)',
                    data: level_data_jenis,
                    fill: 'start',
                    stepped: true,
                    yAxisID: 'y2',
                }, ]
            },
            options: {
                scales: {
                    y2: {
                        type: 'category',
                        labels: ['UltraMoon1', 'UltraMoon2', 'MegaMoon1', 'MegaMoon2', 'SuperMoon1', 'SuperMoon2', 'Wajar1', 'Wajar2', 'Moon1', 'Moon2', 'Recover1', 'Recover2', 'sama', 'Crash1', 'Crash2', 'SuperCrash1', 'SuperCrash2', 'DiamondCrash', 'GoldenCrash1', 'GoldenCrash2', 'MegaCrash1', 'MegaCrash2', 'UltraCrash1', 'UltraCrash2'],
                        offset: true,
                        position: 'left',
                        stack: 'demo',
                        stackWeight: 1,

                    }
                }
            }
        }
    );
</script>