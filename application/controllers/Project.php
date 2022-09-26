<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('project_model');
        $this->load->model('customer_model');

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
        $data['judul'] = "Project";
        
		$this->load->view('templates/header', $data);
		$this->load->view('project/index');
		$this->load->view('js/projectjs');
		$this->load->view('templates/footer');
		
    }

    public function tambah()
    {
        $data['judul'] = "Project";
        $data['customer'] = $this->customer_model->data()->result();
        
		$this->load->view('templates/header', $data);
		$this->load->view('project/tambah');
		$this->load->view('js/projectjs');
		$this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = "Project";
        $where = array('project_id' => $id);

        $data['data'] = $this->project_model->detail_data($where, 'project')->result();
        $data['customer'] = $this->customer_model->data()->result();
        
		$this->load->view('templates/header', $data);
		$this->load->view('project/ubah');
		$this->load->view('js/projectjs');
		$this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = "Project";
        $data['data'] = $this->project_model->detailJoin($id)->result();
        
		$this->load->view('templates/header', $data);
		$this->load->view('project/detail');
		$this->load->view('js/projectjs');
		$this->load->view('templates/footer');
    }
    
    public function proses_tambah()
    {
        $kode = $this->project_model->buat_kode(); 
		$namaP = $this->input->post('namaP');
		$idC = $this->input->post('idC');
		$nk = $this->input->post('nk');
		$sk = $this->input->post('sk');
        $ek = $this->input->post('ek');
        $layanan = $this->input->post('layanan');

        $sk1 = strtotime($sk);
        $formatSk = date('Y-m-d',$sk1);

        $ek1 = strtotime($ek);
        $formatEk = date('Y-m-d',$ek1);

        $data = array(
            'project_id' => $kode,
            'project_nama' => $namaP,
            'customer_id' => $idC,
            'project_layanan' => $layanan,
            'project_kontrak_nilai' => str_replace(".", "", $nk),
            'project_kontrak_start' => $formatSk,
            'project_kontrak_end' => $formatEk
        );

        $this->project_model->tambah_data($data, 'project');
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
		redirect('project');
        
    }

    public function proses_ubah()
    {
        $kode = $this->input->post('idP');
		$namaP = $this->input->post('namaP');
		$idC = $this->input->post('idC');
		$nk = $this->input->post('nk');
		$sk = $this->input->post('sk');
        $ek = $this->input->post('ek');
        $layanan = $this->input->post('layanan');

        $sk1 = strtotime($sk);
        $formatSk = date('Y-m-d',$sk1);

        $ek1 = strtotime($ek);
        $formatEk = date('Y-m-d',$ek1);

        $data = array(
            'project_nama' => $namaP,
            'customer_id' => $idC,
            'project_layanan' => $layanan,
            'project_kontrak_nilai' => str_replace(".", "", $nk),
            'project_kontrak_start' => $formatSk,
            'project_kontrak_end' => $formatEk,
        );

        $where = array(
            'project_id' => $kode
        );

        $this->project_model->ubah_data($where, $data, 'project');
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
		redirect('project');
    }

    public function proses_hapus($id)
	{
		$where = array('project_id' => $id );
		$this->project_model->hapus_data($where, 'project');
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
		redirect('project');
    }
    
    public function hapus_all()
	{
		$this->project_model->delete_all('project');
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
		redirect('project');
	}
    
    function getDataProject()
    {
        $list = $this->project_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'project/detail/'.$field->project_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'project/ubah/'.$field->project_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->project_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            $number = "" . number_format($field->project_kontrak_nilai,0,',','.');

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
            $split = explode('-', $field->project_kontrak_end);
            $splitS = explode('-', $field->project_kontrak_start);

            if($field->project_layanan == 'Sewa'){
                $layanan = '<span class="badge badge-primary">'.$field->project_layanan.'</span>';
            }else if($field->project_layanan == 'Jual'){
                $layanan = '<span class="badge badge-success">'.$field->project_layanan.'</span>';
            }else if($field->project_layanan == 'Repair'){
                $layanan = '<span class="badge badge-warning">'.$field->project_layanan.'</span>';
            }else if($field->project_layanan == 'Lain-lain'){
                $layanan = '<span class="badge badge-info">'.$field->project_layanan.'</span>';
            }else{
                $layanan = '<span class="badge badge-secondary">'.$field->project_layanan.'</span>';
            };

            $namaXdate = '';
            $datenow = date('Y');

            if($split[0] < $datenow){
                $namaXdate = $field->project_nama.' <br /><span class="badge badge-danger">Tidak Aktif</span>';
            }else if($split[0] >= $datenow){
                $namaXdate = $field->project_nama.' <br /><span class="badge badge-success">Aktif</span>';
            }else{
                $namaXdate = $field->project_nama.' <br /><span class="badge badge-secondary">'.$split[0].'</span>';
            }
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $namaXdate;
            $row[] = $field->customer_nama;
            $row[] = $layanan;
            $row[] = $number;
            $row[] = $splitS[2] . ' ' . $bulan[ (int)$splitS[1] ] . ' ' . $splitS[0];
            $row[] = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
            $row[] = $aksi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->project_model->count_all(),
            "recordsFiltered" => $this->project_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

}
