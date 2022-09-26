<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('pendapatan_model');
        $this->load->model('pembiayaan_model');
        $this->load->model('project_model');
        $this->load->model('katbiaya_model');
		$this->load->model('angsuran_model');

		if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
			redirect('login/logout');
			exit;
		}else{

			if($this->session->userdata('login_session')['level'] == '1' || $this->session->userdata('login_session')['level'] == '6'){
            
			}else{
				redirect('pembiayaan');
			}

		}

		
      }

	public function index()
	{   
        $data['judul'] = 'Laporan Per Kategori';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
		$data['twoyearago']=date('Y', strtotime('-2 year'));


		$this->load->view('templates/header', $data);
		$this->load->view('laporan/index');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
	}

	public function noninvest($bulan = 'Semua', $tahun = null)
	{   
        $data['judul'] = 'Laporan Non Investasi';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
		$data['twoyearago']=date('Y', strtotime('-2 year'));

		$data['katbiaya'] = $this->katbiaya_model->data()->result();

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


		$this->load->view('templates/header', $data);
		$this->load->view('laporan/noninvest');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
	}

	public function detailProject($idproject = '' , $bulan = 'Semua', $tahun = null)
	{   
        $data['judul'] = 'Laporan Detail Project';

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

		$idp = $idproject;

		if(!$idp == ''){
			$data['dproject'] = $this->project_model->detailJoin($idp)->result();
		}

		if($this->session->userdata('login_session')['level'] == '6'){
			$usr = $this->session->userdata('login_session')['id_user'];
			$data['project'] = $this->project_model->detailJoinCostumer($usr)->result();
		}else{
			$data['project'] = $this->project_model->dataJoin()->result();
		}

		
		$data['katbiaya'] = $this->pembiayaan_model->katbiayaP($idp)->result();
		
		$data['tglAwal'] = $first;
		$data['tglAkhir'] = $last;
		$data['tahun'] = $thn;
		$data['bulan'] = $bln;
		$data['idp'] = $idp;


		$this->load->view('templates/header', $data);
		$this->load->view('laporan/detailproject');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
	}

	public function detailProjectPrint($idproject = '' , $bulan = 'Semua', $tahun = null)
	{   
        $data['judul'] = 'Print Laporan';

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

		$idp = $idproject;

		if(!$idp == ''){
			$data['dproject'] = $this->project_model->detailJoin($idp)->result();
		}

		if($this->session->userdata('login_session')['level'] == '6'){
			$usr = $this->session->userdata('login_session')['id_user'];
			$data['project'] = $this->project_model->detailJoinCostumer($usr)->result();
		}else{
			$data['project'] = $this->project_model->dataJoin()->result();
		}
		
		$data['katbiaya'] = $this->pembiayaan_model->katbiayaP($idp)->result();
		
		$data['tglAwal'] = $first;
		$data['tglAkhir'] = $last;
		$data['tahun'] = $thn;
		$data['bulan'] = $bln;
		$data['idp'] = $idp;


		$this->load->view('templates/no_header', $data);
		$this->load->view('laporan/detailprojectprint');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/no_footer');
	}

	public function noinvestprint($bulan, $tahun)
	{   
		$data['judul'] = 'Print Laporan';
		$data['katbiaya'] = $this->katbiaya_model->data()->result();

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
		$this->load->view('laporan/noinvestprint');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/no_footer');
	}


	
	public function index2($bulan = 'Semua', $tahun = null)
	{   
		$data['judul'] = 'Laporan Per Projek';
		
		$data['project'] = $this->project_model->dataJoin()->result();

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


		$this->load->view('templates/header', $data);
		$this->load->view('laporan/index2');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
	}

	public function indexPrint()
	{   
        $data['judul'] = 'Print Laporan';

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
		

        $data['pSewa'] = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Sewa', $first, $last, $tahun);
		$data['pJual'] = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Jual', $first, $last, $tahun);
		$data['pLain'] = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Lain-lain', $first, $last, $tahun);


        $data['sSewa'] = $this->pendapatan_model->lapPendapatan('Swasta', 'Sewa', $first, $last, $tahun);
        $data['sJual'] = $this->pendapatan_model->lapPendapatan('Swasta', 'Jual', $first, $last, $tahun);
        $data['sRepair'] = $this->pendapatan_model->lapPendapatan('Swasta', 'Repair', $first, $last, $tahun);
		$data['sLain'] = $this->pendapatan_model->lapPendapatan('Swasta', 'Lain-lain', $first, $last, $tahun);

		$pemPeSe = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Sewa', $first, $last, $tahun);
        $pemPeJu = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Jual', $first, $last, $tahun);
		$pemPeLain = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Lain-lain', $first, $last, $tahun);

        $pemSwSe = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Sewa', $first, $last, $tahun);
        $pemSwJu = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Jual', $first, $last, $tahun);
		$pemSwRe = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Repair', $first, $last, $tahun);
		$pemSwLain = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Lain-lain', $first, $last, $tahun);

		$angsuranPeSe = $this->angsuran_model->lapangsuran('Pemerintahan', 'Sewa', $first, $last, $tahun);
		$angsuranPeJu= $this->angsuran_model->lapangsuran('Pemerintahan', 'Jual', $first, $last, $tahun);
		$angsuranPeLain= $this->angsuran_model->lapangsuran('Pemerintahan', 'Lain-lain', $first, $last, $tahun);

		$angsuranSwSe = $this->angsuran_model->lapangsuran('Swasta', 'Sewa', $first, $last, $tahun);
		$angsuranSwJu = $this->angsuran_model->lapangsuran('Swasta', 'Jual', $first, $last, $tahun);
		$angsuranSwRe = $this->angsuran_model->lapangsuran('Swasta', 'Repair', $first, $last, $tahun);
		$angsuranSwLain = $this->angsuran_model->lapangsuran('Swasta', 'Lain-lain', $first, $last, $tahun);

		$totalPeSe = intval($pemPeSe) + intval($angsuranPeSe);
		$totalPeJu = intval($pemPeJu) + intval($angsuranPeJu);
		$totalPeLain = intval($pemPeLain) + intval($angsuranPeLain);

		$totalSwSe = intval($pemSwSe) + intval($angsuranSwSe);
		$totalSwJu = intval($pemSwJu) + intval($angsuranSwJu);
		$totalSwRe = intval($pemSwRe) + intval($angsuranSwRe);
		$totalSwLain = intval($pemSwLain) + intval($angsuranSwLain);

		$data['ppSewa'] = $totalPeSe;
        $data['ppJual'] = $totalPeJu;
		$data['ppLain'] = $totalPeLain;

        $data['ssSewa'] = $totalSwSe;
        $data['ssJual'] = $totalSwJu;
		$data['ssRepair'] = $totalSwRe;
		$data['ssLain'] = $totalSwLain;

        $data['bulan'] = $bulanView;
		$data['tahun'] = $tahun;


		$this->load->view('templates/no_header', $data);
		$this->load->view('laporan/print');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/no_footer');
	}
	
	public function index2print($bulan, $tahun)
	{   
		$data['judul'] = 'Print Laporan';
		
		$data['project'] = $this->project_model->dataJoin()->result();

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
		$this->load->view('laporan/index2print');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/no_footer');
	}
    
    public function getPendapatan()
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

        $pemerintahanSewa = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Sewa', $first, $last, $tahun);
        $pemerintahanJual = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Jual', $first, $last, $tahun);
		$pemerintahanLain = $this->pendapatan_model->lapPendapatan('Pemerintahan', 'Lain-lain', $first, $last, $tahun);

        $swastaSewa = $this->pendapatan_model->lapPendapatan('Swasta', 'Sewa', $first, $last, $tahun);
        $swastaJual = $this->pendapatan_model->lapPendapatan('Swasta', 'Jual', $first, $last, $tahun);
		$swastaRepair = $this->pendapatan_model->lapPendapatan('Swasta', 'Repair', $first, $last, $tahun);
		$swastaLain = $this->pendapatan_model->lapPendapatan('Swasta', 'Lain-lain', $first, $last, $tahun);
		
        $pSewa = $pemerintahanSewa == '' ? '0' : $pemerintahanSewa;
        $pJual = $pemerintahanJual == '' ? '0' : $pemerintahanJual;
		$pLain = $pemerintahanLain == '' ? '0' : $pemerintahanLain;

        $sSewa = $swastaSewa == '' ? '0' : $swastaSewa;
        $sJual = $swastaJual == '' ? '0' : $swastaJual;
        $sRepair = $swastaRepair == '' ? '0' : $swastaRepair;
		$sLain = $swastaLain == '' ? '0' : $swastaLain;

        $data = array(
			'pemerintahanSewa' => $pSewa,
			'pemerintahanJual' => $pJual,
			'pemerintahanLain' => $pLain,
            'swastaSewa' => $sSewa,
            'swastaJual' => $sJual,
			'swastaRepair' => $sRepair,
			'swastaLain' => $sLain,
		
		);

		echo json_encode($data);
    
    }

    public function getPembiayaan()
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

		$pemerintahanSewa = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Sewa', $first, $last, $tahun);
		$pemerintahanJual = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Jual', $first, $last, $tahun);
		$pemerintahanLain = $this->pembiayaan_model->lapPembiayaan('Pemerintahan', 'Lain', $first, $last, $tahun);

		$angsuranPeSe = $this->angsuran_model->lapangsuran('Pemerintahan', 'Sewa', $first, $last, $tahun);
		$angsuranPeJu = $this->angsuran_model->lapangsuran('Pemerintahan', 'Jual', $first, $last, $tahun);
		$angsuranPeLain = $this->angsuran_model->lapangsuran('Pemerintahan', 'Lain-lain', $first, $last, $tahun);

        $swastaSewa = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Sewa', $first, $last, $tahun);
        $swastaJual = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Jual', $first, $last, $tahun);
		$swastaRepair = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Repair', $first, $last, $tahun);
		$swastaLain = $this->pembiayaan_model->lapPembiayaan('Swasta', 'Lain-lain', $first, $last, $tahun);

		$angsuranSwSe = $this->angsuran_model->lapangsuran('Swasta', 'Sewa', $first, $last, $tahun);
		$angsuranSwJu = $this->angsuran_model->lapangsuran('Swasta', 'Jual', $first, $last, $tahun);
		$angsuranSwRe = $this->angsuran_model->lapangsuran('Swasta', 'Repair', $first, $last, $tahun);
		$angsuranSwLain = $this->angsuran_model->lapangsuran('Swasta', 'Lain-lain', $first, $last, $tahun);
		

        $pSewa = intval($pemerintahanSewa) + intval($angsuranPeSe);
		$pJual = intval($pemerintahanJual) + intval($angsuranPeJu);
		$pLain = intval($pemerintahanLain) + intval($angsuranPeLain);

        $sSewa = intval($swastaSewa) + intval($angsuranSwSe);
        $sJual = intval($swastaJual) + intval($angsuranSwJu);
        $sRepair = intval($swastaRepair) + intval($angsuranSwRe);
		$sLain = intval($swastaLain) + intval($angsuranSwLain);

        $data = array(
			'pemerintahanSewa' => (string) $pSewa,
			'pemerintahanJual' => (string) $pJual,
			'pemerintahanLain' => (string) $pLain,
            'swastaSewa' => (string) $sSewa,
            'swastaJual' => (string) $sJual,
			'swastaRepair' => (string) $sRepair,
			'swastaLain' => (string) $sLain
		);

		echo json_encode($data);
    
	}
	
	
	//Investasi Project
	public function investp()
	{
		$data['judul'] = "Invest Project";
		$data['project'] = $this->project_model->dataJoin()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('laporan/investp');
		$this->load->view('js/laporanjs');
		$this->load->view('templates/footer');
	}

	//Print Investasi Project
	public function investPprint()
	{
		$data['judul'] = "Print Laporan";
		$data['project'] = $this->project_model->dataJoin()->result();
		$this->load->view('templates/no_header', $data);
		$this->load->view('laporan/print/investprint');
		$this->load->view('templates/no_footer');
	}
	
}
