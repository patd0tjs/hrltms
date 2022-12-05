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

    // main export and excel generation
    public function generate_report(){
        header('Content-Type: application/vnd.ms_excel');
        header('Content-Disposition: attachment;filename="hris_report.xlsx"');

        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        // cell merging
        $spreadsheet->getActiveSheet()->mergeCells("A1:G1");
        $spreadsheet->getActiveSheet()->mergeCells("A2:G2");
        $spreadsheet->getActiveSheet()->mergeCells("A3:G3");
        $spreadsheet->getActiveSheet()->mergeCells("A4:G4");
        $spreadsheet->getActiveSheet()->mergeCells("A5:G5");
        $spreadsheet->getActiveSheet()->mergeCells("A6:G6");
        $spreadsheet->getActiveSheet()->mergeCells("A7:G7");
        $spreadsheet->getActiveSheet()->mergeCells("A8:G8");

        // for table header
        $spreadsheet->getActiveSheet()->mergeCells("A10:A11");
        $spreadsheet->getActiveSheet()->mergeCells("B10:B11");
        $spreadsheet->getActiveSheet()->mergeCells("C10:C11");
        $spreadsheet->getActiveSheet()->mergeCells("D10:D11");
        $spreadsheet->getActiveSheet()->mergeCells("E10:E11");
        $spreadsheet->getActiveSheet()->mergeCells("F10:G10");

        // autsize column
        foreach (range('A', 'I') as $column) {            
            $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            
        }
        $spreadsheet->getActiveSheet()->getStyle('A:I')->getAlignment()->setHorizontal('center');

        // set headers
        $sheet->setCellValue('A1', 'Republic of the Philippines');
        $sheet->setCellValue('A2', 'PROVINCE OF BUKIDNON');
        $sheet->setCellValue('A3', 'Provincial Capitol');
        $sheet->setCellValue('A5', 'MONTHLY TARDY AND UNDERTIME SUMMARY REPORT');
        $sheet->setCellValue('A6', 'From '. $s_date . ' to ' .$s_date);
        $sheet->setCellValue('A8', 'OFFICE: BUKIDNON PROVINCIAL HOSPITAL-KIBABWE (REGULAR)');

        $sheet->setCellValue('A10', 'NO');
        $sheet->setCellValue('B10', 'NAME');
        $sheet->setCellValue('C10', 'DESIGNATION');
        $sheet->setCellValue('D10', 'NO. OF TIMES TARDY');
        $sheet->setCellValue('E10', 'NO. OF TIME UNDERTIME');
        $sheet->setCellValue('F10', 'TOTAL NO. OF');
        $sheet->setCellValue('F11', 'HOURS');
        $sheet->setCellValue('G11', 'MINUTES');

        $employees = $this->report_data();

        $current_row = 12;
        for($i = 0; $i < count($employees); $i++){

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

            // cell generation
            $row = $current_row + $i;
            $sheet->setCellValue('A' . $row, 1+$i);
            $sheet->setCellValue('B' . $row, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name']);
            $sheet->setCellValue('C' . $row, $employees[$i]['designation_name']);
            $sheet->setCellValue('D' . $row, $tardy['num_tardy']);
            $sheet->setCellValue('E' . $row, $undertime['num_undertime']);
            $sheet->setCellValue('F' . $row, $total_hours);
            $sheet->setCellValue('G' . $row, $total_minutes);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");

    }

    public function leaves_report(){
        header('Content-Type: application/vnd.ms_excel');
        header('Content-Disposition: attachment;filename="approved_leaves.xlsx"');

        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        $spreadsheet = new Spreadsheet();

        $employees = $this->DateAndTime_model->get_approved_leaves_data($s_date, $e_date); 
        $sheet = $spreadsheet->getActiveSheet();

        // cell merging
        $spreadsheet->getActiveSheet()->mergeCells("A1:E1");
        $spreadsheet->getActiveSheet()->mergeCells("A2:E2");
        $spreadsheet->getActiveSheet()->mergeCells("A3:E3");
        $spreadsheet->getActiveSheet()->mergeCells("A4:E4");

        // set headers
        $sheet->setCellValue('A1', 'Date: ' . $s_date . ' to ' . $e_date);
        $sheet->setCellValue('A2', 'Subject: APPLICATION FOR LEAVE');
        $sheet->setCellValue('A3', "Ma'am, respectfully submitting herewith the Application for Leave of BPH-Kibawe personnel, to wit;");
        $sheet->setCellValue('A5', "NO.")->setCellValue('B5', "NAME OF EMPLOYEES")->setCellValue('C5', "DESIGNATION")->setCellValue('D5', "DATE OF LEAVE")->setCellValue('E5', "NATURE OF LEAVE");

        $current_row = 6;

        for($i = 0; $i < count($employees); $i++){
            // cell generation
            $row = $current_row + $i;
            $sheet->setCellValue('A' . $row, 1+$i);
            $sheet->setCellValue('B' . $row, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name']);
            $sheet->setCellValue('C' . $row, $employees[$i]['designation']);
            $sheet->setCellValue('D' . $row, $employees[$i]['s_date'] . ' to '. $employees[$i]['e_date']);
            $sheet->setCellValue('E' . $row, $employees[$i]['nature']);
        }
        // autsize column
        foreach (range('A', 'E') as $column) {            
            $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            
        }

       

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}