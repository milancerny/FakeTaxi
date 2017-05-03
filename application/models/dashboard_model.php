<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    function getManagerCounts() {
        $this->db->select('tbl_users.roleId');
        $this->db->from('tbl_users');
        $this->db->join('tbl_roles', 'tbl_users.roleId=tbl_roles.roleId', 'left');
        $this->db->where('tbl_roles.roleId', 2);
        $query = $this->db->get();

        return count($query->result());
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='2'
    }

    function getEmployeeCounts($userId) {
        $this->db->select('tbl_users.roleId');
        $this->db->from('tbl_users');
        $this->db->join('tbl_roles', 'tbl_users.roleId=tbl_roles.roleId', 'left');
        $this->db->where('tbl_roles.roleId', 3);
        $this->db->where('tbl_users.superior', $userId);
        $query = $this->db->get();

        return count($query->result());
        //SELECT COUNT(u.roleId) FROM tbl_users u JOIN tbl_roles r ON u.roleId=r.roleId WHERE r.roleId='3'
    }

}

  
?>