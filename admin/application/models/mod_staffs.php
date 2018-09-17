<?php
/**
 * Description of mod_staffs
 *
 * @author anwar
 */

class mod_staffs extends Model {
    function mod_staffs() {
        parent::Model();
    }

    function get_search_options($sel='') {
        $arr = array(
            's.first_name' => 'First Name',
            's.last_name' => 'Last Name',
            's.user_name' => 'Staff ID',
            's.email' => 'Staff Email',
            's.mobile' => 'Mobile Number',
            's.present_address' => 'Present Address',
            'sd.designation' => 'Designation'
        );

        $opt = '<option value="">Select Search Key</option>';
        foreach ($arr as $key => $val) {
            if ($key == $sel) {
                $opt.="<option value='$key' selected='selected'>$val</option>";
            } else {
                $opt.="<option value='$key'>$val</option>";
            }
        }
        return $opt;
    }

    function get_staffGridData() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con = '1';
        
        $user_name = $this->session->userdata('staff_user_name');
        $name = $this->session->userdata('staff_name');
        $bdate = $this->session->userdata('date_of_birth');
        $status = $this->session->userdata('staff_status');
        $branch_id=  $this->session->userdata('branch_id');
        

        if ($user_name != '') {
            $con.=" and s.user_name like '{$user_name}'";
        }
        if ($name != '') {
            $con.=" and s.last_name like '{$name}'";
        }
        if ($bdate != '') {
            $con.=" and s.date_of_birth = '{$bdate}'";
        }
       
        if ($status != '') {
            $con.=" and s.staff_status like '{$status}'";
        }

