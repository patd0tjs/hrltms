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


            array_push($record, $i+1, $employees[$i]['l_name'] . ', ' . $employees[$i]['f_name'], $employees[$i]['designation_name'], $tardy['num_tardy'], $undertime['num_undertime'], $total_hours, $total_minutes);
            array_push($table_data, $record);
        }

        // set an empty row
        $row = '';
        foreach($table_data as $table):
            $row .= 
            <<<EOD
                <tr>
                    <td>$table[0]</td>
                    <td>$table[1]</td>
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
                        <td>
                            No.
                        </td>
                        <td>
                            NAME
                        </td>
                        <td>
                            DESIGNATION
                        </td>
                        <td>
                            NO. OF TIMES TARDY
                        </td>
                        <td>
                            NO. OF TIMES UNDERTIME
                        </td>
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
            <p align="center" style="font-size: 12px">
                MONTHLY TARDY AND UNDERTIME SUMMARY REPORT
                <br>
                For the month of $report_date
                <br>
                <br>
                OFFICE: BUKIDNON PROVINCIAL HOSPITAL-KIBABWE (REGULAR)									
            </p> 
            EOD;

        $this->generate_pdf($title, $table, 'hello.pdf');

    }

    public function leaves_report(){
        header('Content-Type: application/vnd.ms_excel');
        header('Content-Disposition: attachment;filename="approved_leaves.xlsx"');

        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');

        date_default_timezone_set('Asia/Manila');
        $timezone = date_default_timezone_get();
        $today = date("F d, Y");

        $spreadsheet = new Spreadsheet();

        $employees = $this->DateAndTime_model->get_approved_leaves_data($s_date, $e_date); 
        $sheet = $spreadsheet->getActiveSheet();

        // cell merging
        $spreadsheet->getActiveSheet()->mergeCells("A1:E1");
        $spreadsheet->getActiveSheet()->mergeCells("A2:E2");
        $spreadsheet->getActiveSheet()->mergeCells("A3:E3");
        $spreadsheet->getActiveSheet()->mergeCells("A4:E4");

        // set headers
        $sheet->setCellValue('A1', 'Date: ' . date('F d, Y',strtotime($today)));
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
            $sheet->setCellValue('D' . $row, date("M d", strtotime($employees[$i]['s_date'])) . ' - ' . date("d, Y", strtotime($employees[$i]['e_date'])));
            $sheet->setCellValue('E' . $row, $employees[$i]['nature']);
        }
        // autsize column
        foreach (range('A', 'E') as $column) {            
            $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            
        }

       

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    private function generate_pdf($title, $table, $filename){
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
            <table>
                <tr>
                    <td align="right">
                        <div>
                            <img src="assets/img/pdf_logo_1.png" style="width: 75px;">
                        </div>  
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
                        <div>
                            <img src="assets/img/pdf_logo_2.png" style="width: 80px">
                        </div>
                    </td>
                </tr>
            </table>
            $title
            $table
        </div>
        <div align="right">
            <img src="assets/img/pdf_footer.jpg" style="width: 500px;">
        </div>
        EOD;
    
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->Output($filename, 'I');

    }
}