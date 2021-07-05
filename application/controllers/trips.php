<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trips extends CI_Controller {
    public function index()
    {
        // anyone can view the routes
        $this->config->config['pageTitle']= $data['title']='All trips';
        $this->config->config['notifications']= $this->notification_model->get_unread();
        $data['trips'] = $this->trip_model->get_trips();
        $data['routes']= $this->route_model->get_routes();

        $this->load->view('templates/header');
        $this->load->view('trips/index', $data);
        $this->load->view('templates/footer');
        
    }
    public function create()
    {
        // form validations

        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('bus', 'Bus', 'required');
        
        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something


            $data['trip']=
            [
                'date'=>$this->input->post('date'),    #validate the plate number
                'time'=>$this->input->post('time'),  #the bus is assigned to a single route
                'bus'=>$this->input->post('bus'),  
                'buses'=>$this->bus_model->get_buses()
            ];

            // if buses are empty then we can't add a trip we have to show an error
            if(empty($data['buses'])){
                show_404();
            }


            $this->config->config['pageTitle']= $data['title'] = 'Add trip';
            $this->config->config['notifications']= $this->notification_model->get_unread();



            $this->load->view('templates/header');
            $this->load->view('trips/create', $data);
            $this->load->view('templates/footer');
        } 
        else 
        {
            $this->bus_model->create_bus();            
            // Set message
            $this->session->set_flashdata('trip_created', 'Your Trip has been Added');
            
            redirect('trips');
        }
    }
    public function delete($id)
    {
        $this->bus_model->delete_trip($id);

        // Set message
        $this->session->set_flashdata('trip_deleted', 'The trip has been deleted');

        redirect('trips');
    }
}
