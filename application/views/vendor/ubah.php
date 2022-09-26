<section class="section">
    <div class="section-header">
        <h1>Vendor</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>vendor">Vendor</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <form action="<?= base_url() ?>vendor/proses_ubah" name="myForm" method="POST" onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Vendor</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="idV" value="<?= $d->vendor_id ?>">

                            <div class="form-group">
                                <label>Nama Vendor</label>
                                <input type="text" class="form-control" name="namaV" value="<?= $d->vendor_nama ?>">
                            </div>

                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" name="telp" value="<?= $d->vendor_telp ?>">
                            </div>

                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control" name="cp" value="<?= $d->vendor_cp ?>">
                            </div>

                            <div class="form-group">
                                <label>Term of Payment</label>
                                <input type="text" class="form-control" name="top" value="<?= $d->vendor_top ?>">
                            </div>

                            <div class="form-group">
                                <label>Delivery Time</label>
                                <input type="text" class="form-control" name="delivery" value="<?= $d->vendor_delivery ?>">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" style="height:100px;" class="form-control"><?= $d->vendor_alamat ?></textarea>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>vendor" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2"></div>

                </div>

            </div>

        </form>

        <?php endforeach; ?>

    </div>

</section>