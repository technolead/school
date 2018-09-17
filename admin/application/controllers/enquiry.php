<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of enquiry
 *
 * @author Anwar
 */
class enquiry extends Controller {
    private $dir='enquiry';
    private $container='common';
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_enquiry');
    }
    function index() {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('enquiry/index/');

        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        if($_POST['search']) {
            $config['total_rows'] = count($this->mod_enquiry->get_search_enquiry());
            $data=$_POST;
            $data['rows']=$this->mod_enquiry->get_search_enquiry();
        }else {
            $config['total_rows'] = count($this->mod_enquiry->get_all_enquiry());
            $data['rows']=$this->mod_enquiry->get_all_enquiry("limit $start, {$config['per_page']}");
        }
        $data['pagination_links']=$this->pagination->create_links();

        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }

        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];

        $data['nav_array']=array(
                array('title'=>'Manage General Enquiry','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');

        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='index';
        $data['page_title']='Manage General Enquiry';
        $this->load->view('main',$data);
    }
    function details($enquiry_id='') {
        if($enquiry_id=='') {
            redirect('home');
        }
        $data=$this->mod_enquiry->get_enquiry_details($enquiry_id);
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='details';
        $data['page_title']='General Enquiry Details';
        $this->load->view('print_main',$data);
    }
    function new_enquiry() {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->model('mod_staffs');
        if($_POST['save']) {
            $this->valid_emquiry();
            if($this->form_validation->run()) {
                $this->mod_enquiry->save_enquiry(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('enquiry');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage General Enquiry','url'=>site_url('enquiry')),
                array('title'=>'Add New General Enquiry','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='new_enquiry'; //Don't Change
        $data['page_title']='Add New General Enquiry';
        $this->load->view('main',$data);
    }
    function edit_enquiry($enquiry_id='') {
        if($_POST['update']) {
            $this->valid_emquiry();
            if($this->form_validation->run()) {
                $this->mod_enquiry->update_enquiry(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('enquiry');
            }
        }
        $this->load->model('mod_staffs');
        if($enquiry_id=='') {
            redirect('enquiry');
        }
        $data=sql::row('enquiry','enquiry_id='.$enquiry_id);
        $this->session->set_userdata('enquiry_id',$data['enquiry_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage General Enquiry','url'=>site_url('enquiry')),
                array('title'=>'Edit General Enquiry','url'=>'')
        );
        $data['editor']=TRUE;
        $data['dir']=$this->dir;
        $data['container']=$this->container;
        $data['page']='edit_enquiry'; //Don't Change
        $data['page_title']='Edit General Enquiry';
        $this->load->view('main',$data);
    }
    function delete_enquiry($enquiry_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($enquiry_id=='') {
            redirect('enquiry');
        }
        sql::delete('enquiry','enquiry_id='.$enquiry_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function enquiry_status($enquiry_id='',$status='enabled') {
        if(!common::is_admin_user()||!common::user_permit('update')) {
            common::redirect();
        }
        if($enquiry_id=='') {
            redirect('enquiry');
        }
        common::change_status('enquiry','enquiry_id='.$enquiry_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function valid_emquiry() {
        $this->form_validation->set_rules('name', 'Name', '');
        $this->form_validation->set_rules('organisation', 'Organisation', '');
        $this->form_validation->set_rules('messages', 'Messages', '');
        $this->form_validation->set_rules('look_for', 'Looking For', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', '');
        $this->form_validation->set_rules('email', 'Email', '');
        $this->form_validation->set_rules('comments', 'Comments', '');
    }
}
?>
