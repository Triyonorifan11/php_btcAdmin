<?php
include_once __DIR__ . "/../koneksi.php";
include_once("filter2.php");

function chart_level()
{
    global $mysqli;
    $query_level = "SELECT level,tanggal from btc order by id desc";
    $level = mysqli_query($mysqli, $query_level);

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

// chart 2
function chart_filter_jenis()
{
    global $mysqli;

    if (isset($_GET["jenis"]) && $_GET["jenis"] != "") {
        $query = generate_query(["jenis" => "filter_jenis"], "id", ["level", "tanggal"]);
    } else {
        $query = generate_query([], "id", ["level", "tanggal"]);
    }

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

// chart 3
function chart_filter_date()
{
    global $mysqli;
    // get_filter_data();
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;

    if (isset($_GET["jenis"]) && $_GET["jenis"] != "" || (isset($start_date) && $start_date != "") || (isset($end_date) && $end_date != "")) {
        $query = generate_query(["jenis" => "filter_jenis", "tanggal" => "filter_tanggal"], "id", ["level", "tanggal"]);
    } else {
        $query = generate_query([], "id", ["level", "tanggal"]);
    }

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
