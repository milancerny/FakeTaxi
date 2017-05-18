<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
 
class Car extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();

        //$this->load->model('user_model');
        //$this->load->model('dashboard_model');
        $this->load->model('car_model');

        $this->isLoggedIn();   
    }

    public function index() {
        $this->global['pageTitle'] = 'FakeTaxi: Cars Managment';
        
        // $userId = $this->global['userId'];
        // $data['taskData'] = $this->tasks_model->getActiveTaskDetail($userId);

        $this->loadViews('carsManagment', $this->global, NULL, NULL);
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
            //$count = $this->tasks_model->getAllTasksCount($searchText);
            
            if($this->isAdmin() != TRUE) {
                $count = $this->car_model->carsCountAdmin();
                $returns = $this->paginationCompress( "carsManagment/", $count, 5 );
                $data['carsData'] = $this->car_model->carsPreviewAdmin($returns["page"], $returns["segment"]);
            } else {
                $count = $this->car_model->carsCount($userId);
                $returns = $this->paginationCompress( "carsManagment/", $count, 5 );
                $data['carsData'] = $this->car_model->carsPreview($returns["page"], $returns["segment"], $userId);
            }   
            
            $this->loadViews('carsManagment', $this->global, $data , NULL);
        }
    }

    public function createCar() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'FakeTaxi: Create New Car';
            $userId = $this->global['userId'];
            
            $data["types"] = $this->car_model->carTypes();
            $this->loadViews('createCar', $this->global, $data, NULL);
        }
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'FakeTaxi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>