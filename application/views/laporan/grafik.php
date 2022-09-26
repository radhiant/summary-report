<section class="section">
    <div class="section-header">
        <h1>Laporan Grafik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>grafik">Laporan</a></div>
            <div class="breadcrumb-item">Grafik</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="cardLine">
                    <div class="card-header">
                        <h4>Pendapatan vs Pembiayaan</h4>
                        <div class="card-header-action dropdown">
                            <input type="hidden" id="thn" value="<?= $yearnow ?>">
                            <input type="hidden" id="type" value="line">
                            <div class="dropdown d-inline mr-2">
                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="typee"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Line
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-title">Pilih Type Grafik</div>
                                    <a class="dropdown-item active" id="lineG" href="javascript:void(0);"
                                        onclick="lineG()">Line</a>
                                    <a class="dropdown-item" id="barG" href="javascript:void(0);"
                                        onclick="barG()">Bar</a>
                                </div>
                            </div>

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
                        </div>
                    </div>
                    <div class="card-body p-2" id="cardChart">
                        <canvas id="myChart" height="450"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>