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
            <a href="<?= base_url() ?>pembiayaan" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></a>
            <h1 class="ml-2">Pembiayaan</h1>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pembiayaan">Pembiayaan</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <?php foreach($data as $d): ?>

        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail Pembiayaan</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>ID Pembiayaan</h5>
                            <h6><?= $d->pembiayaan_id ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Kategori Biaya</h5>
                            <h6><?= $d->katbiaya_nama; ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Beban Biaya</h5>
                            <h6
                                class="badge <?= $d->pembiayaan_beban_biaya == 'Project' ? "badge-success" : "badge-primary" ?>">
                                <?= $d->pembiayaan_beban_biaya ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Tanggal</h5>
                            <h6><?= tglIndo($d->pembiayaan_tgl); ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nilai Realisasi</h5>
                            <?php $number = ""; if (strpos($d->pembiayaan_nilai_realisasi, ',') !== false) {
                                    $exp = explode(",", $d->pembiayaan_nilai_realisasi);
                                    // $number = "". $field->pembiayaan_nilai_realisasi;

                                    $number = "Rp". number_format($exp[0],0,',','.') . "," . $exp[1];
                                }else{
                                    $number = "Rp" . number_format($d->pembiayaan_nilai_realisasi,0,',','.');
                                    // $number = "". $field->pembiayaan_nilai_realisasi;
                                } ?> 
                            <h6><?= $number ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="mr-5">Keterangan</h5>
                            <h6><?= $d->pembiayaan_ket == "" ? "<i>(Tidak ada keterangan)</i>" : $d->pembiayaan_ket ?>
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">User Input</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Input</h5>
                            <h6><?= tglIndo($d->pembiayaan_tgl_input); ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nama User</h5>
                            <h6><?= $d->user_nmlengkap; ?></h6>
                        </div>
                    </div>
                </div>

                <?php if($d->project_id != ''): ?>

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
                            <h5 class="mr-4">Nama Project</h5>
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
                <?php endif; ?>

            </div>
        </div>

        <?php endforeach; ?>

    </div>

</section>