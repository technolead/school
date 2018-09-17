<?php 
/**
 * Description of user
 *
 * @author anwar
 */
class user extends Controller {
    function user() {
        parent::Controller();
        $this->load->model('mod_user');
        common::is_admin();
    }
    function index() {
        //abc_string();
        $data['nav_array']=array(
                array('title'=>'Manage Users','url'=>'')
        );
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("User ID", "First Name", "Last Name", "Email",'Designation','Status');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ), array("name" => "last_name",
                        "index" => "last_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "email",
                        "index" => "email",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "designation",
                        "index" => "designation",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
             array("name" => "status",
                        "index" => "status",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Users", 880, 200, "user_id", "asc", $gridColumn, $gridColumnModel, site_url('user/load_data'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='user';
        $data['page']='index';
        $data['page_title']='Manage User';
        $this->load->view('main',$data);
    }
    public function load_data() {
        $rows = $this->mod_user->get_all_user(); //Don't Change
        $i = 0;
        foreach($rows as $row) {
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['user_id'];
            $responce->rows[$i]['cell']=array($row['user_name'],$row['first_name'],$row['last_name'],$row['email'],$row['designation'],$status);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Md. Anwar Hossain");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }
    function new_user($part='basic') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_user')) {
                $this->mod_user->save_user(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('user');
            }
        }
        if($_POST['continue_part_1']) {
            if($this->form_validation->run('valid_user')) {
                $new_user_id=$this->mod_user->save_user(); //Don't Change
                $this->session->set_userdata('new_user_id',$new_user_id);
                $this->session->set_flashdata('msg','User Added Successfully!!!');
                redirect('user/new_user/user_permission');
            }
        }
        if($_POST['save_permit']) {
            if($this->form_validation->run('valid_permission')) {
                $this->mod_user->save_permission(); //Don't Change
                $this->session->set_flashdata('msg','Permission Set Successfully!!!');
                redirect('user');
            }
        }
        if($_POST['continue_part_2']) {
            if($this->form_validation->run('valid_permission')) {
                $this->mod_user->save_permission(); //Don't Change
                $this->session->set_flashdata('msg','Permission set Successfully!!!');
                redirect('user/new_user/user_permission');
            }
        }

        $data['nav_array']=array(
                array('title'=>'Manage Users','url'=>site_url('user')),
                array('title'=>'Add New User','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='user';
        $data['page']='new_user'; //Don't Change
        $data['part']=$part;
        $data['page_title']='Add New User';
        $this->load->view('main',$data);
    }
    function edit_user($user_id='',$part='edit_basic') {
        if($user_id==''||!is_numeric($user_id)) {
            redirect('user');
        }
        $data=$this->mod_user->get_user_details($user_id); //Don't Change
        if($_POST['update']) {
            if($this->form_validation->run('valid_user')) {
                $this->mod_user->update_user(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('user');
            }
        }
        if($_POST['continue_edit']) {
            if($this->form_validation->run('valid_user')) {
                $this->mod_user->update_user(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                if(sql::count('permission',"user_id=$user_id")>0) {
                    redirect('user/edit_user/'.$user_id.'/edit_user_permission');
                }else {
                    $this->session->set_userdata('new_user_id',$data['user_id']);
                    redirect('user/new_user/user_permission');
                }
            }
        }
        if($_POST['update_permit']) {
            if($this->form_validation->run('valid_permission')) {
                $this->mod_user->update_permission(); //Don't Change
                $this->session->set_flashdata('msg','Permission Updated Successfully!!!');
                redirect('user');
            }
        }
        $this->session->set_userdata('edit_user_id',$data['user_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Users','url'=>site_url('user')),
                array('title'=>'Edit User','url'=>'')
        );
        $edit_user_id=$this->session->userdata('edit_user_id');
        $data['permit']=sql::row('permission',"user_id=$edit_user_id");
        $data['dir']='user';
        $data['part']=$part;
        $data['page']='edit_user'; //Don't Change
        $data['page_title']='Edit User';
        $this->load->view('main',$data);
    }
    function user_name_check() {
        $str=$_POST['user_name'];
        if($_POST['update']||$_POST['continue_edit']) {
            return TRUE;
        }
        if (sql::count('user',"user_name='$str'")>0) {
            $this->form_validation->set_message('user_name_check', 'This User ID already used in another account.');
            return FALSE;
        }else {
            return TRUE;
        }
    }
    function generate_user_id() {
        $num=sql::count('user')+1;
        $first=substr($_POST['first_name'],0,1);
        $last=substr($_POST['last_name'],0,1);
        $gen_user_id=$first.$last.date('Hi').$num;
        echo strtoupper($gen_user_id);
    }
    function delete_user() {
        $id=$this->uri->segment(3);
        if($id=='') {
            redirect('user');
        }
        $this->mod_user->delete_user($id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        redirect('user');
    }
    function user_status($status='',$id='') {
        if($id=='') {
            redirect('user');
        }
        common::change_status('user','user_id='.$id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        redirect('user');
    }
    function get_user_list() {
        $data=$this->mod_user->get_user_list();
        echo $data;
    }
    function user_log() {
        $data['nav_array']=array(
                array('title'=>'Manage Users','url'=>site_url('user')),
                array('title'=>'Users Log','url'=>'')
        );
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("User Name", "First Name", "Last Name", "Login",'Logout');
        $gridColumnModel = array(
                array("name" => "user_name",
                        "index" => "user_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ), array("name" => "last_name",
                        "index" => "last_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "login",
                        "index" => "login",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "logout",
                        "index" => "logout",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage User's Log", 880, 200, "login", "desc", $gridColumn, $gridColumnModel, site_url('user/load_user_log'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='user';
        $data['page']='user_log';
        $data['page_title']='Manage User';
        $this->load->view('main',$data);
    }
    function load_user_log(){
        $this->mod_user->get_userlogGridData();
    }
}?>