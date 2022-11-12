<?php
class Users extends CI_Controller{
    public function login(){
        if($this->Users_model->login()){
            echo 'ok';
        } else {
            echo 'no';
        }
    }
}