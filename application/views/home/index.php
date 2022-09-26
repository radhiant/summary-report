<section class="section">
    <div class="section-header">
        <h1>Home</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>home">Home</a></div>
            <div class="breadcrumb-item">Dashboard</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animate__bounceIn">
                    <div class="card-icon bg-success">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Project</h4>
                        </div>
                        <div class="card-body">
                            <?= $project ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animate__bounceIn">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Customer</h4>
                        </div>
                        <div class="card-body">
                            <?= $customer ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animate__bounceIn">
                    <div class="card-icon bg-info">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Vendor</h4>
                        </div>
                        <div class="card-body">
                            <?= $vendor ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1 animate__bounceIn">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>User</h4>
                        </div>
                        <div class="card-body">
                            <?= $user ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                <form action="<?= base_url() ?>home/indexPrint" method="POST"  target="_blank">
                    <div class="card animate__bounceIn" id="pendapatan">
                        <div class="card-header">

                            <h4>Pendapatan</h4>
                            <div class="card-header-action dropdown">
                                <input type="hidden" id="bln" name="bln">
                                <input type="hidden" id="thn" name="thn" value="<?= $yearnow ?>">
                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"
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
                                            onclick="mart()">Maret</a></li>
                                    <li><a href="javascript:void(0);" id="apr" class="dropdown-item"
                                            onclick="apr()">April</a></li>
                                    <li><a href="javascript:void(0);" id="may" class="dropdown-item"
                                            onclick="may()">Mei</a>
                                    </li>
                                    <li><a href="javascript:void(0);" id="jun" class="dropdown-item"
                                            onclick="jun()">Juni</a></li>
                                    <li><a href="javascript:void(0);" id="jul" class="dropdown-item"
                                            onclick="jul()">Juli</a></li>
                                    <li><a href="javascript:void(0);" id="agus" class="dropdown-item"
                                            onclick="agus()">Agustus</a></li>
                                    <li><a href="javascript:void(0);" id="sep" class="dropdown-item"
                                            onclick="sep()">September</a>
                                    </li>
                                    <li><a href="javascript:void(0);" id="oct" class="dropdown-item"
                                            onclick="oct()">Oktober</a></li>
                                    <li><a href="javascript:void(0);" id="nov" class="dropdown-item"
                                            onclick="nov()">November</a>
                                    </li>
                                    <li><a href="javascript:void(0);" id="dec" class="dropdown-item"
                                            onclick="dec()">Desember</a>
                                    </li>
                                    <li><a href="javascript:void(0);" class="dropdown-item" onclick="reset()">Reset</a>
                                    </li>
                                </ul>

                                <div class="dropdown d-inline mr-2 ml-1">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="tahun"
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

                                <button type="submit" class="btn btn-primary">Print <i class="fas fa-print"></i></button>

                            </div>

                        </div>
                        <div class="card-body">

                            <div class="summary">
                                <div class="summary-item">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <img class="mr-3 rounded" width="50"
                                                src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png"
                                                alt="product">
                                            <div class="media-body ">
                                                <div class="media-right mt-3 d-flex">Rp <div class="ml-1"
                                                        id="npendapatan">0
                                                    </div>
                                                </div>
                                                <div class="media-title mt-3">PENDAPATAN</div>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <img class="mr-3 rounded" width="50"
                                                src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png"
                                                alt="product">
                                            <div class="media-body ">
                                                <div class="media-right mt-3 d-flex">Rp <div class="ml-1" id="npi">0
                                                    </div>
                                                </div>
                                                <div class="media-title mt-3">PEMBIAYAAN INVESTASI</div>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <img class="mr-3 rounded" width="50"
                                                src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png"
                                                alt="product">
                                            <div class="media-body ">
                                                <div class="media-right mt-3 d-flex">Rp <div class="ml-1" id="npni">0
                                                    </div>
                                                </div>
                                                <div class="media-title mt-3">PEMBIAYAAN NON INVESTASI</div>
                                            </div>
                                        </li>

                                        <li class="media bg-primary rounded" id="totalCard">

                                            <div class="media-body">
                                                <div class="media-right mr-3 mt-3 mb-3 text-white"><b class="d-flex">Rp
                                                        <div class="ml-1" id="total">0</div>
                                                    </b></div>
                                                <div class="media-title ml-3 mt-3 mb-3 text-white"><b> PROFIT </b></div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



            <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                <div class="card animate__bounceIn">
                    <div class="card-header">
                        <h4>Hutang Piutang</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-item">
                                <ul class="list-unstyled list-unstyled-border">

                                    <li class="media">
                                        <img class="mr-3 rounded" width="50"
                                            src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png"
                                            alt="product">
                                        <div class="media-body ">
                                            <div class="media-right mt-3">Rp
                                                <?= number_format($totalHutang,0,',','.') ?>
                                            </div>
                                            <div class="media-title mt-3">HUTANG</div>
                                        </div>
                                    </li>

                                    <li class="media">
                                        <img class="mr-3 rounded" width="50"
                                            src="<?= base_url() ?>assets/stisla/assets/img/products/rp.png"
                                            alt="product">
                                        <div class="media-body ">
                                            <div class="media-right mt-3">Rp <?= number_format($piutang,0,',','.') ?>
                                            </div>
                                            <div class="media-title mt-3">PIUTANG</div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</section>