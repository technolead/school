<?php 
/**
 * Description of mod_agents
 *
 * @author anwar
 */

class mod_agents extends Model {
    function mod_agents() {
        parent::Model();
    }
    function get_agentGridData() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $con='1';
        $user_name=common::getVar('user_name');
        $name=common::getVar('name');
        $agent_status=common::getVar('agent_status');
        $agent_type=common::getVar('agent_type');

        if($user_name!='') {
            $con.=" and user_name like '{$user_name}'";
        }
        if($name!='') {
            $con.=" and (first_name = '%$name%' or last_name = '%$name%')";
        }
        if($agent_status!='') {
            $con.=" and agent_status like '$agent_status'";
        }
        if($agent_type!='') {
            $con.=" and agent_type like '$agent_type'";
        }

        $sql="select * from agents where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('agents',$con);
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
		$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $href='<a href="'.site_url('agents/profile/'.$row['agents_id']).'" class="bold blue">'.$row['first_name'].' '.$row['last_name'].'</a>';
            $responce->rows[$i]['id']=$row['agents_id'];
            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['agent_status'],$row['agent_type'],$row['company_name'],$status);
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
    function get_all_agents($limit='') {
        $sql=$this->db->query("select a.* from agents as a where 1=1 $limit");
        return $sql->result_array();
    }

    function filter_agents($limit='') {
        $con='';
        if($_POST['user_name']!='') {
            $con.=" and a.user_name like '{$_POST['user_name']}'";
        }
        if($_POST['name']!='') {
            $con.=" and a.last_name like '{$_POST['name']}'";
        }
        if($_POST['date_of_birth']!='') {
            $con.=" and a.date_of_birth = '{$_POST['date_of_birth']}'";
        }

        if($_POST['agent_status']!='') {
            $con.=" and a.agent_status like '{$_POST['agent_status']}'";
        }

        if($_POST['agent_type']!='') {
            $con.=" and a.agent_type like '{$_POST['agent_type']}'";
        }

        $sql=$this->db->query("select a.* from agents as a where 1=1 $ins_con $con $limit");
        return $sql->result_array();
    }

    function save_agents() {
        $user_id=$this->session->userdata('user_id');
        $user_name= $_POST['user_name']; //common::generate_user_name($_POST['first_name'], $_POST['last_name']);
        common::save_as_user($user_name,'agents',$_POST['first_name'], $_POST['last_name']);
        $msg="Your Account has been created.
               <br />The Account Activate Information:<br />
                User ID: $user_name<br />
                Password: $user_name<br /><br />
                Support Online <br />
                College Management Team";
        $site=common::get_settings_data();
        $from=$site['admin_email'];
        $from_name='Admin[College Management]';
        $to=$_POST['email'];
        $subject="Account Information";
        common::sending_mail($from, $from_name, $to, $subject, $msg);

        $sql="insert into agents set
                user_id={$this->db->escape($user_id)},
                user_name={$this->db->escape($user_name)},
                title={$this->db->escape($_POST['title'])},
                gender={$this->db->escape($_POST['gender'])},
                first_name={$this->db->escape($_POST['first_name'])},
                last_name={$this->db->escape($_POST['last_name'])},
                date_of_birth={$this->db->escape($_POST['date_of_birth'])},
                nationality={$this->db->escape($_POST['nationality'])},
                company_name={$this->db->escape($_POST['company_name'])},
                address_1={$this->db->escape($_POST['address_1'])},
                telephone_1={$this->db->escape($_POST['telephone_1'])},
                mobile_1={$this->db->escape($_POST['mobile_1'])},
                fax={$this->db->escape($_POST['fax'])},
                email={$this->db->escape($_POST['email'])},
                admission_date={$this->db->escape($_POST['admission_date'])},
                agent_type={$this->db->escape($_POST['agent_type'])},
                agent_status={$this->db->escape($_POST['agent_status'])},
                status_change={$this->db->escape($_POST['status_change'])},
                comments={$this->db->escape($_POST['comments'])}
                ";
        $this->db->query($sql);
        return $this->db->insert_id();
    }
    function save_agent_contact() {
        $agent_id=$this->session->userdata('con_agent_id');
        if($agent_id=='') {
            redirect('agents/new_agent');
        }
        $sql="insert into agent_contact set
                agents_id={$this->db->escape($agent_id)},
		admission_date={$this->db->escape($_POST['admission_date'])},
                contact_duration={$this->db->escape($_POST['contact_duration'])},
                start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])},
                salary_commission={$this->db->escape($_POST['salary_commission'])},
		total_days_per_week={$this->db->escape($_POST['total_days_per_week'])},
                total_hours_per_week={$this->db->escape($_POST['total_hours_per_week'])},
		salary_type={$this->db->escape($_POST['salary_type'])},
                gross_pay={$this->db->escape($_POST['gross_pay'])},
                net_pay={$this->db->escape($_POST['net_pay'])},
		ni_number={$this->db->escape($_POST['ni_number'])},
		reg_fee={$this->db->escape($_POST['reg_fee'])},
		min_deposit={$this->db->escape($_POST['min_deposit'])},
                int_commission={$this->db->escape($_POST['int_commission'])},
                local_commission={$this->db->escape($_POST['local_commission'])},
                int_comm_reg_fee={$this->db->escape($_POST['int_comm_reg_fee'])},
                local_comm_reg_fee={$this->db->escape($_POST['local_comm_reg_fee'])},
		int_comm_tuition_fee={$this->db->escape($_POST['int_comm_tuition_fee'])},
                local_comm_tuition_fee={$this->db->escape($_POST['local_comm_tuition_fee'])},
                fixed_amt_per_student={$this->db->escape($_POST['fixed_amt_per_student'])},
                contact_comment={$this->db->escape($_POST['contact_comment'])}";
        return $this->db->query($sql);
    }
    function update_agents() {
        $agents_id=$this->session->userdata('agents_id');
        $sql="update agents set
                user_name={$this->db->escape($_POST['user_name'])},
                title={$this->db->escape($_POST['title'])},
                gender={$this->db->escape($_POST['gender'])},
                first_name={$this->db->escape($_POST['first_name'])},
                last_name={$this->db->escape($_POST['last_name'])},
                date_of_birth={$this->db->escape($_POST['date_of_birth'])},
                nationality={$this->db->escape($_POST['nationality'])},
                admission_date={$this->db->escape($_POST['admission_date'])},
                company_name={$this->db->escape($_POST['company_name'])},
                address_1={$this->db->escape($_POST['address_1'])},
                telephone_1={$this->db->escape($_POST['telephone_1'])},
                mobile_1={$this->db->escape($_POST['mobile_1'])},
                fax={$this->db->escape($_POST['fax'])},
                email={$this->db->escape($_POST['email'])},
                agent_type={$this->db->escape($_POST['agent_type'])},
                agent_status={$this->db->escape($_POST['agent_status'])},
                status_change={$this->db->escape($_POST['status_change'])},
                comments={$this->db->escape($_POST['comments'])}
                where agents_id=$agents_id";
        return $this->db->query($sql);
    }
    function update_agent_contract() {
        $agents_id=$this->session->userdata('agents_id');
        if($agents_id=='') {
            redirect('agents');
        }
        $sql="update agent_contact set
                admission_date={$this->db->escape($_POST['admission_date'])},
                contact_duration={$this->db->escape($_POST['contact_duration'])},
                start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])},
                salary_commission={$this->db->escape($_POST['salary_commission'])},
		total_days_per_week={$this->db->escape($_POST['total_days_per_week'])},
                total_hours_per_week={$this->db->escape($_POST['total_hours_per_week'])},
		salary_type={$this->db->escape($_POST['salary_type'])},
                gross_pay={$this->db->escape($_POST['gross_pay'])},
                net_pay={$this->db->escape($_POST['net_pay'])},
		ni_number={$this->db->escape($_POST['ni_number'])},
		reg_fee={$this->db->escape($_POST['reg_fee'])},
		min_deposit={$this->db->escape($_POST['min_deposit'])},
                int_commission={$this->db->escape($_POST['int_commission'])},
                local_commission={$this->db->escape($_POST['local_commission'])},
                int_comm_reg_fee={$this->db->escape($_POST['int_comm_reg_fee'])},
                local_comm_reg_fee={$this->db->escape($_POST['local_comm_reg_fee'])},
		int_comm_tuition_fee={$this->db->escape($_POST['int_comm_tuition_fee'])},
                local_comm_tuition_fee={$this->db->escape($_POST['local_comm_tuition_fee'])},
                fixed_amt_per_student={$this->db->escape($_POST['fixed_amt_per_student'])},
                contact_comment={$this->db->escape($_POST['contact_comment'])}
                where agents_id=$agents_id";
        return $this->db->query($sql);
    }
    function delete_agents($agents_id) {
        $sql="delete from agents where agents_id=$agents_id";
        return $this->db->query($sql);
    }
    function get_agents_details($agents_id) {
        $sql=$this->db->query("select a.*,c.* from agents as a
                                left join agent_contact as c on c.agents_id=a.agents_id
                                where a.agents_id=$agents_id");
        return $sql->row_array();
    }
    function get_agents_students($agents_id,$limit='') {
        $sql=$this->db->query("select sr.* from view_std_reg as sr join student as s on s.student_id=sr.student_id
                                where s.agents_id=$agents_id and sr.is_recent=1 $limit");
        return $sql->result_array();
    }

    function get_agent_list() {
        $search=$_POST['search'];
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and institution_id=$institution_id";
        }
        $data.="<ul class='width_160'>";
        if($search!='') {
            $sql="select user_name,agents_id from agents where user_name like '$search%' $ins_con";
            $res=$this->db->query($sql);
            $djs=$res->result_array();

            foreach($djs as $row) {
                $data.="<li title='".$row['user_name']."' rel='{$row['agents_id']}'>".$row['user_name'].'</li>';
            }
        }else {
            $data.='<li>Enter Agents ID</li>';
        }
        $data.='</ul>';
        return $data;
    }
    function get_salary_commission($sel='') {
        $rows=array('Salary Only','Salary &amp; Commission','Commission Only','Fixed Commission');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function get_commission_options($sel='') {
        $rows=array('First Deposit','First Year','Whole Tution Fees');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }

    function get_paid_amount($payments_id='') {
        if($payments_id=='') {
            return 0;
        }
        $sql=$this->db->query("select sum(paid_amount) as paid_amount from agent_payment where payments_id=$payments_id");
        $data=$sql->row_array();
        if($data['paid_amount']=='') {
            return 0;
        }
        return $data['paid_amount'];
    }
}?>