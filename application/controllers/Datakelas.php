<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datakelas extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }  
	  $this->load->model(array('Datakelas_model'));
      $this->load->library('pagination');
	}
	
	public function index(){ 
		$data['add']   = base_url().'index.php/datakelas/add_datakelas';
		$data['modul'] = 'Master';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_datakelas"=>$search_text));
	    }else{
	      if($this->session->userdata('search_datakelas') != NULL){
	        $search_text = $this->session->userdata('search_datakelas');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_datakelas"=>$search_text));
	    }

        $config['base_url'] = site_url('datakelas/index');   
        $config['per_page'] = 5;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$config['display_pages'] = FALSE;
        if($search_text==""){
        	$config['total_rows'] = $this->db->count_all('tbl_kelas'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datakelas'] = $this->Datakelas_model->get_datakelas_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Datakelas_model->get_count_datakelas_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['datakelas'] = $this->Datakelas_model->get_datakelas_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template_wp','datakelas/datakelas_view', $data);
	} 

	function add_datakelas(){
		$data['action'] = base_url().'index.php/datakelas/save_datakelas';
		$data['res']	= array();
		$data['jurusan'] = $this->db->get('tb_jurusan')->result_array();

		$this->db->where('status','A');
		$data['kelas'] = $this->db->get('tbl_kelasconfig')->result_array();
		$data['modul'] = 'Master';
		$this->template->load('template_wp','datakelas/datakelas_add', $data);
	}

	function edit_datakelas(){ 
	 	$id = $this->uri->segment(3);
		$data['action'] = base_url().'index.php/datakelas/update_datakelas'; 
		$this->db->where('guidkelas',$id);
		$data['id']		=  $this->uri->segment(3);
		$data['res']	= $this->db->get('tbl_kelas')->row_array();
		$data['modul'] = 'Master';
		$data['jurusan'] = $this->db->get('tb_jurusan')->result_array();

		$this->db->where('status','A');
		$data['kelas'] = $this->db->get('tbl_kelasconfig')->result_array();
		$this->template->load('template_wp','datakelas/datakelas_edit', $data);
	}

	function hapus_datakelas(){
		$id =  $this->uri->segment(3); 
		$this->db->delete('tbl_kelas', array('guidkelas' => $id));
		$this->session->set_flashdata('message', 'Data berhasil di hapus');
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('datakelas')); 
	}

	function save_datakelas(){
		$nikwalikelas = $this->input->post('nikwalikelas');
		$namawalikelas = $this->input->post('namawalikelas');
		$kodejuruan = $this->input->post('kodejuruan'); 
		$namakelas = $this->input->post('namakelas');
		$kodekelas = $this->input->post('kodekelas');
		
		$config['upload_path'] = realpath('assets/images/ttdwali');
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);

		if($namakelas==''){
			$this->session->set_flashdata('message', 'Nama Kelas tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('datakelas/add_datakelas'));
		}else{
			$guidkelas = uniqid(); 
			if (!$this->upload->do_upload('uploadfile')) {
				$this->session->set_flashdata('message', 'Upload Gagal');
				$this->session->set_flashdata('info', '2');
				redirect(site_url('datakelas/add_datakelas'));
			}else{
				$cek = $this->Datakelas_model->cek_datakelas($namakelas);
				if($cek>0){
					$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> sudah tersedia');
					$this->session->set_flashdata('info', '2');
					redirect(site_url('datakelas/add_datakelas')); 
				}else{
					$data_upload = $this->upload->data();
					$dataSimpan = array(
						'nikwalikelas'=>$nikwalikelas,
						'namakelas'=>$namakelas, 
						'kodejuruan'=>$kodejuruan,
						'namawalikelas'=>$namawalikelas,  
						'guidkelas'=>$guidkelas,
						'kodekelas'=>$kodekelas, 
						'ttdwalikelas'=>$data_upload['file_name'],
					);
					$insert = $this->db->insert('tbl_kelas',$dataSimpan);
					if($insert){ 
						$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> berhasil Ditambahkan');
						$this->session->set_flashdata('info', '1');
						redirect(site_url('datakelas'));
					}else{
						$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> gagal Ditambahkan');
						$this->session->set_flashdata('info', '2');
						redirect(site_url('datakelas/add_datakelas'));
					} 
				} 
			}
			
		}
		
	}
	function update_datakelas(){
		$nikwalikelas = $this->input->post('nikwalikelas');
		$namawalikelas = $this->input->post('namawalikelas');
		$kodejuruan = $this->input->post('kodejuruan'); 
		$namakelas = $this->input->post('namakelas'); 
		$kodekelas = $this->input->post('kodekelas'); 
		$id = $this->input->post('guidkelas');

		$config['upload_path'] = realpath('assets/images/ttdwali');
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);

		if($namakelas==''){
			$this->session->set_flashdata('message', 'Nama Kelas tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('datakelas/edit_datakelas'));
		}else{
			  
			$cek = $this->Datakelas_model->cek_datakelasupdate($namakelas,$id);
			if (!$this->upload->do_upload('uploadfile')) {
				$this->session->set_flashdata('message', 'Upload Gagal');
				$this->session->set_flashdata('info', '2');
				redirect(site_url('datakelas/edit_datakelas/'.$this->input->post('guidkelas')));
			}else{
				if($cek>0){
					$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> gagal diUpdate');
					$this->session->set_flashdata('info', '2');
					redirect(site_url('datakelas/edit_datakelas/'.$this->input->post('guidkelas')));
				}else{
					$this->db->where('guidkelas',$id);
					$dt = $this->db->get('tbl_kelas')->row_array();
					unlink(realpath('assets/images/ttdwali/'.$dt['ttdwalikelas']));

					$data_upload = $this->upload->data();
					$dataSimpan = array(
						'nikwalikelas'=>$nikwalikelas,
						'namakelas'=>$namakelas, 
						'kodejuruan'=>$kodejuruan,
						'namawalikelas'=>$namawalikelas,
						'kodekelas'=>$kodekelas, 
						'ttdwalikelas'=>$data_upload['file_name'],   
					); 
					$this->db->where('guidkelas',$id);
					$update = $this->db->update('tbl_kelas',$dataSimpan);
					if($update){
						$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> berhasil diUpdate');
						$this->session->set_flashdata('info', '1');
						redirect(site_url('datakelas'));
					}else{
						$this->session->set_flashdata('message', 'Kelas <b>'.$namakelas.'</b> gagal diUpdate');
						$this->session->set_flashdata('info', '2');
						redirect(site_url('datakelas/edit_datakelas/'.$this->input->post('guidkelas')));
					}
				}
			}
			
		}
		
	}
}
