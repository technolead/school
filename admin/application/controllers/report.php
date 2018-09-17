<?php

/**
 * Description of report
 *
 * @author anwar
 */
class report extends Controller {

    function report() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_report');
    }

    function index() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Session','Exam','Grade','Grade Point', 'Attendance', 'Created By', 'Action');
        $gridColumnModel = array(
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
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "session_name",
                "index" => "session_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "exam_name",
                "index" => "exam_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "final_grade",
                "index" => "final_grade",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "final_grade_point",
                "index" => "final_grade_point",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "attendance",
                "index" => "attendance",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "u.first_name",
                "index" => "u.first_name",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "action",
                "index" => "action",
                "width" => 45,
                "sortable" => false,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Progress Report", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), true);
        } else {
            $gridObj->setGridOptions("Manage Progress Report", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_report'), true);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['nav_array'] = array(
            array('title' => 'Manage Progress Report', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'report';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Progress Report';
        $this->load->view('main', $data);
    }

    function load_report() {
        $this->mod_report->get_report_grid();
    }

    function new_report() {
        if ($_POST['con_report']) {
            if ($this->form_validation->run('valid_report')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $this->session->set_userdata('sel_class_map_id',$class_map_id);
                $this->session->set_userdata('sel_class_id', $_POST['class_id']);
                $this->session->set_userdata('sel_session_id', $_POST['session_id']);
                $this->session->set_userdata('sel_exam_id',$_POST['exam_id']);
                $std_data = sql::row('view_std_reg', "user_name='{$_POST['user_name']}'", 'student_id,user_name');
                redirect('report/student_report/' . $std_data['student_id']);
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Progress Report', 'url' => site_url('report')),
            array('title' => 'Add New Progress Report', 'url' => '')
        );
        $data['dir'] = 'report';
        $data['page'] = 'new_report'; //Don't Change
        $data['page_title'] = 'Add New Progress Report';
        $this->load->view('main', $data);
    }

    function student_report($user_name='') {


        if ($user_name == '' || common::student_is_delete($user_name) == true) {
            redirect('report/new_report');
        }
        if ($_POST['finish']) {
            if ($this->mod_report->save_report()) {
                $this->session->set_flashdata('msg', 'Student Progress Report added Successfully!');
                redirect('report');
            }
        }

        $class_map_id=$this->session->userdata('sel_class_map_id');        
        $session_id = $this->session->userdata('sel_session_id');
        $exam_id= $this->session->userdata('sel_exam_id');


        if ($class_map_id != '') {
            $con = " and class_map_id=$class_map_id";
        }
       
        $data = sql::row('view_std_reg', "student_id='$user_name' $con");

        

        if ($data['student_id'] == '') {
            redirect('report/new_report');
        }
        $this->session->set_userdata('sel_student_id', $data['student_id']);
        $data['rows'] = $this->mod_report->get_reg_module_result($class_map_id, $session_id,$exam_id);
        $data['attd_row'] = $this->mod_report->get_attendance_percentage($data['student_id'], $class_map_id);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Report', 'url' => site_url('report')),
            array('title' => 'Add New Progress Report', 'url' => site_url('report/new_report')),
            array('title' => 'Student\'s Progress Report', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'report';
        $data['page'] = 'student_report';
        $data['page_title'] = 'Student Student\'s Progress Report';
        $this->load->view('main', $data);
    }

    function is_valid_student() {
        if (sql::count('student', "user_name='{$_POST['user_name']}'") > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_valid_student', 'Sorry, Student ID is invalid!!!');
            return FALSE;
        }
    }

    function is_registered_student() {
        if (sql::count('view_std_reg', "user_name='{$_POST['user_name']}' and class_id={$_POST['class_id']} and session_id={$_POST['session_id']}") > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_registered_student', 'Selected Session or Class is not registered');
            return FALSE;
        }
    }

    function is_add_report() {
        $std = sql::row('student', "user_name='{$_POST['user_name']}'", 'student_id');
        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if (sql::count('progress_report', "student_id='$std[student_id]' and class_map_id={$class_map_id} and exam_id={$_POST['exam_id']}") > 0) {
            $this->form_validation->set_message('is_add_report', 'Report already added!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function edit_report($report_id='') {
        if ($report_id == '' || !is_numeric($report_id)) {
            redirect('report');
        }

        

        if ($_POST['update']) {
            if ($this->mod_report->update_report()) {
                $this->session->set_flashdata('msg', 'Progress Report Updated Successfully!');
                redirect('report');
            }
        }

        $data = sql::row('progress_report', "report_id=$report_id"); //Don't Change
        
        $this->session->set_userdata('report_id', $data['report_id']); //Don't Change
        $this->session->set_userdata('sel_student_id', $data['student_id']);
        $class_id = $data['class_id'];
        $session_id = $data['session_id'];
        if ($class_id != '') {
            $con = " and class_id=$class_id";
        }
        if ($session_id != '') {
            $con.=" and session_id=$session_id";
        }

        $data['student'] = sql::row('view_std_reg', "student_id='$data[student_id]' $con");
        $data['rows'] = $this->mod_report->get_reg_module_result($data['class_map_id'], $session_id,$data['exam_id']);
        $data['attd_row'] = $this->mod_report->get_attendance_percentage($data['student_id'], $data['class_map_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Progress Report', 'url' => site_url('report')),
            array('title' => 'Edit Progress Report', 'url' => '')
        );
        $data['dir'] = 'report';
        $data['page'] = 'edit_report'; //Don't Change
        $data['page_title'] = 'Edit Progress Report';
        $this->load->view('main', $data);
    }

    function delete_report($report_id='') {
        if ($report_id == '') {
            redirect('report');
        }
        sql::delete('progress_report', 'report_id=' . $report_id);
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        common::redirect();
    }

    function print_view($report_id='') {
        if ($report_id == '') {
            redirect('report');
        }
        $data = sql::row('progress_report', "report_id=$report_id"); //Don't Change
        $this->session->set_userdata('sel_student_id', $data['student_id']);
        $class_id = $data['class_id'];
        $session_id = $data['session_id'];
        if ($class_id != '') {
            $con = " and class_id=$class_id";
        }
        if ($session_id != '') {
            $con.=" and session_id=$session_id";
        }

        $data['student'] = sql::row('view_std_reg', "student_id='$data[student_id]' $con");
        $data['rows'] = $this->mod_report->get_reg_module_result($data['class_map_id'], $session_id,$data['exam_id']);
        $data['attd_row'] = $this->mod_report->get_attendance_percentage($data['student_id'], $data['class_map_id']);

        $data['dir'] = 'report';
        $data['page'] = 'print_view'; //Don't Change
        $data['page_title'] = 'Progress Report';
        $this->load->view('print_main', $data);
    }

    function std_sts_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Session', 'Student Status', 'Comments', 'Action');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.session_name",
                "index" => "s.session_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.comments",
                "index" => "st.comments",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "action",
                "index" => "action",
                "width" => 45,
                "sortable" => false,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Report(Status)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_sts_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
            }
        } else {
            $gridObj->setGridOptions("Student Report(Status)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_sts_report'), false);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['dir'] = 'report';
        $data['page'] = 'std_sts_report'; //Don't Change
        $data['page_title'] = 'Student Report(Status)';
        $this->load->view('main', $data);
    }

    function load_sts_report() {
        $this->mod_report->get_sts_report_grid();
    }

    function print_sts_report() {
        $data['rows'] = $this->mod_report->get_std_report();
        $data['dir'] = 'report';
        $data['page'] = 'print_sts_report'; //Don't Change
        $data['page_title'] = 'Student Report(Status)';
        $this->load->view('print_main', $data);
    }

    function std_vp_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'class', 'Level', 'session', 'Status', 'Passport Expiry', 'Visa Expiry');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.level_name",
                "index" => "s.level_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.session_name",
                "index" => "s.session_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.passport_expiry",
                "index" => "st.passport_expiry",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.visa_expiry",
                "index" => "st.visa_expiry",
                "width" => 65,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_vp_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Report(Visa/Passport)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_vp_report_grid&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
            }
        } else {
            $gridObj->setGridOptions("Student Report(Visa/Passport)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_vp_report_grid'), false);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['dir'] = 'report';
        $data['page'] = 'std_vp_report'; //Don't Change
        $data['page_title'] = 'Student Report(Visa/Passport)';
        $this->load->view('main', $data);
    }

    function load_vp_report_grid() {
        $this->mod_report->get_vp_report_grid();
    }

    function print_vp_report() {
        $data['rows'] = $this->mod_report->get_std_vp_report();
        $data['dir'] = 'report';
        $data['page'] = 'print_vp_report'; //Don't Change
        $data['page_title'] = 'Student Report(Status)';
        $this->load->view('print_main', $data);
    }

    function std_cont_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Session', 'Student Status', 'Telephone', 'Email', 'Present Address');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.session_name",
                "index" => "s.session_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.phone",
                "index" => "st.phone",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.email",
                "index" => "st.email",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "st.present_address",
                "index" => "st.present_address",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Report(Status)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=get_contact_grid&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
            }
        } else {
            $gridObj->setGridOptions("Student Report(Status)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/get_contact_grid'), false);
        }

        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'std_cont_report'; //Don't Change
        $data['page_title'] = 'Student Report(Contact)';
        $this->load->view('main', $data);
    }

    function get_contact_grid() {
        $this->mod_report->get_sts_report_grid(true);
    }

    function print_cont_report() {
        $data['rows'] = $this->mod_report->get_std_report();
        $data['dir'] = 'report';
        $data['page'] = 'print_cont_report'; //Don't Change
        $data['page_title'] = 'Student Report(Status)';
        $this->load->view('print_main', $data);
    }

    function valid_std_report() {
        $this->form_validation->set_rules('awarding_body_id', 'Awarding ', '');
        $this->form_validation->set_rules('class_id', 'Class', '');
        $this->form_validation->set_rules('session_id', 'Session', '');
        $this->form_validation->set_rules('student_status', 'Student Status', '');
        $this->form_validation->set_rules('from_date', 'From Date', '');
        $this->form_validation->set_rules('percentage', 'Percentage', '');
        $this->form_validation->set_rules('absent', 'Absent', '');
        $this->form_validation->set_rules('to_date', 'To date', '');
    }

    function agent_report() {
        $this->load->model('mod_agents');
        if ($_POST['gen_report']) {
            $this->valid_agent_report();
            if ($this->form_validation->run()) {
                $data = sql::row('agents', "user_name='{$_POST['user_name']}'");
                $data['rows'] = $this->mod_report->get_agents_students($data['agents_id']);
                if (count($data['rows']) == 0) {
                    $data['msg'] = 'Sorry, No Content Found! Try another settings!';
                }
            }
        }
        $data['dir'] = 'report';
        $data['page'] = 'agent_report'; //Don't Change
        $data['page_title'] = 'Agent Report';
        $this->load->view('main', $data);
    }

    function valid_agent_report() {
        $this->form_validation->set_rules('user_name', 'Agent ID', 'required|callback_is_valid_agent');
        $this->form_validation->set_rules('class_id', 'class', 'required');
        $this->form_validation->set_rules('from_date', 'From Date', '');
        $this->form_validation->set_rules('to_date', 'To date', '');
    }

    function is_valid_agent() {
        if (sql::count('agents', "user_name='{$_POST['user_name']}'") > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_valid_agent', 'Sorry, Agent ID is invalid!!!');
            return FALSE;
        }
    }

    function letter_report() {
        $this->load->model('mod_letters');
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Stdeunt Name', 'Class', 'Session', 'Letter Title', 'Issue Date', 'Action');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 80,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 100,
                "sortable" => false,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.session_name",
                "index" => "s.session_name",
                "width" => 80,
                "sortable" => false,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "l.letter_title",
                "index" => "l.letter_title",
                "width" => 80,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "sl.issue_date",
                "index" => "sl.issue_date",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "action",
                "index" => "action",
                "width" => 50,
                "sortable" => false,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $gridObj->setGridOptions("Letter Generation Report", 880, 250, "sl.issue_date", "desc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_letter_report&tid=' . $_POST['letter_type_id'] . '&pid=' . $_POST['class_id'] . '&sid=' . $_POST['session_id'] . '&fdate=' . $_POST['from_date'] . '&tdate=' . $_POST['to_date']), false);
        } else {
            $gridObj->setGridOptions("Letter Generation Report", 880, 250, "sl.issue_date", "desc", $gridColumn, $gridColumnModel, site_url('report/load_letter_report'), false);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'letter_report'; //Don't Change
        $data['page_title'] = 'Letter Generation Report';
        $this->load->view('main', $data);
    }

    function load_letter_report() {
        $this->load->helper('text');
        $this->mod_report->get_letter_report_grid();
    }

    function attd_per_report() {
        $this->load->model(array('mod_letters', 'mod_attendance'));
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Session', 'Status', 'Last Con. <br />Missed', 'Percentage');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.session_name",
                "index" => "s.session_name",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "sc.absent",
                "index" => "sc.absent",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "percentage",
                "index" => "percentage",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Attendance Report (Percentage)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_attd_per_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
            }
        } else {
            $gridObj->setGridOptions("Attendance Report (Percentage)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_attd_per_report'), false);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'attd_per_report'; //Don't Change
        $data['page_title'] = 'Attendance Report (Percentage)';
        $this->load->view('main', $data);
    }

    function load_attd_per_report() {
        $this->mod_report->get_attdendance_report_grid(TRUE);
    }

    function print_attd_per_report() {
        $this->load->model(array('mod_letters', 'mod_attendance'));
        $data['rows'] = $this->mod_report->get_attd_per_report();
        $data['dir'] = 'report';
        $data['page'] = 'print_attd_per_report'; //Don't Change
        $data['page_title'] = 'Attendance Report (Percentage)';
        $this->load->view('print_main', $data);
    }

    function attd_class_report() {
        $this->load->model(array('mod_letters', 'mod_attendance'));
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Status', 'Con. missed<br />(3 class)', 'Con. missed<br />(6 class)', 'Con. missed<br />(10 class)', 'Last Con. <br />Missed', 'Percentage');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "three_class",
                "index" => "three_class",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "six_class",
                "index" => "six_class",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "ten_class",
                "index" => "six_class",
                "width" => 45,
                "sortable" => false,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "sc.absent",
                "index" => "sc.absent",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "percentage",
                "index" => "percentage",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Attendance Report (Class)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_attd_class_grid&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
            }
        } else {
            $gridObj->setGridOptions("Attendance Report (Class)", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_attd_class_grid'), false);
        }

        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'attd_class_report';
        $data['page_title'] = 'Attendance Report (Class)';
        $this->load->view('main', $data);
    }

    function load_attd_class_grid() {
        $this->mod_report->get_attdendance_report_grid();
    }

    function print_attd_report() {
        $this->load->model(array('mod_letters', 'mod_attendance'));
        $data['rows'] = $this->mod_report->get_attd_per_report();
        $data['dir'] = 'report';
        $data['page'] = 'print_attd_report'; //Don't Change
        $data['page_title'] = 'Attendance Report (Class)';
        $this->load->view('print_main', $data);
    }

    function std_print_view($user_name='') {
        $this->load->model('mod_profile');
        if ($user_name == '') {
            redirect('student/manage_students');
        }
        $data = $this->mod_profile->get_student_details($user_name);
        if ($data['student_id'] == '') {
            common::redirect();
        }
        $data['dir'] = 'report';
        $data['page'] = 'std_print_view'; //Don't Change
        $data['page_title'] = 'Student Profile';
        $this->load->view('print_main', $data);
    }

    function attd_print_view($student_id='', $session_id='') {
        if ($student_id == '' || $session_id == '') {
            common::redirect();
        }
        $data = sql::row('view_std_reg', "student_id='$student_id' and session_id=$session_id");
        $data['rows'] = $this->mod_report->get_percentage_view($student_id, $session_id);
        $data['dir'] = 'report';
        $data['page'] = 'percentage_view'; //Don't Change
        $data['page_title'] = 'Cumulative Attendance Report';
        $this->load->view('print_main', $data);
    }

    function sess_acc_report() {
        $this->session->set_userdata('ser_from_date', $_POST['from_date']);
        $this->session->set_userdata('ser_to_date', $_POST['to_date']);
    }

    function library_report() {
        $this->load->model('mod_books');
        if ($_POST['gen_report']) {
            $this->form_validation->set_rules('user_type', 'User Type', '');
            $this->form_validation->set_rules('issue_date', 'Issue Date', '');
            $this->form_validation->set_rules('expiry_date', 'Expiry Date', '');
            if ($this->form_validation->run()) {
                $data['rows'] = $this->mod_report->get_issued_books();
                if (count($data['rows']) == 0) {
                    $data['msg'] = 'Sorry, No Content Found! Try another settings!';
                }
            }
        } else {
            $data['rows'] = $this->mod_report->get_issued_books();
            if (count($data['rows']) == 0) {
                $data['msg'] = 'Sorry, No Content Found! Try another settings!';
            }
        }
        $data['dir'] = 'report';
        $data['page'] = 'library_report'; //Don't Change
        $data['page_title'] = 'Library Report';
        $this->load->view('main', $data);
    }

    function staff_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array("Staff ID", "Staff Name", 'Department', 'Staff Status', 'Action');
        $gridColumnModel = array(
            array("name" => "user_name",
                "index" => "user_name",
                "width" => 65,
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
            array("name" => "department_name",
                "index" => "department_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "staff_status",
                "index" => "staff_status",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "action",
                "index" => "action",
                "width" => 70,
                "sortable" => false,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $gridObj->setGridOptions("Manage Staffs Report", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_staff_report&ps=' . $_POST['pass_from_date'] . '&pe=' . $_POST['pass_to_date'] . '&vs=' . $_POST['visa_from_date'] . '&ve=' . $_POST['visa_to_date']), false);
        } else {
            $gridObj->setGridOptions("Manage Staffs Report", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_staff_report'), false);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'staff_report'; //Don't Change
        $data['page_title'] = 'Staffs Report';
        $this->load->view('main', $data);
    }

    function load_staff_report() {
        $this->mod_report->get_staff_report_grid();
    }

    //Account Reports
    function payment_report_prev() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Status', 'Pay Date', 'Mood', 'Pay Details', 'Debit', 'Credit', 'Balance');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "sp.paid_date",
                "index" => "sp.paid_date",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "sp.pay_mood",
                "index" => "sp.pay_mood",
                "width" => 45,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "pd.details_name",
                "index" => "pd.details_name",
                "width" => 70,
                "sortable" => false,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "debit",
                "index" => "debit",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "credit",
                "index" => "credit",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "balance",
                "index" => "balance",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "right",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Account (Payment) Report", 880, 250, "sp.paid_date", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_payment_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false, true, true);
            }
        } else {

            $gridObj->setGridOptions("Student Account (Payment) Report", 880, 250, "sp.paid_date", "asc", $gridColumn, $gridColumnModel, site_url('report/load_payment_report'), false, true, true);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['dir'] = 'report';
        $data['page'] = 'payment_report'; //Don't Change
        $data['page_title'] = 'Student Account (Payment) Report';
        $this->load->view('main', $data);
    }

    function payment_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Session', 'Class', 'Action');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            
            array("name" => "ss.session_name",
                "index" => "ss.session_name",
                "width" => 100,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "c.class_name",
                "index" => "c.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "phref",
                "index" => "phref",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Account (Payment) Report", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_payment_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false, true, true);
            }
        } else {

            $gridObj->setGridOptions("Student Account (Payment) Report", 880, 250, "s.user_name", "asc", $gridColumn, $gridColumnModel, site_url('report/load_payment_report'), false, true, true);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['dir'] = 'report';
        $data['page'] = 'payment_report'; //Don't Change
        $data['page_title'] = 'Student Account (Payment) Report';
        $this->load->view('main', $data);
    }

    function load_payment_report() {
        /* prev model calling */
        //$this->mod_report->get_payment_report_grid();
        $this->mod_report->get_reg_student_grid();
    }

    function print_payment_report_prev() {
        $data['rows'] = $this->mod_report->get_payment_report();
        $data['dir'] = 'report';
        $data['acc_sign'] = TRUE;
        $data['page'] = 'print_payment_report'; //Don't Change
        $data['page_title'] = 'Student Account (Payment) Report';
        $this->load->view('print_main', $data);
    }

    function print_payment_report($student_id) {
        $data['student'] = sql::row("student", "student_id=$student_id");
        $data['admission_fee_row'] = $this->mod_report->get_admission_fee($student_id);
        $data['exam_fee_row'] = $this->mod_report->get_exam_fee($student_id);
        $data['monthly_fee_row'] = $this->mod_report->get_monthly_fee($student_id);
        $data['additional_fee_row'] = $this->mod_report->get_additional_fee($student_id);

        $data['dir'] = 'report';
        $data['acc_sign'] = TRUE;
        $data['page'] = 'print_student_payment_report';
        $data['page_title'] = 'Student Account (Payment) Report';
        $this->load->view('print_main', $data);
    }

    function due_report() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Status', 'Committed <br /> Date', 'Committed <br /> Amount', 'Paid <br /> Amount', 'Due');
        $gridColumnModel = array(
            array("name" => "s.user_name",
                "index" => "s.user_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_name",
                "index" => "s.student_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "s.class_name",
                "index" => "s.class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "s.student_status",
                "index" => "s.student_status",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "si.committed_date",
                "index" => "si.committed_date",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "si.amount",
                "index" => "si.amount",
                "width" => 70,
                "sortable" => true,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "paid_amount",
                "index" => "paid_amount",
                "width" => 45,
                "sortable" => false,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "due",
                "index" => "due",
                "width" => 45,
                "sortable" => TRUE,
                "align" => "right",
                "editable" => true
            )
        );
        if ($_POST['gen_report']) {
            $this->valid_std_report();
            if ($this->form_validation->run()) {
                $this->mod_report->sess_std_report();
                $gridObj->setGridOptions("Student Account (Due) Report", 880, 250, "si.committed_date", "asc", $gridColumn, $gridColumnModel, site_url('?c=report&m=load_due_report&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false, true, true);
            }
        } else {
            $gridObj->setGridOptions("Student Account (Due) Report", 880, 250, "si.committed_date", "asc", $gridColumn, $gridColumnModel, site_url('report/load_due_report'), false, true, true);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir'] = 'report';
        $data['page'] = 'due_report'; //Don't Change
        $data['page_title'] = 'Student Account (Due) Report';
        $this->load->view('main', $data);
    }

    function load_due_report() {
        //$this->load->model('mod_accounts');
        $this->mod_report->get_due_report_grid();
    }

    function print_due_report() {
        $this->load->model('mod_accounts');
        $data['rows'] = $this->mod_report->get_due_report();
        $data['dir'] = 'report';
        $data['acc_sign'] = TRUE;
        $data['page'] = 'print_due_report'; //Don't Change
        $data['page_title'] = 'Student Account (Due) Report';
        $this->load->view('print_main', $data);
    }

    function valid_account_report() {
        $this->form_validation->set_rules('class_id', 'class', '');
        $this->form_validation->set_rules('levels_id', 'Levels', '');
        $this->form_validation->set_rules('session_id', 'session', '');
        $this->form_validation->set_rules('from_date', 'From Date', '');
        $this->form_validation->set_rules('to_date', 'To date', '');
    }

    function daily_acc_report() {
        if ($_POST['gen_report']) {
            $this->form_validation->set_rules('from_date', 'Date', 'required');
            $this->form_validation->set_rules('to_date', 'Date', 'required');
            if ($this->form_validation->run()) {
                $this->sess_acc_report();
                //$data['rows'] = $this->mod_report->get_std_balance_report();
                $data['admission_fee'] = $this->mod_report->get_class_admission_fee();
                $data['monthly_fee'] = $this->mod_report->get_class_monthly_fee();
                $data['exam_fee'] = $this->mod_report->get_class_exam_fee();
                $data['additional_fee']=$this->mod_report->get_class_additional_fee();

                $data['staff_rows'] = $this->mod_report->get_staff_balance_report();
                $data['expense_rows'] = $this->mod_report->get_expense_balance_report();
                if (count($data['admission_fee']) == 0 && count($data['monthly_fee']) == 0 && count($data['exam_fee']) == 0 && count($data['staff_rows']) == 0) {
                    $data['msg'] = 'Sorry, No Content Found! Try another settings!';
                }
            }
        }
        $data['dir'] = 'report';
        $data['page'] = 'daily_acc_report'; //Don't Change
        $data['page_title'] = 'Daily Account Management';
        $this->load->view('main', $data);
    }

    function print_daily_report() {

        //$data['rows'] = $this->mod_report->get_std_balance_report();
        $data['admission_fee'] = $this->mod_report->get_class_admission_fee();
        $data['monthly_fee'] = $this->mod_report->get_class_monthly_fee();
        $data['exam_fee'] = $this->mod_report->get_class_exam_fee();
        $data['additional_fee']=$this->mod_report->get_class_additional_fee();

        $data['staff_rows'] = $this->mod_report->get_staff_balance_report();
        $data['expense_rows'] = $this->mod_report->get_expense_balance_report();
        $data['dir'] = 'report';
        $data['acc_sign'] = TRUE;
        $data['page'] = 'print_daily_report'; //Don't Change
        $data['page_title'] = 'Account Report';
        $this->load->view('print_main', $data);
    }

    

    function view_admission_fee($payment_type) {
        
        if($_POST['apply_filter']){
            $this->sess_payment_data();
        }

        $this->session->set_userdata('payment_type', $payment_type);
        $page_type="view";
        $data['admission_fee']= $this->mod_report->get_all_admission_fee($page_type);
        if (count($data['admission_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'admission_fee_report';
        $data['page_title'] = 'Admission Fee Report';
        $this->load->view('main', $data);
    }


    function print_admission_fee() {

        $page_type="print";
        $data['admission_fee']= $this->mod_report->get_all_admission_fee($page_type);
        if (count($data['admission_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'print_admission_fee_report';
        $data['page_title'] = 'Admission Fee Report';
        $this->load->view('print_main', $data);
    }



    function view_monthly_fee($payment_type) {

        if($_POST['apply_filter']){
            $this->sess_payment_data();
        }

        $this->session->set_userdata('payment_type', $payment_type);
        $page_type="view";
        $data['monthly_fee']= $this->mod_report->get_all_monthly_fee($page_type);
        if (count($data['monthly_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'monthly_fee_report';
        $data['page_title'] = "Monthly Fee Report";
        $this->load->view('main', $data);
    }


    function print_monthly_fee() {

        $page_type="print";
        $data['monthly_fee']= $this->mod_report->get_all_monthly_fee($page_type);
        if (count($data['monthly_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'print_monthly_fee_report';
        $data['page_title'] = 'Monthly Fee Report';
        $this->load->view('print_main', $data);
    }

    function view_exam_fee($payment_type) {

        if($_POST['apply_filter']){
            $this->sess_payment_data();
        }

        $this->session->set_userdata('payment_type', $payment_type);
        $page_type="view";
        $data['exam_fee']= $this->mod_report->get_all_exam_fee($page_type);
        if (count($data['exam_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'exam_fee_report';
        $data['page_title'] = "Exam Fee Report";
        $this->load->view('main', $data);
    }


    function print_exam_fee() {

        $page_type="print";
        $data['exam_fee']= $this->mod_report->get_all_exam_fee($page_type);
        if (count($data['exam_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'print_exam_fee_report';
        $data['page_title'] = 'Exam Fee Report';
        $this->load->view('print_main', $data);
    }


    function sess_payment_data() {

        $this->session->set_userdata('std_from_date',$_POST['from_date']);
        $this->session->set_userdata('std_to_date',$_POST['to_date']);
        $this->session->set_userdata('std_awarding_body',$_POST['awarding_body_id']);
        $this->session->set_userdata('std_session',$_POST['session_id']);
        $this->session->set_userdata('std_class',$_POST['class_id']);
        $this->session->set_userdata('std_month',$_POST['month']);
        $this->session->set_userdata('std_section',$_POST['section']);
        $this->session->set_userdata('std_exam',$_POST['exam_id']);
        $this->session->set_userdata('std_description',$_POST['description']);


    }


    /* Additional Fee Report */
    function view_additional_fee($payment_type) {

        if($_POST['apply_filter']){
            $this->sess_payment_data();
        }

        $this->session->set_userdata('payment_type', $payment_type);
        $page_type="view";
        $data['additional_fee']= $this->mod_report->get_all_additional_fee($page_type);
        if (count($data['additional_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'additional_fee_report';
        $data['page_title'] = 'Additional Fee Report';
        $this->load->view('main', $data);
    }


    function print_additional_fee() {

        $page_type="print";
        $data['additional_fee']= $this->mod_report->get_all_additional_fee($page_type);
        if (count($data['additional_fee']) == 0 ) {
            $data['msg'] = 'Sorry, No Content Found! Try another settings!';
        }
        $data['payment_type']=  $this->session->userdata('payment_type');
        $data['dir'] = 'report';
        $data['page'] = 'print_additional_fee_report';
        $data['page_title'] = 'Additional Fee Report';
        $this->load->view('print_main', $data);
    }

}
?>