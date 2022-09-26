<section class="section">
    <div class="section-header">
        <h1>Vendor</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>vendor">Vendor</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>vendor/proses_tambah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Vendor</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Vendor</label>
                                <input type="text" class="form-control" name="namaV">
                            </div>

                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" name="telp">
                            </div>

                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control" name="cp">
                            </div>

                            <div class="form-group">
                                <label>Term of Payment</label>
                                <input type="text" class="form-control" name="top">
                            </div>

                            <div class="form-group">
                                <label>Delivery Time</label>
                                <input type="text" class="form-control" name="delivery">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" style="height:100px;" class="form-control"></textarea>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>vendor" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2"></div>

                </div>

            </div>

        </form>

    </div>

</section>