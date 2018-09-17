<?php

/**
 * Description of mod_exemption
 *
 * @author anwar
 */
class mod_exemption extends Model {

    function __construct() {
        parent::Model();
    }

    function get_exemption() {
        $con = '1';
        $branch_id = $this->session->userdata('branch_id');
        if ($branch_id != '') {
            $con.="s.branch_id='{$branch_id}'";
        }
        $sql = $this->db->query("select s.user_name,s.first_name,s.last_name ,an.* from exemption as an
					join student as s on s.student_id=an.student_id where $con and s.is_delete=0");
        return $sql->result_array();
    }

    function get_search_exemption() {
        $branch_id = $this->session->userdata('branch_id');
        if ($_POST['user_name'] != '') {
            $con.=" and s.user_name like '%{$_POST['user_name']}%'";
        }
        if ($_POST['name'] != '') {
            $con.=" and s.last_name like '%{$_POST['name']}%'";
        }
        if ($_POST['from_date'] != '') {
            $con.=" and an.from_date >= '{$_POST['from_date']}' AND  an.to_date <= '{$_POST['to_date']}'";
        }
        if ($branch_id != '') {
            $con.=" and s.branch_id='{$branch_id}'";
        }
        $sql = $this->db->query("select s.user_name,s.first_name,s.last_name ,an.* from exemption as an
				join student as s on s.student_id=an.student_id
                                where 1 and s.is_delete=0 $con");
        return $sql->result_array();
    }

    function get_absent_details($exemption_id) {
        $sql = $this->db->query("select s.user_name,s.first_name,s.last_name ,an.* from exemption as an
                                        join student as s on s.student_id=an.student_id
                                        where exemption_id=$exemption_id and s.is_delete=0");
        return $sql->row_array();
    }

    function save_exemption() {
        $user_id = $this->session->userdata('user_id');
        $std_id = sql::row('student', "user_name='{$_POST['user_name']}'", 'student_id');
        $student_id = $std_id['student_id'];
        if (common::student_is_delete($student_id) == false) {
            $sql = "insert into exemption set
				student_id=$student_id,
				from_date={$this->db->escape($_POST['from_date'])},
				to_date={$this->db->escape($_POST['to_date'])},
				reason={$this->db->escape($_POST['reason'])},
				user_id=$user_id";
            return $this->db->query($sql);
        }
    }

    function update_exemption() {
        $exemption_id = $this->session->userdata('exemption_id');
        $std_id = sql::row('student', "user_name='{$_POST['user_name']}'", 'student_id');
        $student_id = $std_id['student_id'];
        if (common::student_is_delete($student_id) == false) {
            $sql = "update exemption set
				student_id=$student_id,
				from_date={$this->db->escape($_POST['from_date'])},
				to_date={$this->db->escape($_POST['to_date'])},
				reason={$this->db->escape($_POST['reason'])}
				where exemption_id=$exemption_id";
            return $this->db->query($sql);
        }
    }

}
?>