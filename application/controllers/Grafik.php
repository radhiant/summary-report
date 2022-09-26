<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {

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

			if($this->session->userdata('login_session')['level'] == '1'){
            
			}else{
				redirect('pembiayaan');
			}

		}	
      }

      public function index()
	{   
        $data['judul'] = 'Laporan Grafik';

        $data['yearnow']=date('Y', strtotime('+0 year'));
		$data['previousyear']=date('Y', strtotime('-1 year'));
        $data['twoyearago']=date('Y', strtotime('-2 year'));
        

		$this->load->view('templates/header', $data);
		$this->load->view('laporan/grafik');
		$this->load->view('js/grafikjs');
		$this->load->view('templates/footer');
    }
    
    public function getData()
    {
        if($this->input->post('tahun')){
            $tahun = $this->input->post('tahun');
        }else{
            $tahun = date('Y', strtotime('+0 year'));
        }
        $awalJan = date($tahun.'-01-01'); 
        $akhirJan  = date($tahun.'-01-t');
        $pdJan = $this->pendapatan_model->pdGrafik($awalJan, $akhirJan);
        $pmJan = $this->pembiayaan_model->pmGrafik($awalJan, $akhirJan);

        $awalFeb = date($tahun.'-02-01'); 
        $akhirFeb  = date($tahun.'-02-t');
        $pdFeb = $this->pendapatan_model->pdGrafik($awalFeb, $akhirFeb);
        $pmFeb = $this->pembiayaan_model->pmGrafik($awalFeb, $akhirFeb);

        $awalMar = date($tahun.'-03-01'); 
        $akhirMar  = date($tahun.'-03-t');
        $pdMar = $this->pendapatan_model->pdGrafik($awalMar, $akhirMar);
        $pmMar = $this->pembiayaan_model->pmGrafik($awalMar, $akhirMar);

        $awalApr = date($tahun.'-04-01'); 
        $akhirApr  = date($tahun.'-04-t');
        $pdApr = $this->pendapatan_model->pdGrafik($awalApr, $akhirApr);
        $pmApr = $this->pembiayaan_model->pmGrafik($awalApr, $akhirApr);

        $awalMei = date($tahun.'-05-01'); 
        $akhirMei  = date($tahun.'-05-t');
        $pdMei = $this->pendapatan_model->pdGrafik($awalMei, $akhirMei);
        $pmMei = $this->pembiayaan_model->pmGrafik($awalMei, $akhirMei);

        $awalJun = date($tahun.'-06-01'); 
        $akhirJun  = date($tahun.'-06-t');
        $pdJun = $this->pendapatan_model->pdGrafik($awalJun, $akhirJun);
        $pmJun = $this->pembiayaan_model->pmGrafik($awalJun, $akhirJun);

        $awalJul = date($tahun.'-07-01'); 
        $akhirJul  = date($tahun.'-07-t');
        $pdJul = $this->pendapatan_model->pdGrafik($awalJul, $akhirJul);
        $pmJul = $this->pembiayaan_model->pmGrafik($awalJul, $akhirJul);

        $awalAgs = date($tahun.'-08-01'); 
        $akhirAgs  = date($tahun.'-08-t');
        $pdAgs = $this->pendapatan_model->pdGrafik($awalAgs, $akhirAgs);
        $pmAgs = $this->pembiayaan_model->pmGrafik($awalAgs, $akhirAgs);

        $awalSep = date($tahun.'-09-01'); 
        $akhirSep  = date($tahun.'-09-t');
        $pdSep = $this->pendapatan_model->pdGrafik($awalSep, $akhirSep);
        $pmSep = $this->pembiayaan_model->pmGrafik($awalSep, $akhirSep);

        $awalOkt = date($tahun.'-10-01'); 
        $akhirOkt  = date($tahun.'-10-t');
        $pdOkt = $this->pendapatan_model->pdGrafik($awalOkt, $akhirOkt);
        $pmOkt = $this->pembiayaan_model->pmGrafik($awalOkt, $akhirOkt);

        $awalNov = date($tahun.'-11-01'); 
        $akhirNov  = date($tahun.'-11-t');
        $pdNov = $this->pendapatan_model->pdGrafik($awalNov, $akhirNov);
        $pmNov = $this->pembiayaan_model->pmGrafik($awalNov, $akhirNov);

        $awalDes = date($tahun.'-12-01'); 
        $akhirDes  = date($tahun.'-12-t');
        $pdDes = $this->pendapatan_model->pdGrafik($awalDes, $akhirDes);
        $pmDes = $this->pembiayaan_model->pmGrafik($awalDes, $akhirDes);

        $data = array(
            'pndJan' => $pdJan == null ? '0' : $pdJan,
            'pmbJan' => $pmJan == null ? '0' : $pmJan,
            'pndFeb' => $pdFeb == null ? '0' : $pdFeb,
            'pmbFeb' => $pmFeb == null ? '0' : $pmFeb,
            'pndMar' => $pdMar == null ? '0' : $pdMar,
            'pmbMar' => $pmMar == null ? '0' : $pmMar,
            'pndApr' => $pdApr == null ? '0' : $pdApr,
            'pmbApr' => $pmApr == null ? '0' : $pmApr,
            'pndMei' => $pdMei == null ? '0' : $pdMei,
            'pmbMei' => $pmMei == null ? '0' : $pmMei,
            'pndJun' => $pdJun == null ? '0' : $pdJun,
            'pmbJun' => $pmJun == null ? '0' : $pmJun,
            'pndJul' => $pdJul == null ? '0' : $pdJul,
            'pmbJul' => $pmJul == null ? '0' : $pmJul,
            'pndAgs' => $pdAgs == null ? '0' : $pdAgs,
            'pmbAgs' => $pmAgs == null ? '0' : $pmAgs,
            'pndSep' => $pdSep == null ? '0' : $pdSep,
            'pmbSep' => $pmSep == null ? '0' : $pmSep,
            'pndOkt' => $pdOkt == null ? '0' : $pdOkt,
            'pmbOkt' => $pmOkt == null ? '0' : $pmOkt,
            'pndNov' => $pdNov == null ? '0' : $pdNov,
            'pmbNov' => $pmNov == null ? '0' : $pmNov,
            'pndDes' => $pdDes == null ? '0' : $pdDes,
            'pmbDes' => $pmDes == null ? '0' : $pmDes,

        );

        echo json_encode($data);

    }

}