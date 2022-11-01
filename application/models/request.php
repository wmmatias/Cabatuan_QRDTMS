<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Model {

    public function fetch_all(){
		return $this->db->query("SELECT items.id, items.item_code, items.name as item_name, items.uom, items.unit_price, items.vendor_code, vendors.id as vendor_id, vendors.name, items.created_by, items.created_at
        FROM qrdtms.items
        LEFT JOIN qrdtms.vendors
        ON vendors.vendor_code = items.vendor_code
        ORDER BY items.created_at DESC")->result_array();
	}

    public function fetch_all_request(){
		return $this->db->query("SELECT stagings.id, stagings.temp_id as temp_id, items.item_code, items.name as item_name, items.uom, items.unit_price, vendors.vendor_code, vendors.name, stagings.qty, users.first_name, users.last_name
        FROM qrdtms.stagings
        LEFT JOIN qrdtms.items
        ON items.id = stagings.item_id
        LEFT JOIN qrdtms.vendors
        ON vendors.id = stagings.vendor_id
        LEFT JOIN qrdtms.users
        ON users.id = stagings.created_by"
        )->result_array();
	}

    public function fetch_all_generated_request($id){
        return $this->db->query("SELECT requests.id, requests.pr_no, requests.description, vendors.name, requests.status, users.first_name, users.last_name, requests.created_at
        FROM qrdtms.requests
        LEFT JOIN qrdtms.vendors
        ON vendors.id = requests.vendor_id
        LEFT JOIN qrdtms.users
        ON users.id = requests.created_by
        WHERE created_by = ?",
        array(
            $this->security->xss_clean($id),
        ))->result_array();
    }

    public function requested_item($form_data){
        $qty = '1';
        $query = "INSERT INTO stagings (temp_id, item_id, vendor_id, qty, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['temp']),
            $this->security->xss_clean($form_data['itemid']),  
            $this->security->xss_clean($form_data['vendorid']), 
            $this->security->xss_clean($qty), 
            $this->security->xss_clean($form_data['user_id']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        );
        $this->db->query($query, $values);
        return $this->fetch_all_request();
    }

    public function get_vendor($id){
        return $this->db->query("SELECT DISTINCT temp_id FROM stagings WHERE temp_id =?",
        array(
            $this->security->xss_clean($id)
        ))->result_array();
    }

    public function current($form_data){
        return $this->db->query("SELECT DISTINCT temp_id FROM qrdtms.stagings WHERE created_by = ? ",
        array(
            $this->security->xss_clean($form_data['user_id'])
        ))->result_array();
    }

    public function check_item($form_data){
        return $this->db->query("SELECT item_id FROM qrdtms.stagings WHERE item_id = ? ",
        array(
            $this->security->xss_clean($form_data['itemid'])
        ))->result_array();
        return $this->fetch_all_request();
    }

    public function get_qty($form_data){
        return $this->db->query("SELECT qty FROM qrdtms.stagings WHERE item_id = ? ",
        array(
            $this->security->xss_clean($form_data['itemid'])
        ))->result_array();
    }
    
    public function update($form_data){
        $this->db->query("UPDATE stagings SET qty = ? WHERE id = ? AND temp_id = ?",
        array(
            $this->security->xss_clean($form_data['qty']),
            $this->security->xss_clean($form_data['id']),
            $this->security->xss_clean($form_data['tempid'])
        ));
        return $this->fetch_all_request();
    }

    public function delete_line($form_data){
        $this->db->query("DELETE FROM stagings WHERE id = ? AND temp_id = ?",
        array(
            $this->security->xss_clean($form_data['id']),
            $this->security->xss_clean($form_data['tempid'])
        ));
        return $this->fetch_all_request();
    }

    public function delete($id){
        $this->db->query("DELETE FROM stagings WHERE created_by = ?",
        array(
            $this->security->xss_clean($id)
        ));
        return $this->fetch_all_request();
    }

	public function search($form_data){
		$code = !empty($form_data['vendorcode']) ? '%' .$this->security->xss_clean($form_data['vendorcode']) .'%' : '%%';
		$desc = !empty($form_data['description']) ? '%' .$this->security->xss_clean($form_data['description']) .'%' : '%%';
        if(!empty($form_data)){
            if(!empty($form_data['vendorcode'])){
                    return $this->db->query("SELECT items.id, items.item_code, items.name as item_name, items.uom, items.unit_price, items.vendor_code, vendors.id as vendor_id, vendors.name, items.created_by, items.created_at
                    FROM qrdtms.items
                    LEFT JOIN qrdtms.vendors
                    ON vendors.vendor_code = items.vendor_code
                    WHERE items.vendor_code LIKE ? AND items.name LIKE ?", 
                    array(
                        $code,
                        $desc
                    ))->result_array();
            }
            else{
                    return $this->db->query("SELECT items.id, items.item_code, items.name as item_name, items.uom, items.unit_price, items.vendor_code, vendors.id as vendor_id, vendors.name, items.created_by, items.created_at
                    FROM qrdtms.items
                    LEFT JOIN qrdtms.vendors
                    ON vendors.vendor_code = items.vendor_code
                    WHERE items.vendor_code LIKE ? AND items.name LIKE ?", 
                    array(
                        $code,
                        $desc
                    ))->result_array();
                
            }
        }
		
	}

    public function get_last_pr(){
        $query = "SELECT pr_no FROM requests ORDER BY pr_no DESC LIMIT 1";
        $res =  $this->db->query($query);
        $code = '';
        foreach($res->result_array() as $row)
        {
            $code = $row['pr_no'];
        }

        if($res !== null){
            $initial = 1;
            $vcode = $vcode = 'PR' . str_pad($initial + substr($code, 3), 6, '0', STR_PAD_LEFT);;
            return $vcode;
        }else{
            return 'PR000001';     
        }
    }

    public function get_stagings($form_data){
        return $this->db->query("SELECT * FROM qrdtms.stagings WHERE created_by = ? LIMIT 1",
        array(
            $this->security->xss_clean($form_data['user_id'])
        ))->result_array();
    }

    public function transfer_stagings($form_data){
        return $this->db->query("SELECT * FROM qrdtms.stagings WHERE created_by = ? ",
        array(
            $this->security->xss_clean($form_data['user_id'])
        ))->result();
    }

    public function generate_PR($form_data){
        $pr_code = $this->session->userdata('pr_no');
        $stagings = $this->transfer_stagings($form_data);
        $stagingsdata = $this->get_stagings($form_data);
        $data = array(
            'temp_id' => $stagingsdata[0]['temp_id']
        );
        foreach($stagings as $row) { 
            $stagings = array('temp_id' => $row->temp_id);
            $this->db->insert('details', $row, array('temp_id' => $row->temp_id, 'item_id' => $row->item_id, 'vendor_id' => $row->vendor_id, 'qty' => $row->qty, 'created_by' => $row->created_by));
        }

        $this->db->query("UPDATE details SET pr_no = ?, created_at = ?, updated_at = ? WHERE temp_id = ?",
        array(
            $this->security->xss_clean($pr_code),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($data['temp_id'])
        ));

        $this->delete($form_data['user_id']);

        return 'success';
       
    }

    public function get_all_vendor(){
        return $this->db->query("SELECT id, vendor_code, name, address FROM vendors")->result_array();
    }

    public function get_all_items($vendor_code){
        return $this->db->query("SELECT * FROM items WHERE vendor_code = ?", 
        array(
            $this->security->xss_clean($vendor_code)
        ))->result_array();
    }

    public function get_items_pr($last_code){
        return $this->db->query("SELECT vendors.vendor_code, items.name, details.qty, items.uom, items.unit_price
        FROM qrdtms.details
        LEFT JOIN qrdtms.items
        ON items.id = details.item_id
        LEFT JOIN qrdtms.vendors
        ON vendors.id = details.vendor_id
        WHERE pr_no = ?",
        array(
            $this->security->xss_clean($last_code)
        ))->result_array();
    }

    public function create_validation(){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('pr_no', 'PR Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required'); 
        $this->form_validation->set_rules('vendor', 'Vendor', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');    
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return "success";
        }
    }

    public function get_vendorby_id($form_data){
        return $this->db->query("SELECT vendor_code FROM vendors WHERE id = ?",
        array(
            $this->security->xss_clean($form_data['vendor'])
        ))->result_array();
    }

    public function save_pr($form_data,$result){
        $prdata = array(
            'pr_no' => $form_data['pr_no'],
            'vendor_id' => $form_data['vendor'],
            'description' => $form_data['description'],
            'vendor_code' => $result[0]['vendor_code']
        );
        
        $this->session->set_userdata($prdata);
        $query = "INSERT INTO requests (pr_no, vendor_id, description, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['pr_no']),
            $this->security->xss_clean($form_data['vendor']),  
            $this->security->xss_clean($form_data['description']),  
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        );
        $this->db->query($query, $values);
        return $this->fetch_all_request();
    }

    public function get_pr($pr_no){
        return $this->db->query("SELECT requests.id, requests.pr_no, requests.description, items.name as item_name, details.qty, items.uom, items.unit_price, items.unit_price*details.qty as total_unit_price, vendors.name, requests.status, users.first_name, users.last_name, requests.created_at
        FROM qrdtms.requests
        LEFT JOIN qrdtms.vendors
        ON vendors.id = requests.vendor_id
        LEFT JOIN qrdtms.users
        ON users.id = requests.created_by
        LEFT JOIN qrdtms.details
        ON details.pr_no = requests.pr_no
        LEFT JOIN qrdtms.items
        ON items.id = details.item_id
        WHERE requests.pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

    public function sum_unitprice($pr_no){
        return $this->db->query("SELECT sum(items.unit_price*details.qty) as total_cost
        FROM qrdtms.details
        LEFT JOIN qrdtms.items
        ON items.id = details.item_id
        WHERE details.pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

}