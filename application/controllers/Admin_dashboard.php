<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {
	
	public function index()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
          
           $db['wisudawan']=$this->Wisudawan_model;
		   $db['priode']=$this->Priode_model;
		   $this->Admin_dashboard_model->setdbvar($db);
		   $data=$this->Admin_dashboard_model->rekap_data(); 

		   $this->load->view('admin_dashboard',$data);
		}else{
			redirect('/Admin_dashboard/login');
		}

	}

    public function login()
	{
		$un=$this->input->post('un');
        $psw=$this->input->post('psw');
        $login = $this->input->post('login');

		$db['user']=$this->User_model;
		$db['log']=$this->Log_user_model;	
		$this->Admin_dashboard_model->setdbvar($db);
		$data=$this->Admin_dashboard_model->login($login,$un,$psw);
        if(($login=='login') and ($data['msg']=='') )
		{
          redirect('/Admin_dashboard/index');
		}else{
		  $this->load->view('admin_login',$data);
		} 

		
	}

    public function baca_data_wisudawan()
    {
          $id_wisuda=$this->input->post('id_wisuda'); 

          $db['fakultas']=$this->Fakultas_model;
		  $db['prodi']=$this->Prodi_model;
		  $db['wisudawan']=$this->Wisudawan_model;
		  $this->Admin_dashboard_model->setdbvar($db);
		  $data=$this->Admin_dashboard_model->baca_data_wisudawan($id_wisuda);
          
		  echo $this->load->view('modal',$data,true);

    }

    public function addberita()
    {
    	$berita=$this->input->post('berita');
    	$db['berita']=$this->Berita_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$this->Admin_dashboard_model->simpan_berita($berita);

    }

    public function delete_berita()
    {
    	$id_berita=$this->input->post('id_berita');
    	$db['berita']=$this->Berita_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$this->Admin_dashboard_model->delete_berita($id_berita);

    }

    public function edit_berita()
    {
    	$id_berita=$this->input->post('id_berita');
    	$db['berita']=$this->Berita_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$html = $this->Admin_dashboard_model->edit_berita($id_berita);
        echo $html;
    }

    public function save_berita()
    {
    	$data['id_berita']=$this->input->post('id_berita');
    	$data['isi_berita']=$this->input->post('isi_berita');
    	
    	$db['berita']=$this->Berita_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$this->Admin_dashboard_model->save_berita($data);
        
    }

	 public function berita()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		   
		   $db['berita']=$this->Berita_model;
		   $this->Admin_dashboard_model->setdbvar($db);
		   $data=$this->Admin_dashboard_model->baca_berita(); 
		   $this->load->view('admin_berita',$data);

		 }else{
			redirect('/Admin_dashboard/login');
		}  
	}

	public function data()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		  $db['wisudawan']=$this->Wisudawan_model;
		  $db['priode']=$this->Priode_model;
		  $this->Admin_dashboard_model->setdbvar($db);
		  $data = $this->Admin_dashboard_model->baca_data();		  

		  $this->load->view('admin_wisudawan_data',$data);
		}else{
			redirect('/Admin_dashboard/login');
		}


	}

	public function logout()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		  $user_name = $this->session->userdata('user_name');
		  $lg_time = $this->session->userdata('lg_time');

		  $db['log']=$this->Log_user_model;
		  $this->Admin_dashboard_model->setdbvar($db);
		  $this->Admin_dashboard_model->logout($user_name,$lg_time);
		  
		  $array_items = array('user_name','lg_time','logged_in');
          $this->session->unset_userdata($array_items);
          
		}
		redirect('/Main_dashboard/');
		


	}

	public function do_upload()
	{
		header('Content-type: application/json');
        
                $config['upload_path']          = './assets/photo';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1024;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(array('code' => 0, 'url' => ''));                           
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        echo json_encode(array('code' => 0, 'url' => base_url()."assets/photo/".$_FILES['img']['name']));
                }


        
		
        
	}

	public function updatedatapribadi()
	{
        $data['alamat']=$this->input->post('alamat');
        $data['hp']=$this->input->post('hp');
        $data['jk']= $this->input->post('jk');
        $data['ktp']=$this->input->post('ktp');
        $data['nama']=$this->input->post('nama');
        $data['tmpt_lahir']= $this->input->post('tempat');
        $data['tgl_lahir']= date('Y-m-d', strtotime($this->input->post('tgl')));
        if(!empty($this->input->post('nm_file')))
        {
         $data['photo']= $this->input->post('nm_file');
        }


        $data['id_wisuda']= $this->input->post('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$hsl=$this->Admin_dashboard_model->updatedatapribadi($data);
		echo $hsl;
	}

	public function updatedataakademik()
	{
        $data['angkatan']=$this->input->post('ang');
        $data['id_prodi']= $this->input->post('prodi');
        $data['nim']=$this->input->post('nim');
        

        $data['id_wisuda']= $this->input->post('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$hsl=$this->Admin_dashboard_model->updatedataakademik($data);
		echo $hsl;
	}

	public function updateketverifikasi()
	{
        $data['ket']=$this->input->post('keterangan');
        $data['ver']= $this->input->post('verifikasi');
        $data['tgl_ver']=date('Y-m-d H:i:s');
        $data['admin_name']=$this->session->userdata('user_name');

        $data['id_wisuda']= $this->input->post('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$hsl=$this->Admin_dashboard_model->updateketverifikasi($data);
		echo $hsl;
	}

	

	public function updatedatawisuda()
	{
        $data['ipk']= $this->input->post('ipk');
        
        $data['jdl_skripsi']= $this->input->post('jdlskripsi');
        
        if(!empty($this->input->post('tgllls'))){
          $data['tgl_lls']= date('Y-m-d', strtotime($this->input->post('tgllls')));
        }
        
        if(!empty($this->input->post('tglbyr'))){
          $data['tgl_byr']= date('Y-m-d', strtotime($this->input->post('tglbyr')));
        }
        
        if(!empty($this->input->post('nm_file')))
        {
         $data['kwitansi']= $this->input->post('nm_file');
        }
                

        $data['id_wisuda']= $this->input->post('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Admin_dashboard_model->setdbvar($db);
		$hsl=$this->Admin_dashboard_model->updatedatawisuda($data);
		echo $hsl;
	}


}
