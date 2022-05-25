<?php
include_once __DIR__ . "/../koneksi.php";
include_once("filter2.php");

function chart_idr_dashboard()
{
    global $mysqli;

    $query_harga = "SELECT hargaidr,tanggal from btc order by id desc limit 0,20000";

    $hargaidr = mysqli_query($mysqli, $query_harga);

    $hargaidr_array = [];
    $tanggal_array = [];

    while ($row = mysqli_fetch_array($hargaidr)) {
        $hargaidr_array[] = $row['hargaidr'];
        $tanggal_array[] = $row['tanggal'];
    }

    return ['harga' => $hargaidr_array, 'tanggal' => $tanggal_array];
}


// chart 1
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

    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;
    $jenis = $_GET['jenis'] ?? null;

    $filter_type = [];

    if (isset($jenis) && $jenis != "") {
        $filter_type['jenis'] = 'filter_jenis';
    }

    if ((isset($start_date) && $start_date != "") || (isset($end_date) && $end_date != "")) {
        $filter_type['tanggal'] = 'filter_tanggal';
    } else {
        $query = generate_query([], "id", ["level", "tanggal"]);
    }

    $query = generate_query($filter_type, "id", ["level", "tanggal"]);
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

// chart 4
function chart_filter_volIDR()
{
    global $mysqli;
    // get_filter_data();
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;
    $jenis = $_GET['jenis'] ?? null;

    $filter_type = [];

    if (isset($jenis) && $jenis != "") {
        $filter_type['jenis'] = 'filter_jenis';
    }

    if ((isset($start_date) && $start_date != "") || (isset($end_date) && $end_date != "")) {
        $filter_type['tanggal'] = 'filter_tanggal';
    } else {
        $query = generate_query([], "id", ["volidr", "tanggal"]);
    }

    $query = generate_query($filter_type, "id", ["volidr", "tanggal"]);
    $data_jenis = mysqli_query($mysqli, $query);

    $volIdr_array = [];
    $tanggal_array = [];

    while ($row = mysqli_fetch_array($data_jenis)) {
        $volIdr_array[] = $row['volidr'];

        $tanggal_array[] = $row['tanggal'];
    }

    return [
        'volidr' => $volIdr_array,
        'tanggal' => $tanggal_array
    ];
}

// chart 5
function chart_filter_last_buy_sell()
{
    global $mysqli;
    // get_filter_data();
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;
    $jenis = $_GET['jenis'] ?? null;

    $filter_type = [];

    if (isset($jenis) && $jenis != "") {
        $filter_type['jenis'] = 'filter_jenis';
    }

    if ((isset($start_date) && $start_date != "") || (isset($end_date) && $end_date != "")) {
        $filter_type['tanggal'] = 'filter_tanggal';
    } else {
        $query = generate_query([], "id", ["volidr", "tanggal"]);
    }

    $query = generate_query($filter_type, "id", ["lastbuy", "lastsell", "tanggal"]);

    $data_jenis = mysqli_query($mysqli, $query);

    $lastbuy_array = [];
    $tanggal_array = [];
    $lastsell_array = [];

    while ($row = mysqli_fetch_array($data_jenis)) {
        $lastbuy_array[] = $row['lastbuy'];
        $tanggal_array[] = $row['tanggal'];
        $lastsell_array[] = $row['lastsell'];
    }

    return [
        'lastbuy' => $lastbuy_array,
        'lastsell' => $lastsell_array,
        'tanggal' => $tanggal_array,
    ];
}
