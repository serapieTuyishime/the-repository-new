<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resources extends CI_Controller {
    public function index($offset = 0)
    {
        // Pagination Config
		$config['base_url'] = base_url() . 'resources/index/';
		$config['total_rows'] = $this->db->count_all('resources');
		$config['per_page'] = 6;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

		// Init Pagination
		$this->pagination->initialize($config);

        // this displays all the resources
        $this->config->config['pageTitle']= $data['title']='Resources';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $data['resources'] = $this->resources_model->get_resources(FALSE , $config['per_page'], $offset);
        // die(print_r($data));
        $this->load->view('templates/header');
        $this->load->view('resources/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        if ($this->session->userdata('userType') != 'researcher') {
            $this->session->set_flashdata('login_failed', 'Only the researcher can upload');
            redirect('researchers/login');
        }

        $this->config->config['pageTitle']=$data['title'] = 'Upload a resource';

        $this->form_validation->set_rules('name', 'Research title', 'required|callback_check_name_exists');
        $this->form_validation->set_rules('description', 'Abstract', 'required');  #for abstract
        $this->form_validation->set_rules('price', 'Price', 'required');


        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something

            $data['resource']=[
                'title'=>$this->input->post('name'),
                'price'=>$this->input->post('price'),
                'description'=>$this->input->post('description'),
                'all_departments'=> $this->department_model->getdepartments() #get departments to select from when creating a package
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('resources/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // create a slug title
            $title_slug = url_title($this->input->post('name'));  # ex : the-repository-project

            $cwd = getcwd(); // save the current working directory
			$document_file_path = $cwd."\\assets\\documents\\resources\\";  #where we want to create the folder
            chdir($document_file_path);  # go to theat directory

            // create a folder there with a slug as a name
            mkdir($title_slug);
            // set up configuration
            $config['upload_path'] = $document_file_path.$title_slug;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '10240'; #10MB
            // die(print_r($config));

            $this->load->library('upload', $config); #the library for uploading images and other documents

            if(!$this->upload->do_upload()){
                $errors = array('error' => $this->upload->display_errors());

                // its better to delete the directory that we created before
                    chdir($document_file_path);    # go to resources folder
                    rmdir($title_slug); #delete the folder

                # do not upload when there are errors with the file
                $this->session->set_flashdata('not_matching', 'Problems with the file being uploaded');

                redirect('resources/create');
                die();
            } else {
                $data = array('upload_data' => $this->upload->data());
                $file_name = $_FILES['userfile']['name'];

                // then write the abstract in a separate text file
                $myfile= fopen($document_file_path.'/'.$title_slug.'/abstract.txt', 'w');
				fwrite($myfile, $this->input->post('description'));
				fclose($myfile);
            }

            // register other details in database

            $this->resources_model->register($file_name);

            // Set message
            $this->session->set_flashdata('created', 'Done uploading resource');

            redirect('resources/index');

        }


    }

    public function edit($id)
    {
        if ($this->session->userdata('userType') != 'researcher') {
            $this->session->set_flashdata('login_failed', 'Oly the researcher cam update');
            redirect('researchers/login');
        }

        $this->form_validation->set_rules('price', 'Price', 'required');

        $resource_info =$this->resources_model->get_resources($id);
        $this->config->config['pageTitle']=$data['title'] = 'Update '. $resource_info['title']. ' info';

        // check if the author id equals the logged in Id
        if ($resource_info['researcher_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('not_matching', 'This resource may not be yours');
            redirect('resources/index');
        }

        $cwd = getcwd(); // save the current working directory
        $document_file_path = $cwd."\\assets\\documents\\resources\\".$resource_info['title_slug'];

        // get the contents of the abstract document saved there

        if (file_exists($document_file_path.'\\abstract.txt')) {
            $abstract_contents= file_get_contents($document_file_path.'\\abstract.txt');
        }
        else {
            $abstract_contents = 'Unable to read contents of the abstract';
        }


        if($this->form_validation->run() === FALSE)
        {

            $data['resource']=[
                'id'=>$resource_info['id'],
                'title'=>$resource_info['title'],
                'price'=>$resource_info['price'],
                'department'=>$resource_info['department'],
                'description'=>$abstract_contents, # for the abstract
                'all_departments'=> $this->department_model->getdepartments() #get departments to select from when creating a package
            ];
            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('resources/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {

            // update the abstract
            $myfile= fopen($document_file_path.'\abstract.txt', 'w');
			fwrite($myfile, trim($this->input->post('description')));
			fclose($myfile);

            // register other details in database

            $this->resources_model->update($id);

            // Set message
            $this->session->set_flashdata('created', 'Done Updating resource');

            redirect('resources/index');
        }

    }
    public function check_name_exists($title){
        $this->form_validation->set_message('check_name_exists', 'That Title has arleady been used. Please choose a different one');
        if($this->resources_model->check_name_exists($title)){
            return true;
        } else {
            return false;
        }
    }
    public function resource($id){

        $this->config->config['notifications']= $this->notification_model->get_unread();
        $resource_info =$this->resources_model->get_resources($id);

        $this->config->config['pageTitle']= $data['title']=$resource_info['title'].' resource';

        // read abstract contants from the folder

        $cwd = getcwd(); // save the current working directory
        $document_file_path = $cwd."\\assets\\documents\\resources\\";  #where we want to create the folder
		if (file_exists($document_file_path .$resource_info['title_slug']. "/abstract.txt")) {

            $file = fopen($document_file_path .$resource_info['title_slug']. "/abstract.txt", "r");
            $abstract= fgets($file). "";
        }
        else {
            $abstract = 'Unable to read contents of the abstract';
        }


        $data=[
            'resource' => $resource_info,
            'abstract' => $abstract,
            'resources_by_research' => $this->researcher_model->get_resources_by_author($resource_info['researcher_id'], 6),
            'researcher' => $this->researcher_model->get_researcher($resource_info['researcher_id']),
            'downloads'=> $this->resources_model->countDownloads($id),
            'saves' => $this->resources_model->getSaves($id),
        ];

        // die(print_r($data));
        $this->load->view('templates/header');
        $this->load->view('resources/single', $data);
        $this->load->view('templates/footer');
    }
    public function download($resource_id){
        // check login
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('login_failed', 'Please login first to download the file');
			redirect('students/login');
		}

        $resource_info =$this->resources_model->get_resources($resource_id);

        switch ($this->session->userdata('userType')) {
            case 'researcher':
                header('location:' .base_url() .'resources/resource/'. $resource_id);
                die();
                break;
            case 'student':

                /*
                * the student's username ex 2-34; the first section is the school's id
                */
                $school_id= explode('-', $this->session->userdata('username'))[0];

                // check if the student's school have an active subscription
                if ($this->school_model->subscribed($school_id)) {
                    die('Check the subscribed package details to check if the resource\'s department is covered');
                    $data= array (
        				'title' => $resource_info['title'],
        				'resource_id' => $resource_info['id'],
        				'student_id' => $this->session->userdata('username'),
                        'client_id' => NULL,
                        'on_subscription' => TRUE
        			);

                    $this->resources_model->saveDownload($data);
                    // download the file
                }
                else {
                    $this->session->set_flashdata('not_matching', 'Your school do not have an active subscription');
                    header('location:' .base_url() .'resources/resource/'. $resource_id);
                    die();
                }

                break;
            case 'client':
                $data= array (
                    'title' => $resource_info['title'],
                    'resource_id' => $resource_info['id'],
                    'student_id' => NULL,
                    'client_id' => $this->session->userdata('user_id'),
                    'on_subscription' => FALSE
                );

                $this->resources_model->saveDownload($data);

                $cwd = getcwd();
                $filepath = $cwd."\\assets\\documents\\resources\\" .$resource_info['title_slug']. "\\". $resource_info['file'];  # actual file for download
        		if (file_exists($filepath)) {

                    header('Content-Description: File Transfer');
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    flush(); // Flush system output buffer
                    readfile($filepath);
                }
                else {
                    $this->session->set_flashdata('not_matching', 'Unable to download the file Please try other resources');
                    header('location:' .base_url() .'resources/resource/'. $resource_id);
                    die();
                }

            default:
                $this->session->set_flashdata('not_matching', 'Errors present please try logging out and logging in');
                redirect ('resources/index');
                break;
        }
    }

    public function save_for_later($id){
        if (!$this->session->userdata('logged_in'))
        {
            $this->session->set_flashdata('not_matching', 'Note logged in !.. unable to save for later');
            header('location:' .base_url() .'resources/resource/'. $id);
            die();
        }

        $this->resources_model->save_for_later($id);

        $this->session->set_flashdata('created', 'File saved to my profile');
        header('location:' .base_url() .'resources/resource/'. $id);
        die();
    }
}

?>
