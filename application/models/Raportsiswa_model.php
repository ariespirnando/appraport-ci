<?php

class Raportsiswa_model extends CI_Model {  
    function get_raportsiswa_list($limit, $start){ 
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');  
        $query = $this->db->get('tbl_raport', $limit, $start);
        return $query;
    } 
 
    function get_count_raportsiswa_list($q){ 
        $this->db->group_start();
        $this->db->or_like('tbl_siswa.niksiswa', $q);  
        $this->db->or_like('tbl_siswa.kelamin', $q);  
        $this->db->or_like('tbl_siswa.namasiswa', $q);  
        $this->db->or_like('tbl_semester.tahunajaran', $q); 
        $this->db->or_like('tbl_semester.semester', $q); 
        $this->db->or_like('tbl_kelas.namakelas', $q);
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_raport.statusspp', $q); 
        $this->db->or_like('tbl_raport.statuskenaikan', $q);  
        $this->db->group_end();
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
        $query = $this->db->get('tbl_raport');
        return $query->num_rows();
    } 
    
    function get_raportsiswa_list_search($limit, $start,$q){
    	$this->db->group_start();
        $this->db->or_like('tbl_siswa.niksiswa', $q);  
        $this->db->or_like('tbl_siswa.kelamin', $q);  
        $this->db->or_like('tbl_siswa.namasiswa', $q);  
        $this->db->or_like('tbl_semester.tahunajaran', $q); 
        $this->db->or_like('tbl_semester.semester', $q); 
        $this->db->or_like('tbl_kelas.namakelas', $q);  
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_raport.statusspp', $q); 
        $this->db->or_like('tbl_raport.statuskenaikan', $q);  
        $this->db->group_end();
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
        $query = $this->db->get('tbl_raport', $limit, $start);
        return $query;
    } 


    function get_raportsiswa_list_nik($limit, $start,$niksiswa){ 
        $this->db->where('tbl_siswa.niksiswa',$niksiswa);
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');  
        $query = $this->db->get('tbl_raport', $limit, $start);
        return $query;
    } 
 
    function get_count_raportsiswa_list_nik($q,$niksiswa){ 
        $this->db->where('tbl_siswa.niksiswa',$niksiswa);
        $this->db->group_start();
        $this->db->or_like('tbl_siswa.niksiswa', $q);  
        $this->db->or_like('tbl_siswa.kelamin', $q);  
        $this->db->or_like('tbl_siswa.namasiswa', $q);  
        $this->db->or_like('tbl_semester.tahunajaran', $q); 
        $this->db->or_like('tbl_semester.semester', $q); 
        $this->db->or_like('tbl_kelas.namakelas', $q);
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_raport.statusspp', $q); 
        $this->db->or_like('tbl_raport.statuskenaikan', $q);  
        $this->db->group_end();
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
        $query = $this->db->get('tbl_raport');
        return $query->num_rows();
    } 
    
    function get_raportsiswa_list_search_nik($limit, $start,$q,$niksiswa){
        $this->db->where('tbl_siswa.niksiswa',$niksiswa);
    	$this->db->group_start();
        $this->db->or_like('tbl_siswa.niksiswa', $q);  
        $this->db->or_like('tbl_siswa.kelamin', $q);  
        $this->db->or_like('tbl_siswa.namasiswa', $q);  
        $this->db->or_like('tbl_semester.tahunajaran', $q); 
        $this->db->or_like('tbl_semester.semester', $q); 
        $this->db->or_like('tbl_kelas.namakelas', $q);  
        $this->db->or_like('tbl_kelas.kodejuruan', $q); 
        $this->db->or_like('tbl_raport.statusspp', $q); 
        $this->db->or_like('tbl_raport.statuskenaikan', $q);  
        $this->db->group_end();
        $this->db->order_by("tbl_semester.tahunajaran", "desc");
        $this->db->join('tbl_semester','tbl_semester.guidsemester = tbl_raport.guidsemester','inner');
        $this->db->join('tbl_kelas','tbl_kelas.guidkelas = tbl_raport.guidkelas','inner'); 
        $this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
        $query = $this->db->get('tbl_raport', $limit, $start);
        return $query;
    } 
     
}