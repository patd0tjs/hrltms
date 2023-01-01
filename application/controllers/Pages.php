<?php 

class Pages extends CI_Controller{
    public function index(){
        $this->session->keep_flashdata('error');
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

    public function recovery(){
        $this->load->view('components/header');
        $this->load->view('pages/recovery');;
    }

    public function login(){
        $this->session->unset_userdata('id');
        $this->load->view('components/header');
        $this->load->view('pages/login');;
    }

    // admin's pages
    public function dashboard(){
        if($this->session->id == 'admin'){
            $data = array(
                'title'          => "Dashboard",
                'employees'      => $this->Users_model->get_employees(),
                'tardies'        => $this->DateAndTime_model->get_tardy(),
                'leaves'         => $this->DateAndTime_model->get_approved_leaves(),
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/dashboard', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function employees(){
        if($this->session->id == 'admin'){
            if($this->input->post('department')){
                $employees = $this->Users_model->filter_employees();
            } else {
                $employees = $this->Users_model->get_employees();
            }

            $data = array(
                'departments'    => $this->Users_model->get_departments(),
                'designations'   => $this->Users_model->get_designations(),
                'employees'      => $employees,
                'title'          => 'Employees',
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );

            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/employees', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function leaves(){
        if($this->session->id == 'admin'){

            $data = array(
                'title'          => 'Employee Leave Requests',
                'employees'      => $this->Users_model->get_employees(),
                'pending'        => $this->DateAndTime_model->get_pending_leaves(),
                'approved'       => $this->DateAndTime_model->get_approved_leaves(),
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/leaves', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function tardy(){
        if($this->session->id == 'admin'){
            $data = array(
                'tardies'        => $this->DateAndTime_model->get_tardy(),
                'title'          => 'Tardy',
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/tardy', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function undertime(){
        if($this->session->id == 'admin'){
            $data = array(
                'undertimes'     => $this->DateAndTime_model->get_undertime(),
                'title'          => 'Undertime',
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/undertime', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }
    

    public function schedules(){
        if($this->session->id == 'admin'){
            $data = array(
                'employees'      => $this->Users_model->get_employees(),
                'schedules'      => $this->DateAndTime_model->get_schedules(),
                'title'          => 'Schedules',
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );

            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/schedules', $data);
            $this->load->view('components/footer');

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function dtr(){
        if($this->session->id == 'admin'){
            $data = array(
                'employees'      => $this->Users_model->get_employees(),
                'dtr'            => $this->DateAndTime_model->get_dtr(),
                'title'          => 'Daily Time Record',
                'pending_leaves' => $this->DateAndTime_model->get_pending_leaves()
            );

            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/admin/dtr', $data);
            $this->load->view('components/footer');

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    // employees' pages
    public function my_profile(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){

            $data =array (
                'my_info' => $this->Users_model->my_profile(),
                'title'   => 'Employee Profile'
            );

            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/profile', $data);
            $this->load->view('components/footer');

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function my_leaves(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){
            
            $data = array(
                'title' => 'Employee Leaves',
                'pending' => $this->DateAndTime_model->my_pending_leaves(),
                'approved' => $this->DateAndTime_model->my_approved_leaves(),
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/leaves');
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function my_deficiencies(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){

            $data = array(
                'my_tardy'     => $this->DateAndTime_model->my_tardy(),
                'my_undertime' => $this->DateAndTime_model->my_undertime(),
                'title'        => 'Employee Deficiencies'
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/deficiencies', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function my_schedule(){
        if((!empty($this->session->id)) && ($this->session->id !== 'admin')){

            $data = array(
                'my_schedules' => $this->DateAndTime_model->my_schedules(),
                'title'        => 'My Schedule'
            );
            $this->load->view('components/header');
            $this->load->view('components/navbar', $data);
            $this->load->view('pages/schedule', $data);
            $this->load->view('components/footer');
        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function validate(){
        if((!empty($this->session->recovery_id))){

            $this->load->view('components/header');
            $this->load->view('pages/submit_code');

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }

    public function change_pw_recovery(){
        if((!empty($this->session->recovery_id))){

            $this->load->view('components/header');
            $this->load->view('pages/change_pw_recovery');

        } else {
            $this->session->set_flashdata('error', 'You are not allowed to visit this page');
            redirect('login');
        }
    }
}