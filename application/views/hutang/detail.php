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
            <a href="<?= base_url() ?>hutang" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></a>
            <h1 class="ml-2">Hutang</h1>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>hutang">Hutang</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <?php foreach($data as $d): ?>

        <?php if($d->hutang_kategori == 'bank'): ?>

        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail Hutang Bank</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>ID Hutang</h5>
                            <h6><?= $d->hutang_id ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Bank / Leasing</h5>
                            <h6><?= $d->hutang_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Produk Pembiayaan</h5>
                            <h6><?= $d->hutang_jenis ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nilai Hutang</h5>
                            <?php 
                                 if($d->hutang_nilai == ''){
                                    $nilai = "Rp0";
                                    }else{
                                        if (strpos($d->hutang_nilai, ',') !== false) {
                                            $exp1 = explode(",", $d->hutang_nilai);
                            
                                            $nilai = "Rp". number_format($exp1[0],0,',','.') . "," . $exp1[1];
                                        }else{
                                            $nilai = "Rp" . number_format($d->hutang_nilai,0,',','.');
                                        }
                                    }
                                ?>
                            <h6><?= $nilai ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Cicilan</h5>
                            <h6><?= number_format($d->hutang_cicilan,0,",",".") ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Tanggal start</h5>
                            <h6><?= tglIndo($d->hutang_tgl_start) ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Finish</h5>
                            <h6><?= tglIndo($d->hutang_tgl_finish) ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Project</h4>
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
                    </div>
                </div>
            </div>

        </div>

        <?php else: ?>

        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail Hutang Bank</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>ID Hutang</h5>
                            <h6><?= $d->hutang_id ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Vendor</h5>
                            <h6><?= $d->vendor_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nilai Hutang</h5>
                            <h6><?= number_format($d->hutang_nilai,0,",",".") ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Jatuh Tempo Finish</h5>
                            <h6><?= tglIndo($d->hutang_tgl_finish) ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Project</h4>
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
                    </div>
                </div>
            </div>

        </div>

    </div>


    <?php endif; ?>

    <?php endforeach; ?>

    </div>

</section>