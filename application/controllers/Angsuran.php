<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('hutang_model');
        $this->load->model('angsuran_model');

        if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
            redirect('login/logout');
            exit;
        }else{
            if($this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '3' || $this->session->userdata('login_session')['level'] == '5'){
            
            }else{
                redirect('pembiayaan');
            }
        }
        
      }

      public function index()
	{   
        $data['judul'] = "Angsuran";
        
		$this->load->view('templates/header', $data);
		$this->load->view('angsuran/index');
		$this->load->view('js/angsuranjs');
		$this->load->view('templates/footer');
    }

    public function tambah($kategori)
	{   
        $data['judul'] = "Angsuran";
        $data['hBank'] = $this->hutang_model->hbank()->result();
        $data['hVendor'] = $this->hutang_model->dataJoinVendor()->result();
        $data['kategori'] = $kategori;

		$this->load->view('templates/header', $data);
		$this->load->view('angsuran/tambah');
		$this->load->view('js/angsuranjs');
		$this->load->view('templates/footer');
    }

    public function ubah($id)
	{   
        $data['judul'] = "Angsuran";
        $where = array('angsuran_id' => $id);

        $data['hBank'] = $this->hutang_model->hbank()->result();
        $data['hVendor'] = $this->hutang_model->dataJoinVendor()->result();
        
        $data['data'] = $this->angsuran_model->detail_data($where, 'angsuran')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('angsuran/ubah');
		$this->load->view('js/angsuranjs');
		$this->load->view('templates/footer');
    }

    public function detail($id)
	{   
        $data['judul'] = "Angsuran";
        $data['data'] = $this->angsuran_model->detailJoin($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('angsuran/detail');
		$this->load->view('js/angsuranjs');
		$this->load->view('templates/footer');
    }

    public function getCicilan()
	{
		$id = $this->input->post('id');
    	$where = array('hutang_id' => $id );
    	$data = $this->hutang_model->detail_data($where, 'hutang')->result();
    	echo json_encode($data);
    }
    
    public function getNotagihan()
	{
		$id = $this->input->post('id');
    	$where = array('hutang_id' => $id );
    	$data = $this->hutang_model->detail_data($where, 'hutang')->result();
    	echo json_encode($data);
	}

    public function proses_tambah()
    {
        $kode = $this->angsuran_model->buat_kode();
		$idH = $this->input->post('idH');
		$periode = $this->input->post('periode');
		$np = $this->input->post('np');
        $tgl = $this->input->post('tgl');
        $noT = $this->input->post('noT');
        $usrinput = $this->session->userdata('login_session')['id_user'];
        $tglnow = date("Y-m-d");
        $kategori = $this->input->post('kategori');

        $tgl1 = strtotime($tgl);
        $formatTgl = date('Y-m-d',$tgl1);



        $data = array(
            'angsuran_id' => $kode,
            'hutang_id' => $idH,
            'angsuran_periode' => $periode,
            'angsuran_nilai_pembiayaan' => str_replace(".", "", $np),
            'angsuran_tgl' => $formatTgl,
            'angsuran_no_tagihan' => $noT,
            'angsuran_user_input' => $usrinput,
            'angsuran_tgl_input' => $tglnow,
            'angsuran_kategori' => $kategori
        );

        $this->angsuran_model->tambah_data($data, 'angsuran');
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
		redirect('angsuran');
        
    }

    public function proses_ubah()
    {
        $kode = $this->input->post('idA');
		$idH = $this->input->post('idH');
		$periode = $this->input->post('periode');
		$np = $this->input->post('np');
        $tgl = $this->input->post('tgl');
        $noT = $this->input->post('noT');

        $tgl1 = strtotime($tgl);
        $formatTgl = date('Y-m-d',$tgl1);

        $data = array(
            'hutang_id' => $idH,
            'angsuran_periode' => $periode,
            'angsuran_no_tagihan' => $noT,
            'angsuran_nilai_pembiayaan' => str_replace(".", "", $np),
            'angsuran_tgl' => $formatTgl
        );

        $where = array(
            'angsuran_id' => $kode
        );

        $this->angsuran_model->ubah_data($where, $data, 'angsuran');
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
		redirect('angsuran');
        
    }

    public function proses_hapus($id)
	{
		$where = array('angsuran_id' => $id );
		$this->angsuran_model->hapus_data($where, 'angsuran');
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
		redirect('angsuran');
    }
    
    public function hapus_all($kategori)
	{
		$where = array('angsuran_kategori' => $kategori );
		$this->angsuran_model->hapus_data($where, 'angsuran');
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
		redirect('angsuran');
	}
    


    function getDataAngsuranBank()
    {
        $list = $this->angsuran_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'angsuran/detail/'.$field->angsuran_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'angsuran/ubah/'.$field->angsuran_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->angsuran_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            $np = "" . number_format($field->angsuran_nilai_pembiayaan,0,',','.');

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
            $tgl = explode('-', $field->angsuran_tgl);
            $tginput = explode('-', $field->angsuran_tgl_input);
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->hutang_nama;
            $row[] = $field->angsuran_periode;
            $row[] = $np;
            $row[] = $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0];
            $row[] = $field->user_nmlengkap;
            $row[] = $tginput[2] . ' ' . $bulan[ (int)$tginput[1] ] . ' ' . $tginput[0];
            $row[] = $aksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->angsuran_model->count_all(),
            "recordsFiltered" => $this->angsuran_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    function getDataAngsuranVendor()
    {
        $list = $this->angsuran_model->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'angsuran/detail/'.$field->angsuran_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'angsuran/ubah/'.$field->angsuran_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->angsuran_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            $np = "" . number_format($field->angsuran_nilai_pembiayaan,0,',','.');

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
            $tgl = explode('-', $field->angsuran_tgl);
            $tginput = explode('-', $field->angsuran_tgl_input);
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->vendor_nama;
            $row[] = $field->angsuran_no_tagihan;
            $row[] = $np;
            $row[] = $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0];
            $row[] = $field->user_nmlengkap;
            $row[] = $tginput[2] . ' ' . $bulan[ (int)$tginput[1] ] . ' ' . $tginput[0];
            $row[] = $aksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->angsuran_model->count_all(),
            "recordsFiltered" => $this->angsuran_model->count_filtered1(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

}