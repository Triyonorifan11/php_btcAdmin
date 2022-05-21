<?php
include_once __DIR__ . "/../koneksi.php";
include_once __DIR__ . "/../function/filter2.php";

function chart_level()
{
    global $mysqli;
    $query_level = "SELECT level,tanggal from btc order by id desc limit 0,20";

    // $tanggal_level = mysqli_query($mysqli, $query_level);
    $level = mysqli_query($mysqli, $query_level);
    // $tanggal = $level;

    $level_array = [];
    $tanggal_array = [];

    while ($row = mysqli_fetch_array($level)) {
        $level_array[] = $row['level'];

        $tanggal_array[] = $row['tanggal'];
    }

    return [
        'level' => $level_array,
        'tanggal' => $tanggal_array
    ];
}

function chart_filter_jenis()
{
    global $mysqli;
    $query = generate_query(["jenis"], "id", ["level", "tanggal"]);

    $data_jenis = mysqli_query($mysqli, $query);

    $level_array = [];
    $tanggal_array = [];

    while ($row = mysqli_fetch_array($data_jenis)) {
        $level_array[] = $row['level'];

        $tanggal_array[] = $row['tanggal'];
    }

    return [
        'level' => $level_array,
        'tanggal' => $tanggal_array
    ];
}
