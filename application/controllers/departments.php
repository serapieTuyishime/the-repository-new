<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {
    public function index()
    {
        if ($this->session->userdata('userType') != 'admin') {
            redirect('departments/show');
        }
        $this->config->config['pageTitle']= $data['title']='All departments';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data= [
            'departments' => $this->department_model->getdepartments(),
        ];

        $this->load->view('templates/header');
        $this->load->view('departments/index', $data);
        $this->load->view('templates/footer');
    }

    // for the public who are not logged in
    public function show()
    {
        $this->config->config['pageTitle']= $data['title']='All departments';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data= [
            'departments' => $this->department_model->getdepartments(),
        ];

        // die(print_r($data));

        $this->load->view('templates/header');
        $this->load->view('departments/show', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        if ($this->session->userdata('userType') != 'admin') {
            redirect('departments/show');
        }

        $this->config->config['pageTitle']=$data['title'] = 'Add department';

        $this->form_validation->set_rules('name', 'Name', 'callback_check_name_exists');


        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            // So if it have to display errors it will take back what you entered before

            $school_id= $this->session->userdata('user_id');
            $data['department']=[
                'name'=>$this->input->post('name'),
                'all_departments'=> $this->department_model->getdepartments( FALSE,2) #only bring 2 of them
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

    // view all reosurces in a department
    public function department($id, $offset=0){

        $department_name= $this->department_model->getdepartments($id)['name'];
        // this displays all the resources
        $this->config->config['pageTitle']= $data['title']='Resources in '.$department_name. ' topic';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $all_resources = empty($this->resources_model->resources_by_department($id)) ? 0 : sizeof($this->resources_model->resources_by_department($id));


        // Pagination Config
		$config['base_url'] = base_url() . 'departments/department/'.$id.'/';
		$config['total_rows'] = $all_resources;
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

		// Init Pagination
		$this->pagination->initialize($config);


        $data['resources'] = $this->resources_model->resources_by_department($id , $config['per_page'], $offset);
        $this->load->view('templates/header');
        $this->load->view('departments/resources', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id){
        if ($this->session->userdata('userType') != 'admin') {
            redirect('departments/show');
        }

        $this->config->config['pageTitle']= $data['title']='All departments';
        $this->config->config['notifications'] = $this->notification_model->get_unread();

        $department_info= $this->department_model->getdepartments($id); #info for one dept by ID
        $this->form_validation->set_rules('name', 'Name', 'callback_check_name_exists');

        if($this->form_validation->run() === FALSE)
        {

            $data['department']=[
                'name'=>$department_info['name'],
                'id'=>$department_info['id'],
                'all_departments'=> $this->department_model->getdepartments(FALSE, 2) #only bring 2 of them
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('departments/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {

            $this->department_model->update($id);
            // Set message
            $this->session->set_flashdata('created', 'Department has been edited');

            redirect('departments/index');
        }
    }

    public function delete($id){
        // check loggin
        if ($this->session->userdata('userType') != 'admin') {
            $this->session->set_flashdata('login_failed', 'An admin should be only allowed to delete a department');
            redirect ('admins/login');
        }
        else {
            $this->department_model->delete($id);
            $this->session->set_flashdata('created', 'Department deleted');
            redirect ('departments/index');
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
