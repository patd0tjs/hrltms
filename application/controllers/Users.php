<?php
class Users extends CI_Controller{
    public function login(){
        $this->Users_model->login();
        redirect('');
    }

    public function add_emp(){
        if ($this->session->id){
            echo 'ok';
        } else {
            echo 'no';
        }
        echo $this->session->id;
    }
}