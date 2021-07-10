<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Steps in search
    *===============
    * 1.break the input words
    * 2. use netested loops one for words others for tables
    * 3. store results in an array
 */


class Search extends CI_Controller {
    public function index()
    {
        // this displays all the resources
        $this->config->config['pageTitle']= $data['title']='Search results';
        $this->config->config['notifications']= $this->notification_model->get_unread();

        $this->form_validation->set_rules('content', 'Search content ', 'required');

        if($this->form_validation->run() === FALSE)
        {
            // means no form was submitted or when validation found something
            $data['search']=[
                'content'=>$this->input->post('content'),
            ];

            $this->config->config['notifications']= $this->notification_model->get_unread();

            $this->load->view('templates/header');
            $this->load->view('search/index', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // tables to search from and the field to search from
            $tables= array(
                array("resources", "title",'resources/resource/') ,
                array('departments', 'name', 'departments/department/'),
                array('school', 'name', 'schools/school/'),
                array('researchers', 'name', 'researchers/researcher/'),
                array('packages', 'name', 'packages/package/')
            );

            # 1.
            $word_array= explode(' ', strip_tags($this->input->post('content')));
            $results= array();

            # 2.
            for ($i=0; $i < sizeof($word_array) ; $i++) {
                for ($j=0; $j < sizeof($tables) ; $j++) {
                    $data= [
                        'table_name' => $tables[$j][0],
                        'column_name' => $tables[$j][1],
                        'word' => $word_array[$i]
                    ];
                    $results[$tables[$j][0]][] = $this->search_model->search($data);
                }
            }

            $data= [
                'results' => $results,
                'content' => $this->input->post('content'),
                'tables' => $tables
            ];

            $this->load->view('templates/header');
            $this->load->view('search/index', $data);
            $this->load->view('templates/footer');
        }
    }
}
?>
