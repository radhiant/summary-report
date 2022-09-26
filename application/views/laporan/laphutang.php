<section class="section">
    <div class="section-header">
        <h1>Laporan Hutang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>lapHutang">LapHutang</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">

            <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="d-flex flex-row-reverse">
                                <input type="hidden" id="bln" name="bln">
                                <input type="hidden" id="thn" name="thn" value="<?= $yearnow ?>">

                                <button type="button" onclick="printHutang()" class="btn btn-lg btn-primary rounded-pill">Print <i
                                        class="fas fa-print"></i></button>

                                <!--

                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="tahun"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= $yearnow ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-title">Pilih Tahun</div>
                                        <a class="dropdown-item" id="tya" href="javascript:void(0);"
                                            onclick="tya('<?= $twoyearago ?>')"><?= $twoyearago ?></a>
                                        <a class="dropdown-item" id="py" href="javascript:void(0);"
                                            onclick="py('<?= $previousyear ?>')"><?= $previousyear ?></a>
                                        <a class="dropdown-item active" id="yn" href="javascript:void(0);"
                                            onclick="yn('<?= $yearnow ?>')"><?= $yearnow ?></a>
                                    </div>
                                </div>

                                <div>

                                    <a href="#" data-toggle="dropdown"
                                        class="btn btn-primary btn-lg dropdown-toggle mr-2" id="bulan">Pilih
                                        Bulan</a>
                                    <ul class="dropdown-menu dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-title">Pilih Bulan</li>
                                        <li><a href="javascript:void(0);" id="jan" class="dropdown-item"
                                                onclick="jan()">Januari</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="feb" class="dropdown-item"
                                                onclick="feb()">Februari</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="mart" class="dropdown-item"
                                                onclick="mart()">Maret</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="apr" class="dropdown-item"
                                                onclick="apr()">April</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="may" class="dropdown-item"
                                                onclick="may()">Mei</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="jun" class="dropdown-item"
                                                onclick="jun()">Juni</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="jul" class="dropdown-item"
                                                onclick="jul()">Juli</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="agus" class="dropdown-item"
                                                onclick="agus()">Agustus</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="sep" class="dropdown-item"
                                                onclick="sep()">September</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="oct" class="dropdown-item"
                                                onclick="oct()">Oktober</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="nov" class="dropdown-item"
                                                onclick="nov()">November</a>
                                        </li>
                                        <li><a href="javascript:void(0);" id="dec" class="dropdown-item"
                                                onclick="dec()">Desember</a>
                                        </li>
                                        <li><a href="javascript:void(0);" class="dropdown-item"
                                                onclick="reset()">Reset</a>
                                        </li>
                                    </ul>

                                </div>

                                -->

                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>Hutang</h4>
                    </div> -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table rounded" id="table-1" width="100%">
                                <thead class="bg-primary">
                                    <tr>
                                        <th width="1%" class="text-white">No</th>
                                        <th class="text-white">Project</th>
                                        <th class="text-white">Bank/Leasing</th>
                                        <th class="text-white">Nilai Hutang</th>
                                        <th class="text-white">Hutang Terbayar</th>
                                        <th class="text-white">Sisa Hutang</th>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($data as $d): ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->project_nama ?></td>
                                        <td><?= $d->hutang_nama ?></td>
                                        <td>
                                            <?php 
                                                $where = array(
                                                    'hutang_kategori' => 'bank',
                                                    'project_id' => $d->project_id,
                                                    'hutang_nama' => $d->hutang_nama
                                                );
                                                
                                                $this->db->select_sum('hutang_nilai');
                                                $this->db->where($where);
                                                $result = $this->db->get('hutang');
                                                $hutang = $result->row();

                                                echo 'Rp '.number_format($hutang->hutang_nilai,0,",",".");
                                                
                                                ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $where = array(
                                                    'h.hutang_kategori' => 'bank',
                                                    'h.project_id' => $d->project_id,
                                                    'h.hutang_nama' => $d->hutang_nama
                                                );
                                                
                                                $this->db->select_sum('a.angsuran_nilai_pembiayaan');
                                                $this->db->from('hutang as h');
                                                $this->db->join('angsuran as a', 'a.hutang_id = h.hutang_id', 'left');
                                                $this->db->where($where);
                                                $result1 = $this->db->get();
                                                $angsuran = $result1->row();

                                                echo 'Rp '.number_format($angsuran->angsuran_nilai_pembiayaan,0,",",".");
                                                
                                                ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $total = (int)$hutang->hutang_nilai - (int)$angsuran->angsuran_nilai_pembiayaan;
                                            echo 'Rp '.number_format($total,0,",",".");
                                            
                                            ?>
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