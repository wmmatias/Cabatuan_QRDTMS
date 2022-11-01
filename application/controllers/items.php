<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public function process_create() 
    {   
        $form_data = $this->input->post();
        $code = $form_data['vendorcode'];
        $result = $this->item->create_validation($form_data);
        $exist= $this->item->vendor_exist($code);
        if($result!='success')
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/dashboard/item");
        }
        elseif(empty($exist)){
            $this->session->set_flashdata('input_errors', 'Vendor not found');
            redirect("/dashboard/item");
        }
        else
        {
            $last_code = $this->item->get_last_code();
            $this->item->create_item($form_data, $last_code);
            $this->session->set_flashdata('input_errors', 'item created successfully');

            $res = $this->item->get_allitem();
            $list = array('list'=> $res, 'exist'=>$exist);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_item', $list);
            $this->load->view('templates/includes/footer');
        }
    }

    public function edit($id) 
    {
        $this->session->set_userdata(array('edit_id'=> $id));
        $details = $this->item->get_itemby_id($id);
        $res = $this->item->get_allitem();
        $list = array('list'=> $res, 'details'=>$details);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/edit_item', $list);
        $this->load->view('templates/includes/footer');
    }

    public function validate_update(){
        $id = $this->session->edit_id;
        $form_data = $this->input->post();
        $code = $form_data['vendorcode'];
        $result = $this->item->validate_update();
        $exist= $this->item->vendor_exist($code);

        if($result!='success')
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/dashboard/item");
        }
        elseif(empty($exist)){
            $this->session->set_flashdata('input_errors', 'Vendor not found');
            redirect("/dashboard/item");
        }
        else
        {
            $this->item->update_item($form_data);
            $this->session->set_flashdata('input_errors','The vendor successfully modified');

            $res = $this->item->get_allitem();
            $list = array('list'=> $res, 'exist'=>$exist);
            $this->load->view('templates/includes/header');
            $this->load->view('templates/includes/sidebar');
            $this->load->view('admin/dist/add_item', $list);
            $this->load->view('templates/includes/footer');
        }
    }

    public function delete($id) 
    {
        $this->item->delete_item_id($id);
        redirect('/dashboards/item');
    }

    
}