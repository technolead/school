<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notice
 *
 * @author Anwar
 */
class notice extends Controller {
    private $dir='notice';
    function __construct(){
        parent::Controller();
        $this->load->model('mod_notice');
    }
     function details($notice_id='') {
        if($notice_id=='') {
            redirect('home');
        }
        $data=$this->mod_notice->get_notice_details($notice_id);
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='details';
        $data['portal']=TRUE;
        $data['page_title']='Notice Details';
        $this->load->view('student_portal',$data);
    }
     function notice_details($notice_id='') {
        if($notice_id=='') {
            common::redirect();
        }
        $data=$this->mod_notice->get_staff_notice_details($notice_id);
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='notice_details';
        $data['portal']=TRUE;
        $data['page_title']='Notice Details';
        $this->load->view('student_portal',$data);
    }
}
?>
