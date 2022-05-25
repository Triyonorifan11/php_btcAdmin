<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="dashboard.php" target="_blank">
            <img src="assets/img/icons/Bitcoin-BTC-icon.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">BTC SINYAL</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white <?= $_SESSION['page'] === 'dashboard' ? 'active bg-gradient-warning' : '' ?>  " href="dashboard.php" id="link_active">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $_SESSION['page'] === 'table' ? 'active bg-gradient-warning' : '' ?> text-white " href="table.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $_SESSION['page'] === 'chart' ? 'active bg-gradient-warning' : '' ?> text-white " href="chart.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-symbols-rounded">
                            monitoring
                        </span>
                    </div>
                    <span class="nav-link-text ms-1">Chart</span>
                </a>
                <?php if ($_SESSION['page'] == 'chart') : ?>
                    <ul class="nav-item mb-1 mt-1">
                        <a class="nav-link <?= $_SESSION['page'] === 'chart' && $_SESSION['pages'] === 'chart_level' ? 'active bg-gradient-secondary' : '' ?> text-white " href="chart.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <span class="material-symbols-rounded">
                                    monitoring
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Chart 1</span>
                        </a>
                    </ul>

                    <ul class="nav-item mb-1">
                        <a class="nav-link <?= $_SESSION['page'] === 'chart' && $_SESSION['pages'] === 'chart_level_filter' ? 'active bg-gradient-secondary' : '' ?> text-white " href="chart2.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <span class="material-symbols-rounded">
                                    monitoring
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Chart 2</span>
                        </a>
                    </ul>

                    <ul class="nav-item mb-1">
                        <a class="nav-link <?= $_SESSION['page'] === 'chart' && $_SESSION['pages'] === 'chart_date_filter' ? 'active bg-gradient-secondary' : '' ?> text-white " href="chart3.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <span class="material-symbols-rounded">
                                    monitoring
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Chart 3</span>
                        </a>
                    </ul>

                    <ul class="nav-item mb-1">
                        <a class="nav-link <?= $_SESSION['page'] === 'chart' && $_SESSION['pages'] === 'chart_4' ? 'active bg-gradient-secondary' : '' ?> text-white " href="chart4.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <span class="material-symbols-rounded">
                                    monitoring
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Chart 4</span>
                        </a>
                    </ul>

                    <ul class="nav-item mb-1">
                        <a class="nav-link <?= $_SESSION['page'] === 'chart' && $_SESSION['pages'] === 'chart_5' ? 'active bg-gradient-secondary' : '' ?> text-white " href="chart5.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <span class="material-symbols-rounded">
                                    monitoring
                                </span>
                            </div>
                            <span class="nav-link-text ms-1">Chart 5</span>
                        </a>
                    </ul>
                <?php endif; ?>

            </li>

        </ul>
    </div>

</aside>