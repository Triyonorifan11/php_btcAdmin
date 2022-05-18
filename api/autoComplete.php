<?php
include_once __DIR__ . "/../koneksi.php";

function auto_complete()
{
    global $mysqli;
    $keyword = $_GET['keysearch'];
    $query = "SELECT id,level,jenis from btc WHERE id LIKE '%$keyword%' OR 
                                                    level LIKE '%$keyword%' OR 
                                                    jenis LIKE '%$keyword%'
                                                    order by id desc LIMIT 0,10";

    $x_query = mysqli_query($mysqli, $query);

    $id_array =  array();

    while ($row = mysqli_fetch_array($x_query)) {
        $id_array[] = [
            'id' => $row['id'],
            'level' => $row['level'],
            'jenis' => $row['jenis']
        ];
    }

    // $result = mysqli_fetch_array($x_query, MYSQLI_ASSOC);


    echo json_encode($id_array);
}

auto_complete();
