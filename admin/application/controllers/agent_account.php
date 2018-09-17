<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agent_account
 *
 * @author Anwar
 */
class agent_account extends Controller {
    function  __construct() {
        parent::Controller();
        $this->load->model(array('mod_agent_account','mod_agents'));
    }
    function index(){
        if(!common::user_permit('add','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }
        if($_POST['go']) {
            $data=sql::row('agents',"user_name='{$_POST['user_name']}'");
            if($data['agents_id']=='') {
                $this->session->set_flashdata('msg','There is no agent associated with the Agent ID!');
                common::redirect();
            }else {
                redirect('agent_account/account/'.$data['agents_id']);
            }
        }
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agent_account';
        $data['page']='index';
        $data['page_title']='Agents Account';
        $this->load->view('main',$data);
    }
     function account($agents_id='') {
        if(!common::user_permit('add','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }
        /*-----------------Pagination--------------*/
        if($agents_id=='') {
            redirect('agents/manage_agents');
        }
        $data=$this->mod_agents->get_agents_details($agents_id);
        $this->session->set_userdata('sel_agents_id',$data['agents_id']);
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('agent_account/account/'.$agents_id.'/');
        $config['total_rows'] = count($this->mod_agent_account->get_agents_students($agents_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();
        $data['rows']=$this->mod_agent_account->get_agents_students($agents_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Select Agent','url'=>site_url('agent_account')),
                array('title'=>'Ágent Account','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agent_account';
        $data['page']='account';
        $data['page_title']='Agents Account';
        $this->load->view('main',$data);
    }
     function make_payment($payments_id='') {
        if(!common::user_permit('add','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }

        if($payments_id=='') {
            common::redirect();
        }
        $agents_id=$this->session->userdata('sel_agents_id');
        if($agents_id=='') {
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('agent_payment')) {
                if($this->mod_agent_account->save_payment()) {
                    $this->session->set_flashdata('msg','Agents Payments Added Successfully!!!');
                    redirect('agent_account/mng_payments');
                }
            }
        }
        $data=sql::row('std_payments',"payments_id=$payments_id and agents_id=$agents_id",'agent_amount,payments_id,student_id');
        if($data['payments_id']=='') {
            common::redirect();
        }
        $this->session->set_userdata('payments_id',$data['payments_id']);
        $this->session->set_userdata('agent_student_id',$data['student_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Agents','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agent_account';
        $data['page']='make_payment';
        $data['page_title']='Make Agents Payments';
        $this->load->view('main',$data);
    }
    function mng_payments() {
        if(!common::user_permit('add','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }
        $agents_id=$this->session->userdata('sel_agents_id');
        if($agents_id=='') {
            common::redirect();
        }
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('agent_account/mng_payments/');
        $config['total_rows'] = sql::count('agent_payment',"agents_id=$agents_id");
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();
        $data['rows']=$this->mod_agent_account->get_payments($agents_id);
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/
        $data['nav_array']=array(
                array('title'=>'Slect Agent','url'=>site_url('agent_account/manage_agents')),
                array('title'=>'Manage Agent Payment','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agent_account';
        $data['page']='mng_payments';
        $data['page_title']='Make Agents Payments';
        $this->load->view('main',$data);
    }
    function edit_payment($payments_id='') {
        if(!common::user_permit('add','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }
        if($payments_id=='') {
            common::redirect();
        }
        $agents_id=$this->session->userdata('sel_agents_id');
        if($agents_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('agent_payment')) {
                if($this->mod_agent_account->update_payment()) {
                    $this->session->set_flashdata('msg','Agents Payments Added Successfully!!!');
                    redirect('agent_account/mng_payments');
                }
            }
        }
        $data=sql::row('agent_payment',"agent_payment_id=$payments_id and agents_id=$agents_id");
        if($data['agent_payment_id']=='') {
            common::redirect();
        }
        $this->session->set_userdata('agent_payment_id',$data['agent_payment_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Agents','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agent_account';
        $data['page']='edit_payment';
        $data['page_title']='Edit Agents Payments';
        $this->load->view('main',$data);
    }
    function print_payment($payments_id='') {
        if(!common::user_permit('add','agent_account')) {
            common::redirect();
        }
        if($payments_id=='') {
            common::redirect();
        }
        $agents_id=$this->session->userdata('sel_agents_id');
        if($agents_id=='') {
            common::redirect();
        }

        $data=$this->mod_agent_account->get_payment_details($payments_id,$agents_id);
        if($data['agent_payment_id']=='') {
            common::redirect();
        }
        $data['print']=TRUE;
        $data['dir']='agent_account';
        $data['page']='print_payment';
        $data['page_title']='Agents Payments';
        $this->load->view('print_main',$data);
    }
    function delete_payment($payment_id='') {
        if(!common::user_permit('delete','agent_account')||!common::is_admin_user()) {
            common::redirect();
        }
        if($payment_id==''||!is_numeric($payment_id)) {
            $this->session->set_flashdata('msg','Crital Error!');
            common::redirect();
        }
        sql::delete('agent_payment',"agent_payment_id=$payment_id");
        $this->session->set_flashdata('msg','Payments Deleted Successfully!');
        common::redirect();
    }
}
?>
