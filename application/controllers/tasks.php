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
        $data['xx'] = $this->tasks_model->getAllMyActiveTask($userId);
        // $this->global['managerCount'] = $this->dashboard_model->getManagerCounts();
        // $this->global['employeeCount'] = $this->dashboard_model->getEmployeeCounts();

        $this->loadViews('myTasks', $this->global, $data , NULL);
    }
}

?>