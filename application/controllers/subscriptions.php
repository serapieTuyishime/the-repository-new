<?php
	class Subscriptions extends CI_Controller{
		public function index(){
			$this->config->config['pageTitle']= $data['title']='All subscriptions';
	        $this->config->config['notifications']= $this->notification_model->get_unread();

	        $data['subscriptions'] = $this->subscription_model->get_subscriptions();

	        $this->load->view('templates/header');
	        $this->load->view('subscriptions/index', $data);
	        $this->load->view('templates/footer');
		}
	}
