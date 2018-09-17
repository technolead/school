<?php

/**
 * Description of student
 *
 * @author anwar
 */
class student extends Controller {

    function student() {
        parent::Controller();
        $this->load->model('mod_student');
        common::is_logged();
    }

    function index() {
        if (!common::is_student_user()) {
            redirect('home');
        }
        $this->load->model(array('mod_letters', 'mod_notice'));
        $this->load->helper('text');
        $student_id = $this->session->userdata('logged_student_id');
        if ($student_id == '') {
            redirect('login');
        }
        $data['letters'] = $this->mod_letters->get_student_letters($student_id);
        $data['notice'] = $this->mod_notice->get_issued_notice('Students');
        $data['staff_notice'] = $this->mod_notice->get_staff_issued_notice($student_id);
        /* -----------------End Pagination-------------- */
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'student';
        $data['page'] = 'index';
        $data['page_title'] = 'Student';
        $this->load->view('main', $data);
    }

    function manage_students() {
        if (!common::user_permit('view', 'student')) {
            common::redirect();
        }
        if ($_POST['send']) {
            if ($this->form_validation->run('valid_issue_letter')) {
                $this->mod_student->send_student_letters();
                $this->session->set_flashdata('msg', 'Letter Sent Successfully!!!');
                redirect($this->uri->uri_string());
            }
        }
//        if($_POST['apply_filter']) {
//            $this->valid_filter();
//            if($this->form_validation->run()) {
//                $this->settings_data();
//            }
//        }
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Mobile', 'Status', 'Result Published');
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
            array("name" => "class_name",
                "index" => "class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "mobile",
                "index" => "mobile",
                "width" => 60,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 35,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "is_result",
                "index" => "is_result",
                "width" => 50,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $this->valid_filter();
            if ($this->form_validation->run()) {
                $this->settings_data();
            }
            $gridObj->setGridOptions("Manage Students", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=student&m=load_student&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), true);
        } else {
            $gridObj->setGridOptions("Manage Students", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('student/load_student'), true);
        }
        //$gridObj->setGridOptions("Manage Staffs", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('student/load_student'), true);
        $data['grid_data'] = $gridObj->getGrid();

        $data['nav_array'] = array(
            array('title' => 'Manage Students', 'url' => '')
        );
        $this->session->set_userdata('redirect_url', $this->uri->uri_string());
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'student';
        $data['page'] = 'manage_students';
        $data['page_title'] = 'Manage Student';
        $this->load->view('main', $data);
    }

    function settings_data() {
        $this->session->set_userdata('sess_user_name', $_POST['user_name']);
        $this->session->set_userdata('sess_name', $_POST['name']);
        $this->session->set_userdata('date_of_birth', $_POST['date_of_birth']);
        $this->session->set_userdata('student_status', $_POST['student_status']);
        $this->session->set_userdata('class_id', $_POST['class_id']);
        $this->session->set_userdata('check_session_id', $_POST['check_session_id']);
    }

