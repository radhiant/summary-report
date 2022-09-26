<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
		$this->load->model('vendor_model');

		if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
			redirect('login/logout');
			exit;
		}else{
			if($this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '2' || $this->session->userdata('login_session')['level'] == '3'){
            
			}else{
				redirect('pembiayaan');
			}
		}

		
      }

    public function index()
	{
		$data['judul'] = 'Vendor';
        $data['data'] = $this->vendor_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('vendor/index');
		$this->load->view('js/vendorjs');
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['judul'] = 'Vendor';

		$this->load->view('templates/header', $data);
		$this->load->view('vendor/tambah');
		$this->load->view('js/vendorjs');
		$this->load->view('templates/footer');
	}

	public function ubah($id)
	{
		$data['judul'] = 'Vendor';

		$where = array('vendor_id' => $id);
		$data['data'] = $this->vendor_model->detail_data($where, 'vendor')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('vendor/ubah');
		$this->load->view('js/vendorjs');
		$this->load->view('templates/footer');
	}
	

    public function proses_tambah()
	{   
        
        $idV = $this->vendor_model->buat_kode();
		$namaV = $this->input->post('namaV');
		$telp = $this->input->post('telp');
		$cp = $this->input->post('cp');
		$top = $this->input->post('top');
		$delivery = $this->input->post('delivery');
		$alamat = $this->input->post('alamat');
		
		$data=array(
			'vendor_id'=> $idV,
			'vendor_nama'=> $namaV,
			'vendor_telp'=>$telp,
			'vendor_cp'=>$cp,
			'vendor_top'=>$top,
			'vendor_delivery'=>$delivery,
			'vendor_alamat'=>$alamat,
		);

		$this->vendor_model->tambah_data($data, 'vendor');
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
    	redirect('vendor');
	}

	public function proses_ubah()
	{
        $idV = $this->input->post('idV');
		$namaV = $this->input->post('namaV');
		$telp = $this->input->post('telp');
		$cp = $this->input->post('cp');
		$top = $this->input->post('top');
		$delivery = $this->input->post('delivery');
		$alamat = $this->input->post('alamat');
		
		$data=array(
			'vendor_nama'=> $namaV,
			'vendor_telp'=>$telp,
			'vendor_cp'=>$cp,
			'vendor_top'=>$top,
			'vendor_delivery'=>$delivery,
			'vendor_alamat'=>$alamat,
		);

		$where = array(
			'vendor_id'=>$idV
		);

		$this->vendor_model->ubah_data($where, $data, 'vendor');
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
    	redirect('vendor');
	}

	public function proses_hapus($id)
	{
		$where = array('vendor_id' => $id );
		$this->vendor_model->hapus_data($where, 'vendor');
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
		redirect('vendor');
	}

	public function hapus_all()
	{
		$this->vendor_model->delete_all('vendor');
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
		redirect('vendor');
	}
    
}

?>