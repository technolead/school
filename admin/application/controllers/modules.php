<?php 
/**
 * Description of modules
 *
 * @author anwar
 */

class modules extends Controller {
    function modules() {
        parent::Controller();
        common::is_logged();
        if(!common::user_permit('view','module')||!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->model('mod_modules');
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Subject Name', 'Subject Code','Marks','Subject Type','Inputed By','Status');
        $gridColumnModel = array(
                array("name" => "module_name",
                        "index" => "module_name",
                        "width" => 150,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "module_code",
                        "index" => "module_code",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "marks",
                        "index" => "marks",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "module_type",
                        "index" => "module_type",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "inputed_by",
                        "index" => "inputed_by",
                        "width" => 100,
                        "sortable" => false,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Subject", 750, 250, "module_name", "asc", $gridColumn, $gridColumnModel, site_url('modules/load_module'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Subject','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='modules';
        $data['page']='index';
        $data['page_title']='Manage Subject';
        $this->load->view('main',$data);
    }
    function load_module(){
        $this->mod_modules->get_moduleGrid();
    }
    function new_module() {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_module')) {
                $this->mod_modules->save_module(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('modules');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Subjects','url'=>site_url('modules')),
                array('title'=>'Add New Subject','url'=>'')
        );
        $data['dir']='modules';
        $data['page']='new_module'; //Don't Change
        $data['page_title']='Add Subject';
        $this->load->view('main',$data);
    }
    function edit_module($module_id='') {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_module')) {
                $this->mod_modules->update_module(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('modules');
            }
        }
        if($module_id=='') {
            redirect('modules');
        }
        $data=$this->mod_modules->get_module_details($module_id); //Don't Change
        $this->session->set_userdata('module_id',$data['module_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Subjects','url'=>site_url('modules')),
                array('title'=>'Edit Subject','url'=>'')
        );
        $data['dir']='modules';
        $data['page']='edit_module'; //Don't Change
        $data['page_title']='Edit Subject';
        $this->load->view('main',$data);
    }
    function mapping($class_id='') {
        if($class_id=='all'||$class_id==''||!is_numeric($class_id)) {
            $con='1=1';
        }else {
            $con="mm.class_id=$class_id";
        }
       $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Class Name','Subject Name','Status');
        $gridColumnModel = array(
                
                array("name" => "class_name",
                      "index" => "class_name",
                      "width" => 100,
                      "sortable" => true,
                      "align" => "left",
                      "editable" => false
                ),
                
                array("name" => "module_name",
                      "index" => "module_name",
                      "width" => 100,
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
        $gridObj->setGridOptions("Manage Class", 900, 250, "class_name", "asc", $gridColumn, $gridColumnModel, site_url('modules/load_moduleMap/'.$class_id), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Subject','url'=>'')
        );
        $data['class_id']=$class_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='modules';
        $data['page']='mapping';
        $data['page_title']='Manage Subject';
        $this->load->view('main',$data);
    }
    function load_moduleMap($class_id='all'){
        $this->mod_modules->get_moduleMapGrid($class_id);
    }
    function new_mapping() {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('module_map')) {
                $this->mod_modules->save_mapping(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('modules/mapping');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Subjects','url'=>site_url('modules')),
                array('title'=>'Add New Subject','url'=>'')
        );
        $data['dir']='modules';
        $data['page']='new_mapping'; //Don't Change
        $data['page_title']='Subject Mapping';
        $this->load->view('main',$data);
    }
    function edit_mapping($module_map_id='') {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($module_map_id==''||!is_numeric($module_map_id)) {
            redirect('modules/mapping');
        }
        if($_POST['update']) {
            if($this->form_validation->run('module_map')) {
                $this->mod_modules->update_mapping(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('modules/mapping');
            }
        }
        $data=sql::row('module_map','module_map_id='.$module_map_id);
        $this->session->set_userdata('module_map_id',$data['module_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Modules','url'=>site_url('modules')),
                array('title'=>'Add New Module','url'=>'')
        );
        $data['dir']='modules';
        $data['page']='edit_mapping'; //Don't Change
        $data['page_title']='Subject Mapping';
        $this->load->view('main',$data);
    }
    function delete_module_map($module_map_id='') {
        if(!common::user_permit('delete','class')) {
            common::redirect();
        }
        if($module_map_id==''||!is_numeric($module_map_id)) {
            redirect('modules/mapping');
        }
        sql::delete('module_map',"module_map_id=$module_map_id");
        $this->session->set_flashdata('msg',"Deleted Successfully!!!");
        redirect('modules/mapping');
    }
    function module_map_status($module_map_id='',$status='enabled') {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($module_map_id==''||!is_numeric($module_map_id)) {
            redirect('modules/mapping');
        }
        common::change_status('module_map','module_map_id='.$module_map_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('modules/mapping');
    }
    
    function is_valid_module_map() {
        $levels_id=$_POST['levels_id'];
        $flag=TRUE;
        if($_POST['update']) {
            return TRUE;
        }
        if(count($_POST['module_id'])>0) {
            foreach($_POST['module_id'] as $module_id) {
                if(sql::count('module_map',"module_id=$module_id")>0) {
                    $module_info=sql::row('module',"module_id=$module_id",'module_name');
                    $msg.="<p>The {$module_info['module_name']} is alerady Mapped in this Levels!!</p>";
                    $flag=FALSE;
                }
            }
        }
        if($flag) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_module_map',$msg);
            return FALSE;
        }
    }
    function delete_module($module_id='') {
        if(!common::user_permit('delete','class')) {
            common::redirect();
        }
        if($module_id=='') {
            redirect('modules');
        }
        $this->mod_modules->delete_module($module_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('modules');
    }
    function module_status($module_id='',$status='enabled') {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($module_id=='') {
            redirect('modules');
        }
        common::change_status('module','module_id='.$module_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('modules');
    }
    
    function mng_distribution($staffs_id='') {
        if($staffs_id=='all'||$staffs_id==''||!is_numeric($staffs_id)) {
            $con='1=1';
        }else {
            $con="mm.staffs_id=$staffs_id";
        }
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('modules/mng_distribution/'.$staffs_id.'/');
        $config['total_rows'] = count($this->mod_modules->get_module_distribution($con));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_modules->get_module_distribution($con,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }

        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];

        $data['nav_array']=array(
                array('title'=>'Manage Subject Distribution','url'=>'')
        );
        $data['staffs_id']=$staffs_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='modules';
        $data['page']='mng_distribution';
        $data['page_title']='Manage Subject Distribution';
        $this->load->view('main',$data);
    }
    function module_distribution() {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($_POST['save']) {
            $this->mod_modules->save_module_distribution();
            $this->session->set_flashdata('msg','Added Successfully!!!');
            redirect('modules/mng_distribution');
        }
        $data['nav_array']=array(
                array('title'=>'Manage Subject Distribution','url'=>site_url('modules/mng_distribution')),
                array('title'=>'Subject Distribution','url'=>'')
        );
        $data['dir']='modules';
        $data['page']='module_distribution'; //Don't Change
        $data['page_title']='Subject Distribution';
        $this->load->view('main',$data);
    }
    function edit_distribution($distribution_id='') {
        if(!common::user_permit('add','class')) {
            common::redirect();
        }
        if($distribution_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            $this->mod_modules->update_module_distribution();
            $this->session->set_flashdata('msg','Updated Successfully!!!');
            redirect('modules/mng_distribution');
        }
        $data=sql::row('module_distribution',"distribution_id=$distribution_id");
        $this->session->set_userdata('distribution_id',$data['distribution_id']);
        $data['dir']='modules';
        $data['nav_array']=array(
                array('title'=>'Manage Subject Distribution','url'=>site_url('modules/mng_distribution')),
                array('title'=>'Edit Subject Distribution','url'=>'')
        );
        $data['page']='edit_distribution'; //Don't Change
        $data['page_title']='Edit Subject Distribution';
        $this->load->view('main',$data);
    }
    function delete_distribution($distribution_id='') {
        if(!common::user_permit('delete','class')) {
            common::redirect();
        }
        if($distribution_id=='') {
            common::redirect();
        }
        sql::delete('module_distribution',"distribution_id=$distribution_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }


   
}?>