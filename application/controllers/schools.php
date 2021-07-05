<?php

	class Schools extends CI_Controller{
		public function create()
		{
			
			$this->config->config['pageTitle']=$data['title'] = 'Add school';

			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');

			
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

				$this->school_model->create($enc_password);            
				// Set message
				$this->session->set_flashdata('created', 'New school has been added');
				
				redirect('schools/create');
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

					redirect('students/create');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('schools/login');
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
	}
?>