//    function unset_settings_data() {
//        $this->session->unset_userdata('sess_user_name');
//        $this->session->unset_userdata('date_of_birth');
//        $this->session->unset_userdata('student_status');
//        $this->session->unset_userdata('class_id');
//        $this->session->unset_userdata('semester_id');
//        $this->session->unset_userdata('pass_from_date');
//        $this->session->unset_userdata('pass_to_date');
//        $this->session->unset_userdata('visa_from_date');
//        $this->session->unset_userdata('visa_to_date');
//    }
    function send_letter() {
        $this->mod_student->send_student_letters();
        echo 'Letter Sent Successfully!!!';
    }

    function load_student() {
        $this->mod_student->get_studentGrid();
    }

    function valid_filter() {
        $this->form_validation->set_rules('user_name', 'Student ID', '');
        $this->form_validation->set_rules('name', 'Last Name', '');
        $this->form_validation->set_rules('date_of_birth', 'Last Name', '');
        $this->form_validation->set_rules('student_status', 'Student Status', '');
        $this->form_validation->set_rules('class_id', 'Class', '');
        $this->form_validation->set_rules('check_session_id', 'Session', '');
    }

    function new_student($part='basic') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('add', 'student')) {
            common::redirect();
        }
        if ($_POST['continue_basic']) {
            if ($this->form_validation->run('student_basic')) {
                $student_id = $this->mod_student->save_student();
                $this->session->set_userdata('con_student_id', $student_id);
                $this->mod_student->save_parent_info($student_id);
                $this->mod_student->save_qualifiaction($student_id);
                $this->mod_student->save_class_reg();
                $this->mod_student->save_module_reg();
                if ($_POST['optional_module_id'] != '') {
                    $this->mod_student->save_optional_module();
                }
                $this->session->set_flashdata('msg', 'Successfully Added!!!');
                redirect('student/manage_students');
                //redirect('student/new_student/reg_class');
            }
        }



        $data['nav_array'] = array(
            array('title' => 'Manage Student', 'url' => site_url('student/manage_students')),
            array('title' => 'Add New Student', 'url' => '')
        );
        $data['application_no'] = 'S' . date('mdY') . str_pad(sql::count('student'), 2, 0, STR_PAD_LEFT);
        $data['con_student_id'] = $this->session->userdata('con_student_id');
        $data['dir'] = 'student';
        $data['part'] = $part;
        $data['page'] = 'new_student'; //Don't Change
        $data['page_title'] = 'Add New Student';
        $this->load->view('main', $data);
    }

    function user_name_check() {
        $str = $_POST['user_name'];
        if ($_POST['update'] || $_POST['continue_update']) {
            return TRUE;
        }

        if (sql::count('user', "user_name='$str'") > 0 || strtolower($str) == 'admin') {
            $this->form_validation->set_message('user_name_check', 'This User ID already used in another account.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function edit_student($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('add', 'student')) {
            common::redirect();
        }
        if ($student_id == '') {
            redirect('student/manage_students');
        }
        $data = sql::row('student', "student_id='$student_id' and is_delete=0");
        $data['parent_info'] = sql::row("student_parent_info", "student_id=$student_id and is_delete=0");
        $data['reg_class'] = combo::get_reg_class_option($student_id);
        $data['optional_module_id'] = $om_id = combo::get_student_optional_module_id($student_id);

        if ($data['student_id'] == '') {
            redirect('student/manage_students');
        }
        if ($_POST['update']) {
            if ($this->form_validation->run('student_basic')) {

                $this->mod_student->update_student(); //Don't Change
                $student_id = $this->session->userdata('edit_student_id');
                sql::delete('std_qualifications', "student_id=$student_id");
                $this->mod_student->save_qualifiaction($student_id);
                sql::delete("student_parent_info", "student_id=$student_id");
                $this->mod_student->save_parent_info($student_id);
                $this->session->set_userdata('con_student_id', $student_id);
                $reg_class_info = sql::row("reg_class", "student_id=$student_id");

                if ($reg_class_info['class_id'] != $_POST['class_id']) {

                    $this->session->set_userdata('reg_class_id', $reg_class_info['reg_class_id']);
                    $this->mod_student->edit_class_reg();
                    sql::delete('reg_module', "student_id=$student_id and class_id=$reg_class_info[class_id]");
                    $this->mod_student->save_module_reg();
                    if ($_POST['optional_module_id'] != '') {
                        $this->mod_student->save_optional_module();
                    }
                } else {

                    if ($om_id != '') {
                        $this->mod_student->update_optional_module($om_id);
                    }
                    if ($reg_class_info['section'] != $_POST['section']) {
                        $data = array("section" => $_POST['section']);
                        $this->db->update("reg_class", $data, array("reg_class_id" => $reg_class_info['reg_class_id']));
                    }

                    if ($reg_class_info['privilege'] != $_POST['privilege']) {
                        $data = array("privilege" => $_POST['privilege']);
                        $this->db->update("reg_class", $data, array("reg_class_id" => $reg_class_info['reg_class_id']));
                    }
                }



                $this->session->set_flashdata('msg', 'Student Information Updated Successfully!!!');
                redirect('student/manage_students');
            }
        }

        $this->session->set_userdata('edit_student_id', $data['student_id']); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Student', 'url' => site_url('student/manage_students')),
            array('title' => 'Edit Student', 'url' => '')
        );
        $data['dir'] = 'student';
        $data['page'] = 'edit_student'; //Don't Change
        $data['page_title'] = 'Edit Student';
        $this->load->view('main', $data);
    }

    function student_class($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('view', 'student')) {
            common::redirect();
        }
        $this->load->model(array('mod_profile', 'mod_letters', 'mod_report', 'mod_result'));
        $this->load->model(array('mod_profile', 'mod_letters'));
        $this->load->helper('text');
        if ($student_id == '') {
            redirect('student/manage_students');
        }
        $data = $this->mod_profile->get_student_row($student_id);
        if ($data['student_id'] == '') {
            redirect('student/manage_students');
        }
        $this->session->set_userdata('edit_student_id', $data['student_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student', 'url' => site_url('student/manage_students')),
            array('title' => 'Edit Student class', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['parent_row'] = sql::row("student_parent_info", "student_id=$data[student_id]");
        $data['rows'] = $this->mod_student->get_registered_class($data['student_id']);
        $data['modules'] = $this->mod_student->get_registered_modules($data['student_id']);
        $data['letters'] = $this->mod_letters->get_student_letters($data['student_id']);
        $data['reports'] = $this->mod_report->get_student_progress_report($data['student_id']);
        $data['results'] = $this->mod_result->get_std_modules_result($data['student_id']);
        $this->session->set_userdata('redirect_url', $this->uri->uri_string());
        $data['dir'] = 'student';
        $data['page'] = 'student_class'; //Don't Change
        $data['page_title'] = 'Student Class';
        $this->load->view('main', $data);
    }

    function reg_new_class($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if ($student_id == '' || !is_numeric($student_id)) {
            common::redirect();
        }
        $this->session->set_userdata('con_student_id', $student_id);
        redirect('student/new_student/reg_class');
    }

    function reg_new_level($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if ($student_id == '' || !is_numeric($student_id)) {
            common::redirect();
        }
        $this->session->set_userdata('con_student_id', $student_id);
        redirect('student/new_student/reg_level');
    }

    function reg_new_session($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if ($student_id == '' || !is_numeric($student_id)) {
            common::redirect();
        }
        $this->session->set_userdata('con_student_id', $student_id);
        redirect('student/new_student/reg_session');
    }

    function edit_reg_class($reg_class_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('add', 'student')) {
            common::redirect();
        }
        if ($reg_class_id == '' || !is_numeric($reg_class_id)) {
            common::redirect();
        }
        $student_id = $this->session->userdata('edit_student_id');

        $data = $this->mod_student->get_reg_class_details($reg_class_id);
        $data['optional_module_id'] = $om_id = combo::get_student_optional_module_id($student_id);

        if ($_POST['update_class']) {
            if ($this->form_validation->run('reg_class')) {

                $reg_class_info = sql::row("reg_class", "reg_class_id=$reg_class_id");
                if ($reg_class_info['class_id'] != $_POST['class_id']) {
                    $this->session->set_userdata('con_student_id', $reg_class_info['student_id']);
                    sql::delete('reg_module', "student_id=$student_id and class_id=$reg_class_info[class_id]");
                    $this->mod_student->save_module_reg();
                    if ($_POST['optional_module_id'] != '') {
                        $this->mod_student->save_optional_module();
                    }
                } else {
                    if ($om_id != '') {
                        $this->mod_student->update_optional_module($om_id);
                    }
                }

                $this->mod_student->update_class_reg();
                $this->session->set_flashdata('msg', 'Updated Successfully!!!');
                $redirect_url = $this->session->userdata('redirect_url');
                if ($redirect_url != '') {
                    redirect($redirect_url);
                }
                else
                    redirect('student/manage_students');
            }
        }

        $this->session->set_userdata('reg_class_id', $data['reg_class_id']);

        $data['nav_array'] = array(
            array('title' => 'Manage Student', 'url' => site_url('student/manage_students')),
            array('title' => 'Edit Student Class', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'student';
        $data['page'] = 'edit_reg_class'; //Don't Change
        $data['page_title'] = 'Edit Student Class';
        $this->load->view('main', $data);
    }

    function promote_class() {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('add', 'student')) {
            common::redirect();
        }

        $student_id = $this->session->userdata('promote_student_id');
        if (count($student_id) == 0) {
            common::redirect();
        }

        if ($_POST['promote_class']) {
            if ($this->form_validation->run('reg_class')) {

                foreach ($student_id as $std_id): {
                        $reg_class_info = sql::row("reg_class", "student_id=$std_id");
                        sql::delete('reg_module', "student_id=$std_id and class_id=$reg_class_info[class_id]");
                    }endforeach;


                $this->mod_student->promote_module_reg($student_id);
                if ($_POST['optional_module_id'] != '') {
                    $this->mod_student->promote_optional_module($student_id);
                }
                $this->mod_student->promote_class_reg($student_id);
                $this->session->set_flashdata('msg', 'Updated Successfully!!!');
                $redirect_url = $this->session->userdata('redirect_url');
                if ($redirect_url != '') {
                    redirect($redirect_url);
                }
                else
                    redirect('student/manage_students');
            }
        }


        $data['nav_array'] = array(
            array('title' => 'Manage Student', 'url' => site_url('student/manage_students')),
            array('title' => 'Edit Student Class', 'url' => '')
        );
        $data['student_id'] = $student_id;
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'student';
        $data['page'] = 'promote_reg_class'; //Don't Change
        $data['page_title'] = 'Promote Student Class';
        $this->load->view('main', $data);
    }

    function session_student_id() {
        $student_id = $_POST['student_id'];
        $this->session->unset_userdata('promote_student_id');
        $this->session->set_userdata('promote_student_id', $student_id);
        echo true;
    }

    function print_student($student_id='', $class_id='') {
        if ($student_id == '' || $class_id == '') {
            common::redirect();
        }
        //$data=sql::row('std_reg_view',"student_id='$student_id' and semester_id=$semester_id");
        $data = $this->mod_student->get_reg_class_row($student_id, $class_id);
        $data['qualifications'] = sql::rows('std_qualifications', "student_id=$student_id");

        //$data['reg_mod']=$this->mod_student->get_registered_modules($student_id,$semester_id);
        $data['dir'] = 'student';
        $data['page'] = 'print_student'; //Don't Change
        $data['page_title'] = 'Application Form For Admission';
        $this->load->view('print_main', $data);
    }

    function print_reg_semester($student_id='', $semester_id='') {
        if ($student_id == '' || $semester_id == '') {
            common::redirect();
        }
        //$data=sql::row('std_reg_view',"student_id='$student_id' and semester_id=$semester_id");
        $data = $this->mod_student->get_reg_semester_row($student_id, $semester_id);
        $data['reg_mod'] = $this->mod_student->get_registered_modules($student_id, $semester_id);
        $data['dir'] = 'student';
        $data['page'] = 'print_reg_semester'; //Don't Change
        $data['page_title'] = 'Enrolment Form (Semester Registration)';
        $this->load->view('print_main', $data);
    }

    function delete_class($reg_class_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('delete', 'student')) {
            common::redirect();
        }
        if ($reg_class_id == '' || !is_numeric($reg_class_id)) {
            common::redirect();
        }
        sql::delete('reg_class', "reg_class_id=$reg_class_id");
        $this->session->set_flashdata('msg', 'Class deleted Successfully!!!');
        common::redirect();
    }

    function delete_student_level($reg_level_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('delete', 'student')) {
            common::redirect();
        }
        if ($reg_level_id == '' || !is_numeric($reg_level_id)) {
            common::redirect();
        }
        sql::delete('reg_level', "reg_level_id=$reg_level_id");
        $this->session->set_flashdata('msg', 'Level Deleted Successfully!');
        common::redirect();
    }

    function delete_student_session($reg_session_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('delete', 'student')) {
            common::redirect();
        }
        if ($reg_session_id == '' || !is_numeric($reg_session_id)) {
            common::redirect();
        }
        sql::delete('reg_session', "reg_session_id=$reg_session_id");
        $this->session->set_flashdata('msg', 'Session Deleted Successfully!');
        common::redirect();
    }

    function delete_student_module($reg_module_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('delete', 'student')) {
            common::redirect();
        }
        if ($reg_module_id == '' || !is_numeric($reg_module_id)) {
            common::redirect();
        }
        $student_id = $this->session->userdata('edit_student_id');
        sql::delete('reg_module', "reg_module_id=$reg_module_id and student_id=$student_id");
        $this->session->set_flashdata('msg', 'Module Deleted Successfully!!!');
        common::redirect();
    }

    //This are not used
    function class_status($class_reg_id='', $status='enabled') {
        if (!common::user_permit('add', 'student')) {
            common::redirect();
        }
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if ($class_reg_id == '' || !is_numeric($class_reg_id)) {
            common::redirect();
        }
        common::change_status('class_reg', 'class_reg_id=' . $class_reg_id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        common::redirect();
    }

    function delete_student($student_id='') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if (!common::user_permit('delete', 'student')) {
            common::redirect();
        }
        if ($student_id == '') {
            redirect('student/manage_students');
        }
        // Delete Student Registration Info
        sql::soft_delete('reg_class', "student_id=$student_id");
        sql::soft_delete('reg_module', "student_id=$student_id");


        // Delete Student Attendance Info
//        sql::delete('std_attendance',"student_id=$student_id");
//        sql::delete('std_con_absent',"student_id=$student_id");
//        sql::delete('absent_notice',"student_id=$student_id");
//        sql::delete('counselling',"student_id=$student_id");

        sql::soft_delete('student_parent_info', "student_id=$student_id");
        sql::soft_delete('std_qualifications', "student_id=$student_id");
        sql::soft_delete('student_letters', "student_id=$student_id");
//        sql::delete('std_communication',"student_id=$student_id");
//        sql::delete('progress_report',"student_id=$student_id");
        // Delete Student Account Info
//        sql::delete('std_program_fee',"student_id=$student_id");
//        sql::delete('std_level_fee',"student_id=$student_id");
//        sql::delete('std_fee_installment',"student_id=$student_id");
//        sql::delete('std_payments',"student_id=$student_id");
//        sql::delete('agent_payment',"student_id=$student_id");

        $this->mod_student->delete_student($student_id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        common::redirect();
    }

    function get_class_details() {
        echo $this->mod_student->get_class_details($_POST['class_id']);
    }

    function student_status($student_id='', $status='enabled') {
        if (!common::is_admin_user()) {
            common::redirect();
        }
        if ($student_id == '') {
            redirect('student/manage_students');
        }
        common::change_status('student', 'student_id=' . $student_id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('student/manage_students');
    }

    function get_student_list() {
        $data = $this->mod_student->get_student_list();
        echo $data;
    }

    function create_xls() {
        $rows = $this->mod_student->get_all_student();
        $colums_rows = array('Student ID', 'Student Name', 'Class', 'Student Status', 'Email', 'Mobile', 'Present Address', 'Status');
        $this->load->library('ExcelExport');
        $excel = new ExcelExport();
        $excel->addRow($colums_rows);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
                $excel->addRow(array(
                    $row['user_name'],
                    $row['first_name'] . ' ' . $row['last_name'],
                    $row['class_name'], $row['student_status'],
                    $row['email'],
                    $row['mobile'],
                    $row['present_address'],
                    $status
                ));
            }
        }
        $excel->download('students.xls');
    }

}
?>