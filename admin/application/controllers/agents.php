<?php 
/**
 * Description of agents
 *
 * @author anwar
 */

class agents extends Controller {
    function agents() {
        parent::Controller();
        $this->load->model('mod_agents');
        common::is_logged();
    }
    function index() {
        if(!common::is_agents_user()) {
            common::redirect();
        }
        $this->load->model(array('mod_notice','mod_enquiry'));
        $this->load->helper('text');
        $data['msg']=$this->session->flashdata('msg');
        $data['notice']=$this->mod_notice->get_issued_notice('Agents');
        $data['enquiry']=$this->mod_enquiry->get_enquiry_msg('',$this->session->userdata('logged_agents_id'));
        $data['dir']='agents';
        $data['page']='index';
        $data['page_title']='Agents';
        $this->load->view('main',$data);
    }
    function manage_agents() {
        if(!common::user_permit('view','agents')) {
            common::redirect();
        }
        if(!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Agent ID", "Agent Name",'Agent Status','Agent Type','Company Name','Status');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "agent_name",
                        "index" => "agent_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "agent_status",
                        "index" => "agent_status",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "agent_type",
                        "index" => "agent_type",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "company_name",
                        "index" => "company_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 30,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']) {
            $gridObj->setGridOptions("Manage Agents", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url("?c=agents&m=load_agents&user_name={$_POST['user_name']}&name={$_POST['name']}&agent_status={$_POST['agent_status']}&agent_type={$_POST[agent_type]}"), true);
        }else {
            $gridObj->setGridOptions("Manage Agents", 880, 250, "user_name", "asc", $gridColumn, $gridColumnModel, site_url('agents/load_agents'), true);
        }
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Agents','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='agents';
        $data['page']='manage_agents';
        $data['page_title']='Manage Agents';
        $this->load->view('main',$data);
    }
    function load_agents() {
        $this->mod_agents->get_agentGridData();
    }
  
    function new_agent($part='basic') {
        if(!common::user_permit('add','agents')||!common::is_admin_user()) {
            common::redirect();
        }
//        if($_POST['continue']) {
//            if($this->form_validation->run('agent_basic')) {
//                $agent_id=$this->mod_agents->save_agents(); //Don't Change
//                $this->session->set_userdata('con_agent_id',$agent_id);
//                $this->session->set_flashdata('msg','Successfully Added!!!');
//                redirect('agents/manage_agents');
//            }
//        }

         if($_POST['continue']) {
            if($this->form_validation->run('agent_basic')) {
                $agent_id=$this->mod_agents->save_agents(); //Don't Change
                $this->session->set_userdata('con_agent_id',$agent_id);
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('agents/new_agent/contact');
            }
        }
        if($_POST['finish']) {
            if($this->form_validation->run('agent_contact')) {
                $this->mod_agents->save_agent_contact(); //Don't Change
                $this->session->set_flashdata('msg','Agent Added Successfully!!!');
                redirect('agents/manage_agents');
            }
        }
        
        $data['nav_array']=array(
                array('title'=>'Manage Agents','url'=>site_url('agents/manage_agents')),
                array('title'=>'Add New Agents','url'=>'')
        );
        $data['dir']='agents';
        $data['part']=$part;
        $data['page']='new_agent'; //Don't Change
        $data['page_title']='Add New agents';
        $this->load->view('main',$data);
    }
    function edit_agent($agents_id='',$part='edit_basic') {
        if(!common::user_permit('add','agents')||!common::is_admin_user()) {
            common::redirect();
        }
         if($_POST['update']) {
            if($this->form_validation->run('agent_basic')) {
                $this->mod_agents->update_agents(); //Don't Change
                $this->session->set_flashdata('msg','Agents information updated successfully!!!');
                redirect('agents/manage_agents');
            }
        }
        if($_POST['continue']) {
            if($this->form_validation->run('agent_basic')) {
                $this->mod_agents->update_agents(); //Don't Change
                $this->session->set_flashdata('msg','Agents information updated successfully!!!');
                redirect('agents/edit_agent/'.$agents_id.'/edit_contact');
            }
        }
         if($_POST['finish']) {
            if($this->form_validation->run('agent_contact')) {
                $this->mod_agents->update_agent_contract(); //Don't Change
                $this->session->set_flashdata('msg','Agents information updated successfully!!!');
                redirect('agents/manage_agents');
            }
        }
//        if($_POST['update']) {
//            if($this->form_validation->run('agent_basic')) {
//                $this->mod_agents->update_agents(); //Don't Change
//                $this->session->set_flashdata('msg','Agents information updated successfully!!!');
//                redirect('agents/manage_agents');
//            }
//        }
        if($agents_id=='') {
            redirect('agents/manage_agents');
        }
        $data=sql::row('agents','agents_id='.$agents_id); //Don't Change
        $this->session->set_userdata('agents_id',$data['agents_id']); //Don't Change

        if($part=='edit_contact') {
            $data=sql::row('agent_contact','agents_id='.$agents_id);
            if($data['agent_contact_id']=='') {
                $this->session->set_userdata('con_agent_id',$agents_id);
                redirect('agents/new_agent/contact');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage agents','url'=>site_url('agents')),
                array('title'=>'Edit agents','url'=>'')
        );
        $data['dir']='agents';
        $data['part']=$part;
        $data['page']='edit_agent'; //Don't Change
        $data['page_title']='Edit agent';
        $this->load->view('main',$data);
    }
    function delete_agents($agents_id='') {
        if(!common::user_permit('delete','agents')||!common::is_admin_user()) {
            common::redirect();
        }
        if($agents_id=='') {
            redirect('agents/manage_agents');
        }
        $this->mod_agents->delete_agents($agents_id); //Don't Change
        sql::delete('agent_contact',"agents_id=$agents_id");
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('agents/manage_agents');
    }
    function agents_status($status='1',$agents_id='') {
        if(!common::user_permit('add','agents')||!common::is_admin_user()) {
            common::redirect();
        }
        if($agents_id=='') {
            redirect('agents/manage_agents');
        }
        common::change_status('agents','agents_id='.$agents_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('agents/manage_agents');
    }
    function print_view($agents_id='') {
        if($agents_id=='') {
            redirect('agents/manage_agents');
        }
        $data=$this->mod_agents->get_agents_details($agents_id);
        $data['dir']='agents';
        $data['page']='print_view';
        $data['page_title']='Agents Details View';
        $this->load->view('print_main',$data);
    }
    function profile($agents_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($agents_id=='') {
            common::redirect();
        }
        $data=$this->mod_agents->get_agents_details($agents_id);
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('agents/profile/'.$agents_id.'/');
        $config['total_rows'] = count($this->mod_agents->get_agents_students($agents_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links('#tabs-2');
        $data['rows']=$this->mod_agents->get_agents_students($agents_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['nav_array']=array(
                array('title'=>'Manage Agents','url'=>site_url('agents/manage_agents')),
                array('title'=>$data['first_name'].' '.$data['last_name'],'url'=>'')
        );
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        $data['dir']='agents';
        $data['page']='profile';
        $data['page_title']='Agents Profile';
        $this->load->view('main',$data);
    }

    function get_agent_list() {
        $data=$this->mod_agents->get_agent_list();
        echo $data;
    }
}?>