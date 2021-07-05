<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {
    public function index()
    {
        $this->config->config['pageTitle']= $data['title']='All departments';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data['departments'] = $this->department_model->getdepartments();

        $this->load->view('templates/header');
        $this->load->view('departments/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        
        $this->config->config['pageTitle']=$data['title'] = 'Add department';

        $this->form_validation->set_rules('name', 'Name', 'callback_check_name_exists');

        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            // So if it have to display errors it will take back what you entered before

            $school_id= $this->session->userdata('user_id');
            $data['department']=[
                'name'=>$this->input->post('name'),
                'all_departments'=> $this->department_model->getdepartments(2) #only bring 2 of them
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('departments/create', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {

            $this->department_model->create();            
            // Set message
            $this->session->set_flashdata('created', 'New department added has been added');
            
            redirect('departments/create');
        }
        
    }
    public function check_name_exists($email){
        $this->form_validation->set_message('check_name_exists', 'That name is taken. Please choose a different one');
        if($this->department_model->check_name_exists($email)){
            return true;
        } else {
            return false;
        }
    }
}
