<?php

require FCPATH.'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users_model extends CI_Model{
    private $user_id;

    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    // get employee information
    public function my_profile(){
        return $this->db->select('employees.id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
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

        $img_extension = strtoupper(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));

        if (in_array($img_extension, $extension)) { 
            $configUpl['upload_path'] = 'assets/img/id';
            $configUpl['max_size'] = 5*MB;
            $configUpl['allowed_types'] = '*';
            $configUpl['overwrite'] = TRUE;
            $configUpl['remove_spaces'] = TRUE;
            $this->load->library('upload', $configUpl);

            if (!$this->upload->do_upload('profile_pic')) { 
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

    private function get_employee_email($id){
        return $this->db->select('email')
                        ->where('id', $id)
                        ->get('employee_details')
                        ->row_array();
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

    public function recover_account(){
        $tmp_user = $this->get_user();

        if($tmp_user){
            $user = $tmp_user->row_array();

            $this->session->set_userdata('recovery_id', $user['username']);
            $r_code = rand(1000, 9999);
            $email = $this->get_employee_email($this->session->recovery_id);

            $data = array(
                'user_id' => $this->session->recovery_id,
                'expire'  => date('Y-m-d H:i:s', strtotime('+ 10 minutes')),
                'code'    => $r_code
            );

            // invalidate previous codes
            $this->db->set('used', 'Y');
            $this->db->where('user_id', $this->session->recovery_id);
            $this->db->update('recovery_code');
        

            $this->db->insert('recovery_code', $data);
            $this->send_recovery($email['email'], $r_code);

            return TRUE;
        } else {
            $this->session->set_flashdata('error', "Username doesn't exist");
            return FALSE;
        }

    }

    
    public function validate_code(){
        $curr_date = date('Y-m-d H:i:s');

        $codes = $this->db->where('used', 'N')
                          ->where('expire >=', $curr_date )
                          ->where('user_id', $this->session->recovery_id)
                          ->get('recovery_code');
        
        if($codes->num_rows() > 0){
            $valid = $codes->row_array();

            if($valid['code'] == $this->input->post('code')){

                $this->db->set('used', 'Y');
                $this->db->where('user_id', $this->session->recovery_id);
                $this->db->update('recovery_code');

                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    // main login
    public function login(){
        $tmp_user = $this->get_user();

        if($tmp_user){
            $user = $tmp_user->row_array();

            if($user['pw'] == hash('sha256', $this->input->post('pw'))){
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
        return $this->db->select('employees.id as id')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('employees.l_name as l_name')
                        ->select('employee_details.id_pic as id_pic')
                        ->select('departments.name as department_name')
                        ->select('designations.name as designation_name')
                        ->select('employee_details.designation_id as designation_id')
                        ->select('employee_details.department_id as department_id')
                        ->select('employee_details.status as status')
                        ->select('employee_details.sex as sex')
                        ->select('employee_details.bday as bday')
                        ->select('employee_details.birth_place as birth_place')
                        ->select('employee_details.purok as purok')
                        ->select('employee_details.brgy as brgy')
                        ->select('employee_details.municipality as municipality')
                        ->select('employee_details.province as province')
                        ->select('employee_details.zip as zip')
                        ->select('employee_details.date_hired as date_hired')
                        ->select('employee_details.plantilla as plantilla')
                        ->select('employee_details.education as education')
                        ->select('employee_details.school as school')
                        ->select('employee_details.prc as prc')
                        ->select('employee_details.prc_reg as prc_reg')
                        ->select('employee_details.prc_exp as prc_exp')
                        ->select('employee_details.philhealth as philhealth')
                        ->select('employee_details.phone as phone')
                        ->select('employee_details.marital_status as marital_status')
                        ->select('employee_details.gsis as gsis')
                        ->select('employee_details.sss as sss')
                        ->select('employee_details.pag_ibig as pag_ibig')
                        ->select('employee_details.tin as tin')
                        ->select('employee_details.atm as atm')
                        ->select('employee_details.blood_type as blood_type')
                        ->select('employee_details.email as email')
                        ->select('employee_details.remarks as remarks')
                        ->from('employees')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->join('departments', 'employee_details.department_id=departments.id')
                        ->get()
                        ->result_array();
    }

    public function get_employees_data(){
        return $this->db->select('employees.id as id')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('employees.l_name as l_name')
                        ->select('employee_details.id_pic as id_pic')
                        ->select('departments.name as department_name')
                        ->select('designations.name as designation_name')
                        ->select('employee_details.status as status')
                        ->select('employee_details.sex as sex')
                        ->select('employee_details.bday as bday')
                        ->select('employee_details.birth_place as birth_place')
                        ->select('employee_details.purok as purok')
                        ->select('employee_details.brgy as brgy')
                        ->select('employee_details.municipality as municipality')
                        ->select('employee_details.province as province')
                        ->select('employee_details.zip as zip')
                        ->select('employee_details.date_hired as date_hired')
                        ->select('employee_details.plantilla as plantilla')
                        ->select('employee_details.education as education')
                        ->select('employee_details.school as school')
                        ->select('employee_details.prc as prc')
                        ->select('employee_details.prc_reg as prc_reg')
                        ->select('employee_details.prc_exp as prc_exp')
                        ->select('employee_details.philhealth as philhealth')
                        ->select('employee_details.phone as phone')
                        ->select('employee_details.marital_status as marital_status')
                        ->select('employee_details.gsis as gsis')
                        ->select('employee_details.sss as sss')
                        ->select('employee_details.pag_ibig as pag_ibig')
                        ->select('employee_details.tin as tin')
                        ->select('employee_details.atm as atm')
                        ->select('employee_details.blood_type as blood_type')
                        ->select('employee_details.email as email')
                        ->select('employee_details.remarks as remarks')
                        ->from('employees')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->join('departments', 'employee_details.department_id=departments.id')
                        ->where('employees.id', $this->input->post('id'))
                        ->get()
                        ->row_array();
    }

    public function filter_employees(){
        if($this->input->get('gender') != NULL){
            $gender = $this->input->get('gender'); 
        } else {
            $gender = '';
        }
        
        if($this->input->get('department') != NULL){
            $department = $this->input->get('department');
        } else {
            $department = $this->input->get('');
        }
        return $this->db->select('employees.id as id')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('employees.l_name as l_name')
                        ->select('employee_details.id_pic as id_pic')
                        ->select('departments.name as department_name')
                        ->select('designations.name as designation_name')
                        ->select('employee_details.designation_id as designation_id')
                        ->select('employee_details.department_id as department_id')
                        ->select('employee_details.status as status')
                        ->select('employee_details.sex as sex')
                        ->select('employee_details.bday as bday')
                        ->select('employee_details.birth_place as birth_place')
                        ->select('employee_details.purok as purok')
                        ->select('employee_details.brgy as brgy')
                        ->select('employee_details.municipality as municipality')
                        ->select('employee_details.province as province')
                        ->select('employee_details.zip as zip')
                        ->select('employee_details.date_hired as date_hired')
                        ->select('employee_details.plantilla as plantilla')
                        ->select('employee_details.education as education')
                        ->select('employee_details.school as school')
                        ->select('employee_details.prc as prc')
                        ->select('employee_details.prc_reg as prc_reg')
                        ->select('employee_details.prc_exp as prc_exp')
                        ->select('employee_details.philhealth as philhealth')
                        ->select('employee_details.phone as phone')
                        ->select('employee_details.marital_status as marital_status')
                        ->select('employee_details.gsis as gsis')
                        ->select('employee_details.sss as sss')
                        ->select('employee_details.pag_ibig as pag_ibig')
                        ->select('employee_details.tin as tin')
                        ->select('employee_details.atm as atm')
                        ->select('employee_details.blood_type as blood_type')
                        ->select('employee_details.email as email')
                        ->select('employee_details.remarks as remarks')
                        ->from('employees')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->join('departments', 'employee_details.department_id=departments.id')
                        ->where('employee_details.department_id', $department)
                        ->where('employee_details.sex', $gender)
                        ->get()
                        ->result_array();
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
                'pw'       => hash('sha256','password'),
            );

            $this->db->insert('users', $data);
            $this->session->set_flashdata('success', 'employee added');
            return TRUE;

        } else {
            $this->session->set_flashdata('error', 'employee id already exists');
            return FALSE;
        }
    }
    public function get_designation_name($id){
        return $this->db->where('id', $id)->get('designations')->row_array();
    }

    public function get_department_name($id){
        return $this->db->where('id', $id)->get('departments')->row_array();
    }

    // add employee details to emp_details table
    private function add_emp_details(){   
        if(empty($_FILES['profile_pic']['name'])){
            $photo = base_url() . 'assets/img/null_pic.jpg';
            
        } else {
            $photo = $this->uploadPhoto();;
        } 
        $data = array(
            'id'             => $this->input->post('id'),
            'id_pic'         => $photo,
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

    private function send_recovery($email, $code){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreplybphkibawe@gmail.com';
        $mail->Password = 'dcrlabifhkcfgzqd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
       
        $mail->setFrom('noreplybphkibawe@gmail.com', 'HRMIS');
       
        $mail->addAddress($email);

        $mail->Subject = 'Account Recovery';
       

        $mailContent = "Your recovery code is $code";
        $mail->Body = $mailContent;
        $mail->send();

    }

    public function recover_password(){
        $pw = $this->input->post('pw');
        $pw2 = $this->input->post('pw2');

        if ($pw == $pw2){
            $this->db->set('pw', hash('sha256', $pw));
            $this->db->where('username', $this->session->recovery_id);
            $this->db->update('users');

            return TRUE;
        } else {
            return FALSE;
        }

    }

    private function get_old_pw(){
        return $this->db->select('pw')
                        ->where('username', $this->session->id)
                        ->get('users')
                        ->row_array();
    }

    // update password
    public function change_password(){
        $my_pass = $this->get_old_pw();
        $old     = $this->input->post('old');
        $pw      = $this->input->post('pw');
        $pw2     = $this->input->post('pw2');

        if ($my_pass['pw'] == hash('sha256',$old)){
            if ($pw == $pw2){
                $this->db->set('pw', hash('sha256', $pw));
                $this->db->where('username', $this->session->id);
                $this->db->update('users');
    
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
        
    }

    // add employee main function
    public function edit_employee(){
        $data = array(
            'l_name' => $this->input->post('l_name'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
        );
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('employees', $data);

            $this->edit_emp_details();
    }
    
    
    // add employee details to emp_details table
    private function edit_emp_details(){ 
        if(empty($_FILES['profile_pic']['name'])){
            $photo = $this->input->post('old_pic');
            
        } else {
            $photo = $this->uploadPhoto();;
        }   
        $data = array(
            'id_pic'         => $photo,
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

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('employee_details', $data);
        }
    
    public function employee_data($id){
        return $this->db->select('employees.id as id')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('employees.l_name as l_name')
                        ->select('employee_details.id_pic as id_pic')
                        ->select('departments.name as department_name')
                        ->select('designations.name as designation_name')
                        ->select('employee_details.status as status')
                        ->select('employee_details.sex as sex')
                        ->select('employee_details.bday as bday')
                        ->select('employee_details.birth_place as birth_place')
                        ->select('employee_details.purok as purok')
                        ->select('employee_details.brgy as brgy')
                        ->select('employee_details.municipality as municipality')
                        ->select('employee_details.province as province')
                        ->select('employee_details.zip as zip')
                        ->select('employee_details.date_hired as date_hired')
                        ->select('employee_details.plantilla as plantilla')
                        ->select('employee_details.education as education')
                        ->select('employee_details.school as school')
                        ->select('employee_details.prc as prc')
                        ->select('employee_details.prc_reg as prc_reg')
                        ->select('employee_details.prc_exp as prc_exp')
                        ->select('employee_details.philhealth as philhealth')
                        ->select('employee_details.phone as phone')
                        ->select('employee_details.marital_status as marital_status')
                        ->select('employee_details.gsis as gsis')
                        ->select('employee_details.sss as sss')
                        ->select('employee_details.pag_ibig as pag_ibig')
                        ->select('employee_details.tin as tin')
                        ->select('employee_details.atm as atm')
                        ->select('employee_details.blood_type as blood_type')
                        ->select('employee_details.email as email')
                        ->select('employee_details.remarks as remarks')
                        ->from('employees')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->join('departments', 'employee_details.department_id=departments.id')
                        ->where('employees.id', $id)
                        ->get()
                        ->row_array();
    }
}