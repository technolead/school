<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of create_excel
 *
 * @author Anwar
 */
class create_excel extends Controller {
    function  __construct() {
        parent::Controller();
        common::is_logged();
    }
     function std_status_xls() {
        $this->load->model('mod_report');
        $rows = $this->mod_report->get_std_report();
        $colums_rows = array('Student ID', 'Student Name','Student Status','Class','Session','Email','Comments');
        $this->load->library('ExcelExport');
        $excel=new ExcelExport();
        $excel->addRow($colums_rows);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $excel->addRow(array(
                       $row['user_name'],
                       $row['student_name'],                       
                       $row['student_status'],
                       $row['class_name'],
                       $row['session_name'],
                       $row['email'],
                       $row['comments']
                ));
            }
        }
        $excel->download('students_status_report.xls');
    }
     function vp_report_xls() {
          $this->load->model('mod_report');
        $rows = $this->mod_report->get_std_vp_report();
        $colums_rows = array('Student ID', 'Student Name','Programme','Student Status','Level Name','Semester Name','Passport Expiry','Visa Expiry','Email');
        $this->load->library('ExcelExport');
        $excel=new ExcelExport();
        $excel->addRow($colums_rows);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
                $excel->addRow(array(
                       $row['user_name'],
                       $row['student_name'],
                       $row['program_name'],
                       $row['student_status'],
                       $row['level_name'],
                       $row['semester_name'],
                       $row['passport_expiry'],
                       $row['visa_expiry'],
                       $row['email']
                ));
            }
        }
        $excel->download('students_visa_passport_report.xls');
    }
}
?>
