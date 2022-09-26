<?php

function tglIndo($tgl)
{
    $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
    $split = explode('-', $tgl);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

?>
<section class="section">
    <div class="section-header">
        <div class="d-flex">
            <a href="<?= base_url() ?>project" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></a>
            <h1 class="ml-2">Project</h1>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>project">Project</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <?php foreach($data as $d): ?>

        <div class="row">

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail Project</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>ID Project</h5>
                            <h6><?= $d->project_id ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nama Project</h5>
                            <h6><?= $d->project_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Layanan</h5>
                            <?php if($d->project_layanan == 'Sewa'): ?>
                            <h6 class="badge badge-primary"><?= $d->project_layanan ?></h6>
                            <?php elseif($d->project_layanan == 'Jual'): ?>
                            <h6 class="badge badge-success"><?= $d->project_layanan ?></h6>
                            <?php elseif($d->project_layanan == 'Repair'): ?>
                            <h6 class="badge badge-warning"><?= $d->project_layanan ?></h6>
                            <?php elseif($d->project_layanan == 'Lain-lain'): ?>
                            <h6 class="badge badge-info"><?= $d->project_layanan ?></h6>
                            <?php else: ?>
                            <h6 class="badge badge-secondary"><?= $d->project_layanan ?></h6>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nilai Kontrak</h5>
                            <h6><?= number_format($d->project_kontrak_nilai,0,",",".") ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Kontrak Start</h5>
                            <h6><?= tglIndo($d->project_kontrak_start); ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Kontrak End</h5>
                            <h6><?= tglIndo($d->project_kontrak_end); ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Status</h5>
                            <h6>
                                <?php if($d->project_kontrak_end > date('Y-m-d')): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php elseif($d->project_kontrak_end < date('Y-m-d')): ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Null</span>
                                <?php endif; ?>
                            </h6>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Customer</h4>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h5>ID Customer</h5>
                            <h6><?= $d->customer_id ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Nama Customer</h5>
                            <h6><?= $d->customer_nama ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Kategori</h5>
                            <?php if($d->customer_kategori == 'Pemerintahan'): ?>
                            <h6 class="badge badge-primary"><?= $d->customer_kategori ?></h6>
                            <?php elseif($d->customer_kategori == 'Swasta'): ?>
                            <h6 class="badge badge-success"><?= $d->customer_kategori ?></h6>
                            <?php else: ?>
                            <h6 class="badge badge-secondary"><?= $d->customer_kategori ?></h6>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>