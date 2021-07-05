<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends CI_Controller {
    public function index()
    {
        // anyone can view the routes
        $data['title']='All routes';
        $this->config->config['pageTitle']='All routes';
        $this->config->config['notifications']= $this->notification_model->get_unread();
        $data['routes'] = $this->route_model->get_routes();

        $this->load->view('templates/header');
        $this->load->view('routes/index', $data);
        $this->load->view('templates/footer');
        
    }
    public function create()
    {
        
        $this->config->config['pageTitle']=$data['title'] = 'Create route';

        // form validations

            // the destination and departure must be text and required and the price must be a number greater than 0 
                

        $this->form_validation->set_rules('depart', 'Departure', 'alpha');        
        $this->form_validation->set_rules('destination', 'Destination', 'alpha');

        $this->form_validation->set_rules('price', 'Price', 'numeric');

        $this->form_validation->set_rules('depart', 'Departure', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');



        // die('jkdsdjkd');

        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something


            $data['route']=
            [
                'destination'=>$this->input->post('destination'),
                'depart'=>$this->input->post('depart'),
                'amount'=>$this->input->post('price')
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('routes/create', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $this->route_model->create_route();            
            // Set message
            $this->session->set_flashdata('route_created', 'Your route has been created');
            
            redirect('routes');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'Edit route';        
        $data['route']= $this->route_model->get_routeinfo($id);

        $this->config->config['notifications']= $this->notification_model->get_unread();

        $this->load->view('templates/header');
        $this->load->view('routes/edit', $data);
        $this->load->view('templates/footer');
        
    }
    public function update()
    {
        $data['title'] = 'Edit route';

        $this->form_validation->set_rules('depart', 'Departure', 'alpha');        
        $this->form_validation->set_rules('destination', 'Destination', 'alpha');

        $this->form_validation->set_rules('price', 'Price', 'numeric');

        $this->form_validation->set_rules('depart', 'Departure', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');



        // die('jkdsdjkd');

        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something


            
            $data['route']=
            [
                'destination'=>$this->input->post('destination'),
                'depart'=>$this->input->post('depart'),
                'amount'=>$this->input->post('price'),
                'id'=>$this->input->post('id'),
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('routes/edit', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $this->route_model->edit_route();            
            // Set message
            $this->session->set_flashdata('route_edited', 'Your route has been Edited');
            
            redirect('routes');
        }
    }
    public function delete($id)
    {
        $this->route_model->delete_route($id);

        // Set message
        $this->session->set_flashdata('route_deleted', 'Your route has been deleted');

        redirect('routes');
    }
    public function view($id)
    {
        // view all buses on this route

        $this->config->config['pageTitle']= $data['title'] = 'All buses in '.$this->route_model->get_routeinfo($id)['name'].' route';

        $data['buses'] = $this->bus_model->get_buses_by_route($id);

        $this->config->config['notifications']= $this->notification_model->get_unread();

        $this->load->view('templates/header');
        $this->load->view('routes/buses', $data);
        $this->load->view('templates/footer');
    }
}
