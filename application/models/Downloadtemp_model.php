<?php

class Downloadtemp_model extends CI_Model {  
    function get_downloadtemp_list($limit, $start){ 
        $query = $this->db->get('tbl_kodedokumen', $limit, $start);
        return $query;
    } 

    function get_count_downloadtemp_list($q){ 
        $this->db->group_start();
        $this->db->or_like('kodejuruan', $q); 
        $this->db->or_like('kodekelas', $q); 
        $this->db->or_like('namadok', $q);     
        $this->db->group_end();
        $query = $this->db->get('tbl_kodedokumen');
        return $query->num_rows();
    } 
    
    function get_downloadtemp_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('kodejuruan', $q); 
        $this->db->or_like('kodekelas', $q);
        $this->db->or_like('namadok', $q);    
        $this->db->group_end();
        $query = $this->db->get('tbl_kodedokumen', $limit, $start);
        return $query;
    }   
     
}