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

            $data["carTypes"] = $this->car_model->getCarTypes();
            $data["carSubTypes"] = $this->car_model->getCarSubTypes();

            /*  REUSE FROM TASK MODEL 
             *  TODO : MAYBE DRIVER MAX 2 cars
             */
            $this->load->model('tasks_model');
            if($this->isAdmin() != TRUE) {
                $data["drivers"] = $this->tasks_model->getSolversAdmin();
            } else {
                $data["drivers"] = $this->tasks_model->getSolvers($userId);
            }
            $this->loadViews('createCar', $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to create new task to the system
     */
    function createNewCar() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('carType','Car Type *','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('carSubType','Car Sub Type *','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('ecv','EČV *','trim|required|max_length[8]|xss_clean');
            $this->form_validation->set_rules('vin','VIN *','trim|required|max_length[17]|xss_clean');
            $this->form_validation->set_rules('driver','Driver','trim|numeric');
            $this->form_validation->set_rules('totalKm','KM *','trim|required|numeric');
            $this->form_validation->set_rules('color','Color *','trim|required|max_length[100]|xss_clean');
            
            if($this->form_validation->run() == FALSE) {
                $this->createCar();
            } else {
                $carType = $this->input->post('carType');
                $carSubType = $this->input->post('carSubType');
                $ecv = $this->input->post('ecv');
                $vin = $this->input->post('vin');
                $driver = $this->input->post('driver');
                $totalKm = $this->input->post('totalKm');
                $color = $this->input->post('color');

                /* glogbal params */
                $createdBy = $this->global['userId'];
                
                $carInfo = array('carSubId'=>$carSubType, 'carSubTypeId'=>$carType, 'createdDate'=>date('Y-m-d'), 'ECV'=> $ecv, 'VIN'=> $vin, 'totalCountKm'=> $totalKm,
                                    'driverId'=> $driver, 'createdBy'=>$createdBy, 'updatedBy'=> NULL, 'color'=>$color);
                #'createdDate'=>date('Y-m-d'), 'updatedDate'=>date('Y-m-d'),
                
                $result = $this->car_model->createNewCar($carInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'New car was created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Car creation failed');
                }
                
                redirect('createCar');
            }
        }
    }

    function createNewCarType() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('cType','Car Type *','trim|required|max_length[100]|xss_clean');
            
            if($this->form_validation->run() == FALSE) {
                $this->createCar();
            } else {
                $carType = $this->input->post('cType');
                $result = $this->car_model->getCarTypes();
                
                $phpArr = json_decode(json_encode($result), true);

                $aLength = sizeof($phpArr);
                $count=0;
                foreach($phpArr as $item) {
                    // TODO: check case sensitive
                    if(!in_array($carType, $item, true)) {
                        $count++; 
                    }
                }

                if($aLength == $count) {
                    $carInfo = array('type'=>$carType);
                    $result = $this->car_model->createNewCarType($carInfo);
                
                    if($result > 0) {
                        $this->session->set_flashdata('success', 'New car type was created successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Car type creation failed');
                    }
                        
                    redirect('createCar');
                } else {
                    $this->session->set_flashdata('error', 'Car type exist!');
                    redirect('createCar');
                }
            }
        }
    }

    function createNewCarSubType() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cSubType','Car Sub Type *','trim|required|max_length[100]|xss_clean');
            
            if($this->form_validation->run() == FALSE) {
                $this->createCar();
            } else {
                $carSubType = $this->input->post('cSubType');
                $carTypeId = $this->input->post('csType');

                $result = $this->car_model->getCarSubTypes();
                
                $phpArr = json_decode(json_encode($result), true);
                $aLength = sizeof($phpArr); // full array length
                $count=0;
                foreach($phpArr as $item) {
                    // TODO: check case sensitive, now it is only exact match !!
                    if(!in_array($carSubType, $item, true)) {
                        $count++; 
                    }
                }

                if($aLength == $count) {
                    $carInfo = array('subType'=>$carSubType, 'carTypeId'=>$carTypeId);
                    $result = $this->car_model->createNewCarSubType($carInfo);
                
                    if($result > 0) {
                        $this->session->set_flashdata('success', 'New car sub type was created successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Car sub type creation failed');
                    }
                        
                    redirect('createCar');
                } else {
                    $this->session->set_flashdata('error', 'Car sub type exist!');
                    redirect('createCar');
                }
            }
        }
    }

    /**
     * This function is used to delete the car using id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCar() {
        if($this->isAdmin() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        } else {
            $rowId = $this->input->post('id');
            
            $detailInfo = array('isDeleted'=>1,'updatedBy'=>$this->global['userId'], 'updatedDate'=>date('Y-m-d'));
            $result = $this->car_model->deleteCar($rowId, $detailInfo);

            if($result > 0) {
                $this->session->set_flashdata('success', 'Car was deleted successfully');
                echo(json_encode(array('status'=>TRUE)));
            } else { 
                $this->session->set_flashdata('error', 'Car deletion failed');
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'FakeTaxi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>