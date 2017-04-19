<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
 
class Dashboard extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('dashboard_model');
        $this->isLoggedIn();   
    }

    public function index() {
        $this->global['pageTitle'] = 'Fake Taxi';

        $this->global['managerCount'] = $this->dashboard_model->getManagerCounts();
        $this->global['employeeCount'] = $this->dashboard_model->getEmployeeCounts();

        $this->loadViews('dashboard', $this->global, NULL , NULL);
    }
}

?>