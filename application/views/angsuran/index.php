<section class="section">
    <div class="section-header">
        <h1>Angsuran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>angsuran">Angsuran</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12 mb-4">
                <?php if($this->session->userdata('login_session')['level'] == '1'): ?>
                <button class="btn btn-lg btn-primary " id="btnBank" onclick="tabBank()">Bank</button>
                <button class="btn btn-lg btn-outline-primary" id="btnVendor" onclick="tabVendor()">Vendor</button>
                <?php elseif($this->session->userdata('login_session')['level'] == '5'): ?>
                <button class="btn btn-lg btn-primary " id="btnBank" onclick="tabBank()">Bank</button>
                <?php else: ?>
                <button class="btn btn-lg btn-primary" id="btnVendor" onclick="tabVendor()">Vendor</button>
                <?php endif;?>
            </div>
        </div>

        <input type="hidden" id="level" value="<?= $this->session->userdata('login_session')['level'] ?>">


        <div class="row" id="bank">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Angsuran Bank</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>angsuran/tambah/bank" class="btn btn-primary">Tambah <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Bank / Leasing</th>
                                        <th>Periode</th>
                                        <th>Nilai Pembayaran</th>
                                        <th>Tanggal</th>
                                        <th>User Input</th>
                                        <th>Tgl Input</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="vendor">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran Vendor</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>angsuran/tambah/vendor" class="btn btn-primary">Tambah <i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Vendor</th>
                                        <th>No Tagihan</th>
                                        <th>Nilai Pembayaran</th>
                                        <th>Tanggal</th>
                                        <th>User Input</th>
                                        <th>Tgl Input</th>
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