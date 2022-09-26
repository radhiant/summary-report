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
        <h1>Laporan Non Investasi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>laporan">Laporan</a></div>
            <div class="breadcrumb-item">Non Investasi</div>
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

                            <a href="javascript:void(0);" onclick="filterni()" class="btn btn-success mr-2">Filter <i
                                    class="fas fa-filter"></i></a>
                            <a href="javascript:void(0);" onclick="printprojekni()" class="btn btn-primary">Print <i
                                    class="fas fa-print"></i></a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" width="100%" id="tableP">
                                <thead>
                                    <th>Kategori Biaya</th>
                                    <th>Nilai Realisasi</th>
                                </thead>
                                <tbody>
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
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>