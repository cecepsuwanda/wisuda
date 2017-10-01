<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisudawan_dashboard extends CI_Controller {
	
	public function index()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		 $this->load->view('wisudawan_dashboard');
		}else{
			redirect('/Wisudawan_dashboard/login');
		}

	}

    public function login()
	{
		$un=$this->input->post('un');
        $psw=$this->input->post('psw');
        $login = $this->input->post('login');

		$db['wisudawan']=$this->Wisudawan_model;
		$db['priode']=$this->Priode_model;	
		$db['log']=$this->Log_wisudawan_model;	
		$this->Wisudawan_dashboard_model->setdbvar($db);
		$data=$this->Wisudawan_dashboard_model->login($login,$un,$psw);
        if(($login=='login') and ($data['msg']=='') )
		{
          redirect('/Wisudawan_dashboard/index');
		}else{
		  $this->load->view('wisudawan_login',$data);
		} 

		
	}

	public function data()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		  $db['fakultas']=$this->Fakultas_model;
		  $db['prodi']=$this->Prodi_model;
		  $db['wisudawan']=$this->Wisudawan_model;
		  $this->Wisudawan_dashboard_model->setdbvar($db);
		  $data = $this->Wisudawan_dashboard_model->baca_data();		  

		  $this->load->view('wisudawan_data',$data);
		}else{
			redirect('/Wisudawan_dashboard/login');
		}


	}

	public function logout()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in){
		  $id_wisuda = $this->session->userdata('id_wisuda');
		  $lg_time = $this->session->userdata('lg_time');

		  $db['log']=$this->Log_wisudawan_model;
		  $this->Wisudawan_dashboard_model->setdbvar($db);
		  $this->Wisudawan_dashboard_model->logout($id_wisuda,$lg_time);
		  
		  $array_items = array('id_wisuda','lg_time','logged_in');
          $this->session->unset_userdata($array_items);
          
		}
		redirect('/Main_dashboard/');
		


	}

	public function do_upload()
	{
		header('Content-type: application/json');
        
                $config['upload_path']          = './assets/photo';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                                                   
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


        $data['id_wisuda']= $this->session->userdata('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Wisudawan_dashboard_model->setdbvar($db);
		$hsl=$this->Wisudawan_dashboard_model->updatedatapribadi($data);
		echo $hsl;
	}

	public function updatedataakademik()
	{
        $data['angkatan']=$this->input->post('ang');
        $data['id_prodi']= $this->input->post('prodi');
        $data['nim']=$this->input->post('nim');
        

        $data['id_wisuda']= $this->session->userdata('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Wisudawan_dashboard_model->setdbvar($db);
		$hsl=$this->Wisudawan_dashboard_model->updatedataakademik($data);
		echo $hsl;
	}

	public function updatedatauser()
	{
        $data['user_name']=$this->input->post('user');
        $data['user_pass']= md5($this->input->post('pass'));
                

        $data['id_wisuda']= $this->session->userdata('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Wisudawan_dashboard_model->setdbvar($db);
		$hsl=$this->Wisudawan_dashboard_model->updatedatauser($data);
		echo $hsl;
	}

	public function updatedatawisuda()
	{
        $data['ipk']= $this->input->post('ipk');
        
        $data['jdl_skripsi']= $this->input->post('jdlskripsi');
        
        if(!empty($this->input->post('tgllls'))){
          $data['tgl_lls']= date('Y-m-d', strtotime($this->input->post('tgllls')));
        }
        
        
        if(!empty($this->input->post('nm_file')))
        {
         $data['kwitansi']= $this->input->post('nm_file');
        }
                

        $data['id_wisuda']= $this->session->userdata('id_wisuda');
		$db['wisudawan']=$this->Wisudawan_model;
		$this->Wisudawan_dashboard_model->setdbvar($db);
		$hsl=$this->Wisudawan_dashboard_model->updatedatawisuda($data);
		echo $hsl;
	}


}
