<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('pendapatan_model');
        
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
        $data['judul'] = "Piutang";
        $data['data'] = $this->pendapatan_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('piutang/index');
		$this->load->view('js/piutangjs');
		$this->load->view('templates/footer');
		
    }
    
    public function proses_ubah_bayar()
    {
        $kode = $this->input->post('idP');
		$tglB = $this->input->post('tglB');
        $bayarr = $this->input->post('bayarr');
        
        $tglbTime = strtotime($tglB);
        $formatB = date('Y-m-d',$tglbTime);

        $data = array(
            'pendapatan_tgl_bayar' => $formatB,
            'pendapatan_jml_bayar' => $bayarr == '' ? '0' : trim(preg_replace('/[^A-Za-z0-9-]+/', '', $bayarr)),
        );

        $where = array('pendapatan_id' => $kode);

        $this->pendapatan_model->ubah_data($where, $data, 'pendapatan');
		$this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
			swal.fire({
				title: "Berhasil dibayarkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
			});
			</script>
			');
		redirect('piutang');

    }

}
