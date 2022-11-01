<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function index() 
    {   
        $current_user_id = $this->session->userdata('user_id');
        if(!$current_user_id) { 
            $this->load->view('templates/header');
            $this->load->view('users/signin');
            $this->load->view('templates/footer');
        } 
        else {
            redirect("dashboard");
        }
    }
    
    public function edit($id) 
    {   
        $this->session->set_userdata(array('edit_id'=> $id));
        $result = $this->user->get_user_id($id);
        $list = array('list' => $result);  

        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/edit_user',$list);
        $this->load->view('templates/includes/footer');
    }

    public function process_signin() 
    {
        $result = $this->user->validate_signin_form();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/");
        } 
        else 
        {
            $user_name = $this->input->post('user_name');
            $user = $this->user->get_user($user_name);
            
            $result = $this->user->validate_signin_match($user, $this->input->post('password'));
            
            if($result == "success") 
            {   
                $is_admin = $this->user->validate_is_admin($user_name);
                if(!empty($is_admin)){
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'firstname'=>$user['first_name'], 'userlevel'=>$user['user_level'], 'auth' => true));
                    redirect("dashboard");
                }
                else{
                    $this->session->set_userdata(array('user_id'=>$user['id']));
                    redirect("dashboard");
                }
            }
            else 
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("/");
            }
        }

    }
    
    public function process_registration() 
    {   
        $username = $this->input->post('username');
        $result = $this->user->validate_registration($username);
        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("/dashboard/add");
        }
        else
        {
            $form_data = $this->input->post();
            if($form_data['userlevel'] === 'Select Level'){
                $this->session->set_flashdata('input_errors', 'Select User Level');
                redirect("/dashboard/add");
            }
            else{
                $this->user->create_user($form_data);
                redirect("/dashboard/users");
            }
        }
    }

    public function profile() 
    {   
        $user_id = $this->session->user_id;
        $user = $this->user->get_user_id($user_id);
        $details = array('details'=>$user);
        $this->load->view('templates/header');
        $this->load->view('users/edit',$details); 
    }

    public function edit_information_process() 
    {   
        $result = $this->user->validate_information();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("users/edit");
        } 
        else
        {
            $form_data = $this->input->post();
            $this->user->update_userinformation($form_data);
            $this->session->set_flashdata('success','The user information successfully modified');
            redirect("users/edit");
        }
    }
   
    public function edit_credentials() 
    {   
        $this->output->enable_profiler(TRUE);
        $checkpassword = $this->input->post();
        $result = $this->user->validate_change_password($checkpassword);
        if(!empty($result)) {
            $this->session->set_flashdata('credentials_errors', $result);
            redirect("users/edit");
        } 
        else
        {  
            $form_data = $this->input->post();
            $this->user->update_credentials($form_data);
            $this->session->set_flashdata('successc','your credential successfully update');
            redirect("users/edit");
        }
    }

    public function delete($id) 
    {  
        $this->user->delete_user_id($id);
        redirect('/dashboards/users');
    }

    public function process_user_modification() 
    {   
        $edit_id = $this->session->edit_id;
        $user = $this->input->post('username');
        $result = $this->user->validate_user_details($user, $edit_id);
        
        if($result!=null) {
            $this->session->set_flashdata('input_errors', $result);
            redirect("users/edit/$edit_id");
        } 
        else
        {
            $form_data = $this->input->post();
            $this->user->update_userinformation($form_data);
            $this->session->set_flashdata('input_errors','The user successfully modified');
            redirect("users/edit/$edit_id");
        }
        
    }
    
}
