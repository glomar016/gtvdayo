<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model extends CI_Model {

    function add_user($userName, $userPassword){
        $query = $this->db->query("EXEC SP_INSERT_USER '$userName', '$userPassword'");
    }

    function add_request($requestApplicantName, $requestTeamName, $requestBarangay, $requestCity, $requestEmail, $requestDate){
        $query = $this->db->query("EXEC SP_INSERT_REQUEST '$requestApplicantName', '$requestTeamName', '$requestBarangay', '$requestCity', '$requestEmail', '$requestDate'");
    }

    function show_user(){
        $query = $this->db->query("EXEC SP_SHOW_USER");
        $data = $query->result();
        return $data;
    }
    
    function show_request(){
        $query = $this->db->query("EXEC SP_SHOW_REQUEST");
        $data = $query->result();
        return $data;
    }

    function delete($id, $statusColumn, $tableName){
        $this->db->set($statusColumn, '0');
        $this->db->where("id", $id);
        $this->db->update($tableName);
    }

    function activate($id, $statusColumn, $tableName){
        $this->db->set($statusColumn, '1');
        $this->db->where("id", $id);
        $this->db->update($tableName);
    }

    function approved($id, $statusColumn, $tableName){
        $this->db->set($statusColumn, '2');
        $this->db->where("id", $id);
        $this->db->update($tableName);
    }

    function get_request_info($id){
        $this->db->select('*');
        $this->db->from('t_request');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    function create($data, $tableName){
        return $this->db->insert($tableName, $data);
    }

    function show_approved(){
        $this->db->select('*, t_approved.id AS approvedID');
        $this->db->from('t_approved');
        $this->db->join('t_request', 't_request.id = t_approved.approvedRequestID', 'left');
        $this->db->join('t_user', 't_user.id = t_approved.approvedUserID', 'left');
        $this->db->where('t_request.requestDate < GETDATE()');
        $this->db->where('t_approved.approvedStatus = 1');
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }


    function get_user(){
        $this->db->select("*"); // SELECT *
        $this->db->from('t_user'); // SELECT * FROM t_user
        $this->db->where('userStatus', '1'); // SELECT * FROM t_user WHERE userStatus = 1
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    
}
