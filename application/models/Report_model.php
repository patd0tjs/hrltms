<?php

require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    // get employees
    private function report_data(){
        return $this->db->select('employees.id as emp_id')
                        ->select('employees.l_name as l_name')
                        ->select('employees.f_name as f_name')
                        ->select('employees.m_name as m_name')
                        ->select('designations.name as designation_name')
                        ->from('employees')
                        ->join('employee_details', 'employees.id=employee_details.id')
                        ->join('designations', 'employee_details.designation_id=designations.id')
                        ->order_by('employees.l_name')
                        ->order_by('employees.f_name')
                        ->get()
                        ->result_array();
    }

    // count tardy
    private function get_tardy($emp_id, $s_date, $e_date){
        return $this->db->select('count(*) as num_tardy')
                        ->where('emp_id', $emp_id)
                        ->where('date >=', $s_date)
                        ->where('date <=', $e_date)
                        ->get('tardy')
                        ->row_array();
    }

    // count undertime
    private function get_undertime($emp_id, $s_date, $e_date){
        return $this->db->select('count(*) as num_undertime')
                        ->where('emp_id', $emp_id)
                        ->where('date >=', $s_date)
                        ->where('date <=', $e_date)
                        ->get('undertime')
                        ->row_array();
    }

    // tardy time sum
    private function get_tardy_time($emp_id, $s_date, $e_date){
        $time = $this->db->select('sec_to_time(sum(time_to_sec(diff))) as time_tardy')
                         ->where('emp_id', $emp_id)
                         ->where('date >=', $s_date)
                         ->where('date <=', $e_date)
                         ->get('tardy')
                         ->row_array();

        if ($time['time_tardy'] == NULL){
            return $my_time['time_tardy'] = '00:00:00';

        } else { 
            return $time['time_tardy'];         
        }

    }

    // undertime time sum
    private function get_undertime_time($emp_id, $s_date, $e_date){
        $time = $this->db->select('sec_to_time(sum(time_to_sec(diff))) as time_undertime')
                         ->where('emp_id', $emp_id)
                         ->where('date >=', $s_date)
                         ->where('date <=', $e_date)
                         ->get('undertime')
                         ->row_array();

        if ($time['time_undertime'] == NULL){
            return $my_time['time_undertime'] = '00:00:00';

        } else { 
            return $time['time_undertime'];         
        }
    }

    // convert time to interval
    private function time_to_interval($time) {
        $parts = explode(':',$time);
        return new DateInterval('PT'.$parts[0].'H'.$parts[1].'M'.$parts[2].'S');
    }

    // dissect hours
    private function get_hours($time){
        $parts = explode(':',$time);
        return $parts[0];
    }

    // dissect minutes
    private function get_minutes($time){
        $parts = explode(':',$time);
        return $parts[1];
    }

    // add two time formats
    private function addtime($time1, $time2){
        $x = new DateTime($time1);
        $y = new DateTime($time2);

        $interval1 = $x->diff(new DateTime('00:00:00')) ;
        $interval2 = $y->diff(new DateTime('00:00:00')) ;

        $e = new DateTime('00:00');
        $f = clone $e;
        $e->add($interval1);
        $e->add($interval2);
        $total = $f->diff($e)->format("%H:%I:%S");
        return $total;
    }

    // tardy and undertime report
    public function generate_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $employees = $this->report_data();
        $report_date = date('F Y',strtotime($s_date));

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){

            $record = array();
            // get records
            $tardy = $this->get_tardy($employees[$i]['emp_id'], $s_date, $e_date);
            $undertime = $this->get_undertime($employees[$i]['emp_id'], $s_date, $e_date);
            $tardy_time = $this->get_tardy_time($employees[$i]['emp_id'], $s_date, $e_date);
            $undertime_time = $this->get_undertime_time($employees[$i]['emp_id'], $s_date, $e_date);

            // dissect time
            $time_1 = $this->time_to_interval(date('H:i:s', strtotime($tardy_time)));
            $time_2 = $this->time_to_interval(date('H:i:s', strtotime($undertime_time)));

            // add times
            $total = $this->addTime($tardy_time, $undertime_time);

            // separate formats
            $total_hours = $this->get_hours($total);
            $total_minutes = $this->get_minutes($total);

            if($total_hours > 0 || $total_minutes > 0){
                array_push($record, $i+1, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'], $employees[$i]['designation_name'], $tardy['num_tardy'], $undertime['num_undertime'], $total_hours, $total_minutes);
                array_push($table_data, $record);
            }
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td style="width: 20%">$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                    <td>$table[5]</td>
                    <td>$table[6]</td>
                </tr>
            EOD;
        endforeach;

        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center">
                <thead>
                    <tr>
                        <td rowspan="2" style="width: 5%">
                            No.
                        </td>
                        <td rowspan="2" style="width: 20%">
                            NAME OF EMPLOYEES
                        </td>
                        <td rowspan="2">
                            DESIGNATION
                        </td>
                        <td rowspan="2">
                            NO. OF TIMES TARDY
                        </td>
                        <td rowspan="2">
                            NO. OF TIMES UNDERTIME
                        </td>
                        <td colspan="2">
                            TOTAL NO. OF
                        </td>
                    </tr>
                    <tr>
                        <td>
                            HOURS
                        </td>
                        <td>
                            MINUTES
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = <<<EOD
            <table style="width:100%">
                <tr>
                    <td align="right">

                    </td>
                    <td>
                        <p align="center" style="font-size: 14px">
                            Republic of the Philippines
                            <br>
                            PROVINCE OF BUKIDNON
                            <br>
                            Provincial Capitol          
                        </p>
                    </td>
                    <td align="left">

                    </td>
                </tr>
            </table>
            <p align="center" style="font-size: 12px">
                MONTHLY TARDY AND UNDERTIME SUMMARY REPORT
                <br>
                For the month of $report_date
                <br>
                <br>
                OFFICE: BUKIDNON PROVINCIAL HOSPITAL-KIBABWE (REGULAR)									
            </p> 
            EOD;

        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III
                            </p>
                        </td>
                        <td>
                            <p align="center" style="font-size: 12px">
                                Approved by:
                                <br>
                                <br>
                                ANTONIO R. TUBOG, MD, FPSMS
                                <br>
                                Chief of Hospital II
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;
        $this->generate_pdf($title, $table, $footer, 'tardy_undertime.pdf');

    }

    public function leaves_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        date_default_timezone_set('Asia/Manila');
        $timezone = date_default_timezone_get();
        $today = date("F d, Y");


        $employees = $this->DateAndTime_model->get_approved_leaves_report_data($s_date, $e_date); 

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){
            $record = array();

            array_push($record, $i+1, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'], $employees[$i]['designation'], ($employees[$i]['s_date'] == $employees[$i]['e_date']) ? date("M d, Y", strtotime($employees[$i]['s_date'])) : date("M d", strtotime($employees[$i]['s_date'])) . ' - ' . date("M d, Y", strtotime($employees[$i]['e_date'])), $employees[$i]['nature'] . '<br />' . $employees[$i]['reason']);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td style="width: 20%">$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                </tr>
            EOD;
        endforeach;

        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center">
                <thead>
                    <tr>
                        <td style="width: 5%">
                            No.
                        </td>
                        <td style="width: 20%">
                            NAME OF EMPLOYEES
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            DATE OF LEAVE
                        </td>
                        <td>
                            NATURE OF LEAVE
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = <<<EOD
            <table style="width:100%">
                <tr>
                    <td align="right">
                        <div>
                            <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                        </div>  
                    </td>
                    <td>
                        <p align="center" style="font-size: 14px">
                            Republic of the Philippines
                            <br>
                            PROVINCE OF BUKIDNON          
                        </p>
                    </td>
                    <td align="left">
                        <div>
                            <img src="assets/img/logo-2.jpg" style="width: 80px">
                        </div>
                    </td>
                </tr>
            </table>
            <p align="center" style="font-size: 10px">
                BUKIDNON PROVINCIAL HOSPITAL-KIBAWE
                <br>
                CM. Recto Street, Pamla, Kibawe, Bukidnon            
            </p>
            <div align="left"><hr /></div>
            TRANSMITTAL

            <p align="left" style="font-size: 12px">
                To: &nbsp; MARIE CARMEN C. UNABIA
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PG Department Head
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PEEDM Officer
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Province of Bukidnon
                <br>
                <br>
                Date: $today
                <br>
                <br>
                Subject: APPLICATION FOR LEAVE
                <br>
                <br>
                Ma'am, respectfully submitting herewith the Application for Leave of BPH-Kibawe personnel, to wit;									
            </p> 
            EOD;

        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III
                            </p>
                        </td>
                        <td>
                            <p align="center" style="font-size: 12px">
                                Approved by:
                                <br>
                                <br>
                                ANTONIO R. TUBOG, MD, FPSMS
                                <br>
                                Chief of Hospital II
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;
        $this->generate_pdf($title, $table, $footer, 'tardy_undertime.pdf');

    }

    public function tardy_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $employees = $this->DateAndTime_model->get_tardy_report($s_date, $e_date); 

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){
            $record = array();

            array_push($record, $i+1, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'] . ' ' . $employees[$i]['m_name'], $employees[$i]['designation'], date("M d Y", strtotime($employees[$i]['date'])), $employees[$i]['diff']);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td style="width: 20%">$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                </tr>
            EOD;
        endforeach;
        $report_date = date('F Y',strtotime($s_date));

        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center;">
                <thead>
                    <tr>
                        <td style="width: 5%">
                            No.
                        </td>
                        <td style="width: 20%">
                            NAME
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            DATE
                        </td>
                        <td>
                            DEFICIENCY
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = <<<EOD
            <table style="width:100%">
                <tr>
                    <td align="right">
                        <div>
                            <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                        </div>  
                    </td>
                    <td>
                        <p align="center" style="font-size: 14px">
                            Republic of the Philippines
                            <br>
                            PROVINCE OF BUKIDNON          
                        </p>
                    </td>
                    <td align="left">
                        <div>
                            <img src="assets/img/logo-2.jpg" style="width: 80px">
                        </div>
                    </td>
                </tr>
            </table>
            <p align="center" style="font-size: 12px">
                MONTHLY TARDY SUMMARY REPORT
                <br>
                For the month of $report_date
                <br>
                <br>
                OFFICE: BUKIDNON PROVINCIAL HOSPITAL-KIBABWE (REGULAR)									
            </p>  
            EOD;

        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III
                            </p>
                        </td>
                        <td>
                            <p align="center" style="font-size: 12px">
                                Approved by:
                                <br>
                                <br>
                                ANTONIO R. TUBOG, MD, FPSMS
                                <br>
                                Chief of Hospital II
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;

        $this->generate_pdf($title, $table, $footer, 'tardy_report.pdf');
    }

    public function undertime_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $employees = $this->DateAndTime_model->get_undertime_report($s_date, $e_date); 

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){
            $record = array();

            array_push($record, $i+1, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'] . ' ' . $employees[$i]['m_name'], $employees[$i]['designation'], date("M d Y", strtotime($employees[$i]['date'])), $employees[$i]['diff']);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td style="width: 20%">$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                </tr>
            EOD;
        endforeach;

        $report_date = date('F Y',strtotime($s_date));
        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center">
                <thead>
                    <tr>
                        <td style="width: 5%">
                            No.
                        </td>
                        <td style="width: 20%">
                            NAME
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            DATE
                        </td>
                        <td>
                            DEFICIENCY
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = <<<EOD
            <table style="width:100%">
                <tr>
                    <td align="right">
                        <div>
                            <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                        </div>  
                    </td>
                    <td>
                        <p align="center" style="font-size: 14px">
                            Republic of the Philippines
                            <br>
                            PROVINCE OF BUKIDNON          
                        </p>
                    </td>
                    <td align="left">
                        <div>
                            <img src="assets/img/logo-2.jpg" style="width: 80px">
                        </div>
                    </td>
                </tr>
            </table>
            <p align="center" style="font-size: 12px">
                MONTHLY UNDERTIME SUMMARY REPORT
                <br>
                For the month of $report_date
                <br>
                <br>
                OFFICE: BUKIDNON PROVINCIAL HOSPITAL-KIBABWE (REGULAR)									
            </p> 
            EOD;
        
        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III
                            </p>
                        </td>
                        <td>
                            <p align="center" style="font-size: 12px">
                                Approved by:
                                <br>
                                <br>
                                ANTONIO R. TUBOG, MD, FPSMS
                                <br>
                                Chief of Hospital II
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;

        $this->generate_pdf($title, $table, $footer, 'undertime_report.pdf');
    }

    public function schedules_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $employees = $this->DateAndTime_model->get_schedules_report($s_date, $e_date); 

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){
            $record = array();

            array_push($record, $i+1, $employees[$i]['emp_id'], $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'] . ' ' . $employees[$i]['m_name'], $employees[$i]['designation'], date("M d Y", strtotime($employees[$i]['s_date'])), date("M d Y", strtotime($employees[$i]['e_date'])), $employees[$i]['time_in'], $employees[$i]['time_out']);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td>$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                    <td>$table[5]</td>
                    <td>$table[6]</td>
                    <td>$table[7]</td>
                </tr>
            EOD;
        endforeach;

        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center">
                <thead>
                    <tr>
                        <td style="width: 5%">
                            No.
                        </td>
                        <td>
                            EMPLOYEE ID
                        </td>
                        <td>
                            NAME
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            START DATE
                        </td>
                        <td>
                            END DATE
                        </td>
                        <td>
                            TIME IN
                        </td>
                        <td>
                            TIME OUT
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = 
            <<<EOD
                <table style="width:100%">
                    <tr>
                        <td align="right">
                            <div>
                                <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                            </div>  
                        </td>
                        <td>
                            <p align="center" style="font-size: 14px">
                                Republic of the Philippines
                                <br>
                                PROVINCE OF BUKIDNON          
                            </p>
                        </td>
                        <td align="left">
                            <div>
                                <img src="assets/img/logo-2.jpg" style="width: 80px">
                            </div>
                        </td>
                    </tr>
                </table>
                <p align="left" style="font-size: 12px">
                    Date: $s_date
                    <br>
                    <br>
                    SCHEDULES REPORT					
                </p> 
            EOD;
        
        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III/Payroll in-charge
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;

        $this->generate_pdf($title, $table, $footer, 'schedules_report.pdf');
    }

    public function dtr_report(){
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $employees = $this->DateAndTime_model->get_dtr_report($s_date, $e_date); 

        $table_data = array();
        for($i = 0; $i < count($employees); $i++){
            $record = array();

            array_push($record, $i+1, $employees[$i]['emp_id'], $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'] . ' ' . $employees[$i]['m_name'], $employees[$i]['designation'], date("M d Y", strtotime($employees[$i]['s_date'])), date("M d Y", strtotime($employees[$i]['e_date'])), $employees[$i]['time_in'], $employees[$i]['time_out']);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td style="width: 5%">$table[0]</td>
                    <td>$table[1]</td>
                    <td>$table[2]</td>
                    <td>$table[3]</td>
                    <td>$table[4]</td>
                    <td>$table[5]</td>
                    <td>$table[6]</td>
                    <td>$table[7]</td>
                </tr>
            EOD;
        endforeach;

        // set table
        $table = <<<EOD
            <br>
            <br>
            <style>
                table#main, table#main th, table#main td {
                border: 1px solid black;
                border-collapse: collapse;
                }
            </style>
            <table id="main" style="font-size: 11px; text-align: center">
                <thead>
                    <tr>
                        <td style="width: 5%">
                            No.
                        </td>
                        <td>
                            EMPLOYEE ID
                        </td>
                        <td>
                            NAME
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            START DATE
                        </td>
                        <td>
                            END DATE
                        </td>
                        <td>
                            TIME IN
                        </td>
                        <td>
                            TIME OUT
                        </td>
                    </tr>
                </thead>
                <tbody> 
                    $row 
                </tbody>
            </table> 
            EOD;

        $title = <<<EOD
            <table style="width:100%">
                <tr>
                    <td align="right">
                        <div>
                            <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                        </div>  
                    </td>
                    <td>
                        <p align="center" style="font-size: 14px">
                            Republic of the Philippines
                            <br>
                            PROVINCE OF BUKIDNON          
                        </p>
                    </td>
                    <td align="left">
                        <div>
                            <img src="assets/img/logo-2.jpg" style="width: 80px">
                        </div>
                    </td>
                </tr>
            </table>
            <p align="left" style="font-size: 12px">
                Date: $s_date
                <br>
                <br>
                DTR REPORT					
            </p> 
            EOD;
            
        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III/Payroll in-charge
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;
        $this->generate_pdf($title, $table, $footer, 'tardy_report.pdf');
    }

    public function employee_data_report(){
        $employee = $this->Users_model->get_employees_data(); 

        $school = ucwords($employee['school']);
       

        // set table
        $table = <<<EOD
            <br>
            <br>
            <table id="main" style="font-size: 13px; text-align: left;">
                <tbody>
                <tr>
                    <td colspan="2">
                        <center>
                            <img src="$employee[id_pic]" style="height: 100px">
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>Employee ID:</td>
                    <td>$employee[id]</td>
                </tr>
                <tr>
                    <td>Surname:</td>
                    <td>$employee[l_name]</td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td>$employee[f_name]</td>
                </tr>
                <tr>
                    <td>Middle Name:</td>
                    <td>$employee[m_name]</td>
                </tr>
                <tr>
                    <td>Department:</td>
                    <td>$employee[department_name]</td>
                </tr>
                <tr>
                    <td>Designation:</td>
                    <td>$employee[designation_name]</td>
                </tr>
                <tr>
                    <td>Employment Status:</td>
                    <td>$employee[status]</td>
                </tr>
                <tr>
                    <td>Sex:</td>
                    <td>$employee[sex]</td>
                </tr>
                <tr>
                    <td>Birthday:</td>
                    <td>$employee[bday]</td>
                </tr>
                <tr>
                    <td>Place of Birth:</td>
                    <td>$employee[birth_place]</td>
                </tr>
                <tr>
                    <td>Purok:</td>
                    <td>$employee[purok]</td>
                </tr>
                <tr>
                    <td>Barangay:</td>
                    <td>$employee[brgy]</td>
                </tr>
                <tr>
                    <td>Municipality:</td>
                    <td>$employee[municipality]</td>
                </tr>
                <tr>
                    <td>Province:</td>
                    <td>$employee[province]</td>
                </tr>
                <tr>
                    <td>ZIP Code:</td>
                    <td>$employee[zip]</td>
                </tr>
                <tr>
                    <td>Date Hired:</td>
                    <td>$employee[date_hired]</td>
                </tr>
                <tr>
                    <td>Plantilla:</td>
                    <td>$employee[plantilla]</td>
                </tr>
                <tr>
                    <td>Education:</td>
                    <td>$employee[education]</td>
                </tr>
                <tr>
                    <td>School Name:</td>
                    <td>$school</td>
                </tr>
                <tr>
                    <td>PRC Number:</td>
                    <td>$employee[prc]</td>
                </tr>
                <tr>
                    <td>PRC Date of Registration:</td>
                    <td>$employee[prc_reg]</td>
                </tr>
                <tr>
                    <td>PRC Date of Expiry:</td>
                    <td>$employee[prc_exp]</td>
                </tr>
                <tr>
                    <td>PhilHealth Number:</td>
                    <td>$employee[philhealth]</td>
                </tr>
                <tr>
                    <td>Contact Number:</td>
                    <td>$employee[phone]</td>
                </tr>
                <tr>
                    <td>Marital Status:</td>
                    <td>$employee[marital_status]</td>
                </tr>
                <tr>
                    <td>GSIS Number:</td>
                    <td>$employee[gsis]</td>
                </tr>
                <tr>
                    <td>SSS Number:</td>
                    <td>$employee[sss]</td>
                </tr>
                <tr>
                    <td>Pag-Ibig Number:</td>
                    <td>$employee[pag_ibig]</td>
                </tr>
                <tr>
                    <td>TIN Number:</td>
                    <td>$employee[tin]</td>
                </tr>
                <tr>
                    <td>ATM Number:</td>
                    <td>$employee[atm]</td>
                    </tr>
                <tr>
                    <td>Blood Type:</td>
                    <td>$employee[blood_type]</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>$employee[email]</td>
                </tr>
                <tr>
                    <td>Remarks:</td>
                    <td>$employee[remarks]</td>
                </tr>
                </tbody>
            </table> 
            EOD;

        $title = 
            <<<EOD
                <table style="width:100%">
                    <tr>
                        <td align="right">
                            <div>
                                <img src="assets/img/pdf_logo_3.jpg" style="width: 75px;">
                            </div>  
                        </td>
                        <td>
                            <p align="center" style="font-size: 14px">
                                Republic of the Philippines
                                <br>
                                PROVINCE OF BUKIDNON          
                            </p>
                        </td>
                        <td align="left">
                            <div>
                                <img src="assets/img/logo-2.jpg" style="width: 80px">
                            </div>
                        </td>
                    </tr>
                </table>
                <p align="center" style="font-size: 12px;">
                    <strong>EMPLOYEE DATA</strong>				
                </p> 
            EOD;
        
        $footer = 
            <<<EOD
                <table>
                    <tr>
                        <td>
                            <p align="left" style="font-size: 12px">
                                Prepared by:
                                <br>
                                <br>
                                JUNRIEL D. OCOR, MPSM
                                <br>
                                Administrative Aide III/Payroll in-charge
                            </p>
                        </td>
                    </tr>
                </table>
            EOD;

        $this->generate_pdf($title, $table, $footer, 'employee profile.pdf');
    }

    private function generate_pdf($title, $table, $footer, $filename){
        require_once(APPPATH . 'helpers/tcpdf/tcpdf.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->AddPage();

        $date = date('F Y',strtotime('01-01-2023'));

        // Main content

        $html = <<<EOD
        <div align="center">
            $title
            $table
        </div>
        $footer
        EOD;
    
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->Output($filename, 'I');

    }
}