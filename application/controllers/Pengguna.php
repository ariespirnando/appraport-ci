<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }   
      $this->load->library('pagination');
	}
	 
	function ganti_pwpengguna(){
		$data['action'] = base_url().'index.php/pengguna/ubah_password';
		$data['res']	= array();
		$data['modul'] = 'Pengaturan'; 
		$this->template->load('template_wp','pengguna/pengguna_ubahpw', $data);
	}

	 
	function ubah_password(){
		$rule = $this->session->userdata('rule');
		$id_pengguna = $this->session->userdata('id_pengguna');
		$passwordL = $this->input->post('passwordL');
		$passwordB = $this->input->post('passwordB');

		if($rule==1){
			$this->db->where('id_pengguna',$id_pengguna);
			$this->db->where('password',md5($passwordL));
			$cek = $this->db->get('pengguna')->num_rows();													 								
		}else{
			$this->db->where('guidsiswa',$id_pengguna);
			$this->db->where('password',md5($passwordL));
			$cek = $this->db->get('tbl_siswa')->num_rows();
		}

		if($cek>0){ 
			if($rule==1){
				$this->db->set('password',md5($passwordB));
				$this->db->where('id_pengguna',$id_pengguna);
				$this->db->update('pengguna');
			}else{
				$this->db->set('password',md5($passwordB));
				$this->db->where('guidsiswa',$id_pengguna);
				$this->db->update('tbl_siswa');
			}


			$this->session->set_flashdata('message', '<b>Password</b> berhasil diUpdate');
			$this->session->set_flashdata('info', '1');
			redirect(site_url('pengguna/ganti_pwpengguna'));
		}else{
			$this->session->set_flashdata('message', '<b>Password</b> gagal diUpdate');
			$this->session->set_flashdata('info', '2');
			redirect(site_url('pengguna/ganti_pwpengguna'));
		}
	} 
}
