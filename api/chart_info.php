<?php
include_once __DIR__ . "/../koneksi.php";

function chart_level_tanggal()
{
    global $mysqli;

    $query = "SELECT DISTINCT level,tanggal from btc order by id asc ";

    $x_query = mysqli_query($mysqli, $query);

    $getArray = array();

    while ($row = mysqli_fetch_array($x_query)) {
        $getArray[] = [
            'level' => $row['level'],
            'tanggal' => $row['tanggal']
        ];
    }

    echo json_encode($getArray);
}
chart_level_tanggal();
