<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    /*  DOCU: This function retrieves user information filtered by email.
        Owner: Wilard
    */
    function get_user($user)
    { 
        $query = "SELECT * FROM users WHERE user_name = ?";
        return $this->db->query($query, $this->security->xss_clean($user))->result_array()[0];
    }
    
    /*  DOCU: This function retrieves user information filtered by email.
        Owner: Wilard
    */
    function get_all_user()
    { 
        $query = "SELECT * FROM users";
        return $this->db->query($query)->result_array();
    }

    /*  DOCU: This function inserts new user info upon registration.
        Owner: Wilard
    */
    function create_user($user)
    {
        $password = 'P@ssw0rd';
        $query = "INSERT INTO Users (first_name, last_name, user_name, password, user_level,created_at,updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['firstname']), 
            $this->security->xss_clean($user['lastname']), 
            $this->security->xss_clean($user['username']), 
            md5($this->security->xss_clean($password)),
            $this->security->xss_clean($user['userlevel']), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean(date("Y-m-d, H:i:s"))); 
        
        return $this->db->query($query, $values);
    }

    /*  DOCU: This function checks if all required fields were filled up.
        Owner: Wilard
    */
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
    
    /*  DOCU: This function contains simple condition to match database record and user input in password.
        Owner: Wilard
    */
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

    /*  DOCU: This function checks required input fields and if unique email.
        Owner: Wilard
    */
    function validate_registration($user) 
    {
        var_dump($_POST);
        // $this->form_validation->set_error_delimiters('<div>','</div>');
        // $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
        // $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');   
        // $this->form_validation->set_rules('username', 'User Name', 'required');        
        // $this->form_validation->set_rules('userlevel', 'User Level', 'required');
        
        // if(!$this->form_validation->run()) {
        //     return validation_errors();
        // }
        // else if($this->get_user($user)) {
        //     return "User name already taken.";
        // }
    }

    /*  DOCU: This function return details of current user.
        Owner: Wilard
    */
    function get_user_id($id)
    {
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    /*  DOCU: This function checks required input fields in modifying information.
        Owner: Wilard
    */
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

     /*  DOCU: This function is updating the user information after validation.
        Owner: Wilard
    */
    function update_userinformation($form_data) 
    {
        return $this->db->query("UPDATE users SET first_name = ?, last_name = ?, email = ?, updated_at = ? WHERE id = ?", 
        array(
            $this->security->xss_clean($form_data['first_name']), 
            $this->security->xss_clean($form_data['last_name']),
            $this->security->xss_clean($form_data['email']), 
            $this->security->xss_clean(date("Y-m-d, H:i:s")),
            $this->security->xss_clean($form_data['id'])));
    }

    /*  DOCU: This function checks required input fields in modifying credentials.
        Owner: Wilard
    */
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

    /*  DOCU: This function is for checking of inputed old password and stored password to database.
       Owner: Wilard
   */
    function check_password($password){
         return $this->db->query("SELECT password FROM users WHERE id=? and password = ?", 
        array(
            $this->security->xss_clean($password['id']),
            md5($this->security->xss_clean($password['old_password']))))->row_array(); 
    }

    /*  DOCU: This function is for updating credentials.
        Owner: Wilard
    */
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