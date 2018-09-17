<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
/**
 * Description of news
 *
 * @author Anwar
 */
class news extends Controller {
    private $dir='news';
    function __construct() {
        parent::Controller();
        $this->load->model('mod_news');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('News Category',"News Title",'News Date', "Status");
        $gridColumnModel = array(
                array("name" => "category_id",
                        "index" => "category_id",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "news_title",
                        "index" => "news_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "news_date",
                        "index" => "news_des",
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
            $gridObj->setGridOptions("Manage News", 900, 250, "news_title", "asc", $gridColumn, $gridColumnModel, site_url('?c=news&m=load_news&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue']), true);
        }else {
            $gridObj->setGridOptions("Manage News", 900, 250, "news_title", "asc", $gridColumn, $gridColumnModel, site_url('news/load_news'), true);
        }
        $data['grid_data']=$gridObj->getGrid();

        $this->load->helper('text');
        $data['nav_array']=array(
                array('title'=>'Manage News','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='index';
        $data['page_title']='Manage News';
        $this->load->view('main',$data);
    }
    function load_news() {
        $this->load->helper('text');
        $this->mod_news->get_newsGrid();
    }

    function new_news() {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $news_image=$this->mod_news->add_image();
            }else {
                $news_image='';
            }
            $data=array(
                    'category_id'=>$_POST['category_id'],
                    'news_title'=>$_POST['news_title'],
                    'news_des'=>$_POST['news_des'],
                    'news_image'=>$news_image
            );
            $this->db->insert('wb_news',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('news/index');
        }
        $data['nav_array']=array(
                array('title'=>'Manage News','url'=>site_url('news/index')),
                array('title'=>'Add News','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='new_news'; 
        $data['page_title']='Add New news';
        $this->load->view('main',$data);
    }
    function edit_news($news_id='') {
        if($news_id=='') {
            redirect('news');
        }
        if($_POST['update']) {
            if($_FILES['image']['name']!='') {
                $news_image=$this->mod_news->add_image($_POST['h_image']);
            }else {
                $news_image=$_POST['h_image'];
            }
            $data=array(
                    'category_id'=>$_POST['category_id'],
                    'news_title'=>$_POST['news_title'],
                    'news_des'=>$_POST['news_des'],
                    'news_image'=>$news_image
            );
            $this->db->update('wb_news',$data,array('news_id'=>$news_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('news');
        }

        $data=sql::row('wb_news','news_id='.$news_id);
        $this->session->set_userdata('news_id',$data['news_id']); 
        $data['nav_array']=array(
                array('title'=>'Manage News','url'=>site_url('news/index')),
                array('title'=>'Edit News','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;

        $data['page']='edit_news'; 
        $data['page_title']='Edit News';
        $this->load->view('main',$data);
    }
    function delete_news($news_id='') {
        if(!common::is_admin_user()||!common::user_permit('delete','news')) {
            common::redirect();
        }
        if($news_id=='') {
            redirect('news');
        }
        sql::delete('wb_news','news_id='.$news_id); 
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function news_status($news_id='',$status='enabled') {
        if(!common::is_admin_user()||!common::user_permit('add','news')) {
            common::redirect();
        }
        if($news_id=='') {
            redirect('news');
        }
        common::change_status('wb_news','news_id='.$news_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function category() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("News Title", "Status");
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
        $gridObj->setGridOptions("Manage News Category", 880, 250, "title", "asc", $gridColumn, $gridColumnModel, site_url('news/load_category'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage News Category','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='category';
        $data['page_title']='Manage News Category';
        $this->load->view('main',$data);
    }
    function load_category() {
        $this->mod_news->get_categoryGrid();
    }
    function new_category() {
        if($_POST['save']) {
            $data=array(
                    'title'=>$_POST['title']
            );
            $this->db->insert('wb_category',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('news/category');
        }
        $data['nav_array']=array(
                array('title'=>'Manage News Category','url'=>site_url('news/category')),
                array('title'=>'Add News Category','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='new_category'; 
        $data['page_title']='Add News Category';
        $this->load->view('main',$data);
    }
    function edit_category($category_id='') {
        if($_POST['update']) {
            $data=array(
                    'title'=>$_POST['title']
            );
            $this->db->update('wb_event_category',$data,array('category_id'=>$category_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('news/category');
        }
        if($category_id=='') {
            redirect('category');
        }
        $data=sql::row('wb_event_category','category_id='.$category_id);
        $this->session->set_userdata('category_id',$data['category_id']);
        $data['nav_array']=array(
                array('title'=>'Manage News Category','url'=>site_url('news/category')),
                array('title'=>'Edit News Category','url'=>'')
        );
        $data['dir']=$this->dir;


        $data['page']='edit_category'; 
        $data['page_title']='Edit News Category';
        $this->load->view('main',$data);
    }
    function delete_category($category_id='') {
        if($category_id=='') {
            redirect('news/category');
        }
        sql::delete('wb_category','category_id='.$category_id); 
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function category_status($status='1',$category_id='') {
        if($category_id=='') {
            redirect('category');
        }
        common::change_status('wb_category','category_id='.$category_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
}
?>