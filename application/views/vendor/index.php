<section class="section">
    <div class="section-header">
        <h1>Vendor</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>vendor">Vendor</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Vendor</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url() ?>vendor/tambah" class="btn btn-primary" >Tambah
                                <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama Vendor</th>
                                        <th>Telepon</th>
                                        <th>Contact Person</th>
                                        <th>Term of payment</th>
                                        <th>Delivery Time</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($data as $d): ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->vendor_nama ?></td>
                                        <td><?= $d->vendor_telp ?></td>
                                        <td><?= $d->vendor_cp ?></td>
                                        <td><?= $d->vendor_top ?></td>
                                        <td><?= $d->vendor_delivery ?></td>
                                        <td><?= $d->vendor_alamat ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>vendor/ubah/<?= $d->vendor_id ?>" class="btn btn-success btn-sm" data-placement="top"
                                                title="Ubah Data"> <i class="fas fa-pen"></i> </a>

                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus Data"
                                                onclick="konfirmasi('<?= $d->vendor_id ?>')"> <i
                                                    class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>