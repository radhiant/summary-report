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
    <div class="section-header">
        <h1>Laporan Per Projek</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>laporan">Laporan</a></div>
            <div class="breadcrumb-item">Per Projek</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data</h4>
                        <div class="card-header-action d-flex">

                            <input type="hidden" id="bln" name="bln" value="<?= $bulan ?>">
                            <input type="hidden" id="thn" name="thn" value="<?= $tahun ?>">

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
                                            class="dropdown-item <?= $bulan == 'May' ? 'active' : '' ?>"
                                            onclick="may()">Mei</a>
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
                                <button class="btn btn-primary dropdown-toggle" type="button" id="tahun"
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

                            <a href="javascript:void(0);" onclick="filter()" class="btn btn-success mr-2">Filter <i
                                    class="fas fa-filter"></i></a>
                            <a href="javascript:void(0);" onclick="printprojek()" class="btn btn-primary">Print <i
                                    class="fas fa-print"></i></a>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tableP" width="100%">
                            <thead>
                                <th>Project</th>
                                <th>Customer</th>
                                <th>Layanan</th>
                                <th width="17%">Pendapatan</th>
                                <th width="17%">Pembiayaan</th>
                                <th width="17%">Margin</th>
                            </thead>
                            <tbody>
                                <?php foreach($project as $p): ?>
                                <tr>
                                    <td><?= $p->project_nama ?></td>
                                    <td><?= $p->customer_nama ?></td>
                                    <td>
                                        <?php if($p->project_layanan == 'Sewa'): ?>
                                        <span class="badge badge-primary"><?= $p->project_layanan ?></span>
                                        <?php elseif($p->project_layanan == 'Jual'): ?>
                                        <span class="badge badge-success"><?= $p->project_layanan ?></span>
                                        <?php elseif($p->project_layanan == 'Repair'): ?>
                                        <span class="badge badge-warning"><?= $p->project_layanan ?></span>
                                        <?php else: ?>
                                        <span class="badge badge-warning"><?= $p->project_layanan ?></span>
                                        <?php endif; ?>
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
            </div>
        </div>

    </div>

</section>