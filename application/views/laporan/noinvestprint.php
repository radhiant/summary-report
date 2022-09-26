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
                        <h4>Laporan Non Investasi</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="tabel" width="100%">
                    <tr>
                        <th>Kategori Biaya</th>
                        <th>Nilai Realisasi</th>
                    </tr>
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
                                        $this->db->where('pembiayaan_beban_biaya', 'Non Project');
                                        $data= $this->db->get('pembiayaan');
                                        $pembiayaan = $data->row();
                                        echo 'Rp '.number_format($pembiayaan->pembiayaan_nilai_realisasi,0,",",".") ;
                                        
                                        ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</section>