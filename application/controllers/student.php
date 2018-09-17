<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of student
 *
 * @author Anwar
 */
class student extends Controller {
    private $dir='student';
    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model(array('mod_student','mod_letters'));
    }
    function index() {
        $this->load->helper('text');
        $student_id=$this->session->userdata('logged_student_id');
        if($student_id=='') {
            redirect('login');
        }
        $data['letters']=$this->mod_letters->get_student_letters($student_id);
        $data['notice']=$this->mod_student->get_issued_notice('Students');
        $data['staff_notice']=$this->mod_student->get_staff_issued_notice($student_id);
        $data['nav_array']=array(
                array('title'=>$this->session->userdata('student_name'),'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['page_title']='Student';
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    function profile() {
        $student_id=$this->session->userdata('logged_student_id');
        $data=$this->mod_student->get_student_info($student_id);
        
        if($data['student_id']=='') {
            redirect('home/invalid_page');
        }
        $data['nav_array']=array(
                array('title'=>$data['first_name'].' '.$data['last_name'],'url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['rows']=$this->mod_student->get_registered_class($data['student_id']);
        //$data['session']=$this->mod_student->get_registered_session($data['student_id']);
        $data['modules']=$this->mod_student->get_registered_modules($data['student_id']);

        $data['reports'] = $this->mod_student->get_student_progress_report($data['student_id']);
        $data['results'] = $this->mod_student->get_std_modules_result($data['student_id']);


        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['dir']=$this->dir;
        $data['page']='profile';
        $data['portal']=TRUE;
        $data['page_title']='Students &raquo; '.$data['first_name'].' '.$data['last_name'];
        $this->load->view('student_portal',$data);
    }
    function edit_profile() {
        $student_id=$this->session->userdata('logged_student_id');
        if($student_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_std_profile')) {
                if($this->mod_student->update_std_profile()) {
                    $this->session->set_flashdata('msg','Your Information Updated Successfully!!!');
                    redirect('student/profile');
                }
            }
        }
        $data=sql::row('student',"student_id='$student_id'",'student_id,user_name,title,gender,first_name,last_name,date_of_birth,present_address,permanent_address,email,phone,mobile,student_status');
        $data['nav_array']=array(
                array('title'=>$this->session->userdata('student_name'),'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['portal']=TRUE;
        $data['page']='edit_profile';
        $data['page_title']='Student';
        $this->load->view('student_portal',$data);
    }
    function change_password() {
        if($_POST['change_password']) {
            if($this->form_validation->run('valid_change_password')) {
                if($this->mod_student->do_update_password()) {
                    $this->session->set_flashdata('msg','Your Password changed Successfully!!!');
                    redirect('student/change_password');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Change Password','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['msg']=$this->session->flashdata('msg');
        $data['page']='change_password';
        $data['page_title']='Change Password';
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    function is_valid_user_password() {
        if(!$this->mod_student->confirm_password()) {
            $this->form_validation->set_message('is_valid_user_password','Invalid Old Password');
            return false;
        }else {
            return true;
        }
    }
    function accounts() {

        $data['admission_fee_row']=$this->mod_student->get_admission_fee();
        $data['exam_fee_row']=$this->mod_student->get_exam_fee();
        $data['monthly_fee_row']=$this->mod_student->get_monthly_fee();
        $data['additional_fee_row'] = $this->mod_student->get_additional_fee();

        //$data['install_rows']=$this->mod_student->get_installments();
        //$data['payment_rows']=$this->mod_student->get_payments();
        $data['nav_array']=array(
                array('title'=>$this->session->userdata('student_name').'\'s Account','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='accounts';
        $data['page_title']=$this->session->userdata('student_name');
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
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
        $data['rows'] = $this->mod_student->get_reg_module_result($data['class_map_id'], $session_id,$data['exam_id']);
        $data['attd_row'] = $this->mod_student->get_attendance_percentage($data['student_id'], $data['class_map_id']);

        $data['dir'] = 'student';
        $data['page'] = 'print_view'; 
        $data['page_title'] = 'Progress Report';
        $this->load->view('print_main', $data);
    }
}
?>
