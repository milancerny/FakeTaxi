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

    
}  
?>