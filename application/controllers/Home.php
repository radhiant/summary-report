<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user_model');
		$this->load->model('customer_model');
		$this->load->model('project_model');
		$this->load->model('pendapatan_model');
		$this->load->model('hutang_model');
		$this->load->model('pembiayaan_model');
		$this->load->model('angsuran_model');
		$this->load->model('vendor_model');

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
		$data['judul'] = "Home";
		$data['project'] = $this->project_model->dataJoin()->num_rows();
		$data['dataprojek'] = $this->project_model->dataJoin()->result();
		$data['customer'] = $this->customer_model->data()->num_rows();
		$data['vendor'] = $this->vendor_model->data()->num_rows();
		$data['user'] = $this->user_model->data()->num_rows();
		$data['piutang'] = $this->pendapatan_model->piutang();
		$hutang = $this->hutang_model->hutangTotal();
		$angsuran = $this->angsuran_model->angsuranTotal();
		$data['totalHutang'] = $hutang - $angsuran;

		$data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
		$data['twoyearago']=date('Y', strtotime('-2 year'));
        
		$this->load->view('templates/header', $data);
		$this->load->view('home/index');
		$this->load->view('js/homejs');
		$this->load->view('templates/footer');
		
	}

	public function indexPrint()
	{   
		$data['judul'] = "Print Pendapatan";
		$data['piutang'] = $this->pendapatan_model->piutang();
		$hutang = $this->hutang_model->hutangTotal();
		$angsuran = $this->angsuran_model->angsuranTotal();
		$data['totalHutang'] = $hutang - $angsuran;

		$bulan = $this->input->post('bln');
		$tahun = $this->input->post('thn');

		if($bulan == ''){
			$last = null;
			$first = null;
		}else {
			$last = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));
			$first = date('Y-m-01', strtotime($tahun.'-'.$bulan.'-01'));
		};

		switch ($bulan) {
			case "January":
			  $bulanView = 'Januari';
			  break;
			case "February":
			  $bulanView = 'Februari';
			  break;
			case "March":
			  $bulanView = 'Maret';
			  break;
			case "April":
			  $bulanView = 'April';
			  break;
			case "May":
			  $bulanView = 'Mei';
			  break;
			case "June":
			  $bulanView = 'Juni';
			  break;
			case "July":
			  $bulanView = 'Juli';
			  break;
			case "August":
			  $bulanView = 'Agustus';
			  break;
			case "September":
			  $bulanView = 'September';
			  break;
			case "October":
			  $bulanView = 'Oktober';
			  break;
			case "November":
			  $bulanView = 'November';
			  break;
			case "December":
			  $bulanView = 'Desember';
			  break;
			  
			default:
			  $bulanView = 'Semua';
		  }
		

		$pendapatan = $this->pendapatan_model->pendapatan($first, $last, $tahun);
		$nonprojek = $this->pembiayaan_model->nonproject($first, $last, $tahun);

		$projek = $this->pembiayaan_model->projek($first, $last, $tahun);
		$angsuran = $this->angsuran_model->angsuran($first, $last, $tahun);

		$jumlah1 = $projek == '' ? intval('0') : intval($projek);
		$jumlah2 = $angsuran == '' ? intval('0') : intval($angsuran);

		$jumlah =  $jumlah1 + $jumlah2;
		$total = (string) $jumlah;

		$data['pendapatan'] = $pendapatan == '' ? '0' : $pendapatan;
		$data['nonprojek'] = $nonprojek == '' ? '0' : $nonprojek;
		$data['investasi'] = $total;
		$totalPembiayaan = intval($total) + intval($nonprojek);
		$subtotal = intval($pendapatan) - $totalPembiayaan;

		$data['ttl'] = $subtotal;
		$data['bulan'] = $bulanView;
		$data['tahun'] = $tahun;
        
		$this->load->view('templates/no_header', $data);
		$this->load->view('home/print');
		$this->load->view('js/homejs');
		$this->load->view('templates/no_footer');
		
	}

	public function getData()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		if($bulan == ''){
			$last = null;
			$first = null;
		}else {
			$last = date('Y-m-t', strtotime($tahun.'-'.$bulan.'-01'));
			$first = date('Y-m-01', strtotime($tahun.'-'.$bulan.'-01'));
		};
		

		$pendapatan = $this->pendapatan_model->pendapatan($first, $last, $tahun);
		$nonprojek = $this->pembiayaan_model->nonproject($first, $last, $tahun);

		$projek = $this->pembiayaan_model->projek($first, $last, $tahun);
		$angsuran = $this->angsuran_model->angsuran($first, $last, $tahun);

		$jumlah1 = $projek == '' ? intval('0') : intval($projek);
		$jumlah2 = $angsuran == '' ? intval('0') : intval($angsuran);

		$jumlah =  $jumlah1 + $jumlah2;
		$total = (string) $jumlah;

		$investasi = '0';

		$data = array(
			'pendapatan' => $pendapatan == '' ? '0' : $pendapatan,
			'nonprojek' => $nonprojek == '' ? '0' : $nonprojek,
			'investasi' => $total
		);

		echo json_encode($data);
	}


}