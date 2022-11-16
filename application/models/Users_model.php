<?php
class Users_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    // get employee information
    public function my_profile(){
        return $this->db->select('employees.id')
                        ->select('employees.l_name')
                        ->select('employees.f_name')
                        ->select('employees.m_name')
                        ->select('employee_details.id_pic')
                        ->select('departments.name as department')
                        ->select('designations.name as designation')
                        ->select('employee_details.status')
                        ->select('employee_details.sex')
                        ->select('employee_details.bday')
                        ->select('employee_details.birth_place')
                        ->select('employee_details.purok')
                        ->select('employee_details.brgy')
                        ->select('employee_details.municipality')
                        ->select('employee_details.province')
                        ->select('employee_details.zip')
                        ->select('employee_details.date_hired')
                        ->select('employee_details.plantilla')
                        ->select('employee_details.education')
                        ->select('employee_details.school')
                        ->select('employee_details.prc')
                        ->select('employee_details.prc_reg')
                        ->select('employee_details.prc_exp')
                        ->select('employee_details.philhealth')
                        ->select('employee_details.phone')
                        ->select('employee_details.marital_status')
                        ->select('employee_details.gsis')
                        ->select('employee_details.sss')
                        ->select('employee_details.pag_ibig')
                        ->select('employee_details.tin')
                        ->select('employee_details.atm')
                        ->select('employee_details.blood_type')
                        ->select('employee_details.email')
                        ->select('employee_details.remarks')
                        ->from('employee_details')
                        ->join('employees', 'employees.id=employee_details.id')
                        ->join('departments', 'employee_details.department_id=departments.id')
                        ->join('designations', 'employee_details.designation_id=designations.id') 
                        ->where('employees.id', $this->session->id)
                        ->get()
                        ->row_array();
    }

    // upload photo logic
    private function uploadPhoto(){
        define('MB', 1048576);
        $extension = array("JPG", "JPEG", "PNG");

        $img_extension = strtoupper(pathinfo($_FILES['id_pic']['name'], PATHINFO_EXTENSION));

        if (in_array($img_extension, $extension)) { 
            $configUpl['upload_path'] = 'assets/img/id';
            $configUpl['max_size'] = 5*MB;
            $configUpl['allowed_types'] = '*';
            $configUpl['overwrite'] = TRUE;
            $configUpl['remove_spaces'] = TRUE;
            $this->load->library('upload', $configUpl);

            if (!$this->upload->do_upload($img)) { 
                $error = array('error' => $this->upload->display_errors());
                log_message('error', $error['error']);
            } else {
                $up_data = array('upload_data' => $this->upload->data());
                $file_name = $up_data['upload_data']['file_name'];
                $file = base_url()."assets/img/id/".$file_name;
            }
        } else {
            file_put_contents('image error', "error");
        }
        return $file;     
    }

    // check if user exists
    private function get_user(){
        $tmp_user = $this->db->where('username', $this->input->post('username'))->get('users');
        
        if($tmp_user->num_rows() > 0){
            return $tmp_user;

        } else {
            return FALSE;
        }
    }

    // main login
    public function login(){
        $tmp_user = $this->get_user();

        if($tmp_user){
            $user = $tmp_user->row_array();

            if($user['pw'] == $this->input->post('pw')){
                $this->session->set_userdata('id', $user['username']);
                return TRUE;

            } else {
                $this->session->set_flashdata('error', "username or password doesn't match");
                return FALSE;    
            }

        } else {
            $this->session->set_flashdata('error', "username or password doesn't match");
            return FALSE;
        
        }
    }

    // get data
    public function get_departments(){
        return $this->db->get('departments')->result_array();
    }

    public function get_designations(){
        return $this->db->get('designations')->result_array();
    }

    public function get_employees(){
        return $this->db->get('employees')->result_array();
    }

    // add employee main function
    public function add_employee(){
        if($this->add_emp_acc()){
            $data = array(
                'id'     => $this->input->post('id'),
                'l_name' => $this->input->post('l_name'),
                'f_name' => $this->input->post('f_name'),
                'm_name' => $this->input->post('m_name'),
            );
            $this->db->insert('employees', $data);
            $this->add_emp_details();
        } else {
            echo 'error';
        }
    }

    // add employee to users table
    private function add_emp_acc(){
        $registered = $this->db->where('username', $this->input->post('id'))
                               ->get('users')
                               ->num_rows();
        if($registered == 0){
            $data = array(
                'username' => $this->input->post('id'),
                'pw'       => 'password',
            );

            $this->db->insert('users', $data);
            $this->session->set_flashdata('success', 'employee added');
            return TRUE;

        } else {
            $this->session->set_flashdata('error', 'employee id already exists');
            return FALSE;
        }
    }

    // add employee details to emp_details table
    private function add_emp_details(){
        if($this->input->post('id_pic')){
            $id_pic = $this->uploadPhoto();

        } else {
            $id_pic = base_url() . 'assets/img/null_pic.jpg';
        }
        
        $data = array(
            'id'             => $this->input->post('id'),
            'id_pic'         => $id_pic,
            'department_id'  => $this->input->post('department'),
            'designation_id' => $this->input->post('designation'),
            'status'         => $this->input->post('status'),
            'sex'            => $this->input->post('sex'),
            'bday'           => $this->input->post('bday'),
            'birth_place'    => $this->input->post('birth_place'),
            'purok'          => $this->input->post('purok'),
            'brgy'           => $this->input->post('brgy'),
            'municipality'   => $this->input->post('municipality'),
            'province'       => $this->input->post('province'),
            'zip'            => $this->input->post('zip'),
            'date_hired'     => $this->input->post('date_hired'),
            'plantilla'      => $this->input->post('philhealth'),
            'education'      => $this->input->post('education'),
            'school'         => $this->input->post('school'),
            'prc'            => $this->input->post('prc'),
            'prc_reg'        => $this->input->post('prc_reg'),
            'prc_exp'        => $this->input->post('prc_exp'),
            'philhealth'     => $this->input->post('philhealth'),
            'phone'          => $this->input->post('phone'),
            'marital_status' => $this->input->post('marital_status'),
            'gsis'           => $this->input->post('gsis'),
            'sss'            => $this->input->post('sss'),
            'pag_ibig'       => $this->input->post('pag_ibig'),
            'tin'            => $this->input->post('tin'),
            'atm'            => $this->input->post('atm'),
            'blood_type'     => $this->input->post('blood_type'),
            'email'          => $this->input->post('email'),
            'remarks'        => $this->input->post('remarks'),

        );
        $this->db->insert('employee_details', $data);
    }

}