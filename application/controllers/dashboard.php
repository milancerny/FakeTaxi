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
        $roleId = $this->global['role'];
        //print_r($this);

        $data['managerCount'] = $this->dashboard_model->getManagerCounts();
        

        $data['myActiveTasks'] = $this->tasks_model->getActiveTaskCount($userId);

        if($userId == ROLE_ADMIN) { // if admin see all tasks statistics
            $data['employeeCount'] = $this->dashboard_model->getEmployeeCountsAdmin(); //podriadeni zamestnanci
            $data['completedTasks'] = $this->tasks_model->getCompletedTasksCountAdmin();
            $data['allTasks'] = $this->tasks_model->getAllTasksCountAdmin();
        } else {
            $data['employeeCount'] = $this->dashboard_model->getEmployeeCounts($userId); //podriadeni zamestnanci
            $data['completedTasks'] = $this->tasks_model->getCompletedTasksCount($userId);
            $data['allTasks'] = $this->tasks_model->getAllTasksCount($userId);
        }

        $this->loadViews('dashboard', $this->global, $data , NULL);
    }
}

?>