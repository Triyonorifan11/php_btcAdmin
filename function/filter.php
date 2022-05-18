<?php
include_once __DIR__ . "/../koneksi.php";
include_once "pagination.php";

// flter tanggal
function filter_tanggal($from = "", $to = "", $page)
{
    global $mysqli;
    $q_all = "SELECT * from btc WHERE tanggal BETWEEN '$from' AND '$to' order by id desc";
    $p_info = pagination_info($page, $q_all);

    $q_one = $q_all .  " limit " . $p_info['first'] . "," . $p_info['batas'];

    $show_limit = mysqli_query($mysqli, $q_one);

    return [
        'show' => $show_limit,
        'pagination_info' => $p_info,
        'query' => $q_all,

    ];
}

function filter_level($option, $page)
{
    global $mysqli;
    $q_all = "SELECT * from btc WHERE level = $option order by id desc";
    $p_info = pagination_info($page, $q_all);

    $q_one = $q_all .  " limit " . $p_info['first'] . "," . $p_info['batas'];

    $show_limit = mysqli_query($mysqli, $q_one);

    return [
        'show' => $show_limit,
        'pagination_info' => $p_info,
        'query' => $q_all,
    ];
}

function get_filter_data($page, array $filter)
{
    global $mysqli;
    $q_all = "";
    // $q_all = "SELECT * from btc WHERE level = $option order by id desc";
    $p_info = pagination_info($page);

    $q_one = $q_all .  " limit " . $p_info['first'] . "," . $p_info['batas'];

    $show_limit = mysqli_query($mysqli, $q_one);

    return [
        'show' => $show_limit,
        'pagination_info' => $p_info,
        'query' => $q_all,
    ];
}



// var_dump(filter_tanggal('2022-05-01', '2022-05-10', 1));
