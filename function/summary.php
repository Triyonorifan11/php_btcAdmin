<?php
include_once __DIR__ . "/../koneksi.php";

function getTotalData()
{
    global $mysqli;
    $result = mysqli_query($mysqli, "SELECT * FROM btc");
    $jumlah_data = mysqli_num_rows($result);

    return number_format($jumlah_data, 0, ',', '.');
}

function get_last_info_BTC()
{
    global $mysqli;

    $query = "SELECT * from btc order by tanggal desc limit 0,1";

    $sqli = mysqli_query($mysqli, $query);

    $get_data = mysqli_fetch_row($sqli);

    $hargaidr = number_format($get_data[4], 0, ',', '.');
    $hargausd = number_format($get_data[5], 0, ',', '.');
    // $volidr = number_format($get_data[6], 0, ',', '.');
    $volusdt = number_format($get_data[7], 0, ',', '.');

    $volidr = $get_data[6];

    return [
        'hargaidr' => $hargaidr,
        'hargausd' => $hargausd,
        'volidr' => $volidr,
        'volusd' => $volusdt
    ];
}
