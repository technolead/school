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
        $this->load->model('mod_content');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Menu Name',"Content Title",'Added Date', "Status");
        $gridColumnModel = array(
                array("name" => "menu_id",
                        "index" => "menu_id",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "content_title",
                        "index" => "content_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "content_date",
                        "index" => "content_date",
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
        $gridObj->setGridOptions("Manage Content", 880, 250, "content_title", "asc", $gridColumn, $gridColumnModel, site_url('content/load_content'), true);
        $data['grid_data']=$gridObj->getGrid();

        $this->load->helper('text');
        $data['nav_array']=array(
                array('title'=>'Manage Content','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='index';
        $data['page_title']='Manage Content';
        $this->load->view('main',$data);
    }
    function load_content() {
        $this->load->helper('text');
        $this->mod_content->get_contentGrid();
    }

    function new_content() {
        if($_POST['save']) {
            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'content_title'=>$_POST['content_title'],
                    'content_des'=>$_POST['content_des']
            );
            $this->db->insert('wb_content',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('content/index');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Content','url'=>site_url('content/index')),
                array('title'=>'Add News','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['page']='new_content'; //Don't Change
        $data['page_title']='Add New content';
        $this->load->view('main',$data);
    }
    function edit_content($content_id='') {
        if($content_id=='') {
            redirect('content');
        }
        if($_POST['update']) {
            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'content_title'=>$_POST['content_title'],
                    'content_des'=>$_POST['content_des']
            );
            $this->db->update('wb_content',$data,array('content_id'=>$content_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('content');
        }

        $data=sql::row('wb_content','content_id='.$content_id);
        $this->session->set_userdata('content_id',$data['content_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Content','url'=>site_url('content/index')),
                array('title'=>'Edit News','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;

        $data['page']='edit_content'; //Don't Change
        $data['page_title']='Edit Letters';
        $this->load->view('main',$data);
    }
    function delete_content($content_id='') {
        if($content_id=='') {
            redirect('content');
        }
        sql::delete('content','content_id='.$content_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function content_status($status='1',$content_id='') {
        if($content_id=='') {
            redirect('content');
        }
        common::change_status('wb_content','content_id='.$content_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function menus() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Menu Name","Menu Title", "Status");
        $gridColumnModel = array(
                array("name" => "menu_name",
                        "index" => "title",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "menu_title",
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
        $gridObj->setGridOptions("Manage Menu Name", 880, 250, "menu_title", "asc", $gridColumn, $gridColumnModel, site_url('content/load_menu'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='menus';
        $data['page_title']='Manage Menu Name';
        $this->load->view('main',$data);
    }
    function load_menu() {
        $this->mod_content->get_menuGrid();
    }
    function new_menu() {
        if($_POST['save']) {
            $data=array(
                    'menu_name'=>$_POST['menu_name'],
                    'menu_title'=>$_POST['menu_title']
            );
            $this->db->insert('wb_menus',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('content/menus');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>site_url('content/menus')),
                array('title'=>'Add Menu Name','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['page']='new_menu'; //Don't Change
        $data['page_title']='Add Menu Name';
        $this->load->view('main',$data);
    }
    function edit_menu($menu_id='') {
        if($_POST['update']) {
            $data=array(
                    'menu_name'=>$_POST['menu_name'],
                    'menu_title'=>$_POST['menu_title']
            );
            $this->db->update('wb_menus',$data,array('menu_id'=>$menu_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('content/menus');
        }
        if($menu_id=='') {
            redirect('menus');
        }
        $data=sql::row('wb_menus','menu_id='.$menu_id); //Don't Change
        $this->session->set_userdata('menu_id',$data['menu_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>site_url('content/menus')),
                array('title'=>'Edit Letters Category','url'=>'')
        );
        $data['dir']=$this->dir;


        $data['page']='edit_menu'; //Don't Change
        $data['page_title']='Edit Menu Name';
        $this->load->view('main',$data);
    }

    function sub_menus() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Top Menu',"Menu Name","Menu Title", "Status");
        $gridColumnModel = array(
                array("name" => "parent_id",
                        "index" => "parent_id",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "menu_name",
                        "index" => "menu_name",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "menu_title",
                        "index" => "menu_title",
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
        $gridObj->setGridOptions("Manage Menu Name", 880, 250, "parent_id", "asc", $gridColumn, $gridColumnModel, site_url('content/load_submenu'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='sub_menus';
        $data['page_title']='Manage Menu Name';
        $this->load->view('main',$data);
    }
    function load_submenu() {
        $this->mod_content->get_submenuGrid();
    }
    function new_submenu() {
        if($_POST['save']) {
            $data=array(
                    'parent_id'=>$_POST['parent_id'],
                    'menu_name'=>$_POST['menu_name'],
                    'menu_title'=>$_POST['menu_title']
            );
            $this->db->insert('wb_menus',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('content/sub_menus');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>site_url('content/menus')),
                array('title'=>'Add Menu Name','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='content/new_submenu';
        $data['page']='submenu_form'; //Don't Change
        $data['page_title']='Add Sub Menu Name';
        $this->load->view('main',$data);
    }
    function edit_submenu($menu_id='') {
        if($_POST['save']) {
            $data=array(
                    'parent_id'=>$_POST['parent_id'],
                    'menu_name'=>$_POST['menu_name'],
                    'menu_title'=>$_POST['menu_title']
            );
            $this->db->update('wb_menus',$data,array('menu_id'=>$menu_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('content/sub_menus');
        }
        if($menu_id=='') {
            redirect('menus/submenus');
        }
        $data=sql::row('wb_menus','menu_id='.$menu_id); //Don't Change
        $this->session->set_userdata('menu_id',$data['menu_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Menu Name','url'=>site_url('content/menus')),
                array('title'=>'Edit Letters Category','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['action']='content/edit_submenu/'.$data['menu_id'];
        $data['page']='submenu_form'; //Don't Change
        $data['page_title']='Edit Menu Name';
        $this->load->view('main',$data);
    }

    function delete_menu($menu_id='') {
        if($menu_id=='') {
            common::redirect();
        }
        sql::delete('wb_menus','menu_id='.$menu_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function menu_status($status='1',$menu_id='') {
        if($menu_id=='') {
            common::redirect();
        }
        common::change_status('wb_menus','menu_id='.$menu_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    function page_images() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Top Menu','Image Title','Image', 'Status');
        $gridColumnModel = array(
                array("name" => "m.menu_title",
                        "index" => "m.menu_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "p.image_title",
                        "index" => "p.image_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "p.image",
                        "index" => "p.image",
                        "width" => 40,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "p.status",
                        "index" => "p.status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Page Image", 880, 250, "p.image_title", "asc", $gridColumn, $gridColumnModel, site_url('content/load_page_image'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='page_images';
        $data['page_title']='Manage Page Image';
        $this->load->view('main',$data);
    }
    function load_page_image() {
        $this->mod_content->get_page_imageGrid();
    }
    function new_page_image() {
        if($_POST['save']) {
            $image=$this->mod_content->add_image();
            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'image_title'=>$_POST['image_title'],
                    'image'=>$image
            );
            $this->db->insert('wb_page_image',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('content/page_images');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>site_url('content/page_images')),
                array('title'=>'Add Page Image','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='content/new_page_image';
        $data['page']='page_image_form'; //Don't Change
        $data['page_title']='Add Sub Page Image';
        $this->load->view('main',$data);
    }
    function edit_page_image($image_id='') {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $image=$this->mod_content->add_image($_POST['h_image']);
            }else {
                $image=$_POST['h_image'];
            }

            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'image_title'=>$_POST['image_title'],
                    'image'=>$image
            );
            $this->db->update('wb_page_image',$data,array('image_id'=>$image_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('content/page_images');
        }
        if($image_id=='') {
            redirect('content/page_images');
        }
        $data=sql::row('wb_page_image','image_id='.$image_id); //Don't Change
        $this->session->set_userdata('image_id',$data['image_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>site_url('content/page_images')),
                array('title'=>'Edit Page Image','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['action']='content/edit_page_image/'.$data['image_id'];
        $data['page']='page_image_form'; //Don't Change
        $data['page_title']='Edit Page Image';
        $this->load->view('main',$data);
    }

    function delete_page_image($image_id='') {
        if($image_id=='') {
            common::redirect();
        }
        $data=sql::row('wb_page_image','image_id='.$image_id);
        if($data['image']!='') {
            $param['dir']=FRONT_UPLOAD_PATH."page_image/";
            $param['type']="jpg,png,gif";
            $this->load->library('zupload',$param);
            $this->zupload->delFile($data['image']);
        }
        sql::delete('wb_page_image','image_id='.$image_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function page_image_status($status='1',$image_id='') {
        if($image_id=='') {
            common::redirect();
        }
        common::change_status('wb_page_image','image_id='.$image_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    function right_contents() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Top Menu','Title','Content','Image', 'Status');
        $gridColumnModel = array(
                array("name" => "m.menu_title",
                        "index" => "m.menu_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "p.title",
                        "index" => "p.image_title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "p.des",
                        "index" => "p.title",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "p.image",
                        "index" => "p.image",
                        "width" => 40,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "p.status",
                        "index" => "p.status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Page Image", 880, 250, "p.title", "asc", $gridColumn, $gridColumnModel, site_url('content/load_right_content'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='right_contents';
        $data['page_title']='Manage Page Image';
        $this->load->view('main',$data);
    }
    function load_right_content() {
        $this->mod_content->get_right_contentGrid();
    }
    function new_right_content() {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $image=$this->mod_content->add_right_image($_POST['h_image']);
            }else {
                $image='';
            }

            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'title'=>$_POST['title'],
                    'des'=>$_POST['des'],
                    'image'=>$image
            );
            $this->db->insert('wb_right_content',$data);
            $this->session->set_flashdata('msg','Successfully Added!!!');
            redirect('content/right_contents');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>site_url('content/right_contents')),
                array('title'=>'Add Page Image','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['action']='content/new_right_content';
        $data['page']='right_content_form'; //Don't Change
        $data['page_title']='Add Sub Page Image';
        $this->load->view('main',$data);
    }
    function edit_right_content($right_content_id='') {
        if($_POST['save']) {
            if($_FILES['image']['name']!='') {
                $image=$this->mod_content->add_right_image($_POST['h_image']);
            }else {
                $image=$_POST['h_image'];
            }
            $data=array(
                    'menu_id'=>$_POST['menu_id'],
                    'title'=>$_POST['title'],
                    'des'=>$_POST['des'],
                    'image'=>$image
            );
            $this->db->update('wb_right_content',$data,array('right_content_id'=>$right_content_id));
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('content/right_contents');
        }
        if($right_content_id=='') {
            redirect('content/right_contents');
        }
        $data=sql::row('wb_right_content','right_content_id='.$right_content_id); //Don't Change
        $this->session->set_userdata('right_content_id',$data['right_content_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Page Image','url'=>site_url('content/right_contents')),
                array('title'=>'Edit Page Image','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['action']='content/edit_right_content/'.$data['right_content_id'];
        $data['page']='right_content_form'; //Don't Change
        $data['page_title']='Edit Page Image';
        $this->load->view('main',$data);
    }

    function delete_right_content($right_content_id='') {
        if($right_content_id=='') {
            common::redirect();
        }
        $data=sql::row('wb_right_content','right_content_id='.$right_content_id);
        if($data['image']!='') {
            $param['dir']=FRONT_UPLOAD_PATH."right_content/";
            $param['type']="jpg,png,gif";
            $this->load->library('zupload',$param);
            $this->zupload->delFile($data['image']);
        }
        sql::delete('wb_right_content','right_content_id='.$right_content_id); //Don't Change
        $this->session->set_flashdata('msg','Deleted Successfully!!!');
        common::redirect();
    }
    function right_content_status($status='1',$right_content_id='') {
        if($right_content_id=='') {
            common::redirect();
        }
        common::change_status('wb_right_content','right_content_id='.$right_content_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }




    function site_logo($site_logo_id='') {
        if($_POST['save']) {
            if($_FILES['logo']['name']!='') {
                $logo=$this->mod_content->add_logo($_POST['h_logo']);
            }else {
                $logo=$_POST['h_logo'];
            }

            $data=array('site_logo'=>$logo);
            if($site_logo_id!='' && is_numeric($site_logo_id)){
                $this->db->update('site_logo',$data,array('site_logo_id'=>$site_logo_id));
            }else{
                $this->db->insert("site_logo",$data);
                $site_logo_id=$this->db->insert_id();
            }
            
            $this->session->set_flashdata('msg','Content Added Successfully!');
            redirect('content/site_logo/'.$site_logo_id);
        }
        if($site_logo_id!=''){
            $data=sql::row('site_logo','site_logo_id='.$site_logo_id);            
        }else{
            $data=sql::row('site_logo','site_logo_id=1');
        }
        $this->session->set_userdata('site_logo_id',$data['site_logo_id']);
        
        $data['nav_array']=array(
                array('title'=>'Manage Site Logo','url'=>site_url('content/site_logo')),
                array('title'=>'Add/Edit Site Logo','url'=>'')
        );
        $data['dir']=$this->dir;

        $data['action']='content/site_logo/'.$data['site_logo_id'];
        $data['page']='logo_form';
        $data['page_title']='Add/Edit Logo';
        $this->load->view('main',$data);
    }
}
?>