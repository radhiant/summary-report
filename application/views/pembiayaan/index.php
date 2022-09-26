<section class="section">
    <div class="section-header">
        <h1>Pembiayaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pembiayaan">Pembiayaan</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-3">
                <label for="">Filter Tanggal</label>
                <div class="form-group">
                    <input type="text" name="tgl" id="tgl" class="form-control rangepicker" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-3">
                <label for="">&nbsp;</label>
                <div class="d-flex">
                    <div class="form-group">
                        <button id="btnFilter" class="btn btn-success"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                    <div class="form-group">
                        <button id="btnReset" class="btn btn-primary ml-2"><i class="fas fa-undo"></i> Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembiayaan</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>pembiayaan/tambah" class="btn btn-primary">Tambah <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Kategori</th>
                                        <th>Beban</th>
                                        <th>Project</th>
                                        <th>Tanggal</th>
                                        <th>Nilai Realisasi</th>
                                        <th>Keterangan</th>
                                        <th>Tgl Input</th>
                                        <th>User Input</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>