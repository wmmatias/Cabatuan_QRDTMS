<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {
    public function index() 
    {   
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            redirect("users");
        } 
        else {
            $total = $this->dashboard->total();
            $pending = $this->dashboard->pending();
            $approved = $this->dashboard->approved();
            $cancelled = $this->dashboard->cancelled();
            $po_total = $this->dashboard->po_total();
            $po_pending = $this->dashboard->po_pending();
            $po_approved = $this->dashboard->po_approved();
            $po_cancelled = $this->dashboard->po_cancelled();
            $data = array('total'=>$total, 'pending'=>$pending, 'approved'=>$approved, 'cancel'=>$cancelled, 'po_total'=>$po_total, 'po_pending'=>$po_pending, 'po_approved'=>$po_approved, 'po_cancel'=>$po_cancelled);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/index', $data);
            $this->load->view('templates/includes/footer');
        }
    }

    public function users() 
    {
        $result = $this->user->get_all_user();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_users',$list);
        $this->load->view('templates/includes/footer');
    }

    public function addusers() 
    {
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_users');
        $this->load->view('templates/includes/footer');
    }

    public function vendor() 
    {
        $res = $this->vendor->get_allvendor();
        $list = array('list'=> $res);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_vendor', $list);
        $this->load->view('templates/includes/footer');
    }

    public function item() 
    {
        $res = $this->item->get_allitem();
        $list = array('list'=> $res);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_item', $list);
        $this->load->view('templates/includes/footer');
    }
    
    public function request() 
    {
        redirect('requests');
    }

    public function pr_details() 
    {
        $date = date("Y-m-d, H:i:s");
        $pr_no = $this->request->get_last_pr();
        $create = $this->request->save_pr($pr_no);
        $details = $this->request->get_save_pr($create);
        $this->session->set_userdata('last_save_pr', ''.$create.'');
        $this->session->set_userdata('activity', 'Attepmt to create PR '.$pr_no.'');
        $this->activity->log($this->session->userdata('user_id'));
        $list = array('pr_no' => $create, 'date' => $date, 'details'=>$details);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_pr', $list);
        $this->load->view('templates/includes/footer');
    }
    
    public function order() 
    {
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_order');
        $this->load->view('templates/includes/footer');
    }

    public function list_request() 
    {
        $result = $this->request->fetch_all_generated_request();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_request',$list);
        $this->load->view('templates/includes/footer');
    }
    
    public function list_order() 
    {
        $result = $this->request->fetch_all_generated_order();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_order',$list);
        $this->load->view('templates/includes/footer');
    }

    public function list_logs() 
    {
        $result = $this->activity->fetch_all_logs();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_logs',$list);
        $this->load->view('templates/includes/footer');
    }

    public function approval_order() 
    {   
        $approver = $this->session->userdata('approver');
        $result = $this->request->fetch_all_order_approval($approver);
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/approval_order',$list);
        $this->load->view('templates/includes/footer');
    }

    
    public function report() 
    {   
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/view_report');
        $this->load->view('templates/includes/footer');
    }

    public function approval_request() 
    {
        $approver = $this->session->userdata('approver');
        $result = $this->request->fetch_all_request_approval($approver);
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/approval_request',$list);
        $this->load->view('templates/includes/footer');
    }

    public function logoff() 
    {
        $this->session->sess_destroy();
        $this->session->set_userdata('activity', ''.$this->session->userdata('firstname').' successfully logged out');
        $this->activity->log($this->session->userdata('user_id'));
        redirect("users");   
    }

    
}
