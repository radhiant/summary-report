<section class="section">
    <div class="section-header">
        <h1>Laporan Estimasi Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>grafik">Laporan</a></div>
            <div class="breadcrumb-item">Estimasi Pendapatan</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data</h4>
                        <div class="card-header-action dropdown">
                            <input type="hidden" id="thn" value="<?= $yearnow ?>">

                            <a href="#" class="btn btn-primary mr-1">Tambah
                                <i class="fas fa-plus"></i></a>

                            <div class="dropdown d-inline mr-1">
                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="tahun"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $tahun ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-title">Pilih Tahun</div>
                                    <a class="dropdown-item <?= $tahun == $twoyearago ? 'active' : '' ?>" id="tya"
                                        href="javascript:void(0);"
                                        onclick="tya('<?= $twoyearago ?>')"><?= $twoyearago ?></a>
                                    <a class="dropdown-item <?= $tahun == $previousyear ? 'active' : '' ?>" id="py"
                                        href="javascript:void(0);"
                                        onclick="py('<?= $previousyear ?>')"><?= $previousyear ?></a>
                                    <a class="dropdown-item <?= $tahun == $yearnow ? 'active' : '' ?>" id="yn"
                                        href="javascript:void(0);" onclick="yn('<?= $yearnow ?>')"><?= $yearnow ?></a>
                                </div>
                            </div>

                            <a href="javascript:void(0);" onclick="filter()" class="btn btn-success mr-1">Filter <i
                                    class="fas fa-filter"></i></a>
                            <a href="<?= base_url() ?>estPendapatan" onclick="reset()" class="btn btn-danger ">Reset <i
                                    class="fas fa-undo"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap">
                                <tr>
                                    <th>Project</th>
                                    <th>Customer</th>
                                    <th>Januari</th>
                                    <th>Februari</th>
                                    <th>Maret</th>
                                    <th>April</th>
                                    <th>Mei</th>
                                    <th>Juni</th>
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                </tr>
                                <tbody>
                                    <?php foreach($project as $d): ?>
                                    <tr>
                                        <td><?= $d->project_nama ?></td>
                                        <td><?= $d->customer_nama ?></td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                        <td>Rp 0</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="bg-success">
                                            <center>
                                                <h5 class="text-white">Jumlah</h5>
                                            </center>
                                        </th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                        <th class="bg-secondary">Rp 0</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>