<?php

/**
 * Description of classes
 *
 * @author anwar
 */
class classes extends Controller {

    function classes() {
        parent::Controller();
        common::is_logged();
        if (!common::user_permit('view', 'class') || !common::is_admin_user()) {
            common::redirect();
        }
        $this->load->model('mod_classes');
    }

    function index() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Class Name', 'Class Code', 'Inputed By', 'Status');
        $gridColumnModel = array(
            array("name" => "class_name",
                "index" => "class_name",
                "width" => 150,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "class_code",
                "index" => "class_code",
                "width" => 100,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "inputed_by",
                "index" => "inputed_by",
                "width" => 100,
                "sortable" => false,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 30,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )
        );
        $gridObj->setGridOptions("Manage Classes", 750, 250, "class_name", "asc", $gridColumn, $gridColumnModel, site_url('classes/load_class'), true);
        $data['grid_data'] = $gridObj->getGrid();


        $data['nav_array'] = array(
            array('title' => 'Manage Classes', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'class';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Classes';
        $this->load->view('main', $data);
    }

    function load_class() {
        $this->mod_classes->get_classGrid();
    }

    function new_class() {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_class')) {
                $this->mod_classes->save_class(); //Don't Change
                $this->session->set_flashdata('msg', 'Successfully Added!!!');
                redirect('classes');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage classes', 'url' => site_url('classes')),
            array('title' => 'Add New class', 'url' => '')
        );
        $data['action'] = site_url('classes/new_class');
        $data['dir'] = 'class';
        $data['page'] = 'class_form'; //Don't Change
        $data['page_title'] = 'Add New Class';
        $this->load->view('main', $data);
    }

