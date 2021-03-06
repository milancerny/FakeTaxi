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
        $data['taskData'] = $this->tasks_model->getActiveTaskDetail($userId);

        $this->loadViews('myTasks', $this->global, $data , NULL);
    }

    public function taskManagment() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Task Managment';
            $userId = $this->global['userId'];

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
                
            $this->load->library('pagination');
                
            //$count = $this->tasks_model->getAllTasksCount($searchText);
            
            if($this->isAdmin() != TRUE) {
                $count = $this->tasks_model->getAllTasksCountAdmin($this->global['userId']);
                $returns = $this->paginationCompress( "taskManagment/", $count, 5 );
                $data['taskData'] = $this->tasks_model->taskPreviewAdmin($returns["page"], $returns["segment"]);
            } else {
                $count = $this->tasks_model->getAllTasksCount($this->global['userId']);
                $returns = $this->paginationCompress( "taskManagment/", $count, 5 );
                $data['taskData'] = $this->tasks_model->tasksPreview($returns["page"], $returns["segment"], $userId);
            }   
            
            $this->loadViews('taskManagment', $this->global, $data , NULL);
        }
    }

    public function createTask() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Create New Task';
            $userId = $this->global['userId'];

            if($this->isAdmin() != TRUE) {
                $data["solvers"] = $this->tasks_model->getSolversAdmin();
            } else {
                $data["solvers"] = $this->tasks_model->getSolvers($userId);
            }
            $this->loadViews('createTask', $this->global, $data , NULL);
        }
    }

    /**
     * This function is used to create new task to the system
     */
    function createNewTask() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fsubject','Subject','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('fdes','Description','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('dueDate','Due date','required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('solver','Solver','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE) {
                $this->createTask();
            } else {
                $subject = ucwords(strtolower($this->input->post('fsubject')));
                $description = $this->input->post('fdes');
                $dueDate = $this->input->post('dueDate');
                $solver = $this->input->post('solver');

                /* glogbal params */
                $createdBy = $this->global['userId'];
                $updatedBy = $this->global['userId'];
                
                $userInfo = array('subject'=>$subject, 'description'=>$description, 'dueDate'=>$dueDate, 'userId'=> $solver,
                                    'createdBy'=>$createdBy, 'updatedBy'=>$updatedBy, 'isDeleted' => 0, 'isCompleted' => 0);
                #'createdDate'=>date('Y-m-d'), 'updatedDate'=>date('Y-m-d'),
                
                //print_r($userInfo);
                $this->load->model('tasks_model');
                $result = $this->tasks_model->createNewTask($userInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'New Task was created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }
                
                redirect('createTask');
            }
        }
    }

    /**
     * This function is used to delete the task using taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTask() {
        if($this->isAdmin() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        } else {
            $taskId = $this->input->post('taskId');
            
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->global['userId'], 'updatedDate'=>date('Y-m-d'));
            
            $result = $this->tasks_model->deleteTask($taskId, $userInfo);
            
            if($result > 0) {
                $this->session->set_flashdata('success', 'Task was deleted successfully');
                echo(json_encode(array('status'=>TRUE)));
            } else { 
                $this->session->set_flashdata('error', 'Task deletion failed');
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    /**
     * This function is used load task edit information
     * @param number $taskId : Optional : This is taskId
     */
    function loadOldTask($taskId = NULL) {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            if($taskId == null) {
                redirect('taskManagment');
            }
            $userId = $this->global["userId"];
            $data["solvers"] = $this->tasks_model->getSolvers($userId);
            $data['taskInfo'] = $this->tasks_model->getTaskInfo($taskId);

            foreach($data['taskInfo'] as $record) {
                if($record->isCompleted == 1) {
                    redirect('taskManagment');
                }
            }

            $this->global['pageTitle'] = 'FakeTaxi : Edit Task';
            $this->loadViews("editOldTask", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to update the task information
     */
    function updateTask() {
        if(($this->isAdmin() == TRUE) && ($this->isManager() == TRUE)) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fsubject','Subject','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('fdes','Description','trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('dueDate','Due date','required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('solver','Solver','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE) {
                $this->loadOldTask($taskId);
            } else {
                $taskId = $this->input->post('taskId');

                $subject = ucwords(strtolower($this->input->post('fsubject')));
                $description = $this->input->post('fdes');
                $dueDate = $this->input->post('dueDate');
                $solver = $this->input->post('solver');
                
                $updatedBy = $this->global['userId'];
                
                $taskInfo = array('subject'=>$subject, 'description'=>$description, 'dueDate'=>$dueDate, 'userId'=> $solver,
                                    'updatedBy'=>$updatedBy);

                $this->load->model('tasks_model');
                $result = $this->tasks_model->updateTask($taskId, $taskInfo);
                
                if($result == true) {
                    $this->session->set_flashdata('success', 'Task was updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task update failed');
                }
                
                redirect('taskManagment');
            }
        }
    }

    function successTask() {
        $taskId = $this->input->post('taskId');
        $taskInfo = array('isCompleted'=>1);

        // print_r("AAA".$taskId);
        //print_r($taskInfo);
        $this->load->model('tasks_model');
        $result = $this->tasks_model->updateTask($taskId, $taskInfo);
                
        if($result == true) {
            $this->session->set_flashdata('success', 'Task was updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Task update failed');
        }        
        redirect('tasks');
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'FakeTaxi : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>