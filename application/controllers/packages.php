<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends CI_Controller {
    public function index()
    {
        $this->config->config['pageTitle']= $data['title']='All Packages';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data['packages'] = $this->package_model->get_packages();

        // die(print_r($data['packages']));

        $this->load->view('templates/header');
        $this->load->view('packages/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {

        $this->config->config['pageTitle']=$data['title'] = 'Add Package';

        $this->form_validation->set_rules('name', 'Name', 'required|callback_check_name_exists');
        $this->form_validation->set_rules('departments[]', 'package departments', 'required');


        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            $data['package']=[
                'name'=>$this->input->post('name'),
                'price'=>$this->input->post('price'),
                'description'=>$this->input->post('description'),
                'all_departments'=> $this->department_model->getdepartments() #get departments to select from when creating a package
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('packages/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // create a package then add the details in a table
            $this->package_model->create();
            // Set message
            $this->session->set_flashdata('created', 'New package added has been added');

            redirect('packages/index');
        }

    }
    public function check_name_exists($email){
        $this->form_validation->set_message('check_name_exists', 'That name is taken. Please choose a different one');
        if($this->package_model->check_name_exists($email)){
            return true;
        } else {
            return false;
        }
    }
}
