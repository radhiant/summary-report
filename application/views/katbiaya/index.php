<section class="section">
    <div class="section-header">
        <h1>Kategori Biaya</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>katbiaya">Kategori Biaya</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Kategori Biaya</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
                                <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>ID Kategori Biaya</th>
                                        <th>Nama Kategori Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($data as $d): ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->katbiaya_id ?></td>
                                        <td><?= $d->katbiaya_nama ?></td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm"
                                                data-placement="top" title="Ubah Data" data-toggle="modal" data-target="#exampleModalU" onclick="ambilData('<?= $d->katbiaya_id ?>')"> <i class="fas fa-pen"></i> </a>

                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus Data" onclick="konfirmasi('<?= $d->katbiaya_id ?>')"> <i class="fas fa-trash"></i>
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


