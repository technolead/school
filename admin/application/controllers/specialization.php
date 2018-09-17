<?php 
/**
 * Description of specialization
 *
 * @author anwar
 */

class specialization extends Controller {
    function specialization() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_specialization');
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Awarding Specialization", "Status");
        $gridColumnModel = array(
                array("name" => "specialization_name",
                        "index" => "specialization_name",
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
        $gridObj->setGridOptions("Manage Specialization", 750, 250, "specialization_name", "asc", $gridColumn, $gridColumnModel, site_url('specialization/load_specialization'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Specialization','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='specialization';
        $data['page']='index';
        $data['page_title']='Manage Specialization';
        $this->load->view('main',$data);
    }
    function load_specialization(){
        $this->mod_specialization->get_specializationGrid();
    }
    function new_specialization() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_specialization')) {
                $this->mod_specialization->save_specialization(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('specialization');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Specialization','url'=>site_url('specialization')),
                array('title'=>'Add New Specialization','url'=>'')
        );
        $data['dir']='specialization';
        $data['page']='new_specialization'; //Don't Change
        $data['page_title']='Add New Specialization';
        $this->load->view('main',$data);
    }
    function edit_specialization($specialization_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_specialization')) {
                $this->mod_specialization->update_specialization(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('specialization');
            }
        }
        if($specialization_id=='') {
            redirect('specialization');
        }
        $data=sql::row('specialization','specialization_id='.$specialization_id); //Don't Change
        $this->session->set_userdata('specialization_id',$data['specialization_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Specialization','url'=>site_url('specialization')),
                array('title'=>'Edit Specialization','url'=>'')
        );
        $data['dir']='specialization';
        $data['page']='edit_specialization'; //Don't Change
        $data['page_title']='Edit Specialization';
        $this->load->view('main',$data);
    }
    function new_configuration() {
        $this->load->helper('combo');
        $data['nav_array']=array(
                array('title'=>'Manage Specialization','url'=>site_url('specialization')),
                array('title'=>'Add New Specialization','url'=>'')
        );
        $data['dir']='specialization';
        $data['page']='new_configuration'; //Don't Change
        $data['page_title']='Specialization Configuration';
        $this->load->view('main',$data);
    }
    function details($specialization_id='') {
        if($specialization_id=='') {
            redirect('specialization');
        }
        $data=$this->mod_specialization->get_specialization_details($specialization_id); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Specialization','url'=>site_url('specialization')),
                array('title'=>$data['program_code'],'url'=>'')
        );
        $data['dir']='specialization';
        $data['page']='details'; //Don't Change
        $data['page_title']='Specialization Details';
        $this->load->view('main',$data);
    }
    function delete_specialization($specialization_id='') {
        if($specialization_id=='') {
            redirect('specialization');
        }
        $this->mod_specialization->delete_specialization($specialization_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('specialization');
    }
    function specialization_status($specialization_id='',$status='enabled') {
        if($specialization_id=='') {
            redirect('specialization');
        }
        common::change_status('specialization','specialization_id='.$specialization_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('specialization');
    }
}?>