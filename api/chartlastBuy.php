<?php
include_once __DIR__ . "/../koneksi.php";

$query_lastbuy = "SELECT lastbuy from btc order by id desc limit 0,20000";
$query_tanggal2 = "SELECT distinct tanggal from btc order by id desc limit 0,20000";

$lastbuy = mysqli_query($mysqli, $query_lastbuy);
$tanggal2 = mysqli_query($mysqli, $query_tanggal2);

?>
<script>
    const id_lastbuy = document.getElementById("chart_lastbuy");
    const tanggal = [<?php while ($tanggalss = mysqli_fetch_array($tanggal2)) {
                            echo '"' . $tanggalss['tanggal'] . '",';
                        } ?>];
    const lastbuy_data = [<?php while ($data_lastbuy = mysqli_fetch_array($lastbuy)) {
                                echo $data_lastbuy['lastbuy'] . ',';
                            } ?>];

    const chartLasbuy = new Chart(
        id_lastbuy, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Volume IDR',
                    backgroundColor: 'rgba(255, 201, 60, 0.3)',
                    borderColor: 'rgb(255, 201, 60)',
                    data: lastbuy_data,
                    fill: 'start'
                }, ]
            },
            options: {}
        }
    );
</script>