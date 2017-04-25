<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
 
class Tasks extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();

        //$this->load->model('user_model');
        //$this->load->model('dashboard_model');
        $this->load->model('tasks_model');

        $this->isLoggedIn();   
    }

    public function index() {
        $this->global['pageTitle'] = 'My open tasks';
        
        $userId = $this->global['userId'];
        $data['taskData'] = $this->tasks_model->getAllMyActiveTask($userId);

        $this->loadViews('myTasks', $this->global, $data , NULL);
    }

    public function taskManagment() {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Task Managment';

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
                
            $this->load->library('pagination');
                
            //$count = $this->user_model->userListingCount($searchText);
            $count = $this->tasks_model->getAllTasksCount();
            $returns = $this->paginationCompress( "taskManagment/", $count, 5 );
            $data['taskData'] = $this->tasks_model->getAllTasks($returns["page"], $returns["segment"]);
                
            $this->loadViews('taskManagment', $this->global, $data , NULL);
        }
    }



    function pageNotFound() {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>