<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Anwar
 */
class home extends Controller {
    private $dir='home';
    function  __construct() {
        parent::Controller();
        common::is_logged();
    }
    function index(){
        $this->load->model('mod_notice');
        $this->load->helper('text');
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['notice']=$this->mod_notice->get_issued_notice('Admin User');
        $this->load->view('main',$data);
    }
}
?>
