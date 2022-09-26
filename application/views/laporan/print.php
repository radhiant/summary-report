<section class="section">

    <div class="section-body">

        <div class="col-lg-12 col-md-12 col-12 col-sm-12 mt-4 mb-5">
            <div class="d-flex">
                <img class="mr-3 rounded" width="100" src="<?= base_url() ?>assets/icon/logoBKU-circle.png">
                <div>
                    <h1>PT Bintang Komunikasi Utama</h1>
                    <h4><?= $bulan ?> - <?= $tahun ?></h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2>Pendapatan</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <?php  $totalP = $pSewa + $pJual + $pLain; ?>
                        <div class="d-flex justify-content-between">
                            <h5><b>1. Pemerintahan</b></h5>
                            <h5>Rp <?= number_format($totalP,0,",",".") ?></h5>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>Rp <?= number_format($pSewa,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>Rp <?= number_format($pJual,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>Rp <?= number_format($pLain,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <br>

                        <div class="d-flex justify-content-between">
                            <?php  $totalS = $sSewa + $sJual + $sRepair + $sLain; ?>
                            <h5><b>2. Swasta</b></h5>
                            <h5>Rp <?= number_format($totalS,0,",",".") ?></h5>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>Rp <?= number_format($sSewa,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>Rp <?= number_format($sJual,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Repair</h5>
                            <h5>Rp <?= number_format($sRepair,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>Rp <?= number_format($sLain,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <?php  $totalK = $totalP + $totalS; ?>
                            <h5><b>TOTAL PENDAPATAN</b></h5>
                            <h5><b>Rp <?= number_format($totalK,0,",",".") ?></b></h5>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Pembiayaan</h2>
                    </div>
                    <div class="card-body">
                        <?php  $totalPP = $ppSewa + $ppJual + $ppLain; ?>
                        <div class="d-flex justify-content-between">
                            <h5><b>1. Pemerintahan</b></h5>
                            <h5>Rp <?= number_format($totalPP,0,",",".") ?></h5>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>Rp <?= number_format($ppSewa,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>Rp <?= number_format($ppJual,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>Rp <?= number_format($ppLain,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <br>

                        <div class="d-flex justify-content-between">
                            <?php  $totalSS = $ssSewa + $ssJual + $ssRepair + $ssLain; ?>
                            <h5><b>2. Swasta</b></h5>
                            <h5>Rp <?= number_format($totalSS,0,",",".") ?></h5>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>Rp <?= number_format($ssSewa,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>Rp <?= number_format($ssJual,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Repair</h5>
                            <h5>Rp <?= number_format($ssRepair,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>Rp <?= number_format($ssLain,0,",",".") ?></h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <?php  $totalKK = $totalPP + $totalSS ?>
                            <h5><b>TOTAL PEMBIAYAAN</b></h5>
                            <h5><b>Rp <?= number_format($totalKK,0,",",".") ?></b></h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <div class="d-flex justify-content-between">
                            <?php  $totalKabeh = $totalK - $totalKK; ?>
                            <h4><b>MARGIN +/-</b></h4>
                            <h4><b>Rp <?= number_format($totalKabeh ,0,",",".") ?></b></h4>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>