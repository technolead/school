<?php

class mod_report extends Model {

    function __construct() {
        parent::Model();
    }

    function get_reg_module_result($class_map_id='', $session_id='',$exam_id='') {
        $student_id = $this->session->userdata('sel_student_id');
        $con = '';

        if($class_map_id!=''){
            $con.=" and mr.class_map_id=$class_map_id";
        }

        if($exam_id!=''){
            $con.=" and mr.exam_id=$exam_id";
        }

        if ($session_id != '') {
            $con.=" and rm.session_id=$session_id";
        }
        $sql = $this->db->query("select distinct(m.module_id),m.module_name,m.module_code,
                                mr.*,e.exam_name
                                from reg_module as rm
                                join module as m on m.module_id=rm.module_id
                                join module_map as mp on mp.module_id=m.module_id
                                left join module_result as mr on (mr.student_id=rm.student_id and mr.module_id=rm.module_id)
                                join exam as e on mr.exam_id=e.exam_id
                                where rm.student_id=$student_id $con order by m.module_name");

        
        return $sql->result_array();
    }

    function get_attendance_percentage($student_id, $class_map_id) {
        $sql = $this->db->query("SELECT (sum( sa.attendance ) + sum( sa.leave_excuse )) AS present, sum( sa.leave_excuse ) AS total_leave,
                                (count( ca.class_attendance_id )-(sum( sa.attendance )+sum(sa.leave_excuse))) as absent,
                                count( ca.class_attendance_id ) AS total_class
                                FROM `std_attendance` AS sa
                                JOIN class_attendance AS ca ON ca.class_attendance_id = sa.class_attendance_id
                                WHERE sa.student_id=$student_id and ca.class_map_id=$class_map_id group by sa.student_id,ca.class_map_id");

        return $sql->row_array();
    }

    function save_report() {
        $student_id = $this->session->userdata('sel_student_id');
        $class_map_id = $this->session->userdata('sel_class_map_id');
        $exam_id = $this->session->userdata('sel_exam_id');
        $user_id = $this->session->userdata('user_id');


        $punctuality_point=common::get_curriculum_point($_POST['punctuality']);
        $class_preparation_point=common::get_curriculum_point($_POST['class_preparation']);
        $writing_skills_point=common::get_curriculum_point($_POST['writing_skills']);
        $academic_performance_point=common::get_curriculum_point($_POST['academic_performance']);
        $communication_skills_point=common::get_curriculum_point($_POST['communication_skills']);

        $total_point=$punctuality_point+$class_preparation_point+$writing_skills_point+$academic_performance_point+$communication_skills_point;

        
        foreach($_POST['final_grade_point'] as $fgp){
            $total_point+=$fgp;
            
        }
        $total_pointer=count($_POST['final_grade_point'])+5; //punctually etc are 5

        $final_grade_point=number_format($total_point/$total_pointer,2);
        $final_grade=common::get_grade_from_point($final_grade_point);

        $sql = "insert into progress_report set
                    student_id=$student_id,
                    class_map_id=$class_map_id,
                    exam_id=$exam_id,
                    attendance={$this->db->escape($_POST['attendance'])},
                    punctuality={$this->db->escape($_POST['punctuality'])},
                    class_preparation={$this->db->escape($_POST['class_preparation'])},
                    writing_skills={$this->db->escape($_POST['writing_skills'])},
                    academic_performance={$this->db->escape($_POST['academic_performance'])},
                    communication_skills={$this->db->escape($_POST['communication_skills'])},
                    final_grade={$this->db->escape($final_grade)},
                    final_grade_point={$this->db->escape($final_grade_point)},
                    result_status={$this->db->escape($_POST['result_status'])},
                    tutor_comment={$this->db->escape($_POST['tutor_comment'])},
                    suggestions={$this->db->escape($_POST['suggestions'])},
                    user_id=$user_id
                ";
        return $this->db->query($sql);
    }

    function get_report_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con = '1';
        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        if ($searchField != '' && $searchValue != '') {
            $con.=' and ' . $searchField . ' like "%' . $searchValue . '%"';
        }

        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        $sql = "select s.*,pr.report_id,pr.attendance,pr.final_grade,
                pr.final_grade_point,e.exam_name,
                u.first_name,u.last_name from progress_report as pr
                join view_std_reg as s on s.student_id=pr.student_id
                join exam as e on pr.exam_id=e.exam_id
                join user as u on u.user_id=pr.user_id
                where $con $sort";


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
            
            $responce->rows[$i]['id'] = $row['report_id'];
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/print_view/' . $row['report_id']) . '" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['session_name'],$row['exam_name'],$row['final_grade'],$row['final_grade_point'], $row['attendance'], $row['first_name'] . ' ' . $row['last_name'], $phref);
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

    function get_report_search_options($sel='') {
        $arr = array(
            's.student_name' => 'Student Name',
            's.user_name' => 'Student ID',
            's.class_name' => 'Class Name',
            's.session_name' => 'Session Name',
            'pr.attendance' => 'Attendance'
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

    function get_student_progress_report($student_id) {
        $sql = $this->db->query("select s.*,pr.final_grade,pr.final_grade_point,
                                pr.attendance,pr.report_id,e.exam_name,
                                u.first_name,u.last_name from progress_report as pr
                                join view_std_reg as s on s.student_id=pr.student_id
                                join exam as e on e.exam_id=pr.exam_id
                                join user as u on u.user_id=pr.user_id
                                where pr.student_id=$student_id order by pr.report_id desc $limit");
        return $sql->result_array();
    }

    function update_report() {
        $report_id = $this->session->userdata('report_id');


        $punctuality_point=common::get_curriculum_point($_POST['punctuality']);
        $class_preparation_point=common::get_curriculum_point($_POST['class_preparation']);
        $writing_skills_point=common::get_curriculum_point($_POST['writing_skills']);
        $academic_performance_point=common::get_curriculum_point($_POST['academic_performance']);
        $communication_skills_point=common::get_curriculum_point($_POST['communication_skills']);

        $total_point=$punctuality_point+$class_preparation_point+$writing_skills_point+$academic_performance_point+$communication_skills_point;


        foreach($_POST['final_grade_point'] as $fgp){
            $total_point+=$fgp;

        }
        $total_pointer=count($_POST['final_grade_point'])+5; //punctually etc are 5

        $final_grade_point=number_format($total_point/$total_pointer,2);
        $final_grade=common::get_grade_from_point($final_grade_point);

        $sql = "update progress_report set
				
				attendance={$this->db->escape($_POST['attendance'])},
				punctuality={$this->db->escape($_POST['punctuality'])},
				class_preparation={$this->db->escape($_POST['class_preparation'])},
				writing_skills={$this->db->escape($_POST['writing_skills'])},
				academic_performance={$this->db->escape($_POST['academic_performance'])},
				communication_skills={$this->db->escape($_POST['communication_skills'])},
                                final_grade={$this->db->escape($final_grade)},
                                final_grade_point={$this->db->escape($final_grade_point)},
                                result_status={$this->db->escape($_POST['result_status'])},
				tutor_comment={$this->db->escape($_POST['tutor_comment'])},
				suggestions={$this->db->escape($_POST['suggestions'])}
				where report_id=$report_id
                ";
        return $this->db->query($sql);
    }

    function sess_std_report() {
        $this->session->set_userdata('ser_class_id', $_POST['class_id']);        
        $this->session->set_userdata('ser_session_id', $_POST['session_id']);
        $this->session->set_userdata('ser_student_status', $_POST['student_status']);
        $this->session->set_userdata('ser_from_date', $_POST['from_date']);
        $this->session->set_userdata('ser_to_date', $_POST['to_date']);



        $this->session->set_userdata('ser_percentage', $_POST['percentage']);
        $this->session->set_userdata('ser_absent', $_POST['absent']);
    }

    function get_sts_report_grid($contact=false) {
        $sortname = common::getVar('sidx', 's.user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con = '1';
        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');
        $branch_id = $this->session->userdata('branch_id');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }

        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($from_date != '') {
            $con.=" and st.admission_date BETWEEN '$from_date' AND '$to_date'";
        }

        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        $sql = "select s.*,st.present_address,st.phone,st.email,st.comments from view_std_reg as s
        	join student as st on st.student_id=s.student_id
                where $con and st.is_delete=0 $sort";

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
            $responce->rows[$i]['id'] = $row['student_id'];
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/std_print_view/' . $row['user_name']) . '" class="print_link print_view" title="Print View">Print View</a>';
            if ($contact) {
                $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['session_name'], $row['student_status'], $row['phone'], $row['email'], $row['present_address']);
            } else {
                $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['session_name'], $row['student_status'], $row['comments'], $phref);
            }

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

    function get_std_report($limit='') {
        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }

        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($from_date != '') {
            $con.=" and st.admission_date BETWEEN '$from_date' AND '$to_date}'";
        }
        $sql = $this->db->query("select s.*,st.present_address,st.phone,st.email,st.comments from view_std_reg as s
        			join student as st on st.student_id=s.student_id
				where 1=1 $con and st.is_delete=0 $limit");
        return $sql->result_array();
    }

    function get_vp_report_grid() {
        $sortname = common::getVar('sidx', 's.user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $con = '1';
        $class_id = $this->session->userdata('ser_class_id');
        $levels_id = $this->session->userdata('ser_levels_id');
        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');


        $pass_from_date = $this->session->userdata('pass_from_date');
        $pass_to_date = $this->session->userdata('pass_to_date');

        $visa_from_date = $this->session->userdata('visa_from_date');
        $visa_to_date = $this->session->userdata('visa_to_date');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }
        if ($levels_id != '') {
            $con.=' and s.levels_id=' . $levels_id;
        }
        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($pass_from_date != '') {
            $con.=" and passport_expiry BETWEEN '{$pass_from_date}' AND '{$pass_to_date}'";
        }
        if ($visa_from_date != '') {
            $con.=" and visa_expiry BETWEEN '{$visa_from_date}' AND '{$visa_to_date}'";
        }

        $sql = "select s.*,st.visa_expiry,st.passport_expiry,st.present_address,st.phone_uk,st.email,st.comments from view_std_reg as s
                join student as st on st.student_id=s.student_id
                where $con $sort";

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
            $responce->rows[$i]['id'] = $row['student_id'];
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/std_print_view/' . $row['user_name']) . '" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['level_name'], $row['session_name'], $row['student_status'], $row['passport_expiry'], $row['visa_expiry'], $row['present_address']);

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

    function get_std_vp_report($limit='') {
        $class_id = $this->session->userdata('ser_class_id');
        $levels_id = $this->session->userdata('ser_levels_id');
        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');


        $pass_from_date = $this->session->userdata('pass_from_date');
        $pass_to_date = $this->session->userdata('pass_to_date');

        $visa_from_date = $this->session->userdata('visa_from_date');
        $visa_to_date = $this->session->userdata('visa_to_date');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }
        if ($levels_id != '') {
            $con.=' and s.levels_id=' . $levels_id;
        }
        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($pass_from_date != '') {
            $con.=" and passport_expiry BETWEEN '{$pass_from_date}' AND '{$pass_to_date}'";
        }
        if ($visa_from_date != '') {
            $con.=" and visa_expiry BETWEEN '{$visa_from_date}' AND '{$visa_to_date}'";
        }
        $sql = $this->db->query("select s.*,st.visa_expiry,st.passport_expiry,st.present_address,st.phone_uk,st.email,st.comments from view_std_reg as s
				join student as st on st.student_id=s.student_id
				where 1=1 $con $limit");
        return $sql->result_array();
    }

    function get_agents_students($agents_id, $limit='') {
        if ($_POST['from_date'] != '') {
            $con.=" and s.admission_date BETWEEN '{$_POST['from_date']}' AND '{$_POST['to_date']}'";
        }
        $sql = $this->db->query("select p.class_code,p.class_name,l.level_name,concat(s.first_name,' ',s.last_name) as student_name,s.user_name,s.student_status,s.student_id,sp.agent_amount,sp.agents_id,sp.payments_id from std_payments as sp
                                join std_fee_installment as fi on fi.installment_id=sp.installment_id
                                join std_level_fee as lf on lf.level_fee_id=fi.level_fee_id
                                join class as p on p.class_id=lf.class_id
                                join levels as l on l.levels_id=lf.levels_id
                                join student as s on s.student_id=lf.student_id
                                where sp.agents_id=$agents_id and lf.class_id={$_POST['class_id']} $con");
        return $sql->result_array();
    }

    function get_attdendance_report_grid($per=false) {
        $sortname = common::getVar('sidx', 's.user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        $absent = $this->session->userdata('ser_absent');
        $percentage = $this->session->userdata('ser_percentage');
        $branch_id = $this->session->userdata('branch_id');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }

        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($absent != '') {
            $con.=' and sc.absent >=' . $absent;
        }

        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        if ($percentage == 80) {
            $con.=' and (select (sum(present)/sum(total_class))*100 from view_std_attd as sav where sav.student_id=s.student_id group by s.student_id) < 80';
        } else if ($percentage == 90) {
            $con.=' and (select (sum(present)/sum(total_class))*100 from view_std_attd as sav where sav.student_id=s.student_id group by s.student_id) >= 80';
        }
//        if($percentage!='')
//        $con.=' and (select (sum(present)/sum(total_class))*100 from view_std_attd as sav where sav.student_id=s.student_id group by s.student_id) <= '.$percentage;

        $sql = "SELECT distinct(s.student_id),s.*,sc.absent,sc.from_date,sc.to_date,sum(sa.present)/sum(total_class)*100 as percentage FROM view_std_reg as s
                                join `view_std_attd` as sa on sa.student_id=s.student_id
                                join student as st on st.student_id=s.student_id
                                join std_con_absent as sc on sc.student_id=s.student_id
                                WHERE sc.is_recent=1 $con group by student_id $sort";
        //debug::writeLog($sql, "sql");

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
            $three_class = sql::count('std_con_absent', "student_id=$row[student_id] and absent=3");
            $six_class = sql::count('std_con_absent', "student_id=$row[student_id] and absent=6");
            $ten_class = sql::count('std_con_absent', "student_id=$row[student_id] and absent=10");
            $responce->rows[$i]['id'] = $row['student_id'];
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            if ($per) {
                $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['session_name'], $row['student_status'], $row['absent'], round($row['percentage'], 2) . '%');
            } else {
                $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['student_status'], $three_class, $six_class, $ten_class, $row['absent'], round($row['percentage'], 2) . '%');
            }
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

    function get_attd_per_report($limit='') {
        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        $absent = $this->session->userdata('ser_absent');
        $percentage = $this->session->userdata('ser_percentage');

        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }

        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($student_status != '') {
            $con.=" and s.student_status like '{$student_status}'";
        }
        if ($absent != '') {
            $con.=' and sc.absent >=' . $absent;
        }

        if ($percentage == 80) {
            $con.=' and (select (sum(present)/sum(total_class))*100 from std_attd_view as sav where sav.student_id=s.student_id group by s.student_id) < 80';
        } else if ($percentage == 90) {
            $con.=' and (select (sum(present)/sum(total_class))*100 from std_attd_view as sav where sav.student_id=s.student_id group by s.student_id) >= 80';
        }

        $sql = $this->db->query("SELECT distinct(s.student_id),s.*,sc.absent,sc.from_date,sc.to_date,sum(sa.present)/sum(total_class)*100 as percentage FROM view_std_reg as s
                                join `view_std_attd` as sa on sa.student_id=s.student_id
                                join student as st on st.student_id=s.student_id
                                join std_con_absent as sc on sc.student_id=s.student_id
                                WHERE sc.is_recent=1 $con group by student_id $limit");
        return $sql->result_array();
    }

    function get_percentage_view($student_id, $session_id) {
        $con = "s.student_id='$student_id' and ma.session_id='$session_id'";
        $sql = $this->db->query("SELECT sa.student_id, s.user_name,ct.type_name,ma.class_type_id, m.module_name,m.module_code, ma.module_id,
                                sum( sa.attendance) AS present, sum( sa.leave_excuse ) AS total_leave,(count( ma.module_attendance_id )-sum( sa.attendance )) as absent,count( ma.module_attendance_id ) AS total_class
                                FROM `std_attendance` AS sa
                                JOIN student AS s ON s.student_id = sa.student_id
                                JOIN module_attendance AS ma ON ma.module_attendance_id = sa.module_attendance_id
                                JOIN module AS m ON m.module_id = ma.module_id
                                JOIN conf_type AS ct ON ct.type_id = ma.class_type_id
                                WHERE $con
                                GROUP BY student_id, ma.module_id,ma.class_type_id,ma.session_id order by m.module_name");
        return $sql->result_array();
    }

    function get_issued_books() {
        $con = '1=1 ';
        if ($_POST['user_type'] != '') {
            $con.=' and i.user_type=' . $this->db->escape($_POST['user_type']);
        }
        if ($_POST['issue_date'] != '') {
            $con.=" and i.issue_date >= '{$_POST['issue_date']}'";
        }
        if ($_POST['expiry_date'] != '') {
            $con.=" and i.expiry_date <='{$_POST['expiry_date']}'";
        }
        $sql = $this->db->query("select i.*,b.serial_no,b.book_name,concat(u.first_name,' ',u.last_name) as borrower_name from book_issued as i
                                join books as b on b.books_id=i.books_id
                                join user as u on u.user_name=i.user_name
                                where $con");
        return $sql->result_array();
    }

    function get_staff_payments() {
        $con = '1=1';
        if ($_POST['department_id'] != '') {
            $con.=' and s.department_id=' . $_POST['department_id'];
        }
        if ($_POST['staff_status'] != '') {
            $con.=' and s.staff_status=' . $this->db->escape($_POST['staff_status']);
        }
        if ($_POST['from_date'] != '') {
            $con.=" and p.paid_date BETWEEN '{$_POST['from_date']}' AND '{$_POST['to_date']}'";
        }

        $sql = $this->db->query("select p.*,s.user_name,concat(s.first_name,' ',s.last_name) as staff_name,dept.name,d.details_name,d.pay_effect,concat(u.first_name,' ',u.last_name) as inputed_by from staff_payment as p
                                join payment_details as d on d.pay_details_id=p.pay_details_id
                                join staffs as s on s.staffs_id=p.staffs_id
                                join staff_department as dept on dept.staff_department_id=s.department_id
                                join user as u on u.user_id=p.user_id
                                where $con order by p.paid_date");
        return $sql->result_array();
    }

    function get_staff_due() {
        $con = '1=1';
        if ($_POST['department_id'] != '') {
            $con.=' and s.department_id=' . $_POST['department_id'];
        }
        if ($_POST['staff_status'] != '') {
            $con.=' and s.staff_status=' . $this->db->escape($_POST['staff_status']);
        }
        if ($_POST['from_date'] != '') {
            $con.=" and p.paid_date BETWEEN '{$_POST['from_date']}' AND '{$_POST['to_date']}'";
        }

        $sql = $this->db->query("select p.staffs_id,p.month,p.year,p.paid_date,p.paid_amount,p.due,s.user_name,concat(s.first_name,' ',s.last_name) as staff_name,dept.name from staff_balance as p
                                join staffs as s on s.staffs_id=p.staffs_id
                                join staff_department as dept on dept.staff_department_id=s.department_id
                                where $con order by p.paid_date");
        return $sql->result_array();
    }

    //Account Report
    function get_payment_report() {
        $con = '1=1 ';
        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($class_id != '') {
            $con.=' and sc.class_id=' . $class_id;
        }


        if ($from_date != '') {
            $con.=" and sp.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = $this->db->query("select s.user_name,concat(s.first_name,' ',s.last_name) as student_name,s.student_status,p.class_name,sp.*,pd.details_name,pd.pay_effect from std_payments as sp
                join student as s on s.student_id=sp.student_id
                join payment_details as pd on pd.pay_details_id=sp.pay_details_id
                join std_fee_installment as si on si.installment_id=sp.installment_id
                join std_class_fee as sc on sc.class_fee_id=si.class_fee_id
                join class as p on p.class_id=sc.class_id
                where $con $sort");

        return $sql->result_array();
    }

    function get_payment_report_grid() {

        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con = '1=1 ';
        $class_id = $this->session->userdata('ser_class_id');
        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($class_id != '') {
            $con.=' and sc.class_id=' . $class_id;
        }


        if ($from_date != '') {
            $con.=" and sp.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = "select s.user_name,concat(s.first_name,' ',s.last_name) as student_name,s.student_status,p.class_name,sp.*,pd.details_name,pd.pay_effect from std_payments as sp
                join student as s on s.student_id=sp.student_id
                join payment_details as pd on pd.pay_details_id=sp.pay_details_id
                join std_fee_installment as si on si.installment_id=sp.installment_id
                join std_class_fee as sc on sc.class_fee_id=si.class_fee_id
                join class as p on p.class_id=sc.class_id
                where $con $sort";


        /* class_name required */

        /* $sql=$this->db->query("select concat(s.first_name,' ',s.last_name) as student_name,s.student_status,sp.*,pd.details_name,pd.pay_effect from std_payments as sp
          join student as s on s.student_id=sp.student_id
          join payment_details as pd on pd.pay_details_id=sp.pay_details_id
          join std_fee_installment as si on si.installment_id=sp.installment_id
          where $con order by sp.paid_date"); */

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
        $tot_debit = 0;
        $tot_credit = 0;
        foreach ($rows as $row) {
            $responce->rows[$i]['id'] = $row['payments_id'];
            if ($row['pay_effect'] == 'Debit') {
                $tot_debit+=$row['paid_amount'];
                $debit = $row['paid_amount'];
                $credit = 0;
            } else {
                $debit = 0;
                $credit = $row['paid_amount'];
                $tot_credit+=$row['paid_amount'];
            }
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/print_view/' . $row['report_id']) . '" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['student_status'], $row['paid_date'], $row['pay_mood'], $row['details_name'], $debit, $credit, $tot_credit - $tot_debit);
            $i++;
        }

        $responce->userdata['debit'] = $tot_debit;
        $responce->userdata['credit'] = $tot_credit;
        $responce->userdata['balance'] = $tot_credit - $tot_debit;
        $responce->userdata['pd.details_name'] = 'Total:';

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

    function get_reg_student_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con = '1=1 ';
        
        $class_id = $this->session->userdata('ser_class_id');
        $session_id = $this->session->userdata('ser_session_id');
        $branch_id = $this->session->userdata('branch_id');


        if ($class_id != '') {
            $con.=' and c.class_id=' . $class_id;
        }
        
        if ($session_id != '') {
            $con.=' and ss.session_id=' . $session_id;
        }

        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        $sql = "select s.user_name,concat(s.first_name,' ',s.last_name) as student_name,
              ss.session_name,c.class_name,cm.class_id,
              rc.student_id from reg_class as rc
              join student as s on rc.student_id=s.student_id
              join class_map as cm on rc.class_map_id=cm.class_map_id              
              join session as ss on ss.session_id=cm.session_id
              join class as c on c.class_id=cm.class_id
              where $con $sort";

        //debug::writeLog($sql,"sql");

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
        $tot_debit = 0;
        $tot_credit = 0;
        foreach ($rows as $row) {

            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/print_payment_report/' . $row['student_id']) . '" class="print_link print_view bold blue" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href,$row['session_name'], $row['class_name'], $phref);
            $i++;
        }

        $responce->userdata['debit'] = $tot_debit;
        $responce->userdata['credit'] = $tot_credit;
        $responce->userdata['balance'] = $tot_credit - $tot_debit;
        $responce->userdata['pd.details_name'] = 'Total:';

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

    function get_due_report() {

        $class_id = $this->session->userdata('ser_class_id');
        $levels_id = $this->session->userdata('ser_levels_id');
        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        $con = '1=1 ';

        if ($class_id != '') {
            $con.=' and sc.class_id=' . $class_id;
        }


        if ($from_date != '') {
            $con.=" and si.committed_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select concat(s.first_name,' ',s.last_name) as student_name,s.student_status,p.class_name,si.* from std_fee_installment as si
                                join std_class_fee as sc on sc.class_fee_id=si.class_fee_id
                                join student as s on s.student_id=sc.student_id
                                join class as p on p.class_id=sc.class_id
                                where $con order by si.committed_date");
        return $sql->result_array();
    }

    function get_due_report_grid() {
        //$this->load->model('mod_accounts');
        $sortname = common::getVar('sidx', 'si.committed_date');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $class_id = $this->session->userdata('ser_class_id');

        $session_id = $this->session->userdata('ser_session_id');
        $student_status = $this->session->userdata('ser_student_status');
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        $con = '1';

        if ($class_id != '') {
            $con.=' and sl.class_id=' . $class_id;
        }

        if ($from_date != '') {
            $con.=" and si.committed_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = "select s.user_name,concat(s.first_name,' ',s.last_name) as student_name,s.student_status,p.class_name,si.* from std_fee_installment as si
                join std_class_fee as sc on sc.class_fee_id=si.class_fee_id
                join student as s on s.student_id=sc.student_id
                join class as p on p.class_id=sc.class_id
                where $con $sort";

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
        $tot_debit = 0;
        $tot_credit = 0;
        foreach ($rows as $row) {
            $responce->rows[$i]['id'] = $row['installment_id'];
            $paid_amount = $this->get_paid_amount($row['installment_id']);
            $tot_paid+=$paid_amount;
            $due = $row['amount'] - $paid_amount;
            $tot_due+=$due;
            $tot_amount+=$row['amount'];
            $href = "<a href='" . site_url('student/student_class/' . $row[student_id]) . "' class='bold blue'>{$row['student_name']}</a>";
            $phref = '<a href="#print_view" rel="' . site_url('report/print_view/' . $row['report_id']) . '" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['student_status'], $row['committed_date'], $row['amount'], $paid_amount, $due);
            $i++;
        }

        $responce->userdata['paid_amount'] = $tot_paid;
        $responce->userdata['si.amount'] = $tot_amount;
        $responce->userdata['due'] = $tot_due;
        $responce->userdata['si.committed_date'] = 'Total:';

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

    function get_paid_amount($installment_id) {
        $amount = 0;
        $sql = $this->db->query("select sum(paid_amount) as amount from std_payments where installment_id=$installment_id");
        $data = $sql->row_array();
        if ($data['amount'] != '') {
            $amount = $data['amount'];
        }
        return $amount;
    }

    function std_acc_report($student_id='') {
        if ($student_id != '') {
            $con = "s.student_id=$student_id";
        }
        $sql = $this->db->query("select concat(s.first_name,' ',s.last_name) as student_name,s.student_status,p.class_name,l.level_name,si.* from std_fee_installment as si
                                join std_level_fee as sl on sl.level_fee_id=si.level_fee_id
                                join student as s on s.student_id=sl.student_id
                                join levels as l on l.levels_id=sl.levels_id
                                join class as p on p.class_id=sl.class_id
                                where $con order by si.committed_date");
        return $sql->result_array();
    }

    function get_std_balance_report() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and sp.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select d.pay_details_id,d.details_name,d.pay_effect,sp.student_id,sp.paid_amount as std_payment,sp.paid_date as std_paid_date,sp.pay_mood as std_pay_mood,concat(s.first_name,' ',s.last_name) as student_name,s.user_name from payment_details as d
                                left join std_payments as sp on sp.pay_details_id=d.pay_details_id
                                join student as s on s.student_id=sp.student_id
                                where sp.paid_date!='' $con order by sp.paid_date");
        return $sql->result_array();
    }

    function get_class_admission_fee() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and afr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = $this->db->query("select afr.admission_fee,afr.class_map_id,sum(saf.fee) as total_admission_fee,
                               cm.class_map_id,s.session_name,c.class_name
                               from admission_fee_register as afr
                               join std_admission_fee as saf on afr.admission_fee_register_id=saf.admission_fee_register_id
                               join class_map as cm on afr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               where saf.is_paid=1 $con group by afr.class_map_id");

        //debug::writeLog($this->db->last_query(),"admission");
        return $sql->result_array();
    }

    function get_class_exam_fee() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and efr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = $this->db->query("select efr.class_map_id,efr.exam_id,efr.exam_fee,count(sef.student_id) as total_exam_fee,
                               cm.class_map_id,s.session_name,c.class_name,e.exam_name
                               from exam_fee_register as efr
                               join std_exam_fee as sef on efr.exam_fee_register_id=sef.exam_fee_register_id
                               join class_map as cm on efr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               join exam as e on efr.exam_id=e.exam_id
                               where sef.is_paid=1 $con group by efr.class_map_id,efr.exam_id");

        //debug::writeLog($this->db->last_query(),"exam");
        return $sql->result_array();
    }

    function get_class_monthly_fee() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and cfr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = $this->db->query("select cfr.class_map_id,cfr.monthly_fee,sum(scf.fee) as total_monthly_fee,sum(scf.fine) as total_fine,
                               cm.class_map_id,s.session_name,c.class_name
                               from class_fee_register as cfr
                               join std_class_fee as scf on cfr.class_fee_register_id=scf.class_fee_register_id
                               join class_map as cm on cfr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               where scf.is_paid=1 $con group by cfr.class_map_id");

        //debug::writeLog($this->db->last_query(),"monthly");
        return $sql->result_array();
    }


    function get_class_additional_fee() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and afr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = $this->db->query("select afr.class_map_id,afr.description,sum(saf.fee) as total_additional_fee,
                               cm.class_map_id,s.session_name,c.class_name
                               from additional_fee_register as afr
                               join std_additional_fee as saf on afr.additional_fee_register_id=saf.additional_fee_register_id
                               join class_map as cm on afr.class_map_id=cm.class_map_id
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id                               
                               where saf.is_paid=1 $con group by afr.class_map_id,afr.description");

        //debug::writeLog($this->db->last_query(),"additional");
        return $sql->result_array();
    }


    function get_std_advance_report() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and sp.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select d.pay_details_id,d.details_name,d.pay_effect,sp.student_id,sp.agreed_fee,sp.amount,sp.paid_amount as std_payment,sp.paid_date as std_paid_date,sp.pay_mood as std_pay_mood,concat(s.first_name,' ',s.last_name) as student_name,s.user_name from payment_details as d
                                join std_advance_payment as sp on sp.pay_details_id=d.pay_details_id
                                join student as s on s.student_id=sp.student_id
                                where sp.paid_date!='' $con order by sp.paid_date");
        return $sql->result_array();
    }

    function get_agent_balance_report() {

        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and ap.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select d.pay_details_id,d.details_name,d.pay_effect,concat(a.first_name,' ',a.last_name) as agent_name,a.user_name as agent_user,ap.agents_id,ap.paid_date as agent_paid_date,ap.paid_amount as agent_payment,ap.pay_mood as agent_pay_mood from payment_details as d
                                left join agent_payment as ap on ap.pay_details_id=d.pay_details_id
                                left join agents as a on a.agents_id=ap.agents_id
                                where ap.paid_date!='' $con order by ap.paid_date");
        return $sql->result_array();
    }

    function get_staff_balance_report() {

        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and stp.paid_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select d.pay_details_id,d.details_name,d.pay_effect,
                                concat(s.first_name,' ',s.last_name) as staff_name,
                                s.user_name as staff_user,stp.staffs_id,stp.paid_date as staff_paid_date,
                                (stp.paid_amount+stp.mpo_amount) as staff_payment,stp.pay_mood as staff_pay_mood
                                from staff_payment as stp
                                join payment_details as d on stp.pay_details_id=d.pay_details_id
                                join staffs as s on s.staffs_id=stp.staffs_id
                                where stp.paid_date!='' $con");
        return $sql->result_array();
    }

    function get_expense_balance_report() {
        $from_date = $this->session->userdata('ser_from_date');
        $to_date = $this->session->userdata('ser_to_date');

        if ($from_date != '') {
            $con.=" and e.exp_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }
        $sql = $this->db->query("select d.pay_details_id,d.details_name,d.pay_effect,e.* from expense as e
                                join payment_details as d on e.pay_details_id=d.pay_details_id
                                where e.exp_date!='' $con");
        return $sql->result_array();
    }

    //Staff
    function get_staff_report_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";



        $con = '1';
        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con = "s.branch_id=$branch_id";
        }

        $sql = "select s.status,s.staffs_id,s.staff_status,s.user_name,s.first_name,s.last_name,
                dg.designation,d.name as department_name from staffs as s
                join staff_department as d on d.staff_department_id=s.department_id
                join staff_designation as dg on dg.staff_designation_id=s.designation_id
                where $con $sort";

        //debug::writeLog($sql);

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('staffs', '1=1');
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
            $responce->rows[$i]['id'] = $row['staffs_id'];
            $href = '<a href="' . site_url('staffs/profile/' . $row['staffs_id']) . '" class="bold blue">' . $row['first_name'] . ' ' . $row['last_name'] . '</a>';
            $phref = '<a href="#print_view" rel="' . site_url('staffs/print_view/' . $row['staffs_id']) . '" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['department_name'], $row['staff_status'], $phref);
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

    function get_letter_report_grid() {
        $sortname = common::getVar('sidx', 'letter_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $con = '1';
        $letter_type_id = common::getVar('tid');
        $class_id = common::getVar('pid');
        $session_id = common::getVar('sid');
        $from_date = common::getVar('fdate');
        $to_date = common::getVar('tdate');
        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        if ($letter_type_id != '') {
            $con.=' and l.letters_type_id=' . $letter_type_id;
        }
        if ($class_id != '') {
            $con.=' and s.class_id=' . $class_id;
        }

        if ($session_id != '') {
            $con.=' and s.session_id=' . $session_id;
        }
        if ($from_date != '') {
            $con.=" and sl.issue_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $sql = "select s.student_name,s.user_name,s.class_name,s.session_name,s.student_status,sl.*,DATE_FORMAT(sl.issue_date,'%Y-%m-%d') as issue_date,l.letter_title from student_letters as sl
                join view_std_reg as s on s.student_id=sl.student_id
                join letters as l on l.letters_id=sl.letters_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $temp = $this->db->query($sql);
        $count = count($temp->result_array());
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
            $responce->rows[$i]['id'] = $row['student_letters_id'];
            $href = '<a href="#print_view" rel="' . site_url('letters/print_view/' . $row['student_letters_id']) . '" class="blue print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell'] = array($row['user_name'], $row['student_name'], $row['class_name'], $row['session_name'], $row['letter_title'], $row['issue_date'], $href);
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

    function get_admission_fee($student_id) {

        $sql = $this->db->query("select af.*,raf.admission_fee,cm.class_id,c.class_name,
                                s.session_name,rc.privilege from std_admission_fee as af
                                join admission_fee_register as raf on af.admission_fee_register_id=raf.admission_fee_register_id
                                join class_map as cm on raf.class_map_id=cm.class_map_id                                
                                join class as c on c.class_id=cm.class_id
                                join session as s on s.session_id=cm.session_id
                                join reg_class as rc on rc.student_id=af.student_id
                                where af.student_id=$student_id");
        return $sql->result_array();
    }

    function get_exam_fee($student_id) {

        $sql = $this->db->query("select ef.*,efr.exam_fee,e.exam_name from std_exam_fee as ef
                                join exam_fee_register as efr on ef.exam_fee_register_id=efr.exam_fee_register_id
                                join exam as e on e.exam_id=efr.exam_id
                                where ef.student_id=$student_id");
        return $sql->result_array();
    }

    function get_monthly_fee($student_id) {

        $sql = $this->db->query("select cf.*,rcf.month,rcf.monthly_fee,rc.privilege
                                from std_class_fee as cf 
                                join class_fee_register as rcf on rcf.class_fee_register_id=cf.class_fee_register_id
                                join reg_class as rc on rc.student_id=cf.student_id
                                where cf.student_id=$student_id");
        return $sql->result_array();
    }



    function get_additional_fee($student_id) {

        $sql = $this->db->query("select af.*,raf.description
                                from std_additional_fee as af join additional_fee_register as raf
                                on raf.additional_fee_register_id=af.additional_fee_register_id
                                where af.student_id=$student_id order by raf.description");
        return $sql->result_array();
    }

    function get_all_admission_fee($page_type) {

        $from_date = ($page_type=="view")?$_POST['from_date']:$this->session->userdata('std_from_date');
        $to_date = ($page_type=="view")?$_POST['to_date']:$this->session->userdata('std_to_date');        
        $session = ($page_type=="view")?$_POST['session_id']:$this->session->userdata('std_session');
        $class = ($page_type=="view")?$_POST['class_id']:$this->session->userdata('std_class');
        $payment_type = $this->session->userdata('payment_type');

        if ($from_date != '' && $to_date != '') {
            $con.=" and afr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $class_map_cond = "";
        
        if($session!=''){
            $class_map_cond.=" and session_id=$session";
        }
        if($class!=''){
            $class_map_cond.=" and class_id=$class";
        }
        $class_map_id = common::get_class_map_id_cond($class_map_cond);
        
        $con.=" and afr.class_map_id in ($class_map_id)";
        


        if ($payment_type == "paid") {
            $payment_con = " and saf.is_paid=1";
        } else {
            $payment_con = " and saf.is_paid=0";
        }

        $sql = $this->db->query("select afr.admission_fee,afr.class_map_id,saf.student_id,
                               saf.paid_date,saf.fee,
                               std.user_name,concat(std.first_name,' ',std.last_name) as student_name,
                               cm.class_map_id,s.session_name,c.class_name,rc.privilege
                               from admission_fee_register as afr
                               join std_admission_fee as saf on afr.admission_fee_register_id=saf.admission_fee_register_id
                               join student as std on saf.student_id=std.student_id
                               join class_map as cm on afr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               join reg_class as rc on rc.student_id=saf.student_id
                               where 1 $con $payment_con");

        //debug::writeLog($this->db->last_query(),"admission");
        return $sql->result_array();
    }


    

    function get_all_monthly_fee($page_type) {

        $from_date = ($page_type=="view")?$_POST['from_date']:$this->session->userdata('std_from_date');
        $to_date = ($page_type=="view")?$_POST['to_date']:$this->session->userdata('std_to_date');       
        $session = ($page_type=="view")?$_POST['session_id']:$this->session->userdata('std_session');
        $class = ($page_type=="view")?$_POST['class_id']:$this->session->userdata('std_class');
        $month= ($page_type=="view")?$_POST['month']:$this->session->userdata('std_month');
        $section=($page_type=="view")?$_POST['section']:$this->session->userdata('std_section');
        
        $payment_type = $this->session->userdata('payment_type');

        if ($from_date != '' && $to_date != '') {
            $con.=" and cfr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $class_map_cond = "";
        
        if($session!=''){
            $class_map_cond.=" and session_id=$session";
        }
        if($class!=''){
            $class_map_cond.=" and class_id=$class";
        }
        $class_map_id = common::get_class_map_id_cond($class_map_cond);

        $con.=" and cfr.class_map_id in ($class_map_id)";

        if($month!=''){
            $con.=" and cfr.month='$month'";
        }
        if($section!=''){
            $con.=" and cfr.section='$section'";
        }



        if ($payment_type == "paid") {
            $payment_con = " and scf.is_paid=1";
        } else {
            $payment_con = " and scf.is_paid=0";
        }

        $sql = $this->db->query("select cfr.monthly_fee,cfr.class_map_id,cfr.month,cfr.section,
                               scf.student_id,scf.paid_date,scf.fee,scf.fine,
                               std.user_name,concat(std.first_name,' ',std.last_name) as student_name,
                               cm.class_map_id,s.session_name,c.class_name,rc.privilege
                               from class_fee_register as cfr
                               join std_class_fee as scf on cfr.class_fee_register_id=scf.class_fee_register_id
                               join student as std on scf.student_id=std.student_id
                               join class_map as cm on cfr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               join reg_class as rc on scf.student_id=rc.student_id
                               where 1 $con $payment_con");

        //debug::writeLog($this->db->last_query(),"admission");
        return $sql->result_array();
    }


    


    function get_all_exam_fee($page_type) {

        $from_date =($page_type=="view")?$_POST['from_date']:$this->session->userdata('std_from_date');
        $to_date =($page_type=="view")?$_POST['to_date']:$this->session->userdata('std_to_date');;        
        $session =($page_type=="view")?$_POST['session_id']:$this->session->userdata('std_session');;
        $class =($page_type=="view")?$_POST['class_id']:$this->session->userdata('std_class');;
        $exam=($page_type=="view")?$_POST['exam_id']:$this->session->userdata('std_exam');;

        $payment_type = $this->session->userdata('payment_type');

        if ($from_date != '' && $to_date != '') {
            $con.=" and efr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $class_map_cond = "";
        
        if($session!=''){
            $class_map_cond.=" and session_id=$session";
        }
        if($class!=''){
            $class_map_cond.=" and class_id=$class";
        }
        $class_map_id = common::get_class_map_id_cond($class_map_cond);

        $con.=" and efr.class_map_id in ($class_map_id)";

        if($exam!=''){
            $con.=" and efr.exam_id=$exam";
        }
        



        if ($payment_type == "paid") {
            $payment_con = " and sef.is_paid=1";
        } else {
            $payment_con = " and sef.is_paid=0";
        }

        $sql = $this->db->query("select efr.exam_fee,efr.class_map_id,e.exam_name,
                               sef.student_id,sef.paid_date,
                               std.user_name,concat(std.first_name,' ',std.last_name) as student_name,
                               cm.class_map_id,s.session_name,c.class_name
                               from exam_fee_register as efr
                               join exam as e on efr.exam_id=e.exam_id
                               join std_exam_fee as sef on efr.exam_fee_register_id=sef.exam_fee_register_id
                               join student as std on sef.student_id=std.student_id
                               join class_map as cm on efr.class_map_id=cm.class_map_id                               
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               where 1 $con $payment_con");

        //debug::writeLog($this->db->last_query(),"admission");
        return $sql->result_array();
    }




    function get_all_additional_fee($page_type) {

        $from_date = ($page_type=="view")?$_POST['from_date']:$this->session->userdata('std_from_date');
        $to_date = ($page_type=="view")?$_POST['to_date']:$this->session->userdata('std_to_date');
        $session = ($page_type=="view")?$_POST['session_id']:$this->session->userdata('std_session');
        $class = ($page_type=="view")?$_POST['class_id']:$this->session->userdata('std_class');
        $desciption=($page_type=="view")?$_POST['description']:$this->session->userdata('std_description');
        $payment_type = $this->session->userdata('payment_type');

        if ($from_date != '' && $to_date != '') {
            $con.=" and afr.register_date BETWEEN '{$from_date}' AND '{$to_date}'";
        }

        $class_map_cond = "";

        if($session!=''){
            $class_map_cond.=" and session_id=$session";
        }
        if($class!=''){
            $class_map_cond.=" and class_id=$class";
        }
        $class_map_id = common::get_class_map_id_cond($class_map_cond);

        $con.=" and afr.class_map_id in ($class_map_id)";


        if($desciption!=''){
            $con.=" and afr.description like '%$desciption%'";
        }

        if ($payment_type == "paid") {
            $payment_con = " and saf.is_paid=1";
        } else {
            $payment_con = " and saf.is_paid=0";
        }

        $sql = $this->db->query("select afr.description,afr.class_map_id,saf.student_id,saf.fee,saf.paid_date,
                               std.user_name,concat(std.first_name,' ',std.last_name) as student_name,
                               cm.class_map_id,s.session_name,c.class_name
                               from additional_fee_register as afr
                               join std_additional_fee as saf on afr.additional_fee_register_id=saf.additional_fee_register_id
                               join student as std on saf.student_id=std.student_id
                               join class_map as cm on afr.class_map_id=cm.class_map_id
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id
                               where 1 $con $payment_con order by afr.description");

        //debug::writeLog($this->db->last_query(),"additional");
        return $sql->result_array();
    }

}
?>