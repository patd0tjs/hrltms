<?php
class DateAndTime extends CI_Controller{
    public function add_schedule(){
        if($this->session->id){

            if ($this->session->id == 'admin'){
                $this->DateAndTime_model->add_schedule();
                redirect('admin/schedules');
            } else {
                $this->session->set_flashdata('error', 'You are not allowed to visit this page');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function add_dtr(){
        if($this->session->id){

            if ($this->session->id == 'admin'){
                $this->DateAndTime_model->add_dtr();
                redirect('admin/dtr');
            } else {
                $this->session->set_flashdata('error', 'You are not allowed to visit this page');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }
}