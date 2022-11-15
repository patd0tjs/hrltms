<?php
class DateAndTime_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    // add schedule
    public function add_schedule(){
        $dates = $this->input->post('date');
        $date = explode(",", $dates);

        for($i = 0; $i < count($date); $i++){
            $data = array();

            $data = array(
                'emp_id'   => $this->input->post('employee'),
                'date'     => $date[$i],
                'time_in'  => $this->input->post('time_in'),
                'time_out' => $this->input->post('time_out')
            );
            $this->db->insert('schedule', $data);
        }
    }
}