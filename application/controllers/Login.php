<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('login_model');

  }

	public function index()
	{
		
		$this->load->view('templates/header_login');
		$this->load->view('login/index');
		$this->load->view('js/loginjs');
		$this->load->view('templates/footer_login');
	}

	public function proses_login()
	{
		$username = $this->input->post('user');
		$password = $this->input->post('pwd');
		
		// if($username != 'dev'){
		// 	$this->session->set_flashdata('Pesan','
		// 	<script>
		// 	$(document).ready(function() {
		// 	swal.fire({
		// 		title: "Sedang perbaikan !!!",
		// 		icon: "info",
		// 		confirmButtonColor: "#4e73df",
		// 	});
		// 	});
		// 	</script>
		// 	');
		// 	redirect('login');
		// }

    	$where = array(
    		'user_nama' => $username,
    		'user_password' => md5($password)
    	);

    	$cek = $this->login_model->cek_login($where, 'user')->num_rows();
    	$data = $this->login_model->cek_login($where, 'user')->row_array();
    	if ($cek > 0) {
			
			$userdata = [
				'id_user' => $data['user_id'],
				'username' => $data['user_nama'],
				'nama_lengkap' => $data['user_nmlengkap'],
    			'divisi' => $data['user_divisi'],
    			'level' => $data['user_level'],
				'foto' => $data['user_foto'],
				'login' => 'GLBKU'
			];

			$this->session->set_userdata('login_session',$userdata);
            
            $this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
				title: "Anda berhasil login!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		
			if($data['user_level'] == '2'){
				redirect('pendapatan');
			}elseif($data['user_level'] == '3' || $data['user_level'] == '4' || $data['user_level'] == '5'){
				redirect('pembiayaan');
			}elseif($data['user_level'] == '6'){
				redirect('detailproject');
			}else{
				redirect('home');
			}
			
			// $respon = array('respon' => 'success');
			// echo json_encode($respon);
    	}
    	else{
            $this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
                title:"Login Gagal !",
				text: "Mohon periksa user & password anda",
				icon: "error",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		  redirect('login');
			// $respon = array('respon' => 'failed');
			// echo json_encode($respon);
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		// $respon = array('respon' => 'success');
        // echo json_encode($respon);

        redirect('login');
	}
}