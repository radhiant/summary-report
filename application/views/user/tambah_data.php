<section class="section">
    <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>user">User</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>user/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nmlengkap">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level">
                                    <option value="">--Pilih--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Invoice</option>
                                    <option value="3">Purchasing</option>
                                    <option value="4">SPJ</option>
                                    <option value="5">Operator</option>
                                    <option value="6">Akun Manager</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Divisi</label>
                                <select class="form-control" name="divisi">
                                    <option value="">--Pilih--</option>
                                    <option value="WH">WH</option>
                                    <option value="SE">SE</option>
                                    <option value="OT">OT</option>
                                    <option value="GA">GA</option>
                                    <option value="IT">IT</option>
                                    <option value="FA">FA</option>
                                    <option value="WS">WS</option>
                                    <option value="SD">SD</option>
                                    <option value="MO">MO</option>
                                    <option value="CS">CS</option>
                                    <option value="HR">HR</option>
                                    <option value="PS">PS</option>
                                    <option value="HD">HD</option>
                                    <option value="BD">BD</option>
                                    <option value="R&">R&</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pwd">
                            </div>

                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="password" class="form-control" name="pwdU">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Foto</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Extensi Gambar</div>
                                    .png .jpeg .jpg .tiff .gif .tif
                                </div>
                            </div>

                            <img src="<?= base_url() ?>assets/stisla/assets/img/news/img01.jpg" alt="blankimg"
                                class="imagecheck-image mb-2" id="outputImg">

                            <div class="form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" type="file" id="GetFile" name="photo"
                                        onchange="VerifyFileNameAndFileSize()" accept=".png,.gif,.jpeg,.tiff,.jpg">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" onclick="lodingklik()">Simpan Data <i
                            class="fas fa-check-circle" ></i></button>
                    <a href="<?= base_url() ?>user" class="btn btn-danger btn-lg btn-block">Batal <i
                            class="fas fa-times"></i></a>
                </div>

            </div>

        </form>

    </div>

</section>