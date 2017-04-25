<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    function getAllMyActiveTask($userId) {
        $this->db->select('*');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $query = $this->db->get();

        return $query->result();
        //SELECT * FROM tbl_task WHERE tbl_task.userId=$userId
    }

    function getAllTasksCount() {
        $this->db->select('t.taskId, t.userId, t.subject, t.description, t.dueDate, t.isCompleted');
        $this->db->from('tbl_task t');
        $query = $this->db->get();

        return count($query->result());
    }

    function getAllTasks($page, $segment) {
        $this->db->select('t.taskId, u.name AS name, t.subject, t.description, t.dueDate, t.isCompleted');
        $this->db->from('tbl_task t');
        $this->db->join('tbl_users as u', 't.userId=u.userId','left');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        return $query->result();
    }

    function getSolvers() {
        $this->db->select('t.userId, t.name');
        $this->db->from('tbl_users t');
        $this->db->where('t.userId !=', 1);
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

    
}  
?>