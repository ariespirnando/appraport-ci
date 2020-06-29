<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasiswa extends CI_Controller {
	public function __construct(){    
	  parent::__construct();  
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      } 
	  $this->load->model(array('Datasiswa_model'));
      $this->load->library('pagination');
	}
  
	public function index(){ 
		$data['add']   = base_url().'index.php/datasiswa/add_datasiswa';
		$data['modul'] = 'Master';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_datasiswa"=>$search_text));
	    }else{
	      if($this->session->userdata('search_datasiswa') != NULL){
	        $search_text = $this->session->userdata('search_datasiswa');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_datasiswa"=>$search_text));
	    }

        $config['base_url'] = site_url('datasiswa/index');   
        $config['per_page'] = 10;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$config['display_pages'] = FALSE;
        if($search_text==""){
        	$config['total_rows'] = $this->db->count_all('tbl_siswa'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datasiswa'] = $this->Datasiswa_model->get_datasiswa_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Datasiswa_model->get_count_datasiswa_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datasiswa'] = $this->Datasiswa_model->get_datasiswa_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template_wp','datasiswa/datasiswa_view', $data);
	} 

	function rstdatasiswa(){
		$id =  $this->uri->segment(3);
		
		$this->db->where('guidsiswa',$id);
		$getdt = $this->db->get('tbl_siswa')->row_array(); 

		$this->db->where('guidsiswa',$id);
		$this->db->update('tbl_siswa',array('password'=>md5($getdt['niksiswa'])));

		$this->session->set_flashdata('message', 'Password '.$getdt['namasiswa'].' Berhasil direset' );
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('datasiswa')); 
	}

	function deletedatasiswa(){
		$id =  $this->uri->segment(3); 
		$this->db->where('guidsiswa',$id);
		$getdt = $this->db->get('tbl_siswa')->row_array(); 

		if($this->Datasiswa_model->cek_raport($getdt['niksiswa'])>0){
			$this->session->set_flashdata('message', 'Data Siswa '.$getdt['namasiswa'].' gagal dihapus' );
			$this->session->set_flashdata('info', '2');
			redirect(site_url('datasiswa')); 
		}else{
			$this->db->where('guidsiswa',$id);
			$this->db->delete('tbl_siswa');
			$this->session->set_flashdata('message', 'Data Siswa '.$getdt['namasiswa'].' berhasil dihapus' );
			$this->session->set_flashdata('info', '2');
			redirect(site_url('datasiswa')); 
		}
		
	}
 
}
