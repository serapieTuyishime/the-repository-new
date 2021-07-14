<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {
    public function index(){
        $this->config->config['pageTitle']= $data['title']='All students';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $school_id= $this->session->userdata('user_id');
        $data['students'] = $this->student_model->StudentsBySchool($school_id);

        $this->load->view('templates/header');
        $this->load->view('students/index', $data);
        $this->load->view('templates/footer');
    }
    public function login(){
        $data['title'] = 'Students login';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('students/login', $data);
        } else {

            // Get username
            $username = $this->input->post('username');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));

            // Login student
            $student_id = $this->student_model->login($username, $password);

            if($student_id){
                // Create session
                $user_data = array(
                    'user_id' => $student_id,
                    'username' => $username,
                    'userType' => 'student',
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

                redirect('resources/index');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');

                redirect('students/login');
            }
        }
    }
    public function create(){

        $this->config->config['pageTitle']=$data['title'] = 'Add Student';

        $this->form_validation->set_rules('access_years', 'Last date of access', 'required');
        $this->form_validation->set_rules('email', 'Email', 'callback_check_email_exists');

        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            // So if it have to display errors it will take back what you entered before

            $school_id= $this->session->userdata('user_id');
            $data['student']=[
                'name'=>$this->input->post('name'),
                'email'=>$this->input->post('email'),
                'access_years'=>$this->input->post('access_years'),
                'all_students'=>$this->student_model->StudentsBySchool($school_id ,6) #bring a max of 6 students
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('students/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // Encrypt password
            $enc_password = md5('123456');
            // $enc_password = md5($this->input->post('password'));

            $this->student_model->create($enc_password);
            // Set message
            $this->session->set_flashdata('created', 'New student has been added');

            redirect('students/create');
        }

    }
    public function check_email_exists($email){
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if($this->student_model->check_email_exists($email)){
            return true;
        } else {
            return false;
        }
    }
    public function change_password($student_id = NULL){
        $this->config->config['pageTitle']=$data['title'] = 'Change password for student';

        $this->form_validation->set_rules('old_password', 'Old password', 'required');
        $this->form_validation->set_rules('password', 'New password', 'required');
        $this->form_validation->set_rules('id', 'Student id', 'required');

        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            $student_id= $this->session->userdata('user_id');
            $data['student']=[
                'student_id' => $student_id,
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('students/change_password', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // Encrypt password
            $enc_password = md5($this->input->post('old_password'));

            $new_password = md5($this->input->post('password'));


            // verify if the old password matches

                #if so update
            if ($this->student_model->verify_password($student_id, $enc_password)) {
                $this->student_model->update_passsword($new_password);
                // Set message
                $this->session->set_flashdata('created', 'Password changed you can now login');

                redirect('students/login');
            }
                # if not report
            else {
                // Set message
                $this->session->set_flashdata('not_matching', 'Passwords do not match try again');

                redirect('students/change_password/'.$student_id);
            }


        }
    }

    public function reset_password($student_id){
        // only the school can do it
        if ($this->session->userdata('userType') != 'school') {
            $this->session->set_flashdata('login_failed', 'Please login as a school first');
            redirect('schools/login');
        }

        $password = md5(123456);
        $this->student_model->update_passsword($password , $student_id);
        $this->session->set_flashdata('created', 'Password reset!');
        redirect('students/index');
    }
}
