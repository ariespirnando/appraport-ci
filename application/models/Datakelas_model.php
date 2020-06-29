<?php

class Datakelas_model extends CI_Model {  
    function get_datakelas_list($limit, $start){ 
        $this->db->order_by("kodejuruan", "asc");
        $this->db->order_by("kodekelas", "asc");
        $query = $this->db->get('tbl_kelas', $limit, $start);
        return $query;
    } 

    function get_count_datakelas_list($q){ 
        $this->db->group_start();
        $this->db->or_like('kodejuruan', $q); 
        $this->db->or_like('namakelas', $q);  
        $this->db->or_like('namawalikelas', $q); 
        $this->db->or_like('nikwalikelas', $q);  
        $this->db->or_like('ttdwalikelas', $q);   
        $this->db->group_end();
        $this->db->order_by("kodejuruan", "asc");
        $this->db->order_by("kodekelas", "asc");
        $query = $this->db->get('tbl_kelas');
        return $query->num_rows();
    } 
    
    function get_datakelas_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('kodejuruan', $q); 
        $this->db->or_like('namakelas', $q);  
        $this->db->or_like('namawalikelas', $q); 
        $this->db->or_like('nikwalikelas', $q);  
        $this->db->or_like('ttdwalikelas', $q);   
        $this->db->group_end();
        $this->db->order_by("kodejuruan", "asc");
        $this->db->order_by("kodekelas", "asc");
        $query = $this->db->get('tbl_kelas', $limit, $start);
        return $query;
    } 
    function cek_datakelas($kode){
        $this->db->group_start();
        $this->db->or_where('namakelas', $kode);  
        $this->db->group_end();
        $query = $this->db->get('tbl_kelas');
        return $query->num_rows(); 
    }
    function cek_datakelasupdate($kode,$id){
        $this->db->group_start();
        $this->db->or_where('namakelas', $kode);  
        $this->db->group_end();
        $this->db->where_not_in('guidkelas', $id);
        $query = $this->db->get('tbl_kelas');
        return $query->num_rows(); 
    } 
}