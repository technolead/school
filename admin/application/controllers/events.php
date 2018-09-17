<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
/**
 * Description of events
 *
 * @author Anwar
 */
class events extends Controller {
    private $dir='events';
    function __construct() {
        parent::Controller();
        $this->load->model('mod_events');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Events Category',"Events Title",'Events Date','Event Time', "Status");
        $gridColumnModel = array(
                array("name" => "category_id",
                        "index" => "category_id",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "event_title",
                        "index" => "event_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "event_date",
                        "index" => "event_date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "event_time",
                        "index" => "event_time",
                        "width" => 50,
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
            $gridObj->setGridOptions("Manage Events", 880, 250, "event_title", "asc", $gridColumn, $gridColumnModel, site_url('?c=events&m=load_events&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage Events", 900, 250, "event_title", "asc", $gridColumn, $gridColumnModel, site_url('events/load_events'), true);
        }        
        $data['grid_data']=$gridObj->getGrid();

        $this->load->helper('text');
        $data['nav_array']=array(
                array('title'=>'Manage Events','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='index';
        $data['page_title']='Manage Events';
        $this->load->view('main',$data);
    }
    function load_events() {
        $this->load->helper('text');
        $this->mod_events->get_eventsGrid();
    }

    function new_event() {
        if($_POST['save']) {
            $data=array(
                    'category_id'=>$_POST['category_id'],
                    'event_title'=>$_POST['event_title'],
                    'event_des'=>$_POST['event_des'],
                    'event_date'=>$_POST['event_date'],
                    'event_time'=>$_POST['event_time']
            );
            $this->db->insert('wb_events',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('events/index');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Events','url'=>site_url('events/index')),
                array('title'=>'Add Events','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='event_form';
        $data['action']='events/new_event';
        $data['page_title']='Add New events';
        $this->load->view('main',$data);
    }
    function edit_event($event_id='') {
        if($event_id=='') {
            redirect('events');
        }
        if($_POST['save']) {
            $data=array(
                    'category_id'=>$_POST['category_id'],
                    'event_title'=>$_POST['event_title'],
                    'event_des'=>$_POST['event_des'],
                    'event_date'=>$_POST['event_date'],
                    'event_time'=>$_POST['event_time']
            );
            $this->db->update('wb_events',$data,array('wb_events_id'=>$event_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('events');
        }

        $data=sql::row('wb_events','wb_events_id='.$event_id);
        $this->session->set_userdata('event_id',$data['wb_events_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Events','url'=>site_url('events/index')),
                array('title'=>'Edit Events','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='event_form';
        $data['action']='events/edit_event/'.$data['wb_events_id'];
        $data['page_title']='Edit Event';
        $this->load->view('main',$data);
    }
    function delete_event($event_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','events')) {
            common::redirect();
        }
        if($event_id=='') {
            redirect('events');
        }
        sql::delete('wb_events','event_id='.$event_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function event_status($status='enabled',$event_id='') {
        if(!common::is_admin_user()||!common::user_permit('add','events')) {
            common::redirect();
        }

        
        if($event_id=='') {
            redirect('events');
        }
        common::change_status('wb_events','wb_events_id='.$event_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function category() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Events Title", "Status");
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
                        "align" => "center",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Events Category", 880, 250, "title", "asc", $gridColumn, $gridColumnModel, site_url('?c=events&m=load_category&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage Events Category", 880, 250, "title", "asc", $gridColumn, $gridColumnModel, site_url('events/load_category'), true);
        }
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Events Category','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='category';
        $data['page_title']='Manage Events Category';
        $this->load->view('main',$data);
    }
    function load_category() {
        $this->mod_events->get_categoryGrid();
    }
    function new_category() {
        if($_POST['save']) {
            $data=array(
                    'title'=>$_POST['title']
            );
            $this->db->insert('wb_event_category',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('events/category');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Events Category','url'=>site_url('events/category')),
                array('title'=>'Add Events Category','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['page']='category_form';
        $data['action']='events/new_category/'.$data['event_id'];
        $data['page_title']='Add Events Category';
        $this->load->view('main',$data);
    }
    function edit_category($category_id='') {
        if($_POST['save']) {
            $data=array(
                    'title'=>$_POST['title']
            );
            $this->db->update('wb_event_category',$data,array('category_id'=>$category_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('events/category');
        }
        if($category_id=='') {
            redirect('category');
        }
        $data=sql::row('wb_event_category','category_id='.$category_id); //Don't Change
        $this->session->set_userdata('category_id',$data['category_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Events Category','url'=>site_url('events/category')),
                array('title'=>'Edit Event Category','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['page']='category_form';
        $data['action']=site_url('events/edit_category')."/".$data['category_id'];
        $data['page_title']='Edit Events Category';
        $this->load->view('main',$data);
    }
    function delete_category($category_id='') {
        if($category_id=='') {
            redirect('events/category');
        }
        sql::delete('wb_event_category','category_id='.$category_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function category_status($status='1',$category_id='') {
        if($category_id=='') {
            redirect('category');
        }
        common::change_status('wb_event_category','category_id='.$category_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
}
?>