<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
 
class Dashboard extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('tasks_model');
        $this->load->model('dashboard_model');
        $this->isLoggedIn();   
    }

    public function index() {
        $this->global['pageTitle'] = 'Fake Taxi';
        $userId = $this->global['userId'];


        $data['managerCount'] = $this->dashboard_model->getManagerCounts();
        $data['employeeCount'] = $this->dashboard_model->getEmployeeCounts();

        $data['allTasks'] = $this->tasks_model->getAllTasksCount();
        $data['completedTasks'] = $this->tasks_model->getCompletedTasksCount();
        $data['myActiveTasks'] = $this->tasks_model->getAllMyActiveTaskCount($userId);
        

        $this->loadViews('dashboard', $this->global, $data , NULL);
    }
}

?>