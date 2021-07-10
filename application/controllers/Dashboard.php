<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		// Check login
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('login_failed', 'Please at least login');
			redirect('clients/login');
		}

		// admin
		$schools = empty($this->school_model->get_schools()) ? 0 : sizeof($this->school_model->get_schools());
		$departments = empty($this->department_model->getdepartments()) ? 0 : sizeof($this->department_model->getdepartments());
		$resources = empty($this->resources_model->get_resources()) ? 0 : sizeof($this->resources_model->get_resources());
	 	$researchers = empty($this->researcher_model->get_researchers()) ? 0 : sizeof($this->researcher_model->get_researchers());


		$data =
		[
			'schools'=>$schools,
			'departments'=> $departments,
			'resources'=> $resources,
			'all_resources'=> $this->resources_model->get_resources(FALSE, 5),
			'subsrciptions'=> $this->subscription_model->get_subscriptions(FALSE, 5),
			'researchers'=> $researchers,
		];
		$userType = $this->session->userdata('userType');
		$this->load->view('templates/header');
		$this->load->view('dashboard/'.$userType, $data);
		$this->load->view('templates/footer');

	}
	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('userType');

		// Set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');

		redirect('clients/login');
	}
}
