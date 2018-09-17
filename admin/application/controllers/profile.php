<?php
class profile extends Controller {
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_profile');
    }
    function student() {
        if(!common::is_student_user()) {
            $this->session->set_flashdata('msg','Critical Error!!!');
            redirect('home/invalid_page');
        }
        $this->load->model('mod_student');
        $data=$this->mod_profile->get_student_info();
        if($data['student_id']=='') {
            redirect('home/invalid_page');
        }
        $data['nav_array']=array(
                array('title'=>$data['first_name'].' '.$data['last_name'],'url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['rows']=$this->mod_student->get_registered_class($data['student_id']);
        
        $data['modules']=$this->mod_student->get_registered_modules($data['student_id']);
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['dir']='profile';
        $data['page']='student'; //Don't Change
        $data['page_title']='Students &raquo; '.$data['first_name'].' '.$data['last_name'];
        $this->load->view('main',$data);
    }
    function edit_std_profile() {
        if(!common::is_student_user()) {
            common::redirect();
        }
        $student_id=$this->session->userdata('logged_student_id');
        if($student_id=='') {
            common::redirect();
        }
        if($_POST['update']) {
            if($this->form_validation->run('valid_std_profile')) {
                if($this->mod_profile->update_std_profile()) {
                    $this->session->set_flashdata('msg','Your Information Updated Successfully!!!');
                    redirect('profile/student');
                }
            }
        }
        $data=sql::row('student',"student_id='$student_id'",'student_id,user_name,title,gender,first_name,last_name,date_of_birth,present_address,permanent_address,email,phone,mobile,student_status');
        $data['dir']='profile';
        $data['page']='edit_std_profile';
        $data['page_title']='Student';
        $this->load->view('main',$data);
    }
    function agent() {
        if(!common::is_agents_user()) {
            common::redirect();
        }
        $this->load->model('mod_agents');
        $agents_id=$this->session->userdata('logged_agents_id');
        if($agents_id=='') {
            redirect('agents');
        }
        $data=$this->mod_agents->get_agents_details($agents_id);
        $this->load->library('pagination');
        $start=$this->uri->segment(4);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('agents/details/'.$agents_id.'/');
        $config['total_rows'] = count($this->mod_agents->get_agents_students($agents_id));
        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();
        $data['rows']=$this->mod_agents->get_agents_students($agents_id,"limit $start,{$config['per_page']}"); //Don't Change
        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];
        $data['dir']='profile';
        $data['page']='agent';
        $data['page_title']='Agents Profile';
        $this->load->view('main',$data);
    }
    function staff() {
        if(!common::is_staff_user()) {
            common::redirect();
        }
        $this->load->model('mod_staffs');
        $staffs_id=$this->session->userdata('logged_staffs_id');
        if($staffs_id=='') {
            redirect('home/invalid_page');
        }

        $con='';
        $branch_id=  $this->session->userdata('branch_id');
        if($branch_id!=''){
            $con.=" and branch_id=$branch_id";
        }

        $data=$this->mod_staffs->get_staffs_details($staffs_id);
        $data['qualifications']=sql::rows('staff_qualifications',"staffs_id=$staffs_id");
        $data['shifts']=sql::rows('staff_shift',"staffs_id=$staffs_id");
        $data['student_rows']=sql::rows('view_std_reg','staff_id='.$staffs_id.' and is_recent=1'.$con.' order by student_name');
        $start=0;
        if(count($data['student_rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }
        $data['end']=$start+count($data['student_rows']);
        $data['total']=count($data['student_rows']);

        $data['module_rows']=$this->mod_profile->get_staffs_modules($staffs_id);

         $start=0;
        if(count($data['module_rows'])>0) {
            $data['mstart']=$start+1;
        }else {
            $data['mstart']=$start;
        }
        $data['mend']=$start+count($data['module_rows']);
        $data['mtotal']=count($data['module_rows']);
        
        $data['dir']='profile';
        $data['page']='staff'; //Don't Change
        $data['page_title']='Staffs Profile';
        $this->load->view('main',$data);
    }
     function view_student($user_name='') {
//        if($user_name=='') {
//            $this->session->set_flashdata('msg','Critical Error!!!');
//            redirect('home/invalid_page');
//        }
        $this->load->model('mod_student');
        $data=$this->mod_profile->get_student_info($user_name);
////        if($data['student_id']=='') {
////            redirect('home/invalid_page');
////        }
        $data['nav_array']=array(
                array('title'=>$data['first_name'].' '.$data['last_name'],'url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['rows']=$this->mod_student->get_registered_class($data['student_id']);
        
        $data['modules']=$this->mod_student->get_registered_modules($data['student_id']);
        $this->session->set_userdata('redirect_url',$this->uri->uri_string());
        $data['dir']='profile';
        $data['page']='student'; //Don't Change
        $data['page_title']='Students &raquo; '.$data['first_name'].' '.$data['last_name'];
        $this->load->view('main',$data);
    }
}
?>