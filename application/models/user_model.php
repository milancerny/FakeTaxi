<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * This function is used to get the all user listing count for only ADMIN 
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCountAdmin($searchText = '') {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $searchText= "%".$searchText."%";
            $this->db->where(array(
                'BaseTbl.email LIKE' => $searchText,
                'BaseTbl.isDeleted' => 0,
                'BaseTbl.roleId !=' => 1));

            $this->db->or_where('BaseTbl.name LIKE', $searchText);
            $this->db->where(array(
                'BaseTbl.isDeleted' => 0,
                'BaseTbl.roleId !=' => 1));

            $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
            $this->db->where(array(
                'BaseTbl.isDeleted' => 0,
                'BaseTbl.roleId !=' => 1));
        } else {
            $this->db->where(array(
                'BaseTbl.isDeleted' => 0,
                'BaseTbl.roleId !=' => 1));
        }
        $this->db->order_by("BaseTbl.userId", "asc");
        $query = $this->db->get();
        
        return count($query->result());
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListingAdmin($searchText = '', $page, $segment) {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
            $this->db->from('tbl_users as BaseTbl');
            $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
            if(!empty($searchText)) {
                $searchText= "%".$searchText."%";
                $this->db->where(array(
                    'BaseTbl.email LIKE' => $searchText,
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1));

                $this->db->or_where('BaseTbl.name LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1));

                $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1));
            } else {
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1));
            }
            $this->db->limit($page, $segment);
            $this->db->order_by("BaseTbl.userId", "asc");
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
    }

    /**
     * This function is used to get the user listing count e.g. manager
     * count only your subordinates
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '', $userId) {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $searchText= "%".$searchText."%";
            $this->db->where(array(
                    'BaseTbl.email LIKE' => $searchText,
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
                
                $this->db->or_where('BaseTbl.email LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));

                $this->db->or_where('BaseTbl.name LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));

                $this->db->or_where('BaseTbl.name LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));


                $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
                
                $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));
        } else {
            $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));

            $this->db->or_where('BaseTbl.superior', $userId);
            $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
        }
        $this->db->order_by("BaseTbl.userId", "asc");
        $query = $this->db->get();
        
        return count($query->result());
    }

    /**
     * This function is used to get the user listing 
     * only your subordinates
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment, $userId) {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
            $this->db->from('tbl_users as BaseTbl');
            $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
            if(!empty($searchText)) {
                $searchText= "%".$searchText."%";
                $this->db->where(array(
                    'BaseTbl.email LIKE' => $searchText,
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
                
                $this->db->or_where('BaseTbl.email LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));

                $this->db->or_where('BaseTbl.name LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));

                $this->db->or_where('BaseTbl.name LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));


                $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
                
                $this->db->or_where('BaseTbl.mobile LIKE', $searchText);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId));
            } else {
                
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.userId' => $userId)); 

                $this->db->or_where('BaseTbl.superior', $userId);
                $this->db->where(array(
                    'BaseTbl.isDeleted' => 0,
                    'BaseTbl.roleId !=' => 1,
                    'BaseTbl.superior' => $userId));
            }
            $this->db->limit($page, $segment);
            $this->db->order_by("BaseTbl.userId", "asc");
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
    }
    
    /**
     * This function is used to get the user roles information for admin 
     * Admin can add anything
     * @return array $result : This is result of the query
     */
    function getUserRolesAdmin() {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the user roles information for manager
     * Manager can add only your submission employee
     * @return array $result : This is result of the query
     */
    function getUserRoles() {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId', 3);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the manager name
     * When admin adding some employee, he must defined his superior manager
     * @return array $result : This is result of the query
     */
    function getManagers() {
        $this->db->select('userId, roleId, name');
        $this->db->from('tbl_users');
        $this->db->where('roleId', 2);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0) {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }
}

  
