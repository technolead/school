<?php
/**
 * Description of staffs
 *
 * @author anwar
 */

class staffs extends Controller {
    function staffs() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_staffs');
    }
    function index($department_id='all') {
        if(!common::is_staff_user()) {
            common::redirect();
        }
        $this->load->model(array('mod_notice'));
        $this->load->helper('text');
        $data['msg']=$this->session->flashdata('msg');
        $data['notice']=$this->mod_notice->get_issued_notice('Staffs');
        //$data['enquiry']=$this->mod_enquiry->get_enquiry_msg($this->session->userdata('logged_staffs_id'));
        $data['dir']='staffs';
        $data['page']='index';
        $data['page_title']='Staffs';
        $this->load->view('main',$data);
    }
    function manage_staffs($department_id='all') {
        if(!common::user_permit('view','staffs')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Staff ID", "Staff Name",'Department','Designation','E. Type','E. Nature','Status');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 65,
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
                array("name" => "department_name",
                        "index" => "department_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "designation",
                        "index" => "designation",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "employ_type",
                        "index" => "employ_type",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "employ_nature",
                        "index" => "employ_nature",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                
                array("name" => "status",
                        "index" => "status",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if ($_POST['apply_filter']) {
            
            $this->valid_filter();
            if ($this->form_validation->run()) {
                
                $this->settings_data();
            }
            $gridObj->setGridOptions("Manage Staffs", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=staffs&m=load_staffs&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), true);
        } else {
            
            $gridObj->setGridOptions("Manage Staffs", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('staffs/load_staffs'), true);

        }
        $data['grid_data']=$gridObj->getGrid();


        $data['nav_array']=array(
                array('title'=>'Manage Staffs','url'=>'')
        );
        $data['department_id']=$department_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staffs';
        $data['page']='manage_staffs';
        $data['page_title']='Manage Staffs';
        $this->load->view('main',$data);
    }
    function load_staffs() {
        
        $this->mod_staffs->get_staffGridData();
    }
    function valid_filter() {
        $this->form_validation->set_rules('user_name', 'Student ID', '');
        $this->form_validation->set_rules('name', 'Last Name', '');
        $this->form_validation->set_rules('date_of_birth', 'Last Name', '');
        $this->form_validation->set_rules('staff_status', 'Staff Status', '');
        /*$this->form_validation->set_rules('pass_from_date', 'From Date', '');
        $this->form_validation->set_rules('pass_to_date', 'To date', '');
        $this->form_validation->set_rules('visa_from_date', 'From Date', '');
        $this->form_validation->set_rules('visa_to_date', 'To date', '');*/
    }

    function settings_data() {
        $this->session->set_userdata('staff_user_name', $_POST['user_name']);
        $this->session->set_userdata('staff_name', $_POST['name']);
        $this->session->set_userdata('staff_status', $_POST['staff_status']);
        $this->session->set_userdata('date_of_birth', $_POST['date_of_birth']);
        //have to edit for manage_staffs.php page search options
    }
    function profile($staffs_id='') {
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        $data=$this->mod_staffs->get_staffs_details($staffs_id);
        $data['nav_array']=array(
                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
                array('title'=>$data['first_name'].' '.$data['last_name'],'url'=>'')
        );
        $data['qualifications']=sql::rows('staff_qualifications',"staffs_id=$staffs_id");
        $data['shifts']=sql::rows('staff_shift',"staffs_id=$staffs_id");
        $data['rows']=$this->mod_staffs->get_assigned_module($staffs_id);
        $data['dir']='staffs';
        $data['page']='profile'; //Don't Change
        $data['page_title']='Staffs Details View';
        $this->load->view('main',$data);
    }
    function new_staff($part='basic') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['continue']) {
            if($this->form_validation->run('staff_basic')) {
                $staffs_id=$this->mod_staffs->save_staff();//Don't Change
                $this->mod_staffs->save_qualifiaction($staffs_id);
                $this->mod_staffs->save_experience($staffs_id);
                $this->session->set_userdata('con_staff_id',$staffs_id);
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('staffs/new_staff/contract');
            }
        }
        if($_POST['finish']) {
            if($this->form_validation->run('staff_contract')) {
                $this->mod_staffs->save_staff_contract(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('staffs/manage_staffs');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
                array('title'=>'Add New Staff','url'=>'')
        );
        $data['part']=$part;
        $data['dir']='staffs';
        $data['page']='new_staff'; //Don't Change
        $data['page_title']='Add New staff';
        $this->load->view('main',$data);
    }
    function edit_staff($staffs_id='',$part='edit_basic') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('staff_basic')) {
                $this->mod_staffs->update_staff(); //Don't Change
                $staffs_id=$this->session->userdata('staffs_id');
                sql::delete('staff_qualifications',"staffs_id=$staffs_id");
                sql::delete('staff_experience',"staffs_id=$staffs_id");
                $this->mod_staffs->save_qualifiaction($staffs_id);
                $this->mod_staffs->save_experience($staffs_id);
                $this->session->set_flashdata('msg','Staff content updated Successfully!!!');
                redirect('staffs/manage_staffs');
            }
        }
        if($_POST['continue']) {
            
            if($this->form_validation->run('staff_basic')) {
                $this->mod_staffs->update_staff();//Don't Change
                $staffs_id=$this->session->userdata('staffs_id');
                sql::delete('staff_qualifications',"staffs_id=$staffs_id");
                sql::delete('staff_experience',"staffs_id=$staffs_id");
                $this->mod_staffs->save_qualifiaction($staffs_id);
                $this->mod_staffs->save_experience($staffs_id);
                $this->session->set_flashdata('msg','Updated Successfully!!!');
                redirect("staffs/edit_staff/".$staffs_id."/edit_contract");
            }
        }
        if($_POST['finish']) {
            if($this->form_validation->run('staff_contract')) {
                $this->mod_staffs->update_staff_contract(); //Don't Change
                $this->session->set_flashdata('msg','Updated Successfully!!!');
                redirect('staffs/manage_staffs');
            }
        }
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        $data=sql::row('staffs','staffs_id='.$staffs_id); //Don't Change
        $this->session->set_userdata('staffs_id',$data['staffs_id']); //Don't Change
        if($part=='edit_contract') {
            $data=sql::row('staff_contract','staffs_id='.$staffs_id);
            if($data['staff_contract_id']=='') {
                $this->session->set_userdata('con_staff_id',$staffs_id);
                redirect('staffs/new_staff/contract');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
                array('title'=>'Edit Staff','url'=>'')
        );
        $data['part']=$part;
        $data['dir']='staffs';
        $data['page']='edit_staff'; //Don't Change
        $data['page_title']='Edit Staff';
        $this->load->view('main',$data);
    }

    function print_view($staffs_id='') {
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        $data=$this->mod_staffs->get_staffs_details($staffs_id);
        $data['qualifications']=sql::rows('staff_qualifications',"staffs_id=$staffs_id");
        $data['shifts']=sql::rows('staff_shift',"staffs_id=$staffs_id");
        $data['dir']='staffs';
        $data['page']='print_view'; //Don't Change
        $data['page_title']='Staffs Details View';
        $this->load->view('print_main',$data);
    }
    function delete_staffs($staffs_id='') {
        if(!common::user_permit('delete','staffs')) {
            common::redirect();
        }
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        sql::delete('staff_contract',"staffs_id=$staffs_id");
        sql::delete('staff_qualifications',"staffs_id=$staffs_id");
        sql::delete('staff_shift',"staffs_id=$staffs_id");
        sql::delete('staffs',"staffs_id=$staffs_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('staffs/manage_staffs');
    }
    function staffs_status($staffs_id='',$status='enabled') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($staffs_id=='') {
            redirect('staffs/manage_staffs');
        }
        common::change_status('staffs','staffs_id='.$staffs_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('staffs/manage_staffs');
    }
    function department() {
        if(!common::user_permit('view','staffs')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Department','Status');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 65,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Staffs", 900, 250, "name", "asc", $gridColumn, $gridColumnModel, site_url('staffs/load_department'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Staff Department','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staffs';
        $data['page']='department';
        $data['page_title']='Manage Staff Department';
        //$data['rows']=sql::rows('staff_department','1=1 order by name');
        $this->load->view('main',$data);
    }
    function load_department(){
        $this->mod_staffs->get_departmentGrid();
    }
    function new_department() {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_department')) {
                $this->mod_staffs->save_staff_department(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('staffs/department');
            }
        }

        $data['nav_array']=array(
                array('title'=>'Manage Staff Department','url'=>site_url('staffs/department')),
                array('title'=>'Add New Staff Department','url'=>'')
        );
        $data['dir']='staffs';
        $data['page']='new_department'; //Don't Change
        $data['page_title']='Add New Staff Department';
        $this->load->view('main',$data);
    }
    function edit_department($staff_department_id='') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('staff_department')) {
                $this->mod_staffs->update_staff_department(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('staffs/department');
            }
        }
        if($staff_department_id=='') {
            redirect('staffs/department');
        }
        $data=sql::row('staff_department',"staff_department_id=$staff_department_id");
        $this->session->set_userdata('staff_department_id',$data['staff_department_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Staff Department','url'=>site_url('staffs/department')),
                array('title'=>'Edit Staff Department','url'=>'')
        );
        $data['dir']='staffs';
        $data['page']='edit_department'; //Don't Change
        $data['page_title']='Edit Staff Department';
        $this->load->view('main',$data);
    }
    function delete_staff_department($staff_department_id='') {
        if(!common::user_permit('delete','staffs')) {
            common::redirect();
        }
        if($staff_department_id=='') {
            redirect('staffs/department');
        }
        sql::delete('staff_department','staff_department_id='.$staff_department_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('staffs/department');
    }
    function staff_department_status($staff_department_id='',$status='enabled') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($staff_department_id=='') {
            redirect('staffs/department');
        }
        common::change_status('staff_department','staff_department_id='.$staff_department_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('staffs/department');
    }
    function get_ajax_content() {
        $this->load->helper('combo');
        $day=combo::get_day_options();
        $institutions=combo::get_institution_options();
        $shift=$this->mod_staffs->get_shift_options();
        echo $day.'#'.$institutions.'#'.$shift;
    }
// Staff Attendance
//    function record_attendance($staffs_id='') {
//        if($staffs_id=='') {
//            redirect('staffs/manage_staffs');
//        }
//        if($_POST['save']) {
//            if($this->form_validation->run('valid_staff_attd')) {
//                $this->mod_staffs->save_attendance();
//                redirect('staffs/manage_attendance/'.$staffs_id);
//            }
//        }
//        $data=sql::row('staffs',"staffs_id=$staffs_id",'staffs_id');
//        if($data['staffs_id']=='') {
//            redirect('staffs/manage_staffs');
//        }
//        $this->session->set_userdata('sel_staffs_id',$data['staffs_id']);
//        $data['nav_array']=array(
//                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
//                array('title'=>'Record Attendance','url'=>'')
//        );
//        $data['dir']='staffs';
//        $data['page']='record_attendance'; //Don't Change
//        $data['page_title']='Record Attendance';
//        $this->load->view('main',$data);
//    }
//    function manage_attendance($staffs_id='') {
//        if($staffs_id=='') {
//            redirect('staffs/manage_staffs');
//        }
//        $data=$this->mod_staffs->get_staffs_details($staffs_id);
//        if($data['staffs_id']=='') {
//            redirect('staffs/manage_staffs');
//        }
//
//        /*-----------------Pagination--------------*/
//        $this->load->library('pagination');
//        $start=$this->uri->segment(4);
//        if($start=='') {
//            $start=0;
//        }
//        $config['uri_segment'] = 4;
//        $config['base_url'] = site_url('staffs/manage_attendance/'.$staffs_id.'/');
//        $config['total_rows'] =count($this->mod_staffs->get_staffs_attendance($staffs_id));
//        $config['per_page'] = 20;
//        $config['next_link'] = "Next &raquo;";
//        $config['prev_link'] = "&laquo; Previous";
//        $this->pagination->initialize($config);
//        $data['pagination_links']=$this->pagination->create_links();
//
//        $data['rows']=$this->mod_staffs->get_staffs_attendance($staffs_id);
//        if(count($data['rows'])>0) {
//            $data['start']=$start+1;
//        }else {
//            $data['start']=$start;
//        }
//        $data['end']=$start+count($data['rows']);
//        $data['total']=$config['total_rows'];
//        /*-----------------End Pagination--------------*/
//        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
//        $data['nav_array']=array(
//                array('title'=>'View Staffs Attendance','url'=>site_url('staffs/view_attendance')),
//                array('title'=>'Manage Staffs Attendance','url'=>'')
//        );
//        $data['total_attd']=$this->mod_staffs->get_total_attendance($staffs_id);
//        $data['msg']=$this->session->flashdata('msg');
//        $data['dir']='staffs';
//        $data['page']='manage_attendance'; //Don't Change
//        $data['page_title']='Record Attendance';
//        $this->load->view('main',$data);
//    }
//    function mng_attendance() {
//        /*-----------------Pagination--------------*/
//        $this->load->library('pagination');
//        $start=$this->uri->segment(3);
//        if($start=='') {
//            $start=0;
//        }
//        $config['uri_segment'] = 3;
//        $config['base_url'] = site_url('staffs/mng_attendance/');
//
//        $config['per_page'] = 20;
//        $config['next_link'] = "Next &raquo;";
//        $config['prev_link'] = "&laquo; Previous";
//        $this->pagination->initialize($config);
//        $data['pagination_links']=$this->pagination->create_links();
//        if($_POST['apply_filter']) {
//            $this->valid_attd_filter();
//            if($this->form_validation->run()) {
//                $num=count($this->mod_staffs->filter_attendance());
//                $config['per_page'] = $num;
//                $config['total_rows'] =$num;
//                $data['rows']=$this->mod_staffs->filter_attendance();
//            }
//        }else {
//            $config['total_rows'] =count($this->mod_staffs->get_attendance());
//            $data['rows']=$this->mod_staffs->get_attendance("limit $start,{$config['per_page']}");
//        }
//        $this->pagination->initialize($config);
//        $data['pagination_links']=$this->pagination->create_links();
//
//        if(count($data['rows'])>0) {
//            $data['start']=$start+1;
//        }else {
//            $data['start']=$start;
//        }
//        $data['end']=$start+count($data['rows']);
//        $data['total']=$config['total_rows'];
//        /*-----------------End Pagination--------------*/
//        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
//        $data['nav_array']=array(
//                array('title'=>'Manage Staffs Attendance','url'=>'')
//        );
//        $data['msg']=$this->session->flashdata('msg');
//        $data['dir']='staffs';
//        $data['page']='mng_attendance'; //Don't Change
//        $data['page_title']='Record Attendance';
//        $this->load->view('main',$data);
//    }
//    function valid_attd_filter() {
//        $this->form_validation->set_rules('user_name', 'Student ID', '');
//        $this->form_validation->set_rules('name', 'Last Name', '');
//        $this->form_validation->set_rules('staff_status', 'Staff Status', '');
//        $this->form_validation->set_rules('from_date', 'From Date', '');
//        $this->form_validation->set_rules('to_date', 'To date', '');
//    }
//    function edit_attendance($attendance_id='') {
//        if($attendance_id=='') {
//            common::redirect();
//        }
//        if($_POST['update']) {
//            if($this->form_validation->run('valid_staff_attd')) {
//                $this->mod_staffs->update_attendance();
//                $url=$this->session->userdata('redirect_url');
//                redirect($url);
//            }
//        }
//        $data=sql::row('staffs_attendance',"attendance_id=$attendance_id");
//        $this->session->set_userdata('attendance_id',$data['attendance_id']);
//        $data['nav_array']=array(
//                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
//                array('title'=>'Edit Staffs Attendance','url'=>'')
//        );
//        $data['dir']='staffs';
//        $data['page']='edit_attendance'; //Don't Change
//        $data['page_title']='Edit Record Attendance';
//        $this->load->view('main',$data);
//    }
//    function delete_attendance($attendance_id='') {
//        if($attendance_id=='') {
//            common::redirect();
//        }
//        sql::delete('staffs_attendance',"attendance_id=$attendance_id");
//        $this->session->set_flashdata('msg',"Record Deleted Successfully");
//        common::redirect();
//    }
//    function view_attendance() {
//        $this->load->helper('ahdate');
//        if($_POST['search']) {
//            if($this->form_validation->run('view_staff_attendance')) {
//                $data=sql::row('staffs',"user_name='{$_POST['user_name']}'",'staffs_id,user_name');
//                if($data['staffs_id']=='') {
//                    $data['msg']='Selected Staffs has no attendance record!';
//                }else {
//                    $this->session->set_userdata('sel_from_date',$_POST['from_date']);
//                    $this->session->set_userdata('sel_to_date',$_POST['to_date']);
//                    $this->session->set_userdata('sel_month',$_POST['month']);
//                    $this->session->set_userdata('sel_year',$_POST['year']);
//                    redirect('staffs/manage_attendance/'.$data['staffs_id']);
//                }
//            }
//        }
//        $data['nav_array']=array(
//                array('title'=>'Manage Staffs','url'=>site_url('staffs/manage_staffs')),
//                array('title'=>'View Staff Attendance','url'=>'')
//        );
//        $data['dir']='staffs';
//        $data['page']='view_attendance'; //Don't Change
//        $data['page_title']='View Staff Attendance';
//        $this->load->view('main',$data);
//    }
    //End Attendance
    function is_valid_staffs() {
        if(sql::count('staffs',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_staffs','Sorry, Staffs ID is invalid!!!');
            return FALSE;
        }
    }
    function get_staff_list() {
        $data=$this->mod_staffs->get_staff_list();
        echo $data;
    }

    function designation() {
        if(!common::user_permit('view','staffs')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Designation','MPO Scale','Inputed By');
        $gridColumnModel = array(
                array("name" => "designation",
                        "index" => "designation",
                        "width" => 65,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "mpo_scale",
                        "index" => "mpo_scale",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "inputed_by",
                        "index" => "inputed_by",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Staff Designation", 750, 250, "designation", "asc", $gridColumn, $gridColumnModel, site_url('staffs/load_designation'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Staff Designation','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staffs';
        $data['page']='designation';
        $data['page_title']='Manage Staff Designation';
        $this->load->view('main',$data);
    }
    function load_designation(){
        $this->mod_staffs->get_designationGrid();
    }
    function new_designation() {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_designation')) {
                $this->mod_staffs->save_staff_designation();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('staffs/designation');
            }
        }

        $data['nav_array']=array(
                array('title'=>'Manage Staff Designation','url'=>site_url('staffs/designation')),
                array('title'=>'Add New Staff Designation','url'=>'')
        );
        $data['action']="staffs/new_designation";
        $data['submit_value']="Save";
        $data['dir']='staffs';
        $data['page']='designation_form';
        $data['page_title']='Add New Staff Designation';
        $this->load->view('main',$data);
    }
    function edit_designation($staff_designation_id='') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($staff_designation_id=='') {
            redirect('staffs/designation');
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_designation')) {
                $this->mod_staffs->update_staff_designation();
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('staffs/designation');
            }
        }
        
        $data=sql::row('staff_designation',"staff_designation_id=$staff_designation_id");
        $this->session->set_userdata('staff_designation_id',$data['staff_designation_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Staff Designation','url'=>site_url('staffs/designation')),
                array('title'=>'Edit Staff Designation','url'=>'')
        );
        $data['action']="staffs/edit_designation/".$staff_designation_id;
        $data['submit_value']="Update";
        $data['dir']='staffs';
        $data['page']='designation_form';
        $data['page_title']='Edit Staff Designation';
        $this->load->view('main',$data);
    }
    function delete_designation($staff_designation_id='') {
        if(!common::user_permit('delete','staffs')) {
            common::redirect();
        }
        if($staff_designation_id=='') {
            redirect('staffs/designation');
        }
        sql::delete('staff_designationt','staff_designation_id='.$staff_designation_id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('staffs/designation');
    }



    /*  Staff Training */

    function training() {
        if(!common::user_permit('view','staffs')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('Training Title','Increment Amount','Inputed By');
        $gridColumnModel = array(
                array("name" => "training_title",
                        "index" => "training_title",
                        "width" => 65,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "increment",
                        "index" => "increment",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Staff Training", 900, 250, "training_title", "asc", $gridColumn, $gridColumnModel, site_url('staffs/load_training'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Staff Training','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staffs';
        $data['page']='training';
        $data['page_title']='Manage Staff Trainig';        
        $this->load->view('main',$data);
    }
    function load_training(){
        $this->mod_staffs->get_trainingGrid();
    }
    function new_training() {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_training')) {
                $this->mod_staffs->save_staff_training();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('staffs/training');
            }
        }

        $data['nav_array']=array(
                array('title'=>'Manage Staff Training','url'=>site_url('staffs/training')),
                array('title'=>'Add New Staff Training','url'=>'')
        );
        $data['action']="staffs/new_training";
        $data['dir']='staffs';
        $data['page']='training_form';
        $data['page_title']='Add New Staff Training';
        $this->load->view('main',$data);
    }
    function edit_training($training_id='') {
        if(!common::user_permit('add','staffs')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_training')) {
                $this->mod_staffs->update_staff_training();
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('staffs/training');
            }
        }
        if($training_id=='') {
            redirect('staffs/training');
        }
        $data=sql::row('staff_training',"training_id=$training_id");
        $this->session->set_userdata('training_id',$data['training_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Staff Training','url'=>site_url('staffs/training')),
                array('title'=>'Edit Staff Training','url'=>'')
        );
        $data['action']="staffs/edit_training";
        $data['dir']='staffs';
        $data['page']='training_form';
        $data['page_title']='Edit Staff Training';
        $this->load->view('main',$data);
    }
    function delete_staff_training($training_id='') {
        if(!common::user_permit('delete','staffs')) {
            common::redirect();
        }
        if($training_id=='') {
            redirect('staffs/training');
        }
        sql::delete('staff_training','training_id='.$training_id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('staffs/training');
    }



    /* staff routinre- to do */
    function routine() {
        if(!common::user_permit('view','staffs')) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Staff ID", "Staff Name",'Department','Designation','E. Type','E. Nature','Status');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 65,
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
                array("name" => "department_name",
                        "index" => "department_name",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "designation",
                        "index" => "designation",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "employ_type",
                        "index" => "employ_type",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "employ_nature",
                        "index" => "employ_nature",
                        "width" => 70,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),

                array("name" => "status",
                        "index" => "status",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if ($_POST['apply_filter']) {

            $this->valid_filter();
            if ($this->form_validation->run()) {

                $this->settings_data();
            }
            $gridObj->setGridOptions("Manage Staffs", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=staffs&m=load_staffs&searchField=' . $_POST['searchField'] . '&searchValue=' . $_POST['searchValue']), true);
        } else {

            $gridObj->setGridOptions("Manage Staffs", 900, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('staffs/load_staffs'), true);

        }
        $data['grid_data']=$gridObj->getGrid();


        $data['nav_array']=array(
                array('title'=>'Manage Staffs','url'=>'')
        );
        $data['department_id']=$department_id;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staffs';
        $data['page']='manage_staffs';
        $data['page_title']='Manage Staffs';
        $this->load->view('main',$data);
    }
    


}?>