<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembiayaan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('pembiayaan_model');
        $this->load->model('katbiaya_model');
        $this->load->model('project_model');
        $this->load->model('user_model');

        if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
            redirect('login/logout');
            exit;
        }else{
            if($this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '3' || $this->session->userdata('login_session')['level'] == '4' || $this->session->userdata('login_session')['level'] == '5'){
            
            }else{
                redirect('pendapatan');
            }
        }

        
      }

      public function index()
	{   
        $data['judul'] = "Pembiayaan";
        
		$this->load->view('templates/header', $data);
		$this->load->view('pembiayaan/index');
		$this->load->view('js/pembiayaanjs');
		$this->load->view('templates/footer');
    }

    public function tambah()
	{   
        $data['judul'] = "Pembiayaan";
        $data['katbiaya'] = $this->katbiaya_model->data()->result();
        $data['project'] = $this->project_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pembiayaan/tambah');
		$this->load->view('js/pembiayaanjs');
		$this->load->view('templates/footer');
    }

    public function ubah($id)
	{   
        $data['judul'] = "Pembiayaan";
        $where = array('pembiayaan_id' => $id);
        $data['data'] = $this->pembiayaan_model->detail_data($where, 'pembiayaan')->result();

        $data['katbiaya'] = $this->katbiaya_model->data()->result();
        $data['project'] = $this->project_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pembiayaan/ubah');
		$this->load->view('js/pembiayaanjs');
		$this->load->view('templates/footer');
    }

    public function detail($id)
	{   
        $data['judul'] = "Pembiayaan";
        $data['data'] = $this->pembiayaan_model->detailJoin($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pembiayaan/detail');
		$this->load->view('js/pembiayaanjs');
		$this->load->view('templates/footer');
    }

    public function proses_tambah()
    {
        $kode = $this->pembiayaan_model->buat_kode();
		$kb = $this->input->post('kb');
		$beban = $this->input->post('beban');
		$idP = $this->input->post('idP');
        $tgl = $this->input->post('tgl');
        $realisasi = $this->input->post('realisasi');
        $ket = $this->input->post('ket');
        $usrinput = $this->session->userdata('login_session')['id_user'];
        $tglnow = date("Y-m-d");

        $tgl1 = strtotime($tgl);
        $formatTgl = date('Y-m-d',$tgl1);


        $data = array(
            'katbiaya_id' => $kb,
            'project_id' => $idP,
            'pembiayaan_beban_biaya' => $beban,
            'pembiayaan_tgl' => $formatTgl,
            'pembiayaan_nilai_realisasi' => $realisasi == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $realisasi)),
            'pembiayaan_ket' => $ket,
            'pembiayaan_tgl_input' => $tglnow,
            'user_id' => $usrinput
        );

        $this->pembiayaan_model->tambah_data($data, 'pembiayaan');
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
		redirect('pembiayaan');
        
    }

    public function coba()
    {
        // $num = '500000';
        // echo trim(preg_replace('/[^A-Za-z0-9-]+/', '', $num));

    }

    public function proses_ubah()
    {
        $kode = $this->input->post('idPMB');
		$kb = $this->input->post('kb');
		$beban = $this->input->post('beban');
		$idP = $this->input->post('idP');
        $tgl = $this->input->post('tgl');
        $realisasi = $this->input->post('realisasi');
        $ket = $this->input->post('ket');

        $tgl1 = strtotime($tgl);
        $formatTgl = date('Y-m-d',$tgl1);

        $data = array(
            'katbiaya_id' => $kb,
            'project_id' => $idP,
            'pembiayaan_beban_biaya' => $beban,
            'pembiayaan_tgl' => $formatTgl,
            'pembiayaan_nilai_realisasi' => $realisasi == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $realisasi)),
            'pembiayaan_ket' => $ket
        );

        $where = array(
            'pembiayaan_id' => $kode
        );

        $this->pembiayaan_model->ubah_data($where, $data, 'pembiayaan');
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
		redirect('pembiayaan');
        
    }

    public function proses_hapus($id)
	{
		$where = array('pembiayaan_id' => $id );
		$this->pembiayaan_model->hapus_data($where, 'pembiayaan');
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
		redirect('pembiayaan');
    }
    
    public function hapus_all()
	{
		$this->pembiayaan_model->delete_all('pembiayaan');
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
		redirect('pembiayaan');
	}
    


    function getDataPembiayaan()
    {
        $list = $this->pembiayaan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'pembiayaan/detail/'.$field->pembiayaan_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'pembiayaan/ubah/'.$field->pembiayaan_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->pembiayaan_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            // $number = "Rp" . number_format($field->pembiayaan_nilai_realisasi,0,',','.');
            $number = "";

            if (strpos($field->pembiayaan_nilai_realisasi, ',') !== false) {
                $exp = explode(",", $field->pembiayaan_nilai_realisasi);
                // $number = "". $field->pembiayaan_nilai_realisasi;

                $number = "Rp". number_format($exp[0],0,',','.') . "," . $exp[1];
            }else{
                $number = "Rp" . number_format($field->pembiayaan_nilai_realisasi,0,',','.');
                // $number = "". $field->pembiayaan_nilai_realisasi;
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
            
            if($field->pembiayaan_beban_biaya == 'Non Project'){
                $beban = '<span class="badge badge-primary">'.$field->pembiayaan_beban_biaya.'</span>';
            }else if($field->pembiayaan_beban_biaya == 'Project'){
                $beban = '<span class="badge badge-success">'.$field->pembiayaan_beban_biaya.'</span>';
            }else{
                $beban = '<span class="badge badge-secondary">'.$field->pembiayaan_beban_biaya.'</span>';
            };

            $tgl = explode('-', $field->pembiayaan_tgl);
            $tglinput = explode('-', $field->pembiayaan_tgl_input);
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->katbiaya_id == null ? '-' : $field->katbiaya_nama;
            $row[] = $beban;
            $row[] = $field->project_nama == null ? '-' : $field->project_nama;
            $row[] = $tgl[2] . ' ' . $bulan[ (int)$tgl[1] ] . ' ' . $tgl[0];
            // $row[] =  $field->pembiayaan_tgl;
            $row[] = $number;
            $row[] = $field->pembiayaan_ket;
            $row[] = $tglinput[2] . ' ' . $bulan[ (int)$tglinput[1] ] . ' ' . $tglinput[0];
            // $row[] =  $field->pembiayaan_tgl_input;
            $row[] = $field->user_nmlengkap;
            $row[] = $aksi;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pembiayaan_model->count_all(),
            "recordsFiltered" => $this->pembiayaan_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

}