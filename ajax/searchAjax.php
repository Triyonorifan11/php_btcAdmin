<?php
require '../koneksi.php';
require '../function/query.php';
require '../function/pagination.php';

$keysearch = $_GET["keysearch"];

$query = "SELECT * FROM btc WHERE id LIKE '%$keysearch%' OR
                              sinyal LIKE '%$keysearch%' OR
                              tanggal LIKE '%$keysearch%' OR
                              hargaidr LIKE '%$keysearch%' OR
                              hargausdt LIKE '%$keysearch%' OR
                              volidr LIKE '%$keysearch%' OR
                              volusdt LIKE '%$keysearch%' OR
                              lastbuy LIKE '%$keysearch%' OR
                              lastsell LIKE '%$keysearch%' OR
                              jenis LIKE '%$keysearch%' OR";

// $showData = query($query);
$showData = mysqli_query($mysqli, $query);
// $btc = query($query);
var_dump($showData);

?>

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
    <tbody>
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
                    <td style="background-color: #FF0000 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #FF0000 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #FF0000 ;"><?= $vidr; ?></td>
                    <td style="background-color: #FF0000 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #FF0000 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #FF0000 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #FF4500 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #FF4500 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #FF4500 ;"><?= $vidr; ?></td>
                    <td style="background-color: #FF4500 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #FF4500 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #FF4500 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #FFA500 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #FFA500 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #FFA500 ;"><?= $vidr; ?></td>
                    <td style="background-color: #FFA500 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #FFA500 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #FFA500 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #E52A2A ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #E52A2A ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #E52A2A ;"><?= $vidr; ?></td>
                    <td style="background-color: #E52A2A ;"><?= $vusdt; ?></td>
                    <td style="background-color: #E52A2A ;"><?= $lbuy; ?></td>
                    <td style="background-color: #E52A2A ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #F20082 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #F20082 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #F20082 ;"><?= $vidr; ?></td>
                    <td style="background-color: #F20082 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #F20082 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #F20082 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #DC5C5C ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #DC5C5C ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #DC5C5C ;"><?= $vidr; ?></td>
                    <td style="background-color: #DC5C5C ;"><?= $vusdt; ?></td>
                    <td style="background-color: #DC5C5C ;"><?= $lbuy; ?></td>
                    <td style="background-color: #DC5C5C ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #FF69B4 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #FF69B4 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #FF69B4 ;"><?= $vidr; ?></td>
                    <td style="background-color: #FF69B4 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #FF69B4 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #FF69B4 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #F08080 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #F08080 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #F08080 ;"><?= $vidr; ?></td>
                    <td style="background-color: #F08080 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #F08080 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #F08080 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #FFA07A ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #FFA07A ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #FFA07A ;"><?= $vidr; ?></td>
                    <td style="background-color: #FFA07A ;"><?= $vusdt; ?></td>
                    <td style="background-color: #FFA07A ;"><?= $lbuy; ?></td>
                    <td style="background-color: #FFA07A ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #9370D8 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #9370D8 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #9370D8 ;"><?= $vidr; ?></td>
                    <td style="background-color: #9370D8 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #9370D8 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #9370D8 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #BA55D3 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #BA55D3 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #BA55D3 ;"><?= $vidr; ?></td>
                    <td style="background-color: #BA55D3 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #BA55D3 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #BA55D3 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #66CDAA ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #66CDAA ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #66CDAA ;"><?= $vidr; ?></td>
                    <td style="background-color: #66CDAA ;"><?= $vusdt; ?></td>
                    <td style="background-color: #66CDAA ;"><?= $lbuy; ?></td>
                    <td style="background-color: #66CDAA ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #32CD32 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #32CD32 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #32CD32 ;"><?= $vidr; ?></td>
                    <td style="background-color: #32CD32 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #32CD32 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #32CD32 ;"><?= $lsell; ?></td>

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
                    <td style="background-color: #00FF00 ;"><?= $hrgidr; ?></td>
                    <td style="background-color: #00FF00 ;"><?= $hrgusdt; ?></td>
                    <td style="background-color: #00FF00 ;"><?= $vidr; ?></td>
                    <td style="background-color: #00FF00 ;"><?= $vusdt; ?></td>
                    <td style="background-color: #00FF00 ;"><?= $lbuy; ?></td>
                    <td style="background-color: #00FF00 ;"><?= $lsell; ?></td>

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