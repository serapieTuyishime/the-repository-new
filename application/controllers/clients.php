<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Clients extends CI_Controller{
		// Register client
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

			if($this->form_validation->run() === FALSE){
				$this->load->view('clients/register', $data);
			} else {
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->client_model->register($enc_password);

				// create account where he will be able to rop up coins
				$balance_data=[
					'client_id'=> $this->input->post('username'),
					'client_type'=> 'client',
					'balance'=> 1
				];
				$this->payment_model->createAccount($balance_data);

				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

				redirect('clients/login');
			}
		}

		// change password by self
		public function change_password(){
			$this->config->config['pageTitle']=$data['title'] = 'Change password ';

			$this->form_validation->set_rules('old_password', 'Old password', 'required');
			$this->form_validation->set_rules('password', 'New password', 'required');

			if($this->form_validation->run() === FALSE)
			{
				// means no form was submitted or when validation found something

				$this->config->config['notifications']= $this->notification_model->get_unread();

				$this->load->view('templates/header');
				$this->load->view('clients/change_password');
				$this->load->view('templates/footer');
			}
			else
			{
				// Encrypt password new password
				$enc_password = md5($this->input->post('password'));

				// Encrypt password old password
				$old_password = md5($this->input->post('old_password'));

				// get username of the logged in client
				$username= $this->session->userdata('username');
				// verify if the old password matches

				#if so update
				if ($this->client_model->login($username, $old_password)) {

					$this->client_model->update_passsword($enc_password);
					// Set message
					$this->session->set_flashdata('user_registered', 'Password changed you can now login');

					redirect('clients/login');
				}
				# if not report
				else {
					// Set message
					$this->session->set_flashdata('not_matching', 'Passwords do not match try again');
					redirect('clients/change_password');
				}


			}
		}
		// Log in client
		public function login(){
			if (isset($_GET['to_where'])) {
				$this->session->set_userdata('to_where', $_GET['to_where']);
			}

			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('clients/login', $data);
			} else {

				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

				// Login client
				$client_id = $this->client_model->login($username, $password);

				if($client_id){
					// Create session
					$user_data = array(
						'user_id' => $client_id,
						'username' => $username,
						'userType' => 'client',
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					// if there was a route saved then go there instead
					if ($this->session->has_userdata('to_where')) {
						$route= str_replace('_','/', $this->session->userdata('to_where'));

						// remove the data
						$this->session->unset_userdata('to_where');

						// go the previous page before login
						redirect($route);
					}

					redirect('resources');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('clients/login');
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

			redirect('clients/login');
		}

		// Check if username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->client_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->client_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}
	}
