<?php
class Reports extends CI_Controller{
    public function export(){
        if($this->session->id == 'admin'){
            $this->Report_model->generate_report();
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function export_leaves(){
        if($this->session->id == 'admin'){
            $this->Report_model->leaves_report();
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function pdf(){
        $this->Report_model->tcpdf();
    }
}