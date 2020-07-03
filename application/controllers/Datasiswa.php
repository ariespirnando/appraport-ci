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
        $this->template->load('template','datasiswa/datasiswa_viewnew', $data);
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
