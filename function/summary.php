<?php
include_once __DIR__ . "/../koneksi.php";

function getLastHarga()
{
    global $mysqli;

    $query = "SELECT hargaidr from btc order by tanggal desc limit 0,1";

    $sqli = mysqli_query($mysqli, $query);

    $last = mysqli_fetch_row($sqli);



    // var_dump($last);

    return number_format($last[0], 0, ',', '.');
}

function getTotalData()
{
    global $mysqli;
    $result = mysqli_query($mysqli, "SELECT * FROM btc");
    $jumlah_data = mysqli_num_rows($result);

    return number_format($jumlah_data, 0, ',', '.');
}

function getLastUSD()
{
    global $mysqli;

    $query = "SELECT hargausdt from btc order by tanggal desc limit 0,1";

    $sqli = mysqli_query($mysqli, $query);

    $lastusd = mysqli_fetch_row($sqli);



    // var_dump($last);

    return number_format($lastusd[0], 0, ',', '.');
}
