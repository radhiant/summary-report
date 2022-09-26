<section class="section">
    <div class="section-header">
        <h1>Laporan Estimasi Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>estPendapatan">Laporan</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>epp/proses_tambah" method="POST">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pilih Project</h4>
                            <div class="card-header-action">
                                <button class="btn btn-success mr-2" id="btnSubmit" onclick="lodingklik()"
                                    type="submit">Simpan <i class="fas fa-check-circle"></i> </button>
                                <a href="<?= base_url() ?>estPendapatan" class="btn btn-danger">Batal <i
                                        class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <select name="idP" id="idP" class="form-control chosen">
                                <option value="">--Pilih--</option>
                                <?php foreach($project as $p): ?>
                                <option value="<?= $p->project_id ?>"><?= $p->project_nama ?> - <?= $p->customer_nama ?>
                                </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2" id="formInput">
                <div class="col-lg-12">
                    <div class='card'>
                        <div class='card-body'>
                            <center>
                                <h4 class='mt-4 mb-4'>...</h4>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="loder">
                <div class="col-lg-12">
                    <div class="cssload-dots">
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                        <div class="cssload-dot"></div>
                    </div>

                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <filter id="goo">
                                <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12"></feGaussianBlur>
                                <feColorMatrix in="blur" mode="matrix"
                                    values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo"></feColorMatrix>
                                <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
                            </filter>
                        </defs>
                    </svg>
                </div>
            </div>

        </form>
    </div>

    </div>

</section>