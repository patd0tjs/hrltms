<?php

require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->load->database();
    }

    private function report_data(){
        $this->db->select('employees.id as id')
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

    private function get_tardy($emp_id){
        return $this->db->select('count(*) as num_tardy')
                        ->where('emp_id', $emp_id)
                        ->get('tardy')
                        ->row_array();
    }

    public function get_tardy_time(){
        $total_time = array();
        $time = $this->db->select('diff')
                         ->where('emp_id', 'itspatnotrick')
                         ->get('tardy')
                         ->result_array();

        foreach($time as $t):
            array_push($total_time, $t['diff']);
        endforeach;

        foreach ($total_time as $total):
            $total+$total;
        endforeach;
        echo $total;
    }
    public function generate_report(){
        // header('Content-Type: application/vnd.ms_excel');
        // header('Content-Disposition: attachment;filename="hello_world.xlsx"');

        // $spreadsheet = new Spreadsheet();

        // $sheet = $spreadsheet->getActiveSheet();

        // $this->get_tardy_time();

        $time = "06:58:00";
        $time2 = "00:40:00";

        $secs = strtotime($time2)-strtotime("00:00:00");
        echo $result = date("H:i:s",strtotime($time)+$secs);
    }
}