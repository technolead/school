<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of content
 *
 * @author Anwar
 */
class content extends Controller {
    private $dir='content';
    function __construct() {
        parent::Controller();
    }
    function index($menu_name='') {
        if($menu_name=='') {
            common::redirect();
        }
        $data=sql::row('wb_menus',"menu_name='$menu_name'");
        if($data['menu_id']==''){
            common::redirect();
        }
        $data['rows']=sql::rows('wb_content',"menu_id={$data['menu_id']}");
        $data['left_menus']=sql::rows('wb_menus',"parent_id={$data['menu_id']}");
        $data['page_title']=$data['menu_title'];

        $data['nav_array']=array(
                array('title'=>$data['menu_title'],'url'=>'')
        );
        $data['container']='content';
        $data['dir']=$this->dir;
        $data['page']='index';
        $this->load->view('main',$data);
    }
}
?>