    function edit_class($class_id='') {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_class')) {
                $this->mod_classes->update_class(); //Don't Change
                $this->session->set_flashdata('msg', 'Successfully Updated!!!');
                redirect('classes');
            }
        }
        if ($class_id == '') {
            redirect('classes');
        }
        $data = $this->mod_classes->get_class_details($class_id);
        $this->session->set_userdata('class_id', $data['class_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Classes', 'url' => site_url('classes')),
            array('title' => 'Edit Class', 'url' => '')
        );
        $data['action'] = site_url('classes/edit_class') . "/" . $class_id;
        $data['dir'] = 'class';
        $data['page'] = 'class_form';
        $data['page_title'] = 'Edit Class';
        $this->load->view('main', $data);
    }

    function delete_class($class_id='') {
        if (!common::user_permit('delete', 'class')) {
            common::redirect();
        }
        if ($class_id == '') {
            redirect('classes');
        }
        $this->mod_classes->delete_class($class_id);
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('classes');
    }

    function class_status($status='enabled', $class_id='') {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($class_id == '') {
            redirect('classes');
        }
        common::change_status('class', 'class_id=' . $class_id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('classes');
    }

    function mapping($session_id='all') {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Session', 'Class', 'Start Date', 'End Date', 'Admission Fee', 'Monthly Fee', 'Teacher', 'Status');
        $gridColumnModel = array(
            array("name" => "session_name",
                "index" => "session_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "class_name",
                "index" => "class_name",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "start_date",
                "index" => "start_date",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "end_date",
                "index" => "end_date",
                "width" => 70,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "class_fee",
                "index" => "class_fee",
                "width" => 60,
                "sortable" => true,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "monthly_fee",
                "index" => "monthly_fee",
                "width" => 60,
                "sortable" => true,
                "align" => "right",
                "editable" => true
            ),
            array("name" => "staff_name",
                "index" => "staff_name",
                "width" => 50,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 30,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )
        );
        $gridObj->setGridOptions("Manage Classes", 900, 250, "class_name", "asc", $gridColumn, $gridColumnModel, site_url('classes/load_classMap/' . $session_id), true);
        $data['grid_data'] = $gridObj->getGrid();

        $data['nav_array'] = array(
            array('title' => 'Manage Class Mapping', 'url' => '')
        );
        $data['session_id'] = $session_id;
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'class';
        $data['page'] = 'mapping';
        $data['page_title'] = 'Manage Class Mapping';
        $this->load->view('main', $data);
    }

    function load_classMap($session_id='all') {
        $this->mod_classes->get_classMapGrid($session_id);
    }

    function new_mapping() {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($_POST['save'] == 'Save') {
            if ($this->form_validation->run('class_map')) {
                if ($this->mod_classes->save_mapping()) {
                    $this->session->set_flashdata('msg', 'Added Successfully!!!');
                    redirect('classes/mapping');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Classes', 'url' => site_url('classes')),
            array('title' => 'Add New Class', 'url' => '')
        );
        $data['action'] = site_url('classes/new_mapping');
        $data['submit_value'] = 'Save';
        $data['dir'] = 'class';
        $data['page'] = 'mapping_form';
        $data['page_title'] = 'Class Mapping';
        $this->load->view('main', $data);
    }

    function is_mapping_exist() {
        if ($_POST['save'] == "Update") {
            return TRUE;
        }

        if (sql::count('class_map', "session_id={$_POST[session_id]} and class_id={$_POST[class_id]}") > 0) {
            $this->form_validation->set_message('is_mapping_exist', "This Mapping is inserted, If required please update!");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function edit_mapping($class_map_id='') {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($class_map_id == '') {
            redirect('classes/mapping');
        }
        if ($_POST['save'] == 'Update') {
            if ($this->form_validation->run('class_map')) {
                if ($this->mod_classes->update_mapping()) {
                    $this->session->set_flashdata('msg', 'Updated Successfully!!!');
                    redirect('classes/mapping');
                }
            }
        }
        $data = sql::row('class_map', 'class_map_id=' . $class_map_id);
        $this->session->set_userdata('class_map_id', $data['class_map_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Class Mapping', 'url' => site_url('classes/mapping')),
            array('title' => 'Edit Class Mapping', 'url' => '')
        );
        $data['action'] = site_url('classes/edit_mapping') . "/" . $class_map_id;
        $data['dir'] = 'class';
        $data['submit_value'] = 'Update';
        $data['page'] = 'mapping_form';
        $data['page_title'] = 'Edit Class Mapping';
        $this->load->view('main', $data);
    }

    function delete_class_map($class_map_id='') {
        if (!common::user_permit('delete', 'class')) {
            common::redirect();
        }
        if ($class_map_id == '') {
            redirect('classes/mapping');
        }
        sql::delete('class_map', 'class_map_id=' . $class_map_id);
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('classes/mapping');
    }

    function class_map_status($status='enabled', $class_map_id='') {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($class_map_id == '') {
            redirect('classes');
        }
        common::change_status('class_map', 'class_map_id=' . $class_map_id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('classes/mapping');
    }

    function details($class_id='') {
        if ($class_id == '') {
            redirect('classes');
        }
        $data = $this->mod_classes->get_class_details($class_id); //Don't Change
        $data['nav_array'] = array(
            array('title' => 'Manage Classes', 'url' => site_url('classes')),
            array('title' => $data['class_code'], 'url' => '')
        );
        $data['dir'] = 'class';
        $data['page'] = 'details'; //Don't Change
        $data['page_title'] = 'Class Details';
        $this->load->view('main', $data);
    }

    function class_module() {
        echo combo::get_class_module($_POST['class_id']);
    }

    function exam() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Exam Name', 'Exam Fee', 'Inputed By');
        $gridColumnModel = array(
            array("name" => "exam_name",
                "index" => "exam_name",
                "width" => 150,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "exam_fee",
                "index" => "exam_fee",
                "width" => 150,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "inputed_by",
                "index" => "inputed_by",
                "width" => 100,
                "sortable" => false,
                "align" => "center",
                "editable" => false
            )
        );
        $gridObj->setGridOptions("Manage Classes", 750, 250, "exam_name", "asc", $gridColumn, $gridColumnModel, site_url('classes/load_exam'), true);
        $data['grid_data'] = $gridObj->getGrid();


        $data['nav_array'] = array(
            array('title' => 'Manage Exams', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'class';
        $data['page'] = 'exam';
        $data['page_title'] = 'Manage Exam';
        $this->load->view('main', $data);
    }

    function load_exam() {
        $this->mod_classes->get_examGrid();
    }

    function new_exam() {
        if (!common::user_permit('add', 'exam')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_exam')) {
                $this->mod_classes->save_exam(); //Don't Change
                $this->session->set_flashdata('msg', 'Successfully Added!!!');
                redirect('classes/exam');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Exams', 'url' => site_url('classes/exam')),
            array('title' => 'Add New Exam', 'url' => '')
        );
        $data['action'] = site_url('classes/new_exam');
        $data['dir'] = 'class';
        $data['page'] = 'exam_form'; //Don't Change
        $data['page_title'] = 'Add New Class';
        $this->load->view('main', $data);
    }

    function edit_exam($exam_id='') {
        if (!common::user_permit('add', 'exam')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_exam')) {
                $this->mod_classes->update_exam();
                $this->session->set_flashdata('msg', 'Successfully Updated!!!');
                redirect('classes/exam');
            }
        }
        if ($exam_id == '') {
            redirect('classes/exam');
        }
        $data = sql::row("exam", "exam_id=$exam_id");
        $this->session->set_userdata('exam_id', $data['exam_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Exams', 'url' => site_url('classes/exam')),
            array('title' => 'Edit Exam', 'url' => '')
        );
        $data['action'] = site_url('classes/edit_exam') . "/" . $exam_id;
        $data['dir'] = 'class';
        $data['page'] = 'exam_form';
        $data['page_title'] = 'Edit Exam';
        $this->load->view('main', $data);
    }

    function delete_exam($exam_id='') {
        if (!common::user_permit('delete', 'exam')) {
            common::redirect();
        }
        if ($exam_id == '') {
            redirect('classes/exam');
        }
        sql::delete("exam", "exam_id=$exam_id");
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('classes/exam');
    }

    /* Class Routine */

    function routine() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Session Name', 'Class Name', 'Inputed By', 'Action');
        $gridColumnModel = array(
            array("name" => "session_name",
                "index" => "session_name",
                "width" => 100,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "class_name",
                "index" => "class_name",
                "width" => 150,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "inputed_by",
                "index" => "inputed_by",
                "width" => 100,
                "sortable" => false,
                "align" => "center",
                "editable" => false
            ),
            array("name" => "print_view",
                "index" => "print_view",
                "width" => 100,
                "sortable" => false,
                "align" => "center",
                "editable" => false
            )
        );
        $gridObj->setGridOptions("Manage Class Routine", 750, 250, "c.class_name", "asc", $gridColumn, $gridColumnModel, site_url('classes/load_routine'), true);
        $data['grid_data'] = $gridObj->getGrid();


        $data['nav_array'] = array(
            array('title' => 'Manage Class Routine', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'routine';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Class Routine';
        $this->load->view('main', $data);
    }

    function load_routine() {
        $this->mod_classes->get_routineGrid();
    }

    function new_routine() {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_routine')) {
                $class_routine_id = $this->mod_classes->save_class_routine();
                $this->session->set_userdata('class_routine_id', $class_routine_id);
                redirect('classes/record_routine');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Routine', 'url' => site_url('classes/routine')),
            array('title' => 'Add New Routine', 'url' => '')
        );
        $data['action'] = 'classes/new_routine';
        $data['dir'] = 'routine';
        $data['page'] = 'reg_routine';
        $data['page_title'] = 'Add New Routine';
        $this->load->view('main', $data);
    }

    function is_routine_exist() {
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        if (sql::count("class_routine", "class_map_id=$class_map_id and section='$_POST[section]'") > 0) {
            $this->form_validation->set_message('is_routine_exist', 'This routine already exist!! Please update if required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function record_routine() {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_routine_details')) {
                $this->mod_classes->save_routine_details();
                $this->session->set_userdata('msg', 'Routine Added Successfully!!');
                redirect('classes/routine');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Routine', 'url' => site_url('classes/routine')),
            array('title' => 'Record Routine', 'url' => '')
        );

        $class_routine_id = $this->session->userdata('class_routine_id');
        if ($class_routine_id == '' || !is_numeric($class_routine_id)) {
            redirect('classes/new_routine');
        }
        $data = $this->mod_classes->get_class_routine($class_routine_id);
        $data['action'] = 'classes/record_routine';
        $data['dir'] = 'routine';
        $data['page'] = 'record_routine';
        $data['page_title'] = 'Record Routine';
        $this->load->view('main', $data);
    }

    function edit_routine($class_routine_id='') {
        if (!common::user_permit('add', 'class')) {
            common::redirect();
        }

        if ($class_routine_id == '' || !is_numeric($class_routine_id)) {
            redirect('classes/routine');
        }

        if ($_POST['update']) {
            if ($this->form_validation->run('valid_routine_details')) {

                sql::delete("routine_details","class_routine_id=$class_routine_id");
                $this->mod_classes->save_routine_details();
                $this->session->set_flashdata('msg', 'Successfully Updated!!!');
                redirect('classes/routine');
            }
        }
        
        $data['routine'] = $this->mod_classes->get_routine_details($class_routine_id);
        $this->session->set_userdata('class_routine_id', $class_routine_id);
        $data['nav_array'] = array(
            array('title' => 'Manage Class Routine', 'url' => site_url('classes/routine')),
            array('title' => 'Edit Class Routine', 'url' => '')
        );
        $data['action'] = 'classes/edit_routine/'. $class_routine_id;
        $data['dir'] = 'routine';
        $data['page'] = 'edit_routine';
        $data['page_title'] = 'Edit Class Routine';
        $this->load->view('main', $data);
    }

    function delete_routine($class_routine_id='') {
        if (!common::user_permit('delete', 'class')) {
            common::redirect();
        }
        if ($class_id == '') {
            redirect('classes');
        }
        $this->mod_classes->delete_class($class_id);
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('classes');
    }

    function load_routine_div() {
        $data['day'] = $_POST['day'];
        $data['class_id'] = $_POST['class_id'];
        $this->load->view('routine/routine_form', $data);
    }

    function is_valid_routine() {

        if($_POST['update']){
            return true;
        }

        $pass = true;

        foreach ($_POST['day'] as $day) {
            for ($i = 1; $i <= 8; $i++) {
                $period = $_POST['period_' . $day . "_" . $i];
                $staffs_id = $_POST['staffs_id_' . $day . "_" . $i];

                if ($day != '' && $period != '' && $staffs_id != '') {
                    if (sql::count("routine_details", "day='$day' and period='$period' and staffs_id=$staffs_id") > 0) {
                        $pass = false;
                    } else {
                        $pass = true;
                    }
                }
            }
        }
        if ($pass == false) {
            $this->form_validation->set_message('is_valid_routine', 'Period is occupied by the same teacher!!');
            return false;
        } else {
            return true;
        }
    }

    function check_unique_period() {
        $day = $_POST['day'];
        $period = $_POST['period'];
        $staffs_id = $_POST['staffs_id'];
        if ($day != '' && $period != '' && $staffs_id != '') {
            if (sql::count("routine_details", "day='$day' and period='$period' and staffs_id=$staffs_id") > 0) {
                echo 'This Period is occupied by the same teacher';
            } else {
                echo '';
            }
        }
    }


    function print_routine($class_routine_id){
        if($class_routine_id=='' || !is_numeric($class_routine_id)){
            redirect('classes/routine');
        }

        $data['routine']=$this->mod_classes->get_routine_details($class_routine_id);
        $data['dir']="routine";
        $data['page']="print_routine";
        $data['page_title'] = 'Routine Details';
        $this->load->view('print_main', $data);
    }

}
?>