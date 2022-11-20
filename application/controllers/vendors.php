<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {
    
    public function process_create() 
    {   
        $form_data = $this->input->post();
        $result = $this->vendor->create_validation($form_data);
        if($result!=null)
        {
            $this->session->set_flashdata('vendor_error', $result);
            $this->session->set_userdata('activity', 'Adding '.$form_data['name'].' to vendor failed');
            $this->activity->log($this->session->userdata('user_id'));
            $res = $this->vendor->get_allvendor();
            $list = array('list'=> $res);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_vendor', $list);
            $this->load->view('templates/includes/footer');
        }
        else
        {
            $last_code = $this->vendor->get_last_code();
            $this->vendor->create_vendor($form_data, $last_code);
            $this->session->set_userdata('activity', 'Adding '.$form_data['name'].' to vendor success');
            $this->activity->log($this->session->userdata('user_id'));
            $this->session->set_flashdata('input_errors', 'vendor created successfully');
            redirect("/dashboard/vendor");
        }
    }

    public function edit($id) 
    {
        $this->session->set_userdata(array('edit_id'=> $id));
        $details = $this->vendor->get_vendorby_id($id);
        $res = $this->vendor->get_allvendor();
        $list = array('list'=> $res, 'details'=>$details);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/edit_vendor', $list);
        $this->load->view('templates/includes/footer');
    }

    public function validate_update()
    {
        $id = $this->session->edit_id;
        $form_data = $this->input->post();
        $name = $this->input->post('name');
        $result = $this->vendor->validate_update($name, $id);
        
        if($result!=null) {
            $this->session->set_flashdata('input_errors', $result);
            $this->session->set_userdata('activity', 'Updating '.$form_data['name'].' details failed');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("vendors/edit/$id");
        } 
        else
        {
            $this->vendor->update_vendor($form_data);
            $this->session->set_flashdata('input_errors','The vendor successfully modified');
            $this->session->set_userdata('activity', 'Updating '.$form_data['name'].' details success');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/dashboard/vendor");
        }
    }

    public function block($id) 
    {
        $this->vendor->block_vendor_id($id);
        $this->session->set_flashdata('success','<strong>Successfully!</strong> block');
        $this->session->set_userdata('activity', 'Blocking vendor '.$id.' success');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('/dashboards/vendor');
    }

    public function unblock($id) 
    {
        $this->vendor->unblock_vendor_id($id);
        $this->session->set_flashdata('success','<strong>Successfully!</strong> unblock');
        $this->session->set_userdata('activity', 'Unblocking vendor '.$id.' success');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('/dashboards/vendor');
    }
    
}