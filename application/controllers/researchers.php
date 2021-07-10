<?php
class Researchers extends CI_Controller{
	// Register researcher
	public function register(){
		$data['title'] = 'Sign Up';

		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

		if($this->form_validation->run() === FALSE){
			$this->load->view('researchers/register', $data);
		} else {
			// Encrypt password
			$enc_password = md5($this->input->post('password'));
			// upload Images

			// set up configuration
			$config['upload_path'] = './assets/images/researchers';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config); #the library for uploading images

			if(!$this->upload->do_upload()){
				$errors = array('error' => $this->upload->display_errors());
				$image_name = 'noimage.jpg';
				print_r ($errors);
				die();
			} else {
				$data = array('upload_data' => $this->upload->data());
				$image_name = $_FILES['userfile']['name'];
			}

			$this->researcher_model->register($enc_password, $image_name);

			// Set message
			$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

			redirect('researchers/login');
		}
	}

	// Log in researcher
	public function login(){
		$data['title'] = 'Sign In';

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('researchers/login', $data);
		} else {

			// Get username
			$username = $this->input->post('username');
			// Get and encrypt the password
			$password = md5($this->input->post('password'));

			// Login researcher
			$researcher_id = $this->researcher_model->login($username, $password);

			if($researcher_id){
				// Create session
				$user_data = array(
					'user_id' => $researcher_id,
					'username' => $username,
					'userType' => 'researcher',
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);

				// Set message
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');

				redirect('resources');
			} else {
				// Set message
				$this->session->set_flashdata('login_failed', 'Login is invalid');

				redirect('researchers/login');
			}
		}
	}

	// Log user out
	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');

		// Set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');

		redirect('researchers/login');
	}

	// Check if username exists
	public function check_username_exists($username){
		$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
		if($this->researcher_model->check_username_exists($username)){
			return true;
		} else {
			return false;
		}
	}

	// Check if email exists
	public function check_email_exists($email){
		$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
		if($this->researcher_model->check_email_exists($email)){
			return true;
		} else {
			return false;
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
			$this->load->view('researchers/change_password');
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
			if ($this->researcher_model->login($username, $old_password)) {

				$this->researcher_model->update_passsword($enc_password);
				// Set message
				$this->session->set_flashdata('user_registered', 'Password changed you can now login');

				redirect('researchers/login');
			}
			# if not report
			else {
				// Set message
				$this->session->set_flashdata('not_matching', 'Passwords do not match try again');
				redirect('researchers/change_password');
			}


		}
	}
}
