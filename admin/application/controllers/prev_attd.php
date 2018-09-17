<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of prev_attd
 *
 * @author Anwar
 */
class prev_attd extends Controller {
    private $dir='prev_attd';
    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_prev_attd');
    }
    function index() {

        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('SN', 'Student ID', 'Student Name','Class','Date','Attendance (%)');
        $gridColumnModel = array(
                array("name" => "sn",
                        "index" => "sn",
                        "width" => 30,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "class_name",
                        "index" => "class_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "attd_date",
                        "index" => "attd_date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "attd_attendance",
                        "index" => "attd_attendance",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if($_POST['search']) {
            $gridObj->setGridOptions('Previous cumulative attendance', 880, 200, "user_name", "asc", $gridColumn, $gridColumnModel, site_url("?c=prev_attd&m=load_attd_grid&user_name={$_POST['user_name']}&class_id={$_POST['class_id']}&attd_date={$_POST['attd_date']}"), true);
        }else {
            $gridObj->setGridOptions('Previous cumulative attendance', 880, 200, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('prev_attd/load_attd_grid'), true);
        }
        $data['nav_array']=array(
                array('title'=>'Previous cumulative attendance','url'=>'')
        );
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = $this->dir;
        $data['page'] = 'index';
        $data['page_title'] = 'Previous cumulative attendance';
        $this->load->view('main', $data);
    }

    function load_attd_grid() {
        $this->mod_prev_attd->get_attd_grid();
    }

    function new_attd() {
        if($_POST['find']) {
            $this->valid_attd();
            if($this->form_validation->run()) {
                $this->session->set_userdata('sess_class_id',$_POST['class_id']);
                //$this->session->set_userdata('sess_attd_date',$_POST['attd_date']);
                $data['rows']=$this->mod_prev_attd->get_class_reg_student();
            }
        }

        if($_POST['save']) {
            $this->valid_attd();
            if($this->form_validation->run()) {
                $this->session->set_userdata('sess_class_id',$_POST['class_id']);
                $this->mod_prev_attd->save_prev_attd();
                $this->session->set_flashdata('msg','Content Added Successfully!');
                redirect('prev_attd');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Previous cumulative attendance','url'=>site_url('prev_attd')),
                array('title'=>'Add attendance','url'=>'')
        );
        $data['dir'] = $this->dir;
        $data['page'] = 'new_attd';
        $data['page_title'] = 'Previous cumulative attendance';
        $this->load->view('main', $data);
    }
    function valid_attd() {
        $this->form_validation->set_rules('class_id', 'Class', 'required');
        $this->form_validation->set_rules('attd_date', 'Attendance Date', 'required');
    }
    function edit_attd($attd_id='') {
        if($attd_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            $this->mod_prev_attd->update_prev_attd();
            $this->session->set_flashdata('msg','Content Updated Successfully!');
            redirect('prev_attd');
        }
        $data['nav_array']=array(
                array('title'=>'Previous cumulative attendance','url'=>site_url('prev_attd')),
                array('title'=>'Edit attendance','url'=>'')
        );
        $data['row']=$this->mod_prev_attd->get_attd_details($attd_id);
        $this->session->set_userdata('attd_id',$data['row'][attd_id]);
        $data['dir'] = $this->dir;
        $data['page'] = 'edit_attd';
        $data['page_title'] = 'Previous cumulative attendance';
        $this->load->view('main', $data);
    }
    function delete_attd($id='') {
        if ($id == '') {
            common::redirect();
        }
        sql::delete('prev_attd', "attd_id='$id'");
        $this->session->set_flashdata('msg', 'Content Deleted Successfully!');
        common::redirect();
    }
}
?>
