<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_result
 *
 * @author Anwar
 */
class mod_result extends Model {

    function __construct() {
        parent::Model();
    }

    function get_module_result($module_id='', $session_id='', $limit='') {
        $con = '1=1';
        if (is_numeric($module_id) && $module_id != 0) {
            $con = "mr.module_id=$module_id";
        }
        if (is_numeric($session_id) && $session_id != 0) {
            $con.=" and mr.session_id=$session_id";
        }
        $ins_con = ''; /* Why needed? */
        $institution_id = $this->session->userdata('institution_id');
        if ($institution_id != '' && is_numeric($institution_id)) {
            $ins_con.=" and s.institution_id=$institution_id";
        }

        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        $sql = $this->db->query("select mr.*,m.module_name,m.module_code,e.exam_name,
                                s.first_name,s.last_name,s.user_name from module_result as mr
                                join exam as e on mr.exam_id=e.exam_id
                                join student as s on s.student_id=mr.student_id
                                join module as m on m.module_id=mr.module_id
                                where $con $ins_con and s.is_delete=0 $limit");
        return $sql->result_array();
    }

    function get_grade_options($sel='') {
        $rows = array('A+', 'A', 'A-', 'B+', 'B', 'B-', 'C', 'D', 'E', 'F', 'N/A');
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

    function get_result_options($sel='') {
        $rows = array('Exempted', 'Passed', 'Failed', 'Resit', 'Retake', 'Deferred', 'Waived');
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

    function get_grade($mark) {
        $sql = $this->db->query("select grade from grade_settings
                                where $mark>=marks_from && $mark<=marks_to");

        return $sql->row_array();
    }

    function save_module_result() {
        $module_id = $this->session->userdata('sel_module_id');

        $class_map_id = $this->session->userdata('sel_class_map_id');
        $exam_id = $this->session->userdata('sel_exam_id');
        $exam_date = $this->session->userdata('sel_exam_date');
        $session_id = $this->session->userdata('sel_session_id');
        $user_id = $this->session->userdata('user_id');
        $inc = 0;
        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {

                $final_marks = common::get_final_marks($module_id, $_POST['mark'][$inc], $_POST['attendance'][$inc], $_POST['tutorial'][$inc]);
                $final_grade = common::get_grade_point($final_marks);

                $sql = "insert into module_result set
                       student_id=$student_id,
                       class_map_id=$class_map_id,
                       exam_id=$exam_id,
                       session_id=$session_id,
                       module_id=$module_id,
                       exam_date={$this->db->escape($exam_date)},
                       marks={$this->db->escape($_POST['mark'][$inc])},
                       grade={$this->db->escape($_POST['grade'][$inc])},
                       final_marks=$final_marks,
                       final_grade={$this->db->escape($final_grade['grade'])},
                       final_grade_point={$final_grade['grade_point']},
                       attendance={$this->db->escape($_POST['attendance'][$inc])},
                       tutorial={$this->db->escape($_POST['tutorial'][$inc])},
                       attempt={$this->db->escape($_POST['attempt'][$inc])},
                       notes={$this->db->escape($_POST['notes'][$inc])},
                       result_status={$this->db->escape($_POST['result_status'][$inc])},
					   user_id=$user_id";
                $this->db->query($sql);
                $sql_mod = "update reg_module set
                            module_status={$this->db->escape($_POST['module_status'][$inc])}
                            where student_id=$student_id and module_id=$module_id and session_id=$session_id";
                $this->db->query($sql_mod);
                $inc++;
            }
        }
    }

    function edit_module_result($module_result_id) {
        $sql = $this->db->query("select mr.*,m.module_name,m.module_code,rm.module_status,e.exam_name,
                                s.first_name,s.last_name,s.user_name,sm.session_name from module_result as mr
                                join exam as e on mr.exam_id=e.exam_id
                                join module as m on mr.module_id=m.module_id
                                join reg_module as rm on mr.module_id=rm.module_id
                                join student as s on mr.student_id=s.student_id
                                join session as sm on mr.session_id=sm.session_id                                
                                where mr.module_result_id=$module_result_id and
                                mr.student_id=rm.student_id and mr.module_id=rm.module_id and mr.session_id=rm.session_id");
        return $sql->row_array();
    }

    function update_module_result() {
        $module_result_id = $this->session->userdata('module_result_id');
        if ($module_result_id == '') {
            redirect('result');
        }
        $row = sql::row("module_result", "module_result_id=$module_result_id");
        $final_marks = common::get_final_marks($row['module_id'], $_POST['marks'], $row['attendance'], $row['tutorial']);
        $final_grade = common::get_grade_point($final_marks);


        $sql = "update module_result set
                       marks={$this->db->escape($_POST['marks'])},
                       grade={$this->db->escape($_POST['grade'])},
                       final_marks=$final_marks,
                       final_grade={$this->db->escape($final_grade['grade'])},
                       final_grade_point={$final_grade['grade_point']},
                       attempt={$this->db->escape($_POST['attempt'])},
                       notes={$this->db->escape($_POST['notes'])},
                       result_status={$this->db->escape($_POST['result_status'])}
                       where module_result_id=$module_result_id";
        return $this->db->query($sql);
    }

    function get_std_modules_result($student_id) {
        $sql = $this->db->query("select distinct(m.module_id),mr.*,
                                m.module_code,m.module_name,e.exam_name
                                from module_result as mr
                                join module as m on m.module_id=mr.module_id
                                join exam as e on mr.exam_id=e.exam_id
                                join module_map as mm on mm.module_id=mr.module_id
                                where mr.student_id=$student_id");
        return $sql->result_array();
    }

    function save_tutorial_result() {
        $module_id = $this->session->userdata('tut_module_id');
        $class_map_id = $this->session->userdata('tut_class_map_id');
        $exam_id = $this->session->userdata('tut_exam_id');
        $tutorial_date = $this->session->userdata('tut_tutorial_date');
        $description = $this->session->userdata('tut_description');
        $total_marks = $this->session->userdata('tut_total_marks');
        $user_id = $this->session->userdata('user_id');
        $inc = 0;

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {

                $data = array(
                    "student_id" => $student_id,
                    "class_map_id" => $class_map_id,
                    "exam_id" => $exam_id,
                    "module_id" => $module_id,
                    "description" => $description,
                    "tutorial_date" => $tutorial_date,
                    "total_marks" => $total_marks,
                    "obtained_marks" => $_POST['obtained_marks'][$inc],
                    "user_id" => $user_id
                );

                $this->db->insert("tutorial_result", $data);

                $inc++;
            }
        }
    }

    function get_tutorial_result($module_id='', $exam_id='', $limit='') {
        $con = '1=1';
        if (is_numeric($module_id) && $module_id != 0) {
            $con = "tr.module_id=$module_id";
        }
        if (is_numeric($exam_id) && $exam_id != 0) {
            $con.=" and tr.exam_id=$exam_id";
        }


        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.=" and s.branch_id=$branch_id";
        }

        $sql = $this->db->query("select tr.*,m.module_name,m.module_code,e.exam_name,
                                s.first_name,s.last_name,s.user_name from tutorial_result as tr
                                join exam as e on tr.exam_id=e.exam_id
                                join student as s on s.student_id=tr.student_id
                                join module as m on m.module_id=tr.module_id
                                where $con  and s.is_delete=0 $limit");
        return $sql->result_array();
    }

    function get_std_tutorial_result($student_id) {
        $sql = $this->db->query("select distinct(m.module_id),tr.*,
                                m.module_code,m.module_name,e.exam_name
                                from tutorial_result as tr
                                join module as m on m.module_id=tr.module_id
                                join exam as e on tr.exam_id=e.exam_id
                                join module_map as mm on mm.module_id=tr.module_id
                                where tr.student_id=$student_id");
        return $sql->result_array();
    }

    function edit_tutorial_result($tutorial_result_id) {
        $sql = $this->db->query("select tr.*,m.module_name,m.module_code,e.exam_name,
                                s.first_name,s.last_name,s.user_name from tutorial_result as tr
                                join exam as e on tr.exam_id=e.exam_id
                                join module as m on tr.module_id=m.module_id
                                join reg_module as rm on tr.module_id=rm.module_id
                                join student as s on tr.student_id=s.student_id
                                where tr.tutorial_result_id=$tutorial_result_id and
                                tr.student_id=rm.student_id and tr.module_id=rm.module_id");

        //debug::writeLog($this->db->last_query());
        return $sql->row_array();
    }

    function update_tutorial_result() {
        $tutorial_result_id = $this->session->userdata('tutorial_result_id');
        if ($tutorial_result_id == '') {
            redirect('result');
        }
        $sql = "update tutorial_result set
                       obtained_marks={$this->db->escape($_POST['obtained_marks'])}
                       where tutorial_result_id=$tutorial_result_id";
        return $this->db->query($sql);
    }

}
?>
