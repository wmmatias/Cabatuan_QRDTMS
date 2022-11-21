<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends CI_Controller {

    public function index_html(){
        $result["list"] = $this->request->fetch_all();
	    $this->load->view("partials/item", $result);
    }

    public function to_request(){
        $result["list"] = $this->request->fetch_all_request();
	    $this->load->view("partials/request", $result);
    }

    public function search(){
        $data = $this->input->post();
        $result["list"] = $this->request->search($data);
	    $this->load->view("partials/item", $result);
    }

    
    public function delete(){
        $id = $this->session->userdata('user_id');
        $result["list"] = $this->request->delete($id);
	    $this->load->view("partials/request", $result);
    }

    public function update(){
        $form_data = $this->input->post();
        $result["list"] = $this->request->update($form_data);
	    $this->load->view("partials/request", $result);
    }

    public function delete_line(){
        $form_data = $this->input->post();
        $result["list"] = $this->request->delete_line($form_data);
	    $this->load->view("partials/request", $result);
    }

    public function add_item(){
        $pr_no = $this->session->userdata('last_save_pr');
        $item = $this->request->fetch_request_item($pr_no);
        $data = array('items'=>$item, 'pr_no'=>$pr_no);
	    $this->load->view("partials/pr_items", $data);
    }

    public function cancel_requests($id){
        $this->session->set_flashdata('warning', '<strong>Warning</strong>Purchase Request cancelled');
        $this->session->set_userdata('activity', 'PR '.$id.' cancel creation');
        $this->activity->log($this->session->userdata('user_id'));
        $this->request->cancel_request($id);
        redirect('dashboards/list_request');
    }

    public function initial_item_validation(){
        $form_data = $this->input->post();
        $result = $this->request->item_validation();
        if($result!='success')
        {
            $this->session->set_flashdata('initial', $result);
            $this->add_item();
        }
        else
        {   
            $this->request->add_initial_item($form_data);
            $this->add_item();
        }
    }

    public function initial_item_delete(){
        $form_data = $this->input->post();
        $this->request->delete_initial($form_data);
        $this->add_item();
    }

    public function generate_PR(){
        $form_data = $this->input->post();
        $res = $this->request->generate_PR($form_data);
        if($res === 'success'){
            $this->session->set_flashdata('input_errors', 'Purchase Request created successfully <a href="/dashboard/list_request">view here</a>');
            redirect('dashboard/pr_details');
        }
        else{
            $this->session->set_flashdata('input_errors', 'something went wrong!');
            redirect('dashboard/request');
        }
    }

    public function requested_item(){
        $form_data = $this->input->post();
        $check_item = $this->request->check_item($form_data);
        $result["list"] = $this->request->fetch_all_request();
        if(!empty($check_item)){
            $this->load->view("partials/request", $result);
        }
        else{
            $result["list"] = $this->request->requested_item($form_data);
            $this->load->view("partials/request", $result);
        }
    }

    public function process_create($pr_no) 
    {   
        $form_data = $this->input->post();
        $result = $this->request->create_validation($form_data);
        if($result!='success')
        {
            $this->session->set_flashdata('errors', $result);
            $date = date("Y-m-d, H:i:s");
            $details = $this->request->get_save_pr($pr_no);
            $list = array('pr_no' => $pr_no, 'date' => $date, 'details'=>$details);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_pr', $list);
            $this->load->view('templates/includes/footer');
        }
        else
        {   
            $id = $this->session->userdata('user_id');
            $this->session->set_flashdata('warning', '<strong>Successfully</strong> Created');
            $this->request->update_pr($form_data);
            $this->email->create_pr($form_data, $id);
            $this->email->to_mbo($form_data);
            $this->session->set_userdata('activity', 'PR '.$pr_no.' created successfully');
            $this->activity->log($this->session->userdata('user_id'));
            redirect('dashboards/list_request');
        }
    }

    public function index(){
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_request');
        $this->load->view('templates/includes/footer');
    }

    public function view($id){
        $this->session->set_userdata(array('edit_id'=> $id));
        $data = $this->request->get_pr($id);
        $sum = $this->request->sum_unitprice($id);
        $list = array('data'=>$data, 'sum' => $sum);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/view_request', $list);
        $this->load->view('templates/includes/footer');
    }

    public function qrcode($id){
        $pr_no = $id;
        qrcode::png(
            $pr_no,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 4,
            $margin = 1
        );
    }

    public function approved($id){
        $this->session->set_flashdata('warning', '<strong>Successfully!</strong> The '.$id.' has been approved!');
        $this->request->update_approve($id);
        $this->session->set_userdata('activity', 'PR '.$id.' approved successfully');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('dashboard/list_request');
    }
    
    public function approved_po($id){
        $this->session->set_flashdata('warning', '<strong>Successfully!</strong> The '.$id.' has been approved!');
        $this->request->update_approve_po($id);
        $this->session->set_userdata('activity', 'PO '.$id.' approved successfully');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('dashboard/list_order');
    }

    
    public function disapproved($id){
        $this->session->set_flashdata('warning', '<strong>Successfully!</strong> The '.$id.' has been disapproved!');
        $this->request->update_disapprove($id);
        $this->session->set_userdata('activity', 'PR '.$id.' disapproved successfully');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('dashboard/list_request');
    }
    
    public function disapproved_po($id){
        $this->session->set_flashdata('warning', '<strong>Successfully!</strong> The '.$id.' has been disapproved!');
        $this->request->update_disapprove_po($id);
        $this->session->set_userdata('activity', 'PO '.$id.' disapproved successfully');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('dashboard/list_order');
    }
}