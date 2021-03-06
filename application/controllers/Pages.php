<?php
	class Pages extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			// if we are loading the home page emit the header and footer cz it has its own

			if ($page=='home')
			{
				$this->load->view('pages/'.$page);
			}
			else
			{
				$data['title'] = ucfirst($page);

				$this->load->view('templates/header');
				$this->load->view('pages/'.$page, $data);
				$this->load->view('templates/footer');
			}

		}

		public function agreement(){
			$data['title']= "User agreement";
			$this->load->view('pages/agreement', $data);
		}
		public function about(){
			$this->load->view('pages/about');
		}
	}
