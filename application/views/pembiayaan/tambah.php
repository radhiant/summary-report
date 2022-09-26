<section class="section">
    <div class="section-header">
        <h1>Pembiayaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pembiayaan">Pembiayaan</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <div class="section-body">

        <form action="<?= base_url() ?>pembiayaan/proses_tambah" name="myForm" method="POST"
            onsubmit="return validateForm()">

            <div class="row">

                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Pembiayaan</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Kategori Biaya</label>
                                <?php if($this->session->userdata('login_session')['level'] == '3'): ?>
                                <?php 
                                        $this->db->select('*');
                                        $this->db->where('katbiaya_nama', "PENGADAAN");
                                        $data1= $this->db->get('katbiaya');
                                        $katbiaya = $data1->row();
                                        ?>
                                <input type="hidden" value="<?= $katbiaya->katbiaya_id ?>" name="kb">
                                <input type="text" value="<?= $katbiaya->katbiaya_nama ?>" class="form-control"
                                    readonly>
                                <?php elseif($this->session->userdata('login_session')['level'] == '4'): ?>
                                <?php 
                                        $this->db->select('*');
                                        $this->db->where('katbiaya_nama', "PERJALANAN DINAS");
                                        $data2= $this->db->get('katbiaya');
                                        $katbiayaa = $data2->row();
                                        ?>
                                <input type="hidden" value="<?= $katbiayaa->katbiaya_id ?>" name="kb">
                                <input type="text" value="<?= $katbiayaa->katbiaya_nama ?>" class="form-control"
                                    readonly>
                                <?php else: ?>
                                <select name="kb" id="kb" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($katbiaya as $c): ?>
                                    <option value="<?= $c->katbiaya_id ?>">
                                        <?= $c->katbiaya_nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="">Beban Biaya</label>
                                <div class="mb-2">
                                    <button class="btn btn-primary" type="button" id="btnNprojek"
                                        onclick="nprojek()">Non Project <i class="fas fa-check-circle"
                                            id="checkNP"></i></button>
                                    <button class="btn btn-secondary ml-2" type="button" id="btnProjek"
                                        onclick="projek()">Project <i class="fas fa-check-circle"
                                            id="checkP"></i></button>
                                </div>

                                <input type="hidden" class="form-control" id="beban" name="beban" value="Non Project">
                            </div>

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
                                <label>Tanggal</label>
                                <input type="text" class="form-control datepicker" name="tgl" id="tgl"
                                    autocomplete="off" value="">
                            </div>

                            <div class="form-group">
                                <label>Nilai Realisasi</label>
                                <input type="text" class="form-control" name="realisasi" id="nilai">
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" style="height:100px;" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-lg" onclick="lodingklik()">Simpan Data <i
                                    class="fas fa-check-circle"></i></button>
                            <a href="<?= base_url() ?>pembiayaan" class="btn btn-danger btn-lg">Batal <i
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
                            <h6>2. Nilai Realisasi sudah otomatis diberi titik jadi tinggal ketik saja angkanya.</h6>
                            <center>-Terima Kasih-</center>
                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>

</section>