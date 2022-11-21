<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function view($id){
        $this->session->set_userdata(array('edit_id'=> $id));
        $data = $this->request->get_request($id);
        $sum = $this->request->sum_unitprice($id);
        $item = $this->request->fetch_request_item($id);
        $check = $this->request->check_item_vendor($id);
        $check_po = $this->request->check_pr_to_po($id);
        $po = $this->request->get_last_po();
        $count_vendor = $this->request->count_vendor($id);
        if($count_vendor[0]['vendor_count'] != '1'){
            $this->session->set_flashdata('warning', '<strong>Warning!</strong> The Items on this PR '.$id.' has multiple vendor, please use 1 vendor in all requested items. Update your item <a href="/dashboard/item">here</a>');
            $result = $this->request->fetch_all_generated_request($this->session->userdata('user_id'));
            $this->session->set_userdata('activity', 'PR '.$id.' attemp to create PO failed');
            $this->activity->log($this->session->userdata('user_id'));
            $list = array('list' => $result);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/list_request',$list);
            $this->load->view('templates/includes/footer');
        }
        elseif(count($check) >= 1){
            $this->session->set_flashdata('warning', '<strong>Warning!</strong> The Item on this PR '.$id.' should have a valid vendor or unit cost. Update your item <a href="/dashboard/item">here</a>');
            $result = $this->request->fetch_all_generated_request($this->session->userdata('user_id'));
            $this->session->set_userdata('activity', 'PR '.$id.' attemp to create PO failed');
            $this->activity->log($this->session->userdata('user_id'));
            $list = array('list' => $result);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/list_request',$list);
            $this->load->view('templates/includes/footer');
        }
        elseif(count($check_po) >= 1){
            $this->session->set_flashdata('warning', '<strong>Warning!</strong> The purchase order on this PR '.$id.' has been created. check this PO number <a href="/orders/view_docu/'.$check_po[0]['order_no'].'">'.$check_po[0]['order_no'].'</a>');
            $result = $this->request->fetch_all_generated_request($this->session->userdata('user_id'));
            $this->session->set_userdata('activity', 'atempt to duplicate PO '.$check_po[0]['order_no'].' of PR '.$id.'');
            $this->activity->log($this->session->userdata('user_id'));
            $list = array('list' => $result);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/list_request',$list);
            $this->load->view('templates/includes/footer');
        }
        else{
            $this->session->set_userdata('activity', 'initialized PO of PR '.$id.'');
            $this->activity->log($this->session->userdata('user_id'));
            $list = array('data'=>$data, 'sum' => $sum, 'items'=>$item, 'po'=>$po);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_order', $list);
            $this->load->view('templates/includes/footer');
        }

    }

    public function view_docu($id){
        $this->session->set_userdata(array('edit_id'=> $id));
        $data = $this->request->get_order($id);
        $sum = $this->request->po_sum($id);
        $list = array('data'=>$data, 'id'=>$id, 'sum'=>$sum);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/view_order', $list);
        $this->load->view('templates/includes/footer');
    }

    public function create_po(){
        $id = $this->session->userdata('user_id');
        $form_data = $this->input->post();
        $this->session->set_flashdata('success', '<strong>Successfully!</strong> Created');
        $this->session->set_userdata('activity', 'PO has been created successfully under PR '.$form_data['pr_no'].'');
        $this->activity->log($this->session->userdata('user_id'));
        $this->request->create_po($form_data);
        $this->email->create_po($form_data);
        $this->email->po_to_mm($form_data);
        redirect('/dashboard/list_order');
    }
}