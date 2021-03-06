<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Schools extends CI_Controller{
		public function index()
	    {
	        if ($this->session->userdata('userType') != 'admin') {
				$this->session->set_flashdata('login_failed', 'Admins only can view schools');
				$this->session->set_userdata('to_where', 'schools_index');
	            redirect('admins/login');
	        }
	        $this->config->config['pageTitle']= $data['title']='All schools';
	        $this->config->config['notifications']= $this->notification_model->get_unread();

	        $data= [
	            'schools' => $this->school_model->get_schools(),
	        ];

	        $this->load->view('templates/header');
	        $this->load->view('schools/index', $data);
	        $this->load->view('templates/footer');
	    }
		public function create()
		{
			// only admin can create a school
			if ($this->session->userdata('userType') != 'admin') {
				$this->session->set_flashdata('login_failed', 'Only admin can add school');
				$this->session->set_userdata('to_where', 'schools_create');
				redirect('admins/login');
			}

			$this->config->config['pageTitle']=$data['title'] = 'Add school';

			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('telephone', 'Telephone', 'required|callback_check_telephone_exists');


			if($this->form_validation->run() === FALSE)
			{
				// means no form was submitted or when validation found something

				// So if it have to display errors it will take back what you entered before
				$data['school']=[
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'telephone'=>$this->input->post('telephone'),
					'description'=>$this->input->post('description'),
					'bank_acc'=>$this->input->post('bank_acc'),
					'username'=>$this->input->post('username')
				];

				$this->config->config['notifications']= $this->notification_model->get_unread();

				$this->load->view('templates/header');
				$this->load->view('schools/create', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				// create account where he will be able to top up coins
				$balance_data=[
					'client_id'=> $this->input->post('username'),
					'client_type'=> 'school',
					'balance'=> 1
				];
				$this->payment_model->createAccount($balance_data);

				$this->school_model->create($enc_password);
				// Set message
				$this->session->set_flashdata('created', 'New school has been added');

				redirect('schools/create');
			}
		}

		public function edit($id)
		{
			// only admin can create a school
			if ($this->session->userdata('userType') != 'admin') {
				$this->session->set_flashdata('login_failed', 'Only admin can update school');
				$this->session->set_userdata('to_where', 'schools_edit_'.$id);
				redirect('admins/login');
			}
			$school_info = $this->school_model->get_schools($id);

			$this->config->config['pageTitle']=$data['title'] = 'Edit school';

			$this->form_validation->set_rules('email', 'Email', 'required');
			// $this->form_validation->set_rules('username', 'Username', 'required');


			if($this->form_validation->run() === FALSE)
			{
				// means no form was submitted or when validation found something

				// So if it have to display errors it will take back what you entered before
				$data['school']=[
					'id'=>$school_info['id'],
					'name'=>$school_info['name'],
					'email'=>$school_info['email'],
					'telephone'=>$school_info['telephone'],
					'description'=>$school_info['description'],
				];

				$this->config->config['notifications']= $this->notification_model->get_unread();

				$this->load->view('templates/header');
				$this->load->view('schools/edit', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$valid= $this->school_model->check_email_exists_edit($this->input->post('email'), $id);
				$valid= $this->school_model->check_telephone_exists_edit($this->input->post('telephone'), $id);


				if ($valid) {
					$this->school_model->update($id);
					// Set message
					$this->session->set_flashdata('created', 'School info updated');

					redirect('schools/index');
				}
				else {
					// Set message
					$this->session->set_flashdata('not_matching', 'The email or telephone has been taken by another school');

					redirect('schools/edit/'.$id);
				}


			}
		}

		public function login(){
			$data['title'] = 'School login';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('schools/login', $data);
			} else {

				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

				// Login school
				$school_id = $this->school_model->login($username, $password);

				if($school_id){
					// Create session
					$user_data = array(
						'user_id' => $school_id,
						'username' => $username,
						'userType' => 'school',
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);
					// if there was a route saved then go there instead
					if ($this->session->has_userdata('to_where')) {
						$route= str_replace('_','/', $this->session->userdata('to_where'));

						// remove the data
						$this->session->unset_userdata('to_where');

						// go the previous page before login
						redirect($route);
					}

					redirect('dashboard/index');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('schools/login');
				}
			}
		}
		public function change_password(){
	        $this->config->config['pageTitle']=$data['title'] = 'Change password ';

	        $this->form_validation->set_rules('old_password', 'Old password', 'required');
	        $this->form_validation->set_rules('password', 'New password', 'required');

	        if($this->form_validation->run() === FALSE)
	        {
	            // means no form was submitted or when validation found something

	            $this->config->config['notifications']= $this->notification_model->get_unread();

	            $this->load->view('templates/header');
	            $this->load->view('schools/change_password');
	            $this->load->view('templates/footer');
	        }
	        else
	        {
	            // Encrypt password new password
	            $enc_password = md5($this->input->post('password'));

				// Encrypt password old password
	            $old_password = md5($this->input->post('old_password'));

				// get username of the logged in researcher
				$username= $this->session->userdata('username');
	            // verify if the old password matches

	                #if so update
	            if ($this->school_model->login($username, $old_password)) {

	                $this->school_model->update_passsword($enc_password);
	                // Set message
	                $this->session->set_flashdata('user_registered', 'Password changed you can now login');

	                redirect('schools/login');
	            }
	                # if not report
	            else {
	                // Set message
	                $this->session->set_flashdata('not_matching', 'Passwords do not match try again');
	                redirect('schools/change_password');
	            }
	        }
	    }
		// Check if username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->school_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->school_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}

		// Check if telephone exists
		public function check_telephone_exists($telephone){
			$this->form_validation->set_message('check_telephone_exists', 'That telephone is taken. Please choose a different one');
			if($this->school_model->check_telephone_exists($telephone)){
				return true;
			} else {
				return false;
			}
		}
	}
?>
