<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {
    
    public function process_create() 
    {   
        $form_data = $this->input->post();
        $result = $this->vendor->create_validation($form_data);
        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/dashboard/vendor");
        }
        else
        {
            $last_code = $this->vendor->get_last_code();
            $this->vendor->create_vendor($form_data, $last_code);
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
        $name = $this->input->post('name');
        $result = $this->vendor->validate_update($name, $id);
        
        if($result!=null) {
            $this->session->set_flashdata('input_errors', $result);
            redirect("vendors/edit/$id");
        } 
        else
        {
            $form_data = $this->input->post();
            $this->vendor->update_vendor($form_data);
            $this->session->set_flashdata('input_errors','The vendor successfully modified');
            redirect("/dashboard/vendor");
        }
    }

    public function delete($id) 
    {
        $this->vendor->delete_vendor_id($id);
        redirect('/dashboards/vendor');
    }
    
}