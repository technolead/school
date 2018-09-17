<?php

/**
 * Description of accounts
 *
 * @author anwar
 */
class accounts extends Controller {

    function accounts() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_accounts');
    }

    function index() {
        if (!common::user_permit('view', 'std_account')) {
            common::redirect();
        }
        $data['nav_array'] = array(
            array('title' => 'Select Student', 'url' => '')
        );
        if ($_POST['continue']) {
            if ($this->form_validation->run('is_valid_student')) {
                redirect('accounts/student_accounts/' . $_POST['user_name']);
            }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage accounts';
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

    function student_accounts($user_name='') {
        if (!common::user_permit('view', 'std_account')) {
            common::redirect();
        }

        $data = sql::row('student', "user_name='$user_name' and is_delete=0", 'student_id,user_name');
        if ($data['student_id'] == '') {
            $this->session->set_flashdata('msg', 'Invalid Student ID');
            redirect('accounts');
        }
        $this->session->set_userdata('sel_student_id', $data['student_id']);
        $this->session->set_userdata('std_user_name', $data['user_name']);
        $data['nav_array'] = array(
            array('title' => 'Select Student', 'url' => site_url('accounts')),
            array('title' => 'Manage Student Account', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'student_accounts'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('main', $data);
    }

//    function class_fee_reg() {
//        if(!common::user_permit('view','class_fee')) {
//            common::redirect();
//        }
//        $data['rows']=$this->mod_accounts->get_std_class_fee();
//        $data['nav_array']=array(
//                array('title'=>'Manage Student Accounts','url'=>site_url('accounts/student_accounts/'.$this->session->userdata('std_user_name'))),
//                array('title'=>'Class Fee Registration','url'=>'')
//        );
//        $data['msg']=$this->session->flashdata('msg');
//        $data['dir']='accounts';
//        $data['page']='class_fee_reg'; //Don't Change
//        $data['page_title']='Student Accounts';
//        $this->load->view('account_main',$data);
//    }


    function class_fee_reg() {
        if (!common::user_permit('view', 'class_fee')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        $data = common::get_student_registered_class($student_id);

        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Class Fee Registration', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'class_fee'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    

    function receive_monthly_fee($class_map_id, $month, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_map_id == '' || $month == '') {
            common::redirect();
        }

        $class_fee_register_id = $this->mod_accounts->register_class_fee($class_map_id, $month, $student_id);
        $this->mod_accounts->save_mass_class_fee($class_fee_register_id, $class_map_id, $student_id);
        $this->session->set_flashdata('msg', 'Class Fee Received Successfully!');
        redirect('accounts/class_fee_reg');
    }

    function update_monthly_fee($class_fee_register_id,$class_fee_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_fee_id == '' || !is_numeric($class_fee_id)) {
            common::redirect();
        }

        $this->mod_accounts->update_monthly_fee($class_fee_register_id,$class_fee_id, $student_id);
        $this->session->set_flashdata('msg', 'Class Fee Received Successfully!');
        redirect('accounts/class_fee_reg');
    }

    function save_student_monthly_fee($class_fee_register_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_fee_register_id == '' || $student_id == '') {
            common::redirect();
        }
        $this->mod_accounts->save_student_class_fee($class_fee_register_id, $student_id);
        $this->session->set_flashdata('msg', 'Class Fee Received Successfully!');
        redirect('accounts/class_fee_reg');
    }

    function admission_fee_reg() {
        if (!common::user_permit('view', 'admission_fee')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        $data = common::get_student_registered_class($student_id);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Admission Fee Registration', 'url' => '')
        );

        $data['register'] = $register = sql::row("admission_fee_register", "class_map_id=$data[class_map_id]");
        if (count($register) > 0) {
            $admission_fee_register_id = $register['admission_fee_register_id'];
        } else {
            $admission_fee_register_id = 0;
        }


        $data['admission_fee_row'] = sql::row("std_admission_fee","student_id=$student_id and admission_fee_register_id=$admission_fee_register_id");
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'admission_fee';
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    /* function receive_admission_fee($class_map_id) {
      if (!common::user_permit('add', 'std_payment')) {
      common::redirect();
      }
      if ($class_map_id == '') {
      common::redirect();
      }
      if ($this->mod_accounts->receive_admission_fee($class_map_id)) {
      $this->session->set_flashdata('msg', 'Received Admission Fee Successfully!');
      redirect('accounts/admission_fee_reg');
      } else {
      $this->session->set_flashdata('msg', 'Could not receive admission fee!');
      common::redirect();
      }
      } */

    function receive_admission_fee($class_map_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_map_id == '' || $student_id == '') {
            common::redirect();
        }

        $admission_fee_register_id = $this->mod_accounts->register_admission_fee($class_map_id);
        $this->mod_accounts->save_mass_admission_fee($admission_fee_register_id, $class_map_id, $student_id);
        $this->session->set_flashdata('msg', 'Admission Fee Received Successfully!');
        redirect('accounts/admission_fee_reg');
    }

    function update_admission_fee($admission_fee_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($admission_fee_id == '' || !is_numeric($admission_fee_id)) {
            common::redirect();
        }

        $this->mod_accounts->update_admission_fee($admission_fee_id, $student_id);
        $this->session->set_flashdata('msg', 'Admission Fee Received Successfully!');
        redirect('accounts/admission_fee_reg');
    }

    function save_student_admission_fee($admission_fee_register_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($admission_fee_register_id == '' || $student_id == '') {
            common::redirect();
        }
        $this->mod_accounts->save_student_admission_fee($admission_fee_register_id, $student_id);
        $this->session->set_flashdata('msg', 'Admission Fee Received Successfully!');
        redirect('accounts/admission_fee_reg');
    }

    function delete_admission_fee($admission_fee_id='') {
        if (!common::user_permit('delete', 'admission_fee')) {
            common::redirect();
        }
        if ($admission_fee_id == '' || !is_numeric($admission_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        sql::delete('std_admission_fee', "student_id=$student_id and admission_fee_id=$admission_fee_id");
        $this->session->set_flashdata('msg', 'Admission Fee Deleted Successfully!');
        common::redirect();
    }

    function exam_fee_reg() {
        if (!common::user_permit('view', 'exam_fee')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        $data = $reg_class = common::get_student_registered_class($student_id);
        $data['exams'] = explode(",", $reg_class['exam_id']);


        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Exam Registration', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'exam_fee';
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    /* function receive_exam_fee($class_map_id, $exam_id) {
      if (!common::user_permit('add', 'std_payment')) {
      common::redirect();
      }
      if ($class_map_id == '' || $exam_id == '') {
      common::redirect();
      }
      if ($this->mod_accounts->receive_exam_fee($class_map_id, $exam_id)) {
      $this->session->set_flashdata('msg', 'Received Exam Fee Successfully!');
      redirect('accounts/exam_fee_reg');
      } else {
      $this->session->set_flashdata('msg', 'Could not receive exam fee!');
      common::redirect();
      }
      } */

    function receive_exam_fee($class_map_id, $exam_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_map_id == '' || $student_id == '' || $exam_id == '') {
            common::redirect();
        }

        $exam_fee_register_id = $this->mod_accounts->register_exam_fee($class_map_id, $exam_id);
        $this->mod_accounts->save_mass_exam_fee($exam_fee_register_id, $class_map_id, $student_id);
        $this->session->set_flashdata('msg', 'Exam Fee Received Successfully!');
        redirect('accounts/exam_fee_reg');
    }

    function save_student_exam_fee($exam_fee_register_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($exam_fee_register_id == '' || $student_id == '') {
            common::redirect();
        }
        $this->mod_accounts->save_student_exam_fee($exam_fee_register_id, $student_id);
        $this->session->set_flashdata('msg', 'Exam Fee Received Successfully!');
        redirect('accounts/exam_fee_reg');
    }

    function update_exam_fee($exam_fee_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($exam_fee_id == '' || !is_numeric($exam_fee_id)) {
            common::redirect();
        }

        $this->mod_accounts->update_exam_fee($exam_fee_id, $student_id);
        $this->session->set_flashdata('msg', 'Exam Fee Received Successfully!');
        redirect('accounts/exam_fee_reg');
    }

    function new_class_fee() {
        if (!common::user_permit('add', 'class_fee')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('class_fee_reg')) {
                if ($this->mod_accounts->save_class_fee()) {
                    $this->session->set_flashdata('msg', 'Class fee added Successfully!');
                    redirect('accounts/class_fee_reg');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Class Fee Registration', 'url' => site_url('accounts/class_fee_reg')),
            array('title' => 'Add Class Fee Registration', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'new_class_fee'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function edit_class_fee($class_fee_id='') {
        if (!common::user_permit('add', 'class_fee')) {
            common::redirect();
        }
        if ($class_fee_id == '' || !is_numeric($class_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        if ($_POST['update']) {
            $this->mod_accounts->update_class_fee();
            $this->session->set_flashdata('msg', 'class fee Updated Successfully!');
            redirect('accounts/class_fee_reg');
        }
        $data = sql::row('std_class_fee', "class_fee_id=$class_fee_id");
        $this->session->set_userdata('class_fee_id', $data['class_fee_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Class Fee Registration', 'url' => site_url('accounts/class_fee_reg')),
            array('title' => 'Edit class Fee Registration', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'edit_class_fee';
        $data['page_title'] = 'Edit class Registration Fee';
        $this->load->view('account_main', $data);
    }

    function delete_class_fee($class_fee_id='') {
        if (!common::user_permit('delete', 'class_fee')) {
            common::redirect();
        }
        if ($class_fee_id == '' || !is_numeric($class_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        sql::delete('std_class_fee', "student_id=$student_id and class_fee_id=$class_fee_id");
        $this->session->set_flashdata('msg', 'class Fee Deleted Successfully!');
        common::redirect();
    }

    function level_fee_reg() {
        if (!common::user_permit('view', 'level_fee')) {
            common::redirect();
        }
        $data['rows'] = $this->mod_accounts->get_std_level_fee();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Level Fee Registration', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'level_fee_reg'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function is_level_fee_exits() {
        if ($_POST['update']) {
            return TRUE;
        }
        $student_id = $this->session->userdata('sel_student_id');
        if (sql::count('std_level_fee', "student_id=$student_id and class_id={$_POST['class_id']} and levels_id={$_POST['levels_id']}") > 0) {
            $this->form_validation->set_message('is_level_fee_exits', "This Level Fee already Inserted if required please update!");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function new_level_fee() {
        if (!common::user_permit('add', 'level_fee')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('level_fee_reg')) {
                if ($this->mod_accounts->save_level_fee()) {
                    $this->session->set_flashdata('msg', 'Level fee Added Successfully!');
                    redirect('accounts/level_fee_reg');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Level Fee Registration', 'url' => site_url('accounts/level_fee_reg')),
            array('title' => 'Add Level Fee Registration', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'new_level_fee'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function edit_level_fee($level_fee_id='') {
        if (!common::user_permit('add', 'level_fee')) {
            common::redirect();
        }
        if ($level_fee_id == '' || !is_numeric($level_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        if ($_POST['update']) {
            if ($this->form_validation->run('level_fee_reg')) {
                if ($this->mod_accounts->update_level_fee()) {
                    $this->session->set_flashdata('msg', 'Level fee Updated Successfully!');
                    redirect('accounts/level_fee_reg');
                }
            }
        }
        $data = sql::row('std_level_fee', "level_fee_id=$level_fee_id");
        $this->session->set_userdata('level_fee_id', $data['level_fee_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Level Fee Registration', 'url' => site_url('accounts/level_fee_reg')),
            array('title' => 'Edit Level Fee Registration', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'edit_level_fee';
        $data['page_title'] = 'Edit Level Registration Fee';
        $this->load->view('account_main', $data);
    }

    function delete_level_fee($level_fee_id='') {
        if (!common::user_permit('delete', 'level_fee')) {
            common::redirect();
        }
        if ($level_fee_id == '' || !is_numeric($level_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        sql::delete('std_level_fee', "student_id=$student_id and level_fee_id=$level_fee_id");
        $this->session->set_flashdata('msg', 'Level Fee Deleted Successfully!');
        common::redirect();
    }

    function installment_payment() {
        if (!common::user_permit('view', 'std_payment')) {
            common::redirect();
        }
        $data['install_rows'] = $this->mod_accounts->get_installments();
        $data['payment_rows'] = $this->mod_accounts->get_payments();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Fee Installment/Payments', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'installment_payment'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function print_inspayment() {
        if (!common::user_permit('view', 'std_payment')) {
            common::redirect();
        }
        $data['install_rows'] = $this->mod_accounts->get_installments();
        $data['payment_rows'] = $this->mod_accounts->get_payments();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Fee Installment/Payments', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'print_inspayment'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('print_main', $data);
    }

    function manage_installment() {
        if (!common::user_permit('view', 'fee_installment')) {
            common::redirect();
        }
        $data['rows'] = $this->mod_accounts->get_installments();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Installment', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'manage_installment'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function set_installment($class_fee_id='') {
        if (!common::user_permit('add', 'fee_installment')) {
            common::redirect();
        }
        if ($class_fee_id == '') {
            common::redirect();
        }
        $data = $this->mod_accounts->get_class_fee_info($class_fee_id);
        $this->session->set_userdata('class_fee_id', $data['class_fee_id']);
        if ($data['student_id'] != $this->session->userdata('sel_student_id')) {
            $this->session->set_flashdata('msg', 'Critical Error!');
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('fee_installment')) {
                if ($this->mod_accounts->save_installment()) {
                    $this->session->set_flashdata('msg', 'Installment Set Successfully!');
                    redirect('accounts/installment_payment');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Installment', 'url' => site_url('accounts/installment_payment')),
            array('title' => 'Set Installment', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'set_installment';
        $data['page_title'] = 'Set Installments';
        $this->load->view('account_main', $data);
    }

    function is_valid_install_amount() {
        if ($_POST['total_balance'] >= $_POST['amount']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_valid_install_amount', 'Amount is Greater than Total Fee');
            return FALSE;
        }
    }

    function edit_installment($installment_id='') {
        if (!common::user_permit('add', 'fee_installment')) {
            common::redirect();
        }
        if ($installment_id == '') {
            common::redirect();
        }
        $data = $this->mod_accounts->get_installment_info($installment_id);
        $this->session->set_userdata('installment_id', $data['installment_id']);
        if ($data['student_id'] != $this->session->userdata('sel_student_id')) {
            $this->session->set_flashdata('msg', 'Critical Error!');
            common::redirect();
        }

        if ($_POST['update']) {
            if ($this->form_validation->run('fee_installment')) {
                if ($this->mod_accounts->update_installment()) {
                    $this->session->set_flashdata('msg', 'Installment Updated Successfully!');
                    redirect('accounts/installment_payment');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Installment', 'url' => site_url('accounts/installment_payment')),
            array('title' => 'Edit Installment', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['page'] = 'edit_installment';
        $data['page_title'] = 'Edit Installment';
        $this->load->view('account_main', $data);
    }

    function delete_fee_installment($installment_id='') {
        if (!common::user_permit('delete', 'fee_installment')) {
            common::redirect();
        }
        if ($installment_id == '' || !is_numeric($installment_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        sql::delete('std_fee_installment', "installment_id=$installment_id");
        $this->session->set_flashdata('msg', 'Installment Fee Deleted Successfully!');
        common::redirect();
    }

    function manage_payments() {
        if (!common::user_permit('view', 'std_payment')) {
            common::redirect();
        }
        $data['rows'] = $this->mod_accounts->get_payments();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Student Payments', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'manage_payments'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function receive_payment($installment_id='') {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($installment_id == '') {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('payments')) {
                if ($this->mod_accounts->save_payments()) {
                    $this->session->set_flashdata('msg', 'Received payment Successfully!');
                    redirect('accounts/installment_payment');
                }
            }
        }
        $data = $this->mod_accounts->get_installment_info($installment_id);
        $this->session->set_userdata('installment_id', $data['installment_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Payments', 'url' => site_url('accounts/manage_payments')),
            array('title' => 'Add New Payment', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['thickbox'] = TRUE;
        $data['page'] = 'receive_payment';
        $data['page_title'] = 'Receive Money for Installment';
        $this->load->view('account_main', $data);
    }

    function is_valid_payments() {
        if ($_POST['amount'] >= $_POST['paid_amount']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_valid_payments', 'Paid Amount is Greater than Installment Fee');
            return FALSE;
        }
    }

    function is_extended_fee() {
        if ($_POST['extended_fee'] == '' && $_POST['pro_extd_date'] != '') {
            $this->form_validation->set_message('is_extended_fee', 'Extended Fee is Required!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function is_level_extended_fee() {
        if ($_POST['extended_fee'] == '' && $_POST['level_extd_date'] != '') {
            $this->form_validation->set_message('is_level_extended_fee', 'Extended Fee is Required!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function edit_payment($payments_id='') {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($payments_id == '' || !is_numeric($payments_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        if ($_POST['update']) {
            if ($this->form_validation->run('payments')) {
                if ($this->mod_accounts->update_payments()) {
                    $this->session->set_flashdata('msg', 'Payments Updated Successfully!');
                    redirect('accounts/installment_payment');
                }
            }
        }
        $data = $this->mod_accounts->get_payments_info($payments_id);
        $this->session->set_userdata('payments_id', $data['payments_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Payments', 'url' => site_url('accounts/manage_payments')),
            array('title' => 'Edit Payment', 'url' => '')
        );
        $data['thickbox'] = TRUE;
        $data['dir'] = 'accounts';
        $data['page'] = 'edit_payment';
        $data['page_title'] = 'Edit Received Money';
        $this->load->view('account_main', $data);
    }

    function print_payment($payments_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($payments_id == '' || !is_numeric($payments_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        $data = $this->mod_accounts->get_payments_info($payments_id);
        $data['dir'] = 'accounts';
        $data['page'] = 'print_payment';
        $data['page_title'] = 'Received Money';
        $this->load->view('print_main', $data);
    }

    function delete_payments($payments_id='') {
        if (!common::user_permit('delete', 'std_payment')) {
            common::redirect();
        }
        if ($payments_id == '' || !is_numeric($payments_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        sql::delete('std_payments', "payments_id=$payments_id");
        $this->session->set_flashdata('msg', 'Payments Deleted Successfully!');
        common::redirect();
    }

    function get_class_reg_info() {

        /* modified by checking with student_id */
        $student_id = $this->session->userdata('sel_student_id');

        $sql = $this->db->query("select rc.class_start_date,rc.class_end_date,cm.class_fee,cm.monthly_fee from reg_class as rc
                                join class_map as cm on cm.class_id=rc.class_id
                                where rc.class_id='{$_POST['class_id']}' and rc.student_id={$student_id}");
        $data = $sql->row_array();
        echo $data['class_fee'] . '##' . $data['monthly_fee'] . "##" . $data['class_start_date'] . '##' . $data['class_end_date'];
    }

    function get_level_reg_info() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select lm.level_fee,rl.level_extd_date from level_map as lm
                                join reg_level as rl on rl.levels_id=lm.levels_id
                                where lm.levels_id='{$_POST['levels_id']}' and rl.student_id='$student_id'");
        $data = $sql->row_array();
        echo $data['level_fee'] . '##' . $data['level_extd_date'];
    }

    function advance_payment() {
        if (!common::user_permit('view', 'std_payment')) {
            common::redirect();
        }
        $data['rows'] = $this->mod_accounts->get_advance_payment();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Advance Payment', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'advance_payment'; //Don't Change
        $data['page_title'] = 'Student Accounts';
        $this->load->view('account_main', $data);
    }

    function add_advance() {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }

        if ($_POST['save']) {
            $this->valid_advance_payment();
            if ($this->form_validation->run()) {
                if ($this->mod_accounts->save_advance()) {
                    $this->session->set_flashdata('msg', 'Advance payment added Successfully!');
                    redirect('accounts/advance_payment');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Advance Payment', 'url' => site_url('accounts/advance_payment')),
            array('title' => 'Add Advance Payment', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['thickbox'] = TRUE;
        $data['page'] = 'add_advance';
        $data['page_title'] = 'Advance Payment';
        $this->load->view('account_main', $data);
    }

    function edit_advance($advance_id='') {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        if ($advance_id == '' || $student_id == '') {
            common::redirect();
        }
        if ($_POST['update']) {
            $this->valid_advance_payment();
            if ($this->form_validation->run()) {
                if ($this->mod_accounts->update_advance()) {
                    $this->session->set_flashdata('msg', 'Advance payment Updated Successfully!');
                    redirect('accounts/advance_payment');
                }
            }
        }
        $data = sql::row('std_advance_payment', "student_id=$student_id and advance_id=$advance_id");
        if ($data['advance_id'] == '') {
            common::redirect();
        }
        $this->session->set_userdata('sel_advance_id', $data['advance_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Manage Advance Payment', 'url' => site_url('accounts/advance_payment')),
            array('title' => 'Edit Advance Payment', 'url' => '')
        );
        $data['dir'] = 'accounts';
        $data['thickbox'] = TRUE;
        $data['page'] = 'edit_advance';
        $data['page_title'] = 'Edit Student Advance Payment';
        $this->load->view('account_main', $data);
    }

    function delete_advance($advance_id='') {
        if (!common::user_permit('delete', 'std_payment')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        if ($advance_id == '' || $student_id == '' || !is_numeric($advance_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        sql::delete('std_advance_payment', "advance_id=$advance_id and student_id=$student_id");
        $this->session->set_flashdata('msg', 'Advance Payment Deleted Successfully!');
        common::redirect();
    }

    function valid_advance_payment() {
        $this->form_validation->set_rules('class_id', 'Class', 'required');
        $this->form_validation->set_rules('agreed_fee', 'Agreed Fee', 'required|numeric');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('paid_date', 'Paid Date', 'required');
        $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required|numeric');
        $this->form_validation->set_rules('pay_mood', 'Pay Mood', 'required');
        $this->form_validation->set_rules('pay_details_id', 'Pay Details', 'required');
    }

    function std_account() {
        if (!common::is_student_user()) {
            common::redirect();
        }
        $data['admission_fee_row'] = $this->mod_accounts->get_admission_fee();
        $data['exam_fee_row'] = $this->mod_accounts->get_exam_fee();
        $data['monthly_fee_row'] = $this->mod_accounts->get_monthly_fee();
        $data['additional_fee_row'] = $this->mod_accounts->get_additional_fee();

//        $data['install_rows'] = $this->mod_accounts->get_installments();
//        $data['payment_rows'] = $this->mod_accounts->get_payments();
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name')))
                //array('title'=>'Fee Installment/Payments','url'=>'')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'std_account'; //Don't Change
        $this->load->view('main', $data);
    }

    function mng_accounts() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Student ID', 'Student Name', 'Class', 'Session', 'Status', 'Next Payment Date', 'Amount');
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
            array("name" => "si.committed_date",
                "index" => "si.committed_date",
                "width" => 70,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "si.amount",
                "index" => "si.amount",
                "width" => 45,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Student Account", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=accounts&m=load_std_account&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), false);
        } else {
            $gridObj->setGridOptions("Manage Student Account", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('accounts/load_std_account'), false);
        }

        $data['grid_data'] = $gridObj->getGrid();

        $data['nav_array'] = array(
            array('title' => 'Manage Student Account', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'mng_accounts';
        $data['page_title'] = 'Manage Student Account';
        $this->load->view('main', $data);
    }

    function load_std_account() {
        $this->mod_accounts->get_student_accounts_grid();
    }

    /* additional fee reg */

    function additional_fee_reg() {
        if (!common::user_permit('view', 'additional_fee')) {
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        $data = common::get_student_registered_class($student_id);
        $data['nav_array'] = array(
            array('title' => 'Manage Student Accounts', 'url' => site_url('accounts/student_accounts/' . $this->session->userdata('std_user_name'))),
            array('title' => 'Additional Fee Registration', 'url' => '')
        );

        $data['register'] = sql::rows("additional_fee_register", "class_map_id=$data[class_map_id]");

        if (count($data['register']) > 0) {
            $msg = "";
        } else {
            $msg = "No Content Found!!";
        }



        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'additional_fee';
        $data['page_title'] = 'Student Accounts';

        $this->load->view('account_main', $data);
    }

    function receive_additional_fee($class_map_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($class_map_id == '' || $student_id == '') {
            common::redirect();
        }

        $additional_fee_register_id = $this->mod_accounts->register_additional_fee($class_map_id);
        $this->mod_accounts->save_mass_additional_fee($additional_fee_register_id, $class_map_id, $student_id);
        $this->session->set_flashdata('msg', 'Additional Fee Received Successfully!');
        redirect('accounts/additional_fee_reg');
    }

    function update_additional_fee($additional_fee_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($additional_fee_id == '' || !is_numeric($additional_fee_id)) {
            common::redirect();
        }

        $this->mod_accounts->update_additional_fee($additional_fee_id, $student_id);
        $this->session->set_flashdata('msg', 'Additional Fee Received Successfully!');
        redirect('accounts/additional_fee_reg');
    }

    function save_student_additional_fee($additional_fee_register_id, $student_id) {
        if (!common::user_permit('add', 'std_payment')) {
            common::redirect();
        }
        if ($additional_fee_register_id == '' || $student_id == '') {
            common::redirect();
        }

        if ($_POST['save']) {
            if ($this->form_validation->run('valid_student_additional_fee')) {                
                $this->mod_accounts->save_student_additional_fee($additional_fee_register_id, $student_id);
                $this->session->set_flashdata('msg', 'Additional Fee Received Successfully!');
                redirect('accounts/additional_fee_reg');
            }
        }

        $data=sql::row("additional_fee_register","additional_fee_register_id=$additional_fee_register_id");
        $data['student_id']=$student_id;
        $data['action']="accounts/save_student_additional_fee/".$additional_fee_register_id."/".$student_id;
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'accounts';
        $data['page'] = 'receive_additional_fee';
        $data['page_title'] = 'Student Accounts';

        $this->load->view('account_main', $data);
    }

    function delete_additional_fee($additional_fee_id='') {
        if (!common::user_permit('delete', 'additional_fee')) {
            common::redirect();
        }
        if ($additional_fee_id == '' || !is_numeric($additional_fee_id)) {
            $this->session->set_flashdata('msg', 'Crital Error!');
            common::redirect();
        }
        $student_id = $this->session->userdata('sel_student_id');
        sql::delete('std_additional_fee', "student_id=$student_id and additional_fee_id=$additional_fee_id");
        $this->session->set_flashdata('msg', 'Additional Fee Deleted Successfully!');
        common::redirect();
    }

}
?>