        if($branch_id!=''){
            $con.=" and s.branch_id=$branch_id";
        }


        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        if ($searchField != '' && $searchValue != '') {
            $con.=' and ' . $searchField . ' like "%' . $searchValue . '%"';
        }

        
        $sql="select s.status,s.staffs_id,s.user_name,s.first_name,s.last_name,s.designation_id,sd.designation,c.employ_type,c.employ_nature,c.start_date,d.name as department_name from staffs as s
                join staff_department as d on d.staff_department_id=s.department_id
                join staff_designation as sd on s.designation_id=sd.staff_designation_id
                left join staff_contract as c on c.staffs_id=s.staffs_id
                where $con $sort";

        
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('staffs','1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['staffs_id'];
            $href='<a href="'.site_url('staffs/profile/'.$row['staffs_id']).'" class="bold blue">'.$row['first_name'].' '.$row['last_name'].'</a>';
            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['department_name'],$row['designation'],$row['employ_type'],$row[employ_nature],$status);
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
    function get_departmentGrid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $sql="select * from staff_department where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('staff_department','1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['staff_department_id'];
            $responce->rows[$i]['cell']=array($row['name'],$status);
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
    function get_all_staffs($department_id='',$limit='') {
        if($department_id=='all'||$department_id==''||!is_numeric($department_id)) {
            $con='1=1';
        }else {
            $con="department_id=$department_id";
        }
        $sql=$this->db->query("select s.staffs_id,s.user_name,s.first_name,s.last_name,s.passport_expiry,s.visa_expiry,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day,s.designation,c.employ_type,c.employ_nature,c.start_date,d.name as department_name from staffs as s
                                    join staff_department as d on d.staff_department_id=s.department_id
                                    left join staff_contact as c on c.staffs_id=s.staffs_id
                                    where $con $limit");
        return $sql->result_array();
    }
    function filter_staffs($department_id='') {
        $con='';
        if(is_numeric($department_id)) {
            $con="department_id=$department_id";
        }else {
            $con="1=1";
        }

        if($_POST['user_name']!='') {
            $con.=" and s.user_name like '{$_POST['user_name']}'";
        }
        if($_POST['name']!='') {
            $con.=" and s.last_name like '{$_POST['name']}'";
        }
        if($_POST['date_of_birth']!='') {
            $con.=" and s.date_of_birth = '{$_POST['date_of_birth']}'";
        }

        if($_POST['staff_status']!='') {
            $con.=" and s.staff_status like '{$_POST['staff_status']}'";
        }
        if($_POST['pass_from_date']!='') {
            $con.=" and passport_expiry BETWEEN '{$_POST['pass_from_date']}' AND '{$_POST['pass_to_date']}'";
        }
        if($_POST['visa_from_date']!='') {
            $con.=" and visa_expiry BETWEEN '{$_POST['visa_from_date']}' AND '{$_POST['visa_to_date']}'";
        }

        $sql=$this->db->query("select s.staffs_id,s.user_name,s.first_name,s.last_name,s.passport_expiry,s.visa_expiry,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day,s.designation,c.employ_type,c.employ_nature,c.start_date,d.name as department_name from staffs as s
                                    join staff_department as d on d.staff_department_id=s.department_id
                                    left join staff_contact as c on c.staffs_id=s.staffs_id
                                    where $con $ins_con $limit");
        return $sql->result_array();
    }
    function get_staffs_details($staffs_id='') {
        if($staffs_id=='') {
            return '';
        }
        $sql=$this->db->query("select s.*,c.*,d.name as department_name,s.staffs_id,sd.designation from staffs as s
                                    join staff_department as d on d.staff_department_id=s.department_id
                                    join staff_designation as sd on s.designation_id=sd.staff_designation_id
                                    left join staff_contract as c on c.staffs_id=s.staffs_id
                                    where s.staffs_id=$staffs_id");
        return $sql->row_array();
    }
    function save_staff() {
        $user_id=$this->session->userdata('user_id');
        $photograph='';
        if($_FILES['photograph']['name']!='') {
            $photograph=$this->add_photograph();
        }
        $documents='';
        if($_FILES['documents']['name']!='') {
            $documents=$this->add_documents();
        }
        $user_name=$_POST['user_name']; //common::generate_user_name($_POST['first_name'], $_POST['last_name']);
        common::save_as_user($user_name,'staffs',$_POST['first_name'], $_POST['last_name'],$_POST['email']);
        $msg="Your Account has been created.
               <br />The Account Activate Information:<br />
                User ID: $user_name<br />
                Password: $user_name<br /><br />
                Support Online <br />
                School-College Management Team";

        $site=common::get_settings_data();
        $from=$site['admin_email'];
        $from_name='Admin[School-College Management]';
        $to=$_POST['email'];
        $subject="Account Information";
        //common::sending_mail($from, $from_name, $to, $subject, $msg);

        $training_id = '';
        if (count($_POST['training_id']) > 0) {
            $training_id = implode(',', $_POST['training_id']);
        }


        $sql="insert into staffs set
            user_id={$this->db->escape($user_id)},
            user_name={$this->db->escape($user_name)},
            title={$this->db->escape($_POST['title'])},
            gender={$this->db->escape($_POST['gender'])},
            first_name={$this->db->escape($_POST['first_name'])},
            last_name={$this->db->escape($_POST['last_name'])},
            date_of_birth={$this->db->escape($_POST['date_of_birth'])},
            present_address={$this->db->escape($_POST['present_address'])},
            permanent_address={$this->db->escape($_POST['permanent_address'])},
            phone={$this->db->escape($_POST['telephone'])},
            mobile={$this->db->escape($_POST['mobile'])},
            email={$this->db->escape($_POST['email'])},
            designation_id={$this->db->escape($_POST['designation_id'])},
            department_id={$this->db->escape($_POST['department_id'])},
            mpo_listed={$this->db->escape($_POST['mpo_listed'])},
            training_id={$this->db->escape($training_id)},
            staff_status={$this->db->escape($_POST['staff_status'])},
            status_change_date={$this->db->escape($_POST['status_change_date'])},
            branch_id={$this->db->escape($_POST['branch_id'])},
            nationality={$this->db->escape($_POST['nationality'])},
            marital_status={$this->db->escape($_POST['marital_status'])},
            ielts_score={$this->db->escape($_POST['ielts_score'])},
            qualification_verification={$this->db->escape($_POST['qualification_verification'])},
              photograph={$this->db->escape($photograph)},
            documents={$this->db->escape($documents)},
            comments={$this->db->escape($_POST['comments'])}
                ";
        $this->db->query($sql);
        return $this->db->insert_id();
    }
    function save_qualifiaction($staffs_id) {
        if(count($_POST['qualifications'])>0) {
            $inc=0;
            foreach($_POST['qualifications'] as $qualification) {
                if($qualification!='') {
                    $sql="insert into staff_qualifications set
                        staffs_id=$staffs_id,
                        qualification={$this->db->escape($qualification)},
                        awarding_body={$this->db->escape($_POST['awarding_body'][$inc])},
                        year={$this->db->escape($_POST['year'][$inc])},
                        grade={$this->db->escape($_POST['grade'][$inc])}";
                    $this->db->query($sql);
                }
                $inc++;
            }
        }
    }
    function save_experience($staffs_id) {
        if(count($_POST['position'])>0) {
            $inc=0;
            foreach($_POST['position'] as $position) {
                if($position!='') {
                    $sql="insert into staff_experience set
                        staffs_id=$staffs_id,
                        position={$this->db->escape($position)},
                        duration_from={$this->db->escape($_POST['duration_from'][$inc])},
                        duration_to={$this->db->escape($_POST['duration_to'][$inc])},
                        employer_details={$this->db->escape($_POST['employer_details'][$inc])},
                        responsibilities={$this->db->escape($_POST['responsibilities'][$inc])}";
                    $this->db->query($sql);
                }
                $inc++;
            }
        }
    }
    function save_staff_contract() {
        $staffs_id=$this->session->userdata('con_staff_id');
        if($staffs_id=='') {
            redirect('staffs');
        }
        $this->save_shift($staffs_id);
        $sql="insert into staff_contract set
                staffs_id={$this->db->escape($staffs_id)},
		admission_date={$this->db->escape($_POST['admission_date'])},
                employ_type={$this->db->escape($_POST['employ_type'])},
                employ_nature={$this->db->escape($_POST['employ_nature'])},
                employ_duration={$this->db->escape($_POST['employ_duration'])},
		start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])},
                days_per_week={$this->db->escape($_POST['days_per_week'])},
                hours_per_week={$this->db->escape($_POST['hours_per_week'])},
                salary_type={$this->db->escape($_POST['salary_type'])},
                amount={$this->db->escape($_POST['amount'])},
		ni_number={$this->db->escape($_POST['ni_number'])},
                contract_comment={$this->db->escape($_POST['contract_comment'])}";
        return $this->db->query($sql);
    }
    function save_shift($staffs_id) {
        if(count($_POST['day'])>0) {
            $inc=0;
            sql::delete('staff_shift',"staffs_id=$staffs_id");
            foreach($_POST['day'] as $day) {
                $sql="insert into staff_shift set
                staffs_id={$this->db->escape($staffs_id)},
                day_of_week={$this->db->escape($day)},
                from_time={$this->db->escape($_POST['from_time'][$inc])},
                to_time={$this->db->escape($_POST['to_time'][$inc])}";
                //shift={$this->db->escape($_POST['shift'][$inc])}";
                $this->db->query($sql);
                $inc++;
            }
        }
    }
    function update_staff() {
        $staffs_id=$this->session->userdata('staffs_id');

        $photograph='';
        if($_FILES['photograph']['name']!='') {
            $photograph=$this->add_photograph($_POST['h_photograph']);
        }else {
            $photograph=$_POST['h_photograph'];
        }
        $documents='';
        if($_FILES['documents']['name']!='') {
            $documents=$this->add_documents($_POST['h_documents']);
        }else {
            $documents=$_POST['h_documents'];
        }


        $training_id = '';
        if (count($_POST['training_id']) > 0) {
            $training_id = implode(',', $_POST['training_id']);
        }

        $user_name=$_POST['user_name'];
        $sql="update staffs set
            user_name={$this->db->escape($user_name)},
            title={$this->db->escape($_POST['title'])},
	    gender={$this->db->escape($_POST['gender'])},
            first_name={$this->db->escape($_POST['first_name'])},
            last_name={$this->db->escape($_POST['last_name'])},
            date_of_birth={$this->db->escape($_POST['date_of_birth'])},
            present_address={$this->db->escape($_POST['present_address'])},
            permanent_address={$this->db->escape($_POST['permanent_address'])},
            phone={$this->db->escape($_POST['telephone'])},
            mobile={$this->db->escape($_POST['mobile'])},
            email={$this->db->escape($_POST['email'])},
            designation_id={$this->db->escape($_POST['designation_id'])},
            department_id={$this->db->escape($_POST['department_id'])},
            mpo_listed={$this->db->escape($_POST['mpo_listed'])},
            training_id={$this->db->escape($training_id)},
            staff_status={$this->db->escape($_POST['staff_status'])},
            status_change_date={$this->db->escape($_POST['status_change_date'])},
            branch_id={$this->db->escape($_POST['branch_id'])},
            nationality={$this->db->escape($_POST['nationality'])},
            marital_status={$this->db->escape($_POST['marital_status'])},
            ielts_score={$this->db->escape($_POST['ielts_score'])},
            qualification_verification={$this->db->escape($_POST['qualification_verification'])},
            photograph={$this->db->escape($photograph)},
            documents={$this->db->escape($documents)},
            comments={$this->db->escape($_POST['comments'])}
            where staffs_id=$staffs_id";
        return $this->db->query($sql);
    }
    function update_staff_contract() {
        $staffs_id=$this->session->userdata('staffs_id');
        if($staffs_id=='') {
            redirect('staffs');
        }
        $this->save_shift($staffs_id);
        $sql="update staff_contract set
                staffs_id={$this->db->escape($staffs_id)},
		admission_date={$this->db->escape($_POST['admission_date'])},
                employ_type={$this->db->escape($_POST['employ_type'])},
                employ_nature={$this->db->escape($_POST['employ_nature'])},
                employ_duration={$this->db->escape($_POST['employ_duration'])},
		start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])},
                days_per_week={$this->db->escape($_POST['days_per_week'])},
                hours_per_week={$this->db->escape($_POST['hours_per_week'])},
                salary_type={$this->db->escape($_POST['salary_type'])},
                amount={$this->db->escape($_POST['amount'])},
		ni_number={$this->db->escape($_POST['ni_number'])},
                contract_comment={$this->db->escape($_POST['contract_comment'])}
                where staffs_id=$staffs_id";
        return $this->db->query($sql);
    }

    function get_shift_options($sel='') {
        $rows=array(1=>'Shift 1',2=>'Shift 2',3=>'Shift 3');
        $opt.='';
        foreach($rows as $k=>$row) {
            if($k==$sel) {
                $opt.="<option value='$k' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$k'>$row</option>";
            }
        }
        return $opt;
    }

    function delete_staffs($staffs_id) {
        $sql="delete from staffs where staffs_id=$staffs_id";
        return $this->db->query($sql);
    }
    function save_staff_department() {
        $sql="insert into staff_department set
                name={$this->db->escape($_POST['name'])}";
        return $this->db->query($sql);
    }
    function update_staff_department() {
        $staff_department_id=$this->session->userdata('staff_department_id');
        $sql="update staff_department set
                name={$this->db->escape($_POST['name'])}
                where staff_department_id=$staff_department_id";
        return $this->db->query($sql);
    }
    function get_department_options($sel='') {
        $rows=sql::rows('staff_department',"status='enabled'");
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row[staff_department_id]==$sel) {
                $opt.="<option value='$row[staff_department_id]' selected='selected'>$row[name]</option>";
            }else {
                $opt.="<option value='$row[staff_department_id]'>$row[name]</option>";
            }
        }
        return $opt;
    }
    function add_photograph($pre_image="") {
        $file_name="";
        $param['dir']=UPLOAD_PATH."staffs/";
        $param['type']=DOC_EXT;
        $this->load->library('zupload',$param);
        $this->zupload->setUploadDir($param['dir']);
        if($pre_image!="") {
            $this->zupload->delFile($pre_image);
        }
        $this->zupload->setFileInputName("photograph");
        $this->zupload->upload(true);
        $file_name=$this->zupload->getOutputFileName();

        return $file_name;
    }
    function add_documents($pre_doc="") {
        $file_name="";
        $param['dir']=UPLOAD_PATH."staffs_document/";
        $param['type']=DOC_EXT;
        $this->load->library('zupload',$param);
        $this->zupload->setUploadDir($param['dir']);
        if($pre_doc!="") {
            $this->zupload->delFile($pre_doc);
        }
        $this->zupload->setFileInputName("documents");
        $this->zupload->upload(true);
        $file_name=$this->zupload->getOutputFileName();

        return $file_name;
    }

    function get_staff_list() {
        $search=$_POST['search'];
        $con='';
        $branch_id=  $this->session->userdata('branch_id');
        if($branch_id!=''){
            $con.=" and branch_id=$branch_id";
        }

        $data.="<ul class='width_160'>";
        if($search!='') {
            $sql="select user_name,staffs_id from staffs where user_name like '$search%' $con";
            $res=$this->db->query($sql);
            $djs=$res->result_array();
            if(count($djs)==0){
                $data.='<li>ID Not Found !!</li>';
            }

            foreach($djs as $row) {
                $data.="<li title='".$row['user_name']."' rel='{$row['staffs_id']}'>".$row['user_name'].'</li>';
            }
        }else {
            $data.='<li>Enter Staffs ID</li>';
        }
        $data.='</ul>';
        return $data;
    }
    //Staff Attendance
