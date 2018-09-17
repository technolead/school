<?php 
/**
 * Description of session
 *
 * @author anwar
 */

class session extends Controller {
    function session() {
        parent::Controller();
        common::is_logged();
        if(!common::user_permit('view','session')||!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->model('mod_session');
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Session Name','Status');
        $gridColumnModel = array(
                array("name" => "session_name",
                        "index" => "session_name",
                        "width" => 150,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 30,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Session", 750, 250, "session_name", "asc", $gridColumn, $gridColumnModel, site_url('session/load_session'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Session','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='session';
        $data['page']='index';
        $data['page_title']='Manage Session';
        $this->load->view('main',$data);
    }
    function load_session() {
        $this->mod_session->get_sessionGrid();
    }
    function new_session() {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_session')) {
                $this->mod_session->save_session(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('session');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Session','url'=>site_url('session')),
                array('title'=>'Add New Session','url'=>'')
        );
        $data['action']=site_url('session/new_session');
        $data['dir']='session';
        $data['page']='session_form'; 
        $data['page_title']='Add New Session';
        $this->load->view('main',$data);
    }
    function edit_session($session_id='') {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_session')) {
                $this->mod_session->update_session(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('session');
            }
        }
        if($session_id=='') {
            redirect('session');
        }
        $data=sql::row('session','session_id='.$session_id); //Don't Change
        $this->session->set_userdata('edit_session_id',$data['session_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage session','url'=>site_url('session')),
                array('title'=>'Edit session','url'=>'')
        );
        $data['action']=site_url('session/edit_session')."/".$session_id;
        $data['dir']='session';
        $data['page']='session_form';
        $data['page_title']='Edit Session';
        $this->load->view('main',$data);
    }
    function delete_session($session_id='') {
        if(!common::user_permit('delete','session')) {
            common::redirect();
        }
        if($session_id=='') {
            redirect('session');
        }
        $this->mod_session->delete_session($session_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('session');
    }
    function session_status($status='enabled',$session_id='') {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($session_id=='') {
            redirect('session');
        }
        common::change_status('session','session_id='.$session_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('session');
    }
    function mapping($session_id='') {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Awarding Body Name', 'Class Name','Session Name','Duration','Start Date','End Date','Status');
        $gridColumnModel = array(
                array("name" => "awarding_body_name",
                        "index" => "awarding_body_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "class_name",
                        "index" => "class_name",
                        "width" => 120,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "session_name",
                        "index" => "session_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "session_duration",
                        "index" => "session_duration",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "start_date",
                        "index" => "start_date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "end_date",
                        "index" => "end_date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 30,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Session Mappings", 900, 250, "class_name", "asc", $gridColumn, $gridColumnModel, site_url('session/load_sessionMap/'.$session_id), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Session Map','url'=>'')
        );
        $data['session_id']=$session_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='session';
        $data['page']='mapping';
        $data['page_title']='Manage Session Map';
        $this->load->view('main',$data);
    }
    function load_sessionMap($session_id='all') {
        $this->mod_session->get_sessionMapGrid($session_id);
    }
    function new_mapping() {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('session_map')) {
                if($this->mod_session->save_mapping()) {
                    $this->session->set_flashdata('msg','Added Successfully!!!');
                    redirect('session/mapping');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Session Mappings','url'=>site_url('session/mapping')),
                array('title'=>'New Session Map','url'=>'')
        );
        $data['action']=site_url('session/new_mapping');
        $data['dir']='session';
        $data['page']='mapping_form';
        $data['page_title']='Session Mapping';
        $this->load->view('main',$data);
    }
    function edit_mapping($session_map_id='') {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($session_map_id=='') {
            redirect('session/mapping');
        }
        if($_POST['save']) {
            if($this->form_validation->run('session_map')) {
                if($this->mod_session->update_mapping()) {
                    $this->session->set_flashdata('msg','Updated Successfully!!!');
                    redirect('session/mapping');
                }
            }
        }
        $data=sql::row('session_map','session_map_id='.$session_map_id);
        $this->session->set_userdata('session_map_id',$data['session_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage session Mappings','url'=>site_url('session/mapping')),
                array('title'=>'Edit session Map','url'=>'')
        );
        $data['action']=site_url('session/edit_mapping')."/".$session_map_id;
        $data['dir']='session';
        $data['page']='mapping_form';
        $data['page_title']='Edit Session Mapping';
        $this->load->view('main',$data);
    }
    function delete_session_map($session_map_id='') {
        if(!common::user_permit('delete','session')) {
            common::redirect();
        }
        if($session_map_id=='') {
            redirect('session/mapping');
        }
        sql::delete('session_map',"session_map_id=$session_map_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('session/mapping');
    }
    function session_map_status($status='enabled',$session_map_id='') {
        if(!common::user_permit('add','session')) {
            common::redirect();
        }
        if($session_map_id=='') {
            redirect('session/mapping');
        }
        common::change_status('session_map','session_map_id='.$session_map_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('session/mapping');
    }

    function get_session_details() {
        $data=sql::row('session_map',"session_id={$_POST['session_id']}");
        echo $data['start_date'].'##'.$data['end_date'].'##'.$data['session_duration'];
    }
}?>