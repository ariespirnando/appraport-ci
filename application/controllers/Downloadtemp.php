<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloadtemp extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }  
	  $this->load->model(array('Downloadtemp_model'));
      $this->load->library('pagination');
	}
	
	public function index(){ 
		$data['add']   = base_url().'index.php/Upload/add_upload';
		$data['modul'] = 'Transaksi';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_downloadtemp"=>$search_text));
	    }else{
	      if($this->session->userdata('search_downloadtemp') != NULL){
	        $search_text = $this->session->userdata('search_downloadtemp');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_downloadtemp"=>$search_text));
	    }

        $config['base_url'] = site_url('downloadtemp/index');   
        $config['per_page'] = 5;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		
		$config['display_pages'] = FALSE;
		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';  
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

        if($search_text==""){
        	$config['total_rows'] = $this->db->count_all('tbl_kodedokumen'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['downloadtemp'] = $this->Downloadtemp_model->get_downloadtemp_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Downloadtemp_model->get_count_downloadtemp_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['downloadtemp'] = $this->Downloadtemp_model->get_downloadtemp_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template','downloadtemp/downloadtemp_viewnew', $data);
	} 
 
 
}
