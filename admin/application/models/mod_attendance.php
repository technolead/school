<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_attendance
 *
 * @author Anwar
 */
class mod_attendance extends Model {

    function __construct() {
        parent::Model();
    }

    function get_module_attendance($limit='') {
        $sql = $this->db->query("select m.module_name,m.module_code,u.first_name,u.last_name,t.type_name,r.* from module_attendance as r
                                join module as m on m.module_id=r.module_id
                                join conf_type as t on t.type_id=r.attendance_type_id
                                join user as u on u.user_id=r.user_id where 1 order by r.date $limit");
        return $sql->result_array();
    }

    function sort_class_attendance($type_id='', $limit='') {
        $con = '1=1';
        
        if ($type_id != '' && $type_id != 0) {
            $con.=" and ca.attendance_type_id=$type_id";
        }
        $sql = $this->db->query("select cm.class_duration,s.session_name,c.class_name,
                                u.first_name,u.last_name,t.type_name,ca.* from class_attendance as ca
                                join class_map as cm on cm.class_map_id=ca.class_map_id
                                join session as s on cm.session_id=s.session_id
                                join class as c on cm.class_id=c.class_id
                                join conf_type as t on t.type_id=ca.attendance_type_id
                                join user as u on u.user_id=ca.user_id where $con order by ca.date $limit");

        return $sql->result_array();
    }


    function get_class_attendance($limit='') {
        $sql = $this->db->query("select cm.class_duration,s.session_name,c.class_name,
                                u.first_name,u.last_name,t.type_name,ca.* from class_attendance as ca
                                join class_map as cm on cm.class_map_id=ca.class_map_id
                                join session as s on cm.session_id=s.session_id
                                join class as c on cm.class_id=c.class_id
                                join conf_type as t on t.type_id=ca.attendance_type_id
                                join user as u on u.user_id=ca.user_id where 1 order by ca.date $limit");
        return $sql->result_array();
    }

    function get_view_std_attendance($student_id) {
        $class_id = $this->session->userdata('sel_class_id');
        if ($class_id != '') {
            $con = " and ca.class_id>='$class_id'";
        }

        $session_id = $this->session->userdata('sel_session_id');
        if ($session_id != '') {
            $con = " and ca.session_id>='$session_id'";
        }
        $section = $this->session->userdata('sel_section');
        if ($section != '') {
            $con = " and ca.section>='$section'";
        }

        $from_date = $this->session->userdata('sel_from_date');
        if ($from_date != '') {
            $con.=" and ca.date<='$from_date'";
        }

        $to_date = $this->session->userdata('sel_to_date');
        if ($to_date != '') {
            $con.=" and ca.date<='$to_date'";
        }
        $attendance_type_id = $this->session->userdata('sel_attendance_type_id');
        if ($attendance_type_id != '') {
            $con.=" and ca.attendance_type_id=$attendance_type_id";
        }

        $sql = $this->db->query("select a.attendance,a.leave_excuse,a.std_attendance_id,ca.date,
                                  cm.class_map_id,c.class_name,s.session_name,
                                  t.type_name from std_attendance as a
                                  join class_attendance as ca on ca.class_attendance_id=a.class_attendance_id
                                  join class_map as cm on ca.class_map_id=cm.class_map_id
                                  join class as c on cm.class_id=c.class_id
                                  join session as s on cm.session_id=s.session_id                                  
                                  join conf_type as t on t.type_id=ca.attendance_type_id
                                  where a.student_id='$student_id' $con order by ca.date");
        return $sql->result_array();
    }

    function update_std_attendance() {
        $student_id = $this->session->userdata('sel_student_id');
        if (common::student_is_delete($student_id) == false) {
            if (count($_POST['std_attendance_id']) > 0) {
                foreach ($_POST['std_attendance_id'] as $std_attendance_id) {
                    $attendance = $_POST['attendance_' . $std_attendance_id];
                    if ($attendance == -1) {
                        $leave = 1;
                        $attendance = 0;
                    } else {
                        $leave = 0;
                    }
                    $sql = "update std_attendance set
                            attendance={$attendance},
			    leave_excuse='{$leave}'
                      where std_attendance_id=$std_attendance_id and student_id=$student_id";
                    $this->db->query($sql);
                }
            }
        }
    }

    function save_module_attendance() {
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into module_attendance set
                class_id={$this->db->escape($_POST['class_id'])},
                module_id={$this->db->escape($_POST['module_id'])},
                attendance_type_id={$this->db->escape($_POST['attendance_type_id'])},
                session_id={$this->db->escape($_POST['session_id'])},
                section={$this->db->escape($_POST['section'])},
                date={$this->db->escape($_POST['date'])},
                user_id={$this->db->escape($user_id)}";
        $this->db->query($sql);
        return $this->db->insert_id();
    }



    function save_class_attendance(){
        $user_id = $this->session->userdata('user_id');
        $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        $data=array(
            "class_map_id"=>$class_map_id,
            "attendance_type_id"=>$_POST['attendance_type_id'],
            "section"=>$_POST['section'],
            "date"=>$_POST['date'],
            "user_id"=>$user_id
        );
        $this->db->insert("class_attendance",$data);
        return $this->db->insert_id();

    }

    function update_class_attendance() {
        $class_attendance_id = $this->session->userdata('class_attendance_id');
        $this->db->query("update std_attendance set date={$this->db->escape($_POST['date'])} where class_attendance_id=$class_attendance_id");
        $sql = "update class_attendance set
                attendance_type_id={$this->db->escape($_POST['attendance_type_id'])},
                date={$this->db->escape($_POST['date'])}
                where class_attendance_id=$class_attendance_id";
        return $this->db->query($sql);
    }

    function get_mod_attendance_details($module_attendance_id) {
        $sql = $this->db->query("select m.module_name,m.module_code,p.class_name,sm.session_name,u.first_name,u.last_name,t.type_name,r.* from module_attendance as r
                                join module as m on m.module_id=r.module_id
                                join class as p on p.class_id=r.class_id
                                join session as sm on sm.session_id=r.session_id
                                join conf_type as t on t.type_id=r.attendance_type_id
                                join user as u on u.user_id=r.user_id
				where r.module_attendance_id=$module_attendance_id");
        return $sql->row_array();
    }



    function get_class_attendance_details($class_attendance_id) {
        $sql = $this->db->query("select c.class_name,s.session_id,s.session_name,
                                u.first_name,u.last_name,t.type_name,ca.* from class_attendance as ca
                                join class_map as cm on ca.class_map_id=cm.class_map_id
                                join class as c on cm.class_id=c.class_id
                                join session as s on cm.session_id=s.session_id
                                join conf_type as t on t.type_id=ca.attendance_type_id
                                join user as u on u.user_id=ca.user_id
				where ca.class_attendance_id=$class_attendance_id");
        return $sql->row_array();
    }


    function get_registered_student($module_id, $session_id='', $date='') {
        if ($session_id != '') {
            $con = " and m.session_id=$session_id";
        }
        if ($date != '') {
            $con.=" and rs.enrolment_date <= '$date'";
        }
        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }
        $sql = $this->db->query("select distinct(s.student_id),s.student_name,s.class_code,s.user_name,m.student_id,m.module_status,m.module_attempt from reg_module as m
                                join view_std_reg as s on s.student_id=m.student_id
                                join reg_class as rc on rc.student_id=m.student_id and rc.class_status=1
                                where m.module_id=$module_id $con and m.module_status=1 and rc.is_delete=0 order by s.user_name"); //Continue is the Module Status for Student Module Registration
        //echo $this->db->last_query();exit();
        return $sql->result_array();
    }


    function get_class_reg_student($class_map_id,$section='') {

        $CI =& get_instance();
        $branch_id=$CI->session->userdata('branch_id');
        $con='';
        if($section!=''){
          $con.="and rc.section='$section'"  ;
        }
        if($branch_id!=''){
            $con.=" and s.branch_id='{$branch_id}'";
        }

        $action=$this->session->userdata("student_action");
        if($action=='record'){
            $action_con=" and s.is_delete=0";
        }else{
            $action_con="";
        }

        $sql=$CI->db->query("select distinct(s.student_id),s.user_name,s.is_delete,concat(s.first_name, ' ',s.last_name) as student_name,rc.class_map_id
                             from student as s join reg_class as rc on s.student_id=rc.student_id
                             where rc.class_map_id=$class_map_id and rc.class_status=1 $con $action_con");
        //echo $CI->db->last_query();exit();
        return $sql->result_array();
    }



    function get_module_reg_student($class_id='', $module_id='', $session_id='', $section='', $date='') {
        $module_attendance_id = $this->session->userdata('module_attendance_id');
        $branch_id = $this->session->userdata('branch_id');
        $con = '';
        if ($class_id != '') {
            $con.=" and s.class_id='{$class_id}'";
        }

        if ($session_id != '') {
            $con.=" and s.session_id='{$session_id}'";
        }
        if ($section != '') {
            $con.=" and rc.section='{$section}'";
        }
        if ($branch_id != '') {
            $con.=" and branch_id='{$branch_id}'";
        }
        /* if($date!='') {
          $con.="' and {$date}' BETWEEN rl.level_start_date and rl.level_end_date";
          } */

        $sql = $this->db->query("select distinct(s.student_id),s.student_name,s.class_code,s.user_name,m.module_id,m.student_id,m.module_status,m.module_attempt from reg_module as m
                                join view_std_reg as s on s.student_id=m.student_id
                                join reg_class as rc on rc.student_id=m.student_id and rc.class_status=1
                                where m.module_id='{$module_id}' $con and m.module_status=1 and m.is_delete=0 order by s.user_name"); //Continue is the Module Status for Student Module Registration

        return $sql->result_array();
    }

    function save_reg_attendace() {
        $class_attendance_id = $this->session->userdata('class_attendance_id');
        $session_id = $this->session->userdata('attd_session_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                $attendance = $_POST['attendance_' . $student_id];
                if ($attendance == -1) {
                    $leave = 1;
                    $attendance = 0;
                } else {
                    $leave = 0;
                }
                $sql = "insert into std_attendance set
                       class_attendance_id=$class_attendance_id,
                       student_id=$student_id,
                       attendance={$this->db->escape($attendance)},
		       leave_excuse='{$leave}',
                       date={$this->db->escape($_POST['date'])}";
                $this->db->query($sql);
                //if($attendance==0) {
                $this->add_continuous_absent($student_id);
                // }
            }
        }
        $no_present = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and attendance=1");
        $no_absent = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and attendance=0");
        $no_leave = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and leave_excuse=1");
        $sql_up = "update class_attendance set
                        no_present=$no_present,
                        no_absent=$no_absent,
			no_leave=$no_leave
                    where class_attendance_id=$class_attendance_id";
        return $this->db->query($sql_up);
    }

    function add_continuous_absent($student_id='') {
        $session_id = $this->session->userdata('attd_session_id');
        $class_map_id=$this->session->userdata('attd_class_map_id');

        if ($student_id == '') {
            
        } else {

            if (common::student_is_delete($student_id) == false) {
                sql::delete('std_con_absent', "student_id='$student_id'");
                $conAbsent = sql::rows('view_attd', "student_id='$student_id' order by date asc");

                $preAbsent = 0;
                $from_date = '';
                $to_date = '';

                if (count($conAbsent) > 0) {

                    foreach ($conAbsent as $ab) {

                        if ($ab['attendance'] == 0) {
                            $preAbsent+=1;
                            if ($from_date == '') {
                                $from_date = $ab['date'];
                            }
                            $to_date = $ab['date'];
                        } else {
                            if ($preAbsent != 0) {
                                $this->db->query("update std_con_absent set is_recent=0 where student_id='$student_id' and is_recent=1");
                                $this->db->query("insert into std_con_absent set
                                               student_id='$student_id',
                                               class_map_id='$class_map_id',
                                               from_date='$from_date',
                                               to_date='$to_date',
                                               absent='$preAbsent'");
                                $from_date = '';
                            }
                            if ($from_date == '') {
                                $from_date = $ab['date'];
                            }
                            $to_date = $ab['date'];
                            $preAbsent = 0;
                        }
                    }

                    if ($preAbsent != 0) {
                        $this->db->query("update std_con_absent set is_recent=0 where student_id='$student_id' and is_recent=1");
                        $this->db->query("insert into std_con_absent set
                                       student_id='$student_id',
                                       class_map_id='$class_map_id',
                                       from_date='$from_date',
                                       to_date='$to_date',
                                       absent='$preAbsent'");
                    } else {
                        $this->db->query("update std_con_absent set is_recent=0 where student_id='$student_id' and is_recent=1");
                        $this->db->query("insert into std_con_absent set
                                       student_id='$student_id',
                                       class_map_id='$class_map_id',
                                       from_date='$from_date',
                                       to_date='$to_date',
                                       absent='$preAbsent'");
                    }
                }
            }
        }
    }

    function update_reg_attendace() {
        $class_attendance_id = $this->session->userdata('class_attendance_id');

        if (count($_POST['std_attendance_id']) > 0) {
            $inc = 0;
            foreach ($_POST['std_attendance_id'] as $std_attendance_id) {
                $attendance = $_POST['attendance_' . $std_attendance_id];
                if ($attendance == -1) {
                    $leave = 1;
                    $attendance = 0;
                } else {
                    $leave = 0;
                }

                $student_id = $_POST['student_id'][$inc];
                if (common::student_is_delete($student_id) == false) {

                    $sql = "update std_attendance set
                       attendance={$this->db->escape($attendance)},
		       leave_excuse='{$leave}',
                       date={$this->db->escape($_POST['date'])}
                       where std_attendance_id=$std_attendance_id";
                    $this->db->query($sql);

                    $date = $_POST['date'];

//                if($attendance==0 || $_POST['prev_attendance'][$inc]==0) {
                    $this->add_continuous_absent($student_id);
//                }
                }
                $inc++;
            }
        }
        $no_present = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and attendance=1");
        $no_absent = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and attendance=0");
        $no_leave = sql::count('std_attendance', "class_attendance_id=$class_attendance_id and leave_excuse=1");
        $sql_up = "update class_attendance set
                        no_present=$no_present,
                        no_absent=$no_absent,
			no_leave=$no_leave
                    where class_attendance_id=$class_attendance_id";
        return $this->db->query($sql_up);
    }

    function get_edited_student_attd($class_attendance_id) {
        $sql = $this->db->query("select s.first_name,s.last_name,s.user_name,sa.* from std_attendance as sa
                                join student as s on s.student_id=sa.student_id
                                where sa.class_attendance_id=$class_attendance_id order by s.user_name");
        return $sql->result_array();
    }

    function get_student_attendance($type_id, $limit='') {
        $student_id = $this->session->userdata('sel_student_id');
        $session_id = $this->session->userdata('sel_session_id');
        if ($student_id == '') {
            redirect('attendance/view_attendance');
        }
        if ($session_id != '') {
            $con = " and s.session_id>='$session_id'";
        }
        $from_date = $this->session->userdata('sel_from_date');
        if ($from_date != '') {
            $con = " and ca.date>='$from_date'";
        }
        $to_date = $this->session->userdata('sel_to_date');
        if ($to_date != '') {
            $con.=" and ca.date<='$to_date'";
        }
        
        if (is_numeric($type_id)) {
            $con.=" and ca.attendance_type_id=$type_id";
        }


        $sql = $this->db->query("select a.attendance,a.std_attendance_id,a.leave_excuse,ca.date,
                                  t.type_name from std_attendance as a
                                  join view_std_reg as s on s.student_id=a.student_id
                                  join class_attendance as ca on ca.class_attendance_id=a.class_attendance_id
                                  join conf_type as t on t.type_id=ca.attendance_type_id
                                  where s.student_id='$student_id' $con order by ca.date $limit");
        return $sql->result_array();
    }

    function get_percentage_view() {
        $student_id = $this->session->userdata('sel_student_id');
        $session_id = $this->session->userdata('sel_session_id');
        if ($student_id == '' || $session_id == '') {
            redirect('attendance/view_attendance');
        }
        $con = "s.student_id='$student_id'";
        $from_date = $this->session->userdata('sel_from_date');
        if ($from_date != '') {
            $con.=" and ca.date>='$from_date'";
        }
        $to_date = $this->session->userdata('sel_to_date');
        if ($to_date != '') {
            $con.=" and ca.date<='$to_date'";
        }

        $sql = $this->db->query("SELECT sa.student_id, s.user_name,ct.type_name,ca.attendance_type_id,                                    
                                    sum( sa.attendance) AS present, sum( sa.leave_excuse ) AS total_leave,
                                   (count( ca.class_attendance_id )-sum( sa.attendance )-sum( sa.leave_excuse )) as absent,
                                    count( ca.class_attendance_id ) AS total_class
                                    FROM `std_attendance` AS sa
                                    JOIN student AS s ON s.student_id = sa.student_id
                                    JOIN class_attendance AS ca ON ca.class_attendance_id = sa.class_attendance_id                                    
                                    JOIN conf_type AS ct ON ct.type_id = ca.attendance_type_id
                                    WHERE $con
                                    GROUP BY student_id, ca.class_map_id,ca.attendance_type_id ");
        return $sql->result_array();
    }

    function get_attd_summery($limit='') {
        $branch_id = $this->session->userdata('branch_id');
        $con = '';
        if ($branch_id != '') {
            $con.=" and s.branch_id='{$branch_id}'";
        }
        $sql = $this->db->query("SELECT distinct(s.student_id),s.first_name,s.last_name,s.user_name,rp.class_name,sc.absent,sc.from_date,sc.to_date,
                                (sum(sa.present))/(sum(total_class)-sum(sa.total_leave))*100 as percentage FROM student as s
                                join view_std_reg as rp on rp.student_id=s.student_id and is_recent=1 and rp.class_status=1
                                join `view_std_attd` as sa on sa.student_id=s.student_id and sa.class_map_id=rp.class_map_id
                                left join std_con_absent as sc on sc.student_id=s.student_id and sc.is_recent=1 and sc.class_map_id=sa.class_map_id
                                WHERE rp.is_recent=1 $con group by student_id $limit");
        return $sql->result_array();
    }

    function filter_attd_summery($limit='') {
        $con = '';
        if ($_POST['class_id'] != '') {
            $con.=' and rp.class_id=' . $_POST['class_id'];
        }

        if ($_POST['session_id'] != '') {
            $con.=' and rp.session_id=' . $_POST['session_id'];
        }
        if ($_POST['absent'] != '') {
            $con.=' and sc.absent>=' . $_POST['absent'];
        }
        $branch_id = $this->session->userdata('branch_id');

        if ($branch_id != '') {
            $con.=" and s.branch_id='{$branch_id}'";
        }

        if($_POST['class_id']!='' && $_POST['session_id']!=''){
            $class_map_id=common::get_class_map_id($_POST['session_id'],$_POST['class_id']);
        }else{
            $class_map_id=0;
        }

        if ($_POST['percentage'] != '') {
            $lower = $_POST['percentage'] - 10;
            $con.=" and (select (sum(present)/sum(total_class))*100 from view_std_attd as sav where sav.student_id=s.student_id $per group by s.student_id)='{$_POST['percentage']}'";
            //$con.=" and (select (sum(present)/sum(total_class))*100 from view_std_attd as sav where sav.student_id=s.student_id $per group by s.student_id,sav.levels_id)>='{$lower}'";
        }
        $sql = $this->db->query("SELECT distinct(s.student_id),s.first_name,s.last_name,s.user_name,rp.class_name,sc.absent,sc.from_date,sc.to_date,
                                    (sum(sa.present))/(sum(total_class)-sum(sa.total_leave))*100 as percentage FROM student as s
                                    join view_std_reg as rp on rp.student_id=s.student_id and (rp.is_recent=1 or rp.session_id='{$_POST[session_id]}')
                                    join `view_std_attd` as sa on sa.student_id=s.student_id
                                    left join std_con_absent as sc on sc.student_id=s.student_id and (sc.is_recent=1 or sc.class_map_id='{$class_map_id}')
                                    WHERE 1 $con group by student_id $limit");
        return $sql->result_array();
    }

    function get_letter_options($sel='') {
        $letter_type_id = ATTENDANCE_TYPE;
        //$sql=$this->db->query("select letter_title,letters_id from letters where status='enabled' and letters_type_id=$letter_type_id");
        $sql = $this->db->query("select letter_title,letters_id from letters where status='enabled'");
        $rows = $sql->result_array();
        $opt.="<option value=''>Select Letter</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($row['letters_id'] == $sel) {
                    $opt.="<option value='$row[letters_id]' selected='selected'>$row[letter_title]</option>";
                } else {
                    $opt.="<option value='$row[letters_id]'>$row[letter_title]</option>";
                }
            }
        }
        return $opt;
    }

    function get_my_attd_letters($student_id='') {
        $letter_type_id = ATTENDANCE_TYPE;
        $sql = $this->db->query("select l.des,l.letter_title,sl.* from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
				where sl.student_id=$student_id "); //and l.letters_type_id=$letter_type_id
        return $sql->result_array();
    }

    function get_std_letters_name($student_id='') {
        if ($student_id == '') {
            return '';
        }
        $rows = $this->get_my_attd_letters($student_id);
        $letter = array();
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $letter[] = $row['letter_title'];
            }
        }
        return implode(', ', $letter);
    }

    function get_std_absent_notice($student_id='') {
        if ($student_id == '') {
            return '';
        }
        $rows = sql::rows('absent_notice', "student_id=$student_id");
        $notice = array();
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $notice[] = 'From ' . $row['from_date'] . ' To ' . $row['to_date'] . '[' . $row['reason'] . ']';
            }
        }
        return implode(', ', $notice);
    }

    function get_attd_per_options($sel='') {
        // $arr=array('80'=>'Bellow 80%','90'=>'Above 80%');
        $opt.='<option value="">----Select----</option>';
        for ($inc = 100; $inc > 0; $inc-=10) {
            if ($inc == $sel) {
                $opt.="<option value='$inc' selected='selected'>$inc%</option>";
            } else {
                $opt.="<option value='$inc'>$inc%</option>";
            }
        }
        return $opt;
    }

    function get_attd_class_options($sel='') {
        $arr = array('3' => '3 Class Absent', '6' => '6 Class Absent', '10' => '10 Class Absent');
        $opt.='<option value="">----Select----</option>';
        foreach ($arr as $k => $val) {
            if ($k == $sel) {
                $opt.="<option value='$k' selected='selected'>$val</option>";
            } else {
                $opt.="<option value='$k'>$val</option>";
            }
        }
        return $opt;
    }

    function add_percentage($student_id, $percentage) {
        $prev = sql::row('std_percentage', "student_id=$student_id and is_recent=1");
        if ($percentage < 80) {
            if ($prev['student_id'] == '') {
                $this->db->query("update std_percentage set is_recent=0 where student_id=$student_id");
                $this->db->query("insert into std_percentage set student_id=$student_id, percentage=$percentage, date=CURDATE()");
            } else {
                if ($prev['percentage'] >= 80) {
                    $this->db->query("update std_percentage set is_recent=0 where student_id=$student_id");
                    $this->db->query("insert into std_percentage set student_id=$student_id, percentage=$percentage, date=CURDATE()");
                }
            }
        } else {
            if ($prev['student_id'] == '') {
                $this->db->query("update std_percentage set is_recent=0 where student_id=$student_id");
                $this->db->query("insert into std_percentage set student_id=$student_id, percentage=$percentage, date=CURDATE()");
            } else {
                $this->db->query("update std_percentage set percentage=$percentage where student_id=$student_id");
            }
        }
    }

    function get_color_code($val='') {
        $attd = common::get_settings_data();
        if ($val >= $attd['per_start_1'] && $val <= $attd['per_end_1']) {
            return 'first_color';
        } else if ($val >= $attd['per_start_2'] && $val < $attd['per_end_2']) {
            return 'second_color';
        } else if ($val <= $attd['per_start_3']) {
            return 'fourth_color';
        }
    }

    function save_print_attendance() {
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into print_attendance set
                date={$this->db->escape($_POST['date'])},
                class_id={$this->db->escape($_POST['class_id'])},
                module_id={$this->db->escape($_POST['module_id'])},
                session_id={$this->db->escape($_POST['session_id'])},
                section={$this->db->escape($_POST['section'])},
                attendance_type={$this->db->escape($_POST['attendance_type'])},
                taken_by={$this->db->escape($_POST['taken_by'])},
                user_id={$this->db->escape($user_id)}
                ";
        return $this->db->query($sql);
    }

    function update_print_attendance() {
        $print_attendance_id = $this->session->userdata('print_attendance_id');
        $sql = "update print_attendance set
		date={$this->db->escape($_POST['date'])},
                class_id={$this->db->escape($_POST['class_id'])},
                module_id={$this->db->escape($_POST['module_id'])},
                session_id={$this->db->escape($_POST['session_id'])},
                section={$this->db->escape($_POST['section'])},
                attendance_type={$this->db->escape($_POST['attendance_type'])},
                taken_by={$this->db->escape($_POST['taken_by'])}
		where print_attendance_id=$print_attendance_id
                ";
        return $this->db->query($sql);
    }

    function get_print_attendance($limit='') {
        $sql = $this->db->query("select pa.*,m.module_name,p.class_name,sm.session_name from print_attendance as pa
                                    join module as m on m.module_id=pa.module_id
                                    join class as p on p.class_id=pa.class_id
                                    join session as sm on sm.session_id=pa.session_id
                                where 1 order by date $limit");
        return $sql->result_array();
    }

    function get_print_attd_details($print_attendance_id) {
        $sql = $this->db->query("select pa.*,m.module_name,p.class_name,sm.session_name from print_attendance as pa
                                    join module as m on m.module_id=pa.module_id
                                    join class as p on p.class_id=pa.class_id
                                    join session as sm on sm.session_id=pa.session_id
                                    where print_attendance_id=$print_attendance_id");
        return $sql->row_array();
    }

}
?>