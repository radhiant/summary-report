<?php
 
class user_model extends CI_Model {
 
    var $table = 'user'; //nama tabel dari database
    var $column_order = array(null, 'user_nama','user_nmlengkap','user_level', 'user_divisi'); //field yang ada di table user
    var $column_search = array('user_nama','user_nmlengkap','user_level', 'user_divisi'); //field yang diizin untuk pencarian 
    var $order = array('user_id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->where_not_in('user_nama', 'dev');
 
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
        $this->db->order_by('user_id','DESC');
        $this->db->where_not_in('user_nama', 'dev');
        return $query = $this->db->get('user');
    }

    public function ambilFoto($where)
    {
      $this->db->order_by('user_id','DESC');
      $this->db->limit(1);
      $query = $this->db->get_where('user', $where);   
      
      $data = $query->row();
      $foto= $data->user_foto;
      
      return $foto;
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
		  $this->db->select('RIGHT(user.user_id,4) as kode', FALSE);
		  $this->db->order_by('user_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('user');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "USR-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
	}

 
}