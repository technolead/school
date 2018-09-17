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
    private $container='common';
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_notice');
    }
    function index() {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->helper('text');
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Notice Title','Posted To','Description','Prority','Notice Type','Valid Until','Posted Date', 'Status');
        $gridColumnModel = array(
                array("name" => "notice_title",
                        "index" => "notice_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "posted_to",
                        "index" => "posted_to",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "des",
                        "index" => "des",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "priority",
                        "index" => "priority",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "notice_type",
                        "index" => "notice_type",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "valid_until",
                        "index" => "valid_until",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "posted_date",
                        "index" => "posted_date",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );

        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Notice", 900, 250, "posted_date", "desc", $gridColumn, $gridColumnModel, site_url('?c=notice&m=load_notice&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage Notice", 900, 250, "posted_date", "desc", $gridColumn, $gridColumnModel, site_url('notice/load_notice'), true);
        }
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='index';
        $data['page_title']='Manage Notice';
        $this->load->view('main',$data);
    }
    function load_notice() {
        $this->load->helper('text');
        $this->mod_notice->get_noticeGrid();
    }
    function valid_filter() {
        $this->form_validation->set_rules('posted_date', 'Student ID', '');
        $this->form_validation->set_rules('valid_until', 'Last Name', '');
        $this->form_validation->set_rules('posted_to', 'Last Name', '');
        $this->form_validation->set_rules('notice_type', 'Agent Status', '');
    }
    function details($notice_id='') {
        if($notice_id=='') {
            redirect('home');
        }
        $data=$this->mod_notice->get_notice_details($notice_id);
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='details';
        $data['page_title']='Notice Details';
        $this->load->view('main',$data);
    }
    function new_notice() {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_notice')) {
                $this->mod_notice->save_notice(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('notice');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>site_url('notice')),
                array('title'=>'Add New Notice','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='new_notice'; //Don't Change
        $data['page_title']='Add New Notice';
        $this->load->view('main',$data);
    }
    function edit_notice($notice_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_notice')) {
                $this->mod_notice->update_notice(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('notice');
            }
        }
        if($notice_id=='') {
            redirect('notice');
        }
        $data=sql::row('notice','notice_id='.$notice_id);
        $this->session->set_userdata('notice_id',$data['notice_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>site_url('notice')),
                array('title'=>'Edit Notice','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='edit_notice'; //Don't Change
        $data['page_title']='Edit Notice';
        $this->load->view('main',$data);
    }
    function delete_notice($notice_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($notice_id=='') {
            redirect('notice');
        }
        sql::delete('notice','notice_id='.$notice_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function notice_status($status='enabled',$notice_id='') {
        if(!common::is_admin_user()||!common::user_permit('update')) {
            common::redirect();
        }
        if($notice_id=='') {
            redirect('notice');
        }
        common::change_status('notice','notice_id='.$notice_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    function staff_notice() {
        if(!common::is_staff_user() && !common::is_admin_user()) {
            common::redirect();
        }
        $this->load->helper('text');
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Notice Title','Posted To','Description','Valid Until','Posted Date', 'Status');
        $gridColumnModel = array(
                array("name" => "notice_title",
                        "index" => "notice_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "posted_to",
                        "index" => "posted_to",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "des",
                        "index" => "des",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "valid_until",
                        "index" => "valid_until",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "posted_date",
                        "index" => "posted_date",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Notice", 900, 250, "posted_date", "desc", $gridColumn, $gridColumnModel, site_url('?c=notice&m=load_staff_notice&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage Notice", 900, 250, "posted_date", "desc", $gridColumn, $gridColumnModel, site_url('notice/load_staff_notice'), true);
        }
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='staff_notice';
        $data['page_title']='Manage Notice';
        $this->load->view('main',$data);
    }
    function load_staff_notice() {
        $this->load->helper('text');
        $this->mod_notice->get_staffNoticeGrid();
    }
    function notice_details($notice_id='') {
        if($notice_id=='') {
            common::redirect();
        }
        $data=$this->mod_notice->get_staff_notice_details($notice_id);
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='notice_details';
        $data['page_title']='Notice Details';
        $this->load->view('main',$data);
    }
    function new_staff_notice() {
        if(!common::is_staff_user()) {
            common::redirect();
        }
        if($_POST['save']) {
            // if($this->form_validation->run('valid_notice')) {
            $this->mod_notice->save_staff_notice(); //Don't Change
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('notice/staff_notice');
            //}
        }
        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>site_url('notice/staff_notice')),
                array('title'=>'Add New Notice','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='new_staff_notice'; //Don't Change
        $data['page_title']='Add New Notice';
        $this->load->view('main',$data);
    }
    function edit_staff_notice($notice_id='') {

        if(!common::is_staff_user() && !common::is_admin_user()) {
            common::redirect();
        }
        if($_POST['update']) {
            // if($this->form_validation->run('valid_notice')) {
            $this->mod_notice->update_staff_notice(); //Don't Change
            $this->session->set_flashdata('msg','Successfully Updated!!!');
            redirect('notice/staff_notice');
            //}
        }
        if($notice_id=='') {
            redirect('notice');
        }
        $data=sql::row('staff_notice','notice_id='.$notice_id);
        $this->session->set_userdata('notice_id',$data['notice_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Notice','url'=>site_url('notice/staff_notice')),
                array('title'=>'Edit Notice','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='edit_staff_notice'; //Don't Change
        $data['page_title']='Edit Notice';
        $this->load->view('main',$data);
    }
    function delete_staff_notice($notice_id='') {
        if(common::is_staff_user() || common::is_admin_user()) {
            if($notice_id=='') {
                common::redirect();
            }
            sql::delete('staff_notice','notice_id='.$notice_id); //Don't Change
            $this->session->set_flashdata('msg','Successfully Deleted!!!');
            common::redirect();
        }else {
            common::redirect();
        }

    }
    function staff_notice_status($status='enabled',$notice_id='') {
        if(common::is_staff_user() || common::is_admin_user()) {
            if($notice_id=='') {
                common::redirect();
            }
            common::change_status('staff_notice','notice_id='.$notice_id,$status);
            $this->session->set_flashdata('msg','Status Updated!!!');
            common::redirect();
        }else {
            common::redirect();
        }
    }
}
?>
