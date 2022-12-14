<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function total(){ 
        return $this->db->query ("SELECT count(*) as total_request FROM cabatuan_qrdtms.requests")->result_array()[0];
    }
    public function pending(){ 
        $status = '0';
        return $this->db->query ("SELECT count(*) as total_pending 
        FROM cabatuan_qrdtms.requests 
        WHERE status = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }
    public function approved(){ 
        $status = '1';
        return $this->db->query ("SELECT count(*) as total_approve
        FROM cabatuan_qrdtms.requests 
        WHERE status = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }
    public function cancelled(){ 
        $status = '2';
        return $this->db->query ("SELECT count(*) as total_cancel
        FROM cabatuan_qrdtms.requests 
        WHERE status = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }

    public function get_department(){
        return $this->db->query ("SELECT * FROM cabatuan_qrdtms.departments")->result_array();
    }
    public function po_total(){ 
        return $this->db->query ("SELECT count(*) as total_request FROM cabatuan_qrdtms.orders")->result_array()[0];
    }
    public function po_pending(){ 
        $status = '0';
        return $this->db->query ("SELECT count(*) as total_pending 
        FROM cabatuan_qrdtms.orders 
        WHERE approver_1 = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }
    public function po_approved(){ 
        $status = '1';
        return $this->db->query ("SELECT count(*) as total_approve
        FROM cabatuan_qrdtms.orders 
        WHERE approver_1 = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }
    public function po_cancelled(){ 
        $status = '2';
        return $this->db->query ("SELECT count(*) as total_cancel
        FROM cabatuan_qrdtms.orders 
        WHERE approver_1 = ?", array($this->security->xss_clean($status)))->result_array()[0];
    }

}