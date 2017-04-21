<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    function getAllMyActiveTask($userId) {
        $this->db->select('*');
        $this->db->from('tbl_task');
        $this->db->where('tbl_task.userId', $userId);
        $query = $this->db->get();

        return $query->result();
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='2'
    }
}  
?>