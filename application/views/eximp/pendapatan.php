<section class="section">
    <div class="section-header">
        <h1>Export Import</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>eximp">Export Import</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

    <div class="row mb-4">
            <div class="col-lg-12">
                <a href="<?= base_url() ?>eximp" class="btn btn-outline-primary shadow rounded">Pembiayaan</a>
                <a href="<?= base_url() ?>eximpendapatan" class="btn btn-primary shadow rounded">Pendapatan</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembiayaan</h4>
                        <div class="card-header-action">
                        <a href="#" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary"><i class="fas fa-file-import"></i> Import Data</a>
                        <a href="<?= base_url() ?>eximp/exportPendapatan" class="btn btn-success"><i class="fas fa-file-export"></i> Export Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Projek id</th>
                                        <th>Periode</th>
                                        <th>Penagihan</th>
                                        <th>Tempo</th>
                                        <th>Tagihan</th>
                                        <th>Ket</th>
                                        <th>jml bayar</th>
                                        <th>Tgl Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $d): ?>
                                        <tr>
                                            <td><?= $d->pendapatan_id ?></td>
                                            <td><?= $d->project_id ?></td>
                                            <td><?= $d->pendapatan_periode ?></td>
                                            <td><?= $d->pendapatan_tgl_penagihan ?></td>
                                            <td><?= $d->pendapatan_tgl_tempo ?></td>
                                            <td><?= $d->pendapatan_jml_tagihan ?></td>
                                            <td><?= $d->pendapatan_ket ?></td>
                                            <td><?= $d->pendapatan_jml_bayar ?></td>
                                            <td><?= $d->pendapatan_tgl_bayar ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>