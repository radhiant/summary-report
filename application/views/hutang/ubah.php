<section class="section">
    <div class="section-header">
        <h1>Hutang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>hutang">Hutang</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <form action="<?= base_url() ?>hutang/proses_ubah" name="myForm" method="POST" onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-2"></div>

                <?php if($d->hutang_kategori == 'bank'): ?>


                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Hutang</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="idH" value="<?= $d->hutang_id ?>">
                            <input type="hidden" name="kategori" value="<?= $d->hutang_kategori ?>">

                            <div class="form-group">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"
                                        <?= ($p->project_id == $d->project_id) ? "selected" : "" ?>>
                                        <?= $p->project_nama ?> - <?= $p->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Bank / Leasing</label>
                                <input type="text" class="form-control" name="namaH" id="namaH"
                                    value="<?= $d->hutang_nama ?>">
                            </div>

                            <div class="form-group">
                                <label>Produk Pembiayaan</label>
                                <input type="text" class="form-control" name="jenisH" value="<?= $d->hutang_jenis ?>">
                            </div>

                            <div class="form-group">
                                <label>Nilai Hutang</label>
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
                                <input type="text" class="form-control" name="nilaiH" id="nilai"
                                    value="<?= $nilai ?>">
                            </div>

                            <div class="form-group">
                                <label>Cicilan</label>
                                <input type="text" class="form-control" name="cicilan"
                                    value="<?= number_format($d->hutang_cicilan,0,",",".") ?>" id="cicilan">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Start</label>
                                <input type="text" class="form-control datepicker" name="tglS" id="tglS"
                                    autocomplete="off" value="<?= $d->hutang_tgl_start ?>">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Finish</label>
                                <input type="text" class="form-control datepicker" name="tglF" id="tglF"
                                    autocomplete="off" value="<?= $d->hutang_tgl_finish ?>">
                            </div>



                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>hutang" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <?php else: ?>

                        <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Hutang</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="idH" value="<?= $d->hutang_id ?>">
                            <input type="hidden" name="kategori" value="<?= $d->hutang_kategori ?>">

                            <div class="form-group">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"
                                        <?= ($p->project_id == $d->project_id) ? "selected" : "" ?>>
                                        <?= $p->project_nama ?> - <?= $p->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pilih Vendor</label>
                                <select name="namaH" id="namaH" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($vendor as $v): ?>
                                    <option value="<?= $v->vendor_id ?>" <?= ($v->vendor_id == $d->hutang_nama) ? "selected" : "" ?>><?= $v->vendor_nama ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>No Tagihan</label>
                                <input type="text" class="form-control" name="noT" id="noT" value="<?= $d->hutang_no_tagihan ?>">
                            </div>

                            <div class="form-group">
                                <label>Nilai Hutang</label>
                                <input type="text" class="form-control" name="nilaiH" id="nilai"
                                    value="<?= number_format($d->hutang_nilai,0,",",".") ?>">
                            </div>

                            <div class="form-group">
                                <label>Jatuh Tempo</label>
                                <input type="text" class="form-control datepicker" name="tglF" id="tglF"
                                    autocomplete="off" value="<?= $d->hutang_tgl_finish ?>">
                            </div>



                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>hutang" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>


                    <?php endif; ?>

                    <div class="col-lg-2"></div>

                </div>

            </div>

        </form>

        <?php endforeach; ?>

    </div>

</section>