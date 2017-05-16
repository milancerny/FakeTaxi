<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
 
class Cars extends BaseController {
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
        $this->global['pageTitle'] = 'FakeTaxi: Cars Managment';
        
        // $userId = $this->global['userId'];
        // $data['taskData'] = $this->tasks_model->getActiveTaskDetail($userId);

        $this->loadViews('carsManagment', $this->global, $data , NULL);
    }

    public function carsManagment() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'FakeTaxi: Cars Managment';
            $userId = $this->global['userId'];

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
                
            $this->load->library('pagination');
                
            $count = $this->tasks_model->getAllTasksCount($searchText);
            
            if($this->isAdmin() != TRUE) {
                $count = $this->tasks_model->getAllTasksCountAdmin($this->global['userId']);
                $returns = $this->paginationCompress( "taskManagment/", $count, 5 );
                $data['taskData'] = $this->tasks_model->taskPreviewAdmin($returns["page"], $returns["segment"]);
            } else {
                $count = $this->tasks_model->getAllTasksCount($this->global['userId']);
                $returns = $this->paginationCompress( "taskManagment/", $count, 5 );
                $data['taskData'] = $this->tasks_model->tasksPreview($returns["page"], $returns["segment"], $userId);
            }   
            
            $this->loadViews('carsManagment', $this->global, $data , NULL);
        }
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'FakeTaxi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>