<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    /**
     * This function is used to get all user active tasks,
     * used only  in task controller for show task detail in my task category
     * @param number $userId : This is userId
     * @return array $result : Task info
     */
    function getActiveTaskDetail($userId) {
        $this->db->select('*, isDeleted');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $this->db->where('isDeleted !=', 1);
        $this->db->where('isCompleted !=', 1);
        $query = $this->db->get();

        return $query->result();
        //SELECT * FROM tbl_task WHERE tbl_task.userId=$userId AND isDeleted !=1 AND isCompleted != 1
    }

    /**
     * This function is used to get count of all user active tasks,
     * used only  in dashboard controller for show task count
     * @param number $userId : This is userId
     * @return number $result : Active task count
     */
    function getActiveTaskCount($userId) {
        $this->db->select('*, isDeleted');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $this->db->where('isDeleted !=', 1);
        $this->db->where('isCompleted !=', 1);
        $query = $this->db->get();

        return count($query->result());
    }

   /**
     * This function is used to get count of all completed tasks e.g.(manager+employee),
     * used only  in dashboard
     * @param number $userId : This is userId
     * @return number $result : Active task count
     */
    function getCompletedTasksCount($userId) {

        $q = "SELECT t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior ".
        "FROM tbl_task t JOIN tbl_users u ON t.userId=u.userId WHERE t.isDeleted !=1 AND t.isCompleted=1 AND (u.userId=".$userId." OR u.superior=".$userId.")";
        
        $query = $this->db->query($q); 
        // $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior');
        // $this->db->from('tbl_task t');
        // $this->db->join('tbl_users u', 't.userId=u.userId','left'); 
        // $this->db->where('t.isDeleted !=', 1);
        // $this->db->where('t.isCompleted', 1);
        // $this->db->where('u.superior', $userId);
        // $this->db->where('u.userId', $userId);
        // $query = $this->db->get();

        return count($query->result());
        // SELECT t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior FROM 
        // tbl_task t JOIN tbl_users u ON t.userId=u.userId WHERE t.isDeleted !=1 AND t.isCompleted=1 AND (u.userId=2 OR u.superior=2)
    }

    /**
     * This function is used to get count of all tasks e.g.(manager+employee),
     * used in dashboard and task list as pagination
     * @param number $userId : This is userId
     * @return number $result : All tasks count. I and my employee
     */
    function getAllTasksCount($userId) {
        $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users u', 't.userId=u.userId','left'); 
        $this->db->where('t.isDeleted !=', 1);
        $this->db->where('u.superior', $userId);
        $this->db->or_where('u.userId', $userId);
        $query = $this->db->get();

        return count($query->result());
    }

    function getCompletedTasksCountAdmin() {
        $this->db->select('t.taskId, t.isDeleted, t.isCompleted');
        $this->db->from('tbl_task t');
        $this->db->where('t.isDeleted !=', 1);
        $this->db->where('t.isCompleted', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    function getAllTasksCountAdmin() {
        $this->db->select('t.taskId');
        $this->db->from('tbl_task t');
        $this->db->where('t.isDeleted !=', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    function tasksPreview($page, $segment, $userId) {
        $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users u', 't.userId=u.userId','left');   
        $this->db->where('t.isDeleted !=', 1); //show only valid getAllTasks
        $this->db->where('t.userId', $userId);
        $this->db->or_where('u.superior', $userId);
        $this->db->order_by("t.taskId", "asc");
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        return $query->result();
    }

    function taskPreviewAdmin($page, $segment) { // all task previews
        $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted, u.superior');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users u', 't.userId=u.userId','left');   
        $this->db->where('t.isDeleted !=', 1); //show only valid getAllTasks
        $this->db->order_by("t.taskId", "asc");
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        return $query->result();
    }


    function getSolversAdmin() { // all users available
        $this->db->select('t.userId, t.name, t.roleId, r.role');
        $this->db->from('tbl_users t');
        $this->db->join('tbl_roles as r', 't.roleId=r.roleId','left');
        //$this->db->where('t.userId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSolvers($userId) {
        $this->db->select('u.userId, u.name, u.roleId, r.role');
        $this->db->from('tbl_users u');
        $this->db->join('tbl_roles r', 'u.roleId=r.roleId','left');
        $this->db->where('u.userId', $userId);
        $this->db->or_where('u.superior', $userId);

        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to create new task to system
     * @return number $insert_id : This is last inserted id
     */
    function createNewTask($userInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_task', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to delete the task
     * @param number $userId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTask($taskId, $userInfo) {
        $this->db->where('taskId', $taskId);
        $this->db->update('tbl_task', $userInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function used to get task information by taskId
     * @param number $taskId : This is task id
     * @return array $result : This is task information
     */
    function getTaskInfo($taskId) {
        $this->db->select('t.taskId, t.subject, t.description, t.dueDate, t.userId, u.name, t.isCompleted');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users as u', 't.userId=u.userId','left');
        $this->db->where('t.isDeleted', 0);
        $this->db->where('t.taskId', $taskId);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to update the task information
     * @param array $taskInfo : This is task updated information
     * @param number $taskId : This is task id
     */
    function updateTask($taskId, $taskInfo) {
        $this->db->where('taskId', $taskId);
        $this->db->update('tbl_task', $taskInfo);
        
        return TRUE;
    }

    
}  
?>