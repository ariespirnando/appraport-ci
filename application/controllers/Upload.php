<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct(){    
	  parent::__construct(); 
	  if(!$this->session->userdata('id_pengguna')){   
        redirect('Login');
      }  
	  $this->load->model(array('Upload_model'));
      $this->load->library('pagination');
	}
	
	public function index(){ 
		$data['add']   = base_url().'index.php/Upload/add_upload';
		$data['modul'] = 'Transaksi';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
	      $search_text = $this->input->post('search');
	      $this->session->set_userdata(array("search_upload"=>$search_text));
	    }else{
	      if($this->session->userdata('search_upload') != NULL){
	        $search_text = $this->session->userdata('search_upload');
	      }
	    }

	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("search_upload"=>$search_text));
	    }

        $config['base_url'] = site_url('upload/index');   
        $config['per_page'] = 5;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        if($search_text==""){
        	$config['total_rows'] = $this->db->count_all('tbl_upload'); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['upload'] = $this->Upload_model->get_upload_list($config["per_page"], $data['page'])->result_array(); 
        }else{
        	$config['total_rows'] = $this->Upload_model->get_count_upload_list($search_text); 
        	$choice = $config["total_rows"] / $config["per_page"];
	        $config["num_links"] = floor($choice); 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
	        $data['pagination'] = $this->pagination->create_links();
	        $data['search'] = $search_text;
        	$data['upload'] = $this->Upload_model->get_upload_list_search($config["per_page"], $data['page'],$search_text)->result_array(); 
        }  
        $this->template->load('template_wp','upload/upload_view', $data);
	} 

	function add_upload(){
		$data['action'] = base_url().'index.php/upload/save_upload';
		$data['res']	= array();

		$this->db->order_by("kodejuruan", "asc");
        $this->db->order_by("kodekelas", "asc");
		$data['kelas'] = $this->db->get('tbl_kelas')->result_array();
		$data['semester'] = $this->db->get('tbl_semester')->result_array();
		$data['modul'] = 'Transaksi';
		$this->template->load('template_wp','upload/upload_add', $data);
	}
  
	function hapus_upload(){
		$id =  $this->uri->segment(3);
		$this->db->delete('tbl_upload', array('guidupload' => $id));
		$this->db->delete('tbl_raport', array('guidupload' => $id));
		$this->db->delete('tbl_raportdetail', array('guidupload' => $id)); 
		$this->session->set_flashdata('message', 'Data berhasil di hapus');
		$this->session->set_flashdata('info', '2');
  		redirect(site_url('upload')); 
	}

	function edittgl_upload(){
		$id = $this->uri->segment(3);
		$data['action'] = base_url().'index.php/upload/update_upload';  
		$data['id']		=  $this->uri->segment(3); 
		$data['modul'] 	= 'Transaksi'; 
		$this->template->load('template_wp','upload/upload_edit', $data);
	}

	function update_upload(){ 
		$id = $this->input->post('guidupload');
		$tanggal_raport = $this->tanggal_indonesia($this->input->post('tanggal_raport'));

		if($this->input->post('tanggal_raport')==''){
			$this->session->set_flashdata('message', 'Tanggal Raport tidak terisi');
			$this->session->set_flashdata('info', '2');
			redirect(site_url('upload/edittgl_upload/'.$id));
		}else{
			$this->db->where('guidupload',$id);
			$this->db->update('tbl_upload', array('tanggal_raport' => $tanggal_raport));

			$this->db->where('guidupload',$id);
			$this->db->update('tbl_raport', array('tanggal_raport' => $tanggal_raport));
	
			$this->session->set_flashdata('message', 'Tanggal Berhasil di Update');
			$this->session->set_flashdata('info', '2');
			redirect(site_url('upload')); 
		}
		
		
	}

	function save_upload(){
		$keterangan = $this->input->post('keterangan'); 
		$guidsemester = $this->input->post('guidsemester'); 
		$guidkelas = $this->input->post('guidkelas'); 
		$tanggal_raport = $this->tanggal_indonesia($this->input->post('tanggal_raport'));

		$config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);
		if($keterangan=='' || $this->input->post('tanggal_raport') ==''){
			$this->session->set_flashdata('message', 'Keterangan atau Tanggal Raport tidak terisi');
			$this->session->set_flashdata('info', '2');
  			redirect(site_url('upload/add_upload'));
		}else{
			if (!$this->upload->do_upload('uploadfile')) { 
				$this->session->set_flashdata('message', 'Import Gagal');
				$this->session->set_flashdata('info', '2');
				redirect(site_url('upload/add_upload'));
			}else{
				$guidupload = uniqid();

				$dataSimpan = array(
					'keterangan'=>$keterangan,
					'guidsemester'=>$guidsemester,  
					'guidkelas'=>$guidkelas,  
					'guidupload'=>$guidupload, 
					'tanggal_raport'=>$tanggal_raport,
				);  
				$cek = $this->Upload_model->cek_upload($guidsemester,$guidkelas);

				

				$jurusan = $this->Upload_model->cekjurusan($guidkelas)->row_array();
				$config  = $this->Upload_model->resultconfig($jurusan['kodejuruan'],$jurusan['kodekelas'])->result_array();
				$kodedok = $this->Upload_model->resultdok($jurusan['kodejuruan'],$jurusan['kodekelas'])->row_array();
				if($cek>0){
					$this->session->set_flashdata('message', 'Raport Kelas telah di upload, silahkan dihapus terlebih dahulu untuk upload ulang');
					$this->session->set_flashdata('info', '2');
					redirect(site_url('upload/add_upload')); 
				}else{  
					$insert = $this->db->insert('tbl_upload',$dataSimpan); 

					$data_upload = $this->upload->data();
					//include APPPATH.'third_party/PHPExcel/PHPExcel.php'; 
					$excelreader     = new PHPExcel_Reader_Excel2007();
					$loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']);  
					$sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true); 
					
					//$data = array(); 
					$numrow = 1;
					$tbl_raportdetail = array();
					$tbl_raport = array();
					$tbl_siswa = array();
					$statusbreak =0;
					foreach($sheet as $row){

						if($numrow==1){
							//echo $row['C'].'-'.$kodedok['namadok'];
							if($row['C']!=$kodedok['namadok']){
								$statusbreak++;
								break; 
							}
						} 

						if($statusbreak>0){}else{
						if($numrow > 3){   
							$this->db->where('niksiswa',$row['B']);
							$ceknik = $this->db->get('tbl_siswa')->num_rows();
							if($ceknik>0){}else{
								array_push($tbl_siswa, array(
									'guidsiswa'=>uniqid().$numrow,
									'niksiswa'=>$row['B'],
									'namasiswa'=>$row['C'],  
									'kelamin'=>$row['D'],  
									'password'=>md5($row['B']),
								));  
							} 

							$guidraport = uniqid().$numrow;  
							array_push($tbl_raport, array(
								'niksiswa'=>$row['B'],
								'guidsemester'=>$guidsemester,  
								'tanggal_raport'=>$tanggal_raport,
								'guidkelas'=>$guidkelas,
								'guidupload'=>$guidupload,
								'guidraport'=>$guidraport,
								'statusspp'=>$row['E'],
								'statuskenaikan'=>$row['F'],
								'nilaikegiatanwajib'=>$row['G'],
								'kegiatanextra'=>$row['H'],
								'nilaikegiatan'=>$row['I'],
							));  

							//$tbl_raportdetail = array();
							$s = 'J';
							$abcP1 ='A';
							$abcP2 ='B';
							$abcP3 ='C'; 
							$counter = 0;

							$keterangan='';
							foreach($config as $c){ 
								$rowd ='';   
								for($i=0;$i<3;$i++){  
									if($counter==1){
										$rowd = $abcP1.$s; 
									}else if($counter==2){
										$rowd = $abcP2.$s; 
									}else if($counter==3){
										$rowd = $abcP3.$s; 
									}else{
										$rowd = $s;
									} 
									$grade=''; 
									if($i==0){ 
										$gradepoint = (int)$row[$rowd];
										if($gradepoint>=85){
											$grade = 'A';
										}else if($gradepoint >=80 && $gradepoint < 85){
											$grade = 'B';
										}else if($gradepoint >=75 && $gradepoint < 80){
											$grade = 'C';
										}else{
											$grade = 'D';
										}

										if($gradepoint>=75){
											$keterangan = 'Tuntas'; 
										}else{
											$keterangan = 'Remedial';
										}

										//Nilai Pengetahuan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().'N'.$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'N',
											'iurutan'=>$i, 
											'nilai' =>substr($row[$rowd],0,4),  
										));  

										//Nilai Grade Pengetahuan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().'NG'.$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'NG',
											'iurutan'=>$i.'A', 
											'nilai' =>$grade,  
										));  


									}else if($i==1){
										$gradepoint = (int)$row[$rowd];
										if($gradepoint>=85){
											$grade = 'A';
										}else if($gradepoint >=80 && $gradepoint < 85){
											$grade = 'B';
										}else if($gradepoint >=75 && $gradepoint < 80){
											$grade = 'C';
										}else{
											$grade = 'D';
										}

										//Nilai Keterampilan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().'P'.$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'P',
											'iurutan'=>$i, 
											'nilai' =>substr($row[$rowd],0,4),  
										));  

										//Nilai Grade Keterampilan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().'PG'.$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'PG',
											'iurutan'=>$i.'A', 
											'nilai' =>$grade,  
										)); 
										
										//Nilai Pengetahuan Keterangan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().'NK'.$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'NK',
											'iurutan'=>$i.'B', 
											'nilai' =>$keterangan,  
										)); 
   
									}else{
										//Nilai SIKAP Keterampilan
										array_push($tbl_raportdetail, array(
											'guidraportdetail'=>uniqid().$numrow.$c['kodepelajaran'].$i,
											'guidraport'=>$guidraport,
											'guidupload'=>$guidupload, 
											'kodepelajaran'=>$c['kodepelajaran'],
											'kodenilai'=>'S',
											'iurutan'=>$i, 
											'nilai' =>substr($row[$rowd],0,4),  
										));  
 
									}
 
									if($s=='Z'){ 
										$s='A';
										$counter++;
									}else{
										$s = chr(ord($s) + 1);
									}  
									 
								}  
							
							}
						}}
						$numrow++;
					}  
					if($statusbreak>0){
						$this->db->delete('tbl_upload', array('guidupload' => $guidupload));
						unlink(realpath('excel/'.$data_upload['file_name']));
						$this->session->set_flashdata('message', 'Kode dokumen tidak ditemukan');
						$this->session->set_flashdata('info', '2');
						redirect(site_url('upload/add_upload'));
					}else{
						if(!empty($tbl_raport)){
							$this->db->insert_batch('tbl_raport', $tbl_raport);
						}
						if(!empty($tbl_raportdetail)){
							$this->db->insert_batch('tbl_raportdetail', $tbl_raportdetail);
						}
						if(!empty($tbl_siswa)){
							$this->db->insert_batch('tbl_siswa', $tbl_siswa);
						} 
						//delete file from server
						unlink(realpath('excel/'.$data_upload['file_name']));
						$this->session->set_flashdata('message', 'Data berhasil di proses');
						$this->session->set_flashdata('info', '2');
						redirect(site_url('upload'));
					}
				}
			}
		}
		
	}


	function tanggal_indonesia($tanggal){ 
        $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
        ); 
        $pecahkan = explode('/', $tanggal); 
        return $pecahkan[1] . ' ' . $bulan[ (int)$pecahkan[0] ] . ' ' . $pecahkan[2];
    } 
}
