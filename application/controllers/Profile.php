<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user_model');
		
		if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
			redirect('login/logout');
			exit;
		}
		
      }

	public function index()
	{
        $data['judul'] = 'Profile';
		$where = array('user_id'=>$this->session->userdata('login_session')['id_user']);
		$data['data'] = $this->user_model->detail_data($where, 'user')->result();


		$this->load->view('templates/header', $data);
		$this->load->view('profile/index');
		$this->load->view('js/userjs');
		$this->load->view('templates/footer');
    }

    public function ubah()
	{
		$data['judul'] = 'Profile';
		$where = array('user_id'=> $this->session->userdata('login_session')['id_user']);
		$data['user'] = $this->user_model->detail_data($where, 'user')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('profile/ubah_data');
		$this->load->view('js/userjs');
		$this->load->view('templates/footer');
    }
    
    public function proses_ubah()
	{
		$config['upload_path']   = './assets/upload/user/';
		$config['allowed_types'] = 'png|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF||tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

		$this->load->library('upload', $config);

		$kode = $this->input->post('iduser'); 
		$namaL = $this->input->post('nmlengkap');
		$username = $this->input->post('username');
		$divisi = $this->input->post('divisi');
		$pass = $this->input->post('pwd');
		$passLama = $this->input->post('pwdLama');
		$flama = $this->input->post('fotoLama');

		if($pass == ''){
			$passUpdate = $passLama;
		}else{
			$passUpdate = md5($pass);
		}

		if ($namaFile == '') {
			$ganti = $flama;
		}else{
			if (! $this->upload->do_upload('photo')) {
				$error = $this->upload->display_errors();
				redirect('user/ubah/'.$kode);
			}
			else{
				$data = array('photo' => $this->upload->data());
				$nama_file= $data['photo']['file_name'];
				$ganti = str_replace(" ", "_", $nama_file);
				if($flama !== 'user.png'){
				unlink('./assets/upload/user/'.$flama.'');
				}
	
			}
		}

		$data=array(
			'user_nmlengkap'=>$namaL,
			'user_nama'=>$username,
			'user_divisi'=>$divisi,
			'user_password'=>$passUpdate,
			'user_foto'=>$ganti,
				);

		$where = array('user_id'=>$kode);
	  
		  $this->user_model->ubah_data($where, $data, 'user');
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
		  redirect('profile');
	}
    
}
