<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katbiaya extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
		$this->load->model('katbiaya_model');

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
		$data['judul'] = 'Kategori Biaya';
        $data['data'] = $this->katbiaya_model->data()->result();
        $data['genID'] = $this->katbiaya_model->buat_kode();

		$this->load->view('templates/header', $data);
		$this->load->view('katbiaya/index');
		$this->load->view('js/katbiayajs');
		$this->load->view('templates/footer');
	}
	
	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('katbiaya_id' => $id );
    	$data = $this->katbiaya_model->detail_data($where, 'katbiaya')->result();
    	echo json_encode($data);
	}

    public function proses_tambah()
	{   
        
        $idK = $this->katbiaya_model->buat_kode();
		$namaK = $this->input->post('namaK');
		
		$data=array(
			'katbiaya_id'=> $idK,
			'katbiaya_nama'=> $namaK,
		);

		$this->katbiaya_model->tambah_data($data, 'katbiaya');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil ditambahkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
    	redirect('katbiaya');
	}

	public function proses_ubah()
	{
        $idK = $this->input->post('katbiayaid');
		$namaK = $this->input->post('namaK');
		
		$data=array(
			'katbiaya_nama' => $namaK
		);

		$where = array(
			'katbiaya_id'=>$idK
		);

		$this->katbiaya_model->ubah_data($where, $data, 'katbiaya');
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
    	redirect('katbiaya');
	}

	public function proses_hapus($id)
	{
		$where = array('katbiaya_id' => $id );
		$this->katbiaya_model->hapus_data($where, 'katbiaya');
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
		redirect('katbiaya');
	}

	public function hapus_all()
	{
		$this->katbiaya_model->delete_all('katbiaya');
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
		redirect('katbiaya');
	}
    
}

?>