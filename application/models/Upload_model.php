<?php

class Upload_model extends CI_Model {  
    function get_upload_list($limit, $start){ 
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_upload.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_upload.guidkelas','inner'); 
        $query = $this->db->get('tbl_upload', $limit, $start);  
        
        return $query;
    } 

    function get_count_upload_list($q){ 
        $this->db->group_start();
        $this->db->or_like('keterangan', $q); 
        $this->db->or_like('tbl_upload.tanggal_raport', $q);   
        $this->db->or_like('tbl_semester.semester', $q);  
        $this->db->or_like('tbl_kelas.namakelas', $q); 
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_semester.tahunajaran', $q); 
        $this->db->group_end(); 
        
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_upload.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_upload.guidkelas','inner'); 

        $query = $this->db->get('tbl_upload');
        return $query->num_rows();
    } 
    
    function get_upload_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('keterangan', $q);   
        $this->db->or_like('tbl_upload.tanggal_raport', $q);   
        $this->db->or_like('tbl_semester.semester', $q);  
        $this->db->or_like('tbl_kelas.namakelas', $q); 
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_semester.tahunajaran', $q);   
        $this->db->group_end(); 
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_upload.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_upload.guidkelas','inner'); 
        
        $query = $this->db->get('tbl_upload', $limit, $start);
        return $query;
    } 
    function cek_upload($semester,$kelas){ 
        $this->db->where('guidsemester', $semester);  
        $this->db->where('guidkelas', $kelas);  
        $query = $this->db->get('tbl_upload');
        return $query->num_rows(); 
    }

    function resultconfig($kodejuruan,$kodekelas){ 
        $this->db->where('kodekelas', $kodekelas);
        $this->db->where('kodejuruan', $kodejuruan);   
        $this->db->order_by("iurutan", "asc"); 
        $query = $this->db->get('tb_jurusanxpelajaran');
        return $query; 
    }
    function resultdok($kodejuruan,$kodekelas){ 
        $this->db->where('kodekelas', $kodekelas);
        $this->db->where('kodejuruan', $kodejuruan);   
        $query = $this->db->get('tbl_kodedokumen');
        return $query; 
    }

    function cekjurusan($guidkelas){
        $this->db->where('guidkelas', $guidkelas);    
        $query = $this->db->get('tbl_kelas');
        return $query;
    }
     
    
}