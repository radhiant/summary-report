<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('pendapatan_model');
        $this->load->model('pembiayaan_model');
        $this->load->model('customer_model');
        $this->load->model('project_model');
        $this->load->model('katbiaya_model');
		$this->load->model('angsuran_model');
		$this->load->model('epp_model');

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

      public function index($year = '')
	{   
        $data['judul'] = 'Est Pendapatan';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
        $data['twoyearago']=date('Y', strtotime('-2 year'));

        if($year == ''){
            $tahun = date('Y', strtotime('+0 year'));
        }else{
            $tahun = $year;
        }

        $data['epp'] = $this->epp_model->dataJoinbyYear($tahun)->result();
        $data['tahun'] = $tahun;
        

		$this->load->view('templates/header', $data);
		$this->load->view('epp/index');
		$this->load->view('js/estPendapatanjs');
		$this->load->view('templates/footer');
    }

    public function laporan($year = '', $idC = '')
	{   
        $data['judul'] = 'Laporan Est Pendapatan';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
        $data['twoyearago']=date('Y', strtotime('-2 year'));

        if($year == ''){
            $tahun = date('Y', strtotime('+0 year'));
        }else{
            $tahun = $year;
        }


        $data['epp'] = $this->epp_model->dataJoinbyYear($tahun)->result();
        $data['customer'] = $this->customer_model->data()->result();
        $data['idC'] = $idC;
        $data['tahun'] = $tahun;
        

		$this->load->view('templates/header', $data);
		$this->load->view('laporan/LapestPendapatan');
		$this->load->view('js/estPendapatanjs');
		$this->load->view('templates/footer');
    }

    public function laporanPrint($year = '', $idC = '')
	{   
        $data['judul'] = 'Print Laporan';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
        $data['twoyearago']=date('Y', strtotime('-2 year'));

        if($year == ''){
            $tahun = date('Y', strtotime('+0 year'));
        }else{
            $tahun = $year;
        }

        $data['epp'] = $this->epp_model->dataJoinbyYear($tahun)->result();
        $data['idC'] = $idC;
        $data['tahun'] = $tahun;
        

		$this->load->view('templates/no_header', $data);
		$this->load->view('laporan/LapestPendapatanPrint');
		$this->load->view('js/estPendapatanjs');
		$this->load->view('templates/no_footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Est Pendapatan';
        $epp =  $this->epp_model->dataJoin()->result();
        $idProject = array();
        foreach($epp as $d){
            $idProject[] = $d->project_id;
        }

        $data['project'] = $this->project_model->dataJoinFilter($idProject)->result();

        $this->load->view('templates/header', $data);
		$this->load->view('epp/tambah');
		$this->load->view('js/estPendapatanjs');
		$this->load->view('templates/footer');

    }

    public function getData()
    {
        $idProjek = $this->input->post('idP');
        $data = $this->project_model->detailJoin($idProjek)->result();
        $tglStart;
        $tglAwal;
        $tglEnd;
        $nk;

        foreach($data as $d){
           $tglStart = strtotime($d->project_kontrak_start);
           $tglEnd = strtotime($d->project_kontrak_end);
           $tglAwal = $d->project_kontrak_start;
           $nk = $d->project_kontrak_nilai;
        };
        

        // Menambah bulan ini + semua bulan pada tahun sebelumnya
        $numBulan = 1 + (date("Y",$tglEnd)-date("Y",$tglStart))*12;
        // menghitung selisih bulan
        $numBulan += date("m",$tglEnd)-date("m",$tglStart);

        $exp = explode('-', $tglAwal);
        $tglA = $exp[0].','.$exp[1].','.$exp[2];

        $hasil = array(
            'jml_bulan' => $numBulan,
            'nilai_kontrak' => $nk,
            'tgl_awal' => $tglA,
            'id_projek' => $idProjek
        );

        echo json_encode($hasil);

    }

    public function proses_tambah()
    {
            // Ambil data yang dikirim dari form
            $idP = $_POST['idP']; // Ambil data nis dan masukkan ke variabel nis
            $bulan = $_POST['bulan']; // Ambil data nama dan masukkan ke variabel nama
            $tahun = $_POST['tahun']; // Ambil data telp dan masukkan ke variabel telp
            $tglInput = date("Y-m-d"); // Ambil data alamat dan masukkan ke variabel alamat
            $usrInput = $this->session->userdata('login_session')['id_user']; // Ambil data alamat dan masukkan ke variabel alamat
            $data = array();
            
            $index = 0; // Set index array awal dengan 0
            foreach($idP as $p){ // Kita buat perulangan berdasarkan nis sampai data terakhir
              array_push($data, array(
                'project_id'=>$p,
                'epp_bulan'=>$bulan[$index],  // Ambil dan set data nama sesuai index array dari $index
                'epp_tahun'=>$tahun[$index],  // Ambil dan set data telepon sesuai index array dari $index
                'epp_tgl_input'=>$tglInput,  // Ambil dan set data alamat sesuai index array dari $index
                'epp_user_input'=>$usrInput,  // Ambil dan set data alamat sesuai index array dari $index
              ));
              
              $index++;
            }
            
            $sql = $this->epp_model->save_batch($data); // Panggil fungsi save_batch yang ada di model siswa (SiswaModel.php)
            
            // Cek apakah query insert nya sukses atau gagal
            if($sql){ // Jika sukses
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
            redirect('estPendapatan');
            }else{ // Jika gagal
                $this->session->set_flashdata('Pesan','
                <script>
                $(document).ready(function() {
                swal.fire({
                    title: "Gagal ditambah!",
                    icon: "error",
                    confirmButtonColor: "#4e73df",
                });
                });
                </script>
                ');
            redirect('estPendapatan');
            }
    }

    public function proses_hapus($id, $tahun)
    {
        $where = array('project_id' => $id , 'epp_tahun' => $tahun);
        $this->epp_model->hapus_data($where, 'epp');
		
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
		redirect('estPendapatan');
    }
    

}