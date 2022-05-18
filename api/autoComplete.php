<?php
include_once __DIR__ . "/../koneksi.php";

function auto_complete()
{
    global $mysqli;
    $keyword = $_GET['keysearch'];
    $query = "SELECT id from btc WHERE id LIKE '%$keyword%' order by id desc";

    $x_query = mysqli_query($mysqli, $query);

    $id_array =  array();

    while ($row = mysqli_fetch_array($x_query)) {
        $id_array[] = [
            'id' => $row['id']
        ];
    }

    // $result = mysqli_fetch_array($x_query, MYSQLI_ASSOC);


    echo json_encode($id_array);
}

auto_complete();
