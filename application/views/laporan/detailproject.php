<?php 

 function getBulan($bulan)
{
    switch ($bulan) {
        case "January":
          return 'Januari';
          break;
        case "February":
            return 'Februari';
          break;
        case "March":
            return 'Maret';
          break;
        case "April":
            return 'April';
          break;
        case "May":
            return 'Mei';
          break;
        case "June":
            return 'Juni';
          break;
        case "July":
            return 'Juli';
          break;
        case "August":
            return 'Agustus';
          break;
        case "September":
            return 'September';
          break;
        case "October":
            return 'Oktober';
          break;
        case "November":
            return 'November';
          break;
        case "December":
            return 'Desember';
          break;
          
        default:
        return 'Semua';
      }
}

?>
<section class="section">
    <div class="section-header">
        <h1>Laporan Detail Projek</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>laporan">Laporan</a></div>
            <div class="breadcrumb-item">Detail Projek</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex">
                    <input type="hidden" id="bln" name="bln" value="<?= $bulan ?>">
                    <input type="hidden" id="thn" name="thn" value="<?= $tahun ?>">
                    <div class="fFilter mr-2 mb-3">
                        <select name="idP" id="idP" class="form-control chosen">
                            <option value="">--Pilih Project--</option>
                            <?php foreach($project as $p): ?>
                            <option value="<?= $p->project_id ?>" <?= ($p->project_id == $idp) ? "selected" : "" ?>>
                                <?= $p->project_nama ?> - <?= $p->customer_nama ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>

                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle mr-2"
                            id="bulan"><?= getBulan($bulan) ?></a>
                        <ul class="dropdown-menu dropdown-menu dropdown-menu-right">
                            <li class="dropdown-title">Pilih Bulan</li>
                            <li><a href="javascript:void(0);" id="jan"
                                    class="dropdown-item <?= $bulan == 'January' ? 'active' : '' ?>"
                                    onclick="jan()">Januari</a>
                            </li>
                            <li><a href="javascript:void(0);" id="feb"
                                    class="dropdown-item <?= $bulan == 'February' ? 'active' : '' ?>"
                                    onclick="feb()">Februari</a>
                            </li>
                            <li><a href="javascript:void(0);" id="mart"
                                    class="dropdown-item <?= $bulan == 'March' ? 'active' : '' ?>"
                                    onclick="mart()">Maret</a>
                            </li>
                            <li><a href="javascript:void(0);" id="apr"
                                    class="dropdown-item <?= $bulan == 'April' ? 'active' : '' ?>"
                                    onclick="apr()">April</a>
                            </li>
                            <li><a href="javascript:void(0);" id="may"
                                    class="dropdown-item <?= $bulan == 'May' ? 'active' : '' ?>" onclick="may()">Mei</a>
                            </li>
                            <li><a href="javascript:void(0);" id="jun"
                                    class="dropdown-item <?= $bulan == 'June' ? 'active' : '' ?>"
                                    onclick="jun()">Juni</a>
                            </li>
                            <li><a href="javascript:void(0);" id="jul"
                                    class="dropdown-item <?= $bulan == 'July' ? 'active' : '' ?>"
                                    onclick="jul()">Juli</a>
                            </li>
                            <li><a href="javascript:void(0);" id="agus"
                                    class="dropdown-item <?= $bulan == 'August' ? 'active' : '' ?>"
                                    onclick="agus()">Agustus</a>
                            </li>
                            <li><a href="javascript:void(0);" id="sep"
                                    class="dropdown-item <?= $bulan == 'September' ? 'active' : '' ?>"
                                    onclick="sep()">September</a>
                            </li>
                            <li><a href="javascript:void(0);" id="oct"
                                    class="dropdown-item <?= $bulan == 'October' ? 'active' : '' ?>"
                                    onclick="oct()">Oktober</a>
                            </li>
                            <li><a href="javascript:void(0);" id="nov"
                                    class="dropdown-item <?= $bulan == 'November' ? 'active' : '' ?>"
                                    onclick="nov()">November</a>
                            </li>
                            <li><a href="javascript:void(0);" id="dec"
                                    class="dropdown-item <?= $bulan == 'December' ? 'active' : '' ?>"
                                    onclick="dec()">Desember</a>
                            </li>
                            <li><a href="javascript:void(0);" class="dropdown-item" onclick="reset()">Reset</a>
                            </li>
                        </ul>

                    </div>

                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="tahun" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?= $tahun ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Pilih Tahun</div>
                            <a class="dropdown-item <?= $tahun == $twoyearago ? 'active' : '' ?>" id="tya"
                                href="javascript:void(0);" onclick="tya('<?= $twoyearago ?>')"><?= $twoyearago ?></a>
                            <a class="dropdown-item <?= $tahun == $previousyear ? 'active' : '' ?>" id="py"
                                href="javascript:void(0);" onclick="py('<?= $previousyear ?>')"><?= $previousyear ?></a>
                            <a class="dropdown-item <?= $tahun == $yearnow ? 'active' : '' ?>" id="yn"
                                href="javascript:void(0);" onclick="yn('<?= $yearnow ?>')"><?= $yearnow ?></a>
                        </div>
                    </div>

                    <div class="div">
                        <a href="javascript:void(0);" onclick="lihatDetail()" class="btn btn-success mr-2">Lihat <i
                                class="fas fa-eye"></i></a>
                    </div>
                    <div class="div">
                        <a href="<?= base_url() ?>detailproject" class="btn btn-danger mr-2">Reset <i
                                class="fas fa-undo"></i></a>
                    </div>
                    <div class="div">
                        <a href="javascript:void(0);" onclick="printdp()" class="btn btn-primary">Print <i
                                class="fas fa-print"></i></a>
                    </div>

                </div>
            </div>


        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php if($idp == ''): ?>
                        <div class="row">
                            <div class="col-lg-5">
                                <h5>...</h5>
                                <h5>...</h5>
                                <h5><?= $bulan ?>, <?=  $tahun ?></h5>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between">
                                    <h5>Pendapatan</h5>
                                    <h5>
                                        Rp 0
                                    </h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Pembiayaan</h5>
                                    <h5>Rp 0</h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Margin</h5>
                                    <h5>Rp 0</h5>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>

                        <?php foreach($dproject as $d): ?>

                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                                <h5><?= $d->customer_nama ?></h5>
                                <h5><?= $d->project_nama ?></h5>
                                <h5><?= $bulan ?>, <?=  $tahun ?></h5>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="d-flex justify-content-between">
                                    <h5>Pendapatan</h5>
                                    <h5>
                                        <?php $this->db->select_sum('pendapatan_jml_tagihan');
                                        if($tglAwal != ''){
                                            $this->db->where('pendapatan_tgl_bayar >=', $tglAwal);
                                            $this->db->where('pendapatan_tgl_bayar <=', $tglAkhir);
                                        }else{
                                            $this->db->where('YEAR(pendapatan_tgl_bayar)', $tahun);
                                        }
                                        $this->db->where('project_id', $idp);
                                        $data= $this->db->get('pendapatan');
                                        $tagihan = $data->row();
                                        echo 'Rp '.number_format($tagihan->pendapatan_jml_tagihan,0,",",".")
                                        ?>
                                    </h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Pembiayaan</h5>
                                    <h5>
                                        <?php 
                                    $this->db->select_sum('pembiayaan_nilai_realisasi');
                                    if($tglAwal != ''){
                                      $this->db->where('pembiayaan_tgl >=', $tglAwal);
                                      $this->db->where('pembiayaan_tgl <=', $tglAkhir);
                                    }else{
                                      $this->db->where('YEAR(pembiayaan_tgl)', $tahun);
                                    }
                                    $this->db->where('project_id', $idp);
                                    $data= $this->db->get('pembiayaan');
                                    $prjk = $data->row();
                                    //echo 'Rp '.number_format($prjk->pembiayaan_nilai_realisasi,0,",",".")

                                    $this->db->select_sum('a.angsuran_nilai_pembiayaan');
                                    $this->db->from('angsuran as a');
                                    
                                    $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id', 'left');
                                    $this->db->join('project as p', 'p.project_id = h.project_id', 'left');
                                    $this->db->where('h.project_id', $idp);
                                    $data= $this->db->get();
                                    $ags = $data->row();
                                   // echo 'Rp '.number_format($ags->pembiayaan_nilai_realisasi,0,",",".")

                                   $total = intval($prjk->pembiayaan_nilai_realisasi) + intval($ags->angsuran_nilai_pembiayaan);
                                   echo 'Rp '.number_format($total,0,",",".");
                                //    echo 'Rp '.number_format($prjk->pembiayaan_nilai_realisasi,0,",",".")
                                    ?>
                                    </h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Margin</h5>
                                    <h5>
                                        <?php 
                                    $pndptn = $tagihan->pendapatan_jml_tagihan;
                                    $pmbyaan =  $total;
                                    $margin = intval($pndptn) - intval($pmbyaan);
                                    echo 'Rp '.number_format($margin, 0,",",".");
                                    ?>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>Kategori Biaya</th>
                                    <th>Nilai Realisasi</th>
                                </tr>
                                <tbody>
                                    <?php if($idp == ''): ?>
                                    <tr>
                                        <td>...</td>
                                        <td>...</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php foreach($katbiaya as $k): ?>
                                    <tr>
                                        <td><?= $k->katbiaya_nama ?></td>
                                        <td>
                                            <?php 
                                        
                                        $this->db->select_sum('pembiayaan_nilai_realisasi');
                                        if($tglAwal != ''){
                                            $this->db->where('pembiayaan_tgl >=', $tglAwal);
                                            $this->db->where('pembiayaan_tgl <=', $tglAkhir);
                                        }else{
                                            $this->db->where('YEAR(pembiayaan_tgl)', $tahun);
                                        }
                                        $this->db->where('katbiaya_id', $k->katbiaya_id);
                                        $this->db->where('project_id', $idp);
                                        $dataPbym= $this->db->get('pembiayaan');
                                        $pembiayaan = $dataPbym->row();
                                        // echo 'Rp '.number_format($pembiayaan->pembiayaan_nilai_realisasi,0,",",".") ;

                                        $this->db->select_sum('a.angsuran_nilai_pembiayaan');
                                        $this->db->from('angsuran as a');
                                        
                                        $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id', 'left');
                                        $this->db->join('project as p', 'p.project_id = h.project_id', 'left');
                                        $this->db->where('h.project_id', $idp);
                                        $data1= $this->db->get();
                                        $ags = $data1->row();

                                        $subAgs = $k->katbiaya_nama != "BIAYA BANK" ? intval(0) : intval($ags->angsuran_nilai_pembiayaan);

                                        $ttl = intval($pembiayaan->pembiayaan_nilai_realisasi + intval($subAgs));
                                        echo 'Rp '.number_format($ttl,0,",",".");
                                        ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>