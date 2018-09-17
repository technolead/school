<?php 
/**
 * Description of awarding_body
 *
 * @author anwar
 */

class awarding_body extends Controller {
    function awarding_body() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_awarding_body');
    }
    function index() {
       $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Awarding Body Name", "Status");
        $gridColumnModel = array(
                array("name" => "awarding_body_name",
                        "index" => "awarding_body_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Awarding Body", 750, 250, "awarding_body_name", "asc", $gridColumn, $gridColumnModel, site_url('awarding_body/load_awarding_body'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Awarding Body','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='awarding_body';
        $data['page']='index';
        $data['page_title']='Manage Awarding Body';
        $this->load->view('main',$data);
    }
    function load_awarding_body(){
        $this->mod_awarding_body->get_gridData();
    }
    function new_awarding_body() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_awarding_body')) {
                $this->mod_awarding_body->save_awarding_body(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('awarding_body');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Awarding Body','url'=>site_url('awarding_body')),
                array('title'=>'Add New Awarding Body','url'=>'')
        );
        $data['dir']='awarding_body';
        $data['page']='new_awarding_body'; //Don't Change
        $data['page_title']='Add New Awarding Body';
        $this->load->view('main',$data);
    }
    function edit_awarding_body($awarding_body_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_awarding_body')) {
                $this->mod_awarding_body->update_awarding_body(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('awarding_body');
            }
        }
        if($awarding_body_id=='') {
            redirect('awarding_body');
        }
        $data=sql::row('awarding_body','awarding_body_id='.$awarding_body_id); //Don't Change
        $this->session->set_userdata('awarding_body_id',$data['awarding_body_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Awarding Body','url'=>site_url('awarding_body')),
                array('title'=>'Edit Awarding Body','url'=>'')
        );
        $data['dir']='awarding_body';
        $data['page']='edit_awarding_body'; //Don't Change
        $data['page_title']='Edit Awarding Body';
        $this->load->view('main',$data);
    }
    function new_configuration() {
        $this->load->helper('combo');
        $data['nav_array']=array(
                array('title'=>'Manage Awarding Body','url'=>site_url('awarding_body')),
                array('title'=>'Add New Awarding Body','url'=>'')
        );
        $data['dir']='awarding_body';
        $data['page']='new_configuration'; //Don't Change
        $data['page_title']='Awarding Body Configuration';
        $this->load->view('main',$data);
    }
    function details($awarding_body_id='') {
        if($awarding_body_id=='') {
            redirect('awarding_body');
        }
        $data=$this->mod_awarding_body->get_awarding_body_details($awarding_body_id); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Awarding Body','url'=>site_url('awarding_body')),
                array('title'=>$data['program_code'],'url'=>'')
        );
        $data['dir']='awarding_body';
        $data['page']='details'; //Don't Change
        $data['page_title']='Awarding Body Details';
        $this->load->view('main',$data);
    }
    function delete_awarding_body($awarding_body_id='') {
        if($awarding_body_id=='') {
            redirect('awarding_body');
        }
        $this->mod_awarding_body->delete_awarding_body($awarding_body_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('awarding_body');
    }
    function awarding_body_status($awarding_body_id='',$status='enabled') {
        if($awarding_body_id=='') {
            redirect('awarding_body');
        }
        common::change_status('awarding_body','awarding_body_id='.$awarding_body_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('awarding_body');
    }
}?>