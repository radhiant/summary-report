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
        return 'Pilih Bulan';
      }
}

?>

<section class="section">

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12 mt-4 mb-5">
                <div class="d-flex">
                    <img class="mr-3 rounded" width="100" src="<?= base_url() ?>assets/icon/logoBKU-circle.png">
                    <div>
                        <h1>PT Bintang Komunikasi Utama</h1>
                        <h4><?= getBulan($bulan) ?> - <?= $tahun ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <table class="tabel" width="100%">
                <thead>
                    <th><h5>Project</h5></th>
                    <th><h5>Customer</h5></th>
                    <th><h5>Layanan</h5></th>
                    <th width="17%"><h5>Pendapatan</h5></th>
                    <th width="17%"><h5>Pembiayaan</h5></th>
                    <th width="17%"><h5>Margin</h5></th>
                </thead>
                <tbody>
                    <?php foreach($project as $p): ?>
                    <tr>
                        <td><?= $p->project_nama ?></td>
                        <td><?= $p->customer_nama ?></td>
                        <td>
                            <?= $p->project_layanan ?>
                        </td>
                        <td>
                            <?php 
                                        
                                        $this->db->select_sum('pendapatan_jml_tagihan');
                                        if($tglAwal != ''){
                                            $this->db->where('pendapatan_tgl_bayar >=', $tglAwal);
                                            $this->db->where('pendapatan_tgl_bayar <=', $tglAkhir);
                                        }else{
                                            $this->db->where('YEAR(pendapatan_tgl_bayar)', $tahun);
                                        }
                                        $this->db->where('project_id', $p->project_id);
                                        $data= $this->db->get('pendapatan');
                                        $pendapatan = $data->row();
                                        echo 'Rp '.number_format($pendapatan->pendapatan_jml_tagihan,0,",",".") ;
                                        
                                        ?>
                        </td>
                        <td>
                            <?php 
                                        
                                        $this->db->select_sum('pembiayaan_nilai_realisasi');
                                        if($tglAwal != ''){
                                            $this->db->where('pembiayaan_tgl >=', $tglAwal);
                                            $this->db->where('pembiayaan_tgl <=', $tglAkhir);
                                        }else{
                                            $this->db->where('YEAR(pembiayaan_tgl)', $tahun);
                                        }
                                        $this->db->where('project_id', $p->project_id);
                                        $data1= $this->db->get('pembiayaan');
                                        $pembiayaan = $data1->row();

                                        $this->db->select_sum('a.angsuran_nilai_pembiayaan');
                                        $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id', 'left');
                                        $this->db->join('project as p', 'p.project_id = h.project_id', 'left');

                                        if($tglAwal != ''){
                                            $this->db->where('a.angsuran_tgl >=', $tglAwal);
                                            $this->db->where('a.angsuran_tgl <=', $tglAkhir);
                                        }else{
                                            $this->db->where('YEAR(a.angsuran_tgl)', $tahun);
                                        }
                                        $this->db->where('p.project_id', $p->project_id);
                                        $data2= $this->db->get('angsuran as a');
                                        $angsuran = $data2->row();

                                        $totalPembiayaan = intval($pembiayaan->pembiayaan_nilai_realisasi) + intval($angsuran->angsuran_nilai_pembiayaan);
                                        echo 'Rp '.number_format($totalPembiayaan,0,",",".");
                                        
                                        ?>
                        </td>
                        <td>
                            <?php 
                                        $margin = intval($pendapatan->pendapatan_jml_tagihan) - intval($totalPembiayaan); 
                                        echo 'Rp '.number_format($margin,0,",",".");
                                        ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</section>