//    function save_attendance() {
//        $staffs_id=$this->session->userdata('sel_staffs_id');
//        $user_id=$this->session->userdata('user_id');
//        $attendance=$_POST['attendance'];
//        $present=0;
//        $absent=0;
//        $sick=0;
//        $holiday=0;
//        $excuse=0;
//        if($attendance==1) {
//            $present=1;
//        }else if($attendance==0) {
//            $absent=1;
//        }else if($attendance==2) {
//            $sick=1;
//        }else if($attendance==3) {
//            $holiday=1;
//        }
//        $sql="insert into staffs_attendance set
//                staffs_id=$staffs_id,
//                date={$this->db->escape($_POST['date'])},
//                present=$present,
//                absent=$absent,
//                sick=$sick,
//                holiday=$holiday,
//                hours={$_POST['hours']},
//                extra_hour={$_POST['extra_hour']},
//                absent_hour={$_POST['absent_hour']},
//                late={$_POST['late']},
//		authorize='{$_POST['authorize']}',
//                comments={$this->db->escape($_POST['comments'])},
//                user_id=$user_id
//                ";
//        return $this->db->query($sql);
//    }
//    function update_attendance() {
//        $attendance_id=$this->session->userdata('attendance_id');
//        $attendance=$_POST['attendance'];
//        $present=0;
//        $absent=0;
//        $sick=0;
//        $holiday=0;
//        $excuse=0;
//        if($attendance==1) {
//            $present=1;
//        }else if($attendance==0) {
//            $absent=1;
//        }else if($attendance==2) {
//            $sick=1;
//        }else if($attendance==3) {
//            $holiday=1;
//        }
//        $sql="update staffs_attendance set
//                date={$this->db->escape($_POST['date'])},
//                present=$present,
//                absent=$absent,
//                sick=$sick,
//                holiday=$holiday,
//                hours={$_POST['hours']},
//                extra_hour={$_POST['extra_hour']},
//                absent_hour={$_POST['absent_hour']},
//                late={$_POST['late']},
//		authorize='{$_POST['authorize']}',
//                comments={$this->db->escape($_POST['comments'])}
//                where attendance_id=$attendance_id
//                ";
//        return $this->db->query($sql);
//    }
//    function get_total_attendance($staffs_id) {
//        $data['month']=$this->session->userdata('sel_month');
//        $data['year']=$this->session->userdata('sel_year');
//
//        $con='';
//        if($data['month']!=''&& $data['year']!='') {
//            $date=$data['year'].'-'.$data['month'];
//            $con=" and DATE_FORMAT(date,'%Y-%m')='$date'";
//        }else if($data['month']!='') {
//            $date=$data['month'];
//            $con=" and MONTH(date)='$date'";
//        }
//        $sql=$this->db->query("select sum(present) as tot_present, sum(absent) as tot_absent,sum(sick) as tot_sick,sum(holiday) as tot_holiday,sum(excuse) as tot_excuse,sum(hours) as tot_hours, sum(extra_hour) as tot_extra_hour,sum(absent_hour) as tot_absent_hour,sum(late) as tot_late from staffs_attendance
//				where staffs_id=$staffs_id $con group by staffs_id");
//        return $sql->row_array();
//    }
//    function get_attendance($limit='') {
//
//        $sql=$this->db->query("select a.*,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from staffs_attendance as a
//                                join staffs as s on s.staffs_id=a.staffs_id
//                                where 1=1 $limit");
//        return $sql->result_array();
//    }
//    function filter_attendance() {
//
//        $con='';
//        if($_POST['user_name']!='') {
//            $con.=" and s.user_name like '{$_POST['user_name']}'";
//        }
//        if($_POST['name']!='') {
//            $con.=" and s.last_name like '{$_POST['name']}'";
//        }
//
//        if($_POST['staff_status']!='') {
//            $con.=" and s.staff_status like '{$_POST['staff_status']}'";
//        }
//        if($_POST['from_date']!='') {
//            $con.=" and a.date BETWEEN '{$_POST['from_date']}' AND '{$_POST['to_date']}'";
//        }
//
//        $sql=$this->db->query("select a.*,s.user_name,concat(s.first_name,' ',s.last_name) as staff_name from staffs_attendance as a
//                                join staffs as s on s.staffs_id=a.staffs_id
//                                where 1=1 $con");
//        return $sql->result_array();
//    }
//    function get_staffs_attendance($staffs_id='',$limit='') {
//        if($staffs_id=='') {
//            redirect('staffs/view_attendance');
//        }
//        $from_date=$this->session->userdata('sel_from_date');
//        $to_date=$this->session->userdata('sel_to_date');
//        $month=$this->session->userdata('sel_month');
//        $year=$this->session->userdata('sel_year');
//
//        $con='';
//        if($from_date!='') {
//            $con=" and date >= '$from_date'";
//        }
//        if($to_date!='') {
//            $con.=" and date <= '$to_date'";
//        }
//        if($month!=''&& $year!='') {
//            $date=$year.'-'.$month;
//            $con=" and DATE_FORMAT(date,'%Y-%m')='$date'";
//        }else if($month!='') {
//            $date=$month;
//            $con=" and MONTH(date)='$date'";
//        }
//        $sql=$this->db->query("select * from staffs_attendance where staffs_id=$staffs_id $con order by date $limit");
//        return $sql->result_array();
//    }
//    function get_authorize($sel='') {
//        $arr=array('None','Yes','No');
//        $opt="<option value=''>--Select--</option>";
//        foreach($arr as $val) {
//            if($val==$sel) $opt.="<option value='$val' selected='selected'>$val</option>";
//            else $opt.="<option value='$val'>$val</option>";
//        }
//        return $opt;
//    }
    // End Attendance
    function get_assigned_module($staffs_id='',$limit='') {
        $con='1=1';
        if($staffs_id!='') {
            $con='mm.staffs_id='.$staffs_id;
        }
        $sql=$this->db->query("select mm.*,concat(s.first_name,' ',s.last_name) as staff_name,sd.designation,s.user_name,m.module_name,c.class_name from module_distribution as mm
                                join module as m on m.module_id=mm.module_id
                                join staffs as s on s.staffs_id=mm.staffs_id
                                join staff_designation as sd on s.designation_id=sd.staff_designation_id
                                join class as c on c.class_id=mm.class_id
                                where $con $limit");
        return $sql->result_array();
    }


    function get_designationGrid() {
        $sortname = common::getVar('sidx', 'designation');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $sql="select sd.*,concat(u.first_name,' ',u.last_name) as inputed_by
                from staff_designation as sd
                join user as u on sd.user_id=u.user_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('staff_designation','1=1');
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
            
            $responce->rows[$i]['id']=$row['staff_designation_id'];
            $responce->rows[$i]['cell']=array($row['designation'],$row['mpo_scale'],$row['inputed_by']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mahjabeen");
        header("Email: neela@flammabd.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function save_staff_designation(){
        $user_id=$this->session->userdata('user_id');
        $data=array(
            "designation"=>$_POST['designation'],
            "mpo_scale"=>$_POST['mpo_scale'],
            "user_id"=>$user_id
        );
        $this->db->insert("staff_designation",$data);
    }

    function update_staff_designation(){
        $user_id=$this->session->userdata('user_id');
        $staff_designation_id=$this->session->userdata('staff_designation_id');
        $data=array(
            "designation"=>$_POST['designation'],
            "mpo_scale"=>$_POST['mpo_scale'],
            "user_id"=>$user_id
        );
        $this->db->update("staff_designation",$data,array("staff_designation_id"=>$staff_designation_id));
    }

    /* Staff Training */

    function get_trainingGrid() {
        $sortname = common::getVar('sidx', 'training_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $sql="select st.*,concat(u.first_name,' ',u.last_name) as user_name
              from staff_training as st
              join user as u on st.user_id=u.user_id
              where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('staff_training','1=1');
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
            
            $responce->rows[$i]['id']=$row['training_id'];
            $responce->rows[$i]['cell']=array($row['training_title'],$row['increment'],$row['user_name']);
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

    function save_staff_training(){
        $user_id=$this->session->userdata('user_id');
        $data=array(
            "training_title"=>$_POST['training_title'],
            "increment"=>$_POST['increment'],
            "user_id"=>$user_id
        );

        $this->db->insert("staff_training",$data);
    }


    function update_staff_training(){
        $training_id=$this->session->userdata('training_id');
        $data=array(
            "training_title"=>$_POST['training_title'],
            "increment"=>$_POST['increment']

        );

        $this->db->update("staff_training",$data,array("training_id"=>$training_id));
    }



}?>