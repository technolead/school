<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of result
 *
 * @author Anwar
 */
class result extends Controller {
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_result');
        $this->load->helper('combo');
    }
    function index($module_id='all',$session_id='all') {
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(5);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 5;
        $config['base_url'] = site_url('result/index/'.$module_id.'/'.$session_id);
        $config['total_rows'] = count($this->mod_result->get_module_result($module_id,$session_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_result->get_module_result($module_id,$session_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>'')
        );
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['msg']=$this->session->flashdata('msg');
        $data['module_id']=$module_id;
        $data['session_id']=$session_id;
        $data['dir']='result';
        $data['page']='index';
        $data['page_title']='Manage Student Result';
        $this->load->view('main',$data);
    }

    function get_grade(){
        $mark=$_POST['mark'];
        $module_mark=$_POST['module_mark'];
        $final_mark=($mark*100)/$module_mark;
        $grade=$this->mod_result->get_grade($final_mark);
        echo $grade['grade'];
    }

    function new_module_result() {
        if($_POST['continue']) {
            if($this->form_validation->run('module_result')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);

                $this->session->set_userdata('sel_class_map_id',$class_map_id);
                $this->session->set_userdata('sel_session_id',$_POST['session_id']);
                $this->session->set_userdata('sel_exam_id',$_POST['exam_id']);
                $this->session->set_userdata('sel_module_id',$_POST['module_id']);
                $this->session->set_userdata('sel_exam_date',$_POST['exam_date']);
                redirect('result/reg_module_result');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Add New Result','url'=>'')
        );
        $data['dir']='result';
        $data['page']='new_module_result'; //Don't Change
        $data['page_title']='Add New Result';
        $this->load->view('main',$data);
    }
    function reg_module_result() {
        $this->load->model('mod_attendance');
        $module_id=$this->session->userdata('sel_module_id');
        $session_id=$this->session->userdata('sel_session_id');
        if($module_id==''||$session_id=='') {
            redirect('result/new_module_result');
        }
        if($_POST['generate']) {
            if($this->form_validation->run('generate_result')) {
                $this->mod_result->save_module_result();
                $this->session->set_flashdata('msg','Result generated Successfully!');
                redirect('result');
            }
        }

        $data=sql::row('module',"module_id=$module_id");
        $data['rows']=$this->mod_attendance->get_registered_student($module_id,$session_id);     
        
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Add New Result','url'=>site_url('result/new_module_result')),
                array('title'=>'Generate Result','url'=>'')
        );
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['dir']='result';
        $data['page']='reg_module_result'; //Don't Change
        $data['page_title']='Add New Result';
        $this->load->view('main',$data);
    }
    function is_have_student() {
        if(sql::count('reg_module',"module_id='{$_POST['module_id']}' and session_id={$_POST['session_id']} and module_status=1")>0) { //Need to check Continue Status
            return TRUE;
        }else {
            if($_POST['view']) {
                $txt='Result';
            }else {
                $txt='Active Student';
            }
            $this->form_validation->set_message('is_have_student',"Selected Module has no $txt! at the selected session");
            return FALSE;
        }
    }

    function is_result_exist(){

        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        if(sql::count("module_result","class_map_id=$class_map_id and exam_id={$_POST['exam_id']} and module_id={$_POST['module_id']} and exam_date='$_POST[exam_date]'")>0){
           $this->form_validation->set_message('is_result_exist',"This result already exist! Please update if required");
           return FALSE;
        }else{
            //echo $this->db->last_query();exit();
            return TRUE;
        }
    }

    function edit_result($module_result_id='') {
        if($module_result_id==''||!is_numeric($module_result_id)) {
            redirect('result');
        }
        if($_POST['update']) {
            if($this->form_validation->run('edit_result')) {
                $this->mod_result->update_module_result();
                $this->session->set_flashdata('msg','Result Updated Successfully!!');
                $redirect_url=$this->session->userdata('redirect_url');
                redirect($redirect_url);
            }
        }
        $data=$this->mod_result->edit_module_result($module_result_id);
        $this->session->set_userdata('module_result_id',$data['module_result_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Edit Result','url'=>'')
        );
        $data['dir']='result';
        $data['page']='edit_module_result'; //Don't Change
        $data['page_title']='Edit Subject Result';
        $this->load->view('main',$data);
    }

    function delete_module_result($module_result_id='') {
        if($module_result_id==''||!is_numeric($module_result_id)) {
            redirect('result');
        }
        sql::delete('module_result',"module_result_id=$module_result_id");
        $this->session->set_flashdata('msg','Module Result deleted Successfully!');
        common::redirect();
    }

    function student_result($user_name='') {
        
        if($user_name=='') {
            redirect('result/students_grades');
        }
        $class_id=$this->session->userdata('sel_class_id');
        
        if($class_id!='') {
            $con=" and class_id=$class_id";
        }
        $data=sql::row('view_std_reg',"user_name='$user_name' $con");
        
        if($data['student_id']=='' || common::student_is_delete($data['student_id'])==true) {
            redirect('result/students_grades');
        }
        $data['rows']=$this->mod_result->get_std_modules_result($data['student_id'],$data['class_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Select Student','url'=>site_url('result/students_grades')),
                array('title'=>'Student\'s Grades','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='result';
        $data['page']='student_result';
        $data['page_title']='Student Student\'s Grades View';
        $this->load->view('main',$data);
    }
    function edit_std_result($result_id='') {
        if($result_id!='') {
            $data=$this->mod_result->edit_module_result($result_id);
            $this->session->set_userdata('module_result_id',$data['module_result_id']);
            $this->load->view('result/edit_std_result',$data);
        }
    }
    function update_result() {
        if($this->form_validation->run('edit_result')) {
            if($this->mod_result->update_module_result()) {
                $this->session->set_flashdata('msg','Result Updated Successfully!');
                echo 'success';
            }else {
                echo 'Failed! Please try again!';
            }
        }
    }
    function students_grades($page='basic') {
        if($_POST['continue']) {
            if($this->form_validation->run('student_grades')) {
                $this->session->set_userdata('sel_class_id',$_POST['class_id']);
                $std_data=sql::row('view_std_reg',"user_name='{$_POST['user_name']}'",'student_id,user_name');
                redirect('result/student_result/'.$std_data['user_name']);
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Select Student','url'=>'')
        );
        $data['dir']='result';
        $data['page']=$page;
        $data['page_title']='Student\'s Grades';
        $this->load->view('main',$data);
    }
    function is_valid_student() {
        if(sql::count('student',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_student','Sorry, Student ID is invalid!!!');
            return FALSE;
        }
    }
    function is_have_reg_class() {
        if(sql::count('view_std_reg',"user_name='{$_POST['user_name']}' and class_id={$_POST['class_id']}")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_have_reg_class','The Student is not registered in the selected class!!!');
            return FALSE;
        }
    }

    /* tutorial result */
    function new_tutorial_result() {
        if($_POST['continue']) {
            if($this->form_validation->run('tutorial_result')) {
                $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
                $this->session->set_userdata('tut_class_map_id',$class_map_id);
                $this->session->set_userdata('tut_session_id',$_POST['session_id']);
                $this->session->set_userdata('tut_exam_id',$_POST['exam_id']);
                $this->session->set_userdata('tut_module_id',$_POST['module_id']);
                $this->session->set_userdata('tut_tutorial_date',$_POST['tutorial_date']);
                $this->session->set_userdata('tut_description',$_POST['description']);
                $this->session->set_userdata('tut_total_marks',$_POST['total_marks']);
                redirect('result/reg_tutorial_result');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Add New Tutorial Result','url'=>'')
        );
        $data['dir']='result';
        $data['page']='new_tutorial_result';
        $data['page_title']='Add New Tutorial Result';
        $this->load->view('main',$data);
    }
    function reg_tutorial_result() {
        $this->load->model('mod_attendance');
        $module_id=$this->session->userdata('tut_module_id');
        $session_id=$this->session->userdata('tut_session_id');
        if($module_id==''||$session_id=='') {
            redirect('result/new_tutorial_result');
        }
        if($_POST['generate']) {
            if($this->form_validation->run('generate_tutorial_result')) {
                $this->mod_result->save_tutorial_result();
                $this->session->set_flashdata('msg','Result generated Successfully!');
                redirect('result/tutorial_result');
            }
        }

        $data=sql::row('module',"module_id=$module_id");
        $data['rows']=$this->mod_attendance->get_registered_student($module_id,$session_id);

        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Add New Tutorial Result','url'=>site_url('result/new_tutorial_result')),
                array('title'=>'Generate Tutorial Result','url'=>'')
        );
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['dir']='result';
        $data['page']='reg_tutorial_result';
        $data['page_title']='Add New Tutorial Result';
        $this->load->view('main',$data);
    }


    function is_cross_limit() {
        if(sql::count('tutorial_result',"1 group by exam_id,description")>=2) {
            $this->form_validation->set_message('is_cross_limit','This Exam has already two tutorial!');
            return FALSE;
        }else {
            return TRUE;
        }
    }


    function tutorial_result($module_id='all',$exam_id='all') {
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(5);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 5;
        $config['base_url'] = site_url('result/tutorial_result/'.$module_id.'/'.$exam_id);
        $config['total_rows'] = count($this->mod_result->get_tutorial_result($module_id,$exam_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_result->get_tutorial_result($module_id,$exam_id,"limit $start,{$config['per_page']}");
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>'')
        );
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['msg']=$this->session->flashdata('msg');
        $data['module_id']=$module_id;
        $data['exam_id']=$exam_id;
        $data['dir']='result';
        $data['page']='tutorial_result';
        $data['page_title']='Manage Student Tutorial Result';
        $this->load->view('main',$data);
    }



    function student_tutorial_result($user_name='') {

        if($user_name=='') {
            redirect('result/students_grades');
        }
        $class_map_id=$this->session->userdata('tut_class_map_id');

        if($class_map_id!='') {
            $con=" and class_map_id=$class_map_id";
        }
        $data=sql::row('view_std_reg',"user_name='$user_name' $con");

        if($data['student_id']=='' || common::student_is_delete($data['student_id'])==true) {
            redirect('result/tutorial_result');
        }
        $data['rows']=$this->mod_result->get_std_tutorial_result($data['student_id'],$data['class_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Student Tutorial Result','url'=>site_url('result/tutorial_result'))
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='result';
        $data['page']='student_tutorial_result';
        $data['page_title']='Student Tutorial Result';
        $this->load->view('main',$data);
    }


    function edit_std_tutorial_result($result_id='') {
        
        if($result_id!='') {
            $data=$this->mod_result->edit_tutorial_result($result_id);
            $this->session->set_userdata('tutorial_result_id',$data['tutorial_result_id']);
            $this->load->view('result/edit_std_tutorial_result',$data);
        }
    }

    function update_tutorial_result() {
        if($this->form_validation->run('edit_tutorial_result')) {
            if($this->mod_result->update_tutorial_result()) {
                $this->session->set_flashdata('msg','Result Updated Successfully!');
                echo 'success';
            }else {
                echo 'Failed! Please try again!';
            }
        }
    }

    function edit_tutorial_result($tutorial_result_id='') {
        if($tutorial_result_id==''||!is_numeric($tutorial_result_id)) {
            redirect('result/tutorial_result');
        }
        if($_POST['update']) {
            if($this->form_validation->run('edit_tutorial_result')) {
                $this->mod_result->update_tutorial_result();
                $this->session->set_flashdata('msg','Result Updated Successfully!!');
                $redirect_url=$this->session->userdata('redirect_url');
                redirect($redirect_url);
            }
        }
        $data=$this->mod_result->edit_tutorial_result($tutorial_result_id);
        $this->session->set_userdata('tutorial_result_id',$data['tutorial_result_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Student Result','url'=>site_url('result')),
                array('title'=>'Edit Tutorial Result','url'=>'')
        );
        $data['dir']='result';
        $data['page']='edit_tutorial_result';
        $data['page_title']='Edit Tutorial Result';
        $this->load->view('main',$data);
    }

    function delete_tutorial_result($tutorial_result_id='') {
        if($tutorial_result_id==''||!is_numeric($tutorial_result_id)) {
            redirect('result/tutorial_result');
        }
        sql::delete('tutorial_result',"tutorial_result_id=$tutorial_result_id");
        $this->session->set_flashdata('msg','Tutorial Result deleted Successfully!');
        common::redirect();
    }
}
?>
