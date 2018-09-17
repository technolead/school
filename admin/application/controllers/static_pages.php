<?php
/**
 *
 * @author Anwar
 */
class static_pages extends Controller {

    function __construct(){
        parent::Controller();
        common::is_logged_in();
        $this->load->helper('file');
        $this->load->model('mod_static_pages');
    }

    function index(){
        $data['nav_array'] = array(
            array('title' => 'Manage Static Pages', 'url' => '')
        );
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Page Name', 'Page Titile', 'Page Status');
        $gridColumnModel = array(
            array("name" => "page_name",
                "index" => "page_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => false
            ),
            array("name" => "page_title",
                "index" => "page_title",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "status",
                "index" => "status",
                "width" => 50,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        $gridObj->setGridOptions('Manage Static Pages', 880, 250, "page_name", "asc", $gridColumn, $gridColumnModel, site_url('static_pages/load_page/'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['dir']="static_pages";
        $data['page']="index";
        $this->load->view('main',$data);
    }
    function load_page(){
        $this->mod_static_pages->get_page_grid();
    }
    function new_page(){
        
        if($_POST['save']){
            if($this->form_validation->run('valid_page')){
                if($this->mod_static_pages->save_page()){
                    $this->session->set_flashdata('msg','Page Added Successfully!');
                    redirect('static_pages');
                }
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Static Pages', 'url' => site_url('static_pages')),
            array('title' => 'Add New Page', 'url' => '')
        );
        $data['page_title']='Add New Page';
        $data['editor'] = TRUE;
        $data['dir']="static_pages";
        $data['action']='static_pages/new_page';
        $data['page']="page_form";
        $this->load->view('main',$data);
    }
    function edit_page($page_id=''){
        if($page_id==''){
            common::redirect();
        }
        
        if($_POST['save']){
            if($this->form_validation->run('valid_page')){
                if($this->mod_static_pages->update_page($page_id)){
                    $this->session->set_flashdata('msg','Content Updated Successfully!');
                    redirect('static_pages');
                }
            }
        }
        $data=sql::row('wb_static_pages',"page_id='$page_id'");
        //print_r($data);
        $this->session->set_userdata('edit_page_id',$data['page_id']);
        
        $data['page_des']=read_file(FRONT_END."views/static/".$data['page_name'].".php");
        $data['nav_array'] = array(
            array('title' => 'Manage Static Pages', 'url' => site_url('static_pages')),
            array('title' => 'Edit New Page', 'url' => '')
        );
        $data['form_page_title']='Edit New Page';
        $data['editor'] = TRUE;
        $data['dir']="static_pages";
        $data['action']='static_pages/edit_page/'.$data['page_id'];
        $data['page']="page_form";
        $this->load->view('main',$data);
    }
   function delete_page($id='') {
        if ($id == '') {
            common::redirect();
        }
        $data=sql::row('wb_static_pages',"page_id='$id'");
        @unlink(FRONT_END . "views/static/" . $data['page_name'] . ".php");
        sql::delete('wb_static_pages', "page_id='$id'");
        $this->session->set_flashdata('msg', 'Content Deleted Successfully!');
        common::redirect();
    }

    function page_status($status=1, $id='') {

        if ($id == '') {
            common::redirect();
        }
//        echo $this->uri->uri_string();
//        exit;
        $this->db->update('wb_static_pages',array('status'=>$status),array('page_id'=>$id));
        $this->session->set_flashdata('msg', 'Content Status Updated!');
        common::redirect();
    }
}
?>