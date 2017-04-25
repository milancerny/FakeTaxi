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

    
}  
?>