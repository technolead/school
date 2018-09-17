<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of staff_account
 *
 * @author anwar
 */
class staff_account extends Controller {
    function  __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model(array('mod_staffs','mod_staff_account'));
        $this->load->helper('ahdate');
    }
    function index() {
        $data['nav_array']=array(
                array('title'=>'Select Staff','url'=>'')
        );
        if($_POST['continue']) {
            if($this->form_validation->run('is_valid_staff')) {
                redirect('staff_account/manage_account/'.$_POST['user_name']);
            }
        }
        $data['dir']='staff_account';
        $data['page']='index';
        $data['page_title']='Manage Staffs Account';
        $this->load->view('main',$data);
    }
    function manage_account($user_name='') {
        if(!common::user_permit('view','staff_account')) {
            common::redirect();
        }
        $data=sql::row('staffs',"user_name='$user_name'",'staffs_id,user_name');
        if($data['staffs_id']=='') {
            redirect('staff_account');
        }
        $this->session->set_userdata('sel_staff_id',$data['staffs_id']);
        $this->session->set_userdata('staff_user_name',$data['user_name']);
        $data['nav_array']=array(
                array('title'=>'Select Staff','url'=>site_url('staff_account')),
                array('title'=>'Manage Staffs Account','url'=>'')
        );
        $data['dir']='staff_account';
        $data['page']='manage_account'; //Don't Change
        $data['page_title']='Staff Accounts';
        $this->load->view('main',$data);
    }
    function is_valid_staff() {
        if(sql::count('staffs',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_staff','Sorry, Staffs ID is invalid!!!');
            return FALSE;
        }
    }
    function manage_payments() {
        if(!common::user_permit('view','staff_payment')) {
            common::redirect();
        }
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('staff_account/manage_payments/');
        $config['total_rows'] =count($this->mod_staff_account->get_staff_payments($staffs_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['payment_rows']=$this->mod_staff_account->get_staff_payments($staffs_id,"limit $start,{$config['per_page']}");
        if(count($data['payment_rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['payment_rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/

        $data['nav_array']=array(
                array('title'=>'Select Staff','url'=>site_url('staff_account')),
                array('title'=>'Manage Staffs Account','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_account';
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['page']='manage_payments'; //Don't Change
        $data['page_title']='Staff Accounts';
        $this->load->view('staff_account',$data);
    }
    function new_payment() {
        if(!common::user_permit('add','staff_payment')) {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_payment')) {
                
                if($this->mod_staff_account->save_payment()) {
                    $this->session->set_flashdata('msg','Staff Payment Added Successfully!');
                    redirect('staff_account/manage_payments');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Staff Accounts','url'=>site_url('staff_account/manage_account/'.$this->session->userdata('staff_user_name'))),
                array('title'=>'Manage Payments','url'=>site_url('staff_account/manage_payments')),
                array('title'=>'Add New Payment','url'=>'')
        );
        $staffs_id=$this->session->userdata('sel_staff_id');
        $data=sql::row("staffs","staffs_id=$staffs_id");
        $data['training']=$this->mod_staff_account->get_staff_training($data['training_id']);
        $data['dir']='staff_account';
        $data['page']='new_payment';
        $data['page_title']='Add New Payment';
        $this->load->view('staff_account',$data);
    }
    function edit_payment($payment_id='') {
        if(!common::user_permit('add','staff_payment')) {
            common::redirect();
        }
        if($payment_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('staff_payment')) {
                if($this->mod_staff_account->update_payment()) {
                    $this->session->set_flashdata('msg','Staff Payment Added Successfully!');
                    redirect($this->session->userdata('redirect_url'));
                }
            }
        }
        $data=sql::row('staff_payment',"payment_id=$payment_id");
        $staffs_id=$this->session->userdata('sel_staff_id');
        $data['staff_details']=$details=sql::row("staffs","staffs_id=$staffs_id");
        $data['training']=$this->mod_staff_account->get_staff_training($details['training_id']);
        $this->session->set_userdata('payment_id',$data['payment_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Staff Accounts','url'=>site_url('staff_account/manage_account/'.$this->session->userdata('staff_user_name'))),
                array('title'=>'Manage Payments','url'=>site_url('staff_account/manage_payments')),
                array('title'=>'Edit Payment','url'=>'')
        );
        $data['dir']='staff_account';
        $data['page']='edit_payment';
        $data['page_title']='Edit Payment';
        $this->load->view('staff_account',$data);
    }
    function delete_payment($payment_id='') {
        if(!common::user_permit('delete','staff_payment')) {
            common::redirect();
        }
        if($payment_id==''||!is_numeric($payment_id)) {
            $this->session->set_flashdata('msg','Crital Error!');
            common::redirect();
        }
        sql::delete('staff_payment',"payment_id=$payment_id");
        $this->session->set_flashdata('msg','Payments Deleted Successfully!');
        common::redirect();
    }
    function staff_mng_account() {
        if(!common::user_permit('view','staff_account')) {
            common::redirect();
        }
        $this->load->model('mod_staff_attd');
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        if($_POST['save']) {
            if($this->form_validation->run('staff_balance')) {
                if($this->mod_staff_account->save_balance()) {
                    $this->session->set_flashdata('msg','Payments Deleted Successfully!');
                    redirect('staff_account/mng_staff_balance');
                }
            }
        }
        $data['month']=$this->session->userdata('sel_month');
        $data['year']=$this->session->userdata('sel_year');

        $con='';
        if($data['month']!=''&& $data['year']!='') {
            $date=$data['year'].'-'.$data['month'];
            $con=" and DATE_FORMAT(date,'%Y-%m')='$date'";
        }else if($data['month']!='') {
            $date=$data['month'];
            $con=" and MONTH(date)='$date'";
        }
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('staff_account/staff_mng_account/');
        $config['total_rows'] =sql::count('staffs_attendance',"staffs_id=$staffs_id $con");
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['attd_pagination_links']=$this->pagination->create_links();

        $data['rows']=sql::rows('staffs_attendance',"staffs_id=$staffs_id $con order by date");

        if(count($data['rows'])>0) {
            $data['attd_start']=$start+1;
        }else {
            $data['attd_start']=$start;
        }
        $data['attd_end']=$start+count($data['rows']);
        $data['attd_total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/

        $data['payment_rows']=$this->mod_staff_account->get_staff_payments($staffs_id);
        $start=0;
        if(count($data['payment_rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['payment_rows']);
        $data['total']=count($data['payment_rows']);

        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['nav_array']=array(
                array('title'=>'Select Staff','url'=>site_url('staff_account')),
                array('title'=>'Manage Staffs Account','url'=>'')
        );
        $data['total_attd']=$this->mod_staff_attd->get_total_attendance($staffs_id);

        $data['previous_due']=sql::row('staff_balance',"staffs_id=$staffs_id order by balance_id desc",'due');
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_account';
        $data['page']='staff_mng_account'; //Don't Change
        $data['page_title']='Staff Account';
        $this->load->view('staff_account',$data);
    }
    function mng_staff_balance() {
        if(!common::user_permit('view','staff_balance')) {
            common::redirect();
        }
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        $data['msg']=$this->session->flashdata('msg');
        $data['rows']=sql::rows('staff_balance',"staffs_id=$staffs_id order by balance_id desc");
        $start=0;
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=count($data['rows']);

        $data['dir']='staff_account';
        $data['page']='mng_staff_balance'; //Don't Change
        $data['page_title']='Staff Account';
        $this->load->view('staff_account',$data);
    }
    function edit_balance($balance_id='') {
        if(!common::user_permit('add','staff_balance')) {
            common::redirect();
        }
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        if($balance_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('staff_balance')) {
                if($this->mod_staff_account->update_balance()) {
                    $this->session->set_flashdata('msg','Payments Updated Successfully!');
                    redirect('staff_account/mng_staff_balance');
                }
            }
        }
        $data=sql::row('staff_balance',"balance_id=$balance_id and staffs_id=$staffs_id");
        $this->session->set_userdata('edit_balance_id',$data['balance_id']);
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_account';
        $data['page']='edit_balance'; //Don't Change
        $data['page_title']='Edit Staff Balance';
        $this->load->view('staff_account',$data);
    }
    function print_balance($balance_id=''){
        if(!common::user_permit('add','staff_balance')) {
            common::redirect();
        }
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        if($balance_id=='') {
            common::redirect();
        }
        $data=$this->mod_staff_account->get_balance_details($balance_id);
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='staff_account';
        $data['page']='print_balance'; //Don't Change
        $data['page_title']='Staff Balance';
        $this->load->view('print_main',$data);
    }
    function delete_balance($balance_id='') {
        if(!common::user_permit('delete','staff_balance')) {
            common::redirect();
        }
        $staffs_id=$this->session->userdata('sel_staff_id');
        if($staffs_id=='') {
            common::redirect();
        }
        if($balance_id==''||!is_numeric($balance_id)) {
            $this->session->set_flashdata('msg','Crital Error!');
            common::redirect();
        }
        sql::delete('staff_balance',"balance_id=$balance_id and staffs_id=$staffs_id");
        $this->session->set_flashdata('msg','Staff Payments Deleted Successfully!');
        common::redirect();
    }
    function cng_month_sess() {
        if($_POST['month']=='') {
            $month='';
        }else {
            $month=$_POST['month'];
        }
        if($_POST['year']=='') {
            $year=date('Y');
        }else {
            $year=$_POST['year'];
        }
        $this->session->set_userdata('sel_month',$month);
        $this->session->set_userdata('sel_year',$year);
        echo site_url($this->session->userdata('cur_uri'));
    }
}
?>
