<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_dashboard extends CI_Controller {
	
	public function index()
	{
		$this->load->view('main_dashboard');
	}

    public function berita()
	{
		$this->load->view('berita');
	}

    public function buat_akun()
	{
		$this->load->view('buat_akun');
	}

}