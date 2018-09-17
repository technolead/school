<?php

class mod_user extends Model {
    function mod_user() {
        parent::Model();
    }
    function get_all_user() {
        $sortname = common::getVar('sidx', 'user_id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from user where user_name!='admin' and user_type='admin' $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = count($this->db->query($sql));
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query=$this->db->query($sql." limit $start, $limit");
        return $sql_query->result_array();
    }

    function get_user_details($id) {
        $sql=$this->db->query("select * from user where user_id = $id and user_name!='admin'");
        return $sql->row_array();
    }

    function save_user() {
        $user_name=$_POST['user_name'];
        $password=md5($_POST['user_name']);
        $msg="Your Account has been created.
               <br />The Account Activate Information:<br />
                User ID: $user_name<br />
                Password: $user_name<br /><br />
                Support Online <br />
                College Management Team";

        $site=common::get_settings_data();
        $from=$site['admin_email'];
        $from_name='Admin[School-College Management]';
        $to=$_POST['email'];
        $subject="Account Information";
        common::sending_mail($from, $from_name, $to, $subject, $msg);

        $sql="insert into user set
                user_name={$this->db->escape($_POST['user_name'])},
                password={$this->db->escape($password)},
                first_name={$this->db->escape($_POST['first_name'])},
                last_name={$this->db->escape($_POST['last_name'])},
                email={$this->db->escape($_POST['email'])},
                designation={$this->db->escape($_POST['designation'])},
                user_type='admin'
                ";
        $this->db->query($sql);
        return $this->db->insert_id();
    }
    function update_user() {
        $user_id=$this->session->userdata('edit_user_id');
        $sql="update user set
                user_name={$this->db->escape($_POST['user_name'])},
                first_name={$this->db->escape($_POST['first_name'])},
                last_name={$this->db->escape($_POST['last_name'])},
                email={$this->db->escape($_POST['email'])},
                designation={$this->db->escape($_POST['designation'])}
                where user_id=$user_id";
        return $this->db->query($sql);
    }
    function save_permission() {
        $new_user_id=$this->session->userdata('new_user_id');
        if($new_user_id=='') {
            redirect('user/new_user');
        }

        $user=$this->get_permit_value($_POST['user']);
        $alert=$this->get_permit_value($_POST['alert']);
        $ts_config=$this->get_permit_value($_POST['ts_config']);

        $class=$this->get_permit_value($_POST['class']);
        $branch=  $this->get_permit_value($_POST['branch']);
        $grade=  $this->get_permit_value($_POST['grade']);
        $marking=  $this->get_permit_value($_POST['marking']);
        $module=$this->get_permit_value($_POST['module']);
        
        $session=$this->get_permit_value($_POST['session']);

        $student=$this->get_permit_value($_POST['student']);
        $std_attendance=$this->get_permit_value($_POST['std_attendance']);
        $print_attd=$this->get_permit_value($_POST['print_attd']);
        $arv_attd=$this->get_permit_value($_POST['arv_attd']);
        $exemption=$this->get_permit_value($_POST['exemption']);
       // $counselling=$this->get_permit_value($_POST['counselling']);

        $result=$this->get_permit_value($_POST['result']);
        //$std_account=$this->get_permit_value($_POST['std_account']);

//        $program_fee=$this->get_permit_value($_POST['program_fee']);
//        $level_fee=$this->get_permit_value($_POST['level_fee']);
//        $fee_installment=$this->get_permit_value($_POST['fee_installment']);
//        $std_payment=$this->get_permit_value($_POST['std_payment']);

        $staffs=$this->get_permit_value($_POST['staffs']);
        $staff_attendance=$this->get_permit_value($_POST['staff_attendance']);

//        $staff_account=$this->get_permit_value($_POST['staff_account']);
//        $staff_payment=$this->get_permit_value($_POST['staff_payment']);
//        $staff_balance=$this->get_permit_value($_POST['staff_balance']);


        
//        $agent_account=$this->get_permit_value($_POST['agent_account']);
//        $agent_payment=$this->get_permit_value($_POST['agent_payment']);

        $letters=$this->get_permit_value($_POST['letters']);
        $library=$this->get_permit_value($_POST['library']);
        $up_history=$this->get_permit_value($_POST['up_history']);

        $progress_rep=$this->get_permit_value($_POST['progress_rep']);
        $std_report=$this->get_permit_value($_POST['std_report']);
//        $std_acc_report=$this->get_permit_value($_POST['std_acc_report']);
        $std_attd_rep=$this->get_permit_value($_POST['std_attd_rep']);

        $staff_report=$this->get_permit_value($_POST['staff_report']);
        $staff_acc_rep=$this->get_permit_value($_POST['staff_acc_rep']);
        

//        $account_rep=$this->get_permit_value($_POST['account_rep']);
        $letter_rep=$this->get_permit_value($_POST['letter_rep']);
        $library_rep=$this->get_permit_value($_POST['library_rep']);

        $admission_fee=$this->get_permit_value($_POST['admission_fee']);
        $class_fee=$this->get_permit_value($_POST['class_fee']);
        $exam_fee=$this->get_permit_value($_POST['exam_fee']);
        $additional_fee=  $this->get_permit_value($_POST['additional_fee']);

        $sql="insert into permission set
                user_id=$new_user_id,
                user=$user,
                alert=$alert,
                ts_config=$ts_config,
                class=$class,
                branch=$branch,
                grade=$grade,
                marking=$marking,
                module=$module,
                session=$session,
                student=$student,
                std_attendance=$std_attendance,
                print_attd=$print_attd,
                arv_attd=$arv_attd,
                exemption=$exemption,
                result=$result,
                staffs=$staffs,
                staff_attendance=$staff_attendance,
                letters=$letters,
                library=$library,
                up_history=$up_history,
                progress_rep=$progress_rep,
                std_report=$std_report,
                std_attd_rep=$std_attd_rep,
                letter_rep=$letter_rep,
                library_rep=$library_rep,
                staff_report=$staff_report,
                staff_acc_rep=$staff_acc_rep,
                admission_fee=$admission_fee,
                class_fee=$class_fee,
                exam_fee=$exam_fee,
                additional_fee=$additional_fee
                ";
        return $this->db->query($sql);
    }
    function update_permission() {
        $edit_user_id=$this->session->userdata('edit_user_id');
        if($edit_user_id=='') {
            redirect('user');
        }
        $user=$this->get_permit_value($_POST['user']);
        $alert=$this->get_permit_value($_POST['alert']);
        $ts_config=$this->get_permit_value($_POST['ts_config']);
        $class=$this->get_permit_value($_POST['class']);
        $branch=  $this->get_permit_value($_POST['branch']);
        $grade=  $this->get_permit_value($_POST['grade']);
        $marking=  $this->get_permit_value($_POST['marking']);
        $module=$this->get_permit_value($_POST['module']);
        $session=$this->get_permit_value($_POST['session']);
        $student=$this->get_permit_value($_POST['student']);
        $std_attendance=$this->get_permit_value($_POST['std_attendance']);

        $print_attd=$this->get_permit_value($_POST['print_attd']);
        $arv_attd=$this->get_permit_value($_POST['arv_attd']);
        $exemption=$this->get_permit_value($_POST['exemption']);
        //$counselling=$this->get_permit_value($_POST['counselling']);

        $result=$this->get_permit_value($_POST['result']);
        //$std_account=$this->get_permit_value($_POST['std_account']);

//        $program_fee=$this->get_permit_value($_POST['program_fee']);
//        $level_fee=$this->get_permit_value($_POST['level_fee']);
//        $fee_installment=$this->get_permit_value($_POST['fee_installment']);
//        $std_payment=$this->get_permit_value($_POST['std_payment']);

        $staffs=$this->get_permit_value($_POST['staffs']);
        $staff_attendance=$this->get_permit_value($_POST['staff_attendance']);

        $staff_account=$this->get_permit_value($_POST['staff_account']);
        $staff_payment=$this->get_permit_value($_POST['staff_payment']);
        $staff_balance=$this->get_permit_value($_POST['staff_balance']);

        
//        $agent_account=$this->get_permit_value($_POST['agent_account']);
//        $agent_payment=$this->get_permit_value($_POST['agent_payment']);

        $letters=$this->get_permit_value($_POST['letters']);
        $library=$this->get_permit_value($_POST['library']);
        $up_history=$this->get_permit_value($_POST['up_history']);

        $progress_rep=$this->get_permit_value($_POST['progress_rep']);
        $std_report=$this->get_permit_value($_POST['std_report']);
//        $std_acc_report=$this->get_permit_value($_POST['std_acc_report']);
        $std_attd_rep=$this->get_permit_value($_POST['std_attd_rep']);

        $staff_report=$this->get_permit_value($_POST['staff_report']);
//        $staff_acc_rep=$this->get_permit_value($_POST['staff_acc_rep']);
        

//        $account_rep=$this->get_permit_value($_POST['account_rep']);
        $letter_rep=$this->get_permit_value($_POST['letter_rep']);
        $library_rep=$this->get_permit_value($_POST['library_rep']);
        
        $admission_fee=$this->get_permit_value($_POST['admission_fee']);
        $class_fee=$this->get_permit_value($_POST['class_fee']);
        $exam_fee=$this->get_permit_value($_POST['exam_fee']);
        $additional_fee=  $this->get_permit_value($_POST['additional_fee']);

        $sql="update permission set
                        user=$user,
                        alert=$alert,
                        ts_config=$ts_config,
                        class=$class,
                        branch=$branch,
                        grade=$grade,
                        marking=$marking,
                        module=$module,
                        session=$session,
                        student=$student,
                        std_attendance=$std_attendance,
                        print_attd=$print_attd,
                        arv_attd=$arv_attd,
                        exemption=$exemption,
                        result=$result,
                        staffs=$staffs,
                        staff_attendance=$staff_attendance,
                        letters=$letters,
                        library=$library,
                        up_history=$up_history,
                        progress_rep=$progress_rep,
                        std_report=$std_report,
                        std_attd_rep=$std_attd_rep,
                        letter_rep=$letter_rep,
                        library_rep=$library_rep,
                        staff_report=$staff_report,
                        admission_fee=$admission_fee,
                        class_fee=$class_fee,
                        exam_fee=$exam_fee,
                        additional_fee=$additional_fee
                        where user_id=$edit_user_id
                ";
        $this->db->query($sql);
    }
    function get_permit_value($permit_array) {
        $permit=0;
        if(count($permit_array)>0) {
            foreach($permit_array as $per) {
                $permit+=$per;
            }
        }
        return $permit;
    }
    function delete_user($user_id) {
        $sql="delete from user where user_id=$user_id and user_name!='admin'";
        return $this->db->query($sql);
    }
    function get_user_list() {
        $search=$_POST['search'];
        $data.="<ul class='width_160'>";
        if($search!='') {
            $sql="select user_name,concat(first_name,' ',last_name) as name from user where user_name like '$search%'";
            $res=$this->db->query($sql);
            $djs=$res->result_array();

            foreach($djs as $row) {
                $data.="<li title='".$row['user_name']."' rel='{$row['name']}'>".$row['user_name'].'</li>';
            }
        }else {
            $data.='<li>Enter ID No</li>';
        }
        $data.='</ul>';
        return $data;
    }
    function get_userlogGridData(){
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select u.user_name,u.first_name,u.last_name,l.*  from user_log as l
              join user as u on u.user_id=l.user_id where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('user_log','1=1');
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query=$this->db->query($sql." limit $start, $limit");
        $rows=$sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $responce->rows[$i]['id']=$row['user_log_id'];
            $responce->rows[$i]['cell']=array($row['user_name'],$row['first_name'],$row['last_name'],$row['login'],$row['logout']);
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
}


?>