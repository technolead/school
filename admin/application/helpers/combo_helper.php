<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of combo_helper
 *
 * @author Anwar
 */
class combo {

    public static function get_awarding_body_options($sel='') {
        $CI = & get_instance();
        $sql = $CI->db->query("select * from awarding_body where status='enabled' order by awarding_body_name");
        $rows = $sql->result_array();
        $opt.="<option value=''>Select Awarding Body</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($row['awarding_body_id'] == $sel) {
                    $opt.="<option value='$row[awarding_body_id]' selected='selected'>$row[awarding_body_name]</option>";
                } else {
                    $opt.="<option value='$row[awarding_body_id]'>$row[awarding_body_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_specialization_options($sel='') {
        $CI = & get_instance();
        $sql = $CI->db->query("select * from specialization where status='enabled' order by specialization_name");
        $rows = $sql->result_array();
        $opt.="<option value=''>Select Specialization</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($row['specialization_id'] == $sel) {
                    $opt.="<option value='$row[specialization_id]' selected='selected'>$row[specialization_name]</option>";
                } else {
                    $opt.="<option value='$row[specialization_id]'>$row[specialization_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_class_options($sel='') {
        $CI = & get_instance();
        $sql = $CI->db->query("select class_name,class_id from class where status='enabled' order by class_name");
        $class = $sql->result_array();
        $opt.="<option value=''>Select Class</option>";
        if (count($class) > 0) {
            foreach ($class as $row) {
                if ($row['class_id'] == $sel) {
                    $opt.="<option value='$row[class_id]' selected='selected'>$row[class_name]</option>";
                } else {
                    $opt.="<option value='$row[class_id]'>$row[class_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_class_optional_module_id($class_id, $sel='') {
        $sql = $this->db->query("select m.module_name,mm.module_id from module as m,module_map as mm
                                           where mm.module_id=m.module_id and m.is_compulsary=0 and mm.class_id=$class_id");
        $optional_module = $sql->result_array();
        $opt.="<option value=''>Select Optional Module</option>";
        if (count($optional_module) > 0) {
            foreach ($optional_module as $row) {
                if ($row['module_id'] == $sel) {
                    $opt.="<option value='$row[module_id]' selected='selected'>$row[module_name]</option>";
                } else {
                    $opt.="<option value='$row[module_id]'>$row[module_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_student_optional_module_id($student_id) {

        $sql = $this->db->query("select m.module_id,rm.student_id
                                 from module as m,reg_module as rm
                                 where rm.module_id=m.module_id and m.is_compulsary=0 and rm.student_id=$student_id and rm.is_delete=0");
        $optional_module = $sql->row_array();

        return $optional_module['module_id'];
    }

    public static function get_class_module_id($class_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select module_id from module_map where class_id=$class_id and is_compulsary=1");
        return $sql->result_array();
    }

    public static function is_compulsary_module($module_id) {
        $is_optional = sql::row("module", "is_compulsary=0 and module_id=$module_id");
        if (count($is_optional) > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function get_awarding_body_class($awarding_body_id='', $sel='') {
        $CI = & get_instance();
        $opt.="<option value=''>----Select Class----</option>";
        if ($awarding_body_id == '') {
            return $opt;
        } else {
            $sql = $CI->db->query("select class_name,cm.class_id from class_map as cm
				join class as c on c.class_id=cm.class_id where cm.awarding_body_id=$awarding_body_id order by class_name");
            $class = $sql->result_array();
            if (count($class) > 0) {
                foreach ($class as $row) {
                    if ($row['class_id'] == $sel) {
                        $opt.="<option value='$row[class_id]' selected='selected'>$row[class_name]</option>";
                    } else {
                        $opt.="<option value='$row[class_id]'>$row[class_name]</option>";
                    }
                }
            }
            return $opt;
        }
    }

    public static function get_awarding_body_session($awarding_body_id='', $sel='') {
        $CI = & get_instance();
        $opt.="<option value=''>----Select Session----</option>";
        if ($awarding_body_id == '') {
            return $opt;
        } else {
            $sql = $CI->db->query("select distinct session_name,cm.session_id from class_map as cm
				join session as s on s.session_id=cm.session_id where cm.awarding_body_id=$awarding_body_id order by session_name");

            $session = $sql->result_array();
            if (count($session) > 0) {
                foreach ($session as $row) {
                    if ($row['session_id'] == $sel) {
                        $opt.="<option value='$row[session_id]' selected='selected'>$row[session_name]</option>";
                    } else {
                        $opt.="<option value='$row[session_id]'>$row[session_name]</option>";
                    }
                }
            }
            return $opt;
        }
    }

    public static function get_modules_options($sel='') {
        $modules = sql::rows('module', "status='enabled'  order by module_name");
        if (count($modules) > 0) {
            foreach ($modules as $row) {
                if (is_array($sel)) {
                    if (in_array($row['module_id'], $sel)) {
                        $opt.="<option value='$row[module_id]' selected='selected'>$row[module_name]</option>";
                    } else {
                        $opt.="<option value='$row[module_id]'>$row[module_name]</option>";
                    }
                } else {
                    if ($row['module_id'] == $sel) {
                        $opt.="<option value='$row[module_id]' selected='selected'>$row[module_name]</option>";
                    } else {
                        $opt.="<option value='$row[module_id]'>$row[module_name]</option>";
                    }
                }
            }
        }
        return $opt;
    }

    public static function get_exam_options($sel='') {
        $exams = sql::rows('exam');

        if (count($exams) > 0) {
            foreach ($exams as $row) {
                if (is_array($sel)) {
                    if (in_array($row['exam_id'], $sel)) {
                        $opt.="<option value='$row[exam_id]' selected='selected'>$row[exam_name]</option>";
                    } else {
                        $opt.="<option value='$row[exam_id]'>$row[exam_name]</option>";
                    }
                } else {
                    if ($row['exam_id'] == $sel) {
                        $opt.="<option value='$row[exam_id]' selected='selected'>$row[exam_name]</option>";
                    } else {
                        $opt.="<option value='$row[exam_id]'>$row[exam_name]</option>";
                    }
                }
            }
        }

        return $opt;
    }

    public static function get_session_options($sel='') {
        $rows = sql::rows('session', "status='enabled' order by session_name");
        $opt.="<option value=''>-- Select Session --</option>";
        foreach ($rows as $row) {
            if ($row['session_id'] == $sel) {
                $opt.="<option value='$row[session_id]' selected='selected'>$row[session_name]</option>";
            } else {
                $opt.="<option value='$row[session_id]'>$row[session_name]</option>";
            }
        }
        return $opt;
    }

    public static function get_gender_options($sel='') {
        $status = array('Male', 'Female');
        $opt.="<option value=''>----Select----</option>";
        foreach ($status as $row) {
            if ($row == $sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            } else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }

    public static function get_country_list($sel='', $column='nationality') {
        $rows = sql::rows('country', "status='enabled' order by country_name");
        $opt.="<option value=''>----Select----</option>";
        foreach ($rows as $row) {
            if ($row[$column] == $sel) {
                $opt.="<option value='$row[$column]' selected='selected'>$row[$column]</option>";
            } else {
                $opt.="<option value='$row[$column]'>$row[$column]</option>";
            }
        }
        return $opt;
    }

    public static function get_pay_details_options($pay_details_for='', $sel='') {
        $rows = sql::rows('payment_details', "pay_details_for='$pay_details_for'");
        $opt = "<option value=''>-----Select----</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($sel == $row['pay_details_id']) {
                    $opt.="<option value='$row[pay_details_id]' selected='selected'>$row[details_name]</option>";
                } else {
                    $opt.="<option value='$row[pay_details_id]'>$row[details_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_type_options($type_for='', $sel='', $need_id=FALSE) {
        $rows = sql::rows('conf_type', "type_for='$type_for'");
        $opt = "<option value=''>-----Select----</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($need_id) {
                    if ($sel == $row['type_id']) {
                        $opt.="<option value='$row[type_id]' selected='selected'>$row[type_name]</option>";
                    } else {
                        $opt.="<option value='$row[type_id]'>$row[type_name]</option>";
                    }
                } else {
                    if ($sel == $row['type_name']) {
                        $opt.="<option value='$row[type_name]' selected='selected'>$row[type_name]</option>";
                    } else {
                        $opt.="<option value='$row[type_name]'>$row[type_name]</option>";
                    }
                }
            }
        }
        return $opt;
    }

    public static function get_status_options($status_for='', $sel='', $need_id=FALSE) {
        $rows = sql::rows('conf_status', "status_for='$status_for'");
        $opt = "<option value=''>-----Select----</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($need_id) {
                    if ($sel == $row['status_id']) {
                        $opt.="<option value='$row[status_id]' selected='selected'>$row[status_name]</option>";
                    } else {
                        $opt.="<option value='$row[status_id]'>$row[status_name]</option>";
                    }
                } else {
                    if ($sel == $row['status_name']) {
                        $opt.="<option value='$row[status_name]' selected='selected'>$row[status_name]</option>";
                    } else {
                        $opt.="<option value='$row[status_name]'>$row[status_name]</option>";
                    }
                }
            }
        }
        return $opt;
    }

    public static function get_report_status_options($sel='') {
        $rows = sql::rows('report_status_mark');
        $opt = "<option value=''>-----Select----</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {

                if ($sel == $row['report_status_mark_id']) {
                    $opt.="<option value='$row[report_status_mark_id]' selected='selected'>$row[report_status]</option>";
                } else {
                    $opt.="<option value='$row[report_status_mark_id]'>$row[report_status]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_student_status($sel='') {
        $arr = array('Active', 'Inactive', 'Transferred');
        $opt = "<option value=''>-- Select --</option>";
        foreach ($arr as $val):
            if ($sel == $val) {
                $opt.="<option value='$val' selected>$val</option>";
            } else {
                $opt.="<option value='$val'>$val</option>";
            }
        endforeach;
        return $opt;
    }

    public static function get_class_module_status_options($sel='') {

        $status = array("1" => "Continue", "2" => "Complete", "3" => "Terminated");

        $opt = "<option value=''>-- Select --</option>";
        foreach ($status as $key => $val):

            if ($key == $sel) {
                $opt.= "<option value='$key' selected>$val</option>";
            } else {
                $opt.= "<option value='$key'>$val</option>";
            }
        endforeach;
        return $opt;
    }

    public static function get_class_module_status($sel='') {

        $status = array("1" => "Continue", "2" => "Complete", "3" => "Terminated");

        foreach ($status as $key => $val):
            if ($key == $sel) {
                return $val;
            }
        endforeach;
        return;
    }

    public static function get_marital_status($sel='') {
        $status = array('Single', 'Divorsed', 'Married', 'Widowed');
        $opt.="<option value=''>----Select----</option>";
        foreach ($status as $row) {
            if ($row == $sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            } else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }

    public static function get_day_options($sel='') {
        $rows = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $opt.="<option value=''>----Select----</option>";
        foreach ($rows as $row) {
            if ($row == $sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            } else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }

    public static function registered_class_options($student_id='', $sel='') {
        $CI = & get_instance();
        if ($student_id != '') {
            $sql = $CI->db->query("select c.class_name,c.class_id  from reg_class as rc
				join class as c on c.class_id=rc.class_id where rc.student_id=$student_id order by c.class_name");
            $class = $sql->result_array();
        }
        $opt.="<option value=''>Select Class</option>";
        if (count($class) > 0) {
            foreach ($class as $row) {
                if ($row['class_id'] == $sel) {
                    $opt.="<option value='$row[class_id]' selected='selected'>$row[class_name]</option>";
                } else {
                    $opt.="<option value='$row[class_id]'>$row[class_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_session_class($session_id='', $sel='') {
        $CI = & get_instance();

        $opt.="<option value=''>----Select Class----</option>";
        if ($session_id == '') {
            return $opt;
        } else {
            $sql = $CI->db->query("select class_name,cm.class_id from class_map as cm
				join class as c on c.class_id=cm.class_id
                                where cm.session_id=$session_id order by class_name");
            $class = $sql->result_array();
            if (count($class) > 0) {
                foreach ($class as $row) {
                    if ($row['class_id'] == $sel) {
                        $opt.="<option value='$row[class_id]' selected='selected'>$row[class_name]</option>";
                    } else {
                        $opt.="<option value='$row[class_id]'>$row[class_name]</option>";
                    }
                }
            }
            return $opt;
        }
    }

    public static function get_staff_options($sel='') {
        $CI = & get_instance();

        $sql = $CI->db->query("select first_name,last_name,staffs_id from staffs where status='enabled'");
        $rows = $sql->result_array();
        $opt.="<option value=''>Select Tutor</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                if ($row['staffs_id'] == $sel) {
                    $opt.="<option value='$row[staffs_id]' selected='selected'>$row[first_name] $row[last_name]</option>";
                } else {
                    $opt.="<option value='$row[staffs_id]'>$row[first_name] $row[last_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_class_module($class_id='', $sel='') {
        $CI = & get_instance();
        $opt.="<option value=''>----Select Subject----</option>";
        if ($class_id == '') {
            return $opt;
        } else {
            $sql = $CI->db->query("select module_name,mm.module_id from module_map as mm
				join module as m on m.module_id=mm.module_id where mm.class_id=$class_id order by module_name");
            $levels = $sql->result_array();
            if (count($levels) > 0) {
                foreach ($levels as $row) {
                    if ($row['module_id'] == $sel) {
                        $opt.="<option value='$row[module_id]' selected='selected'>$row[module_name]</option>";
                    } else {
                        $opt.="<option value='$row[module_id]'>$row[module_name]</option>";
                    }
                }
            }
            return $opt;
        }
    }

    public static function get_letter_options($sel='', $is_all=false) {
        $CI = & get_instance();
        if ($is_all) {
            $con = '1=1';
        } else {
            $letter_type_id = ATTENDANCE_TYPE;
            $con = "letters_type_id!=$letter_type_id";
        }
        $sql = $CI->db->query("select letter_title,letters_id from letters where $con and status='enabled'");
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

    public static function registered_module_options($student_id='', $semester_id='', $sel='') {
        $CI = & get_instance();
        if (is_numeric($semester_id) && $semester_id != '') {
            $con = " and rm.semester_id=$semester_id";
        }
        if ($student_id != '') {
            $sql = $CI->db->query("select m.module_name,m.module_id  from reg_module as rm
							join module as m on m.module_id=rm.module_id where rm.student_id=$student_id $con order by module_name");
            $modules = $sql->result_array();
        }
        $opt.="<option value=''>Select Subject</option>";
        if (count($modules) > 0) {
            foreach ($modules as $row) {
                if ($row['module_id'] == $sel) {
                    $opt.="<option value='$row[module_id]' selected='selected'>$row[module_name]</option>";
                } else {
                    $opt.="<option value='$row[module_id]'>$row[module_name]</option>";
                }
            }
        }
        return $opt;
    }

    public static function get_reg_class_option($student_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select rc.* from
              reg_class as rc where rc.student_id=$student_id and rc.is_delete=0");
        return $sql->row_array();
    }

    public static function get_exam_for_class($session_id, $class_id, $sel='') {
        $CI = & get_instance();
        $opt.="<option value=''>-- Select Exam --</option>";
        if ($session_id == '' || $class_id == '') {
            return $opt;
        } else {
            $class_map_id = common::get_class_map_id($session_id, $class_id);
            $class = sql::row("class_map", "class_map_id=$class_map_id");
            $exams_id = $class['exam_id'];
            $exams_id = explode(",", $exams_id);
            if ($exams_id != '') {
                foreach ($exams_id as $exam_id) {
                    $exam = sql::row("exam", "exam_id=$exam_id");
                    if ($exam['exam_id'] == $sel) {
                        $opt.="<option value='$exam[exam_id]' selected='selected'>$exam[exam_name]</option>";
                    } else {
                        $opt.="<option value='$exam[exam_id]'>$exam[exam_name]</option>";
                    }
                }
            }
            return $opt;
        }
    }

    public static function get_designation_options($sel='') {
        $opt = "<option value=''>-- Select --</option>";
        $arr = sql::rows("staff_designation");
        foreach ($arr as $row):
            if ($sel == $row['staff_designation_id']) {
                $opt.="<option value='$row[staff_designation_id]' selected>$row[designation]</option>";
            } else {
                $opt.="<option value='$row[staff_designation_id]'>$row[designation]</option>";
            }
        endforeach;
        return $opt;
    }

    public static function get_mpo_amount($designation_id) {
        $row = sql::row("staff_designation", "staff_designation_id=$designation_id");
        return $row['mpo_scale'];
    }

    /* attendance upto selected date */

    public static function get_attendance_percentage($student_id) {

        $CI = & get_instance();
        $class_map_id = $CI->session->userdata('sel_class_map_id');
        $date = $CI->session->userdata('sel_exam_date');

        $sql = $CI->db->query("SELECT (sum( sa.attendance ) + sum( sa.leave_excuse )) AS present, sum( sa.leave_excuse ) AS total_leave,
                                (count( ca.class_attendance_id )-(sum( sa.attendance )+sum(sa.leave_excuse))) as absent,
                                count( ca.class_attendance_id ) AS total_class
                                FROM `std_attendance` AS sa
                                JOIN class_attendance AS ca ON ca.class_attendance_id = sa.class_attendance_id
                                WHERE sa.student_id=$student_id and ca.class_map_id=$class_map_id
                                and ca.date<='$date' group by sa.student_id,ca.class_map_id");

        //debug::writeLog($CI->db->last_query());
        return $sql->row_array();
    }

    public static function get_training_options($sel='') {
        $training = sql::rows('staff_training');

        if (count($training) > 0) {
            foreach ($training as $row) {
                if (is_array($sel)) {
                    if (in_array($row['training_id'], $sel)) {
                        $opt.="<option value='$row[training_id]' selected='selected'>$row[training_title]</option>";
                    } else {
                        $opt.="<option value='$row[training_id]'>$row[training_title]</option>";
                    }
                } else {
                    if ($row['training_id'] == $sel) {
                        $opt.="<option value='$row[training_id]' selected='selected'>$row[training_title]</option>";
                    } else {
                        $opt.="<option value='$row[training_id]'>$row[training_title]</option>";
                    }
                }
            }
        }

        return $opt;
    }

    public static function get_period_options($sel=''){
        $period=array(
            "1st"=>"1st",
            "2nd"=>"2nd",
            "3rd"=>"3rd",
            "4th"=>"4th",
            "5th"=>"5th",
            "6th"=>"6th",
            "7th"=>"7th",
            "8th"=>"8th"

            );
        $opt="<option value=''> Select Period </option>";

        foreach($period as $key=>$val){
            if($sel==$key){
                $opt.="<option value='$key' selected>$val</option>";
            }else{
                $opt.="<option value='$key'>$val</option>";
            }
        }

        return $opt;
    }

    public static function get_assigned_staff($module_id,$class_id,$sel=''){

        
        $CI=& get_instance();
        $sql=$CI->db->query("select md.staffs_id,concat(s.first_name,' ',s.last_name) as staff_name
                            from module_distribution as md
                            join staffs as s on md.staffs_id=s.staffs_id
                            where md.module_id=$module_id and md.class_id=$class_id");
        
        $res=$sql->result_array();

        $opt="<option value=''> Select Staff </option>";
        foreach($res as $res){
            if($sel==$res['staffs_id']){
                $opt.="<option value='$res[staffs_id]' selected> $res[staff_name] </option>";
            }else{
                $opt.="<option value='$res[staffs_id]'> $res[staff_name] </option>";
            }
        }

        return $opt;
    }


    public static function get_routine_details($class_routine_id,$day){

        $CI=& get_instance();
        $sql=$CI->db->query("select rd.*,
                               m.module_name,st.user_name
                               from routine_details as rd
                               join module as m on rd.module_id=m.module_id
                               join staffs st on rd.staffs_id=st.staffs_id
                               where rd.class_routine_id=$class_routine_id and rd.day='$day'
                               order by rd.day,rd.period asc");

        //debug::writeLog($CI->db->last_query());
        return $sql->result_array();
    }


}
?>