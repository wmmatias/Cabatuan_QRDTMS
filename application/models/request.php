<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
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

    public function fetch_all_generated_request(){
        return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
        FROM cabatuan_qrdtms.requests
        LEFT JOIN cabatuan_qrdtms.users
        ON users.id = requests.created_by
        WHERE requests.description IS NOT NULL AND requests.department IS NOT NULL
        ORDER BY requests.pr_no DESC")->result_array();
    }

    public function fetch_all_request_approval($level){
        if($level === '1'){
            $mbo = '0';
            $mt = '0';
            $ma = '0';
            $mm = '0';
            return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
            FROM cabatuan_qrdtms.requests
            LEFT JOIN cabatuan_qrdtms.users
            ON users.id = requests.created_by
            WHERE requests.approver_1 = ? AND requests.approver_2 = ? AND requests.approver_3 = ? AND requests.approver_4 = ?
            ORDER BY requests.pr_no DESC",
            array(
                $this->security->xss_clean($mbo),
                $this->security->xss_clean($mt),
                $this->security->xss_clean($ma),
                $this->security->xss_clean($mm),
            ))->result_array();
        }
        elseif($level === '2'){
            $mbo = '1';
            $mt = '0';
            $ma = '0';
            $mm = '0';
            return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
            FROM cabatuan_qrdtms.requests
            LEFT JOIN cabatuan_qrdtms.users
            ON users.id = requests.created_by
            WHERE requests.approver_1 = ? AND requests.approver_2 = ? AND requests.approver_3 = ? AND requests.approver_4 = ?
            ORDER BY requests.pr_no DESC",
            array(
                $this->security->xss_clean($mbo),
                $this->security->xss_clean($mt),
                $this->security->xss_clean($ma),
                $this->security->xss_clean($mm),
            ))->result_array();
        }
        elseif($level === '3'){
            $mbo = '1';
            $mt = '1';
            $ma = '0';
            $mm = '0';
            return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
            FROM cabatuan_qrdtms.requests
            LEFT JOIN cabatuan_qrdtms.users
            ON users.id = requests.created_by
            WHERE requests.approver_1 = ? AND requests.approver_2 = ? AND requests.approver_3 = ? AND requests.approver_4 = ?
            ORDER BY requests.pr_no DESC",
            array(
                $this->security->xss_clean($mbo),
                $this->security->xss_clean($mt),
                $this->security->xss_clean($ma),
                $this->security->xss_clean($mm),
            ))->result_array();
        }
        elseif($level === '4'){
            $mbo = '1';
            $mt = '1';
            $ma = '1';
            $mm = '0';
            return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
            FROM cabatuan_qrdtms.requests
            LEFT JOIN cabatuan_qrdtms.users
            ON users.id = requests.created_by
            WHERE requests.approver_1 = ? AND requests.approver_2 = ? AND requests.approver_3 = ? AND requests.approver_4 = ?
            ORDER BY requests.pr_no DESC",
            array(
                $this->security->xss_clean($mbo),
                $this->security->xss_clean($mt),
                $this->security->xss_clean($ma),
                $this->security->xss_clean($mm),
            ))->result_array();
        }
        else{
            return $this->db->query("SELECT requests.pr_no, requests.description, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
            FROM cabatuan_qrdtms.requests
            LEFT JOIN cabatuan_qrdtms.users
            ON users.id = requests.created_by
            ORDER BY requests.pr_no DESC")->result_array();
        }
    }

    public function fetch_all_order_approval(){
        $mm = '0';
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.description, orders.approver_1, users.first_name, users.last_name, requests.created_at
        FROM cabatuan_qrdtms.orders
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.users
        ON requests.created_by = users.id
        WHERE orders.approver_1 = ?
        ORDER BY orders.created_at DESC",
        array(
            $this->security->xss_clean($mm)
        ))->result_array();
    }
    
    public function fetch_all_generated_order(){
        return $this->db->query("SELECT orders.order_no, requests.pr_no, requests.description, orders.approver_1, users.first_name, users.last_name, requests.created_at
        FROM cabatuan_qrdtms.orders
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.users
        ON requests.created_by = users.id
        ORDER BY orders.created_at DESC")->result_array();
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
        $year = date("y");
        foreach($res->result_array() as $row)
        {
            $code = $row['pr_no'];
        }

        if($res !== null){
            $initial = 1;
            $vcode = $vcode = $year.'-'.str_pad($initial + substr($code, 3), 6, '0', STR_PAD_LEFT);;
            return $vcode;
        }else{
            return $year.'-'.'000001';     
        }
    }

    public function get_last_po(){
        $query = "SELECT order_no FROM orders ORDER BY order_no DESC LIMIT 1";
        $res =  $this->db->query($query);
        $code = '';
        $year = date("y");
        foreach($res->result_array() as $row)
        {
            $code = $row['order_no'];
        }

        if($res !== null){
            $initial = 1;
            $vcode = $vcode = $year.'-'.str_pad($initial + substr($code, 3), 6, '1', STR_PAD_LEFT);;
            return $vcode;
        }else{
            return $year.'-'.'111111';     
        }
    }

    public function add_initial_item($form_data){
        $code = '0';
        $query = "INSERT INTO items (pr_no, vendor_code, description, qty, uom, created_by, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['pr_no']), 
            $this->security->xss_clean($code), 
            $this->security->xss_clean($form_data['description']), 
            $this->security->xss_clean($form_data['qty']), 
            $this->security->xss_clean($form_data['uom']), 
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        );
        $this->db->query($query, $values);
        return $this->fetch_all_request();
    }

    public function delete_initial($form_data){
        return $this->db->query("DELETE FROM items WHERE id = ?",
        array(
            $this->security->xss_clean($form_data['id'])
        ));
    }

    public function fetch_request_item($pr_no){
        return $this->db->query("SELECT *, (items.unit_cost*items.qty) as total_cost FROM items
        LEFT JOIN cabatuan_qrdtms.vendors
        ON vendors.vendor_code = items.vendor_code
        WHERE pr_no = ? ORDER BY id DESC",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

    public function cancel_request($id){
        $this->db->query("DELETE FROM items WHERE pr_no = ?",
        array(
            $this->security->xss_clean($id)
        ));
        $this->db->query("DELETE FROM requests WHERE pr_no = ?",
        array(
            $this->security->xss_clean($id)
        ));
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

        $kill = array('pr_no', 'vendor', 'description', 'vendor_code');
        $this->session->unset_userdata($kill);
        return 'success';
       
    }

    public function get_all_vendor(){
        return $this->db->query("SELECT vendor_code, name, address FROM vendors")->result_array();
    }

    public function get_all_items($vendor_code){
        return $this->db->query("SELECT * FROM items WHERE vendor_code = ?", 
        array(
            $this->security->xss_clean($vendor_code)
        ))->result_array();
    }

    public function get_order($id){
        return $this->db->query("SELECT orders.order_no, orders.pr_no, orders.approver_1, requests.description, items.description, items.qty, items.uom, items.unit_cost, 
        items.qty * items.unit_cost as total_unit_cost, vendors.name, vendors.address, orders.created_by, orders.created_at 
        FROM cabatuan_qrdtms.orders
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON requests.pr_no = items.pr_no
        LEFT JOIN cabatuan_qrdtms.vendors
        ON items.vendor_code = vendors.vendor_code
        WHERE order_no = ?", 
        array(
            $this->security->xss_clean($id)
        ))->result_array();
    }

    public function get_items_pr($last_code){
        return $this->db->query("SELECT vendors.vendor_code, items.name, details.qty, items.uom, items.unit_price
        FROM cabatuan_qrdtms.details
        LEFT JOIN cabatuan_qrdtms.items
        ON items.id = details.item_id
        LEFT JOIN cabatuan_qrdtms.vendors
        ON vendors.id = details.vendor_id
        WHERE pr_no = ?",
        array(
            $this->security->xss_clean($last_code)
        ))->result_array();
    }

    public function create_validation(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->form_validation->set_rules('pr_no', 'PR Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required'); 
        $this->form_validation->set_rules('department', 'department', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');    
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return "success";
        }
    }

    public function item_validation(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'numeric'); 
        $this->form_validation->set_rules('uom', 'Unit of Measure', 'required');
        
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

    public function save_pr($pr_no){
        $query = "INSERT INTO requests (pr_no, created_by, created_at, updated_at) VALUES (?,?,?,?)";
        $values = array(
            $this->security->xss_clean($pr_no),
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        );
        $this->db->query($query, $values);
        return $pr_no;
    }
    
    public function get_save_pr($pr_no){
        return $this->db->query("SELECT * FROM requests WHERE pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array()[0];
    }

    public function update_pr($form_data){
        $this->db->query("UPDATE requests SET department = ?, description = ?, updated_at = ? WHERE pr_no = ?",
        array(
            $this->security->xss_clean($form_data['department']),
            $this->security->xss_clean($form_data['description']),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['pr_no'])
        ));
    }

    public function get_pr($pr_no){
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, items.description as item_name, items.uom, items.qty, requests.status, requests.approver_1, requests.approver_2, requests.approver_3, requests.approver_4, users.first_name, users.last_name, requests.created_at
        FROM cabatuan_qrdtms.requests
        LEFT JOIN cabatuan_qrdtms.users
        ON users.id = requests.created_by
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE requests.pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

    
    public function get_request($pr_no){
        return $this->db->query("SELECT requests.pr_no, requests.department, requests.description, items.description as item_name, items.vendor_code, items.uom, items.qty, requests.status, users.first_name, users.last_name, requests.created_at
        FROM cabatuan_qrdtms.requests
        LEFT JOIN cabatuan_qrdtms.users
        ON users.id = requests.created_by
        LEFT JOIN cabatuan_qrdtms.items
        ON items.pr_no = requests.pr_no
        WHERE requests.pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

    public function check_item_vendor($id){
        $code = '0';
        return $this->db->query("SELECT vendor_code FROM cabatuan_qrdtms.items WHERE pr_no = ? AND vendor_code = ? AND unit_cost IS NULL OR pr_no = ? AND vendor_code != ? AND unit_cost IS NULL",
        array(
            $this->security->xss_clean($id),
            $this->security->xss_clean($code),
            $this->security->xss_clean($id),
            $this->security->xss_clean($code)
        ))->result_array();
    }

    public function count_vendor($id){
        return $this->db->query("SELECT count(DISTINCT vendor_code) as vendor_count FROM cabatuan_qrdtms.items WHERE pr_no = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array();
    }

    public function sum_unitprice($pr_no){
        return $this->db->query("SELECT sum(items.unit_cost*items.qty) as total_cost, sum(qty) as total_qty
        FROM items
        WHERE items.pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array()[0];
    }

    public function check_pr_to_po($pr_no){
        return $this->db->query("SELECT order_no, pr_no FROM cabatuan_qrdtms.orders where pr_no = ?",
        array(
            $this->security->xss_clean($pr_no)
        ))->result_array();
    }

    public function po_sum($id){
        return $this->db->query("SELECT sum(items.qty * items.unit_cost) as total_price, sum(items.qty) as total_qty
        FROM cabatuan_qrdtms.orders
        LEFT JOIN cabatuan_qrdtms.requests
        ON orders.pr_no = requests.pr_no
        LEFT JOIN cabatuan_qrdtms.items
        ON requests.pr_no = items.pr_no
        LEFT JOIN cabatuan_qrdtms.vendors
        ON items.vendor_code = vendors.vendor_code
        WHERE order_no = ?",
        array(
            $this->security->xss_clean($id)
        ))->result_array()[0];
    }

    public function create_po($form_data){
        $query = "INSERT INTO orders (order_no, pr_no, created_by, created_at, updated_at) VALUES (?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($form_data['po_no']),
            $this->security->xss_clean($form_data['pr_no']),  
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))
        );
        return $this->db->query($query, $values);
    }

    public function update_approve($id){
        $level = $this->session->userdata('approver');
        $admin = $this->session->userdata('auth');
        if($level === '1'){
            $stat = '1';
            $this->db->query("UPDATE requests SET approver_1 = ?, created_at = ?, updated_at = ? WHERE pr_no = ?",
            array(
                $this->security->xss_clean($stat),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean($id)
            ));
        }
        elseif($level === '2'){
            $stat = '1';
            $this->db->query("UPDATE requests SET approver_2 = ?, created_at = ?, updated_at = ? WHERE pr_no = ?",
            array(
                $this->security->xss_clean($stat),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean($id)
            ));
        }
        elseif($level === '3'){
            $stat = '1';
            $this->db->query("UPDATE requests SET approver_3 = ?, created_at = ?, updated_at = ? WHERE pr_no = ?",
            array(
                $this->security->xss_clean($stat),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean($id)
            ));
        }
        elseif($level === '4'){
            $stat = '1';
            $status = '1';
            $this->db->query("UPDATE requests SET approver_4 = ?, status = ?, created_at = ?, updated_at = ? WHERE pr_no = ?",
            array(
                $this->security->xss_clean($stat),
                $this->security->xss_clean($status),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean($id)
            ));
        }
        elseif($admin){
            $stat = '1';
            $status = '1';
            $this->db->query("UPDATE requests SET approver_1 = ?, approver_2 = ?, approver_3 = ?, approver_4 = ?, status = ?, created_at = ?, updated_at = ? WHERE pr_no = ?",
            array(
                $this->security->xss_clean($stat),
                $this->security->xss_clean($stat),
                $this->security->xss_clean($stat),
                $this->security->xss_clean($stat),
                $this->security->xss_clean($status),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean($id)
            ));
        }

    }

    public function update_approve_po($id){
        $stat = '1';
        $this->db->query("UPDATE orders SET approver_1 = ?, created_at = ?, updated_at = ? WHERE order_no = ?",
        array(
            $this->security->xss_clean($stat),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($id)
        ));
        
    }
    
    public function update_disapprove($id){
        $stat = '2';
        $this->db->query("UPDATE requests SET status = ?, updated_at = ? WHERE pr_no = ?",
        array(
            $this->security->xss_clean($stat),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($id)
        ));
        
    }

    public function update_disapprove_po($id){
        $stat = '2';
        $this->db->query("UPDATE orders SET approver_1 = ?, updated_at = ? WHERE order_no = ?",
        array(
            $this->security->xss_clean($stat),
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($id)
        ));
        
    }

}