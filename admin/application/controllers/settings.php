<?php

class settings extends Controller {
    private $dir='settings';
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_settings');
    }
    function index() {
        if($_POST['update']) {
            if($this->mod_settings->update_settings(2)) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data=$this->mod_settings->get_settings_data();
        $data['nav_array']=array(
                array('title'=>'Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Site Settings";
        $data['dir']=$this->dir;
        $data['page']='index';
        $this->load->view('main',$data);
    }
    function websetting() {
        if($_POST['update']) {
            if($this->mod_settings->update_settings(4)) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data=$this->mod_settings->get_settings_data();
        $data['nav_array']=array(
                array('title'=>'Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Site Settings";
        $data['dir']=$this->dir;
        $data['page']='websetting';
        $this->load->view('main',$data);
    }
    function contact() {
        if($_POST['update']) {
            if($this->mod_settings->update_settings(3)) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data=$this->mod_settings->get_settings_data();
        $data['nav_array']=array(
                array('title'=>'Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Site Settings";
        $data['dir']=$this->dir;
        $data['page']='contact';
        $this->load->view('main',$data);
    }
    function set_attendance() {
        if($_POST['update']) {
            if($this->mod_settings->update_settings(1)) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data=$this->mod_settings->get_settings_data();
        $data['nav_array']=array(
                array('title'=>'Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Attendance Settings";
        $data['dir']=$this->dir;
        $data['page']='set_attendance';
        $this->load->view('main',$data);
    }
    function change_password() {
        if($_POST['change_password']) {
            if($this->form_validation->run('valid_change_password')) {
                if($this->mod_settings->do_update_password()) {
                    $this->session->set_flashdata('msg','Your Password changed Successfully!!!');
                    redirect('settings/change_password');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Change Password','url'=>'')
        );
        $data['dir']=$this->dir;
        $data['msg']=$this->session->flashdata('msg');
        $data['page']='change_password';
        $data['page_title']='Change Password';
        $this->load->view('main',$data);
    }
    function is_valid_user_password() {
        if(!$this->mod_settings->confirm_password()) {
            $this->form_validation->set_message('is_valid_user_password','Invalid Old Password');
            return false;
        }else {
            return true;
        }
    }

    function branch() {
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('Branch Name', 'Inputed By', 'Status');
        $gridColumnModel = array(
            array("name" => "branch_name",
                "index" => "branch_name",
                "width" => 150,
                "sortable" => true,
                "align" => "center",
                "editable" => false
            ),
            
            array("name" => "inputed_by",
                "index" => "inputed_by",
                "width" => 100,
                "sortable" => false,
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
        $gridObj->setGridOptions("Manage Branch", 750, 250, "branch_name", "asc", $gridColumn, $gridColumnModel, site_url('settings/load_branch'), true);
        $data['grid_data'] = $gridObj->getGrid();


        $data['nav_array'] = array(
            array('title' => 'Manage Branch', 'url' => '')
        );
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'branch';
        $data['page_title'] = 'Manage Branch';
        $this->load->view('main', $data);
    }

    function load_branch() {
        $this->mod_settings->get_branchGrid();
    }

    function new_branch() {
        if (!common::user_permit('add', 'branch')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_branch')) {
                $this->mod_settings->save_branch();
                $this->session->set_flashdata('msg', 'Successfully Added!!!');
                redirect('settings/branch');
            }
        }
        $data['nav_array'] = array(
            array('title' => 'Manage Branch', 'url' => site_url('settings/branch')),
            array('title' => 'Add New Branch', 'url' => '')
        );
        $data['action'] = site_url('settings/new_branch');
        $data['dir'] = 'settings';
        $data['page'] = 'branch_form';
        $data['page_title'] = 'Add New Branch';
        $this->load->view('main', $data);
    }

    function edit_branch($branch_id='') {
        if (!common::user_permit('add', 'branch')) {
            common::redirect();
        }
        if ($_POST['save']) {
            if ($this->form_validation->run('valid_branch')) {
                $this->mod_settings->update_branch(); //Don't Change
                $this->session->set_flashdata('msg', 'Successfully Updated!!!');
                redirect('settings/branch');
            }
        }
        if ($branch_id == '') {
            redirect('settings/branch');
        }
        $data = $this->mod_settings->get_branch_details($branch_id);
        $this->session->set_userdata('edit_branch_id', $data['branch_id']);
        $data['nav_array'] = array(
            array('title' => 'Manage Branch', 'url' => site_url('settings/branch')),
            array('title' => 'Edit Branch', 'url' => '')
        );
        
        $data['action'] = site_url('settings/edit_branch') . "/" . $branch_id;
        $data['dir'] = 'settings';
        $data['page'] = 'branch_form';
        $data['page_title'] = 'Edit Branch';
        $this->load->view('main', $data);
    }

    function delete_branch($branch_id='') {
        if (!common::user_permit('delete', 'branch')) {
            common::redirect();
        }
        if ($branch_id == '') {
            redirect('settings/branch');
        }
        sql::delete("branch","branch_id=$branch_id");
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('settings/branch');
    }

    function branch_status($status='enabled', $branch_id='') {
        if (!common::user_permit('add', 'branch')) {
            common::redirect();
        }
        if ($branch_id == '') {
            redirect('settings/branch');
        }
        common::change_status('branch', 'branch_id=' . $branch_id, $status);
        $this->session->set_flashdata('msg', 'Status Updated!!!');
        redirect('settings/branch');
    }


    function set_grade() {
        if($_POST['update']) {
            if($this->mod_settings->update_grade()) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data['grade']=sql::rows("grade_settings");
        $data['nav_array']=array(
                array('title'=>'Grade Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Grade Settings";
        $data['dir']=$this->dir;
        $data['page']='set_grade';
        $this->load->view('main',$data);
    }

    function set_marking() {
        if($_POST['update']) {
            if($this->mod_settings->update_settings(5)) {
                $msg="Settings Updated Successfully!!!";
            }
        }

        $data=$this->mod_settings->get_settings_data();
        $data['nav_array']=array(
                array('title'=>'Settings','url'=>'')
        );

        $data['msg']=$msg;
        $data['page_title']="Mark Settings";
        $data['dir']=$this->dir;
        $data['page']='set_mark';
        $this->load->view('main',$data);
    }


}
?>
