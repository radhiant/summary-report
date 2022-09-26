<?php
 
class hutang_model extends CI_Model {
 
    var $table = 'hutang as h'; //nama tabel dari database

    var $column_order = array(null, 'p.project_nama', 'h.hutang_nama', 'h.hutang_nilai', 'h.hutang_cicilan', 'h.hutang_tgl_start', 'h.hutang_tgl_finish', 'h.hutang_jenis'); //field yang ada di table user
    var $column_search = array('p.project_nama', 'h.hutang_nama', 'h.hutang_nilai', 'h.hutang_cicilan', 'h.hutang_tgl_start', 'h.hutang_tgl_finish', 'h.hutang_jenis'); //field yang diizin untuk pencarian 
    var $order = array('h.hutang_id' => 'desc'); // default order
    
    var $column_order1 = array(null, 'p.project_nama', 'v.vendor_nama', 'h.hutang_no_tagihan', 'h.hutang_nilai', 'h.hutang_tgl_finish'); //field yang ada di table user
    var $column_search1 = array('p.project_nama', 'v.vendor_nama', 'h.hutang_no_tagihan', 'h.hutang_nilai', 'h.hutang_tgl_finish'); //field yang diizin untuk pencarian 
    var $order1 = array('h.hutang_id' => 'desc'); // default order
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('project as p', 'p.project_id = h.project_id','left');
        $this->db->where('h.hutang_kategori', 'bank');
 
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
        $this->db->join('project as p', 'p.project_id = h.project_id','left');
        $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama','left');
        $this->db->where('h.hutang_kategori', 'vendor');
 
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
        $this->db->order_by('hutang_id','DESC');
        return $query = $this->db->get('hutang');
    }

    function hbank()
    {
        $this->db->order_by('hutang_id','DESC');
        $this->db->where('hutang_kategori', 'bank');
        return $query = $this->db->get('hutang');
    }

    function hvendor()
    {
        $this->db->order_by('hutang_id','DESC');
        $this->db->where('hutang_kategori', 'vendor');
        return $query = $this->db->get('hutang');
    }

    public function detailJoin($where)
    {
      $this->db->select('*');
      $this->db->from('hutang as h');
      $this->db->join('project as p', 'p.project_id = h.project_id', 'left');
      $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama', 'left');
      $this->db->where('h.hutang_id',$where);
      return $query = $this->db->get();
    }

    public function dataJoinGroupBy()
    {
      $this->db->select('*');
      $this->db->from('hutang as h');
      $this->db->join('project as p', 'p.project_id = h.project_id', 'left');
      $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama', 'left');
      $this->db->where('h.hutang_kategori','bank');
      $this->db->group_by('h.project_id', 'h.hutang_nama');
      return $query = $this->db->get();
    }

    public function dataJoinVendor()
    {
      $this->db->select('*');
      $this->db->from('hutang as h');
      $this->db->join('vendor as v', 'v.vendor_id = h.hutang_nama', 'left');
      $this->db->order_by('h.hutang_id','DESC');
      $this->db->where('h.hutang_kategori', 'vendor');
      return $query = $this->db->get();
    }

    public function hutangTotal()
    {

      $data=$this->db
    ->select_sum('hutang_nilai')
    ->from('hutang')
    ->get();
      $hutang = $data->row();
      return $hutang->hutang_nilai;
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
		  $this->db->select('RIGHT(hutang.hutang_id,4) as kode', FALSE);
		  $this->db->order_by('hutang_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('hutang');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "HTG-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
	}

 
}