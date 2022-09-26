<section class="section">
    <div class="section-body">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12 mt-4 mb-5">
                <div class="d-flex">
                    <img class="mr-3 rounded" width="120" src="<?= base_url() ?>assets/icon/logoBKU-circle.png">
                    <div>
                        <h1>PT Bintang Komunikasi Utama</h1>
                        <h4>Laporan Estimasi Pendapatan - <?= $tahun ?></h4>
                        <h4><?php 
                        if($idC == ''){
                            echo '-';
                        }else{
                            $this->db->select('*');
                            $this->db->where('customer_id', $idC);
                            $subC= $this->db->get('customer');
                            $hasilC = $subC->row();
                            echo $hasilC->customer_nama;
                        }
                        ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <table class="tabel" width="100%">
                <tr>
                    <th>Bulan</th>
                    <th>Pendapatan</th>
                </tr>
                <tr>
                    <td>Januari</td>
                    <td>
                        <?php 

                                        $blnJanuari= $tahun.'-01';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data1= $this->db->get();
                                        $jan = $data1->row();

                                        $ttl1 = intval($hasil1->project_kontrak_nilai == null ? 0 : $hasil1->project_kontrak_nilai) + intval($jan->project_kontrak_nilai == null ? 0 : $jan->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl1);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Februari</td>
                    <td>
                        <?php 

                                        $blnFeb= $tahun.'-02';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data2= $this->db->get();
                                        $feb = $data2->row();

                                        $ttl2 = intval($hasil2->project_kontrak_nilai == null ? 0 : $hasil2->project_kontrak_nilai) + intval($feb->project_kontrak_nilai == null ? 0 : $feb->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl2);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Maret</td>
                    <td>
                        <?php 

                                        $blnMar= $tahun.'-03';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data3= $this->db->get();
                                        $mar = $data3->row();

                                        $ttl3 = intval($hasil3->project_kontrak_nilai == null ? 0 : $hasil3->project_kontrak_nilai) + intval($mar->project_kontrak_nilai == null ? 0 : $mar->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl3);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>April</td>
                    <td>
                        <?php 

                                        $blnApr= $tahun.'-04';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data4= $this->db->get();
                                        $april = $data4->row();

                                        $ttl4 = intval($hasil4->project_kontrak_nilai == null ? 0 : $hasil4->project_kontrak_nilai) + intval($april->project_kontrak_nilai == null ? 0 : $april->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl4);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Mei</td>
                    <td>
                        <?php 

                                        $blnMei= $tahun.'-05';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data5= $this->db->get();
                                        $mei = $data5->row();

                                        $ttl5 = intval($hasil5->project_kontrak_nilai == null ? 0 : $hasil5->project_kontrak_nilai) + intval($mei->project_kontrak_nilai == null ? 0 : $mei->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl5);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Juni</td>
                    <td>
                        <?php 

                                        $blnJuni= $tahun.'-06';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data6= $this->db->get();
                                        $jun = $data6->row();

                                        $ttl6 = intval($hasil6->project_kontrak_nilai == null ? 0 : $hasil6->project_kontrak_nilai) + intval($jun->project_kontrak_nilai == null ? 0 : $jun->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl6);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Juli</td>
                    <td>
                        <?php 
                                        
                                        
                                        $blnJuli= $tahun.'-07';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data7= $this->db->get();
                                        $jul = $data7->row();

                                        $ttl7 = intval($hasil7->project_kontrak_nilai == null ? 0 : $hasil7->project_kontrak_nilai) + intval($jul->project_kontrak_nilai == null ? 0 : $jul->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl7);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Agustus</td>
                    <td>
                        <?php 
                                        
                                        $blnAgs= $tahun.'-08';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data8= $this->db->get();
                                        $ags = $data8->row();

                                        $ttl8 = intval($hasil8->project_kontrak_nilai == null ? 0 : $hasil8->project_kontrak_nilai) + intval($ags->project_kontrak_nilai == null ? 0 : $ags->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl8);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>September</td>
                    <td>
                        <?php 
                                        
                                        $blnSep= $tahun.'-09';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data9= $this->db->get();
                                        $sep = $data9->row();

                                        $ttl9 = intval($hasil9->project_kontrak_nilai == null ? 0 : $hasil9->project_kontrak_nilai) + intval($sep->project_kontrak_nilai == null ? 0 : $sep->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl9);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Oktober</td>
                    <td>
                        <?php 
                                        
                                        $blnOkt= $tahun.'-10';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data10= $this->db->get();
                                        $okt = $data10->row();

                                        $ttl10 = intval($hasil10->project_kontrak_nilai == null ? 0 : $hasil10->project_kontrak_nilai) + intval($okt->project_kontrak_nilai == null ? 0 : $okt->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl10);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>November</td>
                    <td>
                        <?php 
                                        
                                        $blnNov= $tahun.'-11';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data11= $this->db->get();
                                        $nov = $data11->row();

                                        $ttl11 = intval($hasil11->project_kontrak_nilai == null ? 0 : $hasil11->project_kontrak_nilai) + intval($nov->project_kontrak_nilai == null ? 0 : $nov->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl11);
                                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Desember</td>
                    <td>
                        <?php 
                                        
                                        $blnNov= $tahun.'-12';

                                        $this->db->select_sum('project_kontrak_nilai');
                                        $this->db->where('project_layanan', 'Jual');
                                        if($idC != ''){
                                            $this->db->where('customer_id', $idC);
                                        }
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
                                        if($idC != ''){
                                            $this->db->where('p.customer_id', $idC);
                                        }

                                        $data12= $this->db->get();
                                        $des = $data12->row();

                                        $ttl12 = intval($hasil12->project_kontrak_nilai == null ? 0 : $hasil12->project_kontrak_nilai) + intval($des->project_kontrak_nilai == null ? 0 : $des->project_kontrak_nilai);
                                        echo 'Rp '.number_format($ttl12);
                                        ?>
                    </td>
                </tr>

                <tr>
                    <th class=""><b>TOTAL</b></th>
                    <th class=""><b><?php 
                    $ttlK = $ttl1 + $ttl12 + $ttl3 + $ttl4 + $ttl5 + $ttl6 + $ttl7 + $ttl8 + $ttl9 + $ttl10 + $ttl11 + $ttl12;
                    echo 'Rp '.number_format($ttlK);
                                    
                    ?></b></th>
                </tr>
            </table>
        </div>

    </div>
</section>