<?php
session_start();
$_SESSION['page'] = 'chart';
$_SESSION['pages'] = 'chart_level';

include_once("components/headhtml.php");
include_once("function/query.php");
$ops_jenis = getJenis();
?>

<body class="g-sidenav-show  bg-gray-200">
    <!-- sidebar kiri -->
    <?php include_once("components/sidebar.php"); ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include_once("components/navbar.php") ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4 mb-5">


            <!-- Chart info -->

            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Level BTC</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <canvas id="level"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <?php include_once("components/footer.php") ?>
        </div>
    </main>



    <!-- chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="chart.js?"></script> -->
    <?php include_once("components/chart/chart_level.php"); ?>




    <!--   Core JS Files   -->
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.min.js?v=3.0.2"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>