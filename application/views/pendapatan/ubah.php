<?php 

function formatDate($tanggal)
{
    $tgl = strtotime($tanggal);
    $formatTgl = date('m/d/Y',$tgl);
    return $formatTgl;
}

?>

<section class="section">
    <div class="section-header">
        <h1>Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pendapatan">Pendapatan</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <form action="<?= base_url() ?>pendapatan/proses_ubah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Pendapatan</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="idPD" value="<?= $d->pendapatan_id ?>">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen" onchange="getNilaiKontrak()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"
                                        <?= ($p->project_id == $d->project_id) ? "selected" : "" ?>>
                                        <?= $p->project_nama ?> - <?= $p->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Periode</label>
                                <select name="periode" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="Januari" <?= ($d->pendapatan_periode == 'Januari') ? "selected" : "" ?>>
                                        Januari</option>
                                    <option value="Februari"
                                        <?= ($d->pendapatan_periode == 'Februari') ? "selected" : "" ?>>Februari</option>
                                    <option value="Maret" <?= ($d->pendapatan_periode == 'Maret') ? "selected" : "" ?>>
                                        Maret</option>
                                    <option value="April" <?= ($d->pendapatan_periode == 'April') ? "selected" : "" ?>>
                                        April</option>
                                    <option value="Mei" <?= ($d->pendapatan_periode == 'Mei') ? "selected" : "" ?>>Mei
                                    </option>
                                    <option value="Juni" <?= ($d->pendapatan_periode == 'Juni') ? "selected" : "" ?>>Juni
                                    </option>
                                    <option value="Juli" <?= ($d->pendapatan_periode == 'Juli') ? "selected" : "" ?>>Juli
                                    </option>
                                    <option value="Agustus" <?= ($d->pendapatan_periode == 'Agustus') ? "selected" : "" ?>>
                                        Agustus</option>
                                    <option value="September"
                                        <?= ($d->pendapatan_periode == 'September') ? "selected" : "" ?>>September</option>
                                    <option value="Oktober" <?= ($d->pendapatan_periode == 'Oktober') ? "selected" : "" ?>>
                                        Oktober</option>
                                    <option value="November"
                                        <?= ($d->pendapatan_periode == 'November') ? "selected" : "" ?>>November</option>
                                    <option value="Desember"
                                        <?= ($d->pendapatan_periode == 'Desember') ? "selected" : "" ?>>Desember</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tgl Penagihan</label>
                                <input type="text" class="form-control datepicker" name="tglP" id="tglP"
                                    autocomplete="off" value="<?= $d->pendapatan_tgl_penagihan ?>">
                            </div>

                            <div class="form-group">
                                <label>Tgl Tempo</label>
                                <input type="text" class="form-control datepicker" name="tglT" id="tglT"
                                    autocomplete="off" value="<?= $d->pendapatan_tgl_tempo ?>">
                            </div>

                            <div class="form-group">
                                <label>Jumlah Tagihan</label>
                                <?php if($d->pendapatan_jml_tagihan == "" || $d->pendapatan_jml_tagihan == null){
                                        $jmltagihan = "0";
                                    }else{
                                        if (strpos($d->pendapatan_jml_tagihan, ',') !== false) {
                                            $exp = explode(",", $d->pendapatan_jml_tagihan);

                                            $jmltagihan = number_format($exp[0],0,',','.') . "," . $exp[1];
                                        }else{
                                            $jmltagihan =  number_format($d->pendapatan_jml_tagihan,0,',','.');
                                        }
                                    } ?>
                                <input type="text" class="form-control" name="jmlT" id="nilai" value="<?=  $jmltagihan ?>">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" style="height:100px;" class="form-control"><?= $d->pendapatan_ket ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Tgl Dibayar</label>
                                <input type="text" class="form-control datepicker1" name="tglB" autocomplete="off"
                                    value="<?= ($d->pendapatan_tgl_bayar == '') ? "" : formatDate($d->pendapatan_tgl_bayar) ?>">
                            </div>

                            <div class="form-group">
                                <label>Di Bayarkan</label>
                                <?php if (strpos($d->pendapatan_jml_bayar, ',') !== false) {
                                    $exp2 = explode(",", $d->pendapatan_jml_bayar);
                    
                                    $jmlbayar = "". number_format($exp2[0],0,',','.') . "," . $exp2[1];
                                }else{
                                    $jmlbayar = "" . number_format($d->pendapatan_jml_bayar,0,',','.');
                                } ?>
                                <input type="text" class="form-control" name="jmlB" id="jmlB"
                                    value="<?= $jmlbayar ?>">
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>pendapatan" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card bg-warning">
                        <div class="card-header">
                            <h3 class="text-white">Perhatian</h3>
                        </div>
                        <div class="card-body">
                            <h6>1. Format Tanggal YYYY-MM-DD</h6>
                            <h6>2. Jumlah Tagihan sudah otomatis diberi titik jadi tinggal ketik saja angkanya.</h6>
                            <center>-Terima Kasih-</center>
                        </div>
                    </div>
                </div>


            </div>

        </form>

        <?php endforeach; ?>

    </div>

</section>