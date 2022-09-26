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
                            <th width="1%" class="">No</th>
                            <th class="">Project</th>
                            <th class="">Bank/Leasing</th>
                            <th class="">Nilai Hutang</th>
                            <th class="">Hutang Terbayar</th>
                            <th class="">Sisa Hutang</th>
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



</section>