<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends CI_Controller {
    public function index()
    {
        $this->config->config['pageTitle']= $data['title']='All Packages';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data['packages'] = $this->package_model->get_packages();

        $this->load->view('templates/header');
        $this->load->view('packages/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        if ($this->session->userdata('userType') != 'admin') {
            redirect('packages/index');
        }

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

    public function edit($id)
    {
        if ($this->session->userdata('userType') != 'admin') {
            redirect('packages/index');
        }

        $this->config->config['pageTitle']=$data['title'] = 'Update Package info';

        $this->form_validation->set_rules('name', 'Name', 'required|callback_check_name_exists');
        $this->form_validation->set_rules('departments[]', 'package departments', 'required');
        $package_info = $this->package_model->get_package($id);
        $package_details = $this->package_model->get_details($id);

        // get package's departments in one array
        $departments = array();
        if (!empty($package_details)) {
            foreach ($package_details as $key => $value) {
                $departments[] = $value['department_id'];
            }
        }

        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            $data['package']=[
                'id'=>$package_info['id'],
                'name'=>$package_info['name'],
                'price'=>$package_info['price'],
                'description'=>$package_info['description'],
                'departments' => $departments,
                'all_departments'=> $this->department_model->getdepartments() #get departments to select from when creating a package
            ];
            // die(print_r($data));

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('packages/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // delete the previous selected departments in the detailss table
            $this->package_model->delete_details($id);
            // create a package then add the details in a table
            $this->package_model->update($id);
            // Set message
            $this->session->set_flashdata('created', 'Package edited');

            redirect('packages/index');
        }

    }

    public function delete($id){
        if ($this->session->userdata('userType') != 'admin') {
            redirect('packages/index');
        }
        // delete the details assigned to the package
        $this->package_model->delete_details($id);

        // delete the actual package
        $this->package_model->delete($id);

        $this->session->set_flashdata('deleted', 'Package successful deleted');
        redirect('packages/index');
    }

    public function package($package_id){
        // purely informative page

        $package_info = $this->package_model->get_package($package_id);

        $this->config->config['pageTitle']= $data['title']='Info for '. $package_info['name'];
        $this->config->config['notifications']= $this->notification_model->get_unread();


            $data['package']=[
                'package_info' => $package_info,
                'details'=> $this->package_model->get_details($package_id),
                'all_packages' => $this->package_model->get_packages(5) #limit
            ];
        $this->load->view('templates/header');
        $this->load->view('packages/single', $data);
        $this->load->view('templates/footer');
    }

    public function subscribe($package_id)
    {
        // redirect to the page for selecting the months of subscription

        $package_info = $this->package_model->get_package($package_id);
        $this->config->config['pageTitle']=$data['title'] = 'Subscribe for '.$package_info['name'];

        $this->form_validation->set_rules('months', 'Months', 'required');

        // get school id and username
        $school_id = $this->session->userdata('user_id');
        $school_username = $this->session->userdata('username');

        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            $data['package']=[
                'months'=>$this->input->post('months'),
                'school_id'=>$school_id,
                'package_info' => $package_info,
                'all_packages' => $this->package_model->get_packages(5) #limit
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('packages/subscribe', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // only the school can susbscribe to a package
            if ($this->session->userdata('userType') != 'school') {
                $this->session->set_userdata('to_where', 'packages_subscribe_'.$package_id);
                $this->session->set_flashdata('login_failed', 'Login as a school first');
                redirect('schools/login');
            }
            // create a package then add the details in a table
            $subscription_id = $this->package_model->subscribe($package_id);

            // check if the school have enough coins the activate it or not
            $school_balance= $this->payment_model->check_balance($school_username, 'school')['balance'];
            $total_cost = $package_info['price'] * $this->input->post('months');

            if ($school_balance >= $total_cost) {
                // reduce the balance then activate the package
                $newbalance= $school_balance- $total_cost;
                $this->payment_model->update_client_price($newbalance, $school_username, 'school');
                $this->package_model->activate_package($subscription_id);

                // record the transaction
                $transaction_data=
                [
                    'type'=>'in',
                    'details'=> 'Activation of subscription '. $subscription_id,
                    'amount'=> $total_cost,
                    'reference_no'=> $school_username,
                ];
                // die(print_r($transaction_data));
                $this->payment_model->create_transaction($transaction_data);

                $this->session->set_flashdata('created', 'Subscription activated and your balance reduced by '.$total_cost);
            }
            else {
                $this->session->set_flashdata('created', 'Subscription will be updated upon payment');
            }


            redirect('dashboard/index');
        }
    }

    public function activate($subscription_id){
        if ($this->session->userdata('userType') != 'school') {
            $this->session->set_userdata('to_where', 'packages_activate_'.$subscription_id);
            $this->session->set_flashdata('login_failed', 'Login as a school first');
            redirect('schools/login');
        }
        $school_username = $this->session->userdata('username');
        $school_balance= $this->payment_model->check_balance($school_username, 'school')['balance'];
        $subscription_info = $this->subscription_model->get_subscriptions($subscription_id);

        // calculate total months subscribed for

        $date1 = new DateTime($subscription_info['date_start']);
        $date2 = new DateTime($subscription_info['date_end']);
        $interval = $date1->diff($date2);
        $months= round($interval->days / 30);  # months subscribed

        // get the price of the package
        $package_id = $subscription_info['package_id'];
        $package_price= $this->package_model->get_package($package_id)['price'];

        $total_cost= $package_price *  $months;

        if ($school_balance >= $total_cost) {
            // reduce the balance then activate the package
            $newbalance= $school_balance- $total_cost;

            $this->payment_model->update_client_price($newbalance, $school_username, 'school');
            $this->package_model->activate_package($subscription_id);

            // record the transaction
            $transaction_data=
            [
                'type'=>'in',
                'details'=> 'Activation of subscription '. $id,
                'amount'=> $total_cost,
                'reference_no'=> $school_username,
            ];
            $this->payment_model->create_transaction($transaction_data);

            $this->session->set_flashdata('created', 'Subscription activated and your balance reduced by '.$total_cost);
        }
        else {
            $this->session->set_flashdata('not_matching', 'You do not have sufficient balance to activate the package');
        }
        redirect('dashboard/index');


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
