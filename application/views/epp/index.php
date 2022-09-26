
<section class="section">
    <div class="section-header">
        <h1>Estimasi Pendapatan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>estPendapatan">Estimasi Pendapatan</a></div>
            <div class="breadcrumb-item">Data</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data</h4>
                        <div class="card-header-action dropdown">
                            <input type="hidden" id="thn" value="<?= $yearnow ?>">

                            <a href="<?= base_url() ?>epp/tambah" class="btn btn-primary mr-1">Tambah
                                <i class="fas fa-plus"></i></a>

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
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped text-nowrap">
                                <tr>
                                    <th width="1%">#</th>
                                    <th>Project</th>
                                    <th>Customer</th>
                                    <th>Januari</th>
                                    <th>Februari</th>
                                    <th>Maret</th>
                                    <th>April</th>
                                    <th>Mei</th>
                                    <th>Juni</th>
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th colspan="3" class="bg-success">
                                            <center>
                                                <h5 class="text-white">Jumlah</h5>
                                            </center>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnJanuari= $tahun.'-01';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnJanuari);
                                        $getLayanan1= $this->db->get('project');
                                        $hasil1 = $getLayanan1->row();
                                        
                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Januari');

                                        $this->db->where_not_in('p.project_layanan', 'Jual');

                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data1= $this->db->get();
                                        $jan = $data1->row();

                                        $ttl1 = intval($hasil1->project_kontrak_nilai == null ? 0 : $hasil1->project_kontrak_nilai) + intval($jan->project_kontrak_nilai == null ? 0 : $jan->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl1);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnFeb= $tahun.'-02';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnFeb);
                                        $getLayanan2= $this->db->get('project');
                                        $hasil2 = $getLayanan2->row();
                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Februari');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data2= $this->db->get();
                                        $feb = $data2->row();

                                        $ttl2 = intval($hasil2->project_kontrak_nilai == null ? 0 : $hasil2->project_kontrak_nilai) + intval($feb->project_kontrak_nilai == null ? 0 : $feb->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl2);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnMar= $tahun.'-03';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnMar);
                                        $getLayanan3= $this->db->get('project');
                                        $hasil3 = $getLayanan3->row();
                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Maret');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data3= $this->db->get();
                                        $mar = $data3->row();

                                        $ttl3 = intval($hasil3->project_kontrak_nilai == null ? 0 : $hasil3->project_kontrak_nilai) + intval($mar->project_kontrak_nilai == null ? 0 : $mar->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl3);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnApr= $tahun.'-04';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnApr);
                                        $getLayanan4= $this->db->get('project');
                                        $hasil4 = $getLayanan4->row();
                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'April');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data4= $this->db->get();
                                        $april = $data4->row();

                                        $ttl4 = intval($hasil4->project_kontrak_nilai == null ? 0 : $hasil4->project_kontrak_nilai) + intval($april->project_kontrak_nilai == null ? 0 : $april->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl4);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnMei= $tahun.'-05';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnMei);
                                        $getLayanan5= $this->db->get('project');
                                        $hasil5 = $getLayanan5->row();
                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Mei');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data5= $this->db->get();
                                        $mei = $data5->row();

                                        $ttl5 = intval($hasil5->project_kontrak_nilai == null ? 0 : $hasil5->project_kontrak_nilai) + intval($mei->project_kontrak_nilai == null ? 0 : $mei->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl5);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 

                                        $blnJuni= $tahun.'-06';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnJuni);
                                        $getLayanan6= $this->db->get('project');
                                        $hasil6 = $getLayanan6->row();

                                        
                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Juni');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data6= $this->db->get();
                                        $jun = $data6->row();

                                        $ttl6 = intval($hasil6->project_kontrak_nilai == null ? 0 : $hasil6->project_kontrak_nilai) + intval($jun->project_kontrak_nilai == null ? 0 : $jun->project_kontrak_nilai);
                                        
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl6);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        
                                        $blnJuli= $tahun.'-07';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnJuli);
                                        $getLayanan7= $this->db->get('project');
                                        $hasil7 = $getLayanan7->row();


                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Juli');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data7= $this->db->get();
                                        $jul = $data7->row();

                                        $ttl7 = intval($hasil7->project_kontrak_nilai == null ? 0 : $hasil7->project_kontrak_nilai) + intval($jul->project_kontrak_nilai == null ? 0 : $jul->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl7);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        $blnAgs= $tahun.'-08';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnAgs);
                                        $getLayanan8= $this->db->get('project');
                                        $hasil8 = $getLayanan8->row();

                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Agustus');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data8= $this->db->get();
                                        $ags = $data8->row();

                                        $ttl8 = intval($hasil8->project_kontrak_nilai == null ? 0 : $hasil8->project_kontrak_nilai) + intval($ags->project_kontrak_nilai == null ? 0 : $ags->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl8);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        $blnSep= $tahun.'-09';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnSep);
                                        $getLayanan9= $this->db->get('project');
                                        $hasil9 = $getLayanan9->row();


                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'September');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data9= $this->db->get();
                                        $sep = $data9->row();

                                        $ttl9 = intval($hasil9->project_kontrak_nilai == null ? 0 : $hasil9->project_kontrak_nilai) + intval($sep->project_kontrak_nilai == null ? 0 : $sep->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl9);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        $blnOkt= $tahun.'-10';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnOkt);
                                        $getLayanan10= $this->db->get('project');
                                        $hasil10 = $getLayanan10->row();

                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Oktober');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data10= $this->db->get();
                                        $okt = $data10->row();

                                        $ttl10 = intval($hasil10->project_kontrak_nilai == null ? 0 : $hasil10->project_kontrak_nilai) + intval($okt->project_kontrak_nilai == null ? 0 : $okt->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl10);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        $blnNov= $tahun.'-11';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnNov);
                                        $getLayanan11= $this->db->get('project');
                                        $hasil11 = $getLayanan11->row();

                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'November');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data11= $this->db->get();
                                        $nov = $data11->row();

                                        $ttl11 = intval($hasil11->project_kontrak_nilai == null ? 0 : $hasil11->project_kontrak_nilai) + intval($nov->project_kontrak_nilai == null ? 0 : $nov->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl11);
                                        }
                                        ?>
                                        </th>
                                        <th class="bg-secondary">
                                            <?php 
                                        
                                        $blnNov= $tahun.'-12';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->like('project_kontrak_start', $blnNov);
                                        $getLayanan12= $this->db->get('project');
                                        $hasil12 = $getLayanan12->row();

                                        $this->db->select_sum('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Desember');
                                        $this->db->where_not_in('p.project_layanan', 'Jual');
                                        $this->db->where('e.epp_tahun', $tahun);

                                        $data12= $this->db->get();
                                        $des = $data12->row();

                                        $ttl12 = intval($hasil12->project_kontrak_nilai == null ? 0 : $hasil12->project_kontrak_nilai) + intval($des->project_kontrak_nilai == null ? 0 : $des->project_kontrak_nilai);
                                        if(empty($epp)){
                                            echo 'Rp 0';
                                        }else{
                                            echo 'Rp '.number_format($ttl12);
                                        }
                                        ?>
                                        </th>
                                    </tr>
                                    <?php foreach($epp as $d): ?>
                                    <tr>
                                        <td> <a href="#"
                                                onclick="konfirmasi('<?= $d->project_id ?>', '<?= $d->epp_tahun ?>')"
                                                class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> </a> </td>
                                        <td><?= $d->project_nama ?></td>
                                        <td><?= $d->customer_nama ?></td>
                                        <td>
                                            <?php 
                                        
                                        $bJan= $tahun.'-01';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR1= $this->db->get('project');
                                        $result1 = $subR1->row();
                                        $tglAwal1 = $result1 == null ? '' : substr($result1->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Januari');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $jan1= $this->db->get();
                                        $blnJan = $jan1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal1 != $bJan){
                                                echo '-';
                                            }else{
                                                echo $blnJan == null ? '-' : 'Rp '.number_format($blnJan->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnJan == null ? '-' : 'Rp '.number_format($blnJan->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bFeb= $tahun.'-02';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR2= $this->db->get('project');
                                        $result2 = $subR2->row();
                                        $tglAwal2 = $result2 == null ? '' : substr($result2->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Februari');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $feb1= $this->db->get();
                                        $blnFeb = $feb1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal2 != $bFeb){
                                                echo '-';
                                            }else{
                                                echo $blnFeb == null ? '-' : 'Rp '.number_format($blnFeb->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnFeb == null ? '-' : 'Rp '.number_format($blnFeb->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bMar= $tahun.'-03';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR3= $this->db->get('project');
                                        $result3 = $subR3->row();
                                        $tglAwal3 = $result3 == null ? '' : substr($result3->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Maret');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $mar1= $this->db->get();
                                        $blnMar = $mar1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal3 != $bMar){
                                                echo '-';
                                            }else{
                                                echo $blnMar == null ? '-' : 'Rp '.number_format($blnMar->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnMar == null ? '-' : 'Rp '.number_format($blnMar->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bApril= $tahun.'-04';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR4= $this->db->get('project');
                                        $result4 = $subR4->row();
                                        $tglAwal4 = $result4 == null ? '' : substr($result4->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'April');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $apr1= $this->db->get();
                                        $blnApr = $apr1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal4 != $bApril){
                                                echo '-';
                                            }else{
                                                echo $blnApr == null ? '-' : 'Rp '.number_format($blnApr->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnApr == null ? '-' : 'Rp '.number_format($blnApr->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bMei= $tahun.'-05';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR5= $this->db->get('project');
                                        $result5 = $subR5->row();
                                        $tglAwal5 = $result5 == null ? '' : substr($result5->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Mei');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $mei1= $this->db->get();
                                        $blnMei = $mei1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal5 != $bMei){
                                                echo '-';
                                            }else{
                                                echo $blnMei == null ? '-' : 'Rp '.number_format($blnMei->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnMei == null ? '-' : 'Rp '.number_format($blnMei->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 

                                        $bJun= $tahun.'-06';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR6= $this->db->get('project');
                                        $result6 = $subR6->row();
                                        $tglAwal6 = $result6 == null ? '' : substr($result6->project_kontrak_start,0,7);
                                        
                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Juni');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $jun1= $this->db->get();
                                        $blnJun = $jun1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal6 != $bJun){
                                                echo '-';
                                            }else{
                                                echo $blnJun == null ? '-' : 'Rp '.number_format($blnJun->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnJun == null ? '-' : 'Rp '.number_format($blnJun->project_kontrak_nilai,0,",",".");
                                        }
                                        
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bJul= $tahun.'-07';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR7= $this->db->get('project');
                                        $result7 = $subR7->row();
                                        $tglAwal7 = $result7 == null ? '' : substr($result7->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Juli');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $jul1= $this->db->get();
                                        $blnJul = $jul1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal7 != $bJul){
                                                echo '-';
                                            }else{
                                                echo $blnJul == null ? '-' : 'Rp '.number_format($blnJul->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnJul == null ? '-' : 'Rp '.number_format($blnJul->project_kontrak_nilai,0,",",".");
                                        }
                                        
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bAgs= $tahun.'-08';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR8= $this->db->get('project');
                                        $result8 = $subR8->row();
                                        $tglAwal8 = $result8 == null ? '' : substr($result8->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Agustus');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $ags1= $this->db->get();
                                        $blnAgs = $ags1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal8 != $bAgs){
                                                echo '-';
                                            }else{
                                                echo $blnAgs == null ? '-' : 'Rp '.number_format($blnAgs->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnAgs == null ? '-' : 'Rp '.number_format($blnAgs->project_kontrak_nilai,0,",",".");
                                        }

                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bSep= $tahun.'-09';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR9= $this->db->get('project');
                                        $result9 = $subR9->row();
                                        $tglAwal9 = $result9 == null ? '' : substr($result9->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'September');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $sep1= $this->db->get();
                                        $blnSep = $sep1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal9 != $bSep){
                                                echo '-';
                                            }else{
                                                echo $blnSep == null ? '-' : 'Rp '.number_format($blnSep->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnSep == null ? '-' : 'Rp '.number_format($blnSep->project_kontrak_nilai,0,",",".");
                                        }

                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bOkt= $tahun.'-10';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR10= $this->db->get('project');
                                        $result10 = $subR10->row();
                                        $tglAwal10 = $result10 == null ? '' : substr($result10->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Oktober');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $ok1= $this->db->get();
                                        $blnOkt = $ok1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal10 != $bOkt){
                                                echo '-';
                                            }else{
                                                echo $blnOkt == null ? '-' : 'Rp '.number_format($blnOkt->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnOkt == null ? '-' : 'Rp '.number_format($blnOkt->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bNov= $tahun.'-11';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR11= $this->db->get('project');
                                        $result11 = $subR11->row();
                                        $tglAwal11 = $result11 == null ? '' : substr($result11->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'November');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $nov1= $this->db->get();
                                        $blnNov = $nov1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal11 != $bNov){
                                                echo '-';
                                            }else{
                                                echo $blnNov == null ? '-' : 'Rp '.number_format($blnNov->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnNov == null ? '-' : 'Rp '.number_format($blnNov->project_kontrak_nilai,0,",",".");
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php 
                                        
                                        $bDes= $tahun.'-12';

                                        $this->db->select('*');
                                        $this->db->where('project_layanan', 'Jual');
                                        $this->db->where('project_id', $d->project_id);
                                        $subR12= $this->db->get('project');
                                        $result12 = $subR12->row();
                                        $tglAwal12 = $result12 == null ? '' : substr($result12->project_kontrak_start,0,7);

                                        $this->db->select('p.project_kontrak_nilai');
                                        $this->db->from('epp as e');
                                        $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
                                        $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
                                        $this->db->where('e.epp_bulan', 'Desember');
                                        $this->db->where('e.epp_tahun', $tahun);
                                        $this->db->where('e.project_id', $d->project_id);

                                        $des1= $this->db->get();
                                        $blnDes = $des1->row();

                                        if($d->project_layanan == 'Jual'){
                                            if($tglAwal12 != $bDes){
                                                echo '-';
                                            }else{
                                                echo $blnDes == null ? '-' : 'Rp '.number_format($blnDes->project_kontrak_nilai,0,",",".");
                                            }
                                        }else{
                                            echo $blnDes == null ? '-' : 'Rp '.number_format($blnDes->project_kontrak_nilai,0,",",".");
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