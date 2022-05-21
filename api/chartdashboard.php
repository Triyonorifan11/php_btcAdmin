<?php
include_once __DIR__ . "/../koneksi.php";

$query_harga = "SELECT hargaidr from btc order by id desc limit 0,20000";
$query_tanggal = "SELECT distinct tanggal from btc order by id desc limit 0,20000";

$hargaIdr = mysqli_query($mysqli,  $query_harga);
$tanggal = mysqli_query($mysqli, $query_tanggal);

?>
<script>
    const test_chart = document.getElementById("test_chart");
    const labels = [<?php while ($tanggals = mysqli_fetch_array($tanggal)) {
                        echo '"' . $tanggals['tanggal'] . '",';
                    } ?>]
    const data = [<?php while ($harga = mysqli_fetch_array($hargaIdr)) {
                        echo $harga['hargaidr'] . ',';
                    } ?>];

    const myChart = new Chart(
        test_chart, {
            type: 'line',
            data: {
                labels: labels,
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