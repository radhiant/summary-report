<?php
 
class angsuran_model extends CI_Model {
 
    var $table = 'angsuran as a'; //nama tabel dari database

    var $column_order = array(null, 'h.hutang_nama', 'a.angsuran_periode', 'a.angsuran_nilai_pembiayaan', 'a.angsuran_tgl', 'u.user_nmlengkap', 'a.angsuran_tgl_input'); //field yang ada di table user
    var $column_search = array('h.hutang_nama', 'a.angsuran_periode', 'a.angsuran_nilai_pembiayaan', 'a.angsuran_tgl', 'u.user_nmlengkap', 'a.angsuran_tgl_input'); //field yang diizin untuk pencarian 
    var $order = array('a.angsuran_id' => 'desc'); // default order 

    var $column_order1 = array(null, 'v.vendor_nama', 'a.angsuran_no_tagihan', 'a.angsuran_nilai_pembiayaan', 'a.angsuran_tgl', 'u.user_nmlengkap', 'a.angsuran_tgl_input'); //field yang ada di table user
    var $column_search1 = array('v.vendor_nama', 'a.angsuran_no_tagihan', 'a.angsuran_nilai_pembiayaan', 'a.angsuran_tgl', 'u.user_nmlengkap', 'a.angsuran_tgl_input'); //field yang diizin untuk pencarian 
    var $order1 = array('a.angsuran_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id','left'); 
        $this->db->join('user as u', 'u.user_id = a.angsuran_user_input','left'); 
        $this->db->where('a.angsuran_kategori', 'bank');
 
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

    private function _get_datatables_query1()
    {
         
        $this->db->from($this->table);
        $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id','left'); 
        $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama','left'); 
        $this->db->join('user as u', 'u.user_id = a.angsuran_user_input','left'); 
        $this->db->where('a.angsuran_kategori', 'vendor');
 
        $i = 0;
     
        foreach ($this->column_search1 as $item) // looping awal
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
 
                if(count($this->column_search1) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
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

    function get_datatables1()
    {
        $this->_get_datatables_query1();
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

    function count_filtered1()
    {
        $this->_get_datatables_query1();
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
        $this->db->order_by('angsuran_id','DESC');
        return $query = $this->db->get('angsuran');
    }

    public function angsuranTotal()
    {

      $data=$this->db
    ->select_sum('angsuran_nilai_pembiayaan')
    ->from('angsuran')
    ->get();
      $hutang = $data->row();
      return $hutang->angsuran_nilai_pembiayaan;
    }

    public function detailJoin($where)
    {
      $this->db->select('*');
      $this->db->from('angsuran as a');
      $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id', 'left');
      $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama', 'left');
      $this->db->join('user as u', 'u.user_id = a.angsuran_user_input','left'); 
      $this->db->where('a.angsuran_id',$where);
      return $query = $this->db->get();
    }

    public function angsuran($tglAwal, $tglAkhir, $tahun)
    {

      $this->db->select_sum('angsuran_nilai_pembiayaan');
      if($tglAwal != ''){
        $this->db->where('angsuran_tgl >=', $tglAwal);
        $this->db->where('angsuran_tgl <=', $tglAkhir);
      }else{
        $this->db->where('YEAR(angsuran_tgl)', $tahun);
      }
      $data= $this->db->get('angsuran');
      $angsuran = $data->row();
      return $angsuran->angsuran_nilai_pembiayaan;
    }

    public function lapangsuran($kategori, $layanan, $tglAwal, $tglAkhir, $tahun)
    {

      $this->db->select_sum('a.angsuran_nilai_pembiayaan');
      $this->db->join('hutang as h', 'h.hutang_id = a.hutang_id' , 'left');
      $this->db->join('project as pj', 'pj.project_id = h.project_id' , 'left');
      $this->db->join('customer as c', 'c.customer_id = pj.customer_id' , 'left');

      if($tglAwal != ''){
        $this->db->where('a.angsuran_tgl >=', $tglAwal);
        $this->db->where('a.angsuran_tgl <=', $tglAkhir);
      }else{
        $this->db->where('YEAR(a.angsuran_tgl)', $tahun);
      }

      $this->db->where('pj.project_layanan', $layanan);
      $this->db->where('c.customer_kategori', $kategori);

      $data= $this->db->get('angsuran as a');
      $angsuran = $data->row();
      return $angsuran->angsuran_nilai_pembiayaan;
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


    public function buat_kode()   {
		  $this->db->select('RIGHT(angsuran.angsuran_id,4) as kode', FALSE);
		  $this->db->order_by('angsuran_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('angsuran');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "AGS-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
    }
    


 
}