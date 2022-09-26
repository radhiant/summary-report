<?php
 
class project_model extends CI_Model {
 
    var $table = 'project as p'; //nama tabel dari database

    var $column_order = array(null, 'p.project_nama','cs.customer_nama', 'p.project_layanan', 'p.project_kontrak_nilai', 'p.project_kontrak_start', 'p.project_kontrak_end'); //field yang ada di table user
    var $column_search = array('p.project_nama','cs.customer_nama','p.project_layanan', 'p.project_kontrak_nilai', 'p.project_kontrak_start', 'p.project_kontrak_end'); //field yang diizin untuk pencarian 
    var $order = array('p.project_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('customer as cs', 'cs.customer_id = p.customer_id','left');
 
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
        $this->db->order_by('project_id','DESC');
        return $query = $this->db->get('project');
    }

    public function dataJoin()
    {
      $this->db->select('*');
      $this->db->from('project as p');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      return $query = $this->db->get();
    }

    public function detailJoinCostumer($where)
    {
      $this->db->select('*');
      $this->db->from('project as p');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      $this->db->where('c.customer_am',$where);
      return $query = $this->db->get();
    }

    public function dataJoinFilter($where)
    {
      $this->db->select('*');
      $this->db->from('project as p');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      if($where != null){
        $this->db->where_not_in('p.project_id', $where);
      }
      return $query = $this->db->get();
    }

    public function dataJoinbyYear($tahun)
    {
      $this->db->select('*');
      $this->db->from('project as p');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      return $query = $this->db->get();
    }

    public function detailJoin($where)
    {
      $this->db->select('*');
      $this->db->from('project as p');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      $this->db->where('p.project_id',$where);
      return $query = $this->db->get();
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
		  $this->db->select('RIGHT(project.project_id,4) as kode', FALSE);
		  $this->db->order_by('project_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('project');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "PRJ-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
	}

 
}