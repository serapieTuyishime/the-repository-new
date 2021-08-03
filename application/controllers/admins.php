<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Admins extends CI_Controller
    {
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
				$this->load->view('admin/change_password');
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
				if ($this->admin_model->login($username, $old_password)) {

					$this->admin_model->update_passsword($enc_password);
					// Set message
					$this->session->set_flashdata('user_registered', 'Password changed you can now login');

					redirect('admins/login');
				}
				# if not report
				else {
					// Set message
					$this->session->set_flashdata('not_matching', 'Passwords do not match try again');
					redirect('admins/change_password');
				}
			}
		}
		// Log in admin
		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/login', $data);
			} else {

				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

				// Login admin
				$admin_id = $this->admin_model->login($username, $password);

				if($admin_id){
					// Create session
					$user_data = array(
						'user_id' => $admin_id,
						'username' => $username,
						'userType' => 'admin',
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

					redirect('dashboard/index');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('admins/login');
				}
			}
		}
    }

 ?>
