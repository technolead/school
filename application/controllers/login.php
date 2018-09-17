<?php
/**
 * Description of login
 *
 * @author anwar
 */
class login extends Controller {
    function login() {
        parent::Controller();
        $this->load->model('mod_login');
    }

    function index() {
        if($_POST['login']) {
            if($this->form_validation->run('valid_login')) {
                if($this->mod_login->is_valid_user()) {
                    redirect('student');
                }
                else {
                    $data['msg']='Invalid User and Password';
                }
            }
        }
        if($data['msg']=='') {
            $data['msg']=$this->session->flashdata('msg');
        }
         $data['nav_array']=array(
                array('title'=>'Login into Student Portal','url'=>'')
        );
        $data['page_title']='Login into Student Portal';
        $data['dir']='login';
        $data['page']='index';
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    function logout() {
        $this->mod_login->do_logout();
        redirect('login');
    }
    function forgot_password() {

        if($_POST['send']) {
            $this->form_validation->set_rules('user_name','User Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email|callback_is_user');
            if($this->form_validation->run()) {
                $this->mod_login->reset_password();
                $this->session->set_flashdata('msg','Thank you for contacting College Management Online Account Support.<p>We have Sent you an email to '.$_POST['email'].' .
                                                    <span class="block">Please check your email- a password reset link will be included in a message from College Management. Please click on the link to complete your password reset Process.</span></p>
                                                    <br />
                                                    <br />Thank you,
                                                    <br />College Management Account Support');
                redirect('login/notice');
            }
        }
         $data['nav_array']=array(
                array('title'=>'Forgot Password','url'=>'')
        );
        $data['page_title']='Forgot Password';
        $data['dir']='login';
        $data['page']='forgot_password';
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    /*function is_user() {
        $valid=sql::count('vw_user',"user_name='{$_POST['user_name']}' and (admin_email='{$_POST['email']}' or student_email='{$_POST['email']}' or agent_email='{$_POST['email']}' or staff_email='{$_POST['email']}')");
        if($valid>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_user','Email or User Name is invalid!');
            return FALSE;
        }
    }*/
    function is_user(){
        $valid=sql::count('user',"user_name='{$_POST['user_name']}' and email='{$_POST['email']}'");
        if($valid>0){
            return TRUE;
        }else{
            $this->form_validation->set_message('is_user','Email or User Name is invalid!');
            return FALSE;
        }
    }
    function notice() {
        $data['msg']=$this->session->flashdata('msg');
        if($data['msg']=='') {
            redirect('home');
        }
        $data['page_title']='Notice';
        $data['dir']='login';
        $data['page']='notice';
         $data['nav_array']=array(
                array('title'=>'Notice','url'=>'')
        );
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    function reset_password($verification_code='') {
        if($_POST['change_password']) {
            $this->form_validation->set_rules('new_password','Password','required|min_length[6]');
            $this->form_validation->set_rules('conf_password','Confirm Password','required|matches[new_password]');
            if($this->form_validation->run()) {
                $this->mod_login->update_password($verification_code);
                $this->session->set_flashdata('msg','Password Changed Successfully!!!');
                redirect('login/notice','refresh');
            }
        }
        if($verification_code=='') {
            redirect('home');
        }
        if($this->mod_login->is_password_verfiy($verification_code)) {
            $data['verify_code']=$verification_code;
            $data['nav_array']=array(
                    array('title'=>'Reset Password','url'=>'')
            );
            $data['dir']='login';
            $data['page']='reset_password';
            $data['page_title']='Reset Password';
            $data['portal']=TRUE;
            $this->load->view('student_portal',$data);
        }
        else {
            $this->session->set_flashdata('msg','Error!!!<br />An Error occured!.');
            redirect('login/notice');
        }
    }
}