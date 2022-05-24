<!-- chart 3 -->

<div class="col-12 mb-5">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Chart Filter by Jenis & Date Picker</h6>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="" method="get">
                    <label for="" class="">Filter Jenis</label>
                    <div class="col-12">
                        <section class="col-8 ">
                            <select class="form-select select-group select-group-outline" aria-label="Default select example" name="jenis">
                                <option <?= isset($_GET['jenis']) ? "" : "selected"; ?> value="">Semua</option>
                                <?php while ($option_jenis = mysqli_fetch_array($ops_jenis)) : ?>
                                    <option <?= isset($_GET['jenis']) && $_GET['jenis'] == $option_jenis['jenis'] ? "selected" : ""; ?> value="<?= $option_jenis['jenis']; ?>"><?= $option_jenis['jenis']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </section>

                        <input type="hidden" name="filter" value="true">
                        <label for="">Filter Tanggal</label>
                        <section class="col-8 d-flex">
                            <div class="input-group input-group-text mb-3">
                                <span class="input-group-text" id="addon-wrapping">from</span>
                                <input type="hidden" name="halaman" value="1">
                                <input type="date" class="form-control" name="start_date" value="<?= $_GET['start_date']; ?>">
                            </div>
                            <div class="input-group mb-3 mx-1">
                                <span class="input-group-text" id="addon-wrapping">to</span>
                                <input type="date" class="form-control" name="end_date" value="<?= $_GET['end_date']; ?>">
                            </div>
                        </section>



                        <div class="col-4">
                            <button type="submit" class="btn btn-info mx-1">GO</button>
                        </div>
                    </div>



                </form>
            </div>
            <div>
                <canvas id="chart_datePicker"></canvas>
            </div>
        </div>
    </div>
</div>