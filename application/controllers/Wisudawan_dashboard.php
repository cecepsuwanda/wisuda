<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisudawan_dashboard extends CI_Controller {
	
	public function index()
	{
		$this->load->view('wisudawan_login');
	}

    public function login()
	{
		$this->load->view('wisudawan_dashboard');
	}

	public function data()
	{
		$this->load->view('wisudawan_data');
	}	


}
