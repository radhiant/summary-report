<section class="section">
    <div class="section-header">
        <h1>Laporan Per Kategori</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>laporan">Laporan</a></div>
            <div class="breadcrumb-item">Per Kategori</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>laporan/indexPrint" method="POST" target="_blank">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="d-flex flex-row-reverse">
                        <input type="hidden" id="bln" name="bln">
                        <input type="hidden" id="thn" name="thn" value="<?= $yearnow ?>">

                        <button type="submit" class="btn btn-lg btn-primary">Print <i class="fas fa-print"></i></button>

                        <div class="dropdown d-inline mr-2">
                            <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="tahun"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $yearnow ?>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Pilih Tahun</div>
                                <a class="dropdown-item" id="tya" href="javascript:void(0);"
                                    onclick="tya('<?= $twoyearago ?>')"><?= $twoyearago ?></a>
                                <a class="dropdown-item" id="py" href="javascript:void(0);"
                                    onclick="py('<?= $previousyear ?>')"><?= $previousyear ?></a>
                                <a class="dropdown-item active" id="yn" href="javascript:void(0);"
                                    onclick="yn('<?= $yearnow ?>')"><?= $yearnow ?></a>
                            </div>
                        </div>

                        <div>

                            <a href="#" data-toggle="dropdown" class="btn btn-primary btn-lg dropdown-toggle mr-2"
                                id="bulan">Pilih
                                Bulan</a>
                            <ul class="dropdown-menu dropdown-menu dropdown-menu-right">
                                <li class="dropdown-title">Pilih Bulan</li>
                                <li><a href="javascript:void(0);" id="jan" class="dropdown-item"
                                        onclick="jan()">Januari</a>
                                </li>
                                <li><a href="javascript:void(0);" id="feb" class="dropdown-item"
                                        onclick="feb()">Februari</a>
                                </li>
                                <li><a href="javascript:void(0);" id="mart" class="dropdown-item"
                                        onclick="mart()">Maret</a>
                                </li>
                                <li><a href="javascript:void(0);" id="apr" class="dropdown-item"
                                        onclick="apr()">April</a>
                                </li>
                                <li><a href="javascript:void(0);" id="may" class="dropdown-item" onclick="may()">Mei</a>
                                </li>
                                <li><a href="javascript:void(0);" id="jun" class="dropdown-item"
                                        onclick="jun()">Juni</a>
                                </li>
                                <li><a href="javascript:void(0);" id="jul" class="dropdown-item"
                                        onclick="jul()">Juli</a>
                                </li>
                                <li><a href="javascript:void(0);" id="agus" class="dropdown-item"
                                        onclick="agus()">Agustus</a>
                                </li>
                                <li><a href="javascript:void(0);" id="sep" class="dropdown-item"
                                        onclick="sep()">September</a>
                                </li>
                                <li><a href="javascript:void(0);" id="oct" class="dropdown-item"
                                        onclick="oct()">Oktober</a>
                                </li>
                                <li><a href="javascript:void(0);" id="nov" class="dropdown-item"
                                        onclick="nov()">November</a>
                                </li>
                                <li><a href="javascript:void(0);" id="dec" class="dropdown-item"
                                        onclick="dec()">Desember</a>
                                </li>
                                <li><a href="javascript:void(0);" class="dropdown-item" onclick="reset()">Reset</a>
                                </li>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-lg-6">
                <div class="card" id="pendapatan">
                    <div class="card-header">
                        <h4>Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5><b>1. Pemerintahan</b></h5>
                            <h5>
                                <div id="totalP"></div>
                            </h5>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>
                                <div id="pSewa"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>
                                <div id="pJual"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>
                                <div id="pLain"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <br>

                        <div class="d-flex justify-content-between">
                            <h5><b>2. Swasta</b></h5>
                            <h5>
                                <div id="totalS"></div>
                            </h5>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>
                                <div id="sSewa"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>
                                <div id="sJual"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Repair</h5>
                            <h5>
                                <div id="sRepair"></div>
                            </h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>
                                <div id="sLain"></div>
                            </h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <h5><b>TOTAL PENDAPATAN</b></h5>
                            <h4><b>
                                    <div id="totalK"></div>
                                </b></h4>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card" id="pembiayaan">
                    <div class="card-header">
                        <h4>Pembiayaan</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5><b>1. Pemerintahan</b></h5>
                            <h5>
                                <div id="totalPP"></div>
                            </h5>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>
                                <div id="ppSewa"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">
                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>
                                <div id="ppJual"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>
                                <div id="ppLain"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <br>

                        <div class="d-flex justify-content-between">
                            <h5><b>2. Swasta</b></h5>
                            <h5>
                                <div id="totalSS"></div>
                            </h5>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Sewa</h5>
                            <h5>
                                <div id="ssSewa"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Jual</h5>
                            <h5>
                                <div id="ssJual"></div>
                            </h5>
                        </div>
                        <hr class="ml-5">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Repair</h5>
                            <h5>
                                <div id="ssRepair"></div>
                            </h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <h5 class="ml-5">Lain-lain</h5>
                            <h5>
                                <div id="ssLain"></div>
                            </h5>
                        </div>
                        <hr class="ml-5 mb-4">

                        <div class="d-flex justify-content-between">
                            <h5><b>TOTAL PEMBIAYAAN</b></h5>
                            <h4><b>
                                    <div id="totalKK"></div>
                                </b></h4>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-3">
                            <h4><b>MARGIN +/-</b></h4>
                            <h4><b>
                                    <div id="totalKabeh"></div>
                                </b></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>