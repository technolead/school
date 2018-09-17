<?php

/**
 * Description of common_helper
 *
 * @author anwar
 */
class common {

    public static function redirect() {
        $CI = & get_instance();
        $uri = $CI->session->userdata('cur_uri');
        redirect($uri);
    }

    public static function track_uri() {
        $CI = & get_instance();
        $uri = $CI->uri->uri_string();
        $CI->session->set_userdata('cur_uri', $uri);
    }

    public static function is_logged_in() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_admin() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_name') == 'admin') {
            return true;
        } else {
            common::redirect();
        }
    }

    public static function is_admin_logged() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_name') == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_admin_user() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_type') == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_student_user() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_type') == 'student') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_staff_user() {
        $CI = & get_instance();
        if ($CI->session->userdata('logged_in') && $CI->session->userdata('user_type') == 'staffs') {
            return true;
        } else {
            return false;
        }
    }

    public static function is_logged() {
        $CI = & get_instance();
        if (!$CI->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public static function nav_menu_link($nav_array) {
        $link = "<div class='nav_menu'>";
        if (is_array($nav_array)) {
            $link.="<a href='" . site_url('home') . "'>Home</a> &raquo; ";
            foreach ($nav_array as $nav) {
                if ($nav[url] != '') {
                    $link.="<a href='" . $nav[url] . "'>$nav[title]</a> &raquo; ";
                } else {
                    $link.="<span class='b'>$nav[title]</span>";
                }
            }
        }
        $link.="</div>";
        return $link;
    }

    public static function generate_user_name($first_name='', $last_name='') {
        $CI = & get_instance();
        $data = $CI->db->query("select max(user_id) as num from user");
        $max_user = $data->row_array();
        $num = $max_user['num'] + 1;
        $first = substr($first_name, 0, 1);
        $last = substr($last_name, 0, 1);
        $gen_user_id = $first . $last . date('Hi') . $num;
        return strtoupper($gen_user_id);
    }

    public static function save_as_user($user_name='', $user_type='admin', $first_name='', $last_name='', $email='') {
        if ($user_name != '') {
            $CI = & get_instance();
            $password = md5($user_name);
            $sql = "insert into user set first_name='$first_name', last_name='$last_name',user_name='$user_name', password='$password',email='$email', user_type='$user_type'";
            return $CI->db->query($sql);
        }
    }

    public static function status($status='') {
        if ($status == 'enabled') {
            return 'Disabled';
        } else {
            return 'Enabled';
        }
    }

    public static function change_status($table, $con, $status) {
        $CI = & get_instance();
        if ($status == 'enabled') {
            $sta = 'disabled';
        } else {
            $sta = 'enabled';
        }
        if (is_numeric($status)) {
            $sta = $status;
        }
        $sql = "update $table set status='$sta' where $con";
        return $CI->db->query($sql);
    }

    public static function get_settings_data() {
        $data = null;
        $rows = sql::rows('settings');
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $data[$row['key_flag']] = $row['key_value'];
            }
        }
        return $data;
    }

    public static function get_settings_data_with_flag($key_flag) {

        $row = sql::row('settings', "key_flag='$key_flag'");
        return $row['key_value'];
    }

    public static function user_permit($action='view', $option='user', $user_id='') {
        $CI = & get_instance();
        if ($user_id == '') {
            $user_id = $CI->session->userdata('user_id');
            if ($CI->session->userdata('user_name') == 'admin') {
                return TRUE;
            }
        }

        $sql = $CI->db->query("select $option from permission where user_id=$user_id");
        $per = $sql->row_array();
        $permit = $per[$option];
        if ($permit == 0) {
            return false;
        }
        if ($action == 'view') {
            if ($permit == 1 || $permit == 3 || $permit == 5 || $permit == 7) {
                return true;
            } else {
                return false;
            }
        }
        if ($action == 'add') {
            if ($permit == 2 || $permit == 3 || $permit == 6 || $permit == 7) {
                return true;
            } else {
                return false;
            }
        }
        if ($action == 'delete') {
            if ($permit == 4 || $permit == 5 || $permit == 6 || $permit == 7) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function sending_mail($from, $from_name, $to, $subject, $msg) {
        $CI = & get_instance();
        $CI->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $CI->email->initialize($config);

        $CI->email->from($from, $from_name);
        $CI->email->to($to);
        //$CI->email->cc('another@another-example.com');
        $CI->email->subject($subject);
        $CI->email->message($msg);
        $CI->email->send();

        //echo $CI->email->print_debugger();
    }

    public static function is_leave_student($student_id, $date) {
        if (sql::count('exemption', "'$date' BETWEEN from_date AND to_date and student_id=$student_id") > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function student_details() {
        $CI = & get_instance();
        $student_id = $CI->session->userdata('sel_student_id');
        if ($student_id == '') {
            common::redirect();
        }
        $data = sql::row('student', "student_id='$student_id'", 'student_id,user_name,first_name,last_name,admission_date,present_address,email,mobile,student_status');
        return $data;
    }

    public static function get_student_info($student_id='') {
        $CI = & get_instance();
        $sql = $CI->db->query("select s.student_id,s.user_name,s.title,s.first_name,s.last_name,s.date_of_birth,
                                s.admission_date,s.present_address,s.email,s.permanent_address,
                                s.mobile,s.nationality,s.phone,
                                cr.class_start_date,cr.class_end_date,c.class_code,c.class_name,
                                cm.class_duration,cm.class_fee
                                from student as s
                                join reg_class as cr on cr.student_id=s.student_id
                                join class as c on c.class_id=cr.class_id
                                join class_map as cm on cm.class_id=c.class_id                                
                                where s.student_id=$student_id");
        return $sql->row_array();
    }

    public static function issued_letters_data($issued_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select l.des,l.letter_title,sl.*,concat(u.first_name,' ',u.last_name) as issued_by from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join user as u on u.user_id=sl.user_id
                                where sl.student_letters_id=$issued_id");
        $letter = $sql->row_array();
        $data = common::get_student_info($letter['student_id']);
        $data['letter'] = $letter;
        //print_r($data);
        $msg = $CI->load->view('letters/read_letter', $data, TRUE);
        return $msg;
    }

    public static function get_attd_status_view($val=0) {
        $attd = common::get_settings_data();
        if ($val >= $attd['con_start_1'] && $val <= $attd['con_end_1']) {
            return 'first_color';
        } else if ($val >= $attd['con_start_2'] && $val <= $attd['con_end_3']) {
            return 'second_color';
        } else if ($val >= $attd['con_start_3']) {
            return 'fourth_color';
        }
    }

    public static function get_color_code($val='') {
        $attd = common::get_settings_data();
        if ($val >= $attd['per_start_1'] && $val <= $attd['per_end_1']) {
            return 'first_color';
        } else if ($val >= $attd['per_start_2'] && $val < $attd['per_end_2']) {
            return 'second_color';
        } else if ($val >= $attd['per_start_3'] && $val <= $attd['per_end_3']) {
            return 'fourth_color';
        }
    }

    public static function getVar($var, $default='') {
        if (isset($_REQUEST[$var]) && !empty($_REQUEST[$var]))
            return $_REQUEST[$var];
        elseif (!empty($default)) {
            return $default;
        }
        else
            return "";
    }

    public static function get_institution_type($sel='') {
        $option = "";
        $rows = sql::rows("institution_type");
        foreach ($rows as $row) {
            if ($sel != '' && $sel == $row['institution_type_id']) {
                $option.="<option value='" . $row['institution_type_id'] . "' selected>" . $row['institution_type'] . "</option>";
            } else {
                $option.="<option value='" . $row['institution_type_id'] . "'>" . $row['institution_type'] . "</option>";
            }
        }

        return $option;
    }

    public static function get_months() {
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


        return $months;
    }

    public static function get_student_registered_class($student_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select rc.student_id,rc.section,rc.privilege,
                               cm.*,c.class_name,s.session_name
                               from reg_class as rc join class_map as cm on rc.class_map_id=cm.class_map_id                               
                               join class as c on c.class_id=cm.class_id
                               join session as s on s.session_id=cm.session_id
                               where rc.student_id=$student_id");
        return $sql->row_array();
    }

    public static function get_class_map_id($session_id, $class_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select class_map_id from class_map where session_id=$session_id and class_id=$class_id");
        $id = $sql->row_array();
        if ($id['class_map_id'] != '')
            return $id['class_map_id'];
        else
            return 0;
    }

    public static function get_class_map_id_cond($cond) {
        /* if($cond=="")
          $cond="and 0"; */
        $CI = & get_instance();
        $sql = $CI->db->query("select class_map_id from class_map where 1 $cond");
        //debug::writeLog($this->db->last_query());
        $id = $sql->result_array();

        if (count($id) == 0) {
            $class_map_id = "0";
        } else {
            $inc = 0;
            foreach ($id as $row) {
                $class_map_id.=$row['class_map_id'];
                $inc++;
                if (count($id) > 1 && $inc < count($id)) {
                    $class_map_id.=",";
                }
            }
        }
        return $class_map_id;
    }

    public static function get_exam_details($exam_id) {
        $CI = & get_instance();
    }

    public static function get_class_reg_student($class_map_id, $section='') {

        $CI = & get_instance();
        $branch_id = $CI->session->userdata('branch_id');
        $con = '';
        if ($section != '') {
            $con.="and rc.section='$section'";
        }
        if ($branch_id != '') {
            $con.=" and s.branch_id='{$branch_id}'";
        }

        $action = $this->session->userdata("student_action");
        if ($action == 'record') {
            $action_con = " and s.is_delete=0";
        } else {
            $action_con = "";
        }

        $sql = $CI->db->query("select distinct(s.student_id),s.user_name,s.is_delete,concat(s.first_name, ' ',s.last_name) as student_name,rc.class_map_id
                             from student as s join reg_class as rc on s.student_id=rc.student_id
                             where rc.class_map_id=$class_map_id $con $action_con");
        //echo $CI->db->last_query();exit();
        return $sql->result_array();
    }

    public static function get_month_options($sel='') {
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $opt.="<option value=''>Select Month</option>";
        foreach ($months as $month): {
                if ($month == $sel) {
                    $opt.="<option value='$month' selected='selected'>$month</option>";
                } else {
                    $opt.="<option value='$month'>$month</option>";
                }
            }endforeach;

        return $opt;
    }

    public static function get_class_details($class_map_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select cm.class_map_id,s.session_name,c.class_name
                             from class_map as cm                             
                             join session as s on s.session_id=cm.session_id
                             join class as c on c.class_id=cm.class_id
                             where cm.class_map_id=$class_map_id");
        return $sql->row_array();
    }

    public static function get_std_class_fee($student_id, $class_fee_register_id, $month) {
        $CI = & get_instance();
        $sql = $CI->db->query("select cf.*,rcf.class_fee_register_id,rcf.month,rcf.monthly_fee,rcf.register_date
                             from std_class_fee as cf
                             join class_fee_register as rcf
                             on rcf.class_fee_register_id=cf.class_fee_register_id
                             and cf.student_id=$student_id and rcf.class_fee_register_id=$class_fee_register_id
                             and rcf.month='$month'");
        return $sql->row_array();
    }

    public static function get_class_payment_info($student_id, $class_fee_register_id) {
        $payment = sql::row("std_class_fee", "student_id=$student_id and class_fee_register_id=$class_fee_register_id");
        return $payment;
    }

    public static function get_admission_payment_info($student_id, $admission_fee_register_id) {
        $payment = sql::row("std_admission_fee", "student_id=$student_id and admission_fee_register_id=$admission_fee_register_id");
        return $payment;
    }

    public static function get_additional_payment_info($student_id, $additional_fee_register_id) {
        $payment = sql::row("std_additional_fee", "student_id=$student_id and additional_fee_register_id=$additional_fee_register_id");
        return $payment;
    }

    public static function get_exam_payment_info($student_id, $exam_fee_register_id) {
        $payment = sql::row("std_exam_fee", "student_id=$student_id and exam_fee_register_id=$exam_fee_register_id");
        return $payment;
    }

    public static function get_exam_fee_row($student_id, $exam_id, $exam_fee_register_id) {
        $CI = & get_instance();
        $sql = $CI->db->query("select ef.*,efr.exam_id,efr.exam_fee_register_id,efr.register_date
                             from std_exam_fee as ef join exam_fee_register as efr
                             where ef.exam_fee_register_id=efr.exam_fee_register_id
                             and ef.student_id=$student_id and efr.exam_fee_register_id=$exam_fee_register_id
                             and efr.exam_id=$exam_id");
        return $sql->row_array();
    }

    public static function get_branch_options($sel='') {

        $opt = "<option value=''>Select Branch</option>";
        $branch = sql::rows("branch");
        foreach ($branch as $row):
            if ($row['branch_id'] == $sel) {
                $opt.= "<option value='$row[branch_id]' selected>$row[branch_name]</option>";
            } else {
                $opt.= "<option value='$row[branch_id]'>$row[branch_name]</option>";
            }
        endforeach;

        return $opt;
    }

    public static function get_branch_name($branch_id) {
        if ($branch_id == '' || !is_numeric($branch_id)) {
            redirect();
        }
        $branch = sql::row("branch", "branch_id=$branch_id");
        return $branch['branch_name'];
    }

    public static function student_is_delete($student_id) {
        $data = sql::row("student", "student_id=$student_id");
        if ($data['is_delete'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_privilege_options($sel='') {
        $arr = array("0" => "None", "1" => "Full Free", "2" => "Half Free");
        $opt = "<option value=''>-- Select Privilege --</option>";

        foreach ($arr as $key => $val) {
            if ($sel == $key) {
                $opt.="<option value='$key' selected>$val</option>";
            } else {
                $opt.="<option value='$key' >$val</option>";
            }
        }

        return $opt;
    }

    public static function get_privilege_name($sel='') {


        $arr = array("0" => "None", "1" => "Full Free", "2" => "Half Free");
        $privilege = "";
        foreach ($arr as $key => $val) {
            if ($sel == $key) {
                $privilege = $val;
                return $privilege;
            }
        }
        return $privilege;
    }

    public static function get_tutorial_marks($student_id, $exam_id, $module_id) {

        $CI = & get_instance();
        $sql = $CI->db->query("select * from tutorial_result
                             where student_id=$student_id and exam_id=$exam_id and module_id=$module_id
                             group by exam_id,description");
        $rows = $sql->result_array();
        if (count($rows) == 0) {
            return "";
        }
        $total_marks = 0;
        $obtained_marks = 0;
        foreach ($rows as $row) {
            $total_marks+=$row['total_marks'];
            $obtained_marks+=$row['obtained_marks'];
        }

        $percentage = ($obtained_marks * 100) / $total_marks;
        $tutorial_per = common::get_settings_data_with_flag("tutorial");
        $final_per = round(($percentage * $tutorial_per) / 100);

        return $final_per;
    }

    public static function get_final_marks($module_id, $marks, $attendance, $tutorial) {

        $row = sql::row("module", "module_id=$module_id");
        $attd = explode("%", $attendance);

        $mark_per = common::get_settings_data_with_flag("final_exam");
        $final_mark = (($marks * $mark_per) / $row['marks']) + $attd[0] + $tutorial;
        return round($final_mark);
    }

    public static function get_grade_point($mark) {
        $CI = & get_instance();
        $sql = $CI->db->query("select * from grade_settings
                                where $mark>=marks_from && $mark<=marks_to");

        //debug::writeLog($this->db->last_query());

        return $sql->row_array();
    }

    public static function get_curriculum_point($report_status_mark_id) {
        $row = sql::row("report_status_mark", "report_status_mark_id=$report_status_mark_id");
        $grade = common::get_grade_point($row['mark']);
        $curriculum_point = $grade['grade_point'];
        return $curriculum_point;
    }

    public static function get_grade_from_point($final_grade_point) {

        $CI = & get_instance();
        $sql = $CI->db->query("SELECT * FROM `grade_settings` WHERE 1 ORDER BY grade_point ASC");
        $rows = $sql->result_array();

        for ($i = 0; $i < count($rows); $i++) {

            $prev = $rows[$i]['grade_point'];
            $new = $rows[$i + 1]['grade_point'];

            //debug::writeLog($prev." ".$new);
            if ($final_grade_point >= $prev && $final_grade_point < $new) {
                $grade = $rows[$i]['grade'];
                return $grade;
            }
        }
    }

    public static function get_report_status($report_status_mark_id) {
        $row = sql::row("report_status_mark", "report_status_mark_id=$report_status_mark_id");
        return $row['report_status'];
    }

}
?>