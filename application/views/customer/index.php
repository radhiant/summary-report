<section class="section">
    <div class="section-header">
        <h1>Customer</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>customer">Customer</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Customer</h4>
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
                                        <!-- <th width="1%">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    data-checkbox-role="dad" class="custom-control-input"
                                                    id="check-all">
                                                <label for="check-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th> -->
                                        <th width="1%">No</th>
                                        <th>ID Customer</th>
                                        <th>Nama Customer</th>
                                        <th>Kategori</th>
                                        <th>Akun Manager</th>
                                        <th>Kondisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idNumb = 1; $no=1; foreach($data as $d): ?>
                                    <tr>
                                        <!-- <td>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="<?= (string) $idNumb++ ?>">
                                                <label for="<?= (string) $idNumb++ ?>" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td> -->
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->customer_id ?></td>
                                        <td><?= $d->customer_nama ?></td>
                                        <td><span
                                                class="badge <?= $d->customer_kategori == 'Pemerintahan' ? "badge-success" : "badge-primary"  ?>"><?= $d->customer_kategori ?></span>
                                        </td>
                                        <td><?= $d->user_nmlengkap == null ? '<i>(kosong)</i>' :  $d->user_nmlengkap ?></td>
                                        <td>
                                            <?php if($d->customer_kondisi == "Aktif"): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php elseif($d->customer_kondisi == "Tidak Aktif"): ?>
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">. . .</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm" data-placement="top"
                                                title="Ubah Data" data-toggle="modal" data-target="#exampleModalU"
                                                onclick="ambilData('<?= $d->customer_id ?>')"> <i
                                                    class="fas fa-pen"></i> </a>

                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus Data"
                                                onclick="konfirmasi('<?= $d->customer_id ?>')"> <i
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