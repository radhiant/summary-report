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

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12 mt-4 mb-5">
                    <div class="d-flex">
                        <img class="mr-3 rounded" width="100" src="<?= base_url() ?>assets/icon/logoBKU-circle.png">
                        <div>
                            <h1>PT Bintang Komunikasi Utama</h1>
                            <!-- <h4><?= getBulan($bulan) ?> - <?= $tahun ?></h4> -->
                            <h4>Laporan Hutang</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table rounded" id="table-1" width="100%">
                        <tr>
                            <th width="1%">No</th>
                            <th>Project</th>
                            <th>Customer</th>
                            <th>Biaya Invest</th>
                            <th>Pendapatan</th>
                            <th>Balik Modal</th>
                            <tbody>
                                <?php $no=1; foreach($project as $d): ?>
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
                                        echo 'Rp '.number_format($balikmodal,0,",",".");
                                       
                                        
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



</section>