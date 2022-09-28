<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    /*  DOCU: This function is triggered by default which displays the sign in/dashboard.
        Owner: 
    */
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
    
    /*  DOCU: This function is triggered when the sign in button is clicked. 
        This validates the required form inputs and if user password matches in the database by given email.
        If no problem occured, user will be routed to the dashboard.
        Owner: 
    */
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
                    $this->session->set_userdata(array('user_id'=>$user['id'], 'auth' => true));
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
    
    /*  DOCU: This function is triggered when the register button is clicked. 
        This validates the required form inputs then checks if the email is already taken. 
        If no problem occured, user information will be stored in database 
        and said user will be routed to the dashboard.
        Owner: 
    */
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
            $this->user->create_user($form_data);
            
            redirect("/dashboard/users");
        }
    }

    /*  DOCU: This function loads the details of current user in profile page.
        Owner: 
    */
    public function profile() 
    {   
        $user_id = $this->session->user_id;
        $user = $this->user->get_user_id($user_id);
        $details = array('details'=>$user);
        $this->load->view('templates/header');
        $this->load->view('users/edit',$details); 
    }

    /*  DOCU: This function validate the user information.
        Owner: 
    */
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
    
    /*  DOCU: This function validate the user credentials input.
        Owner: 
    */
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
    
}
