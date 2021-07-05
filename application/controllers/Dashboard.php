<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		// Check login
		if(!$this->session->userdata('logged_in')){
			redirect('users/login');
		}
		$this->load->view('templates/header');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');

	}
}
