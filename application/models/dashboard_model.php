<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    function getManagerCounts() {
        $this->db->select('u.roleId, u.superior');
        $this->db->from('tbl_users u');
        $this->db->where('u.roleId', 2);
        $query = $this->db->get();

        return count($query->result());
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='2'
    }

    function getEmployeeCounts($userId) {
        $this->db->select('u.roleId, u.superior');
        $this->db->from('tbl_users u');
        $this->db->where('u.roleId', 3);
        $this->db->where('u.superior', $userId);
        $query = $this->db->get();

        return count($query->result());
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='3'
    }

    function getEmployeeCountsAdmin() {
        $this->db->select('u.roleId, u.superior');
        $this->db->from('tbl_users u');
        $this->db->where('u.roleId', 3);
        $query = $this->db->get();

        return count($query->result());
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='3'
    }
}

  
?>