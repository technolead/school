<?php

/**
 * Description of mod_student
 *
 * @author anwar
 */
class mod_student extends Model {

    function mod_student() {
        parent::Model();
    }

    function get_search_options($sel='') {
        $arr = array(
            's.first_name' => 'First Name',
            's.last_name' => 'Last Name',
            's.user_name' => 'Student ID',
            's.email' => 'Student Email',
            's.mobile' => 'Mobile Number',
            's.present_address' => 'Present Address',
            'sr.class_name' => 'Class Name',
            's.student_status' => 'Student Status',
            'sr.session_name' => 'Session Name',
            'sr.section' => 'Section'
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

    function get_studentGrid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        //$con='1';
        $con = '';
        $user_name = $this->session->userdata('sess_user_name');
        $name = $this->session->userdata('sess_name');
        $bdate = $this->session->userdata('date_of_birth');
        $status = $this->session->userdata('student_status');
        $class_id = $this->session->userdata('class_id');
        $check_session_id = $this->session->userdata('check_session_id');
        $branch_id = $this->session->userdata('branch_id');


        if ($user_name != '') {
            $con.=" and s.user_name like '{$user_name}'";
        }
        if ($name != '') {
            $con.=" and s.last_name like '{$name}'";
        }
        if ($bdate != '') {
            $con.=" and s.date_of_birth = '{$bdate}'";
        }
        if ($class_id != '') {
            $con.=' and sr.class_id=' . $class_id;
        }
        if ($check_session_id != '') {
            $con.=' and sr.session_id=' . $check_session_id;
        }
        if ($status != '') {
            $con.=" and s.student_status like '{$status}'";
        }
        if ($branch_id != '') {
            $con.=" and s.branch_id=" . $branch_id;
        }


        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        if ($searchField != '' && $searchValue != '') {
            $con.=' and ' . $searchField . ' like "%' . $searchValue . '%"';
        }

        $sql = "select sr.class_map_id,sr.class_id,sr.class_name,sr.session_id,s.status,s.student_id,
                s.first_name,s.last_name,s.user_name,s.email,s.mobile,s.present_address,
                s.student_status,s.date_of_birth from student as s
                left join view_std_reg as sr on sr.student_id=s.student_id
                where is_online=0 and is_delete=0 $con $sort";

        //debug::writeLog($sql);


        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $r = $this->db->query($sql);
        $count = count($r->result_array());
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

        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach ($rows as $row) {
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id'] = $row['student_id'];
            $is_result = (count(sql::row("progress_report", "student_id=$row[student_id] and class_map_id='{$row[class_map_id]}' and result_status=1 ")) > 0) ? "Yes" : "No";
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['first_name']} {$row['last_name']}</a>";
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['mobile'], $status, $is_result);
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

    function get_all_student($limit='') {
        $con = '';
        $user_name = $this->session->userdata('sess_user_name');
        $name = $this->session->userdata('sess_name');
        $bdate = $this->session->userdata('date_of_birth');
        $status = $this->session->userdata('student_status');
        $class_id = $this->session->userdata('class_id');
        $check_session_id = $this->session->userdata('check_session_id');
        $branch_id = $this->session->userdata('branch_id');


        if ($user_name != '') {
            $con.=" and s.user_name like '{$user_name}'";
        }
        if ($name != '') {
            $con.=" and s.last_name like '{$name}'";
        }
        if ($bdate != '') {
            $con.=" and s.date_of_birth = '{$bdate}'";
        }
        if ($class_id != '') {
            $con.=' and rp.class_id=' . $class_id;
        }
        if ($check_session_id != '') {
            $con.=' and rp.session_id=' . $session_id;
        }
        if ($status != '') {
            $con.=" and s.student_status like '{$status}'";
        }
        if ($branch_id != '') {
            $con.=" and s.branch_id=" . $branch_id;
        }

        $sql = $this->db->query("select rp.class_id,rp.class_name,s.status,s.student_id,s.first_name,s.last_name,s.user_name,s.email,s.mobile,s.present_address,s.student_status,s.date_of_birth
              from student as s
              left join view_std_reg as rp on rp.student_id=s.student_id and rp.is_recent=1
                                    where is_online=0 and is_delete=0 $con $sort");
        return $sql->result_array();
    }

    function filter_student($limit='') {
        $con = '';
        if ($_POST['user_name'] != '') {
            $con.=" and s.user_name like '{$_POST['user_name']}'";
        }
        if ($_POST['name'] != '') {
            $con.=" and s.last_name like '{$_POST['name']}'";
        }
        if ($_POST['date_of_birth'] != '') {
            $con.=" and s.date_of_birth = '{$_POST['date_of_birth']}'";
        }
        if ($_POST['class_id'] != '') {
            $con.=' and rp.class_id=' . $_POST['class_id'];
        }
        if ($_POST['check_session_id'] != '') {
            $con.=' and rp.session_id=' . $_POST['check_session_id'];
        }
        if ($_POST['student_status'] != '') {
            $con.=" and s.student_status like '{$_POST['student_status']}'";
        }

        $sql = $this->db->query("select rp.class_id,rp.class_name,s.status,s.student_id,s.first_name,s.last_name,s.user_name,s.email,s.mobile,s.present_address,s.student_status,s.date_of_birth
                               from student as s
                               left join view_std_reg as rp on rp.student_id=s.student_id
                               and rp.is_recent=1 where is_online=0 and is delete=0 $con $sort");
        return $sql->result_array();
    }

    function save_student() {
        $user_id = $this->session->userdata('user_id');
        $user_name = $_POST['user_name']; //common::generate_user_name($_POST['first_name'], $_POST['last_name']);
        common::save_as_user($user_name, 'student', $_POST['first_name'], $_POST['last_name'], $_POST['email']);
        $msg = "Your Account has been created.
               <br />The Account Activate Information:<br />
                User ID: $user_name<br />
                Password: $user_name<br /><br />
                Support Online <br />
                College Management Team";
        $site = common::get_settings_data();
        $from = $site['admin_email'];
        $from_name = 'Admin[College Management]';
        $to = $_POST['email'];
        $subject = "Account Information";
        //common::sending_mail($from, $from_name, $to, $subject, $msg); // This is off the email Sent.

        $document_submitted = '';
        if (count($_POST['document_submitted']) > 0) {
            $document_submitted = implode(',', $_POST['document_submitted']);
        }

        $photograph = '';

        if ($_FILES['photograph']['name'] != '') {
            $photograph = $this->add_photograph();
        }

        $doc_cirtificate = '';
        if ($_FILES['doc_cirtificate']['name'] != '') {
            $doc_cirtificate = $this->add_cirtificate_doc();
        }

        

        $data = array(
            "user_id" => $user_id,
            "user_name" => $user_name,
            "title" => $_POST['title'],
            "gender" => $_POST['gender'],
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "date_of_birth" => $_POST['date_of_birth'],
            "present_address" => $_POST['present_address'],
            "permanent_address" => $_POST['permanent_address'],
            "phone" => $_POST['phone'],
            "mobile" => $_POST['mobile'],
            "email" => $_POST['email'],
            "admission_date" => $_POST['admission_date'],
            "student_status" => $_POST['student_status'],
            "std_status_date" => $_POST['std_status_date'],
            "branch_id" => $_POST['branch_id'],
            "nationality" => $_POST['nationality'],
            "marital_status" => $_POST['marital_status'],
            "doc_submitted" => $document_submitted,
            "photograph" => $photograph,
            "doc_certificates" => $doc_cirtificate,
            "doc_required" => $_POST['doc_required'],
            "comments" => $_POST['comments']
        );

        
        $this->db->insert("student",$data);
        return $this->db->insert_id();
    }

    function add_photograph($pre_image="") {
        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "photograph/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_image != "") {
            $this->zupload->delFile($pre_image);
        }
        $this->zupload->setFileInputName("photograph");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }

    function add_passport_doc($pre_doc="") {
        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "passports/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_doc != "") {
            $this->zupload->delFile($pre_doc);
        }
        $this->zupload->setFileInputName("doc_passport");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }

    function add_cirtificate_doc($pre_doc="") {

        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "cirtificates/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_doc != "") {
            $this->zupload->delFile($pre_doc);
        }
        $this->zupload->setFileInputName("doc_cirtificate");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }

