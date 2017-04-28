<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    function getAllMyActiveTask($userId) {
        $this->db->select('*, isDeleted');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $this->db->where('isDeleted !=', 1); //TEST !! show only valid tasks
        $this->db->where('isCompleted !=', 1);
        $query = $this->db->get();

        return $query->result();
        //SELECT * FROM tbl_task WHERE tbl_task.userId=$userId
    }

    function getAllMyActiveTaskCount($userId) {
        $this->db->select('*, isDeleted');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $this->db->where('isDeleted !=', 1); //TEST !! show only valid tasks
        $this->db->where('isCompleted !=', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    function getAllTasksCount() {
        $this->db->select('t.taskId, t.userId, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted');
        $this->db->from('tbl_task t');
        $this->db->where('t.isDeleted !=', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    function getCompletedTasksCount() {
        $this->db->select('t.taskId, t.userId, t.subject, t.description, t.dueDate, t.isCompleted');
        $this->db->from('tbl_task t');
        $this->db->where('t.isCompleted', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    function getAllTasks($page, $segment) {
        $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted, t.isDeleted');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users as u', 't.userId=u.userId','left');
        $this->db->where('t.isDeleted !=', 1); //show only valid tasks
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        return $query->result();
    }

    function getSolvers() {
        $this->db->select('t.userId, t.name, t.roleId, r.role');
        $this->db->from('tbl_users t');
        $this->db->join('tbl_roles as r', 't.roleId=r.roleId','left');
        //$this->db->where('t.userId !=', 1);
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
        $this->db->select('t.taskId, t.subject, t.description, t.dueDate, t.userId, u.name');
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