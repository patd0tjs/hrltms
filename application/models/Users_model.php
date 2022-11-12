<?php
class Users_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
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
                $this->session->set_flashdata('error', 'invalid password');
                return FALSE;    
            }

        } else {
            $this->session->set_flashdata('error', 'invalid username');
            return FALSE;
        
        }
    }

    public function add_employee(){

    }

    // add employee to users table
    private function add_emp_acc(){
        $data = array();
        $this->db->insert('', $data);
    }

    // add employee details to emp_details table
    private function add_emp_details(){
        $data = array();
        $this->db->insert('', $data);
    }
}