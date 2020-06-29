<?php

class Datasiswa_model extends CI_Model {  
    function get_datasiswa_list($limit, $start){ 
        $this->db->order_by("namasiswa", "asc");
        $query = $this->db->get('tbl_siswa', $limit, $start);
        return $query;
    } 

    function get_count_datasiswa_list($q){ 
        $this->db->group_start();
        $this->db->or_like('kelamin', $q); 
        $this->db->or_like('namasiswa', $q);  
        $this->db->or_like('niksiswa', $q); 
        $this->db->group_end();
        $this->db->order_by("namasiswa", "asc");
        $query = $this->db->get('tbl_siswa');
        return $query->num_rows();
    } 
    
    function get_datasiswa_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('kelamin', $q); 
        $this->db->or_like('namasiswa', $q);  
        $this->db->or_like('niksiswa', $q); 
        $this->db->group_end();
        $this->db->order_by("namasiswa", "asc");
        $query = $this->db->get('tbl_siswa', $limit, $start);
        return $query;
    } 

    function cek_raport($niksiswa){
        $this->db->where('niksiswa',$niksiswa);
        return $this->db->get('tbl_raport')->num_rows();
    }
     
}