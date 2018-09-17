<?php 
/**
 * Description of levels
 *
 * @author anwar
 */

class levels extends Controller {
    function levels() {
        parent::Controller();
        $this->load->model('mod_levels');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Level Name', 'Level Code','Inputed By','Status');
        $gridColumnModel = array(
                array("name" => "level_name",
                        "index" => "level_name",
                        "width" => 150,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "level_code",
                        "index" => "level_code",
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
                        "width" => 30,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Levels", 750, 250, "level_name", "asc", $gridColumn, $gridColumnModel, site_url('levels/load_level'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage levels','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='levels';
        $data['page']='index';
        $data['page_title']='Manage levels';
        $this->load->view('main',$data);
    }
    function load_level() {
        $this->mod_levels->get_levelGrid();
    }
    function details($levels_id='') {
        if($levels_id=='') {
            redirect('levels');
        }
        $data=$this->mod_levels->get_levels_details($levels_id); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Levels','url'=>site_url('levels')),
                array('title'=>$data['level_code'],'url'=>'')
        );
        $data['dir']='levels';
        $data['page']='details'; //Don't Change
        $data['page_title']='Levels Details';
        $this->load->view('main',$data);
    }
    function new_level() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_levels')) {
                $this->mod_levels->save_levels(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('levels');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage levels','url'=>site_url('levels')),
                array('title'=>'Add New levels','url'=>'')
        );
        $data['dir']='levels';
        $data['page']='new_level'; //Don't Change
        $data['page_title']='Add New levels';
        $this->load->view('main',$data);
    }

    function edit_level($levels_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_levels')) {
                $this->mod_levels->update_levels(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('levels');
            }
        }
        if($levels_id=='') {
            redirect('levels');
        }
        $data=sql::row('levels','levels_id='.$levels_id); //Don't Change
        $this->session->set_userdata('levels_id',$data['levels_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Levels','url'=>site_url('levels')),
                array('title'=>'Edit Levels','url'=>'')
        );
        $data['dir']='levels';
        $data['page']='edit_level'; //Don't Change
        $data['page_title']='Edit levels';
        $this->load->view('main',$data);
    }
    function delete_levels($levels_id='') {
        if($levels_id=='') {
            redirect('levels');
        }
        $this->mod_levels->delete_levels($levels_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('levels');
    }
    function levels_status($levels_id='',$status='enabled') {
        if($levels_id=='') {
            redirect('levels');
        }
        common::change_status('levels','levels_id='.$levels_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('levels');
    }
    function mapping($programs_id='all') {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Awarding Body Name', 'Program Name','Specialization Name','Level Name','Duration','Fee','Status');
        $gridColumnModel = array(
                array("name" => "awarding_body_name",
                       "index" => "awarding_body_name",
                       "width" => 120,
                       "sortable" => true,
                       "align" => "left",
                       "editable" => false
                ),
                array("name" => "program_name",
                      "index" => "program_name",
                      "width" => 120,
                      "sortable" => true,
                      "align" => "left",
                      "editable" => false
                ),
                array("name" => "specialization_name",
                      "index" => "specialization_name",
                      "width" => 100,
                      "sortable" => true,
                      "align" => "left",
                      "editable" => false
                ),
                array("name" => "level_name",
                      "index" => "level_name",
                      "width" => 50,
                      "sortable" => true,
                      "align" => "left",
                      "editable" => true
                ),
                array("name" => "level_duration",
                      "index" => "level_duration",
                      "width" => 30,
                      "sortable" => true,
                      "align" => "left",
                      "editable" => true
                ),
                 array("name" => "level_fee",
                      "index" => "level_fee",
                      "width" => 30,
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
        $gridObj->setGridOptions("Manage Levels Mappings", 900, 250, "program_name", "asc", $gridColumn, $gridColumnModel, site_url('levels/load_levelMap/'.$programs_id), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Level Mappings','url'=>'')
        );
        $data['programs_id']=$programs_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='levels';
        $data['page']='mapping';
        $data['page_title']='Manage Level Mappings';
        $this->load->view('main',$data);
    }
    function load_levelMap($programs_id='all'){
        $this->mod_levels->get_levelMapGrid($programs_id);
    }
    function new_mapping() {
        $this->load->helpers('combo');
        if($_POST['save']) {
            if($this->form_validation->run('level_map')) {
                $this->mod_levels->save_mapping(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('levels/mapping');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage levels','url'=>site_url('levels')),
                array('title'=>'Add New levels','url'=>'')
        );
        $data['dir']='levels';
        $data['page']='new_mapping'; //Don't Change
        $data['page_title']='Level Mapping';
        $this->load->view('main',$data);
    }
    function edit_mapping($level_map_id='') {
        if($level_map_id=='') {
            redirect('levels/mapping');
        }
        $this->load->helpers('combo');
        if($_POST['update']) {
            if($this->form_validation->run('level_map')) {
                $this->mod_levels->update_mapping(); //Don't Change
                $this->session->set_flashdata('msg','Updated Successfully!!!');
                redirect('levels/mapping');
            }
        }
        $data=sql::row('level_map','level_map_id='.$level_map_id);
        $this->session->set_userdata('level_map_id',$data['level_map_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Level Mapping','url'=>site_url('levels')),
                array('title'=>'Edit Level Mapping','url'=>'')
        );
        $data['dir']='levels';
        $data['page']='edit_mapping'; //Don't Change
        $data['page_title']='Edit Level Mapping';
        $this->load->view('main',$data);
    }
    function delete_level_map($level_map_id='') {
        if($level_map_id=='') {
            redirect('levels/mapping');
        }
        sql::delete('level_map','level_map_id='.$level_map_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('levels/mapping');
    }
    function level_map_status($level_map_id='',$status='enabled') {
        if($level_map_id=='') {
            redirect('levels/mapping');
        }
        common::change_status('level_map','level_map_id='.$level_map_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('levels/mapping');
    }
    function get_levels_info() {
        if($_POST['levels_id']!='') {
            $data=sql::row('level_map',"levels_id={$_POST['levels_id']}",'level_duration');
        }
        echo $data['level_duration'];
    }
    function levels_reg_info() {
        if($_POST['levels_id']!='') {
            $sql=$this->db->query("select rl.*,l.level_duration from reg_level as rl
								join level_map as l on l.levels_id=rl.levels_id where rl.student_id={$_POST['student_id']} and rl.levels_id={$_POST['levels_id']}");
            $data=$sql->row_array();
        }
        echo $data['level_duration'].'##'.$data['level_start_date'].'##'.$data['level_end_date'].'##'.$data['level_extd_date'];
    }
}?>