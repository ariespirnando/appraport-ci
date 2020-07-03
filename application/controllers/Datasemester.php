<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasemester extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }  
	  $this->load->model(array('Datasemester_model'));
      $this->load->library('pagination');
	}
	
	public function index(){ 
		$data['add']   = base_url().'index.php/datasemester/add_datasemester';
		$data['modul'] = 'Master';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_datasemester"=>$search_text));
	    }else{
	      if($this->session->userdata('search_datasemester') != NULL){
	        $search_text = $this->session->userdata('search_datasemester');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_datasemester"=>$search_text));
	    }

        $config['base_url'] = site_url('datasemester/index');   
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
        	$config['total_rows'] = $this->db->count_all('tbl_semester'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datasemester'] = $this->Datasemester_model->get_datasemester_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Datasemester_model->get_count_datasemester_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datasemester'] = $this->Datasemester_model->get_datasemester_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template','datasemester/datasemester_viewnew', $data);
	} 

	function add_datasemester(){
		$data['action'] = base_url().'index.php/datasemester/save_datasemester';
		$data['res']	= array(); 
		$data['modul'] = 'Master';
		$this->template->load('template_wp','datasemester/datasemester_add', $data);
	}

	function edit_datasemester(){ 
	 	$id = $this->uri->segment(3);
		$data['action'] = base_url().'index.php/datasemester/update_datasemester'; 
		$this->db->where('guidsemester',$id);
		$data['id']		=  $this->uri->segment(3);
		$data['res']	= $this->db->get('tbl_semester')->row_array();
		$data['modul'] = 'Master'; 
		$this->template->load('template_wp','datasemester/datasemester_edit', $data);
	}

	function hapus_datasemester(){
		$id =  $this->uri->segment(3); 
		$this->db->delete('tbl_semester', array('guidsemester' => $id));
		$this->session->set_flashdata('message', 'Data berhasil di hapus');
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('datasemester')); 
	}

	function save_datasemester(){
		$tahunajaran = $this->input->post('tahunajaran');
		$semester = $this->input->post('semester'); 
		$tipe= $this->input->post('tipe');

		if($tahunajaran==''){
			$this->session->set_flashdata('message', 'Nama Kelas tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('datasemester/add_datasemester'));
		}else{
			$guidsemester = uniqid();
			$dataSimpan = array(
				'tahunajaran'=>$tahunajaran,
				'semester'=>$semester,   
				'guidsemester'=>$guidsemester,
				'tipe'=>$tipe,     
			); 

			$cek = $this->Datasemester_model->cek_datasemester($tahunajaran,$semester);
			if($cek>0){
				$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> sudah tersedia');
				$this->session->set_flashdata('info', '2');
	  			redirect(site_url('datasemester/add_datasemester')); 
			}else{
				$insert = $this->db->insert('tbl_semester',$dataSimpan);
				if($insert){
					$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> berhasil Ditambahkan');
					$this->session->set_flashdata('info', '1');
	  				redirect(site_url('datasemester'));
				}else{
					$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> gagal Ditambahkan');
					$this->session->set_flashdata('info', '2');
	  				redirect(site_url('datasemester/add_datasemester'));
				} 
			} 
		}
		
	}
	function update_datasemester(){
		$tahunajaran = $this->input->post('tahunajaran');
		$semester = $this->input->post('semester'); 
		$tipe = $this->input->post('tipe'); 
		$id = $this->input->post('guidsemester');

		if($tahunajaran==''){
			$this->session->set_flashdata('message', 'Nama Kelas tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('datasemester/edit_datasemester'));
		}else{
			$dataSimpan = array(
				'tahunajaran'=>$tahunajaran,
				'semester'=>$semester,  
				'tipe'=>$tipe,     
			); 
			$cek = $this->Datasemester_model->cek_datasemesterupdate($tahunajaran,$semester,$id);
			if($cek>0){
				$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> gagal diUpdate');
				$this->session->set_flashdata('info', '2');
  				redirect(site_url('datasemester/edit_datasemester/'.$this->input->post('guidsemester')));
			}else{
				$this->db->where('guidsemester',$id);
				$update = $this->db->update('tbl_semester',$dataSimpan);
				if($update){
					$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> berhasil diUpdate');
					$this->session->set_flashdata('info', '1');
	  				redirect(site_url('datasemester'));
				}else{
					$this->session->set_flashdata('message', 'Tahun Ajaran <b>'.$tahunajaran.'</b> gagal diUpdate');
					$this->session->set_flashdata('info', '2');
	  				redirect(site_url('datasemester/edit_datasemester/'.$this->input->post('guidsemester')));
				}
			}
			
		}
		
	}
}
