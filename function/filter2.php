<?php
include_once __DIR__ . "/../koneksi.php";
include_once "pagination.php";

// flter tanggal
function filter_tanggal()
{
    return "tanggal BETWEEN '" . $_GET['start_date'] . "' AND '" . $_GET['end_date'] . "'";
}

function filter_level()
{
    return " level = '" . $_GET['level'] . "'";
}

function filter_jenis()
{
    return "jenis = '" . $_GET['jenis'] . "'";
}

function filter_sinyal()
{
    return "sinyal BETWEEN '" . $_GET['start_sinyal'] . "' AND '" . $_GET['end_sinyal'] . "'";
}

function filter_harga_idr()
{
    return "hargaidr BETWEEN '" . $_GET['start_harga_idr'] . "' AND '" . $_GET['end_harga_idr'] . "'";
}

function filter_harga_usd()
{
    return "hargausdt BETWEEN '" . $_GET['start_harga_usd'] . "' AND '" . $_GET['end_harga_usd'] . "'";
}

function filter_vol_idr()
{
    return "volidr BETWEEN '" . $_GET['start_vol_idr'] . "' AND '" . $_GET['end_vol_idr'] . "'";
}

function filter_vol_usd()
{
    return "volusdt BETWEEN '" . $_GET['start_vol_usd'] . "' AND '" . $_GET['end_vol_usd'] . "'";
}

// sambung query sesuai filter
function generate_query(array $types, $sort)
{
    if (empty($types)) {
        $full_query = "SELECT * from btc order by $sort asc";
    } else {
        $base_query = "SELECT * from btc WHERE ";
        $full_query = $base_query;
        $suffix = " order by id desc";

        $iterasi = 1;
        foreach ($types as $key => $value) {
            if ($iterasi == 1) {
                $full_query .= call_user_func($value);
            } else {
                $full_query .= " AND " . call_user_func($value);
            }

            $iterasi += 1;
        }
        $full_query .= $suffix;
    }

    return $full_query;
}


function get_filter_data()
{
    global $mysqli;
    $page = $_GET['halaman'] ?? 1;
    $start_date = $_GET['start_date'] ?? null;
    $end_date = $_GET['end_date'] ?? null;

    $level = $_GET['level'] ?? null;
    $jenis = $_GET['jenis'] ?? null;

    $start_sinyal = $_GET['start_sinyal'] ?? null;
    $end_sinyal = $_GET['end_sinyal'] ?? null;

    $start_harga_idr = $_GET['start_harga_idr'] ?? null;
    $end_harga_idr = $_GET['end_harga_idr'] ?? null;

    $start_harga_usd = $_GET['start_harga_usd'] ?? null;
    $end_harga_usd = $_GET['end_harga_usd'] ?? null;

    $start_vol_idr = $_GET['start_vol_idr'] ?? null;
    $end_vol_idr = $_GET['end_vol_idr'] ?? null;

    $start_vol_usd = $_GET['start_vol_usd'] ?? null;
    $end_vol_usd = $_GET['end_vol_usd'] ?? null;

    $q_all = "";
    $filter_type = [];

    $filter_sort = "id";

    if ((isset($start_date) && $start_date != "") || (isset($end_date) && $end_date != "")) {
        // array_push($filter_type, "tanggal");
        $filter_type['tanggal'] = 'filter_tanggal';
    }

    if (isset($level) && $level != "") {
        // array_push($filter_type, "level");
        $filter_type['level'] = 'filter_level';
    }

    if (isset($jenis) && $jenis != "") {
        $filter_type['jenis'] = 'filter_jenis';
    }

    if ((isset($start_sinyal) && $start_sinyal != "") || (isset($end_sinyal) && $end_sinyal != "")) {
        $filter_type['sinyal'] = 'filter_sinyal';
        $filter_sort = "sinyal";
    }

    if ((isset($start_harga_idr) && $start_harga_idr != "") || (isset($end_harga_idr) && $end_harga_idr != "")) {
        $filter_type['hargaidr'] = 'filter_harga_idr';
        $filter_sort = "hargaidr";
    }

    if ((isset($start_harga_usd) && $start_harga_usd != "") || (isset($end_harga_usd) && $end_harga_usd != "")) {
        $filter_type['hargausdt'] = 'filter_harga_usd';
        $filter_sort = "hargausdt";
    }

    if ((isset($start_vol_idr) && $start_vol_idr != "") || (isset($end_vol_idr) && $end_vol_idr != "")) {
        $filter_type['volidr'] = 'filter_vol_idr';
        $filter_sort = "volidr";
    }

    if ((isset($start_vol_usd) && $start_vol_usd != "") || (isset($end_vol_usd) && $end_vol_usd != "")) {
        $filter_type['volusdt'] = 'filter_vol_usd';
        $filter_sort = "volusdt";
    }



    $q_all = generate_query($filter_type, $filter_sort);
    $p_info = pagination_info($page, $q_all);

    $q_one = $q_all .  " limit " . $p_info['first'] . "," . $p_info['batas'];

    $show_limit = mysqli_query($mysqli, $q_one);

    return [
        'show' => $show_limit,
        'pagination_info' => $p_info,
        'query' => $q_all,
        'sort' => $filter_sort
    ];
}





// var_dump(get_filter_data());
