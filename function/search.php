<?php
include_once __DIR__ . "/../koneksi.php";
include_once "pagination.php";

function search($keyword)
{
    global $mysqli;
    $page = $_GET['halaman'] ?? 1;
    $query = "SELECT * from btc WHERE id LIKE '%$keyword%' order by id desc";
    $data = pagination_info($page, $query);

    $showData = mysqli_query($mysqli, $query);
    return [
        'show' => $showData,
        'pagination_info' => $data
    ];
}

function getByid($id)
{
    global $mysqli;
    $page = $_GET['halaman'] ?? 1;
    $query = "SELECT * from btc WHERE id = $id order by id desc";
    $data = pagination_info($page, $query);

    $showData = mysqli_query($mysqli, $query);
    return [
        'show' => $showData,
        'pagination_info' => $data
    ];
}
