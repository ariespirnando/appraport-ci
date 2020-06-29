<?php

class Datasemester_model extends CI_Model {  
    function get_datasemester_list($limit, $start){ 
        $query = $this->db->get('tbl_semester', $limit, $start);
        return $query;
    } 

    function get_count_datasemester_list($q){ 
        $this->db->group_start();
        $this->db->or_like('tahunajaran', $q); 
        $this->db->or_like('semester', $q);     
        $this->db->group_end();
        $query = $this->db->get('tbl_semester');
        return $query->num_rows();
    } 
    
    function get_datasemester_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('tahunajaran', $q); 
        $this->db->or_like('semester', $q);  
        $this->db->group_end();
        $query = $this->db->get('tbl_semester', $limit, $start);
        return $query;
    } 
    function cek_datasemester($kode,$semester){
        $this->db->where('tahunajaran', $kode);  
        $this->db->where('semester', $semester);
        $query = $this->db->get('tbl_semester');
        return $query->num_rows(); 
    }
    function cek_datasemesterupdate($kode,$semester,$id){
        $this->db->where('tahunajaran', $kode);  
        $this->db->where('semester', $semester);
        $this->db->where_not_in('guidsemester', $id);
        $query = $this->db->get('tbl_semester');
        return $query->num_rows(); 
    } 
}