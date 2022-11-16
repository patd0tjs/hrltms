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

    public function get_tardy(){
        return $this->db->select('tardy.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('tardy.date as date')
                        ->select('tardy.diff as diff')
                        ->from('tardy')
                        ->join('employees', 'tardy.emp_id=employees.id')
                        ->get()
                        ->result_array();
    }

    public function get_undertime(){
        return $this->db->select('undertime.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('undertime.date as date')
                        ->select('undertime.diff as diff')
                        ->from('undertime')
                        ->join('employees', 'undertime.emp_id=employees.id')
                        ->get()
                        ->result_array();
    }

    public function my_tardy(){
        return $this->db->where('emp_id', $this->session->id)
                        ->get('tardy')
                        ->result_array();
    }

    public function my_undertime(){
        return $this->db->where('emp_id', $this->session->id)
                        ->get('undertime')
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
                        ->select('dtr.date as date')
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
            $tardy = $this->compute_tardy();
            $this->add_tardy($tardy);
        };

        if($this->compute_undertime()){
            $undertime = $this->compute_undertime();
            $this->add_undertime($undertime);
        };
    }

    // compute tardy main logic
    private function compute_tardy(){
        $time_in = $this->input->post('am_in');

        $employee = $this->db->select('time_in')
                             ->select('date')
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

    // undertime main logic
    private function compute_undertime(){
        $time_out = $this->input->post('pm_out');

        $employee = $this->db->select('time_out')
                             ->select('date')
                             ->where('emp_id', $this->input->post('employee'))
                             ->where('date', $this->input->post('date'))
                             ->get('schedule')
                             ->row_array();

        if($time_out < $employee['time_out']){
            $schedule = new DateTime($employee['time_out']);
            $dtr = new DateTime($time_out);
            $difference = $schedule ->diff($dtr);
            $undertime = $difference ->format('%H:%I:%S');

            return $undertime;
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

    // add undertime to db
    private function add_undertime($diff){
        $data = array(
            'emp_id' => $this->input->post('employee'),
            'date'   => $this->input->post('date'),
            'diff'   => $diff
        );

        $this->db->insert('undertime', $data);
    }

    public function request_leave(){
            $data = array(
                'emp_id' => $this->input->post('emp_id'),
                's_date' => $this->input->post('s_date'),
                'e_date' => $this->input->post('e_date'),
                'nature' => $this->input->post('nature'),
                'status' => $this->input->post('status'),
            );
            $this->db->insert('leaves', $data);
    }

    public function my_pending_leaves(){
        return $this->db->where('emp_id', $this->session->id)
                        ->where('status', 'pending')
                        ->get('leaves')
                        ->result_array();
    }

    public function my_approved_leaves(){
        return $this->db->where('emp_id', $this->session->id)
                        ->where('status', 'approved')
                        ->get('leaves')
                        ->result_array();
    }

    public function get_pending_leaves(){
        return $this->db->select('leaves.emp_id as emp_id')
                        ->select('leaves.id as id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('leaves.s_date as s_date')
                        ->select('leaves.e_date as e_date')
                        ->select('leaves.nature as nature')
                        ->from('leaves')
                        ->join('employees', 'leaves.emp_id=employees.id')
                        ->where('status', 'pending')
                        ->get()
                        ->result_array();
    }

    public function get_approved_leaves(){
        return $this->db->select('leaves.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('leaves.s_date as s_date')
                        ->select('leaves.e_date as e_date')
                        ->select('leaves.nature as nature')
                        ->from('leaves')
                        ->join('employees', 'leaves.emp_id=employees.id')
                        ->where('status', 'approved')
                        ->get()
                        ->result_array();
    }

    public function approve_leave(){
        $this->db->set('status', 'approved');
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('leaves');
    }
}