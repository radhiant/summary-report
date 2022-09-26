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
            <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2>Pendapatan</h2>
                        <hr>
                    </div>
                    <div class="card-body">

                        <div class=" d-flex justify-content-between">
                            <div class="d-flex">
                                <img class="mr-3 rounded" width="55"
                                    src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png" alt="product">
                                <h5 class="mt-3">PENDAPATAN</h5>
                            </div>

                            <h5 class="mt-3">Rp <?= number_format($pendapatan,0,',','.') ?></h5>
                        </div>

                        <hr class="mt-4">

                        <div class=" d-flex justify-content-between">
                            <div class="d-flex">
                                <img class="mr-3 rounded" width="55"
                                    src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png" alt="product">
                                <h5 class="mt-3">PEMBIAYAAN INVESTASI</h5>
                            </div>

                            <h5 class="mt-3">Rp <?= number_format($investasi,0,',','.') ?></h5>
                        </div>

                        <hr class="mt-4">

                        <div class=" d-flex justify-content-between">
                            <div class="d-flex">
                                <img class="mr-3 rounded" width="55"
                                    src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png" alt="product">
                                <h6 class="mt-3">PEMBIAYAAN NON INVESTASI</h6>
                            </div>

                            <h5 class="mt-3">Rp <?= number_format($nonprojek,0,',','.') ?></h5>
                        </div>

                        <hr class="mt-4">

                        <div class="d-flex justify-content-between mb-2">
                            <h3 class="mt-3"><b>TOTAL</b></h3>
                            <h3 class="mt-3">Rp <?= number_format($ttl,0,',','.') ?></h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Hutang Piutang</h2>
                    </div>
                    <div class="card-body">

                        <div class=" d-flex justify-content-between">
                            <div class="d-flex">
                                <img class="mr-3 rounded" width="55"
                                    src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png" alt="product">
                                <h5 class="mt-3">HUTANG</h5>
                            </div>

                            <h5 class="mt-3">Rp <?= number_format($totalHutang,0,',','.') ?></h5>
                        </div>

                        <hr class="mt-4">

                        <div class=" d-flex justify-content-between">
                            <div class="d-flex">
                                <img class="mr-3 rounded" width="55"
                                    src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png" alt="product">
                                <h5 class="mt-3">PIUTANG</h5>
                            </div>

                            <h5 class="mt-3">Rp <?= number_format($piutang,0,',','.') ?></h5>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</section>