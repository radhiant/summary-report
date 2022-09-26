<section class="section">
    <div class="section-header">
        <h1>Halaman Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>profile">profile</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Photo User</h4>
                    </div>
                    <div class="card-body">

                        <img src="<?= base_url() ?>assets/upload/user/<?= $d->user_foto ?>" alt="blankimg"
                            class="imagecheck-image mb-2" id="outputImg">

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile User</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>profile/ubah" class="btn btn-success">Ubah profile <i
                                    class="fas fa-pen"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Nama Lengkap</h5>
                            <h6><?= $d->user_nmlengkap ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Nama User</h5>
                            <h6><?= $d->user_nama ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Divisi</h5>
                            <h6 class="badge badge-success"><?= $d->user_divisi ?></h6>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5>Level</h5>
                            <?php if($d->user_level == '1'): ?>
                            <h6 class="badge badge-primary">Administrator</h6>
                            <?php elseif($d->user_level == '2'): ?>
                            <h6 class="badge badge-primary">Invoice</h6>
                            <?php elseif($d->user_level == '3'): ?>
                            <h6 class="badge badge-primary">Purchasing</h6>
                            <?php elseif($d->user_level == '4'): ?>
                            <h6 class="badge badge-primary">SPJ</h6>
                            <?php elseif($d->user_level == '5'): ?>
                            <h6 class="badge badge-primary">Operator</h6>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>