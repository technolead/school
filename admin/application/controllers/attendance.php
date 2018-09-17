<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of attendance
 *
 * @author Anwar
 */
class attendance extends Controller {
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_attendance');
    }
    function index() {
        /*-----------------Pagination--------------*/
        if(!common::user_permit('delete','arv_attd')) {
            common::redirect();
        }
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start==''||!is_numeric($start)) {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('attendance/index/');
        $config['total_rows'] = count($this->mod_attendance->get_class_attendance());
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_attendance->get_class_attendance("limit $start,{$config['per_page']}"); 
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='attendance';
        $data['page']='index';
        $data['page_title']='Manage Attendance';
        $this->load->view('main',$data);
    }
    function class_attendance($type_id='') {
        if(!common::user_permit('delete','arv_attd')) {
            common::redirect();
        }
        if($module_id==0 && $type_id=='') {
            redirect('attendance');
        }
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(5);
        if($start==''||!is_numeric($start)) {
            $start=0;
        }
        $config['uri_segment'] = 5;
        $config['base_url'] = site_url('attendance/class_attendance/'.$type_id.'/');
        $config['total_rows'] = count($this->mod_attendance->sort_class_attendance($type_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_attendance->sort_class_attendance($type_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='attendance';
        $data['module_id']=$module_id;
        $data['attendance_type_id']=$type_id;
        $data['page']='index';
        $data['page_title']='Manage Attendance';
        $this->load->view('main',$data);
    }

    function view_attendance() {
        if(!common::user_permit('view','std_attendance')) {
            common::redirect();
        }
        if($_POST['search']) {
            if($this->form_validation->run('view_attendance')) {
                $data=sql::row('view_std_reg',"user_name='{$_POST['user_name']}' and session_id='{$_POST['session_id']}'",'student_id,session_id');
                if($data['student_id']=='') {
                    $data['msg']='Selected Student has no attendance record!';
                }else {
                    $this->session->set_userdata('sel_student_id',$data['student_id']);
                    $this->session->set_userdata('sel_class_id',$_POST['class_id']);
                    
                    $this->session->set_userdata('sel_session_id',$_POST['session_id']);
                    $this->session->set_userdata('sel_module_id',$_POST['module_id']);
                    $this->session->set_userdata('sel_section',$_POST['section']);
                    $this->session->set_userdata('sel_type_id',$_POST['attendance_type_id']);
                    $this->session->set_userdata('sel_from_date',$_POST['from_date']);
                    $this->session->set_userdata('sel_to_date',$_POST['to_date']);
                    redirect('attendance/student_attendance');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'View Attendance','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='view_attendance'; //Don't Change
        $data['page_title']='View Attendance';
        $this->load->view('main',$data);
    }
    function student_attendance($type_id='') {
        $student_id=$this->session->userdata('sel_student_id');
        $session_id=$this->session->userdata('sel_session_id');
        if($student_id=='') {
            redirect('attendance/view_attendance');
        }
        
        if($type_id=='') {
            $type_id='all';
        }
        $data=sql::row('view_std_reg',"student_id='$student_id' and session_id=$session_id");

        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(5);
        if($start==''||!is_numeric($start)) {
            $start=0;
        }
        $config['uri_segment'] = 5;
        $config['base_url'] = site_url('attendance/student_attendance/'.$type_id.'/');
        $config['total_rows'] = count($this->mod_attendance->get_student_attendance($type_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_attendance->get_student_attendance($type_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/


        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'View Attendance','url'=>site_url('attendance/view_attendance')),
                array('title'=>'Student Attendance View','url'=>''),
        );
        $data['from_date']=$this->session->userdata('sel_from_date');
        $data['to_date']=$this->session->userdata('sel_to_date');
        $data['module_id']=$module_id;
        $data['attendance_type_id']=$type_id;
        $data['dir']='attendance';
        $data['page']='student_attendance'; //Don't Change
        $data['page_title']='Student Attendance';
        $this->load->view('main',$data);
    }
    function percentage_view() {
        $student_id=$this->session->userdata('sel_student_id');
        $session_id=$this->session->userdata('sel_session_id');
        if($student_id==''||$session_id=='') {
            redirect('attendance/view_attendance');
        }
        $data=sql::row('view_std_reg',"student_id='$student_id' and session_id=$session_id");
        $data['rows']=$this->mod_attendance->get_percentage_view();
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'View Attendance','url'=>site_url('attendance/view_attendance')),
                array('title'=>'Student Attendance View','url'=>site_url('attendance/student_attendance')),
                array('title'=>'Cumulative Attendance Report','url'=>'')
        );
        $data['from_date']=$this->session->userdata('sel_from_date');
        $data['to_date']=$this->session->userdata('sel_to_date');
        $data['dir']='attendance';
        $data['print_view']=TRUE;
        $data['page']='percentage_view'; //Don't Change
        $data['page_title']='Cumulative Attendance Report';
        $this->load->view('main',$data);
    }
    function attd_print_view() {
        $student_id=$this->session->userdata('sel_student_id');
        $session_id=$this->session->userdata('sel_session_id');
        if($student_id==''||$session_id=='') {
            redirect('attendance/view_attendance');
        }
        $data=sql::row('view_std_reg',"student_id='$student_id' and session_id=$session_id");
        $data['rows']=$this->mod_attendance->get_percentage_view();
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'View Attendance','url'=>site_url('attendance/view_attendance')),
                array('title'=>'Student Attendance View','url'=>site_url('attendance/student_attendance')),
                array('title'=>'Student Cummulative Attendance','url'=>'')
        );
        $data['from_date']=$this->session->userdata('sel_from_date');
        $data['to_date']=$this->session->userdata('sel_to_date');
        $data['dir']='attendance';
        $data['page']='percentage_view'; //Don't Change
        $data['page_title']='Cumulative Attendance Report';
        $this->load->view('print_main',$data);
    }
    // Working Start
    function print_attendance() {
        if(!common::user_permit('add','print_attd')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('print_attendance')) {
                if($this->mod_attendance->save_print_attendance()) {
                    $this->session->set_flashdata('msg','Print Attendance Added Successfully!');
                    redirect('attendance/mng_print_attendance');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage print Attendance','url'=>site_url('attendance/mng_print_attendance')),
                array('title'=>'Print Attendance','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='print_attendance'; //Don't Change
        $data['page_title']='Print Attendance';
        $this->load->view('main',$data);
    }
    function mng_print_attendance() {
        if(!common::user_permit('view','print_attd')) {
            common::redirect();
        }
        $this->load->model('mod_print_attendance');
        $this->load->library('grid');
        $attdgridObj=new grid();
        $attdgridColumn = array('Class Name', 'Session Name','Section','Module Name','Date','Class Type','Taken By','Action');
        $attdgridColumnModel = array(
                array("name" => "class_name",
                        "index" => "class_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                
                array("name" => "session_name",
                        "index" => "session_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "section",
                        "index" => "section",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "module_name",
                        "index" => "module_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "pa.date",
                        "index" => "pa.date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "attendance_type",
                        "index" => "attendance_type",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "taken_by",
                        "index" => "taken_by",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                 array("name" => "action",
                        "index" => "action",
                        "width" => 70,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => false
                )
        );
        if($_POST['apply_filter']){
            $attdgridObj->setGridOptions("Print Attendance", 880, 250, "pa.date", "asc", $attdgridColumn, $attdgridColumnModel, site_url('?c=attendance&m=load_print_attendance&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else{
            $attdgridObj->setGridOptions("Print Attendance", 880, 250, "pa.date", "asc", $attdgridColumn, $attdgridColumnModel, site_url('attendance/load_print_attendance'), true);
        }
        
        $data['grid_data']=$attdgridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Print Attendance','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='attendance';
        $data['page']='mng_print_attendance'; //Don't Change
        $data['page_title']='Print Attendance';
        $this->load->view('main',$data);
    }
     function load_print_attendance(){
        $this->load->model('mod_print_attendance');
        $this->mod_print_attendance->get_printAttendanceGrid();
    }
    function edit_print_attendance($print_attendance_id='') {
        if(!common::user_permit('add','print_attd')) {
            common::redirect();
        }
        if($print_attendance_id=='') {
            common::redirect();
        }

        if($_POST['update']) {
            if($this->form_validation->run('print_attendance')) {
                if($this->mod_attendance->update_print_attendance()) {
                    $this->session->set_flashdata('msg','Print Attendance Updated Successfully!');
                    redirect('attendance/mng_print_attendance');
                }
            }
        }
        $data=sql::row('print_attendance',"print_attendance_id=$print_attendance_id");
        $this->session->set_userdata('print_attendance_id',$data['print_attendance_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Print Attendance','url'=>site_url('attendance/mng_print_attendance')),
                array('title'=>'Edit Print Attendance','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='edit_print_attendance'; //Don't Change
        $data['page_title']='Edit Print Attendance';
        $this->load->view('main',$data);
    }
    function del_print_attendance($print_attendance_id='') {
        if(!common::user_permit('delete','print_attd')) {
            common::redirect();
        }
        if($print_attendance_id=='') {
            common::redirect();
        }
        sql::delete('print_attendance',"print_attendance_id=$print_attendance_id");
        $this->session->set_flashdata('msg','Content Deleted successfully!');
        common::redirect();
    }
    function print_attd_view($print_attendance_id='') {
        if($print_attendance_id=='') {
            common::redirect();
        }
        $data=$this->mod_attendance->get_print_attd_details($print_attendance_id);
        if($data['module_id']=='' || $data['session_id']=='') {
            common::redirect();
        }
        $data['rows']=$this->mod_attendance->get_module_reg_student($data['class_id'],$data['module_id'],$data['session_id'],$data['section']);
        $data['dir']='attendance';
        $data['tsign']=TRUE;
        $data['page']='print_attd_view'; //Don't Change
        $data['page_title']='Print Attendance';
        $this->load->view('print_main',$data);
    }
    function record_attendance() {
        if(!common::user_permit('add','arv_attd')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Record Attendance','url'=>'')
        );
        if($_POST['save']) {
            if($this->form_validation->run('valid_attendance')) {
                $class_attendance_id=$this->mod_attendance->save_class_attendance();
                redirect('attendance/reg_attendance/'.$class_attendance_id);
                exit;
            }

        }
        $this->session->set_userdata("student_action","record");
        $data['dir']='attendance';
        $data['page']='record_attendance'; //Don't Change
        $data['page_title']='Record Attendance';
        $this->load->view('main',$data);
    }
    function is_have_student() {

        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);

        if(count($this->mod_attendance->get_class_reg_student($class_map_id,$_POST['section']))>0) { //Need to check Continue Status
            return TRUE;
        }else {
            if($_POST['view']) {
                $txt='Attendance';
            }else {
                $txt='Active Student';
            }
            $this->form_validation->set_message('is_have_student',"Selected Class has no $txt! at the selected Session");
            return FALSE;
        }
    }
    function is_exits_attendance() {
        if($_POST['view']) {
            return TRUE;
        }

        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(sql::count('class_attendance',"class_map_id='{$class_map_id}' and section ='{$_POST['section']}' and date='{$_POST['date']}' and attendance_type_id={$_POST['attendance_type_id']}")>0) {
            $this->form_validation->set_message('is_exits_attendance',"This attendance already exits, Please Update this if required!");
            return FALSE;
        }else {
            return TRUE;
        }
    }
    function is_valid_student() {
        if(sql::count('student',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_student','Sorry, Student ID is invalid!!!');
            return FALSE;
        }
    }

    function reg_attendance($class_attendance_id='') {
        if($class_attendance_id==''||!is_numeric($class_attendance_id)) {
            common::redirect();
        }
        if($_POST['save_attendance']) {
            $this->mod_attendance->save_reg_attendace();
            redirect('attendance');
        }
        $data=$this->mod_attendance->get_class_attendance_details($class_attendance_id);
        
        $this->session->set_userdata('class_attendance_id',$data['class_attendance_id']);
        $this->session->set_userdata('attd_class_map_id',$data['class_map_id']);
        
        $data['rows']=$this->mod_attendance->get_class_reg_student($data['class_map_id'],$data['section']);
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Attendance Registration','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='reg_attendance'; 
        $data['page_title']='Attendance Registration';
        $this->load->view('main',$data);
    }
    function delete_attendance($attendance_id='') {
        if(!common::user_permit('delete','std_attendance')) {
            common::redirect();
        }
        if($attendance_id=='') {
            redirect('attendance');
        }
        $rows=sql::rows('std_attendance',"module_attendance_id=$attendance_id");
        if(!empty ($rows)) {
            foreach($rows as $row) {
                $attedance=$row['attendance'];
                sql::delete('std_attendance',"module_attendance_id=$attendance_id and student_id='$row[student_id]'");
                if($row['attendance']==0) {
                    $this->mod_attendance->add_continuous_absent($row[student_id]);
                }
            }
        }
        sql::delete('module_attendance',"module_attendance_id=$attendance_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('attendance');
    }
    function view_register() {
        if(!common::user_permit('add','arv_attd')) {
            common::redirect();
        }
        if($_POST['view']) {
            if($this->form_validation->run('valid_view_register')) {

                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $data=sql::row('class_attendance',"class_map_id='{$class_map_id}' and date='{$_POST['date']}' and attendance_type_id={$_POST['attendance_type_id']}",'class_attendance_id');
                $class_attendance_id=$data['class_attendance_id'];
                if($class_attendance_id!='') {
                    redirect('attendance/edit_reg_attendance/'.$class_attendance_id);
                    exit;
                }else {
                    $data['error_msg']='This Class has no attendance record at inputed Date!';
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Record Attendance','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='view_register'; //Don't Change
        $data['page_title']='View Register';
        $this->load->view('main',$data);
    }
    function edit_reg_attendance($class_attendance_id='') {
        if(!common::user_permit('add','arv_attd')) {
            common::redirect();
        }
        if($class_attendance_id==''||!is_numeric($class_attendance_id)) {
            redirect('attendance');
        }
        if($_POST['update_attendance']) {
            $this->mod_attendance->update_class_attendance();
            $this->mod_attendance->update_reg_attendace();
            $this->session->set_flashdata('msg','Attendance Updated Successfully!!!');
            redirect('attendance');
        }
        $data=$this->mod_attendance->get_class_attendance_details($class_attendance_id);
        //print_r($data);
        $this->session->set_userdata('class_attendance_id',$data['class_attendance_id']);
        $data['rows']=$this->mod_attendance->get_edited_student_attd($class_attendance_id);
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Attendance Registration','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='edit_reg_attendance'; //Don't Change
        $data['page_title']='Attendance Registration';
        $this->load->view('main',$data);
    }
    function manage_attendance() {
        if(!common::user_permit('add','std_attendance')) {
            common::redirect();
        }
        if($_POST['view']) {
            if($this->form_validation->run('manage_attendance')) {
                $data=sql::row('student',"user_name='{$_POST['user_name']}'",'student_id');
                if($data['student_id']!='') {
                    $this->session->set_userdata('sel_student_id',$data['student_id']);
                    $this->session->set_userdata('sel_class_id',$_POST['class_id']);
                    $this->session->set_userdata('sel_session_id',$_POST['session_id']);                    
                    $this->session->set_userdata('sel_section',$_POST['section']);
                    $this->session->set_userdata('sel_from_date',$_POST['from_date']);
                    $this->session->set_userdata('sel_to_date',$_POST['to_date']);
                    $this->session->set_userdata('sel_attendance_type_id',$_POST['attendance_type_id']);
                    redirect('attendance/edit_std_attendance');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Manage Student Attendance','url'=>'')
        );
        $data['dir']='attendance';
        $data['page']='manage_attendance'; //Don't Change
        $data['page_title']='Manage Attendance';
        $this->load->view('main',$data);
    }
    function edit_std_attendance() {
        if(!common::user_permit('add','std_attendance')) {
            common::redirect();
        }
        $student_id=$this->session->userdata('sel_student_id');
        
        if($_POST['update_reg']) {
            $this->mod_attendance->update_std_attendance();
            $this->mod_attendance->add_continuous_absent($student_id);
            $this->session->set_flashdata('msg','Attendance Record Updated Successfully!!!');
            common::redirect();
        }

        $data=sql::row('student',"student_id=$student_id",'user_name,first_name,last_name,email');
        
        $data['rows']=$this->mod_attendance->get_view_std_attendance($student_id);
        $data['nav_array']=array(
                array('title'=>'Manage Attendance','url'=>site_url('attendance')),
                array('title'=>'Manage Student Attendance','url'=>site_url('attendance/manage_attendance')),
                array('title'=>'Student Attendance View','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='attendance';
        $data['page']='edit_std_attendance'; //Don't Change
        $data['page_title']='Edit Student Attendance';
        $this->load->view('main',$data);
    }
    function is_registered_module() {
        $data=sql::row('student',"user_name='{$_POST['user_name']}'",'student_id');
        if($data['student_id']=='') {
            $this->form_validation->set_message('is_registered_module',"The Student ID is not found!");
            return FALSE;
        }
    }

    //Not Show
    function view_summary() {
        /*-----------------Pagination--------------*/
        if(!common::user_permit('view','arv_attd')) {
            common::redirect();
        }
        $this->load->model('mod_student');
        if($_POST['send']) {
            if($this->form_validation->run('valid_issue_letter')) {
                $this->mod_student->send_student_letters();
                $this->session->set_flashdata('msg','Letter Sent Successfully!!!');
                redirect($this->uri->uri_string());
            }
        }
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start==''||!is_numeric($start)) {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('attendance/view_summary/');
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";

        if($_POST['apply_filter']) {
            $this->valid_filter();
            if($this->form_validation->run()) {
                $config['per_page'] =  count($this->mod_attendance->filter_attd_summery());
                $config['total_rows'] = count($this->mod_attendance->filter_attd_summery());
                $data['rows']=$this->mod_attendance->filter_attd_summery(); //Don't Change
            }
        }else {
            $config['total_rows'] = count($this->mod_attendance->get_attd_summery());
            $data['rows']=$this->mod_attendance->get_attd_summery("limit $start,{$config['per_page']}"); //Don't Change
        }
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'View Attendance Summary','url'=>'')
        );
        $data['thickbox']=TRUE;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='attendance';
        $data['page']='view_summary';
        $data['page_title']='View Attendance Summary';
        $this->load->view('main',$data);
    }
    function valid_filter() {
        $this->form_validation->set_rules('class_id', 'class', '');
        
        $this->form_validation->set_rules('session_id', 'session', '');
        $this->form_validation->set_rules('absent', 'Absent', '');
        $this->form_validation->set_rules('percentage', 'Percentage', '');
    }
    function view_con_absent($student_id='') {
        if($student_id=='') {
            echo 'Critical Error';
        }
        echo 'Yes';
        $this->load->view('attendance/view_con_absent',$data);
    }
    function exemption() {
        $student_id=$_GET['student_id'];
        if($student_id=='') {
            echo 'Critical Error!';
        }
        $rows=sql::rows('exemption',"student_id=$student_id");
        if(count($rows)>0) {
            $data.='<table class="txt_center"><tr><th>From Date</th><th>To Date</th><th>Reason</th></tr>';
            foreach ($rows as $row) {
                $data.="<tr><td>$row[from_date]</td><td>$row[to_date]</td><td>$row[reason]</td></tr>";
            }
            $data.='</table>';
        }
        echo $data;
    }


    function add_is_delete(){
        $sql=$this->db->query("show tables");
        $tables=$sql->result_array();
        foreach($tables as $table):
            $sql=$this->db->query("ALTER TABLE $table[Tables_in_work_school] ADD `is_delete` TINYINT( 4 ) NOT NULL DEFAULT '0'");
        endforeach;
    }
}?>