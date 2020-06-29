<?php

class Datakepsek_model extends CI_Model {  
    function get_datakepsek_list($limit, $start){ 
        $query = $this->db->get('tbl_kepsek', $limit, $start);
        return $query;
    } 

    function get_count_datakepsek_list($q){ 
        $this->db->group_start();
        $this->db->or_like('namakepsek', $q); 
        $this->db->or_like('nikkepsek', $q);      
        $this->db->group_end();
        $query = $this->db->get('tbl_kepsek');
        return $query->num_rows();
    } 
    
    function get_datakepsek_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('namakepsek', $q); 
        $this->db->or_like('nikkepsek', $q);    
        $this->db->group_end();
        $query = $this->db->get('tbl_kepsek', $limit, $start);
        return $query;
    }  
    function cek_datakepsekupdate($kode,$id){
        $this->db->group_start();
        $this->db->or_where('namakepsek', $kode);  
        $this->db->group_end();
        $this->db->where_not_in('guidkepsek', $id);
        $query = $this->db->get('tbl_kepsek');
        return $query->num_rows(); 
    } 
}