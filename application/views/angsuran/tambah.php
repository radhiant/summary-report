<section class="section">
    <div class="section-header">
        <h1>Angsuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>angsuran">Angsuran</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>angsuran/proses_tambah" name="myForm" method="POST"
            onsubmit="return <?= $kategori == 'bank' ?  'validateBank()' : 'validateVendor()' ?>">

            <input type="hidden" name="kategori" value="<?= $kategori ?>">

            <?php if($kategori == 'bank'): ?>

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Angsuran Bank</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Bank / Leasing</label>
                                <select name="idH" id="idH" class="form-control chosen" onchange="getCicilan()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($hBank as $p): ?>
                                    <option value="<?= $p->hutang_id ?>"><?= $p->hutang_nama ?> - <?= $p->hutang_jenis ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Periode</label>
                                <select name="periode" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input type="text" class="form-control" name="np" id="np">
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control datepicker" name="tgl" id="tgl"
                                    autocomplete="off">
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
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

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Vendor</label>
                                <select name="idH" id="idH" class="form-control chosen" onchange="getNotagihan()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($hVendor as $p): ?>
                                    <option value="<?= $p->hutang_id ?>"><?= $p->vendor_nama ?> - <?= $p->hutang_no_tagihan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>No Tagihan</label>
                                <input type="text" class="form-control" name="noT" id="noT">
                            </div>

                            <div class="form-group">
                                <label>Nilai Pembayaran</label>
                                <input type="text" class="form-control" name="np" id="np">
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control datepicker" name="tgl" id="tgl"
                                    autocomplete="off">
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
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

    </div>

</section>