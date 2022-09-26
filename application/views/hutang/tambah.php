<section class="section">
    <div class="section-header">
        <h1>Hutang </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>hutang">Hutang</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>hutang/proses_tambah" name="myForm" method="POST"
            onsubmit="return <?= $kategori == 'bank' ? 'validateBank()' : 'validateVendor()' ?> ">

            <div class="row">

                <div class="col-lg-2"></div>

                <?php if($kategori == 'bank'): ?>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Hutang <?= $kategori == 'bank' ? 'Bank' : 'Vendor' ?></h4>
                        </div>
                        <div class="card-body">

                        <input type="hidden" value="bank" name="kategori">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"><?= $p->project_nama ?> -
                                        <?= $p->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Bank / Leasing</label>
                                <input type="text" class="form-control" name="namaH" id="namaH">
                            </div>

                            <div class="form-group">
                                <label>Produk Pembiayaan</label>
                                <input type="text" class="form-control" name="jenisH">
                            </div>

                            <div class="form-group">
                                <label>Nilai Hutang</label>
                                <input type="text" class="form-control" name="nilaiH" id="nilai">
                            </div>

                            <div class="form-group">
                                <label>Cicilan</label>
                                <input type="text" class="form-control" name="cicilan" id="cicilan">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Start</label>
                                <input type="text" class="form-control datepicker" name="tglS" id="tglS"
                                    autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Finish</label>
                                <input type="text" class="form-control datepicker" name="tglF" id="tglF"
                                    autocomplete="off">
                            </div>



                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
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

                        <input type="hidden" value="vendor" name="kategori">

                            <div class="form-group" id="projekFrom">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"><?= $p->project_nama ?> -
                                        <?= $p->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pilih Vendor</label>
                                <select name="namaH" id="namaH" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($vendor as $v): ?>
                                    <option value="<?= $v->vendor_id ?>"><?= $v->vendor_nama ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>No Tagihan</label>
                                <input type="text" class="form-control" name="noT" id="noT">
                            </div>

                            <div class="form-group">
                                <label>Nilai Hutang</label>
                                <input type="text" class="form-control" name="nilaiH" id="nilai">
                            </div>

                            <div class="form-group">
                                <label>Jatuh Tempo</label>
                                <input type="text" class="form-control datepicker" name="tglF" id="tglF"
                                    autocomplete="off">
                            </div>



                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
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

    </div>

</section>