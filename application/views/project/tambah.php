<section class="section">
    <div class="section-header">
        <h1>Project</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>project">Project</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>project/proses_tambah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Project</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="idP">

                            <div class="form-group">
                                <label>Nama Project</label>
                                <input type="text" class="form-control" name="namaP">
                            </div>

                            <div class="form-group">
                                <label for="">Customer</label>
                                <select name="idC" id="idC" class="form-control chosen" onchange="getsitecustomer()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($customer as $c): ?>
                                    <option value="<?= $c->customer_id ?>">
                                        <?= $c->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Layanan</label>
                                <select name="layanan" id="layanan" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="Sewa">Sewa</option>
                                        <option value="Jual">Jual</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nilai Kontrak</label>
                                <input type="text" class="form-control" name="nk" id="nilai">
                            </div>

                            <div class="form-group">
                                <label>Start Kontrak</label>
                                <input type="text" class="form-control datepicker" name="sk" id="sk" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>End Kontrak</label>
                                <input type="text" class="form-control datepicker" name="ek" id="ek" autocomplete="off">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>project" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2"></div>

                </div>

            </div>

        </form>

    </div>

</section>