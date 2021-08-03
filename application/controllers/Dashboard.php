<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		// Check login
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('login_failed', 'Please at least login');
			$this->session->set_userdata('to_where', 'dashboard_index');
			redirect('clients/login');
		}

		// admin
		switch ($this->session->userdata('userType')) {
			case 'admin':
				$this->config->config['pageTitle']= $data['title']='Admin dashboard';
				$schools = empty($this->school_model->get_schools()) ? 0 : sizeof($this->school_model->get_schools());
				$departments = empty($this->department_model->getdepartments()) ? 0 : sizeof($this->department_model->getdepartments());
				$resources = empty($this->resources_model->get_resources()) ? 0 : sizeof($this->resources_model->get_resources());
				$researchers = empty($this->researcher_model->get_researchers()) ? 0 : sizeof($this->researcher_model->get_researchers());
				$current_cash= $this->payment_model->get_money_made(0); # not yet translated into cash
				$past_cash= $this->payment_model->get_money_made(1); # for documentation

				$data =
				[
					'schools'=>$schools,
					'departments'=> $departments,
					'resources'=> $resources,
					'all_resources'=> $this->resources_model->get_resources(FALSE, 5),
					'subsrciptions'=> $this->subscription_model->get_subscriptions(FALSE, 5),
					'researchers'=> $researchers,
					'coins'=> round($current_cash['amount'])
				];
				break;
			case 'school':
				$this->config->config['pageTitle']= $data['title']='School dashboard';
				$school_id = $this->session->userdata('user_id');
				$username = $this->session->userdata('username');
				$downloadsPerStudents= $this->resources_model->downloads_per_students($school_id, 5); # get top 5
				$StudentsBySchool= empty($this->student_model->StudentsBySchool($school_id)) ? 0 : sizeof($this->student_model->StudentsBySchool($school_id));
				$subscriptions = $this->subscription_model->subscription_per_school($school_id);
				$balance = $this->payment_model->check_balance($username, 'school');
				if (empty($subscriptions)) {
					$NextBilldate = date('Y-m-d');
					$active_subscriptions =0;
				}
				else {
					$NextBilldate= $subscriptions[0]['date_end'];
					$active_subscriptions = sizeof($subscriptions);
				}

				$data=
				[
					'downloadsPerStudents' => $downloadsPerStudents,
					'students' => $StudentsBySchool,
					'packages' => $subscriptions,
					'lastAccessDate' => $NextBilldate,
					'active_subscriptions' => $active_subscriptions,
					'balance' => $balance['balance']
				];
				break;
			case 'researcher':
				$this->config->config['pageTitle']= $data['title']='Researcher dashboard';
				$researcher_id = $this->session->userdata('user_id');
				$schools = empty($this->school_model->get_schools()) ? 0 : sizeof($this->school_model->get_schools());
				$departments = empty($this->department_model->getdepartments()) ? 0 : sizeof($this->department_model->getdepartments());
				$resources = empty($this->resources_model->get_resources()) ? 0 : sizeof($this->resources_model->get_resources());
				$researchers = empty($this->researcher_model->get_researchers()) ? 0 : sizeof($this->researcher_model->get_researchers());
				$data =
				[
					'schools' =>$schools,
					'departments' => $departments,
					'resources' => $resources,
					'researchers' => $researchers,
					'all_resources'=> $this->resources_model->get_resources(FALSE, 5),
					'my_resources' => $this->resources_model->resources_by_researcher($researcher_id, 5),

				];
				break;
			case 'client':
				redirect('resources/saved_for_later');
				break;
			default:
				// code...
				break;
		}

		// schools


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
