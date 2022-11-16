<?php
class DateAndTime_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function get_schedules(){
        return $this->db->select('schedule.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('schedule.date as date')
                        ->select('schedule.time_in as time_in')
                        ->select('schedule.time_out as time_out')
                        ->from('schedule')
                        ->join('employees', 'schedule.emp_id=employees.id')
                        // ->where('date >= CURDATE()')
                        ->get()
                        ->result_array();
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

    // get all dtr
    public function get_dtr(){
        return $this->db->select('dtr.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('dtr.am_in as am_in')
                        ->select('dtr.am_out as am_out')
                        ->select('dtr.pm_in as pm_in')
                        ->select('dtr.pm_out as pm_out')
                        ->from('dtr')
                        ->join('employees', 'dtr.emp_id=employees.id')
                        ->get()
                        ->result_array();
    }

    // add dtr
    public function add_dtr(){
        $data = array(
            'emp_id'   => $this->input->post('employee'),
            'date'     => $this->input->post('date'),
            'am_in'    => $this->input->post('am_in'),
            'am_out'   => $this->input->post('am_out'),
            'pm_in'    => $this->input->post('pm_in'),
            'pm_out'   => $this->input->post('pm_out')
        );

        $this->db->insert('dtr', $data);

        if($this->compute_tardy()){
            $diff = $this->compute_tardy();
            $this->add_tardy($diff);
        };
    }

    // compute tardy main logic
    private function compute_tardy(){
        $time_in = $this->input->post('am_in');

        $employee = $this->db->select('time_in')
                             ->select('date')
                             ->select('time_in')
                             ->where('emp_id', $this->input->post('employee'))
                             ->where('date', $this->input->post('date'))
                             ->get('schedule')
                             ->row_array();

        if($time_in > $employee['time_in']){
            $schedule = new DateTime($employee['time_in']);
            $dtr = new DateTime($time_in);
            $difference = $schedule ->diff($dtr );
            $tardy = $difference ->format('%H:%I:%S');

            return $tardy;
        } else {
            return FALSE;
        }
    }

    // add tardy to db
    private function add_tardy($diff){
        $data = array(
            'emp_id' => $this->input->post('employee'),
            'date'   => $this->input->post('date'),
            'diff'   => $diff
        );

        $this->db->insert('tardy', $data);
    }
}