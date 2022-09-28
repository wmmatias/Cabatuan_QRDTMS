<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Controller {
    
    /*  DOCU: This function is triggered by default which displays the dashboard.
        Owner: QRDTMS
    */
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

    /*  DOCU: This function logs out the current user then goes to sign in page.
        Owner: 
    */
    public function users() 
    {
        $result = $this->user->get_all_user();
        $list = array('list' => $result);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/list_users',$list);
        $this->load->view('templates/includes/footer');
    }

    /*  DOCU: This function logs out the current user then goes to sign in page.
        Owner: 
    */
    public function addusers() 
    {
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/add_users');
        $this->load->view('templates/includes/footer');
    }

    /*  DOCU: This function logs out the current user then goes to sign in page.
        Owner: 
    */
    public function logoff() 
    {
        $this->session->sess_destroy();
        redirect("users");   
    }

    
}
