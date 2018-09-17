<?php

class institution_config extends Controller {
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_institution_config');
    }

    function index(){
        
    }

    function institution_type() {
        
        $data['nav_array']=array(
                array('title'=>'Manage Institution Type','url'=>'')
        );
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Type Name");
        $gridColumnModel = array(
                array("name" => "institution_type",
                        "index" => "institution_type",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                )
        );
        $gridObj->setGridOptions("Manage Institution Configuration", 750, 250, "institution_type", "asc", $gridColumn, $gridColumnModel, site_url('institution_config/load_type'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='institution_config';
        $data['page']='index';
        $data['page_title']='Manage Institution Type';
        
        $this->load->view('main',$data);
    }
    public function load_type() {
        
        $this->mod_institution_config->get_institution_types();
    }
    function new_type() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_institution_type')) {
                $this->mod_institution_config->save_type();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('institution_config/institution_type');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Institution Types','url'=>site_url('institution_config/institution_type')),
                array('title'=>'Add New Type','url'=>'')
        );
        $data['action']=site_url('institution_config/new_type');
        $data['dir']='institution_config';
        $data['page']='new_type'; //Don't Change
        $data['page_title']='Add New Type';
        $this->load->view('main',$data);
    }
    function edit_type($type_id='') {

        if($type_id=='') {
            redirect('institution_config/institution_type');
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_institution_type')) {
                $this->mod_institution_config->update_type(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('institution_config/institution_type');
            }
        }
        
        $data=sql::row('institution_type','institution_type_id='.$type_id); //Don't Change
        $this->session->set_userdata('institution_type_id',$data['institution_type_id']); //Don't Change
        
        $data['nav_array']=array(
                array('title'=>'Manage Institution Types','url'=>site_url('institution_config/institution_type')),
                array('title'=>'Edit Type','url'=>'')
        );
        
        $data['action']=site_url('institution_config/edit_type')."/".$data['institution_type_id'];
        $data['dir']='institution_config';
        $data['page']='new_type'; //Don't Change
        $data['page_title']='Edit Type';
        $this->load->view('main',$data);
    }
    function delete_type($type_id='') {
        if($type_id=='') {
            redirect('institution_config/institution_type');
        }
        sql::delete('institution_type','institution_type_id='.$type_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }


    function manage_class() {

        $data['nav_array']=array(
                array('title'=>'Manage Class','url'=>'')
        );
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Institution Type","Year","Class","Inputed By","Status");
        $gridColumnModel = array(
                array("name" => "institution_type",
                        "index" => "institution_type",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "class_year",
                        "index" => "class_year",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                 array("name" => "class_code",
                        "index" => "class_code",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                 array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                ),
                 array("name" => "status",
                        "index" => "status",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => false
                )
        );
        $gridObj->setGridOptions("Manage Class", 750, 250, "class_code", "asc", $gridColumn, $gridColumnModel, site_url('institution_config/load_class'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='institution_config';
        $data['page']='manage_class';
        $data['page_title']='Manage Class';

        $this->load->view('main',$data);
    }

    public function load_class() {

        $this->mod_institution_config->get_class();
    }

    function new_class() {
        
        if($_POST['save']) {
            if($this->form_validation->run('valid_class')) {
                $this->mod_institution_config->save_class();
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('institution_config/manage_class');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Classes','url'=>site_url('institution_config/manage_class')),
                array('title'=>'Add New Type','url'=>'')
        );

        $data['action']=site_url('institution_config/new_class');
        $data['dir']='institution_config';
        $data['page']='new_class';
        $data['page_title']='Add New Class';
        $this->load->view('main',$data);
    }

    function edit_class($class_id='') {

        if($class_id=='') {
            redirect('institution_config/manage_class');
        }
        if($_POST['save']) {
            if($this->form_validation->run('valid_class')) {
                $this->mod_institution_config->update_class(); 
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('institution_config/manage_class');
            }
        }

        $data=sql::row('class','class_id='.$class_id); 
        $this->session->set_userdata('class_id',$data['class_id']);

        $data['nav_array']=array(
                array('title'=>'Manage Class','url'=>site_url('institution_config/manage_class')),
                array('title'=>'Edit Class','url'=>'')
        );

        $data['action']=site_url('institution_config/edit_class')."/".$data['class_id'];
        $data['dir']='institution_config';
        $data['page']='new_class';
        $data['page_title']='Edit Class';
        $this->load->view('main',$data);
    }

    function delete_class($class_id='') {
        if($class_id=='') {
            redirect('institution_config/manage_class');
        }
        sql::delete('class','class_id='.$class_id); 
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
        $gridObj->setGridOptions("Manage College Configuration", 750, 250, "status_for", "asc", $gridColumn, $gridColumnModel, site_url('institution_config/load_status/'.$status_for), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='institution_config';
        $data['page']='manage_status';
        $data['page_title']='Manage Status';
        $data['status_for']=$status_for;
        $this->load->view('main',$data);
    }
    function load_status($status_for='all') {
        $this->mod_institution_config->get_status($status_for);
    }
    function new_status() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_status')) {
                $this->mod_institution_config->save_status(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('institution_config/manage_status/'.$_POST['status_for']);
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>site_url('institution_config/manage_status')),
                array('title'=>'Add New Status','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='new_status'; //Don't Change
        $data['page_title']='Add New Status';
        $this->load->view('main',$data);
    }
    function edit_status($status_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_status')) {
                $this->mod_institution_config->update_status(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('institution_config/manage_status/'.$_POST['status_for']);
            }
        }
        if($status_id=='') {
            redirect('institution_config/manage_status');
        }
        $data=sql::row('conf_status','status_id='.$status_id); //Don't Change
        $this->session->set_userdata('status_id',$data['status_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Status','url'=>site_url('institution_config/manage_status')),
                array('title'=>'Edit Status','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='edit_status'; //Don't Change
        $data['page_title']='Edit Status';
        $this->load->view('main',$data);
    }
    function delete_status($status_id='') {
        if($status_id=='') {
            redirect('institution_config/manage_status');
        }
        sql::delete('conf_status','status_id='.$status_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function status_status($coll_status_id='',$status='enabled') {
        if($coll_status_id=='') {
            redirect('institution_config');
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
        $gridObj->setGridOptions("Manage College Configuration", 750, 250, "country_name", "asc", $gridColumn, $gridColumnModel, site_url('institution_config/load_country'), true);
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='institution_config';
        $data['page']='manage_country';
        $data['page_title']='Manage Country';
        $this->load->view('main',$data);
    }
    function load_country() {
        $this->mod_institution_config->get_country_grid();
    }
    function new_country() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_country')) {
                $this->mod_institution_config->save_country(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('institution_config/manage_country');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>site_url('institution_config/manage_country')),
                array('title'=>'Add New Country','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='new_country'; //Don't Change
        $data['page_title']='Add New Country';
        $this->load->view('main',$data);
    }
    function edit_country($country_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_country')) {
                $this->mod_institution_config->update_country(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('institution_config/manage_country');
            }
        }
        if($country_id=='') {
            redirect('institution_config/manage_country');
        }
        $data=sql::row('country','country_id='.$country_id); //Don't Change
        $this->session->set_userdata('country_id',$data['country_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Country','url'=>site_url('institution_config/manage_country')),
                array('title'=>'Edit Country','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='edit_country'; //Don't Change
        $data['page_title']='Edit Country';
        $this->load->view('main',$data);
    }
    function delete_country($country_id='') {
        if($country_id=='') {
            common::redirect();
        }
        sql::delete('country','country_id='.$country_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
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
        $config['base_url'] = site_url('institution_config/payment_details/');
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
        $data['dir']='institution_config';
        $data['page']='payment_details';
        $data['page_title']='Manage Payment Details';
        $this->load->view('main',$data);
    }
    function new_pay_details() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_pay_details')) {
                $this->mod_institution_config->save_pay_details(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('institution_config/payment_details');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Payment Details','url'=>site_url('institution_config/payment_details')),
                array('title'=>'Add New Payment Details','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='new_pay_details'; //Don't Change
        $data['page_title']='Add New Payment Details';
        $this->load->view('main',$data);
    }
    function edit_pay_details($pay_details_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('valid_pay_details')) {
                $this->mod_institution_config->update_pay_details(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('institution_config/payment_details');
            }
        }
        if($pay_details_id=='') {
            redirect('institution_config/payment_details');
        }
        $data=sql::row('payment_details','pay_details_id='.$pay_details_id); //Don't Change
        $this->session->set_userdata('pay_details_id',$data['pay_details_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Payment Details','url'=>site_url('institution_config/payment_details')),
                array('title'=>'Edit Payment Details','url'=>'')
        );
        $data['dir']='institution_config';
        $data['page']='edit_pay_details'; //Don't Change
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
}?>