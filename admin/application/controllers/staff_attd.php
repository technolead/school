<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of staff_attd
 *
 * @author Anwar
 */
class staff_attd extends Controller {

    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_staff_attd');
    }
    function index() {
        $data['nav_array']=array(
                array('title'=>'Select Staff','url'=>'')
        );
        if($_POST['record_attd']) {
            if($this->form_validation->run('is_valid_staff')) {
                $staff_row=sql::row('staffs',"user_name='{$_POST['user_name']}'",'staffs_id');
                redirect('staff_attd/record_attendance/'.$staff_row['staffs_id']);
            }
        }
        if($_POST['manage_attd']) {
            if($this->form_validation->run('is_valid_staff')) {
                $staff_row=sql::row('staffs',"user_name='{$_POST['user_name']}'",'staffs_id');
                redirect('staff_attd/manage_attendance/'.$staff_row['staffs_id']);
            }
        }
        $data['dir']='staff_attd';
        $data['page']='index';
        $data['page_title']='Staffs Attendance';
        $this->load->view('main',$data);
    }
    function record_attendance($staffs_id='') {
        if($staffs_id=='') {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_staff_attd')) {
                $this->mod_staff_attd->save_attendance();
                redirect('staff_attd/manage_attendance/'.$staffs_id);
            }
        }
        $data=sql::row('staffs',"staffs_id=$staffs_id",'staffs_id');
        if($data['staffs_id']=='') {
            common::redirect();
        }
        $this->session->set_userdata('sel_staffs_id',$data['staffs_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Staffs Attendance','url'=>site_url('staffs/manage_staffs')),
                array('title'=>'Record Attendance','url'=>'')
        );
        $data['dir']='staff_attd';
        $data['page']='record_attendance'; //Don't Change
        $data['page_title']='Record Attendance';
        $this->load->view('main',$data);
    }
    function manage_attendance($staffs_id='') {
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        $data=$this->mod_staff_attd->get_staffs_details($staffs_id);
        if($data['staffs_id']=='') {
            common::redirect();
        }

        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('staff_attd/manage_attendance/'.$staffs_id.'/');
        $config['total_rows'] =count($this->mod_staff_attd->get_staffs_attendance($staffs_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=$this->mod_staff_attd->get_staffs_attendance($staffs_id);
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['nav_array']=array(
                array('title'=>'View Staffs Attendance','url'=>site_url('staff_attd/view_attendance')),
                array('title'=>'Manage Staffs Attendance','url'=>'')
        );
        $data['total_attd']=$this->mod_staff_attd->get_total_attendance($staffs_id);
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_attd';
        $data['page']='manage_attendance'; //Don't Change
        $data['page_title']='Record Attendance';
        $this->load->view('main',$data);
    }
    function mng_attendance() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Staff ID", "Staff Name",'Date','Present','Absent','Sick','Holiday','Hours Done','Extra Hours','Absent Hours','Late Hours','Authorize','Comments');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "date",
                        "index" => "date",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "present",
                        "index" => "present",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "absent",
                        "index" => "absent",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "sick",
                        "index" => "sick",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "holiday",
                        "index" => "holiday",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "hours",
                        "index" => "hours",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "extra_hour",
                        "index" => "extra_hour",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "absent_hour",
                        "index" => "absent_hour",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "late",
                        "index" => "late",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "authorize",
                        "index" => "authorize",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "comments",
                        "index" => "comments",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Staffs Attendance", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url("?c=staff_attd&m=load_attendance&user_name={$_POST['user_name']}&name={$_POST['name']}&staff_status={$_POST['staff_status']}&from_date={$_POST[from_date]}&to_date={$_POST[to_date]}"), true);
        }else {
            $gridObj->setGridOptions("Manage Staffs Attendance", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('staff_attd/load_attendance'), true);
        }
        $data['grid_data']=$gridObj->getGrid();
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['nav_array']=array(
                array('title'=>'Manage Staffs Attendance','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_attd';
        $data['page']='mng_attendance'; //Don't Change
        $data['page_title']='Record Attendance';
        $this->load->view('main',$data);
    }
    function load_attendance() {
        $this->mod_staff_attd->get_attendance_grid();
    }
    function valid_attd_filter() {
        $this->form_validation->set_rules('user_name', 'Student ID', '');
        $this->form_validation->set_rules('name', 'Last Name', '');
        $this->form_validation->set_rules('staff_status', 'Staff Status', '');
        $this->form_validation->set_rules('from_date', 'From Date', '');
        $this->form_validation->set_rules('to_date', 'To date', '');
    }
    function edit_attendance($attendance_id='') {
        if($attendance_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_staff_attd')) {
                $this->mod_staff_attd->update_attendance();
                $this->session->set_flashdata('msg','Content Updated Successfully!');
                $url=$this->session->userdata('redirect_url');
                redirect($url);
            }
        }
        $data=sql::row('staffs_attendance',"attendance_id=$attendance_id");
        $this->session->set_userdata('attendance_id',$data['attendance_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Staffs Attendance','url'=>site_url('staff_attd/mng_attendance/')),
                array('title'=>'Edit Staffs Attendance','url'=>'')
        );
        $data['dir']='staff_attd';
        $data['page']='edit_attendance'; //Don't Change
        $data['page_title']='Edit Record Attendance';
        $this->load->view('main',$data);
    }
    function delete_attendance($attendance_id='') {
        if($attendance_id=='') {
            common::redirect();
        }
        sql::delete('staffs_attendance',"attendance_id=$attendance_id");
        $this->session->set_flashdata('msg',"Record Deleted Successfully");
        common::redirect();
    }
    function view_attendance() {
        $this->load->helper('ahdate');
        if($_POST['search']) {
            if($this->form_validation->run('view_staff_attendance')) {
                $data=sql::row('staffs',"user_name='{$_POST['user_name']}'",'staffs_id,user_name');
                if($data['staffs_id']=='') {
                    $data['msg']='Selected Staffs has no attendance record!';
                }else {
                    $this->session->set_userdata('sel_from_date',$_POST['from_date']);
                    $this->session->set_userdata('sel_to_date',$_POST['to_date']);
                    $this->session->set_userdata('sel_month',$_POST['month']);
                    $this->session->set_userdata('sel_year',$_POST['year']);
                    redirect('staff_attd/manage_attendance/'.$data['staffs_id']);
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Staffs Attendance','url'=>site_url('staff_attd/mng_attendance/')),
                array('title'=>'View Staff Attendance','url'=>'')
        );
        $data['dir']='staff_attd';
        $data['page']='view_attendance'; //Don't Change
        $data['page_title']='View Staff Attendance';
        $this->load->view('main',$data);
    }
    function is_valid_staffs() {
        if(sql::count('staffs',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_staffs','Sorry, Staffs ID is invalid!!!');
            return FALSE;
        }
    }
}
?>
