<?php
include_once("koneksi.php");
include_once("function/pagination.php");
include_once("function/filter2.php");
include_once("function/query.php");
include_once("function/search.php");

if (!empty($_GET)) {
    if (isset($_GET['halaman'])  &&  isset($_GET['filter'])) {
        $data = get_filter_data();
    } else if (isset($_GET['keysearch'])) {
        $data = search($_GET['keysearch']);
    } else if (isset($_GET['id'])) {
        $data = getByid($_GET['id']);
    } else if (isset($_GET['halaman'])) {
        $data = pagination($_GET['halaman']);
    }
} else {
    $data = pagination(1);
}


$showData = $data['show'];

$pag_info = $data['pagination_info'];

$page = $pag_info['page'];
$start_number = $pag_info['start'];
$end_number = $pag_info['end'];
$next = $pag_info['next'];
$prev = $pag_info['prev'];
$total_halaman = $pag_info['totalHalaman'];
$total_data = $pag_info['jumlah_data'];

$ops_level = getLevel();
$ops_jenis = getJenis();
$ops_sinyal_start = getSinyal();
$ops_sinyal_end = getSinyal();




?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengumpulan Sinyal BTC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>

<body>



    <div class="container">
        <h1 class="text-center">Penambangan Sinyal Harian INDODAX</h1>
        <div class="my-4 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= pagination_links(1); ?>" class="btn btn-outline-secondary me-2">Start</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?= pagination_links($prev); ?>" class="btn btn-outline-secondary me-2">Prev</a>
                        </li>

                    <?php endif; ?>
                    <?php for ($i = $start_number; $i <= $end_number; $i++) : ?>
                        <li class="page-item">
                            <?php if ($i == $page) : ?>
                                <a class="page-link active" href="<?= pagination_links($i); ?>" class="btn btn-secondary"><?= $i; ?></a>
                            <?php else : ?>
                                <a class="page-link" href="<?= pagination_links($i) ?>" class="btn btn-outline-secondary"><?= $i; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $total_halaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= pagination_links($next); ?>" class="btn btn-outline-secondary ms-2">Next</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?= pagination_links($total_halaman); ?>" class="btn btn-outline-secondary ms-2">End</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>


        <div class="my-4 col-md-12 d-md-flex">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-funnel"></i>
            </button>
            <!-- href relative -->
            <a href="http://localhost:1109/pemWeb/btc/" class="btn btn-danger me-auto"><i class="bi bi-arrow-clockwise"></i> Reset</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="height: 90vh; ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="overflow-y:scroll ;">
                            <form class="" method="GET">
                                <input type="hidden" name="filter" value="true">
                                <label for="">Filter Tanggal</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="halaman" value="1">
                                        <span class="input-group-text" id="addon-wrapping">from</span>
                                        <input type="date" class="form-control" name="start_date" value="<?= $_GET['start_date']; ?>">
                                    </div>
                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to</span>
                                        <input type="date" class="form-control" name="end_date" value="<?= $_GET['end_date']; ?>">
                                    </div>
                                </section>


                                <!-- filter level -->
                                <label for="" class="">Filter Level</label>
                                <section class="col-12 d-flex">
                                    <select class="form-select" aria-label="Default select example" name="level">
                                        <option <?= isset($_GET['level']) ? "" : "selected" ?> value="">Semua</option>
                                        <?php while ($option_level = mysqli_fetch_array($ops_level)) : ?>
                                            <option <?= isset($_GET['level']) && $_GET['level'] == $option_level['level'] ? "selected" : ""; ?> value="<?= $option_level['level']; ?>"><?= $option_level['level']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </section>

                                <!-- Filter Jenis -->
                                <label for="" class="mt-3">Filter Jenis</label>
                                <section class="col-12 d-flex">
                                    <select class="form-select" aria-label="Default select example" name="jenis">
                                        <option <?= isset($_GET['jenis']) ? "" : "selected"; ?> value="">Semua</option>
                                        <?php while ($option_jenis = mysqli_fetch_array($ops_jenis)) : ?>
                                            <option <?= isset($_GET['jenis']) && $_GET['jenis'] == $option_jenis['jenis'] ? "selected" : ""; ?> value="<?= $option_jenis['jenis']; ?>"><?= $option_jenis['jenis']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </section>

                                <!-- filter sinyal -->
                                <label for="" class="mt-3">Filter Sinyal</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping">from</span>

                                        <select class="form-select" aria-label="Default select example" name="start_sinyal">
                                            <option <?= isset($_GET['start_sinyal']) ? "" : "selected"; ?> value="">Semua</option>
                                            <?php while ($option_sinyal = mysqli_fetch_array($ops_sinyal_start)) : ?>
                                                <option <?= isset($_GET['start_sinyal']) && $_GET['start_sinyal'] == $option_sinyal['sinyal'] ? "selected" : ""; ?> value="<?= $option_sinyal['sinyal']; ?>"><?= $option_sinyal['sinyal']; ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                    </div>
                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to</span>
                                        <select class="form-select" aria-label="Default select example" name="end_sinyal">
                                            <option <?= isset($_GET['end_sinyal']) ? "" : "selected"; ?> value="">Semua</option>
                                            <?php while ($option_sinyal = mysqli_fetch_array($ops_sinyal_end)) : ?>
                                                <option <?= isset($_GET['end_sinyal']) && $_GET['end_sinyal'] == $option_sinyal['sinyal'] ? "selected" : ""; ?> value="<?= $option_sinyal['sinyal']; ?>"><?= $option_sinyal['sinyal']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </section>

                                <!-- filter Harga IDR -->
                                <label for="" class="">Filter Harga IDR</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping">from Rp</span>
                                        <input type="number" class="form-control" name="start_harga_idr" value="<?= $_GET['start_harga_idr']; ?>">
                                    </div>

                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to Rp</span>
                                        <input type="number" class="form-control" name="end_harga_idr" value="<?= $_GET['end_harga_idr']; ?>">
                                    </div>
                                </section>
                                <!-- endfilter Harga IDR -->

                                <!-- filter Harga USD -->
                                <label for="" class="">Filter Harga USD $</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping">from $</span>
                                        <input type="number" class="form-control" name="start_harga_usd" value="<?= $_GET['start_harga_usd']; ?>">
                                    </div>

                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to $</span>
                                        <input type="number" class="form-control" name="end_harga_usd" value="<?= $_GET['end_harga_usd']; ?>">
                                    </div>
                                </section>
                                <!-- end fiter Harga USD -->

                                <!-- filter Vol IDR -->
                                <label for="" class="">Filter Volume IDR Rp</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping">from Rp</span>
                                        <input type="number" class="form-control" name="start_vol_idr" value="<?= $_GET['start_vol_idr']; ?>">
                                    </div>

                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to Rp</span>
                                        <input type="number" class="form-control" name="end_vol_idr" value="<?= $_GET['end_vol_idr']; ?>">
                                    </div>
                                </section>
                                <!-- end filter Vol IDR -->

                                <!-- filter Vol USD -->
                                <label for="" class="">Filter Volume USD $</label>
                                <section class="col-12 d-flex">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="addon-wrapping">from $</span>
                                        <input type="number" class="form-control" name="start_vol_usd" value="<?= $_GET['start_vol_usd']; ?>">
                                    </div>

                                    <div class="input-group mb-3 mx-1">
                                        <span class="input-group-text" id="addon-wrapping">to $</span>
                                        <input type="number" class="form-control" name="end_vol_usd" value="<?= $_GET['end_vol_usd']; ?>">
                                    </div>
                                </section>
                                <!-- end filter Vol USD -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">GO</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- pencarian -->
            <form action="" method="GET" class="d-flex flex-column col-lg-3 col-md-6 col-sm-12 position-relative">
                <!-- <img src="images/loader.gif" alt="" class="col-2 loader" id="loader" style="display: none;"> -->
                <div class="d-flex ">
                    <input class="form-control me-2" id="keysearch" type="text" name="keysearch" placeholder="<?= isset($_GET['id']) ? "id = " . $_GET['id'] : "Cari id/level/jenis"; ?>" size="10" autofocus aria-label="Search" autocomplete="off">
                    <button class="btn btn-outline-success" id="button-search" type="submit"><i class="bi bi-search"></i></button>
                </div>
                <div class="card" style="position:absolute;top:45px; display: none;" id="box-autocomplete">
                    <div class="card-body" id="body-autocomplete">
                    </div>
                </div>
            </form>
        </div>



        <div class="col-12">

            <div class="table-responsive" id="table">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary text-light text-center">
                            <th>ID</th>
                            <th>Sinyal</th>
                            <th>Level</th>
                            <th>Tanggal dan Waktu</th>
                            <th>Harga Rp.</th>
                            <th>Harga USDT</th>
                            <th>Vol BTC</th>
                            <th>Vol Rp.</th>
                            <th>Last Buy</th>
                            <th>Last Sell</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        <?php while ($user_data = mysqli_fetch_array($showData)) : ?>
                            <?php $konter = $user_data['sinyal']; ?>

                            <tr>
                                <?php
                                $hrgidr = number_format($user_data['hargaidr']);
                                $hrgusdt = number_format($user_data['hargausdt']);
                                $vidr = number_format($user_data['volidr'], 8, ",", ".");
                                $vusdt = number_format($user_data['volusdt']);
                                $lbuy = number_format($user_data['lastbuy']);
                                $lsell = number_format($user_data['lastsell']);
                                ?>

                                <?php if ($konter >= 120) : ?>
                                    <th scope="row" style="background-color: #FF0000 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #FF0000 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #FF0000 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #FF0000 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #FF0000 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #FF0000 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #FF0000 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #FF0000 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #FF0000 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #FF0000 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 111) : ?>
                                    <th scope="row" style="background-color: #FF4500 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #FF4500 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #FF4500 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #FF4500 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #FF4500 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #FF4500 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #FF4500 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #FF4500 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #FF4500 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #FF4500 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 101) : ?>
                                    <th scope="row" style="background-color: #FFA500 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #FFA500 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #FFA500 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #FFA500 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #FFA500 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #FFA500 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #FFA500 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #FFA500 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #FFA500 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #FFA500 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 91) : ?>
                                    <th scope="row" style="background-color: #E52A2A ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #E52A2A ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #E52A2A ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #E52A2A ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #E52A2A ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #E52A2A ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #E52A2A ;"><?= $vidr; ?></td>
                                    <td style="background-color: #E52A2A ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #E52A2A ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #E52A2A ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 81) : ?>
                                    <th scope="row" style="background-color: #F20082 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #F20082 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #F20082 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #F20082 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #F20082 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #F20082 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #F20082 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #F20082 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #F20082 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #F20082 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 71) : ?>
                                    <th scope="row" style="background-color: #DC5C5C ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #DC5C5C ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #DC5C5C ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #DC5C5C ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #DC5C5C ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #DC5C5C ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #DC5C5C ;"><?= $vidr; ?></td>
                                    <td style="background-color: #DC5C5C ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #DC5C5C ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #DC5C5C ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 61) : ?>
                                    <th scope="row" style="background-color: #FF69B4 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #FF69B4 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #FF69B4 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #FF69B4 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #FF69B4 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #FF69B4 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #FF69B4 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #FF69B4 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #FF69B4 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #FF69B4 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 51) : ?>
                                    <th scope="row" style="background-color: #F08080 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #F08080 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #F08080 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #F08080 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #F08080 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #F08080 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #F08080 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #F08080 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #F08080 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #F08080 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 41) : ?>
                                    <th scope="row" style="background-color: #FFA07A ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #FFA07A ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #FFA07A ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #FFA07A ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #FFA07A ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #FFA07A ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #FFA07A ;"><?= $vidr; ?></td>
                                    <td style="background-color: #FFA07A ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #FFA07A ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #FFA07A ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 31) : ?>
                                    <th scope="row" style="background-color: #9370D8 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #9370D8 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #9370D8 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #9370D8 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #9370D8 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #9370D8 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #9370D8 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #9370D8 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #9370D8 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #9370D8 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 21) : ?>
                                    <th scope="row" style="background-color: #BA55D3 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #BA55D3 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #BA55D3 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #BA55D3 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #BA55D3 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #BA55D3 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #BA55D3 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #BA55D3 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #BA55D3 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #BA55D3 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 11) : ?>
                                    <th scope="row" style="background-color: #66CDAA ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #66CDAA ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #66CDAA ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #66CDAA ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #66CDAA ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #66CDAA ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #66CDAA ;"><?= $vidr; ?></td>
                                    <td style="background-color: #66CDAA ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #66CDAA ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #66CDAA ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php elseif ($konter >= 1) : ?>
                                    <th scope="row" style="background-color: #32CD32 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #32CD32 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #32CD32 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #32CD32 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #32CD32 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #32CD32 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #32CD32 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #32CD32 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #32CD32 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #32CD32 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php else : ?>
                                    <th scope="row" style="background-color: #00FF00 ;"><?= $user_data['id']; ?></th>
                                    <td style="background-color: #00FF00 ;"><?= $user_data['sinyal']; ?></td>
                                    <td style="background-color: #00FF00 ;"><?= $user_data['level']; ?></td>
                                    <td style="background-color: #00FF00 ;"><?= $user_data['tanggal']; ?></td>
                                    <td style="background-color: #00FF00 ;">Rp<?= $hrgidr; ?></td>
                                    <td style="background-color: #00FF00 ;">$<?= $hrgusdt; ?></td>
                                    <td style="background-color: #00FF00 ;"><?= $vidr; ?></td>
                                    <td style="background-color: #00FF00 ;"><?= $vusdt; ?></td>
                                    <td style="background-color: #00FF00 ;">Rp<?= $lbuy; ?></td>
                                    <td style="background-color: #00FF00 ;">Rp<?= $lsell; ?></td>

                                    <?php if ($user_data['jenis'] == 'crash') : ?>
                                        <td style="background-color: red;"><?= $user_data['jenis']; ?></td>
                                    <?php elseif ($user_data['jenis'] == 'moon') : ?>
                                        <td style="background-color: green;"><?= $user_data['jenis']; ?></td>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <p>Data ditemukan = <?= $total_data; ?></p>
            </div>
        </div>

    </div>

    <script src="js/script.js?id=1"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>