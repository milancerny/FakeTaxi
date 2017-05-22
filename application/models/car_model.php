<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Car_model extends CI_Model {

    function carsPreviewAdmin($page, $segment) { 
        $this->db->select('d.carSubId, d.id, d.ECV, d.VIN, d.totalCountKm, subT.id as subId, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.carTypeId','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('d.carSubId = subT.id');
        $this->db->where('d.isDeleted !=', 1);
        $this->db->order_by("d.id", "asc");
        $this->db->limit($page, $segment);
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to get count of all cars e.g.(manager+employee)
     * @return number $result : All tasks count. I and my employee
     */
    function carsCountAdmin() {
        $this->db->select('d.carSubId, d.id, d.ECV, d.VIN, d.totalCountKm, subT.id, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.carTypeId','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('d.carSubId = subT.id');
        $this->db->where('d.isDeleted !=', 1);

        $query = $this->db->get();
        return count($query->result());
    }

    function carsPreview($page, $segment, $userId) {
        $this->db->select('d.carSubId, d.id, d.ECV, d.VIN, d.totalCountKm, subT.id, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.carTypeId','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('d.carSubId = subT.id');
        $this->db->or_where('u.userId', $userId);
        $this->db->where('u.superior', $userId);
        $this->db->where('d.isDeleted !=', 1);
        
        $this->db->order_by("type.type", "asc");
        $this->db->limit($page, $segment);
        
        $query = $this->db->get();
        return $query->result();
    }

    function carsCount($userId) {
        $this->db->select('d.carSubId, d.id, d.ECV, d.VIN, d.totalCountKm, subT.id, subT.subType, type.type, u.name');
        $this->db->from('tbl_car_detail d');
        $this->db->join('tbl_car_sub_type subT', 'd.carSubTypeId=subT.carTypeId','left'); 
        $this->db->join('tbl_car_type type', 'subT.carTypeId=type.id','left'); 
        $this->db->join('tbl_users u', 'd.driverId=u.userId','left'); 
        $this->db->where('d.carSubId = subT.id');
        $this->db->or_where('u.userId', $userId);
        $this->db->where('u.superior', $userId);
        $this->db->where('d.isDeleted !=', 1);

        $query = $this->db->get();
        return count($query->result());
    }

    function getCarTypes() {
        $this->db->select('*');
        $this->db->from('tbl_car_type');
        $this->db->order_by("type", "asc");

        $query = $this->db->get();
        return $query->result();
    }

    function getCarSubTypes(){
        $this->db->select('id, subType, carTypeId');
        $this->db->from('tbl_car_sub_type');
        $this->db->order_by("subType", "asc");

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to create new car to system
     * @return number $insert_id : This is last inserted id
     */
    function createNewCar($carInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_car_detail', $carInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        return $insert_id;
    }

    function createNewCarType($carInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_car_type', $carInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        return $insert_id;
    }

    function createNewCarSubType($carInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_car_sub_type', $carInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        return $insert_id;
    }

    /**
     * This function is used to delete the car
     * @param number $rowId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCar($rowId, $detailInfo) {
        $this->db->where('id', $rowId);
        $this->db->update('tbl_car_detail', $detailInfo);
        
        return $this->db->affected_rows();
    }
    
    
}  
?>