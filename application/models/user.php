<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function get_user($user)
    { 
        $query = "SELECT * FROM users WHERE user_name = ?";
        return $this->db->query($query, $this->security->xss_clean($user))->result_array()[0];
    }

    function get_user_username($user, $user_id)
    { 
        $query = "SELECT * FROM users WHERE user_name = ? AND id != ?";
        $values = array(
            $this->security->xss_clean($user),
            $this->security->xss_clean($user_id)
        );
        return $this->db->query(
            $query, 
            $values
            )->result_array();
    }
    
    function get_all_user()
    { 
        $query = "SELECT * FROM users ORDER BY created_at DESC";
        return $this->db->query($query)->result_array();
    }

    public function delete_user_id($id) {
        return $this->db->query("DELETE FROM users WHERE id = ?", 
        array(
            $this->security->xss_clean($id)));
    }

    function create_user($user)
    {
        $password = 'P@ssw0rd';
        $query = "INSERT INTO Users (first_name, last_name, user_name, email, password, user_level,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['firstname']), 
            $this->security->xss_clean($user['lastname']), 
            $this->security->xss_clean($user['username']), 
            $this->security->xss_clean($user['email']), 
            md5($this->security->xss_clean($password)),
            $this->security->xss_clean($user['userlevel']), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))); 
        
        return $this->db->query($query, $values);
    }

    function validate_signin_form() {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('user_name', 'UserName', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }
    
    function validate_signin_match($user, $password) 
    {
        $hash_password = md5($this->security->xss_clean($password));

        if($user && $user['password'] == $hash_password) {
            return "success";
        }
        else {
            return "Incorrect username/password.";
        }
    }
    function validate_is_admin($user_name) 
    {
        $query = "SELECT user_level FROM users WHERE user_name = ? and user_level = 0";
        return $this->db->query($query, $this->security->xss_clean($user_name))->result_array()[0];
    }

    function validate_registration($user) 
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');   
        $this->form_validation->set_rules('username', 'User Name', 'required');  
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails');        
        $this->form_validation->set_rules('userlevel', 'User Level', 'required');
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_user($user)) {
            return "User name already taken.";
        }
    }

    function validate_user_details($user, $user_id)
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');   
        $this->form_validation->set_rules('username', 'User Name', 'required');  
        $this->form_validation->set_rules('email', 'Email', 'required|valid_emails');        
        $this->form_validation->set_rules('userlevel', 'User Level', 'required');
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_user_username($user, $user_id)) {
            return "User name already taken.";
        }
    }

    function get_user_id($id)
    {
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    function validate_information() 
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');   
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else{
            return 'success';
        }
    }

    function update_userinformation($form_data) 
    {
        return $this->db->query("UPDATE users SET first_name = ?, last_name = ?, user_name = ?, email = ?, user_level = ?,updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['firstname']), 
            $this->security->xss_clean($form_data['lastname']),
            $this->security->xss_clean($form_data['username']),
            $this->security->xss_clean($form_data['email']), 
            $this->security->xss_clean($form_data['userlevel']), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    function validate_change_password($password = NULL) 
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');   
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');  
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if(empty($this->check_password($password))){
                return 'incorrect old password';
        }
    }

    function check_password($password){
         return $this->db->query("SELECT password FROM users WHERE id=? and password = ?", 
        array(
            $this->security->xss_clean($password['id']),
            md5($this->security->xss_clean($password['old_password']))))->row_array(); 
    }

    function update_credentials($form_data) 
    {
        return $this->db->query("UPDATE users SET password = ?, updated_at = ? WHERE id = ?", 
        array(
            md5($this->security->xss_clean($form_data['password'])), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }
    
}

?>