<?php

class fee extends Controller{

    function fee(){
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_fee');
    }

    /* class fee register */
    function register_class_fee() {
        if(!common::user_permit('add','class_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Class Fee','url'=>  site_url('#')),
                array('title'=>'Record Class Fee','url'=>'')
        );
        if($_POST['save']) {
            if($this->form_validation->run('valid_class_fee')) {                
                $class_fee_register_id=$this->mod_fee->register_class_fee();
                redirect('fee/record_class_fee/'.$class_fee_register_id);
                exit;
            }

        }
        $data['dir']='fee';
        $data['action']="fee/register_class_fee";
        $data['submit_name']='save';
        $data['submit_value']='Save';
        $data['page']='register_class_fee';
        $data['page_title']='Register Class Fee';
        $this->load->view('main',$data);
    }


    function record_class_fee($class_fee_register_id='') {
        if($class_fee_register_id==''||!is_numeric($class_fee_register_id)) {
            common::redirect();
        }
        if($_POST['save_class_fee']) {
            $class_fee_register_id=$this->session->userdata('class_fee_register_id');
            $this->mod_fee->save_mass_class_fee();
            $this->session->set_flashdata('msg', 'Class fee is registered successfully');
            redirect('fee/update_class_fee/'.$class_fee_register_id);
        }
        $data=sql::row("class_fee_register","class_fee_register_id=$class_fee_register_id");
        $data['class']=common::get_class_details($data['class_map_id']);
        // print_r($data);
        $this->session->set_userdata('class_fee_register_id',$data['class_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $this->session->set_userdata("student_action","record");
        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Class Fee','url'=>  site_url('#')),
                array('title'=>'Class Fee Registration','url'=>'')
        );
        $data['dir']='fee';

        $data['action']="fee/record_class_fee/".$class_fee_register_id;
        $data['page']='reg_class_fee'; //Don't Change
        $data['submit_name']='save_class_fee';
        $data['submit_value']='Save Class fee';
        $data['page_title']='Class Fee Registration';
        $this->load->view('main',$data);
    }


    function is_exist_class_fee() {

        
        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        
        if(sql::count('class_fee_register',"class_map_id='{$class_map_id}' and month='{$_POST['month']}' and section='{$_POST['section']}'")>0) {
            if($_POST['view']){
                return TRUE;
            }
            $this->form_validation->set_message('is_exist_class_fee',"This month's fee already exists, Please Update if required!");
            return FALSE;
        }else {

            if($_POST['view']) {
                $this->form_validation->set_message('is_exist_class_fee',"This month's fee does not exists, Please insert!");
                return FALSE;
            }else {
                return TRUE;

            }
        }
    }


    function is_have_student() {

        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(count(common::get_class_reg_student($class_map_id,$_POST['section']))>0) {
            return TRUE;
        }else {
            if($_POST['view']) {
                $txt='Class Fee';
            }else {
                $txt='Active Student';
            }
            $this->form_validation->set_message('is_have_student',"Selected Session/Class/Section/Branch has no $txt!");
            return FALSE;
        }
    }


    function view_class_fee() {
        if(!common::user_permit('view','class_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Class Fee','url'=>  site_url('#')),
                array('title'=>'Record Class Fee','url'=>'')
        );
        if($_POST['view']) {
            if($this->form_validation->run('valid_class_fee')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $class_fee_register_id=$this->mod_fee->get_class_fee_register_id($class_map_id);

                redirect('fee/update_class_fee/'.$class_fee_register_id);
                exit;
            }

        }

        $data['action']="fee/view_class_fee";
        $data['dir']='fee';
        $data['submit_name']='view';
        $data['submit_value']='View';
        $data['page']='register_class_fee';
        $data['page_title']='View Class Fee';
        $this->load->view('main',$data);
    }

    function update_class_fee($class_fee_register_id='') {
        if($class_fee_register_id==''||!is_numeric($class_fee_register_id)) {
            common::redirect();
        }
        if($_POST['update_class_fee']) {
            $class_fee_register_id=$this->session->userdata('class_fee_register_id');
            //sql::delete("std_class_fee","class_fee_register_id=$class_fee_register_id");
            $this->mod_fee->update_mass_class_fee();
            $this->session->set_flashdata('msg', 'Class fee updated successfully');
            redirect('fee/update_class_fee/'.$class_fee_register_id);
        }
        $data=sql::row("class_fee_register","class_fee_register_id=$class_fee_register_id");

        $this->session->set_userdata("student_action","view");
        $data['class']=common::get_class_details($data['class_map_id']);
        // print_r($data);
        $this->session->set_userdata('class_fee_register_id',$data['class_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Class Fee','url'=>  site_url('#')),
                array('title'=>'Class Fee Registration','url'=>'')
        );
        $data['msg']=  $this->session->flashdata('msg');
        $data['dir']='fee';
        $data['action']="fee/update_class_fee/".$class_fee_register_id;
        $data['page']='reg_class_fee'; 
        $data['submit_name']='update_class_fee';
        $data['submit_value']='Update Class Fee';
        $data['page_title']='Class Fee Registration';
        $this->load->view('main',$data);
    }

    function delete_reg_class_fee($class_fee_register_id){
        if($class_fee_register_id=='' || !is_numeric($class_fee_register_id)){
            common::redirect();
        }
        sql::delete("std_class_fee","class_fee_register_id=$class_fee_register_id");
        sql::delete("class_fee_register","class_fee_register_id=$class_fee_register_id");
        redirect('fee/view_class_fee');
    }


    /* admission fee register */
    
    function register_admission_fee() {
        if(!common::user_permit('add','admission_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Admission Fee','url'=>  site_url('#')),
                array('title'=>'Record Admission Fee','url'=>'')
        );
        if($_POST['save']) {
            if($this->form_validation->run('valid_admission_fee')) {
                $admission_fee_register_id=$this->mod_fee->register_admission_fee();
                redirect('fee/record_admission_fee/'.$admission_fee_register_id);
                exit;
            }

        }
        $data['dir']='fee';
        $data['action']="fee/register_admission_fee";
        $data['submit_name']='save';
        $data['submit_value']='Save';
        $data['page']='register_admission_fee';
        $data['page_title']='Register Admission Fee';
        $this->load->view('main',$data);
    }


    function record_admission_fee($admission_fee_register_id='') {
        if($admission_fee_register_id==''||!is_numeric($admission_fee_register_id)) {
            common::redirect();
        }
        if($_POST['save_admission_fee']) {
            $admission_fee_register_id=$this->session->userdata('admission_fee_register_id');
            $this->mod_fee->save_mass_admission_fee();
            $this->session->set_flashdata('msg', 'Admission fee is registered successfully');
            redirect('fee/update_admission_fee/'.$admission_fee_register_id);
        }
        $data=sql::row("admission_fee_register","admission_fee_register_id=$admission_fee_register_id");

        $this->session->set_userdata("student_action","record");
        $data['class']=common::get_class_details($data['class_map_id']);
        // print_r($data);
        $this->session->set_userdata('admission_fee_register_id',$data['admission_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Admission Fee','url'=>  site_url('#')),
                array('title'=>'Admission Fee Registration','url'=>'')
        );
        $data['dir']='fee';

        $data['action']="fee/record_admission_fee/".$admission_fee_register_id;
        $data['page']='reg_admission_fee'; //Don't Change
        $data['submit_name']='save_admission_fee';
        $data['submit_value']='Save Admission fee';
        $data['page_title']='Admission Fee Registration';
        $this->load->view('main',$data);
    }

    function is_exist_admission_fee() {


        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(sql::count('admission_fee_register',"class_map_id='{$class_map_id}'")>0) {
            if($_POST['view']){
                return TRUE;
            }
            $this->form_validation->set_message('is_exist_admission_fee',"This admission fee already exists, Please Update if required!");
            return FALSE;
        }else {

            if($_POST['view']) {
                $this->form_validation->set_message('is_exist_admission_fee',"This admission fee does not exists, Please insert!");
                return FALSE;
            }else {
                return TRUE;

            }
        }
    }

    function view_admission_fee() {
        if(!common::user_permit('view','admission_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Admission Fee','url'=>  site_url('#')),
                array('title'=>'Record Admission Fee','url'=>'')
        );
        if($_POST['view']) {
            if($this->form_validation->run('valid_admission_fee')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $admission_fee_register_id=$this->mod_fee->get_admission_fee_register_id($class_map_id);

                redirect('fee/update_admission_fee/'.$admission_fee_register_id);
                exit;
            }

        }

        $data['action']="fee/view_admission_fee";
        $data['dir']='fee';
        $data['submit_name']='view';
        $data['submit_value']='View';
        $data['page']='register_admission_fee';
        $data['page_title']='View Admission Fee';
        $this->load->view('main',$data);
    }

    function update_admission_fee($admission_fee_register_id='') {
        if($admission_fee_register_id==''||!is_numeric($admission_fee_register_id)) {
            common::redirect();
        }
        if($_POST['update_admission_fee']) {
            $admission_fee_register_id=$this->session->userdata('admission_fee_register_id');            
            $this->mod_fee->update_mass_admission_fee();
            $this->session->set_flashdata('msg', 'Admission fee updated successfully');
            redirect('fee/update_admission_fee/'.$admission_fee_register_id);
        }
        $data=sql::row("admission_fee_register","admission_fee_register_id=$admission_fee_register_id");

        $this->session->set_userdata("student_action","view");
        $data['class']=common::get_class_details($data['class_map_id']);
        $this->session->set_userdata('admission_fee_register_id',$data['admission_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Admission Fee','url'=>  site_url('#')),
                array('title'=>'Admission Fee Registration','url'=>'')
        );
        $data['msg']=  $this->session->flashdata('msg');
        $data['dir']='fee';
        $data['action']="fee/update_admission_fee/".$admission_fee_register_id;
        $data['page']='reg_admission_fee';
        $data['submit_name']='update_admission_fee';
        $data['submit_value']='Update Admission Fee';
        $data['page_title']='Admission Fee Registration';
        $this->load->view('main',$data);
    }

    function delete_reg_admission_fee($admission_fee_register_id){
        if($admission_fee_register_id=='' || !is_numeric($admission_fee_register_id)){
            common::redirect();
        }
        sql::delete("std_admission_fee","admission_fee_register_id=$admission_fee_register_id");
        sql::delete("admission_fee_register","admission_fee_register_id=$admission_fee_register_id");
        redirect('fee/view_admission_fee');
    }



    /* register exam fee */



    function register_exam_fee() {
        if(!common::user_permit('add','exam_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Exam Fee','url'=>  site_url('#')),
                array('title'=>'Record Exam Fee','url'=>'')
        );
        if($_POST['save']) {
            if($this->form_validation->run('valid_exam_fee')) {
                $exam_fee_register_id=$this->mod_fee->register_exam_fee();
                redirect('fee/record_exam_fee/'.$exam_fee_register_id);
                exit;
            }

        }
        $data['dir']='fee';
        $data['action']="fee/register_exam_fee";
        $data['submit_name']='save';
        $data['submit_value']='Save';
        $data['page']='register_exam_fee';
        $data['page_title']='Register Exam Fee';
        $this->load->view('main',$data);
    }


    function record_exam_fee($exam_fee_register_id='') {
        if($exam_fee_register_id==''||!is_numeric($exam_fee_register_id)) {
            common::redirect();
        }
        if($_POST['save_exam_fee']) {
            $exam_fee_register_id=$this->session->userdata('exam_fee_register_id');
            $this->mod_fee->save_mass_exam_fee();
            $this->session->set_flashdata('msg', 'Exam fee is registered successfully');
            redirect('fee/update_exam_fee/'.$exam_fee_register_id);
        }
        $data=sql::row("exam_fee_register","exam_fee_register_id=$exam_fee_register_id");
        $data['exam']=sql::row("exam","exam_id=$data[exam_id]");

        $this->session->set_userdata("student_action","record");
        $data['class']=common::get_class_details($data['class_map_id']);
        // print_r($data);
        $this->session->set_userdata('exam_fee_register_id',$data['exam_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);
        $this->session->set_userdata('exam',$data['exam_id']);
        $this->session->set_userdata("student_action","record");

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Exam Fee','url'=>  site_url('#')),
                array('title'=>'Exam Fee Registration','url'=>'')
        );
        $data['dir']='fee';

        $data['action']="fee/record_exam_fee/".$exam_fee_register_id;
        $data['page']='reg_exam_fee';
        $data['submit_name']='save_exam_fee';
        $data['submit_value']='Save Exam fee';
        $data['page_title']='Exam Fee Registration';
        $this->load->view('main',$data);
    }

    function is_exist_exam_fee() {


        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(sql::count('exam_fee_register',"class_map_id='{$class_map_id}' and exam_id='{$_POST[exam_id]}'")>0) {
            if($_POST['view']){
                return TRUE;
            }
            $this->form_validation->set_message('is_exist_exam_fee',"This exam fee already exists, Please Update if required!");
            return FALSE;
        }else {

            if($_POST['view']) {
                $this->form_validation->set_message('is_exist_exam_fee',"This exam fee does not exists, Please insert!");
                return FALSE;
            }else {
                return TRUE;

            }
        }
    }

    function view_exam_fee() {
        if(!common::user_permit('view','exam_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Exam Fee','url'=>  site_url('#')),
                array('title'=>'Record Exam Fee','url'=>'')
        );
        if($_POST['view']) {
            if($this->form_validation->run('valid_exam_fee')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $exam_fee_register_id=$this->mod_fee->get_exam_fee_register_id($class_map_id,$_POST['exam_id']);

                redirect('fee/update_exam_fee/'.$exam_fee_register_id);
                exit;
            }

        }

        $data['action']="fee/view_exam_fee";
        $data['dir']='fee';
        $data['submit_name']='view';
        $data['submit_value']='View';
        $data['page']='register_exam_fee';
        $data['page_title']='View Exam Fee';
        $this->load->view('main',$data);
    }

    function update_exam_fee($exam_fee_register_id='') {
        if($exam_fee_register_id==''||!is_numeric($exam_fee_register_id)) {
            common::redirect();
        }
        if($_POST['update_exam_fee']) {
            $exam_fee_register_id=$this->session->userdata('exam_fee_register_id');
            
            $this->mod_fee->update_mass_exam_fee();
            $this->session->set_flashdata('msg', 'Exam fee updated successfully');
            redirect('fee/update_exam_fee/'.$exam_fee_register_id);
        }
        $data=sql::row("exam_fee_register","exam_fee_register_id=$exam_fee_register_id");
        $data['exam']=sql::row("exam","exam_fee=$data[exam_fee]");

        $this->session->set_userdata("student_action","view");
        $data['class']=common::get_class_details($data['class_map_id']);
        $this->session->set_userdata('exam_fee_register_id',$data['exam_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);
        $this->session->set_userdata("student_action","view");

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Exam Fee','url'=>  site_url('#')),
                array('title'=>'Exam Fee Registration','url'=>'')
        );
        $data['msg']=  $this->session->flashdata('msg');
        $data['dir']='fee';
        $data['action']="fee/update_exam_fee/".$exam_fee_register_id;
        $data['page']='reg_exam_fee';
        $data['submit_name']='update_exam_fee';
        $data['submit_value']='Update Exam Fee';
        $data['page_title']='Exam Fee Registration';
        $this->load->view('main',$data);
    }

    function delete_reg_exam_fee($exam_fee_register_id){
        if($exam_fee_register_id=='' || !is_numeric($exam_fee_register_id)){
            common::redirect();
        }
        sql::delete("std_exam_fee","exam_fee_register_id=$exam_fee_register_id");
        sql::delete("exam_fee_register","exam_fee_register_id=$exam_fee_register_id");
        redirect('fee/view_exam_fee');
    }





    /* additional fee register */

    function register_additional_fee() {
        if(!common::user_permit('add','additional_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Additional Fee','url'=>  site_url('#')),
                array('title'=>'Record Additional Fee','url'=>'')
        );
        if($_POST['save']) {
            if($this->form_validation->run('valid_additional_fee')) {
                $additional_fee_register_id=$this->mod_fee->register_additional_fee();
                redirect('fee/record_additional_fee/'.$additional_fee_register_id);
                exit;
            }

        }
        $data['dir']='fee';
        $data['action']="fee/register_additional_fee";
        $data['submit_name']='save';
        $data['submit_value']='Save';
        $data['page']='register_additional_fee';
        $data['page_title']='Register Additional Fee';
        $this->load->view('main',$data);
    }


    function record_additional_fee($additional_fee_register_id='') {
        if($additional_fee_register_id==''||!is_numeric($additional_fee_register_id)) {
            common::redirect();
        }
        if($_POST['save_additional_fee']) {
            $additional_fee_register_id=$this->session->userdata('additional_fee_register_id');
            $this->mod_fee->save_mass_additional_fee();
            $this->session->set_flashdata('msg', 'Additional fee is registered successfully');
            redirect('fee/update_additional_fee/'.$additional_fee_register_id);
        }
        $data=sql::row("additional_fee_register","additional_fee_register_id=$additional_fee_register_id");

        $this->session->set_userdata("student_action","record");
        $data['class']=common::get_class_details($data['class_map_id']);
        // print_r($data);
        $this->session->set_userdata('additional_fee_register_id',$data['additional_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Additional Fee','url'=>  site_url('#')),
                array('title'=>'Additional Fee Registration','url'=>'')
        );
        $data['dir']='fee';

        $data['action']="fee/record_additional_fee/".$additional_fee_register_id;
        $data['page']='reg_additional_fee'; //Don't Change
        $data['submit_name']='save_additional_fee';
        $data['submit_value']='Save Additional fee';
        $data['page_title']='Additional Fee Registration';
        $this->load->view('main',$data);
    }

    function is_exist_additional_fee() {


        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(sql::count('additional_fee_register',"class_map_id='{$class_map_id}' and section='{$_POST[section]}' and description like '%{$_POST[description]}%'")>0) {
            
            if($_POST['view']){
                return TRUE;
            }
            $this->form_validation->set_message('is_exist_additional_fee',"This additional fee already exists, Please Update if required!");
            return FALSE;
        }else {

            if($_POST['view']) {
                $this->form_validation->set_message('is_exist_additional_fee',"This additional fee does not exists, Please insert!");
                return FALSE;
            }else {
                return TRUE;

            }
        }
    }

    function view_additional_fee() {
        if(!common::user_permit('view','additional_fee')) {
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Additional Fee','url'=>  site_url('#')),
                array('title'=>'Record Additional Fee','url'=>'')
        );
        if($_POST['view']) {
            if($this->form_validation->run('valid_additional_fee')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $additional_fee_register_id=$this->mod_fee->get_additional_fee_register_id($class_map_id);

                redirect('fee/update_additional_fee/'.$additional_fee_register_id);
                exit;
            }

        }

        $data['action']="fee/view_additional_fee";
        $data['dir']='fee';
        $data['submit_name']='view';
        $data['submit_value']='View';
        $data['page']='register_additional_fee';
        $data['page_title']='View Additional Fee';
        $this->load->view('main',$data);
    }

    function update_additional_fee($additional_fee_register_id='') {
        if($additional_fee_register_id==''||!is_numeric($additional_fee_register_id)) {
            common::redirect();
        }
        if($_POST['update_additional_fee']) {
            $additional_fee_register_id=$this->session->userdata('additional_fee_register_id');
            $this->mod_fee->update_mass_additional_fee();
            $this->session->set_flashdata('msg', 'Additional fee updated successfully');
            redirect('fee/update_additional_fee/'.$additional_fee_register_id);
        }
        $data=sql::row("additional_fee_register","additional_fee_register_id=$additional_fee_register_id");

        $this->session->set_userdata("student_action","view");
        $data['class']=common::get_class_details($data['class_map_id']);
        $this->session->set_userdata('additional_fee_register_id',$data['additional_fee_register_id']);
        $this->session->set_userdata('register_date',$data['register_date']);

        $data['rows']=common::get_class_reg_student($data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Additional Fee','url'=>  site_url('#')),
                array('title'=>'Additional Fee Registration','url'=>'')
        );
        $data['msg']=  $this->session->flashdata('msg');
        $data['dir']='fee';
        $data['action']="fee/update_additional_fee/".$additional_fee_register_id;
        $data['page']='reg_additional_fee';
        $data['submit_name']='update_additional_fee';
        $data['submit_value']='Update Additional Fee';
        $data['page_title']='Additional Fee Registration';
        $this->load->view('main',$data);
    }

    function delete_reg_additional_fee($additional_fee_register_id){
        if($additional_fee_register_id=='' || !is_numeric($additional_fee_register_id)){
            common::redirect();
        }
        sql::delete("std_additional_fee","additional_fee_register_id=$additional_fee_register_id");
        sql::delete("additional_fee_register","additional_fee_register_id=$additional_fee_register_id");
        redirect('fee/view_additional_fee');
    }



}
?>
