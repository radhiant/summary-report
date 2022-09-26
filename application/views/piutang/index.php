<?php 

function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Jan',
				'Feb',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agus',
				'Sep',
				'Okt',
				'Nov',
				'Des'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

?>

<section class="section">
    <div class="section-header">
        <h1>Piutang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>piutang">Piutang</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Piutang</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Project</th>
                                        <th>Customer</th>
                                        <th>Periode</th>
                                        <th>Tgl Ditagihkan</th>
                                        <th>Tempo</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($data as $d): ?>
                                    <?php $tglnow = date("Y-m-d"); 
                                        
                                        if($d->pendapatan_tgl_tempo < $tglnow && $d->pendapatan_jml_bayar == ''): ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->project_nama ?></td>
                                        <td><?= $d->customer_nama ?></td>
                                        <td><?= $d->pendapatan_periode ?></td>
                                        <td><?= tanggal_indo($d->pendapatan_tgl_penagihan) ?></td>
                                        <td><?= tanggal_indo($d->pendapatan_tgl_tempo) ?></td>
                                        <?php if($d->pendapatan_jml_tagihan == "" || $d->pendapatan_jml_tagihan == null){
                                            $number = "Rp0";
                                        }else{
                                            if (strpos($d->pendapatan_jml_tagihan, ',') !== false) {
                                                $exp = explode(",", $d->pendapatan_jml_tagihan);

                                                $number = "Rp". number_format($exp[0],0,',','.') . "," . $exp[1];
                                            }else{
                                                $number = "Rp" . number_format($d->pendapatan_jml_tagihan,0,',','.');
                                            }
                                        } ?>
                                        <td><?=  $number ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#exampleModal"
                                                onclick="bayarkan('<?= $d->pendapatan_id ?>','<?= $d->pendapatan_jml_tagihan ?>')"><i
                                                    class="far fa-credit-card mdb-gallery-view-icon"></i> Dibayarkan
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>

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