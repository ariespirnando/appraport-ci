<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Raportsiswa extends CI_Controller {
	public function __construct(){    
	  parent::__construct();  
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      } 
	  $this->load->model(array('Raportsiswa_model'));
      $this->load->library(array('pagination'));
	}
  
	public function index(){ 
		$data['add']   = base_url().'index.php/raportsiswa/add_raportsiswa';
		$data['modul'] = 'Raport';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_raportsiswa"=>$search_text));
	    }else{
	      if($this->session->userdata('search_raportsiswa') != NULL){
	        $search_text = $this->session->userdata('search_raportsiswa');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_raportsiswa"=>$search_text));
	    }

        $config['base_url'] = site_url('raportsiswa/index');   
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
		if($this->session->userdata('rule')==1){
			if($search_text==""){
				$config['total_rows'] = $this->db->count_all('tbl_raport'); 
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice); 
				$this->pagination->initialize($config);
				$data['rule'] = $this->session->userdata('rule');
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
				$data['pagination'] = $this->pagination->create_links();
				$data['search'] = $search_text;
				$data['raportsiswa'] = $this->Raportsiswa_model->get_raportsiswa_list($config["per_page"], $data['page'])->result_array(); 
			}else{
				$config['total_rows'] = $this->Raportsiswa_model->get_count_raportsiswa_list($search_text); 
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice); 
				$this->pagination->initialize($config);
				$data['rule'] = $this->session->userdata('rule');
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
				$data['pagination'] = $this->pagination->create_links();
				$data['search'] = $search_text;
				$data['raportsiswa'] = $this->Raportsiswa_model->get_raportsiswa_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
			} 
		}else{
			if($search_text==""){
				$this->db->where('niksiswa',$this->session->userdata('niksiswa')); 
				$config['total_rows'] = $this->db->get('tbl_raport')->num_rows(); 
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice); 
				$this->pagination->initialize($config);
				$data['rule'] = $this->session->userdata('rule');
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
				$data['pagination'] = $this->pagination->create_links();
				$data['search'] = $search_text;
				$data['raportsiswa'] = $this->Raportsiswa_model->get_raportsiswa_list_nik($config["per_page"], $data['page'],$this->session->userdata('niksiswa'))->result_array(); 
			}else{
				$config['total_rows'] = $this->Raportsiswa_model->get_count_raportsiswa_list_nik($search_text,$this->session->userdata('niksiswa')); 
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice); 
				$this->pagination->initialize($config);
				$data['rule'] = $this->session->userdata('rule');
				$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
				$data['pagination'] = $this->pagination->create_links();
				$data['search'] = $search_text;
				$data['raportsiswa'] = $this->Raportsiswa_model->get_raportsiswa_list_search_nik($config["per_page"], $data['page'],$search_text,$this->session->userdata('niksiswa'))->result_array(); 
			} 
		}																
		
		$this->template->load('template','raportsiswa/raportsiswa_viewnew', $data);
	} 
	function download1(){ 
		$id = $this->uri->segment(3);
		 
		$data['guidraport'] = $id; 
		$query = "SELECT tg.namakelas, tg.namawalikelas, tg.nikwalikelas, tg.ttdwalikelas, tg.kodejuruan, tg.kodekelas FROM tbl_raport tr 
			JOIN tbl_kelas tg ON tr.guidkelas = tg.guidkelas 
			WHERE tr.guidraport='".$id."' LIMIT 1"; 

		$row  = $this->db->query($query)->row_array(); 
		$data['namakelas'] = $row['namakelas'];
		$data['namawalikelas'] = $row['namawalikelas'];
		$data['nikwalikelas'] = $row['nikwalikelas'];  
		if($data['ttdwalikelas'] = $row['ttdwalikelas']==""){
			$data['ttdwalikelas'] = '1';
		}else{
			$filename = realpath('assets/images/ttdwali/'.$row['ttdwalikelas'] );
			if(file_exists($filename)){ 
				$data['ttdwalikelas'] = $row['ttdwalikelas'];
			}else{
				$data['ttdwalikelas'] = '1';
			}
		}   
		
		$query = "SELECT tj.kodekelompok, tj.`iurutan`, tj.kodepelajaran, tp.namapelajaran, tp.kkm FROM tb_jurusanxpelajaran tj JOIN tbl_pengaturanpelajaran tp ON tp.kodepelajaran = tj.kodepelajaran
			WHERE tj.kodekelas = '".$row['kodekelas']."' AND tj.kodejuruan='".$row['kodejuruan']."'  
			ORDER BY tj.kodekelompok,tj.`iurutan`";
		$loop = $this->db->query($query)->result_array();
		$kela = array();
		$kelb = array();
		$kelc = array();
		$keld = array();
		$kele = array();
		$nilaia = array();
		$nilaib = array();
		$nilaic = array();
		$nilaid = array();
		$nilaie = array();
   
		foreach($loop as $l){ 
			$gtnilai = "SELECT kodenilai, nilai, iurutan FROM tbl_raportdetail 
				WHERE guidraport = '".$id."' and kodepelajaran='".$l['kodepelajaran']."'
				ORDER by iurutan";
			$nilailoop = $this->db->query($gtnilai)->result_array();
			$nilaipel = array();
			$nilaipel[$l['kodepelajaran']] = $nilailoop; 
			if($l['kodekelompok']=='KELA'){
				array_push($kela, array(
					'kodekelompok'=>$l['kodekelompok'],
					'iurutan'=>$l['iurutan'],
					'kodepelajaran'=>$l['kodepelajaran'], 
					'namapelajaran'=>$l['namapelajaran'],
					'kkm'=>$l['kkm'],  
				));  
				array_push($nilaia, $nilaipel);  
			}else if($l['kodekelompok']=='KELB'){
				array_push($kelb, array(
					'kodekelompok'=>$l['kodekelompok'],
					'iurutan'=>$l['iurutan'],
					'kodepelajaran'=>$l['kodepelajaran'], 
					'namapelajaran'=>$l['namapelajaran'],
					'kkm'=>$l['kkm'],  
				)); 
				array_push($nilaib, $nilaipel);  
			}else if($l['kodekelompok']=='KELC'){
				array_push($kelc, array(
					'kodekelompok'=>$l['kodekelompok'],
					'iurutan'=>$l['iurutan'],
					'kodepelajaran'=>$l['kodepelajaran'], 
					'namapelajaran'=>$l['namapelajaran'],
					'kkm'=>$l['kkm'],  
				)); 
				array_push($nilaic, $nilaipel);  
			}else if($l['kodekelompok']=='KELD'){
				array_push($keld, array(
					'kodekelompok'=>$l['kodekelompok'],
					'iurutan'=>$l['iurutan'],
					'kodepelajaran'=>$l['kodepelajaran'], 
					'namapelajaran'=>$l['namapelajaran'],
					'kkm'=>$l['kkm'],  
				)); 
				array_push($nilaid, $nilaipel);  
			}else{
				array_push($kele, array(
					'kodekelompok'=>$l['kodekelompok'],
					'iurutan'=>$l['iurutan'],
					'kodepelajaran'=>$l['kodepelajaran'], 
					'namapelajaran'=>$l['namapelajaran'],
					'kkm'=>$l['kkm'],  
				)); 
				array_push($nilaie, $nilaipel);  
			} 
		} 
		$data['kela'] = $kela;
		$data['kelb'] = $kelb;
		$data['kelc'] = $kelc;
		$data['keld'] = $keld;
		$data['kele'] = $kele; 
		$data['nilaia'] = $nilaia;
		$data['nilaib'] = $nilaib;
		$data['nilaic'] = $nilaic;
		$data['nilaid'] = $nilaid;
		$data['nilaie'] = $nilaie; 

		$query = "SELECT ts.tahunajaran, ts.semester, ts.tipe, tr.statuskenaikan FROM tbl_raport tr 
			JOIN tbl_semester ts ON tr.guidsemester = ts.guidsemester 
			WHERE tr.guidraport='".$id."' LIMIT 1"; 
		$row  = $this->db->query($query)->row_array(); 
		$data['semester'] = $row['semester'];
		$data['tipe'] = $row['tipe'];
		$data['tahunajaran'] = $row['tahunajaran']; 
		$data['statuskenaikan'] = $row['statuskenaikan'];  

		$query = "SELECT ts.namasiswa, ts.niksiswa, tr.kegiatanextra, tr.nilaikegiatan, tr.statuskenaikan, tr.statusspp,
			tr.nilaikegiatanwajib, tr.tanggal_raport FROM tbl_raport tr 
			JOIN tbl_siswa ts ON tr.niksiswa = ts.niksiswa WHERE tr.guidraport='".$id."' LIMIT 1"; 
		$row  = $this->db->query($query)->row_array(); 
		$data['namasiswa'] = $row['namasiswa'];
		$data['niksiswa'] = $row['niksiswa'];
		$data['kegiatanextra'] = $row['kegiatanextra']; 
		$data['nilaikegiatan'] = $row['nilaikegiatan']; 
		$data['nilaikegiatanwajib'] = $row['nilaikegiatanwajib'];    
		$data['tanggalsekarang'] = $row['tanggal_raport'];  
 

		$query = "SELECT namakepsek, nikkepsek, ttdkepsek FROM tbl_kepsek LIMIT 1"; 
		$etcddl  = $this->db->query($query)->row_array(); 
		$data['namakepsek'] = $etcddl['namakepsek'];
		$data['nikkepsek'] = $etcddl['nikkepsek']; 
		
		if($data['ttdkepsek'] = $etcddl['ttdkepsek']==""){
			$data['ttdkepsek'] = '1';
		}else{
			$filename = realpath('assets/images/ttdwali/'.$etcddl['ttdkepsek'] );
			if(file_exists($filename)){ 
				$data['ttdkepsek'] = $etcddl['ttdkepsek'];
			}else{
				$data['ttdkepsek'] = '1';
			}
		}  

		$filename = preg_replace('/[^A-Za-z0-9\  ]/','_',$row['namasiswa']).'_'.preg_replace('/[^A-Za-z0-9\  ]/','_',$data['namakelas']);  
		$html = $this->load->view('cetak',$data,true); 
		$pdfFilePath = $filename.".pdf";

		$mpdf = new \Mpdf\Mpdf();
		if($this->session->userdata('rule')==1){  
			$mpdf->AddPage("P","","","","","","","","","","","","","","","","","","","","Legal");
			$mpdf->WriteHTML($html);
			$mpdf->Output($pdfFilePath, "D"); 	
		}else{
			if($row['statuskenaikan'] == 'Tidak Naik Kelas' || $row['statusspp'] == 'Belum Lunas'){
				$this->session->set_flashdata('message', 'Anda tidak bisa melakukan download raport, silahkan hubungi pihak sekolah' );
				$this->session->set_flashdata('info', '2');
  				redirect(site_url('raportsiswa')); 
			}else{ 
				$mpdf->AddPage("P","","","","","","","","","","","","","","","","","","","","Legal");
				$mpdf->WriteHTML($html);
				$mpdf->Output($pdfFilePath, "D");  
				// $pdf = $this->m_pdf->load();
				// $pdf->WriteHTML($html);
				// $pdf->Output($pdfFilePath, "D");
			}
		}
		
	}
	 
 

	function updatespp(){
		$id =  $this->uri->segment(3);
		
		$this->db->where('guidraport',$id);
		$this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
		$getdt = $this->db->get('tbl_raport')->row_array(); 

		$this->db->where('guidraport',$id);
		$this->db->update('tbl_raport',array('statusspp'=>'Lunas'));

		$this->session->set_flashdata('message', 'Data pembayaran SPP '.$getdt['namasiswa'].' Berhasil diupdate' );
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('raportsiswa')); 
	}

	function updatekenaikan(){
		$id =  $this->uri->segment(3);
		
		$this->db->where('guidraport',$id);
		$this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
		$getdt = $this->db->get('tbl_raport')->row_array(); 

		$this->db->where('guidraport',$id);
		$this->db->update('tbl_raport',array('statuskenaikan'=>'Naik Kelas'));

		$this->session->set_flashdata('message', 'Data kenaikan Kelas '.$getdt['namasiswa'].' Berhasil diupdate' );
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('raportsiswa')); 
	}

	function updatespp2(){
		$id =  $this->uri->segment(3);
		
		$this->db->where('guidraport',$id);
		$this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
		$getdt = $this->db->get('tbl_raport')->row_array(); 

		$this->db->where('guidraport',$id);
		$this->db->update('tbl_raport',array('statusspp'=>'Belum Lunas'));

		$this->session->set_flashdata('message', 'Data pembayaran SPP '.$getdt['namasiswa'].' Berhasil diupdate' );
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('raportsiswa')); 
	}

	function updatekenaikan2(){
		$id =  $this->uri->segment(3);
		
		$this->db->where('guidraport',$id);
		$this->db->join('tbl_siswa','tbl_siswa.niksiswa = tbl_raport.niksiswa','inner');
		$getdt = $this->db->get('tbl_raport')->row_array(); 

		$this->db->where('guidraport',$id);
		$this->db->update('tbl_raport',array('statuskenaikan'=>'Tidak Naik Kelas'));

		$this->session->set_flashdata('message', 'Data kenaikan Kelas '.$getdt['namasiswa'].' Berhasil diupdate' );
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('raportsiswa')); 
	}
 
}
