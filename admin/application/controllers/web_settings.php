<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
/**
 * Description of web_settings
 *
 * @author Anwar
 */
class web_settings extends Controller {
    private $dir='web_settings';
    function __construct() {
        parent::Controller();
        $this->load->model('mod_web_settings');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Link Title','Link URL', 'Status');
        $gridColumnModel = array(
                array("name" => "link_title",
                        "index" => "link_title",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "link_title",
                        "index" => "link_title",
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
        $gridObj->setGridOptions("Manage Useful Links", 880, 250, "link_title", "asc", $gridColumn, $gridColumnModel, site_url('web_settings/load_links'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Useful Links','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['page_title']='Manage Useful Links';
        $this->load->view('main',$data);
    }
    function load_links() {
        $this->mod_web_settings->get_linkGrid();
    }
    function new_link() {
        if($_POST['save']) {
            $data=array(
                    'link_title'=>$_POST['link_title'],
                    'link_url'=>$_POST['link_url']
            );
            $this->db->insert('wb_useful_link',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('web_settings');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Useful Links','url'=>site_url('web_settings')),
                array('title'=>'Add Useful Links','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='web_settings/new_link'; //Don't Change
        $data['page']='link_form'; //Don't Change
        $data['page_title']='Add Useful Links';
        $this->load->view('main',$data);
    }
    function edit_link($link_id='') {
        if($_POST['save']) {
            $data=array(
                    'link_title'=>$_POST['link_title'],
                    'link_url'=>$_POST['link_url']
            );
            $this->db->update('wb_useful_link',$data,array('link_id'=>$link_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('web_settings');
        }
        if($link_id=='') {
            common::redirect();
        }
        $data=sql::row('wb_useful_link','link_id='.$link_id); //Don't Change
        $this->session->set_userdata('link_id',$data['link_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Useful Links','url'=>site_url('web_settings')),
                array('title'=>'Edit Link','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='web_settings/edit_link/'.$data['link_id']; //Don't Change
        $data['page']='link_form'; //Don't Change
        $data['page_title']='Edit Useful Links';
        $this->load->view('main',$data);
    }
    function delete_link($link_id='') {
        if($link_id=='') {
            redirect('web_settings');
        }
        sql::delete('wb_useful_link','link_id='.$link_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function link_status($status='1',$link_id='') {
        if($link_id=='') {
            redirect('link');
        }
        common::change_status('wb_useful_link','link_id='.$link_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    //
    function featured() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Featured Title','Featured URL','Featured Image', 'Status');
        $gridColumnModel = array(
                array("name" => "featured_title",
                        "featured" => "featured_title",
                        "width" => 100,
                        "sortable" => TRUE,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "featured_url",
                        "featured" => "featured_url",
                        "width" => 100,
                        "sortable" => TRUE,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "featured_image",
                        "featured" => "featured_image",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status",
                        "featured" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Featured Box", 880, 250, "featured_title", "asc", $gridColumn, $gridColumnModel, site_url('web_settings/load_featured'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Featured Box','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='featured';
        $data['page_title']='Manage Featured Box';
        $this->load->view('main',$data);
    }
    function load_featured() {
        $this->mod_web_settings->get_featuredGrid();
    }
    function new_featured() {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $featured_image=$this->mod_web_settings->add_image();
            }else {
                $featured_image='';
            }
            if(is_array($_POST['featured_links'])) {
                $featured_links=implode('#', $_POST['featured_links']);
            }else {
                $featured_links='';
            }
            $data=array(
                    'featured_title'=>$_POST['featured_title'],
                    'featured_url'=>$_POST['featured_url'],
                    'featured_image'=>$featured_image,
                    'featured_links'=>$featured_links
            );
            $this->db->insert('wb_featured_box',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('web_settings/featured');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Featured Box','url'=>site_url('web_settings')),
                array('title'=>'Add Featured Box','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='web_settings/new_featured'; //Don't Change
        $data['page']='featured_form'; //Don't Change
        $data['page_title']='Add Featured Box';
        $this->load->view('main',$data);
    }
    function edit_featured($featured_id='') {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $featured_image=$this->mod_web_settings->add_image($_POST['h_image']);
            }else {
                $featured_image=$_POST['h_image'];
            }
            if(is_array($_POST['featured_links'])) {
                $featured_links=implode('#', $_POST['featured_links']);
            }else {
                $featured_links='';
            }
            $data=array(
                    'featured_title'=>$_POST['featured_title'],
                    'featured_url'=>$_POST['featured_url'],
                    'featured_image'=>$featured_image,
                    'featured_links'=>$featured_links
            );
            $this->db->update('wb_featured_box',$data,array('featured_id'=>$featured_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('web_settings/featured');
        }
        if($featured_id=='') {
            common::redirect();
        }
        $data=sql::row('wb_featured_box','featured_id='.$featured_id); //Don't Change
        $this->session->set_userdata('featured_id',$data['featured_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Featured Box','url'=>site_url('web_settings')),
                array('title'=>'Edit featured','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='web_settings/edit_featured/'.$data['featured_id']; //Don't Change
        $data['page']='featured_form'; //Don't Change
        $data['page_title']='Edit Featured Box';
        $this->load->view('main',$data);
    }
    function delete_featured($featured_id='') {
        if($featured_id=='') {
            redirect('web_settings');
        }
        sql::delete('wb_featured_box','featured_id='.$featured_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function featured_status($status='1',$featured_id='') {
        if($featured_id=='') {
            redirect('featured');
        }
        common::change_status('wb_featured_box','featured_id='.$featured_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
}
?>