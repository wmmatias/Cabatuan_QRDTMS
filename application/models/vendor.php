<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Model {

    public function get_allvendor()
    { 
        $query = "SELECT  vendors.vendor_code, vendors.id, vendors.name, vendors.address, users.first_name, users.last_name, vendors.created_at
        FROM qrdtms.vendors
        LEFT JOIN qrdtms.users
        ON users.id = vendors.user_id
        ORDER BY vendors.created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function get_vendorby_id($id)
    {
        $query = "SELECT * FROM vendors WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function get_vendor_name($vendor)
    { 
        $query = "SELECT name FROM vendors WHERE name=? LIMIT 1";
        return $this->db->query($query, $this->security->xss_clean($vendor))->result_array();
    }

    public function get_name_inother($user, $user_id){ 
        $query = "SELECT * FROM vendors WHERE name = ? AND id != ?";
        $values = array(
            $this->security->xss_clean($user),
            $this->security->xss_clean($user_id)
        );
        return $this->db->query(
            $query, 
            $values
            )->result_array();
    }

    public function create_validation($form_data){
        $vendor = $form_data['name'];
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('name', 'Vendor Name', 'required');
        $this->form_validation->set_rules('address', 'Vendor Address', 'required');    
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_vendor_name($vendor)) {
            return "Vendor already exist.";
        }
    }
    
    public function get_last_code(){
        $query = "SELECT vendor_code FROM vendors  ORDER BY vendor_code DESC LIMIT 1";
        $res =  $this->db->query($query);
        foreach($res->result_array() as $row)
        {
            $code = $row['vendor_code'];
        }

        if($res !== null){
            $initial = 1;
            $vcode = $vcode = 'V' . str_pad($initial + substr($code, 3), 6, '0', STR_PAD_LEFT);;
            return $vcode;
        }else{
            return 'V000001';     
        }
    }

    public function create_vendor($form_data, $last_code){

        $query = "INSERT INTO vendors (vendor_code, name, address, user_id, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array( 
            $this->security->xss_clean($last_code), 
            $this->security->xss_clean($form_data['name']), 
            $this->security->xss_clean($form_data['address']), 
            $this->security->xss_clean($form_data['id']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))); 
        
        return $this->db->query($query, $values);
    }

    public function validate_update($name, $id){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('name', 'Vendor Name', 'required');
        $this->form_validation->set_rules('address', 'Vendor Address', 'required');   
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_name_inother($name, $id)) {
            return "Vendor already exist.";
        }
    }

    public function update_vendor($form_data){
        return $this->db->query("UPDATE vendors SET name = ?, address = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['name']), 
            $this->security->xss_clean($form_data['address']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    public function delete_vendor_id($id) {
        return $this->db->query("DELETE FROM vendors WHERE id = ?", 
        array(
            $this->security->xss_clean($id)));
    }
}