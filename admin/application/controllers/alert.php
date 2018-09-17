<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of alert
 *
 * @author Anwar
 */
class alert extends Controller {
    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_alert');
        if(!common::is_admin_user()) {
            common::redirect();
        }
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Student ID', 'Student Name','Class','Mobile');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "student_name",
                        "index" => "student_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "class_name",
                        "index" => "class_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                
                array("name" => "mobile",
                        "index" => "mobile",
                        "width" => 70,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Passport &amp; Visa Alert", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('alert/load_student'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Student Alert','url'=>'')
        );
        $data['thickbox']=TRUE;
        $data['msg']=$this->session->flashdata('msg');

        $data['dir']='alert';
        $data['page']='index';
        $data['page_title']='Student Alert';
        $this->load->view('main',$data);
    }
    function create_xls_pv() {
        $rows = $this->mod_alert->get_pass_visa_alert();
        $colums_rows = array('Student ID', 'Student Name','Program','Passport Expiry','Visa Expiry','Mobile');
        $this->load->library('ExcelExport');
        $excel=new ExcelExport();
        $excel->addRow($colums_rows);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $excel->addRow(array(
                        $row['user_name'],
                        $row['student_name'],
                        $row['program_name'],
                        $row['passport_expiry'],
                        $row['visa_expiry'],
                        $row['mobile']
                ));
            }
        }
        $excel->download('passport_visa_'.date('Y_m_d').'.xls');
    }
    function attendance() {
        $this->load->model('mod_attendance');
        $this->load->library('grid');
        $attdgridObj=new grid();
        $attdgridColumn = array('Student ID', 'Student Name','Class','Continues miss','Total Attendance','Mobile','Exemption');
        $attdgridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "student_name",
                        "index" => "student_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "class_name",
                        "index" => "class_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "absent",
                        "index" => "absent",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "percentage",
                        "index" => "percentage",
                        "width" => 70,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "mobile",
                        "index" => "mobile",
                        "width" => 70,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "exemption",
                        "index" => "exemption",
                        "width" => 70,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $attdgridObj->setGridOptions("Continues Attendance Miss Alert", 900, 250, "user_name", "asc", $attdgridColumn, $attdgridColumnModel, site_url('?c=alert&m=load_attendance&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $attdgridObj->setGridOptions("Continues Attendance Miss Alert", 900, 250, "user_name", "asc", $attdgridColumn, $attdgridColumnModel, site_url('alert/load_attendance'), true);
        }

        $data['attd_grid_data']=$attdgridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Continues Attendance Miss Alert','url'=>'')
        );
        $data['thickbox']=TRUE;
        $data['letters']=$this->mod_attendance->get_letter_options();
        $data['dir']='alert';
        $data['page']='attendance';
        $data['page_title']='Student Alert';
        $this->load->view('main',$data);
    }
    function load_student() {
        $this->mod_alert->get_studentGrid();
    }
    function load_attendance() {
        $this->mod_alert->get_attendanceGrid();
    }
    function create_xls() {
        $rows = $this->mod_alert->get_attendance_alert();
        $colums_rows = array('Student ID', 'Student Name','Class','Continues miss','Total attendance','Mobile','Exemption');
        $this->load->library('ExcelExport');
        $excel=new ExcelExport();
        $excel->addRow($colums_rows);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                if(sql::count('exemption',"student_id=$row[student_id]")>0) {
                    $exemption='Yes';
                }
                else {
                    $exemption= 'No';
                }
                $excel->addRow(array(
                        $row['user_name'],
                        $row['student_name'],
                        $row['class_name'],
                        $row['absent'],
                        $row['percentage'],
                        $row['mobile'],
                        $exemption
                ));
            }
        }
        $excel->download('attendance_alert_'.date('Y_m_d').'.xls');
    }
    function staffs() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Staff ID', 'Staff Name','Designation','Department','Passport Expiry','Visa Expiry');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "designation",
                        "index" => "program_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "department_name",
                        "index" => "department_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "passport_expiry",
                        "index" => "passport_expiry",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "visa_expiry",
                        "index" => "visa_expiry",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Passport &amp; Visa Alert", 870, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('alert/load_staff'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Staffs Alert','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='alert';
        $data['page']='staffs';
        $data['page_title']='Staffs Alert';
        $this->load->view('main',$data);
    }
    function load_staff() {
        $this->mod_alert->get_staffGrid();
    }
}
?>
