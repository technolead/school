<?php 
/**
 * Description of exemption
 *
 * @author anwar
 */
class exemption extends Controller {
    function exemption() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_exemption');
    }
    function index() {
        if(!common::user_permit('view','exemption')){
            common::redirect();
        }
        $data['nav_array']=array(
                array('title'=>'Manage Exemption','url'=>'')
        );
        if($_POST['apply_filter']) {
            $data=$_POST;
            $data['rows']=$this->mod_exemption->get_search_exemption();
        }else {
              $data['rows']=$this->mod_exemption->get_exemption(); //Don't Change
              $data['to_date']=date('Y-m-d');
              $data['from_date']=date('Y-m-d');
        }
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='exemption';
        $data['page']='index';
        $data['page_title']='Manage Exemption';
        $this->load->view('main',$data);
    }
    function new_exemption() {
         if(!common::user_permit('add','exemption')){
            common::redirect();
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_exemption')) {
                $this->mod_exemption->save_exemption(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('exemption');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Exemption','url'=>site_url('exemption')),
                array('title'=>'Add New Exemption','url'=>'')
        );
        $data['dir']='exemption';
        $data['page']='new_exemption'; //Don't Change
        $data['page_title']='Add New Exemption';
        $this->load->view('main',$data);
    }
    function edit_exemption($absent_id='') {
         if(!common::user_permit('add','exemption')){
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_exemption')) {
                $this->mod_exemption->update_exemption(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('exemption');
            }
        }
        if($absent_id=='') {
            common::redirect();
        }
        $data=$this->mod_exemption->get_absent_details($absent_id); //Don't Change
        $this->session->set_userdata('exemption_id',$data['exemption_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Exemption','url'=>site_url('exemption')),
                array('title'=>'Edit Exemption','url'=>'')
        );
        $data['dir']='exemption';
        $data['page']='edit_exemption'; //Don't Change
        $data['page_title']='Edit Exemption';
        $this->load->view('main',$data);
    }
    function delete_exemption($exemption_id='') {
         if(!common::user_permit('delete','exemption')){
            common::redirect();
        }
        if($exemption_id=='') {
            redirect('exemption');
        }
        sql::delete('exemption',"exemption_id=$exemption_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function is_valid_student() {
        if(sql::count('student',"user_name='{$_POST['user_name']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_student','Sorry, Student ID is invalid!!!');
            return FALSE;
        }
    }
}?>