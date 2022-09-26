<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('pendapatan_model');
        $this->load->model('project_model');

        if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
            redirect('login/logout');
            exit;
        }else{
            if($this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '2'){
            
            }else{
                redirect('pembiayaan');
            }
        }
        
      }

      public function index()
	{   
        $data['judul'] = "Pendapatan";
        
		$this->load->view('templates/header', $data);
		$this->load->view('pendapatan/index');
		$this->load->view('js/pendapatanjs');
		$this->load->view('templates/footer');
    }

    public function tambah()
	{   
        $data['judul'] = "Pendapatan";
        $data['project'] = $this->project_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pendapatan/tambah');
		$this->load->view('js/pendapatanjs');
		$this->load->view('templates/footer');
    }

    public function ubah($id)
	{   
        $data['judul'] = "Pendapatan";
        $where = array('pendapatan_id' => $id);

        $data['project'] = $this->project_model->dataJoin()->result();
        $data['data'] = $this->pendapatan_model->detail_data($where, 'pendapatan')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pendapatan/ubah');
		$this->load->view('js/pendapatanjs');
		$this->load->view('templates/footer');
    }

    public function detail($id)
	{   
        $data['judul'] = "Pendapatan";
        $data['data'] = $this->pendapatan_model->detailJoin($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pendapatan/detail');
		$this->load->view('js/pendapatanjs');
		$this->load->view('templates/footer');
    }

    public function getNilaiKontrak()
	{
		$id = $this->input->post('id');
    	$where = array('project_id' => $id );
    	$data = $this->project_model->detail_data($where, 'project')->result();
    	echo json_encode($data);
	}

    public function proses_tambah()
    {
        $kode = $this->pendapatan_model->buat_kode();
		$idP = $this->input->post('idP');
		$periode = $this->input->post('periode');
		$tglP = $this->input->post('tglP');
        $tglT = $this->input->post('tglT');
        $jmlT = $this->input->post('jmlT');
        $ket = $this->input->post('ket');

        $tglP1 = strtotime($tglP);
        $formatTglP = date('Y-m-d',$tglP1);

        $tglT1 = strtotime($tglT);
        $formatTglT = date('Y-m-d',$tglT1);


        $data = array(
            'project_id' => $idP,
            'pendapatan_periode' => $periode,
            'pendapatan_tgl_penagihan' => $formatTglP,
            'pendapatan_tgl_tempo' => $formatTglT,
            'pendapatan_jml_tagihan' => $jmlT == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $jmlT)),
            'pendapatan_ket' => $ket
        );

        $this->pendapatan_model->tambah_data($data, 'pendapatan');
		$this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
				title: "Berhasil ditambah!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		redirect('pendapatan');
        
    }

    public function proses_ubah()
    {
        $kode = $this->input->post('idPD');
		$idP = $this->input->post('idP');
		$periode = $this->input->post('periode');
		$tglP = $this->input->post('tglP');
        $tglT = $this->input->post('tglT');
        $jmlT = $this->input->post('jmlT');
        $ket = $this->input->post('ket');
        $tglB = $this->input->post('tglB');
        $jmlB = $this->input->post('jmlB');

        $tglP1 = strtotime($tglP);
        $formatTglP = date('Y-m-d',$tglP1);

        $tglT1 = strtotime($tglT);
        $formatTglT = date('Y-m-d',$tglT1);

        if($tglB == ''){
            $formatTglB = null;
        }else{
            $tglB1 = strtotime($tglB);
            $formatTglB = date('Y-m-d',$tglB1);
        }

        $data = array(
            'project_id' => $idP,
            'pendapatan_periode' => $periode,
            'pendapatan_tgl_penagihan' => $formatTglP,
            'pendapatan_tgl_tempo' => $formatTglT,
            'pendapatan_jml_tagihan' => $jmlT == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $jmlT)),
            'pendapatan_ket' => $ket,
            'pendapatan_tgl_bayar'=> $formatTglB,
            'pendapatan_jml_bayar'=> $jmlB == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $jmlB)),
        );

        $where = array(
            'pendapatan_id' => $kode
        );

        $this->pendapatan_model->ubah_data($where, $data, 'pendapatan');
		$this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
				title: "Berhasil diubah!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		redirect('pendapatan');
        
    }

    public function proses_ubah_bayar()
    {
        $kode = $this->input->post('idP');
		$tglB = $this->input->post('tglB');
        $bayarr = $this->input->post('bayarr');
        
        $tglbTime = strtotime($tglB);
        $formatB = date('Y-m-d',$tglbTime);

        $data = array(
            'pendapatan_tgl_bayar' => $formatB,
            'pendapatan_jml_bayar' => $bayarr == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $bayarr)),
        );

        $where = array('pendapatan_id' => $kode);

        $this->pendapatan_model->ubah_data($where, $data, 'pendapatan');
		$this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
				title: "Berhasil dibayarkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		redirect('pendapatan');

    }

    public function proses_hapus($id)
	{
		$where = array('pendapatan_id' => $id );
		$this->pendapatan_model->hapus_data($where, 'pendapatan');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil dihapus!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect('pendapatan');
    }
    
    public function hapus_all()
	{
		$this->pendapatan_model->delete_all('pendapatan');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil dihapus!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect('pendapatan');
	}
    


    function getDataPendapatan()
    {
        $list = $this->pendapatan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            if($field->pendapatan_jml_bayar == ''){
                $dbayarkan = '<a class="dropdown-item has-icon text-primary" href="#" data-toggle="modal" data-target="#exampleModal" onclick="bayarkan('."'".$field->pendapatan_id."'".','."'".$field->pendapatan_jml_tagihan."'".')"><i class="far fa-credit-card mdb-gallery-view-icon"></i> Dibayarkan</a>';
            }else{
                $dbayarkan = null;
            }

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
                '.$dbayarkan.'
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'pendapatan/detail/'.$field->pendapatan_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'pendapatan/ubah/'.$field->pendapatan_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->pendapatan_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';

          if($field->pendapatan_jml_tagihan == "" || $field->pendapatan_jml_tagihan == null){
            $number = "Rp0";
          }else{
            if (strpos($field->pendapatan_jml_tagihan, ',') !== false) {
                $exp = explode(",", $field->pendapatan_jml_tagihan);

                $number = "Rp". number_format($exp[0],0,',','.') . "," . $exp[1];
            }else{
                $number = "Rp" . number_format($field->pendapatan_jml_tagihan,0,',','.');
            }
        }

            $bulan = array (1 =>   'Jan',
				'Feb',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agus',
				'Sep',
				'Okt',
				'Nov',
				'Des'
			);
            $penagihan = explode('-', $field->pendapatan_tgl_penagihan);
            $tempo = explode('-', $field->pendapatan_tgl_tempo);

            if($field->pendapatan_tgl_bayar == ''){
                $bayar = '-';
            }else{
                $pecah1 = explode('-', $field->pendapatan_tgl_bayar);
                $bayar = $pecah1[2] . ' ' . $bulan[ (int)$pecah1[1] ] . ' ' . $pecah1[0];
            }

            if($field->pendapatan_jml_bayar == '' || $field->pendapatan_jml_bayar == null){
                $jmlbayar = "-";
            }else{
                if (strpos($field->pendapatan_jml_bayar, ',') !== false) {
                    $exp2 = explode(",", $field->pendapatan_jml_bayar);
    
                    $jmlbayar = "Rp". number_format($exp2[0],0,',','.') . "," . $exp2[1];
                }else{
                    $jmlbayar = "Rp" . number_format($field->pendapatan_jml_bayar,0,',','.');
                }
            }
            
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->project_nama;
            $row[] = $field->customer_nama;
            $row[] = $field->pendapatan_periode == "" ? "-" : $field->pendapatan_periode ;
            $row[] = $penagihan[2] . ' ' . $bulan[ (int)$penagihan[1] ] . ' ' . $penagihan[0];
            $row[] = $tempo[2] . ' ' . $bulan[ (int)$tempo[1] ] . ' ' . $tempo[0];
            $row[] = $number;
            $row[] = $field->pendapatan_ket;
            $row[] = $bayar;
            $row[] = $jmlbayar;
            $row[] = $aksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pendapatan_model->count_all(),
            "recordsFiltered" => $this->pendapatan_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

}