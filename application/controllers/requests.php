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

    public function generate_PR(){
        $form_data = $this->input->post();
        $res = $this->request->generate_PR($form_data);
        if($res === 'success'){
            $this->session->set_flashdata('input_errors', 'Purchase Request created successfully');
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

    public function process_create() 
    {   
        $form_data = $this->input->post();

        if($form_data['vendor'] !== 'Select Vendor'){
            $result = $this->request->create_validation($form_data);
            if($result!='success')
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("/dashboard/pr_details");
            }
            else
            {   
                $result = $this->request->get_vendorby_id($form_data);
                $this->request->save_pr($form_data, $result);
                redirect('requests');
            }
        }
        else{
            $date = date("Y-m-d, H:i:s");
            $pr_no = $this->request->get_last_pr();
            $vendor = $this->request->get_all_vendor();
            $items = $this->request->get_items_pr($pr_no);
            $error =  $this->session->set_flashdata('input_errors', 'The Vendor field is required please select vendor.');
            $list = array('pr_no' => $pr_no, 'date' => $date, 'vendor' => $vendor, 'items' => $items);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_pr', $list);
            $this->load->view('templates/includes/footer');
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
        // $list = array('data'=>$data);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/view_request', $list);
        $this->load->view('templates/includes/footer');
    }
}