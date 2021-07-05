<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses extends CI_Controller {
    public function index()
    {
        die('view all buses irespective of the route');
        
    }
    public function create()
    {

        // form validations

        $this->form_validation->set_rules('plate', 'Plate', 'required');
        $this->form_validation->set_rules('route', 'Route', 'required');

        $this->form_validation->set_rules('plate', 'Plate', 'plate');        

        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something


            $data=
            [
                'plate'=>$this->input->post('plate'),    #validate the plate number
                'route'=>$this->input->post('route_id'),  #the bus is assigned to a single route
                'size'=>$this->input->post('size'),  
                'routes'=>$this->route_model->get_routes()
            ];


            // if routes are empty then we can't add a bus we have to show an error
            if(empty($data['routes'])){
                show_404();
            }


            $this->config->config['pageTitle']= $data['title'] = 'Add bus';
            $this->config->config['notifications']= $this->notification_model->get_unread();



            $this->load->view('templates/header');
            $this->load->view('buses/create', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $this->bus_model->create_bus();            
            // Set message
            $this->session->set_flashdata('bus_created', 'Your bus has been Added');
            
            redirect('routes');
        }
    }

    public function edit($id)
    {
            $data['title'] = 'Edit bus';        
            $data['bus']= $this->bus_model->get_businfo($id);
            $data['bus']['routes']= $this->route_model->get_routes();
            $this->config->config['notifications']= $this->notification_model->get_unread();


            $this->load->view('templates/header');
            $this->load->view('buses/edit', $data);
            $this->load->view('templates/footer');
        
    }
    public function update()
    {
        // form validations

        $this->form_validation->set_rules('plate', 'Plate', 'required');
        $this->form_validation->set_rules('route', 'Route', 'required');

        $this->form_validation->set_rules('plate', 'Plate', 'plate');        

        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something


            $data['bus']=
            [
                'number'=>$this->input->post('plate'),    #validate the plate number
                'route_id'=>$this->input->post('route_id'),  #the bus is assigned to a single route
                'size'=>$this->input->post('size'),  
                'routes'=>$this->route_model->get_routes()
            ];


            // if routes are empty then we can't add a bus we have to show an error
            if(empty($data['routes'])){
                show_404();
            }


            $this->config->config['pageTitle']= $data['title'] = 'Edit bus';
            $this->config->config['notifications']= $this->notification_model->get_unread();



            $this->load->view('templates/header');
            $this->load->view('buses/edit', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $this->bus_model->edit_bus();            
            // Set message
            $this->session->set_flashdata('bus_edited', 'Your bus has been Updated');
            
            redirect('routes');
        }
    }    
   
    public function delete($id)
    {
        $this->bus_model->delete_bus($id);

        // Set message
        $this->session->set_flashdata('bus_deleted', 'Your Bus has been deleted');

        redirect('routes');
    }
}
