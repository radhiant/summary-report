<?php
 
class pembiayaan_model extends CI_Model {
 
    var $table = 'pembiayaan as p'; //nama tabel dari database

    var $column_order = array(null,'k.katbiaya_nama', 'p.pembiayaan_beban_biaya', 'pj.project_nama', 'p.pembiayaan_tgl', 'p.pembiayaan_nilai_realisasi', 'p.pembiayaan_ket', 'p.pembiayaan_tgl_input', 'u.user_nmlengkap'); //field yang ada di table user
    var $column_search = array('k.katbiaya_nama', 'p.pembiayaan_beban_biaya', 'pj.project_nama', 'p.pembiayaan_tgl', 'p.pembiayaan_nilai_realisasi', 'p.pembiayaan_ket', 'p.pembiayaan_tgl_input', 'u.user_nmlengkap'); //field yang diizin untuk pencarian 
    var $order = array('p.pembiayaan_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('katbiaya as k', 'k.katbiaya_id = p.katbiaya_id','left');
        $this->db->join('project as pj', 'pj.project_id = p.project_id','left');
        $this->db->join('user as u', 'u.user_id = p.user_id','left');

        if($this->input->post('tglawal')){
          $timeAwal = strtotime($this->input->post('tglawal'));
          $timeAkhir = strtotime($this->input->post('tglakhir'));
          $newformatAwal = date('Y-m-d',$timeAwal);
          $newformatAkhir = date('Y-m-d',$timeAkhir);

          $this->db->where('p.pembiayaan_tgl >=', $newformatAwal);
          $this->db->where('p.pembiayaan_tgl <=', $newformatAkhir);
      }
      
        if($this->session->userdata('login_session')['level'] == '3'){
          $this->db->where('k.katbiaya_nama', 'PENGADAAN');
        }elseif($this->session->userdata('login_session')['level'] == '4'){
          $this->db->where('k.katbiaya_nama', 'PERJALANAN DINAS');
        }
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function data()
    {
        $this->db->order_by('pembiayaan_id','DESC');
        return $query = $this->db->get('pembiayaan');
    }

    public function nonproject($tglAwal, $tglAkhir, $tahun)
    {

      $this->db->select_sum('pembiayaan_nilai_realisasi');
      if($tglAwal != ''){
        $this->db->where('pembiayaan_tgl >=', $tglAwal);
        $this->db->where('pembiayaan_tgl <=', $tglAkhir);
      }else{
        $this->db->where('YEAR(pembiayaan_tgl)', $tahun);
      }
      $this->db->where('pembiayaan_beban_biaya', 'Non Project');
      $data= $this->db->get('pembiayaan');
      $nonprojek = $data->row();
      return $nonprojek->pembiayaan_nilai_realisasi;
    }

    public function katbiayaP($where)
    {
      $this->db->select('*');
      $this->db->from('pembiayaan as p');
      $this->db->join('katbiaya as k', 'k.katbiaya_id = p.katbiaya_id', 'left');
      $this->db->group_by('p.katbiaya_id'); 
      $this->db->where('p.project_id',$where);
      return $query = $this->db->get();
    }

    public function projek($tglAwal, $tglAkhir, $tahun)
    {

      $this->db->select_sum('pembiayaan_nilai_realisasi');
      if($tglAwal != ''){
        $this->db->where('pembiayaan_tgl >=', $tglAwal);
        $this->db->where('pembiayaan_tgl <=', $tglAkhir);
      }else{
        $this->db->where('YEAR(pembiayaan_tgl)', $tahun);
      }
      $this->db->where('pembiayaan_beban_biaya', 'Project');
      $data= $this->db->get('pembiayaan');
      $prjk = $data->row();
      return $prjk->pembiayaan_nilai_realisasi;
    }

    public function pmGrafik($tglAwal, $tglAkhir)
    {

      $this->db->select_sum('pembiayaan_nilai_realisasi');
      if($tglAwal != ''){
        $this->db->where('pembiayaan_tgl >=', $tglAwal);
        $this->db->where('pembiayaan_tgl <=', $tglAkhir);
      }
      $this->db->where('pembiayaan_beban_biaya', 'Project');
      $data= $this->db->get('pembiayaan');
      $prjk = $data->row();
      return $prjk->pembiayaan_nilai_realisasi;
    }

    public function lapPembiayaan($kategori, $layanan, $tglAwal, $tglAkhir, $tahun)
    {

      $this->db->select_sum('p.pembiayaan_nilai_realisasi');
      $this->db->join('project as pj', 'pj.project_id = p.project_id' , 'left');
      $this->db->join('customer as c', 'c.customer_id = pj.customer_id' , 'left');

      if($tglAwal != ''){
        $this->db->where('p.pembiayaan_tgl >=', $tglAwal);
        $this->db->where('p.pembiayaan_tgl <=', $tglAkhir);
      }else{
        $this->db->where('YEAR(p.pembiayaan_tgl)', $tahun);
      }

      $this->db->where('pj.project_layanan', $layanan);
      $this->db->where('c.customer_kategori', $kategori);

      $data= $this->db->get('pembiayaan as p');
      $total = $data->row();
      return $total->pembiayaan_nilai_realisasi;
    }

    public function detailJoin($where)
    {
      $this->db->select('*');
      $this->db->from('pembiayaan as p');
      $this->db->join('katbiaya as k', 'k.katbiaya_id = p.katbiaya_id','left');
      $this->db->join('project as pj', 'pj.project_id = p.project_id','left');
      $this->db->join('user as u', 'u.user_id = p.user_id','left');
      $this->db->where('p.pembiayaan_id',$where);
      return $query = $this->db->get();
    }

    function dataOrderby($order)
    {
        $this->db->order_by('pembiayaan_id',$order);
        return $query = $this->db->get('pembiayaan');
    }


    public function ambilId($table, $where)
   {
       return $this->db->get_where($table, $where);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
         if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;

    }


    public function detail_data($where, $table)
    {
       return $this->db->get_where($table,$where);
    }

    public function tambah_data($data, $table)
    {
       $this->db->insert($table, $data);
    }

    public function ubah_data($where, $data, $table)
    {
       $this->db->where($where);
       $this->db->update($table, $data);

    }

    public function delete_all($table)
    {
        $this->db->empty_table($table);
         if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return false;

    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('pembiayaan', $data);
	}


    public function buat_kode()   {
		  $this->db->select('RIGHT(pembiayaan.pembiayaan_id,4) as kode', FALSE);
		  $this->db->order_by('pembiayaan_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('pembiayaan');      //cek dulu apakah ada sudah ada kode di tabel.
		  if($query->num_rows() <> 0){
		   //jika kode ternyata sudah ada.
		   $data = $query->row();
		   $kode = intval($data->kode) + 1;
		  }
		  else {
		   //jika kode belum ada
		   $kode = 1;
		  }
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "PMB-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
  }
  
    // Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
    unlink("./excel/import_data_pembiayaan.xlsx");
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '5048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

 
}