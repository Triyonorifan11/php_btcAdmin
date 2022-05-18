<?php
include_once __DIR__ . "/../koneksi.php";


function getLevel()
{
    global $mysqli;
    $query = "SELECT DISTINCT level from btc WHERE level != '' order by level asc";

    return mysqli_query($mysqli, $query);
}

function getJenis()
{
    global $mysqli;
    $query = "SELECT DISTINCT jenis from btc WHERE jenis != '' order by jenis asc";

    return mysqli_query($mysqli, $query);
}

function getSinyal()
{
    global $mysqli;
    $query = "SELECT DISTINCT sinyal from btc WHERE sinyal != '' order by sinyal asc";

    return mysqli_query($mysqli, $query);
}
