<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Car_model extends CI_Model {

    function carsPreviewAdmin($page, $segment) {
        $this->db->select('d.id, d.ECV, d.VIN, d.totalCountKm, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.id','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        //$this->db->order_by("t.taskId", "asc");
        $this->db->limit($page, $segment);
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to get count of all tasks e.g.(manager+employee),
     * used in dashboard and task list as pagination
     * @param number $userId : This is userId
     * @return number $result : All tasks count. I and my employee
     */
    function carsCountAdmin() {
        $this->db->select('d.ECV, d.VIN, d.driverId, d.totalCountKm, subT.subType, type.type');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.id','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        
        $query = $this->db->get();
        return count($query->result());
    }

    function carsPreview($page, $segment, $userId) {
        $this->db->select('d.id, d.ECV, d.VIN, d.totalCountKm, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.id','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('u.userId', $userId);
        $this->db->or_where('u.superior', $userId);
        //$this->db->order_by("t.taskId", "asc");
        $this->db->limit($page, $segment);
        
        $query = $this->db->get();
        return $query->result();
    }

    function carsCount($userId) {
        $this->db->select('d.ECV, d.VIN, d.driverId, d.totalCountKm, subT.subType, type.type');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.id','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('u.userId', $userId);
        $this->db->or_where('u.superior', $userId);

        $query = $this->db->get();
        return count($query->result());
    }

    function carTypes() {
        $this->db->select('t.type, sub.*');
        $this->db->from('tbl_car_type t');
        $this->db->join('tbl_car_sub_type sub', 'sub.carTypeId=t.id','left'); 
        $this->db->where('sub.carTypeId is NOT NULL', NULL, FALSE);
        $this->db->order_by("t.type", "asc");

        $query = $this->db->get();
        return $query->result();
    }
    
}  
?>