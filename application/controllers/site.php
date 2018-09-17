<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site
 *
 * @author Anwar
 */
class site extends Controller {
    private $dir='static';
    function  __construct() {
        parent::Controller();
    }
    function index($page_name=''){
        if($page_name=='') {
            common::redirect();
        }
        $data=sql::row('wb_static_pages',"page_name='$page_name'");
        if($data['page_id']==''){
            common::redirect();
        }

        $data['page_title']=$data['page_title'];
        $data['nav_array']=array(
                array('title'=>$data['page_title'],'url'=>'')
        );
        $data['container']='content';
        $data['dir']=$this->dir;
        $data['page']='index';
        $this->load->view('main',$data);
    }
}
?>
