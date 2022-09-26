<?php 

function formatDate($tanggal)
{
    $tgl = strtotime($tanggal);
    $formatTgl = date('Y-m-d',$tgl);
    return $formatTgl;
}

?>
<section class="section">
    <div class="section-header">
        <h1>Project</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>project">Project</a></div>
            <div class="breadcrumb-item">Ubah Data</div>
        </div>
    </div>

    <div class="section-body">

        <?php foreach($data as $d): ?>

        <form action="<?= base_url() ?>project/proses_ubah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Project</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="idP" value="<?= $d->project_id ?>">

                            <div class="form-group">
                                <label>Nama Project</label>
                                <input type="text" class="form-control" name="namaP" value="<?= $d->project_nama ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Customer</label>
                                <select name="idC" id="idC" class="form-control chosen" onchange="getsitecustomer()">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($customer as $c): ?>
                                    <option value="<?= $c->customer_id ?>"
                                        <?= ($c->customer_id == $d->customer_id) ? "selected" : "" ?>>
                                        <?= $c->customer_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Layanan</label>
                                <select name="layanan" id="layanan" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="Sewa" <?= $d->project_layanan == 'Sewa' ? 'selected' : '' ?>>Sewa
                                    </option>
                                    <option value="Jual" <?= $d->project_layanan == 'Jual' ? 'selected' : '' ?>>Jual
                                    </option>
                                    <option value="Repair" <?= $d->project_layanan == 'Repair' ? 'selected' : '' ?>>
                                        Repair</option>
                                    <option value="Lain-lain" <?= $d->project_layanan == 'Lain-lain' ? 'selected' : '' ?>>
                                        Lain-lain</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nilai Kontrak</label>
                                <input type="text" class="form-control" name="nk" id="nilai"
                                    value="<?= number_format($d->project_kontrak_nilai,0,",",".") ?>">
                            </div>

                            <div class="form-group">
                                <label>Start Kontrak</label>
                                <input type="text" class="form-control datepicker" name="sk" autocomplete="off"
                                    value="<?= formatDate($d->project_kontrak_start) ?>">
                            </div>

                            <div class="form-group">
                                <label>End Kontrak</label>
                                <input type="text" class="form-control datepicker" name="ek" autocomplete="off"
                                    value="<?= formatDate($d->project_kontrak_end) ?>">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success btn-lg" onclick="lodingklik()">Simpan Perubahan <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>project" class="btn btn-danger btn-lg">Batal <i
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