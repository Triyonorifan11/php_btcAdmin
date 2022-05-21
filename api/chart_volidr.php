<?php
include_once __DIR__ . "/../koneksi.php";

$vol_idr = "SELECT volidr from btc order by id desc limit 0,20000";
$query_tanggal = "SELECT distinct tanggal from btc order by id desc limit 0,20000";

$volidr = mysqli_query($mysqli,  $vol_idr);
$tanggal = mysqli_query($mysqli, $query_tanggal);

?>
<script>
    const test_chart = document.getElementById("chart_level_tanggal");
    const labels = [<?php while ($tanggals = mysqli_fetch_array($tanggal)) {
                        echo '"' . $tanggals['tanggal'] . '",';
                    } ?>];
    const data = [<?php while ($data_volidr = mysqli_fetch_array($volidr)) {
                        echo $data_volidr['volidr'] . ',';
                    } ?>];

    const chart_level_tanggal = new Chart(
        test_chart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Volume IDR',
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