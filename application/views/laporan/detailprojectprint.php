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


    <div class="section-body">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12 mt-4 mb-5">
                <div class="d-flex">
                    <img class="mr-3 rounded" width="120" src="<?= base_url() ?>assets/icon/logoBKU-circle.png">
                    <div>
                        <h1>PT Bintang Komunikasi Utama</h1>
                        <h4><?= getBulan($bulan) ?> - <?= $tahun ?></h4>
                        <h4>Laporan Detail Project</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if($idp == ''): ?>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                                <h5>...</h5>
                                <h5>...</h5>
                                <h5><?= $bulan ?>, <?=  $tahun ?></h5>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12">
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
                                    echo 'Rp '.number_format($prjk->pembiayaan_nilai_realisasi,0,",",".")
                                    ?>
                                    </h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Margin</h5>
                                    <h5>
                                        <?php 
                                    $pndptn = $tagihan->pendapatan_jml_tagihan;
                                    $pmbyaan = $prjk->pembiayaan_nilai_realisasi;
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
                                        $data= $this->db->get('pembiayaan');
                                        $pembiayaan = $data->row();
                                        echo 'Rp '.number_format($pembiayaan->pembiayaan_nilai_realisasi,0,",",".") ;
                                        
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