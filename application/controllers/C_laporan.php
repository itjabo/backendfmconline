<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends CI_Controller {
	
	public function print_word(){		
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			
			$id_kapals = $this->input->post('id_kapal');
			$awal; $akhir;
			$dates  = $this->input->post('tanggal');
			$waktu = $this->input->post('waktu');
			if (strlen($dates)<1){
				$awal =  substr(date('Y-m-d'), 0, 7).'-01';
				$a_date = date('Y-m-d');
				$akhir = date("Y-m-t", strtotime($a_date));
			}else{				
				$awal  = substr($dates,6,4).'-'.substr($dates,0,2).'-'.substr($dates,3,2);
				$akhir = substr($dates,19,4).'-'.substr($dates,13,2).'-'.substr($dates,16,2);
			}	
			if (strlen($id_kapals)<1){
				$id_kapals = "All";				
			}
			if (strlen($waktu)<1){
				$waktu = "All";				
			}
			
			$dataKapal = $this->m_models->getLaporanDiantara($id_kapals,$waktu,$awal, $akhir);
			//$dataKapal = $this->m_models->getLaporan1($id_kapals,$waktu,$awal, $akhir);
			$dataPosisi = $this->m_models->getPosisiDiantara($id_kapals,$waktu,$awal, $akhir);
			
			$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'u_zona'	=> $data["zona"],
				'kapal'		=> $data2,
				'laporan'	=> $dataKapal, 
				'tgl_pilih' => $dates,
				'idkapal_pilh'=> $id_kapals,
				'lap_pos'	=> $dataPosisi,
			);
			
			$this->load->view('print_word',$datas);
		}else{redirect('formlogin');}
	}
	
	public function print_preview(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); 
		$data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models');
		$id_bbm = $this->input->post('id_bbm');
		$data3 = $this->m_models->getLapBBM($id_bbm);
		$data2 = $this->m_models->getKapal();
		$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'u_zona'	=> $data["zona"],
				'kapal'		=> $data2,
				'data_bbm'	=> $data3, 
			);
			
		$this->load->view('print_preview',$datas);
		}else{redirect('formlogin');}
	}
	
	public function preview_posisi(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); 
		$data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models');
		$id_posisi = $this->input->post('id_posisi');
		$data3 = $this->m_models->getLapPosisi($id_posisi);
		$data2 = $this->m_models->getKapal();
		$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'u_zona'	=> $data["zona"],
				'kapal'		=> $data2,
				'data_posisi'	=> $data3, 
			);
			
		$this->load->view('preview_posisi',$datas);
		}else{redirect('formlogin');}
	}
	
	public function print_laporan(){		
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			$awal; $akhir;
			$dates  = $this->input->post('tanggal');
			$waktu = $this->input->post('waktu');
			$id_kapals = $this->input->post('id_kapal');
			if (strlen($dates)<1){
				$awal =  substr(date('Y-m-d'), 0, 7).'-01';
				$a_date = date('Y-m-d');
				$akhir = date("Y-m-t", strtotime($a_date));
			}else{				
				$awal  = substr($dates,6,4).'-'.substr($dates,0,2).'-'.substr($dates,3,2);
				$akhir = substr($dates,19,4).'-'.substr($dates,13,2).'-'.substr($dates,16,2);
			}		
			if (strlen($id_kapals)<1){
				$id_kapals = "All";				
			}
			if (strlen($waktu)<1){
				$waktu = "All";				
			}
			$dataBBM = $this->m_models->getLaporanDiantara($id_kapals,$waktu,$awal, $akhir);
			$dataPosisi = $this->m_models->getPosisiDiantara($id_kapals,$waktu,$awal, $akhir);
			
			$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'u_zona'	=> $data["zona"],
				'kapal'		=> $data2,
				'laporan'	=> $dataBBM, 
				'lap_pos'	=> $dataPosisi,
				'tgl_pilih' => $dates,
				'idkapal_pilh'=> $id_kapals,
			);
			
			$this->load->view('print',$datas);
		}else{redirect('formlogin');}
	}
	
	public function bbm(){		
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			$dataKapal = $this->m_models->getDataLaporan();
			$error ="";
			if (strcmp($data["level"],"lihat")==0){
				redirect('home');
			}else{
			$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				'laporan'	=> $dataKapal, 
				'error'		=> $error,
			);			
			$this->load->view('bbm',$datas);
			}
		}else{redirect('formlogin');}
	}
	
	public function insertbbm(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models'); 
		$data2 = $this->m_models->getKapal();
		$dataKapal = $this->m_models->getDataLaporan();	
		$this->load->model('m_models');
		$dates  = $this->input->post('tanggal');
		$dates  = substr($dates,6,4).'-'.substr($dates,3,2).'-'.substr($dates,0,2);
		//$dates  = str_replace("/","-",$dates);
		$jam	= $this->input->post('jam');
		$menit  = $this->input->post('menit');
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1500;
                $config['max_width']            = 3680;
                $config['max_height']           = 3680;

                $this->load->library('upload', $config);
				$datax = $this->upload->data();
                $error = "Sukses Insert Data";
				$datas;
		if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = $this->upload->display_errors();
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'error'		=> $error,
									);
                }else{
                        $datax = $this->upload->data();
                        $error = "Sukses Insert Data";
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'error'		=> $error,
										'upload_data'		=> $datax,
									);
                        
                }
			$id_kapal 		= $this->input->post('id_kapal');
						$derajat		= $this->input->post('derajat');			$tanggal_siang 	= $dates." ".$jam.":".$menit.":00";
						$kepada 		= $this->input->post('kepada');				$tembusan		= $this->input->post('tembusan');
						$no_surat		= $this->input->post('no_surat');			$lok_isi		= $this->input->post('lok_isi');
						$waktu_pengisian= $this->input->post('waktu_pengisian');	$sblm_hsd 		= $this->input->post('sblm_hsd');
						$sblm_at 		= $this->input->post('sblm_at');			$sblm_ml 		= $this->input->post('sblm_ml');
						$ngisi_hsd		= $this->input->post('ngisi_hsd');			$ngisi_at		= $this->input->post('ngisi_at');
						$ngisi_ml		= $this->input->post('ngisi_ml');			$skrg_hsd		= $this->input->post('skrg_hsd');
						$skrg_at		= $this->input->post('skrg_at');			$skrg_ml		= $this->input->post('skrg_ml');
						$pengirim		= $this->input->post('pengirim');			$nahkoda		= $this->input->post('nahkoda');
						$nip_nrp		= $this->input->post('nip_nrp');			$tgl_buat		= $this->input->post('tgl_buat');
						$tgl_kirim		= $this->input->post('tgl_kirim');			$zona			= $this->input->post('zona');
						$ttd			= $datax['file_name'];
						$this->m_models->insertBBMsiang( $id_kapal, $derajat, $tanggal_siang, $kepada, $tembusan, $no_surat, $lok_isi, $waktu_pengisian, $sblm_hsd, $sblm_at, $sblm_ml, $ngisi_hsd, $ngisi_at, $ngisi_ml, $skrg_hsd, $skrg_at, $skrg_ml, $pengirim, $nahkoda, $nip_nrp, $tgl_buat, $tgl_kirim,$zona, $ttd);
						
                        $this->load->view('bbm', $datas);
		}else{redirect('formlogin');}
	}
	
	public function editbbm(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); 
		$data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models');
		if (strcmp($data["level"],"lihat")==0){
				redirect('home');
		}else{
		$id_bbm = $this->input->post('id_bbm');
		$data3 = $this->m_models->getLapBBM($id_bbm);
		$data2 = $this->m_models->getKapal();
		$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				'data_bbm'	=> $data3, 
			);			
		$this->load->view('editbbm',$datas);
		}
		}else{redirect('formlogin');}
	}

	public function updateBBM(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$dates  = $this->input->post('tanggal');
		$dates  = substr($dates,6,4).'-'.substr($dates,3,2).'-'.substr($dates,0,2);
		//$dates  = str_replace("/","-",$dates);
		$jam	= $this->input->post('jam');
		$menit  = $this->input->post('menit');
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1500;
                $config['max_width']            = 3680;
                $config['max_height']           = 3680;

                $this->load->library('upload', $config);
				$datax = $this->upload->data();
		if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = $this->upload->display_errors();
                }else{
                        $datax = $this->upload->data();
                }
		$id_kapal 		= $this->input->post('id_kapal');		$derajat		= $this->input->post('derajat');
		$tanggal_siang 	= $dates." ".$jam.":".$menit.":00";		$kepada 		= $this->input->post('kepada');
		$tembusan		= $this->input->post('tembusan');		$no_surat		= $this->input->post('no_surat');
		$lok_isi		= $this->input->post('lok_isi');			$waktu_pengisian= $this->input->post('waktu_pengisian');
		$sblm_hsd 		= $this->input->post('sblm_hsd');		$sblm_at 		= $this->input->post('sblm_at');
		$sblm_ml 		= $this->input->post('sblm_ml');		$ngisi_hsd		= $this->input->post('ngisi_hsd');
		$ngisi_at		= $this->input->post('ngisi_at');		$ngisi_ml		= $this->input->post('ngisi_ml');
		$skrg_hsd		= $this->input->post('skrg_hsd');		$skrg_at		= $this->input->post('skrg_at');
		$skrg_ml		= $this->input->post('skrg_ml');		$pengirim		= $this->input->post('pengirim');
		$nahkoda		= $this->input->post('nahkoda');		$nip_nrp		= $this->input->post('nip_nrp');
		$tgl_buat		= $this->input->post('tgl_buat');		$tgl_kirim		= $this->input->post('tgl_kirim');
		$zona			= $this->input->post('zona');			$id_lap_siang   = $this->input->post('id_lap_siang');
		$ttd			= $datax['file_name'];
		if (strlen($ttd)<2){
			$ttd			= $this->input->post('filename');
		}
		$this->m_models->updateBBM($id_lap_siang , $id_kapal, $derajat, $tanggal_siang, $kepada, $tembusan, $no_surat, $lok_isi, $waktu_pengisian, $sblm_hsd, $sblm_at, $sblm_ml, $ngisi_hsd, $ngisi_at, $ngisi_ml, $skrg_hsd, $skrg_at, $skrg_ml, $pengirim, $nahkoda, $nip_nrp, $tgl_buat, $tgl_kirim,$zona,$ttd);
		
		redirect('bbm');	
		}else{redirect('formlogin');}
	}
	public function deleteBBM(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$id_bbm = $this->input->post('id_bbm');
		$this->m_models->deleteBBM($id_bbm);		
			
		redirect('bbm');	
		}else{redirect('formlogin');}
	}
	
    public function posisi(){		
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			$dataKapal = $this->m_models->getDataPosisi();
			$error ="";
			if (strcmp($data["level"],"lihat")==0){
				redirect('home');
			}else{
			$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				'laporan'	=> $dataKapal, 
				'error'		=> $error,
			);
			$this->load->view('posisi',$datas);
			}
		}else{redirect('formlogin');}
	}
	
	public function insertposisi(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models'); 
		$data2 = $this->m_models->getKapal();
		$dataKapal = $this->m_models->getDataPosisi();	
		$this->load->model('m_models');
		$dates  = $this->input->post('tanggal');
		$dates  = substr($dates,6,4).'-'.substr($dates,3,2).'-'.substr($dates,0,2);
		//$dates  = str_replace("/","-",$dates);
		$jam	= $this->input->post('jam');
		$menit  = $this->input->post('menit');
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1500;
                $config['max_width']            = 3680;
                $config['max_height']           = 3680;

                $this->load->library('upload', $config);
				$datax = $this->upload->data();
                $error = "Sukses Insert Data";
				$datas;
		if ( ! $this->upload->do_upload('userfile')){
                        $error = $this->upload->display_errors();
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'error'		=> $error,
									);
                }else{
                        $datax = $this->upload->data();
                        $error = "Sukses Insert Data";
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'error'		=> $error,
										'upload_data'		=> $datax,
									);                        
                }
				$id_kapal		= $this->input->post('id_kapal');			$waktu			= $this->input->post('waktu');
				$waktu_pengisian= $this->input->post('waktu_pengisian');	$derajat		= $this->input->post('derajat');
				$tanggal_siang	= $dates." ".$jam.":".$menit.":00";			$kepada 		= $this->input->post('kepada');
				$tembusan		= $this->input->post('tembusan');			$no_surat		= $this->input->post('no_surat');
				$zona			= $this->input->post('zona');				$giat			= $this->input->post('giat');
				$koordinat		= $this->input->post('koordinat');			$posisi			= $this->input->post('posisi');
				$bbm			= $this->input->post('bbm');				$layar			= $this->input->post('layar');
				$lego			= $this->input->post('lego');				$sandar			= $this->input->post('sandar');
				$pemeriksaan	= $this->input->post('pemeriksaan');		$penangkapan	= $this->input->post('penangkapan');
				$pengirim		= $this->input->post('pengirim');			$nahkoda		= $this->input->post('nahkoda');
				$nip_nrp		= $this->input->post('nip_nrp');			$tgl_buat		= $this->input->post('tgl_buat');
				$tgl_kirim		= $this->input->post('tgl_kirim');			$ttd			= $datax['file_name'];	
				$this->m_models->insertPosisi($id_kapal,$waktu,$waktu_pengisian, $derajat,$tanggal_siang,$kepada,$tembusan,$no_surat,$zona,$giat,$koordinat,$posisi,$bbm,$layar,$lego,$sandar,$pemeriksaan,$penangkapan, $pengirim, $nahkoda, $nip_nrp, $tgl_buat, $tgl_kirim, $ttd);
						
                $this->load->view('posisi', $datas);
		}else{redirect('formlogin');}
	}
	
	public function editposisi(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); 
		$data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models');
		if (strcmp($data["level"],"lihat")==0){
				redirect('home');
		}else{
		$id_pos = $this->input->post('id_pos');
		$data3 = $this->m_models->getLapPosisi($id_pos);
		$data2 = $this->m_models->getKapal();
		$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				'data_pos'	=> $data3, 
			);
			
		$this->load->view('editposisi',$datas);
		}
		}else{redirect('formlogin');}
	}
	
	public function updateposisi(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$dates  = $this->input->post('tanggal');
		$dates  = substr($dates,6,4).'-'.substr($dates,3,2).'-'.substr($dates,0,2);
		//$dates  = str_replace("/","-",$dates);
		$jam	= $this->input->post('jam');
		$menit  = $this->input->post('menit');
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1500;
                $config['max_width']            = 3680;
                $config['max_height']           = 3680;

                $this->load->library('upload', $config);
				$datax = $this->upload->data();
		if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = $this->upload->display_errors();
                }else{
                        $datax = $this->upload->data();
                }
		
			$id_pos 	    = $this->input->post('id_lap_siang');		$waktu			= $this->input->post('waktu');
			$waktu_pengisian= $this->input->post('waktu_pengisian');	$derajat		= $this->input->post('derajat');
			$tanggal_siang	= $dates." ".$jam.":".$menit.":00";			$kepada 		= $this->input->post('kepada');
			$tembusan		= $this->input->post('tembusan');			$no_surat		= $this->input->post('no_surat');
			$zona			= $this->input->post('zona');				$giat			= $this->input->post('giat');
			$koordinat		= $this->input->post('koordinat');			$posisi			= $this->input->post('posisi');
			$bbm			= $this->input->post('bbm');				$layar			= $this->input->post('layar');
			$lego			= $this->input->post('lego');				$sandar			= $this->input->post('sandar');
			$pemeriksaan	= $this->input->post('pemeriksaan');		$penangkapan	= $this->input->post('penangkapan');
			$pengirim		= $this->input->post('pengirim');			$nahkoda		= $this->input->post('nahkoda');
			$nip_nrp		= $this->input->post('nip_nrp');			$tgl_buat		= $this->input->post('tgl_buat');
			$tgl_kirim		= $this->input->post('tgl_kirim');			$ttd			= $datax['file_name'];	
			
		if (strlen($ttd)<2){
			$ttd			= $this->input->post('filename');
		}
		$this->m_models->updatePosisi($id_pos,$waktu,$waktu_pengisian, $derajat,$tanggal_siang,$kepada,$tembusan,$no_surat,$zona,$giat,$koordinat,$posisi,$bbm,$layar,$lego,$sandar,$pemeriksaan,$penangkapan, $pengirim, $nahkoda, $nip_nrp, $tgl_buat, $tgl_kirim, $ttd);
		
		redirect('posisi');	
		}else{redirect('formlogin');}
	}
	
	public function deletePosisi(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$id_pos = $this->input->post('id_pos');
		$this->m_models->deletePosisi($id_pos);		
			
		redirect('posisi');	
		}else{redirect('formlogin');}
	}
	
	public function add_kapal(){		
		if($this->session->userdata('is_logged_in')){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			if (strcmp($data["level"],"super admin")==0){
				$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				);			
				$this->load->view('add_kapal',$datas);
			}else{
				redirect('home');
			}
		}else{redirect('formlogin');}
	}
	
	public function insert_kapal(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$nama_kapal	= $this->input->post('nama_kapal');
		$tangki		= $this->input->post('tangki');
		$bbm		= $this->input->post('bbm');
		$panjang	= $this->input->post('panjang');
		$kapasitas	= $this->input->post('kapasitas');
		$instansi	= $this->input->post('instansi');
		$this->m_models->insert_kapal($nama_kapal, $tangki, $bbm, $panjang, $kapasitas, $instansi);
		redirect('add_kapal');
		}else{
			redirect('formlogin');
		}
	}
	
	public function delete_kapal(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');
		$id_kapal = $this->input->post('id_kapal');
		$this->m_models->deleteKapal($id_kapal);		
			
		redirect('add_kapal');	
		}else{redirect('formlogin');}
	}
	
	public function edit_kapal(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_login'); 
		$data = $this->m_login->loadData($this->session->userdata('user_name'));
		$this->load->model('m_models');
		if (strcmp($data["level"],"lihat")==0){
				redirect('home');
		}else{
		$id_kapal = $this->input->post('id_kapal');
		$data3 = $this->m_models->getLapKapal($id_kapal);
		$data2 = $this->m_models->getKapal();
		$datas = array(
				'username'  	=> $data["username"],
				'email' 	=> $data["email"],
				'unit' 		=> $data["unit"],
				'level' 	=> $data["level"],
				'tgl_create'	=> $data["tgl_create"],
				'kapal'		=> $data2,
				'data_kapal'	=> $data3, 
			);
			
		$this->load->view('edit_kapal',$datas);
		}
		}else{redirect('formlogin');}
	}
	
	public function update_kapal(){
		if($this->session->userdata('is_logged_in')){
		$this->load->model('m_models');		
		$id_kapal	= $this->input->post('id_kapal');
		$nama_kapal	= $this->input->post('nama_kapal');
		$tangki		= $this->input->post('tangki');
		$bbm		= $this->input->post('bbm');
		$panjang	= $this->input->post('panjang');
		$kapasitas	= $this->input->post('kapasitas');
		$instansi	= $this->input->post('instansi');
		$this->m_models->update_kapal($id_kapal, $nama_kapal, $tangki, $bbm, $panjang, $kapasitas, $instansi);
			
		redirect('add_kapal');	
		}else{redirect('formlogin');}
	}
	
	public function do_upload(){
			$this->load->model('m_login'); $data = $this->m_login->loadData($this->session->userdata('user_name'));
			$this->load->model('m_models'); 
			$data2 = $this->m_models->getKapal();
			$dataKapal = $this->m_models->getDataLaporan();	
			
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1000;
                $config['max_width']            = 2024;
                $config['max_height']           = 2680;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = $this->upload->display_errors();
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'error'		=> $error,
									);
                        $this->load->view('bbm', $datas);
                }
                else
                {
                        $datax = $this->upload->data();
						$datas = array(
										'username'  	=> $data["username"],
										'email' 	=> $data["email"],
										'unit' 		=> $data["unit"],
										'level' 	=> $data["level"],
										'tgl_create'	=> $data["tgl_create"],
										'kapal'		=> $data2,
										'laporan'	=> $dataKapal, 
										'upload_data'		=> $datax,
									);
                        $this->load->view('upload_success', $datas);
                }
        }	
}
