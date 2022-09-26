<section class="section">
    <div class="section-header">
        <h1>Laporan Investasi Project</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>investp">Laporan</a></div>
            <div class="breadcrumb-item">Investasi Project</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data</h4>
                        <div class="card-header-action">
                            <button type="button" onclick="printInvestP()"
                                class="btn btn-lg btn-primary rounded-pill">Print <i class="fas fa-print"></i></button>
                        </div>
                        <!-- <div class="card-header-action dropdown">
                            <input type="hidden" id="thn" value="<?= $yearnow ?>">

                            <div class="dropdown d-inline mr-1">
                                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="tahun"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $tahun ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-title">Pilih Tahun</div>
                                    <a class="dropdown-item <?= $tahun == $twoyearago ? 'active' : '' ?>" id="tya"
                                        href="javascript:void(0);"
                                        onclick="tya('<?= $twoyearago ?>')"><?= $twoyearago ?></a>
                                    <a class="dropdown-item <?= $tahun == $previousyear ? 'active' : '' ?>" id="py"
                                        href="javascript:void(0);"
                                        onclick="py('<?= $previousyear ?>')"><?= $previousyear ?></a>
                                    <a class="dropdown-item <?= $tahun == $yearnow ? 'active' : '' ?>" id="yn"
                                        href="javascript:void(0);" onclick="yn('<?= $yearnow ?>')"><?= $yearnow ?></a>
                                </div>
                            </div>

                            <a href="javascript:void(0);" onclick="filter()" class="btn btn-success mr-1">Filter <i
                                    class="fas fa-filter"></i></a>
                            <a href="<?= base_url() ?>estPendapatan" onclick="reset()" class="btn btn-danger ">Reset <i
                                    class="fas fa-undo"></i></a>
                        </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Project</th>
                                        <th>Customer</th>
                                        <th>Biaya Invest</th>
                                        <th>Pendapatan</th>
                                        <th>Balik Modal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($project as $d): ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= $d->project_nama ?></td>
                                        <td><?= $d->customer_nama ?></td>
                                        <td>
                                            <?php $this->db->select_sum('project_kontrak_nilai');
                                        // if($tglAwal != ''){
                                        //     $this->db->where('pendapatan_tgl_bayar >=', $tglAwal);
                                        //     $this->db->where('pendapatan_tgl_bayar <=', $tglAkhir);
                                        // }else{
                                        //     $this->db->where('YEAR(pendapatan_tgl_bayar)', $tahun);
                                        // }
                                        $this->db->where('project_id', $d->project_id);
                                        $data= $this->db->get('project');
                                        $binvest = $data->row();
                                        echo 'Rp '.number_format($binvest->project_kontrak_nilai,0,",",".");
                                        ?>
                                        </td>
                                        <td>
                                            <?php $this->db->select_sum('pendapatan_jml_tagihan');
                                        // if($tglAwal != ''){
                                        //     $this->db->where('pendapatan_tgl_bayar >=', $tglAwal);
                                        //     $this->db->where('pendapatan_tgl_bayar <=', $tglAkhir);
                                        // }else{
                                        //     $this->db->where('YEAR(pendapatan_tgl_bayar)', $tahun);
                                        // }
                                        $this->db->where('project_id', $d->project_id);
                                        $data2= $this->db->get('pendapatan');
                                        $tagihan = $data2->row();
                                        echo 'Rp '.number_format($tagihan->pendapatan_jml_tagihan,0,",",".");
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $balikmodal = (int)$binvest->project_kontrak_nilai - (int)$tagihan->pendapatan_jml_tagihan;
                                        if($balikmodal < 0){
                                            echo '<span class="badge badge-danger">Rp '.number_format($balikmodal,0,",",".")."</span>";
                                        }elseif($balikmodal == 0){
                                            echo '<span class="badge badge-secondary">Rp '.number_format($balikmodal,0,",",".")."</span>";
                                        }else{
                                            echo '<span class="badge badge-success">Rp '.number_format($balikmodal,0,",",".")."</span>";
                                        }
                                       
                                        
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