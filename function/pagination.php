<?php
include_once __DIR__ . "/../koneksi.php";

function pagination($page)
{
    $data = pagination_info($page, "SELECT * FROM btc");
    $firstPage = $data['first'];
    $batas = $data['batas'];
    global $mysqli;
    $showData = mysqli_query($mysqli, "SELECT * FROM btc order by id desc limit $firstPage, $batas");

    return [
        'show' => $showData,
        'pagination_info' => $data
    ];
}

function pagination_info($page, $query = null)
{
    global $mysqli;
    $batas = 10;

    $firstPage = ($page > 1) ? ($page * $batas) - $batas : 0;

    $prev = $page - 1;
    $next = $page + 1;

    // $result = mysqli_query($mysqli, "SELECT * FROM btc order by id desc");
    // cek query
    if (is_null($query)) {
        $result = mysqli_query($mysqli, "SELECT * FROM btc");
    } else {
        $result = mysqli_query($mysqli, $query);
    }

    $jumlah_data = mysqli_num_rows($result);
    $total_halaman = ceil($jumlah_data / $batas);
    // set jumlah pagination

    $jumlah_link = 5;
    if ($page > $jumlah_link) {
        $start_number = $page - $jumlah_link;
    } else {
        $start_number = 1;
    }

    if ($page < $total_halaman - $jumlah_link) {
        $end_number = $page + $jumlah_link;
    } else {
        $end_number = $total_halaman;
    }

    return [
        'start' => $start_number,
        'end' => $end_number,
        'prev' => $prev,
        'next' => $next,
        'page' => $page,
        'totalHalaman' => $total_halaman,
        'first' => $firstPage,
        'batas' => $batas,
        'result' => $result,
        'query' => $query,
        'jumlah_data' => $jumlah_data
    ];
}

function pagination_links($page)
{

    $startCheck = isset($_GET['start_date']) ? "&start_date=" . $_GET['start_date'] : "";
    $endCheck = isset($_GET['end_date']) ? "&end_date=" . $_GET['end_date'] : "";

    $levelCheck = isset($_GET['level']) ? "&level=" . $_GET['level'] : "";
    $filterTrue = isset($_GET['filter']) ? "&filter=" . $_GET['filter'] : "";
    $jenis = isset($_GET['jenis']) ? "&jenis=" . $_GET['jenis'] : "";
    $search = isset($_GET['keysearch']) ? "&keysearch=" . $_GET['keysearch'] : "";

    $start_sinyal = isset($_GET['start_sinyal']) ? "&start_sinyal=" . $_GET['start_sinyal'] : "";
    $end_sinyal = isset($_GET['end_sinyal']) ? "&end_sinyal=" . $_GET['end_sinyal'] : "";

    $start_harga_idr = isset($_GET['start_harga_idr']) ? "&start_harga_idr=" . $_GET['start_harga_idr'] : "";
    $end_harga_idr = isset($_GET['end_harga_idr']) ? "&end_harga_idr=" . $_GET['end_harga_idr'] : "";

    $start_harga_usd = isset($_GET['start_harga_usd']) ? "&start_harga_usd=" . $_GET['start_harga_usd'] : "";
    $end_harga_usd = isset($_GET['end_harga_usd']) ? "&end_harga_usd=" . $_GET['end_harga_usd'] : "";

    $start_vol_idr = isset($_GET['start_vol_idr']) ? "&start_vol_idr=" . $_GET['start_vol_idr'] : "";
    $end_vol_idr = isset($_GET['end_vol_idr']) ? "&end_vol_idr=" . $_GET['end_vol_idr'] : "";

    $start_vol_usd = isset($_GET['start_vol_usd']) ? "&start_vol_usd=" . $_GET['start_vol_usd'] : "";
    $end_vol_usd = isset($_GET['end_vol_usd']) ? "&end_vol_usd=" . $_GET['end_vol_usd'] : "";

    $params = "?halaman=$page" . $filterTrue . $startCheck . $endCheck . $levelCheck . $search . $jenis .
        $start_sinyal . $end_sinyal . $start_harga_idr . $end_harga_idr . $start_harga_usd . $end_harga_usd
        . $start_vol_idr . $end_vol_idr . $start_vol_usd . $end_vol_usd;


    return $params;
}
