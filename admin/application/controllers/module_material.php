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
        if(!common::is_student_user()) {
            redirect('login');
        }
        $this->load->helper('text');
        $data['rows']=$this->mod_module_material->get_student_material(); //Don't Change
        $data['dir']=$this->dir;

        $data['page']='index'; //Don't Change
        $data['page_title']='Subject Notes';
        $this->load->view('main',$data);
    }
    function details($module_material_id='') {
        if($module_material_id=='') {
            common::redirect();
        }
        $data=$this->mod_module_material->get_material_details($module_material_id);
        $data['dir']=$this->dir;
        $data['page']='details'; //Don't Change
        $data['page_title']='Subject Materials Details';
        $this->load->view('main',$data);
    }
    function mng_material() {
        if(!common::is_staff_user()) {
            redirect('login');
        }
        $this->load->helper('text');
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('module_material/mng_material/');
        $config['total_rows'] = count($this->mod_module_material->get_staff_material());
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_module_material->get_staff_material("limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Subject Material','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;

        $data['page']='mng_material'; //Don't Change
        $data['page_title']='Manage Subject Material';
        $this->load->view('main',$data);
    }
    function new_material() {
        if(!common::is_staff_user()) {
            redirect('login');
        }
        if($_POST['save']) {
            $this->valid_material();
            if($this->form_validation->run()) {
                $this->mod_module_material->save_module_material();
                $this->session->set_flashdata('msg','Subject Material Added Successfully!!!');
                redirect('module_material/mng_material');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Subject Material','url'=>site_url('module_material/mng_material')),
                array('title'=>'New Subject Material','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='new_material'; //Don't Change
        $data['page_title']='New Subject Material';
        $this->load->view('main',$data);
    }
    function edit_material($module_material_id='') {
        if(!common::is_staff_user()) {
            common::redirect();
        }
        if($_POST['update']) {
            $this->valid_material();
            if($this->form_validation->run()) {
                $this->mod_module_material->update_module_material();
                $this->session->set_flashdata('msg','Subject Material Added Successfully!!!');
                redirect('module_material/mng_material');
            }
        }
        if($module_material_id=='') {
            redirect('module_material/index');
        }
        $data=sql::row('module_material',"module_material_id=$module_material_id");
        $this->session->set_userdata('module_material_id',$data['module_material_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Subject Material','url'=>site_url('module_material/mng_material')),
                array('title'=>'Edit Subject Material','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='edit_material'; //Don't Change
        $data['page_title']='Edit Subject Material';
        $this->load->view('main',$data);
    }
    function delete_material($module_material_id='') {
        if(common::is_student_user() || !common::is_logged_in()) {
            common::redirect();
        }
        if($module_material_id=='') {
            common::redirect();
        }
        $file=sql::row('module_material',"module_material_id=$module_material_id");
        $param['dir']=UPLOAD_PATH."materials/";
        $param['type']=DOC_EXT;
        $this->load->library('zupload',$param);
        if($file['lecture_file']!="") {
            $this->zupload->delFile($file['lecture_file']);
        }
        sql::delete('module_material','module_material_id='.$module_material_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function material_status($module_material_id='',$status='enabled') {
        if(common::is_student_user() || !common::is_logged_in()) {
            common::redirect();
        }
        if($module_material_id=='') {
            common::redirect();
        }
        common::change_status('module_material','module_material_id='.$module_material_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function valid_material() {
        $this->form_validation->set_rules('module_id', 'Subject', 'required');
        $this->form_validation->set_rules('lecture_notes', 'Lecture Notes', 'required');
        $this->form_validation->set_rules('posted_date', 'Posted Date', 'required');
        $this->form_validation->set_rules('valid_until', 'Valid Until', 'required');
    }
    function module_doc_history() {
        if(!common::is_admin_user()) {
            redirect('login');
        }
        $this->load->helper('text');
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('module_material/mng_material/');
        $config['total_rows'] = count($this->mod_module_material->get_module_material());
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        
       

        if($_POST['apply_filter']) {
            $this->valid_filter();
            if($this->form_validation->run()) {
                $config['per_page'] =count($this->mod_module_material->filter_material());
                $config['total_rows'] =count($this->mod_module_material->filter_material());
                $data['rows']=$this->mod_module_material->filter_material(); //Don't Change
            }
        }else {
            $config['total_rows'] =count($this->mod_module_material->get_module_material());
             $data['rows']=$this->mod_module_material->get_module_material("limit $start,{$config['per_page']}"); //Don't Change
        }

        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();
        
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Manage Subject Material','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;

        $data['page']='module_doc_history'; //Don't Change
        $data['page_title']='Manage Subject Material';
        $this->load->view('main',$data);
    }
    function valid_filter() {
        $this->form_validation->set_rules('posted_date', 'Student ID', '');
        $this->form_validation->set_rules('valid_until', 'Last Name', '');
        $this->form_validation->set_rules('staffs_id', 'Last Name', '');
        $this->form_validation->set_rules('module_id', 'Agent Status', '');
    }
      function edit_doc_history($module_material_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($_POST['update']) {
            $this->valid_material();
            if($this->form_validation->run()) {
                $this->mod_module_material->update_module_material();
                $this->session->set_flashdata('msg','Module Material Updated Successfully!!!');
                redirect('module_material/module_doc_history');
            }
        }
        if($module_material_id=='') {
            redirect('module_material/index');
        }
        $data=$this->mod_module_material->get_module_material_row($module_material_id);
        $this->session->set_userdata('module_material_id',$data['module_material_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Module Material','url'=>site_url('module_material/module_doc_history')),
                array('title'=>'Edit Module Material','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='edit_doc_history'; //Don't Change
        $data['page_title']='Edit Module Material';
        $this->load->view('main',$data);
    }
}
?>
