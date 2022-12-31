<?php

require FCPATH.'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DateAndTime_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    public function get_schedules(){
        return $this->db->select('schedule.emp_id as emp_id')
                        ->select('schedule.id as id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('schedule.s_date as s_date')
                        ->select('schedule.e_date as e_date')
                        ->select('schedule.time_in as time_in')
                        ->select('schedule.time_out as time_out')
                        ->from('schedule')
                        ->join('employees', 'schedule.emp_id=employees.id')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->get()
                        ->result_array();
    }

    // change schedule
    public function change_schedule(){
        $data = array(
            's_date'   => $this->input->post('s_date'),
            'e_date'   => $this->input->post('e_date'),
            'time_in'  => $this->input->post('time_in'),
            'time_out' => $this->input->post('time_out')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('schedule', $data);
        
    }

    public function delete_sched(){
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('schedule');
        
    }

    public function delete_leave(){
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('leaves');
        
    }

    public function get_tardy(){
        return $this->db->select('tardy.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('tardy.date as date')
                        ->select('tardy.diff as diff')
                        ->from('tardy')
                        ->join('employees', 'tardy.emp_id=employees.id')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->get()
                        ->result_array();
    }

    public function get_undertime(){
        return $this->db->select('undertime.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('undertime.date as date')
                        ->select('undertime.diff as diff')
                        ->from('undertime')
                        ->join('employees', 'undertime.emp_id=employees.id')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
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

            $time_in = $this->input->post('time_in');
            $time_out = $this->input->post('time_out');

            if ($time_out < $time_in){
                $e_date = date('Y-m-d', strtotime($date[$i] . ' + 1 day'));
            } else {
                $e_date = $date[$i];
            }

            $data = array(
                'emp_id'   => $this->input->post('employee'),
                's_date'   => $date[$i],
                'e_date'   => $e_date,
                'time_in'  => $time_in,
                'time_out' => $time_out,
            );

            $schedules = $this->db->where('s_date', $date[$i])
                                  ->where('emp_id', $this->input->post('employee'))
                                  ->get('schedule')
                                  ->num_rows();

            if($schedules <= 0){
                $this->db->insert('schedule', $data);
            } else {
                $this->session->set_flashdata('error', 'Conflicting schedules. Some schedules are not added');
            }
            
        }
    }

    // get all dtr
    public function get_dtr(){
        return $this->db->select('dtr.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('dtr.s_date as s_date')
                        ->select('dtr.e_date as e_date')
                        ->select('dtr.time_in as time_in')
                        ->select('dtr.time_out as time_out')
                        ->from('dtr')
                        ->join('employees', 'dtr.emp_id=employees.id')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->get()
                        ->result_array();
    }

    // add dtr
    public function add_dtr(){
        // $this->compute_tardy();

        $time_in = $this->input->post('time_in');
        $time_out = $this->input->post('time_out');
        $s_date = $this->input->post('date');

        if ($time_out < $time_in){
            $e_date = date('Y-m-d', strtotime($s_date . ' + 1 day'));
        } else {
            $e_date = $s_date;
            //$e_date = $date[$i];
        }

        $data = array(
            'emp_id'   => $this->input->post('employee'),
            's_date'   => $this->input->post('date'),
            'e_date'   => $e_date,
            'time_in'  => $time_in,
            'time_out' => $time_out,
        );

        $schedules = $this->db->where('s_date', $this->input->post('date'))
                              ->where('emp_id', $this->input->post('employee'))
                              ->get('schedule')
                              ->num_rows();

        if($schedules > 0){
            $this->db->insert('dtr', $data);

            if($this->compute_tardy()){
                $tardy = $this->compute_tardy();
                $this->add_tardy($tardy);
                $this->count_tardy($tardy);
            };
    
            if($this->compute_undertime()){
                $undertime = $this->compute_undertime();
                $this->add_undertime($undertime);
                $this->count_tardy($undertime);
            };

        } else {
            $this->session->set_flashdata('error', "Employee schedule doesn't exists. DTR not added");
        }
    }

    // count tardy
    private function count_tardy(){
        $employee = $this->db->select('employee_details.email as email')
                             ->from('tardy')
                             ->join('employee_details', 'tardy.emp_id=employee_details.id')
                             ->where('emp_id', $this->input->post('employee'))
                             ->get()
                             ->result_array();

        if (count($employee) > 10){
            $this->send_warning($employee[0]['email'], 'tardies');
        } 
    }

    private function count_undertime(){
        $employee = $this->db->select('employee_details.email as email')
                             ->from('undertime')
                             ->join('employee_details', 'undertime.emp_id=employee_details.id')
                             ->where('emp_id', $this->input->post('employee'))
                             ->get()
                             ->result_array();

        if (count($employee) > 10){
            $this->send_warning($employee[0]['email'], 'undertime');
        } 
    }
    // compute tardy main logic
    private function compute_tardy(){
        $time_in = $this->input->post('time_in');

        $employee = $this->db->select('time_in')
                             ->select('time_out')
                             ->select('s_date')
                             ->where('emp_id', $this->input->post('employee'))
                             ->where('s_date', $this->input->post('date'))
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
        $time_out = $this->input->post('time_out');

        $employee = $this->db->select('time_out')
                             ->select('s_date')
                             ->where('emp_id', $this->input->post('employee'))
                             ->where('s_date', $this->input->post('date'))
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
                'reason' => $this->input->post('reason'),
                'status' => $this->input->post('status'),
            );
            $this->db->insert('leaves', $data);
    }

    public function get_leaves(){
        return $this->db->get('leaves')
                        ->result_array();
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
                        ->select('designations.name as designation')
                        ->select('leaves.s_date as s_date')
                        ->select('leaves.e_date as e_date')
                        ->select('leaves.nature as nature')
                        ->select('leaves.reason as reason')
                        ->select('leaves.date_filed as date_filed')
                        ->from('leaves')
                        ->join('employees', 'leaves.emp_id=employees.id')
                        ->join('employee_details', 'leaves.emp_id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->where('leaves.status', 'pending')
                        ->get()
                        ->result_array();
    }

    public function get_approved_leaves(){
        return $this->db->select('leaves.emp_id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('leaves.s_date as s_date')
                        ->select('leaves.e_date as e_date')
                        ->select('leaves.nature as nature')
                        ->select('leaves.reason as reason')
                        ->select('leaves.date_filed as date_filed')
                        ->from('leaves')
                        ->join('employees', 'leaves.emp_id=employees.id')
                        ->join('employee_details', 'leaves.emp_id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->where('leaves.status', 'approved')
                        ->get()
                        ->result_array();
    }

    public function get_approved_leaves_data($s_date, $e_date){
        return $this->db->select('leaves.emp_id as emp_id')
                        ->select('employees.id as employee_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation')
                        ->select('leaves.s_date as s_date')
                        ->select('leaves.e_date as e_date')
                        ->select('leaves.nature as nature')
                        ->select('leaves.reason as reason')
                        ->select('leaves.date_filed as date_filed')
                        ->from('leaves')
                        ->join('employees', 'leaves.emp_id=employees.id')
                        ->join('employee_details', 'leaves.emp_id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->where('leaves.status', 'approved')
                        ->where('date_filed >=', $s_date)
                        ->where('date_filed <=', $e_date)
                        ->get()
                        ->result_array();
    }

    public function approve_leave(){
        $this->db->set('status', 'approved');
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('leaves');

        $this->send_leave_approval($this->input->post('id'));
    }

    private function send_warning($email, $violation){
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

        $mail->Subject = 'Exceeded Number of lates/tardies';
       

        $mailContent = "You have exceeded the amount of $violation. Please visit the HR office immediately";
        $mail->Body = $mailContent;
        $mail->send();

    }

    private function send_leave_approval($leave_id){

        $leave = $this->db->select('employee_details.email as email')
                          ->select('leaves.s_date as from')
                          ->select('leaves.e_date as to')
                          ->from('leaves')
                          ->join('employee_details', 'leaves.emp_id=employee_details.id')
                          ->where('leaves.id', $leave_id)
                          ->get()
                          ->row_array();

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreplybphkibawe@gmail.com';
        $mail->Password = 'dcrlabifhkcfgzqd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
       
        $mail->setFrom('noreplybphkibawe@gmail.com', 'HRMIS');
       
        $mail->addAddress($leave['email']);

        $mail->Subject = 'Leave approval';
       

        $mailContent = "Your leave application with dates starting from" . $leave['from'] . ' to ' . $leave['to'] . ' has been approved!';
        $mail->Body = $mailContent;
        $mail->send();

    }
}