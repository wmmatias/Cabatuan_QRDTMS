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
        $department = $this->dashboard->get_department();
        $this->session->set_userdata(array('edit_id'=> $id));
        $result = $this->user->get_user_id($id);
        $list = array('list' => $result, 'department'=>$department);  

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
                $approver = $this->user->validate_is_approver($user_name);
                if(!empty($is_admin)){
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'firstname'=>$user['first_name'], 'department'=>$user['department'], 'auth' => true));
                    $this->session->set_userdata('activity', ''.$user['first_name'].' successfully logged in');
                    $this->activity->log($user['id']);
                    redirect("dashboard");
                }
                elseif(!empty($approver)){
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'firstname'=>$user['first_name'], 'department'=>$user['department'], 'approver'=>$user['app_level']));
                    $this->session->set_userdata('activity', ''.$user['first_name'].' successfully logged in');
                    $this->activity->log($user['id']);
                    redirect("dashboard");
                }
                else{
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'firstname'=>$user['first_name'], 'department'=>$user['department'], 'user'=>'user'));
                    $this->session->set_userdata('activity', ''.$user['first_name'].' successfully logged in');
                    $this->activity->log($user['id']);
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
        $form_data = $this->input->post();

        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            $this->session->set_userdata('activity', 'Adding '.$form_data['firstname'].' '.$form_data['lastname'].' to user failed');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/dashboard/add");
        }
        elseif($this->input->post('userlevel') === 'empty'){
            $this->session->set_flashdata('userlevel', '<p class="text-danger">please select user level</p>');
            $this->session->set_userdata('activity', 'Adding '.$form_data['firstname'].' '.$form_data['lastname'].' to user failed');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/dashboard/add");
        }
        elseif($this->input->post('department') === 'empty'){
            $this->session->set_flashdata('department', '<p class="text-danger">please select department</p>');
            $this->session->set_userdata('activity', 'Adding '.$form_data['firstname'].' '.$form_data['lastname'].' to user failed');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/dashboard/add");
        }
        else
        {
            $this->user->create_user($form_data);
            $this->session->set_flashdata('success', '<strong>Successfully</strong> Created!');
            $this->session->set_userdata('activity', 'Adding '.$form_data['firstname'].' '.$form_data['lastname'].' to user success');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/dashboard/users");
        }
    }

    public function profile() 
    {   
        $user_id = $this->session->user_id;
        $user = $this->user->get_user_id($user_id);
        $details = array('details'=>$user);
        $this->load->view('templates/includes/header');
        $this->load->view('templates/includes/sidebar');
        $this->load->view('admin/dist/edit_profile', $details);
        $this->load->view('templates/includes/footer');
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
            redirect("/users/edit");
        }
    }
   
    public function edit_credentials() 
    {   
        $checkpassword = $this->input->post();
        $result = $this->user->validate_change_password($checkpassword);
        if(!empty($result)) {
            $this->session->set_flashdata('errors', $result);
            $this->profile();
        } 
        else
        {  
            $form_data = $this->input->post();
            $this->user->update_credentials($form_data);
            $this->session->set_flashdata('success','<strong>Successfully!</strong> Your credential successfully update');
            $this->profile();
        }
    }

    public function block($id) 
    {  
        $this->user->block_user_id($id);
        $this->session->set_flashdata('success','<strong>Successfully!</strong> block');
        $this->session->set_userdata('activity', 'Blocking user '.$id.' success');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('/dashboards/users');
    }
    
    public function unblock($id) 
    {  
        $this->user->unblock_user_id($id);
        $this->session->set_flashdata('success','<strong>Successfully!</strong> unblock');
        $this->session->set_userdata('activity', 'Unblocking user '.$id.' success');
        $this->activity->log($this->session->userdata('user_id'));
        redirect('/dashboards/users');
    }

    public function process_user_modification() 
    {   
        $edit_id = $this->session->edit_id;
        $user = $this->input->post('username');
        $result = $this->user->validate_user_details($user, $edit_id);
        $form_data = $this->input->post();
        
        if($result!=null) {
            $this->session->set_flashdata('input_errors', $result);
            $this->session->set_userdata('activity', 'Updating '.$form_data['firstname'].' '.$form_data['lastname'].' details failed');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/users/edit/$edit_id");
        } 
        else
        {
            $this->user->update_userinformation($form_data);
            $this->session->set_flashdata('success','The user successfully modified');
            $this->session->set_userdata('activity', 'Updating '.$form_data['firstname'].' '.$form_data['lastname'].' details success');
            $this->activity->log($this->session->userdata('user_id'));
            redirect("/users/edit/$edit_id");
        }
        
    }
    
}
