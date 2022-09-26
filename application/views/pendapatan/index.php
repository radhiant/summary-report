<section class="section">
    <div class="section-header">
        <h1>Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>pendapatan">Pendapatan</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pendapatan</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>pendapatan/tambah" class="btn btn-primary">Tambah <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Project</th>
                                        <th>Customer</th>
                                        <th>Periode</th>
                                        <th>Tagihan</th>
                                        <th>Tempo</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Keterangan</th>
                                        <th>Tgl Bayar</th>
                                        <th>Jml Bayar</th>
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