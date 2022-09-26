<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
		$this->load->model('customer_model');
		$this->load->model('user_model');

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
		$data['judul'] = 'Customer';
        $data['data'] = $this->customer_model->dataJoin()->result();
		$data['genID'] = $this->customer_model->buat_kode();
		$data['user'] = $this->user_model->detail_data(array('user_level'=>'6'), 'user')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('customer/index');
		$this->load->view('js/customerjs');
		$this->load->view('templates/footer');
	}
	
	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('customer_id' => $id );
    	$data = $this->customer_model->detail_data($where, 'customer')->result();
    	echo json_encode($data);
	}

    public function proses_tambah()
	{   
        
        $idC = $this->customer_model->buat_kode();
		$namaC = $this->input->post('namaC');
		$kategori = $this->input->post('kategori');
		$am = $this->input->post('am');
		$kondisi = $this->input->post('kondisi');
		
		$data=array(
			'customer_id'=> $idC,
			'customer_nama'=> $namaC,
			'customer_kategori'=>$kategori,
			'customer_am'=>$am,
			'customer_kondisi'=>$kondisi,
		);

		$this->customer_model->tambah_data($data, 'customer');
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
    	redirect('customer');
	}

	public function proses_ubah()
	{
        $idC = $this->input->post('customerid');
		$namaC = $this->input->post('namaC');
		$kategori = $this->input->post('kategori');
		$am = $this->input->post('am');
		$kondisi = $this->input->post('kondisi');

		$data=array(
			'customer_nama' => $namaC,
			'customer_kategori' => $kategori,
			'customer_am' => $am,
			'customer_kondisi' => $kondisi,
		);

		$where = array(
			'customer_id'=>$idC
		);

		$this->customer_model->ubah_data($where, $data, 'customer');
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
    	redirect('customer');
	}

	public function proses_hapus($id)
	{
		$where = array('customer_id' => $id );
		$this->customer_model->hapus_data($where, 'customer');
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
		redirect('customer');
	}

	public function hapus_all()
	{
		$this->customer_model->delete_all('customer');
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
		redirect('customer');
	}
    
}

?>