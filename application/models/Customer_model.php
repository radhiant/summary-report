<?php
class customer_model extends ci_model{


    function data()
    {
        $this->db->order_by('customer_id','DESC');
        return $query = $this->db->get('customer');
    }

    function dataJoin()
    {
        $this->db->select('*');
        $this->db->from('customer as c');
        $this->db->join('user as u', 'u.user_id = c.customer_am', 'left');
        $this->db->order_by('c.customer_id','ASC');

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
		  $this->db->select('RIGHT(customer.customer_id,4) as kode', FALSE);
		  $this->db->order_by('customer_id','DESC');
		  $this->db->limit(1);
		  $query = $this->db->get('customer');      //cek dulu apakah ada sudah ada kode di tabel.
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
		  $kodejadi = "CS-".$kodemax;    // hasilnya USR-0001 dst.
		  return $kodejadi;
	}





}