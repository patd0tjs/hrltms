<?php 

class Pages extends CI_Controller{
    public function date(){
        $date = $this->input->post('date');

        $pieces = explode(",", $date);
        print_r($pieces);
    }

    public function demo(){
        $this->load->view('demo');
    }
    public function index(){
        // check session
        if($this->session->id){

            // check if user is admin
            if($this->session->id == 'admin'){
                redirect('admin');
            } else {
                redirect('profile');
            }
        } else {
            redirect('login');
        }
    }


    public function login(){
        $this->session->unset_userdata('id');
        $this->load->view('pages/login');
    }

    // admin's pages
    public function dashboard(){
        if($this->session->id == 'admin'){
            $this->load->view('components/header');
            $this->load->view('pages/admin/dashboard');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function employees(){
        if($this->session->id == 'admin'){
            $data = array(
                'departments'  => $this->Users_model->get_departments(),
                'designations' => $this->Users_model->get_designations(),
                'employees'    => $this->Users_model->get_employees()
            );

            $this->load->view('components/header');
            $this->load->view('pages/admin/employees', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function leaves(){
        if($this->session->id == 'admin'){
            $this->load->view('components/header');
            $this->load->view('pages/admin/dashboard');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function tardy(){
        if($this->session->id == 'admin'){
            $this->load->view('components/header');
            $this->load->view('pages/admin/dashboard');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    // employees' pages
    public function my_profile(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){
            $this->load->view('components/header');
            $this->load->view('pages/profile');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function my_leaves(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){
            $this->load->view('components/header');
            $this->load->view('pages/leaves');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function my_tardy(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){
            $this->load->view('components/header');
            $this->load->view('pages/tardy');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }
}