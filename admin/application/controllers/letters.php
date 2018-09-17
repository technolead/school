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
    function __construct() {
        parent::Controller();
        $this->load->model('mod_letters');
        common::is_logged();
    }
    function index() {
        if(!common::is_student_user()) {
            common::redirect();
        }
        $this->load->helper('text');
        $student_id=$this->session->userdata('logged_student_id');
        $data['letters']=$this->mod_letters->get_student_letters($student_id);
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['page_title']='Letters';
        $this->load->view('main',$data);
    }
    function manage_letters() {
        if(!common::is_admin_user()) {
            common::redirect();
        }

        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Letter Type',"Letter Title",'Description', "Status");
        $gridColumnModel = array(
                array("name" => "letter_type",
                        "index" => "letter_type",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "letter_title",
                        "index" => "letter_title",
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
                array("name" => "status",
                        "index" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Letters", 900, 250, "letter_title", "asc", $gridColumn, $gridColumnModel, site_url('letters/load_letters'), true);
        $data['grid_data']=$gridObj->getGrid();

        //$data['rows']=$this->mod_letters->get_letters();

        $this->load->helper('text');
        $data['nav_array']=array(
                array('title'=>'Manage Letters','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='manage_letters';
        $data['page_title']='Manage Letters';
        $this->load->view('main',$data);
    }
    function load_letters() {
        $this->load->helper('text');
        $this->mod_letters->get_letterGrid();
    }
    function details($issued_id='') {
        if(!common::is_student_user()) {
            common::redirect();
        }
        if($issued_id=='') {
            common::redirect();
        }
        $data=$this->mod_letters->get_issued_letters_details($issued_id);
        $data['letter_des']=common::issued_letters_data($issued_id);
        $data['nav_array']=array(
                array('title'=>'Letters','url'=>site_url('letters')),
                array('title'=>$data['letter_title'],'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['page']='details';
        $data['page_title']='Letters Details';
        $this->load->view('main',$data);
    }
    function new_letter() {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }

        if($_POST['save']) {
            if($this->form_validation->run('valid_letters')) {
                $this->mod_letters->save_letters(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('letters/manage_letters');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Letters','url'=>site_url('letters/manage_letters')),
                array('title'=>'Add New Letters','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='new_letter'; //Don't Change
        $data['page_title']='Add New letters';
        $this->load->view('main',$data);
    }
    function edit_letter($letters_id='') {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_letters')) {
                $this->mod_letters->update_letters(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('letters/manage_letters');
            }
        }
        if($letters_id=='') {
            redirect('letters/manage_letters');
        }
        $data=sql::row('letters','letters_id='.$letters_id);
        $this->session->set_userdata('letters_id',$data['letters_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Letters','url'=>site_url('letters/manage_letters')),
                array('title'=>'Edit Letters','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;

        $data['page']='edit_letter'; //Don't Change
        $data['page_title']='Edit Letters';
        $this->load->view('main',$data);
    }
    function delete_letters($letters_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','letters')) {
            common::redirect();
        }
        if($letters_id=='') {
            redirect('letters');
        }
        sql::delete('letters','letters_id='.$letters_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function letters_status($letters_id='',$status='enabled') {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($letters_id=='') {
            redirect('letters');
        }
        common::change_status('letters','letters_id='.$letters_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function letters_type() {
        if(!common::is_admin_user()||!common::user_permit('view','letters')) {
            common::redirect();
        }
        // $data['rows']=sql::rows('letters_type');
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Letter Title", "Status");
        $gridColumnModel = array(
                array("name" => "title",
                        "index" => "title",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Letters Type", 750, 250, "title", "asc", $gridColumn, $gridColumnModel, site_url('letters/load_types'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Letters Type','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='letters_type';
        $data['page_title']='Manage Letters Type';
        $this->load->view('main',$data);
    }
    function load_types() {
        $this->mod_letters->get_LetterTypeGrid();
    }
    function new_letter_type() {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_letters_type')) {
                $this->mod_letters->save_letters_type(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('letters/letters_type');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Letters Type','url'=>site_url('letters/letters_type')),
                array('title'=>'Add New Letters Type','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='new_letter_type'; //Don't Change
        $data['page_title']='Add New Letters Type';
        $this->load->view('main',$data);
    }
    function edit_letter_type($letters_type_id='') {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_letters_type')) {
                $this->mod_letters->update_letters_type(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('letters/letters_type');
            }
        }
        if($letters_type_id=='') {
            redirect('letters_type');
        }
        $data=sql::row('letters_type','letters_type_id='.$letters_type_id); //Don't Change
        $this->session->set_userdata('letters_type_id',$data['letters_type_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Letters Type','url'=>site_url('letters/letters_type')),
                array('title'=>'Edit Letters Type','url'=>'')
        );
        $data['dir']=$this->dir;


        $data['page']='edit_letter_type'; //Don't Change
        $data['page_title']='Edit Letters Type';
        $this->load->view('main',$data);
    }
    function delete_letters_type($letters_type_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','letters')) {
            common::redirect();
        }
        if($letters_type_id=='') {
            redirect('letters/letters_type');
        }
        sql::delete('letters_type','letters_type_id='.$letters_type_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function letters_type_status($letters_type_id='',$status='enabled') {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($letters_type_id=='') {
            redirect('letters_type');
        }
        common::change_status('letters_type','letters_type_id='.$letters_type_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function issued_letters() {
        if(!common::is_admin_user()||!common::user_permit('view','letters')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Student ID','Stdeunt Name',"Letter Title",'Description','Created By','Issue Date', 'Action');
        $gridColumnModel = array(
                array("name" => "s.user_name",
                        "index" => "s.user_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "s.first_name",
                        "index" => "s.first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "l.letter_title",
                        "index" => "l.letter_title",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "des",
                        "index" => "des",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "u.first_name",
                        "index" => "l.letter_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "sl.issue_date",
                        "index" => "sl.issue_date",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "action",
                        "index" => "action",
                        "width" => 45,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Issued Letters", 900, 250, "sl.issue_date", "desc", $gridColumn, $gridColumnModel, site_url('?c=letters&m=load_issue_letters&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage Issued Letters", 900, 250, "sl.issue_date", "desc", $gridColumn, $gridColumnModel, site_url('letters/load_issue_letters'), true);
        }
        $data['grid_data']=$gridObj->getGrid();
        
        $data['nav_array']=array(
                array('title'=>'Manage Issued Letters','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;

        $data['page']='issued_letters'; //Don't Change
        $data['page_title']='Manage Issued Letters';
        $this->load->view('main',$data);
    }
    function load_issue_letters() {
        $this->load->helper('text');
        $this->mod_letters->get_issueLetterGrid();
    }
   
    function edit_issue_letter($student_letters_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','letters')) {
            common::redirect();
        }
        if($student_letters_id=='') {
            redirect('letters/issued_letters');
        }
        if($_POST['update']) {
            $this->form_validation->set_rules('issue_date','Issue Date','required');
            $this->form_validation->set_rules('letter_des','letter Description','required');
            if($this->form_validation->run()) {
                $this->mod_letters->update_issue_letter();
                redirect('letters/issued_letters');
            }
        }
        $data=sql::row('student_letters','student_letters_id='.$student_letters_id);
        $this->session->set_userdata('student_letters_id',$data['student_letters_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Issued Letters','url'=>site_url('letters/issued_letters')),
                array('title'=>'Edit Issued Letters','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;

        $data['page']='edit_issue_letter'; //Don't Change
        $data['page_title']='Edit Letters';
        $this->load->view('main',$data);

    }
    function delete_issued_letters($student_letters_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','letters')) {
            common::redirect();
        }
        if($student_letters_id=='') {
            redirect('letters/issued_letters');
        }
        sql::delete('student_letters','student_letters_id='.$student_letters_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function print_view($issued_id='') {
        if($issued_id=='') {
            redirect('letters/issued_letters');
        }
        
        $letter=$this->mod_letters->get_issued_letters_details($issued_id);
        $data=common::get_student_info($letter['student_id']);
        
        $data['letter_print']=TRUE;
        $data['letter']=$letter;
        $data['dir']='letters';
        $data['page']='read_letter'; //Don't Change
        $data['page_title']='View Letter';
        $this->load->view('print_main',$data);
    }
    function letter_variable() {
        $data['dir']='letters';
        $data['page']='letter_variable'; //Don't Change
        $data['page_title']='Letter Variable List';
        $this->load->view('print_main',$data);
    }









    function official_letters() {
        if(!common::is_admin_user()) {
            common::redirect();
        }

        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Letter Title",'Description', "Issue Date");
        $gridColumnModel = array(
                array("name" => "title",
                        "index" => "title",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "description",
                        "index" => "description",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "issue_date",
                        "index" => "issue_date",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                )
        );
        $gridObj->setGridOptions("Manage Official Letters", 900, 250, "title", "asc", $gridColumn, $gridColumnModel, site_url('letters/load_official_letters'), true);
        $data['grid_data']=$gridObj->getGrid();

        $this->load->helper('text');
        $data['nav_array']=array(
                array('title'=>'Manage Official Letters','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='official_letters';
        $data['page_title']='Manage Official Letters';
        $this->load->view('main',$data);
    }
    function load_official_letters() {
        $this->load->helper('text');
        $this->mod_letters->get_official_letterGrid();
    }
    
    function new_official_letter() {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }

        if($_POST['save']) {
            if($this->form_validation->run('valid_official_letters')) {
                $this->mod_letters->save_official_letters();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('letters/official_letters');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Official Letters','url'=>site_url('letters/official_letters')),
                array('title'=>'New Official Letter','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='new_official_letter';
        $data['page_title']='New Official Letter';
        $this->load->view('main',$data);
    }
    function edit_official_letter($official_letter_id='') {
        if(!common::is_admin_user()||!common::user_permit('add','letters')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_official_letters')) {
                $this->mod_letters->update_official_letter();
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('letters/official_letters');
            }
        }
        if($official_letter_id=='') {
            redirect('letters/official_letters');
        }
        $data=sql::row('official_letter','official_letter_id='.$official_letter_id);
        $this->session->set_userdata('official_letter_id',$data['official_letter_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Official Letters','url'=>site_url('letters/official_letters')),
                array('title'=>'Edit Official Letter','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;

        $data['page']='edit_official_letter';
        $data['page_title']='Edit Official Letter';
        $this->load->view('main',$data);
    }
    function delete_official_letters($official_letter_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','letters')) {
            common::redirect();
        }
        if($official_letter_id=='') {
            redirect('letters/official_letter');
        }
        $this->mod_letters->delete_official_letter($official_letter_id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
}
?>
