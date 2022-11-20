<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Activity extends CI_Model {

    public function log($id)
    { 
        $query = "INSERT INTO logs (activity, created_by, created_at) VALUES (?,?,?)";
        $values = array(
            $this->security->xss_clean($this->session->userdata('activity')), 
            $this->security->xss_clean($id), 
            $this->security->xss_clean(date("Y-m-d, H:i:s"))); 
        
        return $this->db->query($query, $values);
    }

    public function fetch_all_logs(){
        return $this->db->query("SELECT logs.activity, logs.created_by, users.first_name, users.last_name, logs.created_at 
        FROM cabatuan_qrdtms.logs 
        LEFT JOIN cabatuan_qrdtms.users
        ON logs.created_by = users.id
        ORDER BY created_at DESC")->result_array();
    }

}