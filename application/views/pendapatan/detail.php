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
            <a href="<?= base_url() ?>pendapatan" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></a>
            <h1 class="ml-2">Pendapatan</h1>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pendapatan">Pendapatan</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <?php foreach($data as $d): ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail Pendapatan</h4>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h5>ID Pendapatan</h5>
                            <h6><?= $d->pendapatan_id ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Periode</h5>
                            <h6><?= $d->pendapatan_periode == "" ? "-" : $d->pendapatan_periode ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Penagihan</h5>
                            <h6><?= tglIndo($d->pendapatan_tgl_penagihan); ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Tempo</h5>
                            <h6><?= tglIndo($d->pendapatan_tgl_tempo); ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Jumlah Tagihan</h5>
                            <h6>
                            <?php if($d->pendapatan_jml_tagihan == "" || $d->pendapatan_jml_tagihan == null){
                                        $jmltagihan = "Rp0";
                                    }else{
                                        if (strpos($d->pendapatan_jml_tagihan, ',') !== false) {
                                            $exp = explode(",", $d->pendapatan_jml_tagihan);

                                            $jmltagihan = "Rp". number_format($exp[0],0,',','.') . "," . $exp[1];
                                        }else{
                                            $jmltagihan = "Rp" . number_format($d->pendapatan_jml_tagihan,0,',','.');
                                        }
                                    } ?>
                            <?= $jmltagihan ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="mr-4">Keterangan</h5>
                            <h6><?= $d->pendapatan_ket == "" ? "<i>(Tidak ada keterangan)</i>" : $d->pendapatan_ket ?>
                            </h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Jumlah dibayarkan</h5>
                            <?php if (strpos($d->pendapatan_jml_bayar, ',') !== false) {
                                $exp2 = explode(",", $d->pendapatan_jml_bayar);
                
                                $jmlbayar = "Rp". number_format($exp2[0],0,',','.') . "," . $exp2[1];
                            }else{
                                $jmlbayar = "Rp" . number_format($d->pendapatan_jml_bayar,0,',','.');
                            } ?>
                            <h6><?= $jmlbayar ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Bayar</h5>
                            <h6><?= ($d->pendapatan_tgl_bayar == null) ? "-" : tglIndo($d->pendapatan_tgl_bayar) ?></h6>
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
                            <h5 class="mr-4">Nama Customer</h5>
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

            </div>
        </div>

        <?php endforeach; ?>

    </div>

</section>