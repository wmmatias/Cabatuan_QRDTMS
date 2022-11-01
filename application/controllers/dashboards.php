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
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/index');
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
        // $this->load->view('templates/includes/header');
        // $this->load->view('templates/includes/sidebar');
        // $this->load->view('admin/dist/add_request');
        // $this->load->view('templates/includes/footer');
        redirect('requests');
    }

    public function pr_details() 
    {
        $date = date("Y-m-d, H:i:s");
        $pr_no = $this->request->get_last_pr();
        $vendor = $this->request->get_all_vendor();
        $items = $this->request->get_items_pr($pr_no);
        $list = array('pr_no' => $pr_no, 'date' => $date, 'vendor' => $vendor, 'items' => $items);
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
        $result = $this->request->fetch_all_generated_request($this->session->userdata('user_id'));
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_request',$list);
        $this->load->view('templates/includes/footer');
    }
    
    public function list_order() 
    {
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_order');
        $this->load->view('templates/includes/footer');
    }

    public function logoff() 
    {
        $this->session->sess_destroy();
        redirect("users");   
    }

    
}
