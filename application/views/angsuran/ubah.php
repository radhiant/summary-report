<section class="section">
    <div class="section-header">
        <h1>Angsuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>angsuran">Angsuran</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <form action="<?= base_url() ?>angsuran/proses_ubah" name="myForm" method="POST"
            onsubmit="return <?= $d->angsuran_kategori == 'bank' ?  'validateBank()' : 'validateVendor()' ?>">

            <?php if($d->angsuran_kategori == 'bank'): ?>

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Angsuran Bank</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="idA" value="<?= $d->angsuran_id ?>">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Bank / Leasing</label>
                                <select name="idH" id="idH" class="form-control chosen" onchange="getCicilan()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($hBank as $p): ?>
                                    <option value="<?= $p->hutang_id ?>"
                                        <?= ($p->hutang_id == $d->hutang_id) ? "selected" : "" ?>><?= $p->hutang_nama ?> - <?= $p->hutang_jenis ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Periode</label>
                                <select name="periode" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="Januari"
                                        <?= ($d->angsuran_periode == 'Januari') ? "selected" : "" ?>>
                                        Januari</option>
                                    <option value="Februari"
                                        <?= ($d->angsuran_periode == 'Februari') ? "selected" : "" ?>>Februari</option>
                                    <option value="Maret" <?= ($d->angsuran_periode == 'Maret') ? "selected" : "" ?>>
                                        Maret</option>
                                    <option value="April" <?= ($d->angsuran_periode == 'April') ? "selected" : "" ?>>
                                        April</option>
                                    <option value="Mei" <?= ($d->angsuran_periode == 'Mei') ? "selected" : "" ?>>Mei
                                    </option>
                                    <option value="Juni" <?= ($d->angsuran_periode == 'Juni') ? "selected" : "" ?>>Juni
                                    </option>
                                    <option value="Juli" <?= ($d->angsuran_periode == 'Juli') ? "selected" : "" ?>>Juli
                                    </option>
                                    <option value="Agustus"
                                        <?= ($d->angsuran_periode == 'Agustus') ? "selected" : "" ?>>
                                        Agustus</option>
                                    <option value="September"
                                        <?= ($d->angsuran_periode == 'September') ? "selected" : "" ?>>September
                                    </option>
                                    <option value="Oktober"
                                        <?= ($d->angsuran_periode == 'Oktober') ? "selected" : "" ?>>
                                        Oktober</option>
                                    <option value="November"
                                        <?= ($d->angsuran_periode == 'November') ? "selected" : "" ?>>November</option>
                                    <option value="Desember"
                                        <?= ($d->angsuran_periode == 'Desember') ? "selected" : "" ?>>Desember</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input type="text" class="form-control" name="np" id="np"
                                    value="<?= number_format($d->angsuran_nilai_pembiayaan,0,",",".") ?>">
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control datepicker" name="tgl" id="tgl"
                                    autocomplete="off" value="<?= $d->angsuran_tgl ?>">
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>angsuran" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2"></div>

                </div>

            </div>

            <?php else: ?>

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Pembayaran Vendor</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="idA" value="<?= $d->angsuran_id ?>">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Vendor</label>
                                <select name="idH" id="idH" class="form-control chosen" onchange="getNotagihan()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($hVendor as $p): ?>
                                    <option value="<?= $p->hutang_id ?>"
                                        <?= ($p->hutang_id == $d->hutang_id) ? "selected" : "" ?>><?= $p->vendor_nama ?> - <?= $p->hutang_no_tagihan ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>No Tagihan</label>
                                <input type="text" class="form-control" name="noT" id="noT"
                                    value="<?= $d->angsuran_no_tagihan ?>">
                            </div>

                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input type="text" class="form-control" name="np" id="np"
                                    value="<?= number_format($d->angsuran_nilai_pembiayaan,0,",",".") ?>">
                            </div>


                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control datepicker" name="tgl" id="tgl"
                                    autocomplete="off" value="<?= $d->angsuran_tgl ?>">
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>angsuran" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2"></div>

                </div>

            </div>

            <?php endif; ?>

        </form>

        <?php endforeach; ?>

    </div>

</section>