    function add_financial_doc($pre_doc="") {
        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "financials/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_doc != "") {
            $this->zupload->delFile($pre_doc);
        }
        $this->zupload->setFileInputName("doc_financial");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }

    function add_doc_ielts_other($pre_doc="") {
        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "ielts_others/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_doc != "") {
            $this->zupload->delFile($pre_doc);
        }
        $this->zupload->setFileInputName("doc_ielts_other");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }

    function save_qualifiaction($student_id) {
        //$student_id=$this->session->userdata('con_student_id');
        if (count($_POST['qualifications']) > 0) {
            $inc = 0;
            foreach ($_POST['qualifications'] as $qualification) {
                if ($qualification != '') {
                    $sql = "insert into std_qualifications set
                        student_id=$student_id,
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

    function save_parent_info($student_id) {
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "student_id" => $student_id,
            "father_name" => $_POST['father_name'],
            "mother_name" => $_POST['mother_name'],
            "parent_address" => $_POST['parent_address'],
            "parent_phone" => $_POST['parent_phone'],
            "legal_guardian_name" => $_POST['legal_guardian_name'],
            "legal_guardian_address" => $_POST['legal_guardian_address'],
            "legal_guardian_phone" => $_POST['legal_guardian_phone'],
            "user_id" => $user_id
        );
        $this->db->insert("student_parent_info", $data);
    }

    function save_experience($student_id) {
        if (count($_POST['position']) > 0) {
            $inc = 0;
            foreach ($_POST['position'] as $position) {
                if ($position != '') {
                    $sql = "insert into student_experience set
                        student_id=$student_id,
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

    function save_class_reg() {

        /* session_id,class_id,class_start_date,class_end_date unnecessary */

        $student_id = $this->session->userdata('con_student_id');
        if ($student_id == '') {
            redirect('student/new_student');
        }
        $user_id = $this->session->userdata('user_id');
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $sql = "insert into reg_class set
                   student_id={$this->db->escape($student_id)},
                   class_map_id={$this->db->escape($class_map_id)},
                   session_id={$this->db->escape($_POST['session_id'])},
                   class_id={$this->db->escape($_POST['class_id'])},
                   class_start_date={$this->db->escape($_POST['class_start_date'])},
                   class_end_date={$this->db->escape($_POST['class_end_date'])},
                   section={$this->db->escape($_POST['section'])},
                   privilege={$this->db->escape($_POST['privilege'])},
                   class_status={$this->db->escape(1)},
                   class_status_date={$this->db->escape(date('Y-m-d'))},
		   user_id={$this->db->escape($user_id)}
                ";
        return $this->db->query($sql);
    }

    function save_session_reg() {
        $student_id = $this->session->userdata('con_student_id');
        if ($student_id == '') {
            redirect('student/new_student');
        }
        $user_id = $this->session->userdata('user_id');
        $this->db->query("update reg_session set is_recent=0 where student_id=$student_id");
        $sql = "insert into reg_session set
                   student_id={$this->db->escape($student_id)},
                   session_id={$this->db->escape($_POST['session_id'])},
                   class_id={$this->db->escape($_POST['class_id'])},
                   staffs_id={$this->db->escape($_POST['staffs_id'])},
                   session_section={$this->db->escape($_POST['session_section'])},
		   user_id=$user_id
                ";
        return $this->db->query($sql);
    }

    function save_module_reg() {
        $student_id = $this->session->userdata('con_student_id');
        $modules = combo::get_class_module_id($_POST['class_id']);
        if (count($modules) > 0) {

            foreach ($modules as $module) {
                if ($module != '') {
                    $sql = "insert into reg_module set
                        student_id=$student_id,
                        class_id={$this->db->escape($_POST['class_id'])},
                        session_id={$this->db->escape($_POST['session_id'])},
                        module_id={$this->db->escape($module['module_id'])},
                        module_status={$this->db->escape(1)},
                        module_attempt={$this->db->escape('First')},
                        module_comment={$this->db->escape('')}";
                    $this->db->query($sql);
                }
            }
        }
    }

    function save_optional_module() {
        $student_id = $this->session->userdata('con_student_id');
        $sql = "insert into reg_module set
                        student_id=$student_id,
                        class_id={$this->db->escape($_POST['class_id'])},
                        session_id={$this->db->escape($_POST['session_id'])},
                        module_id={$this->db->escape($_POST['optional_module_id'])},
                        module_status={$this->db->escape(1)},
                        module_attempt={$this->db->escape('First')},
                        module_comment={$this->db->escape('')}";
        $this->db->query($sql);
    }

    function update_optional_module($optional_module_id) {
        $student_id = $this->session->userdata('edit_student_id');
        $sql = "update reg_module
                set module_id={$this->db->escape($_POST['optional_module_id'])}
                where student_id=$student_id and module_id=$optional_module_id";
        $this->db->query($sql);
    }

    function save_level_reg() {
        $student_id = $this->session->userdata('con_student_id');
        if ($student_id == '') {
            redirect('student/new_student');
        }
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into reg_level set
                   student_id={$this->db->escape($student_id)},
                   class_id={$this->db->escape($_POST['class_id'])},
                   levels_id={$this->db->escape($_POST['levels_id'])},
                   level_start_date={$this->db->escape($_POST['level_start_date'])},
                   level_end_date={$this->db->escape($_POST['level_end_date'])},
                   level_status={$this->db->escape($_POST['level_status'])},
                   level_status_date={$this->db->escape($_POST['level_status_date'])},
                   level_comment={$this->db->escape($_POST['level_comment'])},
                    user_id=$user_id
                ";
        return $this->db->query($sql);
    }

    function update_student() {
        $student_id = $this->session->userdata('edit_student_id');
        $document_submitted = '';
        if (count($_POST['document_submitted']) > 0) {
            $document_submitted = implode(',', $_POST['document_submitted']);
        }

        $photograph = '';

        if ($_FILES['photograph']['name'] != '') {
            $photograph = $this->add_photograph($_POST['h_photograph']);
        } else {
            $photograph = $_POST['h_photograph'];
        }

        $doc_cirtificate = '';
        if ($_FILES['doc_cirtificate']['name'] != '') {
            $doc_cirtificate = $this->add_cirtificate_doc($_POST['h_doc_certificate']);
        } else {
            $doc_cirtificate = $_POST['h_doc_certificate'];
        }


        $user_name = $_POST['user_name'];
        

        $data = array(
            "user_name" => $user_name,
            "title" => $_POST['title'],
            "gender" => $_POST['gender'],
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "date_of_birth" => $_POST['date_of_birth'],
            "present_address" => $_POST['present_address'],
            "permanent_address" => $_POST['permanent_address'],
            "phone" => $_POST['phone'],
            "mobile" => $_POST['mobile'],
            "email" => $_POST['email'],
            "admission_date" => $_POST['admission_date'],
            "student_status" => $_POST['student_status'],
            "std_status_date" => $_POST['std_status_date'],
            "branch_id" => $_POST['branch_id'],
            "nationality" => $_POST['nationality'],
            "marital_status" => $_POST['marital_status'],
            "doc_submitted" => $document_submitted,
            "photograph" => $photograph,
            "doc_certificates" => $doc_cirtificate,
            "doc_required" => $_POST['doc_required'],
            "comments" => $_POST['comments']
        );
        $this->db->update("student",$data,array("student_id"=>$student_id));

       
    }

    function get_registered_class($student_id) {

        $sql = $this->db->query("select rc.reg_class_id,rc.class_status,rc.class_status_date,
                               rc.section,rc.privilege,cm.*,
                               c.class_name,s.session_name,
                               concat(sf.first_name,' ',sf.last_name) as tutor_name from reg_class as rc
                               join class_map as cm on cm.class_map_id=rc.class_map_id                              
                               join class as c on c.class_id=cm.class_id
                               join session as s on s.session_id=cm.session_id
                               left join staffs as sf on sf.staffs_id=cm.staff_id where rc.student_id=$student_id and rc.is_delete=0");
        return $sql->result_array();
    }

    function get_registered_levels($student_id) {
        $sql = $this->db->query("select rl.reg_level_id,rl.level_start_date,rl.level_end_date,rl.level_extd_date,rl.level_status,rl.level_status_date,l.level_code,l.level_name from reg_level as rl
                                    join levels as l on l.levels_id=rl.levels_id
                                    where rl.student_id=$student_id");
        return $sql->result_array();
    }

    function get_registered_session($student_id) {
        $sql = $this->db->query("select distinct(rs.reg_session_id),rs.session_id,rs.student_id,rs.reg_session_id,rs.session_status,rs.session_status_date,s.session_name,sm.start_date,sm.end_date,concat(sf.first_name,' ',sf.last_name) as tutor_name from reg_session as rs
                                    join session as s on s.session_id=rs.session_id
                                    join session_map as sm on sm.session_id=rs.session_id
                                    left join staffs as sf on sf.staffs_id=rs.staffs_id
                                    where rs.student_id=$student_id and rs.class_id=sm.class_id");
        return $sql->result_array();
    }

    function get_registered_modules($student_id, $session_id='') {
        $con = '';
        if ($session_id != '') {
            $con = " and rm.session_id=$session_id";
        }

        $sql = $this->db->query("select s.session_name,m.module_code,m.module_name,m.is_compulsary,rm.module_id,rm.module_status,rm.module_attempt,rm.module_comment,rm.reg_module_id from reg_module as rm
                                    join module as m on m.module_id=rm.module_id
                                    join session as s on s.session_id=rm.session_id
                                    where rm.student_id=$student_id and rm.is_delete=0 $con");
        return $sql->result_array();
    }

    function get_reg_class_details($reg_class_id) {
        $sql = $this->db->query("select rc.*,class_duration from reg_class as rc
                                    join class_map as cm on cm.class_id=rc.class_id
                                    and cm.session_id=rc.session_id
                                    where rc.reg_class_id=$reg_class_id and rc.is_delete=0");
        return $sql->row_array();
    }

    /* this is for edit student basic info */

    function edit_class_reg() {

        /* session_id,class_id,class_start_date,class_end_date unnecessary */

        $reg_class_id = $this->session->userdata('reg_class_id');
        if ($reg_class_id == '') {
            common::redirect();
        }
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);



        $sql = "update reg_class set
                   class_map_id={$this->db->escape($class_map_id)},
                   session_id={$this->db->escape($_POST['session_id'])},
                   class_id={$this->db->escape($_POST['class_id'])},
                   class_start_date={$this->db->escape($_POST['class_start_date'])},
                   class_end_date={$this->db->escape($_POST['class_end_date'])},
                   section={$this->db->escape($_POST['section'])}
                   where reg_class_id=$reg_class_id
                ";
        return $this->db->query($sql);
    }

    /* this is for edit student register info */

    function update_class_reg() {
        $reg_class_id = $this->session->userdata('reg_class_id');
        if ($reg_class_id == '') {
            common::redirect();
        }

        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);

        $sql = "update reg_class set
                   class_map_id={$this->db->escape($class_map_id)},
                   session_id={$this->db->escape($_POST['session_id'])},
                   class_id={$this->db->escape($_POST['class_id'])},
                   class_start_date={$this->db->escape($_POST['class_start_date'])},
                   class_end_date={$this->db->escape($_POST['class_end_date'])},
                   class_status={$this->db->escape($_POST['class_status'])},
                   class_status_date={$this->db->escape($_POST['class_status_date'])},
                   section={$this->db->escape($_POST['section'])},
                   privilege={$this->db->escape($_POST['privilege'])},
                   class_comment={$this->db->escape($_POST['class_comment'])}
                   where reg_class_id=$reg_class_id
                ";
        return $this->db->query($sql);
    }

    function promote_class_reg($student_id) {

        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $data = array(
            "class_map_id" => $class_map_id,
            "session_id" => $_POST['session_id'],
            "class_id" => $_POST['class_id'],
            "class_start_date" => $_POST['class_start_date'],
            "class_end_date" => $_POST['class_end_date'],
            "section" => $_POST['section'],
            "class_status" => $_POST['class_status'],
            "class_status_date" => $_POST['class_status_date']
        );

        foreach ($student_id as $std_id): {
                $reg_class = sql::row("reg_class", "student_id=$std_id");
                $this->db->update("reg_class", $data, array("reg_class_id" => $reg_class[reg_class_id]));
            }endforeach;
    }

    function promote_optional_module($student_id) {

        foreach ($student_id as $std_id): {
                $data = array(
                    "student_id" => $std_id,
                    "class_id" => $_POST['class_id'],
                    "session_id" => $_POST['session_id'],
                    "module_id" => $_POST['optional_module_id'],
                    "module_status" => '1',
                    "module_attempt" => 'First',
                    "module_comment" => ""
                );
                $this->db->insert("reg_module", $data);
            }endforeach;
    }

    function promote_module_reg($student_id) {

        $modules = combo::get_class_module_id($_POST['class_id']);
        if (count($modules) > 0) {
            foreach ($modules as $module) {
                if ($module != '') {
                    foreach ($student_id as $std_id): {
                            $data = array(
                                "student_id" => $std_id,
                                "class_id" => $_POST['class_id'],
                                "session_id" => $_POST['session_id'],
                                "module_id" => $module['module_id'],
                                "module_status" => '1',
                                "module_attempt" => 'First',
                                "module_comment" => ""
                            );
                            $this->db->insert("reg_module", $data);
                        }endforeach;
                }
            }
        }
    }

    function get_levels_edit_data($reg_level_id) {
        $sql = $this->db->query("select lr.*,level_duration from reg_level as lr
				join level_map as lm on lm.levels_id=lr.levels_id
                                where lr.reg_level_id=$reg_level_id");
        return $sql->row_array();
    }

    function update_level_reg() {
        $reg_level_id = $this->session->userdata('reg_level_id');
        if ($reg_level_id == '') {
            common::redirect();
        }
        $sql = "update reg_level set
                   class_id={$this->db->escape($_POST['class_id'])},
                   levels_id={$this->db->escape($_POST['levels_id'])},
                   level_start_date={$this->db->escape($_POST['level_start_date'])},
                   level_end_date={$this->db->escape($_POST['level_end_date'])},
                   level_status={$this->db->escape($_POST['level_status'])},
                   level_status_date={$this->db->escape($_POST['level_status_date'])},
                   level_comment={$this->db->escape($_POST['level_comment'])}
		   where reg_level_id=$reg_level_id
                ";
        return $this->db->query($sql);
    }

    function get_session_edit_data($reg_session_id) {
        $sql = $this->db->query("select rs.*,s.session_name,sm.start_date,sm.end_date,sm.session_duration from reg_session as rs
                                    join session as s on s.session_id=rs.session_id
                                    join session_map as sm on sm.session_id=rs.session_id
                                    where rs.reg_session_id=$reg_session_id and rs.class_id=sm.class_id");
        return $sql->row_array();
    }

    function get_levels_name($module_id) {
        if ($module_id == '') {
            return '';
        }
        $sql = $this->db->query("select distinct(l.levels_id),l.level_name from module_map as mm
                                join levels as l on l.levels_id=mm.levels_id
                                where mm.module_id=$module_id");
        $data = $sql->row_array();
        return $data['level_name'];
    }

    function update_session_reg() {
        $reg_session_id = $this->session->userdata('reg_session_id');
        if ($reg_session_id == '') {
            common::redirect();
        }
        $sql = "update reg_session set
                   session_id={$this->db->escape($_POST['session_id'])},
                   class_id={$this->db->escape($_POST['class_id'])},
                   session_status={$this->db->escape($_POST['session_status'])},
                   session_status_date={$this->db->escape($_POST['session_status_date'])},
                   staffs_id={$this->db->escape($_POST['staffs_id'])},
                   session_section={$this->db->escape($_POST['session_section'])}
		   where reg_session_id=$reg_session_id
                ";
        return $this->db->query($sql);
    }

    function update_module_reg() {
        if (count($_POST['reg_module_id']) > 0) {
            $inc = 0;
            foreach ($_POST['reg_module_id'] as $module_reg_id) {
                if ($module_reg_id != '') {
                    $sql = "update module_reg set
                            levels_id={$this->db->escape($_POST['levels_id'])},
                            module_id={$this->db->escape($_POST['module_id'][$inc])},
                            module_status={$this->db->escape($_POST['module_status'][$inc])},
                            attempt={$this->db->escape($_POST['attempt'][$inc])},
                            module_comment={$this->db->escape($_POST['module_comment'][$inc])}
                            where module_reg_id=$module_reg_id";
                    $this->db->query($sql);
                }
                $inc++;
            }
        }
    }

    function get_class_details($class_id='') {
        $msg = '';
        if ($class_id != '') {
            $data = sql::row('class', 'class_id=' . $class_id);
            $msg = "<table>
                    <tr><td class='b width_50'>class Name</td><td>$data[class_name]</td></tr>
                    <tr><td class='b width_50'>Specialization</td><td>$data[specialization]</td></tr>
                    <tr><td class='b width_50'>Awarding Body</td><td>$data[awarding_body]</td></tr>
                    <tr><td class='b width_50'>Duration</td><td>$data[duration]</td></tr>
            </table>";
        }
        return $msg;
    }

    function delete_student($student_id) {
        $row = sql::row('student', 'student_id=' . $student_id, 'photograph,doc_certificates');
        $param['dir'] = UPLOAD_PATH;
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        if ($row['photograph'] != '') {
            $this->zupload->delFile($row['photograph'], UPLOAD_PATH . '/photograph');
        }

        if ($row['doc_certificates'] != '') {
            $this->zupload->delFile($row['doc_certificates'], UPLOAD_PATH . '/cirtificates');
        }

        /*$sql = "delete from student where student_id=$student_id";
        return $this->db->query($sql);*/
        sql::soft_delete("student","student_id=$student_id");
    }

    function get_student_list() {
        $search = $_POST['search'];
        $branch_id = $this->session->userdata('branch_id');
        $con = '';
        if ($branch_id != '') {
            $con.="and branch_id=$branch_id";
        }
        $data.="<ul class='width_160'>";
        if ($search != '') {
            $sql = "select user_name,student_id from student as s where user_name like '$search%' and is_delete=0 $con limit 0,10";
            $res = $this->db->query($sql);
            $std = $res->result_array();
            if (count($std) > 0) {
                foreach ($std as $row) {
                    $data.="<li title='" . $row['user_name'] . "' rel='{$row['student_id']}'>" . $row['user_name'] . '</li>';
                }
            } else {
                $data.='<li>Student ID Not Found</li>';
            }
        } else {
            $data.='<li>Enter Student ID</li>';
        }
        $data.='</ul>';
        return $data;
    }

    function send_student_letters() {
        if ($_POST['letters_id'] != '') {
            $letter = sql::row('letters', 'letters_id=' . $_POST['letters_id']);
        }

        $user_id = $this->session->userdata('user_id');
        $site = common::get_settings_data();
        $from = $site['admin_email'];
        $base_url = base_url();
        $from_name = 'Admin[School-College Management]';

        if (count($_POST['student_list']) > 0) {
            foreach ($_POST['student_list'] as $student_id) {
                $letter_type_id = ATTENDANCE_TYPE;
                $data = $this->get_student_info($student_id);
                if ($_POST['enotify'] == 1) {
                    $to = $data['email'];
                    $subject = $letter['letter_title'];
                    $msg_content = "<div style='width:750px;margin:0 auto;border:1px solid #dedede;'><a href='$base_url'><img alt='College Management' src='" . $base_url . "/images/logo.jpg'  style='margin:10px 50px;' border='0'/></a>
                                <hr />";
                    $msg_content.="<div style='font-family:trebuchet ms;padding:10px;color:#343434;font-size:13px;'>";
                    $msg_content.="<h3 style='font-size:16px;border-bottom:1px solid #ddd;'>{$letter['letter_title']}</h3>";
                    $this->db->query("update student_letters set is_recent=0 where student_id=$student_id");
                    $sql = "insert into student_letters set
                                user_id=$user_id,
                                student_id=$student_id,
                                session_id={$data['session_id']},
                                letter_des={$this->db->escape($letter['des'])},
                                issue_date={$this->db->escape($_POST['issue_date'])},
                                letters_id={$this->db->escape($_POST['letters_id'])},
                                is_recent=1";
                    $this->db->query($sql);
                    $issued_id = $this->db->insert_id();
                    $msg_content.=common::issued_letters_data($issued_id);
                    $msg_content.="</div></div>";
                    common::sending_mail($from, $from_name, $to, $subject, $msg_content);
                } else if ($letter['letters_type_id'] == $letter_type_id) {
                    $this->db->query("update student_letters set is_recent=0 where student_id=$student_id");
                    $sql = "insert into student_letters set
                                user_id=$user_id,
                                student_id=$student_id,
                                session_id='{$data['session_id']}',
                                letter_des={$this->db->escape($letter['des'])},
                                issue_date={$this->db->escape($_POST['issue_date'])},
                                letters_id={$this->db->escape($_POST['letters_id'])},
                                is_recent=1";
                    $this->db->query($sql);
                } else {
                    $sql = "insert into student_letters set
                                user_id=$user_id,
                                student_id=$student_id,
                                session_id='{$data['session_id']}',
                                letter_des={$this->db->escape($letter['des'])},
                                issue_date={$this->db->escape($_POST['issue_date'])},
                                letters_id={$this->db->escape($_POST['letters_id'])}";
                    $this->db->query($sql);
                }
            }
        }
    }

    function get_student_info($student_id='') {
        $sql = $this->db->query("select sr.*,s.nationality as country from view_std_reg as sr
                                join student as s on s.student_id=sr.student_id
                                where sr.student_id=$student_id and sr.is_recent=1 and s.is_delete=0");
        return $sql->row_array();
    }

    function get_reg_session_row($student_id, $session_id) {
        $sql = $this->db->query("select sr.*,sm.session_duration,sm.start_date,sm.end_date from view_std_reg as sr
                                join session_map as sm on sm.session_id=sr.session_id
                                where sr.student_id=$student_id and sr.session_id=$session_id and sr.class_id=sm.class_id");
        return $sql->row_array();
    }

    function get_reg_class_row($student_id, $class_id) {
        $sql = $this->db->query("select s.*,rp.*,p.class_name,p.class_code,pm.class_duration,ab.awarding_body_name from student as s
                               join reg_class as rp on rp.student_id=s.student_id
                               join class as p on p.class_id=rp.class_id
                               join class_map as pm on pm.class_id=rp.class_id
                               join awarding_body as ab on ab.awarding_body_id=pm.awarding_body_id
                               where s.student_id=$student_id and rp.class_id=$class_id and s.is_delete=0");
        return $sql->row_array();
    }

}
?>