<section class="section">
    <div class="section-header">
        <h1>Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pendapatan">Pendapatan</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>pendapatan/proses_tambah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Pendapatan</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="idP">

                            <div class="form-group">
                                <label>Pilih Project</label>
                                <select name="idP" id="idP" class="form-control chosen" onchange="getNilaiKontrak()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($project as $p): ?>
                                    <option value="<?= $p->project_id ?>"><?= $p->project_nama ?> -
                                        <?= $p->customer_nama ?></option>
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
                                <label>Tgl Penagihan</label>
                                <input type="text" class="form-control datepicker" name="tglP" id="tglP"
                                    autocomplete="off" value="">
                            </div>

                            <div class="form-group">
                                <label>Tgl Tempo</label>
                                <input type="text" class="form-control datepicker" name="tglT" id="tglT"
                                    autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Jumlah Tagihan</label>
                                <input type="text" class="form-control" placeholder="cth: 200000" name="jmlT" id="nilai">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" style="height:100px;" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>pendapatan" class="btn btn-danger btn-lg">Batal <i
                                    class="fas fa-times"></i></a>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card bg-warning">
                        <div class="card-header">
                            <h3 class="text-white">Perhatian</h3>
                        </div>
                        <div class="card-body">
                            <h6>1. Format Tanggal YYYY-MM-DD</h6>
                            <center>-Terima Kasih-</center>
                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>

</section>