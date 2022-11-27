<?php
class Users extends CI_Controller{
    public function login(){
        $this->Users_model->login();
        redirect('');
    }

    // admin functions
    public function add_emp(){
        if($this->session->id){

            if ($this->session->id == 'admin'){
                $this->Users_model->add_employee();
                redirect('admin/employees');
            } else {
                $this->session->set_flashdata('error', 'You are not allowed to visit this page');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function edit_emp(){
        if($this->session->id){

            if ($this->session->id == 'admin'){
                $this->Users_model->edit_employee();
                redirect('admin/employees');
            } else {
                $this->session->set_flashdata('error', 'You are not allowed to visit this page');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function check_username(){
        if($this->Users_model->recover_account()){
            redirect('validate');
        } else {

            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('recovery');
        }
    }

    public function validate_code(){
        if($this->session->recovery_id){

            if($this->Users_model->validate_code()){
                redirect('password_recovery');
            } else {
                $this->session->set_flashdata('error', 'You are not allowed to visit this page');
                redirect('recovery');
            }
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function recover_password(){
        if($this->session->recovery_id){

            if($this->Users_model->recover_password()){
                $this->session->set_flashdata('success', 'Password change success! <br> You may now login using your new password');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Passwords does not match!');
                redirect('password_recovery');
            }
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function change_password(){
        if($this->session->id){

            if($this->Users_model->change_password()){
                $this->session->set_flashdata('success', 'Password change success! <br> You may now login using your new password');
                redirect('');
            } else {
                $this->session->set_flashdata('error', 'Passwords does not match!');
                redirect('');
            }
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }
    
}