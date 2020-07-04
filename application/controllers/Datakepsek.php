<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datakepsek extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }  
	  $this->load->model(array('Datakepsek_model'));
      $this->load->library('pagination');
	}
	
	public function index(){ 
		$data['add']   = base_url().'index.php/datakepsek/add_datakepsek';
		$data['modul'] = 'Master';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_datakepsek"=>$search_text));
	    }else{
	      if($this->session->userdata('search_datakepsek') != NULL){
	        $search_text = $this->session->userdata('search_datakepsek');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_datakepsek"=>$search_text));
	    }

        $config['base_url'] = site_url('datakepsek/index');   
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
        	$config['total_rows'] = $this->db->count_all('tbl_kepsek'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datakepsek'] = $this->Datakepsek_model->get_datakepsek_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Datakepsek_model->get_count_datakepsek_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datakepsek'] = $this->Datakepsek_model->get_datakepsek_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template','datakepsek/datakepsek_viewnew', $data);
	} 
 

	function edit_datakepsek(){ 
	 	$id = $this->uri->segment(3);
		$data['action'] = base_url().'index.php/datakepsek/update_datakepsek'; 
		$this->db->where('guidkepsek',$id);
		$data['id']		=  $this->uri->segment(3);
		$data['res']	= $this->db->get('tbl_kepsek')->row_array();
		$data['modul'] = 'Master'; 
		$this->template->load('template','datakepsek/datakepsek_edit', $data);
	}
  
	function update_datakepsek(){
		$nikkepsek = $this->input->post('nikkepsek');
		$namakepsek = $this->input->post('namakepsek'); 
		$id = $this->input->post('guidkepsek');

		$config['upload_path'] = realpath('assets/images/ttdwali');
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);

		if($namakepsek==''){
			$this->session->set_flashdata('message', 'Nama Kepala sekolah tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('datakepsek/edit_datakepsek'));
		}else{ 
			$cek = $this->Datakepsek_model->cek_datakepsekupdate($namakepsek,$id);
			if (!$this->upload->do_upload('uploadfile')) {
				$this->session->set_flashdata('message', 'Upload Gagal');
				$this->session->set_flashdata('info', '2');
				redirect(site_url('datakepsek/edit_datakepsek/'.$this->input->post('guidkepsek')));
			}else{
				if($cek>0){
					$this->session->set_flashdata('message', 'Kepala sekolah <b>'.$namakepsek.'</b> gagal diUpdate');
					$this->session->set_flashdata('info', '2');
					redirect(site_url('datakepsek/edit_datakepsek/'.$this->input->post('guidkepsek')));
				}else{
					$this->db->where('guidkepsek',$id);
					$dt = $this->db->get('tbl_kepsek')->row_array();
					unlink(realpath('assets/images/ttdwali/'.$dt['ttdkepsek']));

					$data_upload = $this->upload->data();
					$dataSimpan = array(
						'nikkepsek'=>$nikkepsek, 
						'namakepsek'=>$namakepsek,
						'ttdkepsek'=>$data_upload['file_name'],   
					); 
					$this->db->where('guidkepsek',$id);
					$update = $this->db->update('tbl_kepsek',$dataSimpan);
					if($update){
						$this->session->set_flashdata('message', 'Kepala sekolah <b>'.$namakepsek.'</b> berhasil diUpdate');
						$this->session->set_flashdata('info', '1');
						redirect(site_url('datakepsek'));
					}else{
						$this->session->set_flashdata('message', 'Kepala sekolah <b>'.$namakepsek.'</b> gagal diUpdate');
						$this->session->set_flashdata('info', '2');
						redirect(site_url('datakepsek/edit_datakepsek/'.$this->input->post('guidkepsek')));
					}
				}
			}
			
		}
		
	}
}
