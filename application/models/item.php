<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Model {

    public function get_allitem()
    { 
        $query = "SELECT  items.id, items.pr_no, vendors.name, items.description, items.uom, items.unit_cost, items.vendor_code, users.first_name, users.last_name, items.created_at
        FROM cabatuan_qrdtms.items
        LEFT JOIN cabatuan_qrdtms.users
        ON users.id = items.created_by
        LEFT JOIN cabatuan_qrdtms.vendors
        ON vendors.vendor_code = items.vendor_code
        ORDER BY items.created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function get_itemby_id($id)
    {
        $query = "SELECT * FROM items WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    public function get_item_name($vendor)
    { 
        $query = "SELECT name FROM vendors WHERE name=?";
        return $this->db->query($query, $this->security->xss_clean($vendor))->result_array()[0];
    }

    public function get_name_inother($user, $user_id)
    { 
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

    public function create_validation(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('vendorcode', 'Vendor Code', 'required|alpha_numeric');
        $this->form_validation->set_rules('itemname', 'Item Name', 'required'); 
        $this->form_validation->set_rules('uom', 'Unit of Measure', 'required');
        $this->form_validation->set_rules('unitcost', 'Unit Cost', 'required|decimal');    
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return "success";
        }
    }

    public function create_item($form_data, $item_code){
        $query = "INSERT INTO items (created_by, item_code, name, uom, unit_price, vendor_code, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['id']),  
            $this->security->xss_clean($item_code),
            $this->security->xss_clean($form_data['itemname']), 
            $this->security->xss_clean($form_data['uom']), 
            $this->security->xss_clean($form_data['unitcost']), 
            $this->security->xss_clean($form_data['vendorcode']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))); 
        
        return $this->db->query($query, $values);
    }

    public function validate_update(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->form_validation->set_rules('vendorcode', 'Vendor Code', 'required|alpha_numeric');
        $this->form_validation->set_rules('itemname', 'Item Name', 'required'); 
        $this->form_validation->set_rules('uom', 'Unit of Measure', 'required');
        $this->form_validation->set_rules('unitcost', 'Unit Cost', 'required|decimal');    
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return "success";
        }
    }

    public function update_item($form_data){
        return $this->db->query("UPDATE items SET description = ?, uom = ?, unit_cost = ?, vendor_code = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['itemname']), 
            $this->security->xss_clean($form_data['uom']),
            $this->security->xss_clean($form_data['unitcost']), 
            $this->security->xss_clean($form_data['vendorcode']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    public function vendor_exist($code){
        $query = "SELECT * FROM vendors WHERE vendor_code=?";
        return $this->db->query($query, $this->security->xss_clean($code))->result_array();
    }
    
    // public function delete_item_id($id) {
    //     return $this->db->query("DELETE FROM items WHERE id = ?", 
    //     array(
    //         $this->security->xss_clean($id)));
    // }

    // public function get_last_code(){
    //     $query = "SELECT item_code FROM items  ORDER BY id DESC LIMIT 1";
    //     $res =  $this->db->query($query);
    //     $code = '';
    //     foreach($res->result_array() as $row)
    //     {
    //         $code = $row['item_code'];
    //     }

    //     if($res !== null){
    //         $initial = 1;
    //         $vcode = $vcode = 'I' . str_pad($initial + substr($code, 3), 6, '0', STR_PAD_LEFT);;
    //         return $vcode;
    //     }else{
    //         return 'I000001';     
    //     }
    // }

}