<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('hutang_model');
        $this->load->model('project_model');
        $this->load->model('vendor_model');

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
        $data['judul'] = "Hutang";
        
		$this->load->view('templates/header', $data);
		$this->load->view('hutang/index');
		$this->load->view('js/hutangjs');
		$this->load->view('templates/footer');
    }

    public function tambah($kategori)
	{   
        $data['judul'] = "Hutang";
        $data['project'] = $this->project_model->dataJoin()->result();
        $data['vendor'] = $this->vendor_model->data()->result();
        $data['kategori'] = $kategori;

		$this->load->view('templates/header', $data);
		$this->load->view('hutang/tambah');
		$this->load->view('js/hutangjs');
		$this->load->view('templates/footer');
    }

    public function ubah($id)
	{   
        $data['judul'] = "Hutang";
        $where = array('hutang_id' => $id);

        $data['project'] = $this->project_model->dataJoin()->result();
        $data['vendor'] = $this->vendor_model->data()->result();
        $data['data'] = $this->hutang_model->detail_data($where, 'hutang')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('hutang/ubah');
		$this->load->view('js/hutangjs');
		$this->load->view('templates/footer');
    }

    public function detail($id)
	{   
        $data['judul'] = "Hutang";
        $data['data'] = $this->hutang_model->detailJoin($id)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('hutang/detail');
		$this->load->view('js/hutangjs');
		$this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['judul'] = 'Laporan Hutang';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
        $data['twoyearago']=date('Y', strtotime('-2 year'));
        
        $data['data'] = $this->hutang_model->dataJoinGroupBy()->result();

        $this->load->view('templates/header', $data);
		$this->load->view('laporan/laphutang');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
    }

    public function laporanPrint($bulan = 'Semua', $tahun = null)
    {
        $data['judul'] = 'Print Laporan';
		
		$data['data'] = $this->hutang_model->dataJoinGroupBy()->result();

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
		$data['twoyearago']=date('Y', strtotime('-2 year'));

		$bln = $bulan;
		$thn = $tahun == null ? date('Y', strtotime('+0 year')) : $tahun;

		if($bln == 'Semua'){
			$last = null;
			$first = null;
		}else {
			$last = date('Y-m-t', strtotime($thn.'-'.$bln.'-01'));
			$first = date('Y-m-01', strtotime($thn.'-'.$bln.'-01'));
		};
		
		$data['tglAwal'] = $first;
		$data['tglAkhir'] = $last;
		$data['tahun'] = $thn;
		$data['bulan'] = $bln;
        
        $this->load->view('templates/no_header', $data);
		$this->load->view('laporan/laphutangPrint');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/no_footer');
    }

    public function proses_tambah()
    {
        $kode = $this->hutang_model->buat_kode();
		$idP = $this->input->post('idP');
		$namaH = $this->input->post('namaH');
		$nilaiH = $this->input->post('nilaiH');
        $cicilan = $this->input->post('cicilan');
        $noT = $this->input->post('noT');
        $tglS = $this->input->post('tglS');
        $tglF = $this->input->post('tglF');
        $jenisH = $this->input->post('jenisH');
        $kategori = $this->input->post('kategori');

        $tglS1 = strtotime($tglS);
        $formatTglS = date('Y-m-d',$tglS1);

        $tglF1 = strtotime($tglF);
        $formatTglF = date('Y-m-d',$tglF1);


        $data = array(
            'hutang_id' => $kode,
            'project_id' => $idP,
            'hutang_nama' => $namaH,
            'hutang_nilai' => $nilaiH == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $nilaiH)),
            'hutang_cicilan' => $cicilan == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $cicilan)),
            'hutang_tgl_start' => $kategori == 'bank' ? $formatTglS : null,
            'hutang_tgl_finish' => $formatTglF,
            'hutang_jenis' => $jenisH,
            'hutang_kategori' => $kategori,
            'hutang_no_tagihan' => $noT
        );

        $this->hutang_model->tambah_data($data, 'hutang');
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
		redirect('hutang');
        
    }

    public function proses_ubah()
    {
        $kode = $this->input->post('idH');
		$idP = $this->input->post('idP');
		$namaH = $this->input->post('namaH');
		$nilaiH = $this->input->post('nilaiH');
        $cicilan = $this->input->post('cicilan');
        $tglS = $this->input->post('tglS');
        $tglF = $this->input->post('tglF');
        $jenisH = $this->input->post('jenisH');
        $kategori = $this->input->post('kategori');
        $noT = $this->input->post('noT');

        $tglS1 = strtotime($tglS);
        $formatTglS = date('Y-m-d',$tglS1);

        $tglF1 = strtotime($tglF);
        $formatTglF = date('Y-m-d',$tglF1);


        $data = array(
            'project_id' => $idP,
            'hutang_nama' => $namaH,
            'hutang_nilai' => $nilaiH == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $nilaiH)),
            'hutang_cicilan' => $cicilan == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $cicilan)),
            'hutang_tgl_start' => $kategori == 'bank' ? $formatTglS : null,
            'hutang_tgl_finish' => $formatTglF,
            'hutang_jenis' => $jenisH,
            'hutang_kategori' => $kategori,
            'hutang_no_tagihan' => $noT
        );

        $where = array(
            'hutang_id' => $kode
        );

        $this->hutang_model->ubah_data($where, $data, 'hutang');
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
		redirect('hutang');
        
    }

    public function proses_hapus($id)
	{
		$where = array('hutang_id' => $id );
		$this->hutang_model->hapus_data($where, 'hutang');
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
		redirect('hutang');
    }
    
    public function hapus_all($kategori)
	{
		$where = array('hutang_kategori' => $kategori );
		$this->hutang_model->hapus_data($where, 'hutang');
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
		redirect('hutang');
	}
    


    function getDataHutangBank()
    {
        $list = $this->hutang_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'hutang/detail/'.$field->hutang_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'hutang/ubah/'.$field->hutang_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->hutang_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            $nilai = "" . number_format($field->hutang_nilai,0,',','.');
            $cicilan = "" . number_format($field->hutang_cicilan,0,',','.');

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
            $start = explode('-', $field->hutang_tgl_start);
            $finish = explode('-', $field->hutang_tgl_finish);
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->project_nama;
            $row[] = $field->hutang_nama;
            $row[] = $nilai;
            $row[] = $cicilan;
            $row[] = $start[2] . ' ' . $bulan[ (int)$start[1] ] . ' ' . $start[0];
            $row[] = $finish[2] . ' ' . $bulan[ (int)$finish[1] ] . ' ' . $finish[0];
            $row[] = $field->hutang_jenis;
            $row[] = $aksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->hutang_model->count_all(),
            "recordsFiltered" => $this->hutang_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    function getDataHutangVendor()
    {
        $list = $this->hutang_model->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $aksi = '<div class="dropdown d-inline">
            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon text-primary" href="'.base_url().'hutang/detail/'.$field->hutang_id.'"><i class="fas fa-eye"></i> Detail</a>
              <a class="dropdown-item has-icon text-success" href="'.base_url().'hutang/ubah/'.$field->hutang_id.'"><i class="fas fa-pen"></i> Ubah</a>
              <a class="dropdown-item has-icon text-danger" href="#" onclick="konfirmasi('."'".$field->hutang_id."'".')"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>';
            
            // $nilai = "" . number_format($field->hutang_nilai,0,',','.');
            if($field->hutang_nilai == ''){
                    $nilai = "Rp0";
            }else{
                if (strpos($field->hutang_nilai, ',') !== false) {
                    $exp1 = explode(",", $field->hutang_nilai);
    
                    $nilai = "Rp". number_format($exp1[0],0,',','.') . "," . $exp1[1];
                }else{
                    $nilai = "Rp" . number_format($field->hutang_nilai,0,',','.');
                }
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

            $finish = explode('-', $field->hutang_tgl_finish);
            
            $no++;
            $row = array();
            $row[] = $no.'.';
            $row[] = $field->project_nama;
            $row[] = $field->vendor_nama;
            $row[] = $field->hutang_no_tagihan;
            $row[] = $nilai;
            $row[] = $finish[2] . ' ' . $bulan[ (int)$finish[1] ] . ' ' . $finish[0];
            $row[] = $aksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->hutang_model->count_all(),
            "recordsFiltered" => $this->hutang_model->count_filtered1(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

}