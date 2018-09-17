<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of module_material
 *
 * @author Anwar
 */
class module_material extends Controller {
    private $dir='module_material';

    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_module_material');
    }
    function index() {
        $this->load->helper('text');
        $data['rows']=$this->mod_module_material->get_student_material(); //Don't Change
        $data['dir']=$this->dir;

        $data['page']='index'; //Don't Change
        $data['page_title']='Subject Notes';
        $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
    function details($module_material_id='') {
        if($module_material_id=='') {
            common::redirect();
        }
        $data=$this->mod_module_material->get_material_details($module_material_id);
        $data['dir']=$this->dir;
        $data['page']='details'; //Don't Change
        $data['page_title']='Subject Materials Details';
         $data['portal']=TRUE;
        $this->load->view('student_portal',$data);
    }
}
?>
