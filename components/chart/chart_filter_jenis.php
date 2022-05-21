<?php
include_once __DIR__ . "/../../koneksi.php";
include_once __DIR__ . "/../../function/chartJS.php";

$dataChart = chart_filter_jenis();
?>

<script>
    const id_level = document.getElementById("level");


    const tanggals = <?= json_encode($dataChart['tanggal']); ?>;

    const level_data = <?= json_encode($dataChart['level']); ?>;
    console.log(level_data);

    const uniqLevel = [...new Set(level_data)];

    const chartLaslevel = new Chart(
        id_level, {
            type: 'line',
            data: {
                labels: tanggals,
                datasets: [{
                    label: 'Level BTC',
                    backgroundColor: 'rgba(255, 201, 60, 0.3)',
                    borderColor: 'rgb(255, 201, 60)',
                    data: level_data,
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