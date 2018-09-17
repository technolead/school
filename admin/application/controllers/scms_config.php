<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of scms_config
 *
 * @author Anwar
 */
class scms_config extends Controller {
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_scms_config');
    }
    function index($type_for='all') {
        /*-----------------Pagination--------------*/

        $data['nav_array']=array(
                array('title'=>'Manage Type','url'=>'')
        );
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Type Name", "Type For", "Date");
        $gridColumnModel = array(
                array("name" => "type_name",
                        "index" => "type_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "type_for",
                        "index" => "type_for",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "date",
                        "index" => "date",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage School-College Configuration", 750, 250, "type_for", "asc", $gridColumn, $gridColumnModel, site_url('scms_config/load_type/'.$type_for), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['type_for']=$type_for;
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='scms_config';
        $data['page']='index';
        $data['page_title']='Manage Type';
        $this->load->view('main',$data);
    }
    public function load_type($type_for='all') {
        $this->mod_scms_config->get_types($type_for);
    }
    function new_type($type_for='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_type')) {
                $this->mod_scms_config->save_type(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('scms_config/index/'.$_POST['type_for']);
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Types','url'=>site_url('scms_config')),
                array('title'=>'Add New Type','url'=>'')
        );
        $data['action']=site_url('scms_config/new_type')."/".$type_for;
        $data['type_for']=$type_for;
        $data['dir']='scms_config';
        $data['page']='type_form';
        $data['page_title']='Add New Type';
        $this->load->view('main',$data);
    }
    function edit_type($type_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_type')) {
                $this->mod_scms_config->update_type(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('scms_config');
            }
        }
        if($type_id=='') {
            redirect('scms_config');
        }
        $data=sql::row('conf_type','type_id='.$type_id); //Don't Change
        $this->session->set_userdata('type_id',$data['type_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Types','url'=>site_url('scms_config')),
                array('title'=>'Edit Type','url'=>'')
        );
        $data['action']=site_url('scms_config/edit_type')."/".$type_id;
        $data['dir']='scms_config';
        $data['page']='type_form';
        $data['page_title']='Edit Type';
        $this->load->view('main',$data);
    }
    function delete_type($type_id='') {
        if($type_id=='') {
            redirect('scms_config');
        }
        sql::delete('conf_type','type_id='.$type_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }

    function manage_status($status_for='all') {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Status Name", "Status For", "Date");
        $gridColumnModel = array(
                array("name" => "status_name",
                        "index" => "status_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "status_for",
                        "index" => "status_for",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "date",
                        "index" => "date",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage College Configuration", 750, 250, "status_for", "asc", $gridColumn, $gridColumnModel, site_url('scms_config/load_status/'.$status_for), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='scms_config';
        $data['page']='manage_status';
        $data['page_title']='Manage Status';
        $data['status_for']=$status_for;
        $this->load->view('main',$data);
    }
    function load_status($status_for='all') {
        $this->mod_scms_config->get_status($status_for);
    }
    function new_status($status_for='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_status')) {
                $this->mod_scms_config->save_status();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('scms_config/manage_status/'.$_POST['status_for']);
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>site_url('scms_config/manage_status')),
                array('title'=>'Add New Status','url'=>'')
        );
        $data['status_for']=$status_for;
        $data['action']=site_url('scms_config/new_status');
        $data['dir']='scms_config';
        $data['page']='status_form';
        $data['page_title']='Add New Status';
        $this->load->view('main',$data);
    }
    function edit_status($status_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_status')) {
                $this->mod_scms_config->update_status(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('scms_config/manage_status/'.$_POST['status_for']);
            }
        }
        if($status_id=='') {
            redirect('scms_config/manage_status');
        }
        $data=sql::row('conf_status','status_id='.$status_id); //Don't Change
        $this->session->set_userdata('status_id',$data['status_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>site_url('scms_config/manage_status')),
                array('title'=>'Edit Status','url'=>'')
        );
        $data['action']=site_url('scms_config/edit_status')."/".$status_id;
        $data['dir']='scms_config';
        $data['page']='status_form';
        $data['page_title']='Edit Status';
        $this->load->view('main',$data);
    }
    function delete_status($status_id='') {
        if($status_id=='') {
            redirect('scms_config/manage_status');
        }
        sql::delete('conf_status','status_id='.$status_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function status_status($coll_status_id='',$status='enabled') {
        if($coll_status_id=='') {
            redirect('scms_config');
        }
        common::change_status('coll_status','coll_status_id='.$coll_status_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    function manage_country() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Country Name", "Nationality");
        $gridColumnModel = array(
                array("name" => "country_name",
                        "index" => "country_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "nationality",
                        "index" => "nationality",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage College Configuration", 750, 250, "country_name", "asc", $gridColumn, $gridColumnModel, site_url('scms_config/load_country'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='scms_config';
        $data['page']='manage_country';
        $data['page_title']='Manage Country';
        $this->load->view('main',$data);
    }
    function load_country() {
        $this->mod_scms_config->get_country_grid();
    }
    function new_country() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_country')) {
                $this->mod_scms_config->save_country(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('scms_config/manage_country');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>site_url('scms_config/manage_country')),
                array('title'=>'Add New Country','url'=>'')
        );
        $data['action']=site_url('scms_config/new_country');
        $data['dir']='scms_config';
        $data['page']='country_form'; //Don't Change
        $data['page_title']='Add New Country';
        $this->load->view('main',$data);
    }
    function edit_country($country_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_country')) {
                $this->mod_scms_config->update_country(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('scms_config/manage_country');
            }
        }
        if($country_id=='') {
            redirect('scms_config/manage_country');
        }
        $data=sql::row('country','country_id='.$country_id); //Don't Change
        $this->session->set_userdata('country_id',$data['country_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>site_url('scms_config/manage_country')),
                array('title'=>'Edit Country','url'=>'')
        );
        $data['action']=site_url('scms_config/edit_country')."/".$country_id;
        $data['dir']='scms_config';
        $data['page']='country_form';
        $data['page_title']='Edit Country';
        $this->load->view('main',$data);
    }
    function delete_country($country_id='') {
        if($country_id=='') {
            common::redirect();
        }
        sql::delete('country','country_id='.$country_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('scms_config/manage_country');
    }
    function country_status($country_id='',$status='enabled') {
        if($country_id=='') {
            common::redirect();
        }
        common::change_status('country','country_id='.$country_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }


    function payment_details() {
        /*-----------------Pagination--------------*/
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('scms_config/payment_details/');
        $config['total_rows'] = sql::count('payment_details');
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        $data['rows']=sql::rows('payment_details',"1=1 limit $start,{$config['per_page']}");
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        /*-----------------End Pagination--------------*/

        $data['nav_array']=array(
                array('title'=>'Manage Payment Details','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='scms_config';
        $data['page']='payment_details';
        $data['page_title']='Manage Payment Details';
        $this->load->view('main',$data);
    }
    function new_pay_details() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_pay_details')) {
                $this->mod_scms_config->save_pay_details(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('scms_config/payment_details');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Payment Details','url'=>site_url('scms_config/payment_details')),
                array('title'=>'Add New Payment Details','url'=>'')
        );
        $data['action']=site_url('scms_config/new_pay_details');
        $data['dir']='scms_config';
        $data['page']='pay_details_form';
        $data['page_title']='Add New Payment Details';
        $this->load->view('main',$data);
    }
    function edit_pay_details($pay_details_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_pay_details')) {
                $this->mod_scms_config->update_pay_details(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('scms_config/payment_details');
            }
        }
        if($pay_details_id=='') {
            redirect('scms_config/payment_details');
        }
        $data=sql::row('payment_details','pay_details_id='.$pay_details_id); //Don't Change
        $this->session->set_userdata('pay_details_id',$data['pay_details_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Payment Details','url'=>site_url('scms_config/payment_details')),
                array('title'=>'Edit Payment Details','url'=>'')
        );
        $data['action']=site_url('scms_config/edit_pay_details')."/".$pay_details_id;
        $data['dir']='scms_config';
        $data['page']='pay_details_form';
        $data['page_title']='Edit Payment Details';
        $this->load->view('main',$data);
    }
    function delete_pay_details($pay_details_id='') {
        if($pay_details_id=='') {
            common::redirect();
        }
        sql::delete('payment_details','pay_details_id='.$pay_details_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function pay_details_status($pay_details_id='',$status='enabled') {
        if($pay_details_id=='') {
            common::redirect();
        }
        common::change_status('payment_details','pay_details_id='.$pay_details_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }



    function manage_report_status() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Report Status", "Marks");
        $gridColumnModel = array(
                array("name" => "report_status",
                        "index" => "report_status",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "mark",
                        "index" => "mark",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage College Configuration", 750, 250, "report_status", "asc", $gridColumn, $gridColumnModel, site_url('scms_config/load_report_status'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Report Status','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='scms_config';
        $data['page']='report_status';
        $data['page_title']='Manage Report Status';
        
        $this->load->view('main',$data);
    }
    function load_report_status() {
        $this->mod_scms_config->get_report_status();
    }
    function new_report_status() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_report_status')) {
                $this->mod_scms_config->save_report_status();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('scms_config/manage_report_status');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Report Status','url'=>site_url('scms_config/manage_report_status')),
                array('title'=>'Add New Report Status','url'=>'')
        );
        $data['status_for']=$status_for;
        $data['action']=site_url('scms_config/new_report_status');
        $data['dir']='scms_config';
        $data['page']='report_status_form';
        $data['page_title']='Add New Report Status';
        $this->load->view('main',$data);
    }
    function edit_report_status($report_status_mark_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_report_status')) {
                $this->mod_scms_config->update_report_status(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('scms_config/manage_report_status');
            }
        }
        if($report_status_mark_id=='' || !is_numeric($report_status_mark_id)) {
            redirect('scms_config/manage_report_status');
        }
        $data=sql::row('report_status_mark','report_status_mark_id='.$report_status_mark_id); 
        $this->session->set_userdata('report_status_mark_id',$data['report_status_mark_id']);
        $data['nav_array']=array(
                array('title'=>'Manage Report Status','url'=>site_url('scms_config/manage_report_status')),
                array('title'=>'Edit Report Status','url'=>'')
        );
        $data['action']=site_url('scms_config/edit_report_status')."/".$report_status_mark_id;
        $data['dir']='scms_config';
        $data['page']='report_status_form';
        $data['page_title']='Edit Report Status';
        $this->load->view('main',$data);
    }
    function delete_report_status($report_status_mark_id='') {
        if($report_status_mark_id=='') {
            redirect('scms_config/manage_report_status');
        }
        sql::delete('report_status_mark','report_status_mark_id='.$report_status_mark_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
}?>