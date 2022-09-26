<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user_model');

		if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
			redirect('login/logout');
			exit;
		}else{
			if($this->session->userdata('login_session')['level'] == '1'){
            
			}else{
				redirect('pembiayaan');
			}
		}
		
      }

	public function index()
	{   
        $data['judul'] = "User";
        
		$this->load->view('templates/header', $data);
		$this->load->view('user/index');
		$this->load->view('js/userjs');
		$this->load->view('templates/footer');
		
    }
    
    function getDataUser()
    {
        $list = $this->user_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $aksi = '
                        <a href="'.base_url().'user/ubah/'.$field->user_id.'" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ubah Data"> <i class="fas fa-pen"></i> </a>
                        <a href="#" onclick="konfirmasi('."'".$field->user_id."'".')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus Data"> <i class="fas fa-trash"></i> </a>
                    ';
            
            $img = '<img class="rounded-circle" width="35"
            src="'.base_url().'assets/upload/user/'.$field->user_foto.'" alt="avatar">';

            if($field->user_level == '1'){
                $level = 'Admin';
            }elseif($field->user_level == '2'){
                $level = 'Invoice';
            }elseif($field->user_level == '3'){
                $level = 'Purchasing';
            }elseif($field->user_level == '4'){
                $level = 'SPJ';
            }elseif($field->user_level == '5'){
                $level = 'Operator';
            }elseif($field->user_level == '6'){
                $level = 'Akun Manager';
            }


            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $img;
            $row[] = $field->user_nama;
            $row[] = $field->user_nmlengkap;
            $row[] = $level;
            $row[] = $field->user_divisi;
            $row[] = $aksi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function tambah()
    {
        $data['judul'] = "User";
        
		$this->load->view('templates/header', $data);
		$this->load->view('user/tambah_data');
		$this->load->view('js/userjs');
		$this->load->view('templates/footer');
	}
	
	public function ubah($id)
	{
		$data['judul'] = 'User';
		$where = array('user_id'=>$id);
		$data['user'] = $this->user_model->detail_data($where, 'user')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('user/ubah_data');
		$this->load->view('js/userjs');
		$this->load->view('templates/footer');
	}

    public function proses_tambah()
	{

		$config['upload_path']   = './assets/upload/user/';
		$config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF|tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

		$this->load->library('upload', $config);
		
		$kode = $this->user_model->buat_kode(); 
		$namaL = $this->input->post('nmlengkap');
		$username = $this->input->post('username');
		$level = $this->input->post('level');
		$divisi = $this->input->post('divisi');
		$pass = $this->input->post('pwd');

		if ($namaFile == '') {
			$ganti = 'user.png';
		}else{
			if (! $this->upload->do_upload('photo')) {
				$error = $this->upload->display_errors();
				redirect('user/tambah');
			}
			else{
				$data = array('photo' => $this->upload->data());
				$nama_file= $data['photo']['file_name'];
				$ganti = str_replace(" ", "_", $nama_file);
			}
		}
		
		$data=array(
			'user_id'=>$kode,
			'user_nmlengkap'=>$namaL,
			'user_nama'=>$username,
			'user_level'=>$level,
			'user_divisi'=>$divisi,
			'user_password'=> md5($pass),
			'user_foto'=>$ganti
				);
	  
		  $this->user_model->tambah_data($data, 'user');
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
		  redirect('user');

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
		$level = $this->input->post('level');
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
			'user_level'=>$level,
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
		  redirect('user');
	}

	public function proses_hapus($id)
	{
		$where = array('user_id' => $id );
		$foto = $this->user_model->ambilFoto($where);
		if($foto){
			if($foto != 'user.png'){
				unlink('./assets/upload/user/'.$foto.'');
			}

			$this->user_model->hapus_data($where, 'user');
		}
		
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
		redirect('user');
	}

	

}
