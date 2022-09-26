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
            <a href="<?= base_url() ?>angsuran" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></a>
            <h1 class="ml-2">Angsuran</h1>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>angsuran">Angsuran</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <?php foreach($data as $d): ?>

        <div class="row">

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Detail
                            <?= $d->angsuran_kategori == 'bank' ? 'Angsuran Bank' : 'Pembayaran Vendor' ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>ID Angsuran</h5>
                            <h6><?= $d->angsuran_id ?></h6>
                        </div>
                        <hr>
                        <?php if($d->angsuran_kategori == 'bank'): ?>

                        <div class="d-flex justify-content-between">
                            <h5>Bank / Leasing</h5>
                            <h6><?= $d->hutang_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Periode Angsuran</h5>
                            <h6><?= $d->angsuran_periode ?></h6>
                        </div>
                        <hr>

                        <?php else: ?>

                        <div class="d-flex justify-content-between">
                            <h5>Vendor</h5>
                            <h6><?= $d->vendor_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>No Tagihan</h5>
                            <h6><?= $d->angsuran_no_tagihan ?></h6>
                        </div>
                        <hr>

                        <?php endif; ?>

                        <div class="d-flex justify-content-between">
                            <h5>Nilai Pembiayaan</h5>
                            <h6><?= number_format($d->angsuran_nilai_pembiayaan,0,",",".") ?></h6>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Tanggal</h5>
                            <h6><?= tglIndo($d->angsuran_tgl); ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">User Input</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Tanggal Input</h5>
                            <h6><?= tglIndo($d->angsuran_tgl_input); ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nama User</h5>
                            <h6><?= $d->user_nmlengkap; ?></h6>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>