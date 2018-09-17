<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of letters
 *
 * @author Anwar
 */
class letters extends Controller {
    private $dir='letters';
    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_letters');
    }
    function index() {
        $this->load->helper('text');
        $student_id=$this->session->userdata('logged_student_id');
        $data['letters']=$this->mod_letters->get_student_letters($student_id);
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['portal']=TRUE;
        $data['nav_array']=array(
                array('title'=>$this->session->userdata('student_name'),'url'=>'')
        );
        $data['page_title']='Letters';
        $this->load->view('student_portal',$data);
    }
    function details($issued_id='') {
        if($issued_id=='') {
            common::redirect();
        }
        $data=$this->mod_letters->get_issued_letters_details($issued_id);
        $data['letter_des']=$this->mod_letters->issued_letters_data($issued_id);
        $data['nav_array']=array(
                array('title'=>'Letters','url'=>site_url('letters')),
                array('title'=>$data['letter_title'],'url'=>'')
        );
        $data['portal']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='details';
        $data['page_title']='Letters Details';
        $this->load->view('student_portal',$data);
    }
}
?>
