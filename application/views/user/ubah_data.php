<section class="section">
    <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>user">User</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($user as $u): ?>

        <form action="<?= base_url() ?>user/proses_ubah" name="myForm" method="POST" enctype="multipart/form-data"
            onsubmit="return validateFormUpdate()">

            <div class="row">

                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header">
                            <h4>Form User</h4>
                        </div>
                        <div class="card-body">
                            <!-- Id User -->
                            <input class="form-control" name="iduser" type="hidden" value="<?= $u->user_id ?>">
                            
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nmlengkap"
                                    value="<?= $u->user_nmlengkap ?>">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $u->user_nama ?>">
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level">
                                    <?php if($u->user_level == '1'): ?>
                                    <option value="1" selected>Admin</option>
                                    <?php else: ?>
                                    <option value="1">Admin</option>
                                    <?php endif; ?>

                                    <?php if($u->user_level == '2'): ?>
                                    <option value="2" selected>Invoice</option>
                                    <?php else: ?>
                                    <option value="2">Invoice</option>
                                    <?php endif; ?>

                                    <?php if($u->user_level == '3'): ?>
                                    <option value="3" selected>Purchasing</option>
                                    <?php else: ?>
                                    <option value="3">Purchasing</option>
                                    <?php endif; ?>

                                    <?php if($u->user_level == '4'): ?>
                                    <option value="4" selected>SPJ</option>
                                    <?php else: ?>
                                    <option value="4">SPJ</option>
                                    <?php endif; ?>

                                    <?php if($u->user_level == '5'): ?>
                                    <option value="5" selected>Operator</option>
                                    <?php else: ?>
                                    <option value="5">Operator</option>
                                    <?php endif; ?>

                                    <?php if($u->user_level == '6'): ?>
                                    <option value="6" selected>Akun Manager</option>
                                    <?php else: ?>
                                    <option value="6">Akun Manager</option>
                                    <?php endif; ?>

                                </select>
                            </div>

                            <!-- Divisi -->
                            <div class="form-group"><label>Divisi</label>
                                <select name="divisi" class="form-control">
                                    <option value="WH" <?= $u->user_divisi == 'WH' ? 'selected' : ''?>>WH</option>
                                    <option value="SE" <?= $u->user_divisi == 'SE' ? 'selected' : ''?>>SE</option>
                                    <option value="OT" <?= $u->user_divisi == 'OT' ? 'selected' : ''?>>OT</option>
                                    <option value="GA" <?= $u->user_divisi == 'GA' ? 'selected' : ''?>>GA</option>
                                    <option value="IT" <?= $u->user_divisi == 'IT' ? 'selected' : ''?>>IT</option>
                                    <option value="FA" <?= $u->user_divisi == 'FA' ? 'selected' : ''?>>FA</option>
                                    <option value="WS" <?= $u->user_divisi == 'WS' ? 'selected' : ''?>>WS</option>
                                    <option value="SD" <?= $u->user_divisi == 'SD' ? 'selected' : ''?>>SD</option>
                                    <option value="MO" <?= $u->user_divisi == 'MO' ? 'selected' : ''?>>MO</option>
                                    <option value="CS" <?= $u->user_divisi == 'CS' ? 'selected' : ''?>>CS</option>
                                    <option value="HR" <?= $u->user_divisi == 'HR' ? 'selected' : ''?>>HR</option>
                                    <option value="PS" <?= $u->user_divisi == 'PS' ? 'selected' : ''?>>PS</option>
                                    <option value="HD" <?= $u->user_divisi == 'HD' ? 'selected' : ''?>>HD</option>
                                    <option value="BD" <?= $u->user_divisi == 'BD' ? 'selected' : ''?>>BD</option>
                                    <option value="R&" <?= $u->user_divisi == 'R&' ? 'selected' : ''?>>R&</option>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="card-body">

                        <div class="alert alert-warning alert-has-icon">
                                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Perhatian !</div>
                                    Kosongkan jika tidak ingin merubah 
                                </div>
                            </div>

                            <!-- Password lama -->
                            <input name="pwdLama" type="hidden" value="<?= $u->user_password ?>">

                            <!-- Password -->
                            <div class="form-group"><label>Password</label>
                                <input class="form-control" name="pwd" type="password" value="">
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="form-group"><label>Konfirmasi Password</label>
                                <input class="form-control" name="kpwd" type="password" value="">
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

                            <img src="<?= base_url() ?>assets/upload/user/<?= $u->user_foto ?>" alt="blankimg"
                                class="imagecheck-image mb-2" id="outputImg">
                            <br>
                            <span class="text-danger">*kosongkan jika tidak ingin merubah</span>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="hidden" name="fotoLama" value="<?= $u->user_foto ?>">
                                    <input class="custom-file-input" type="file" id="GetFile" name="photo"
                                        onchange="VerifyFileNameAndFileSize()" accept=".png,.gif,.jpeg,.tiff,.jpg">
                                    <label class="custom-file-label" for="customFile">Pilih File</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="btn btn-success btn-lg btn-block" onclick="lodingklik()">Simpan Perubahan <i
                            class="fas fa-check-circle" ></i></button>
                    <a href="<?= base_url() ?>user" class="btn btn-danger btn-lg btn-block">Batal <i
                            class="fas fa-times"></i></a>
                </div>

            </div>

        </form>

        <?php endforeach; ?>

    </div>

</section>