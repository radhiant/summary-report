<?php
class epp_model extends ci_model{


    function data()
    {
        $this->db->order_by('epp_id','DESC');
        return $query = $this->db->get('epp');
    }

    public function dataJoin()
    {
      $this->db->select('*');
      $this->db->from('epp as e');
      $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      $this->db->group_by(array("p.project_nama", "c.customer_nama", 'e.epp_tahun'));
      $this->db->order_by('epp_id','DESC');
      return $query = $this->db->get();
    }

    public function dataJoinbyYear($tahun)
    {
      $this->db->select('*');
      $this->db->from('epp as e');
      $this->db->join('project as p', 'p.project_id = e.project_id', 'left');
      $this->db->join('customer as c', 'c.customer_id = p.customer_id', 'left');
      $this->db->where('e.epp_tahun',$tahun);
      $this->db->group_by(array("p.project_nama", "c.customer_nama", 'e.epp_tahun'));
      $this->db->order_by('epp_id','DESC');
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

    public function save_batch($data){
        return $this->db->insert_batch('epp', $data);
    }    




}
