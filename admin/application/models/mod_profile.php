<?php

class mod_profile extends Model {

    function __construct() {
        parent::Model();
    }

    function get_student_info($user_name='') {
        if ($user_name == '') {
            $user_name = $this->session->userdata('user_name');
        }
        $sql = $this->db->query("select s.* from student as s where s.user_name='$user_name' and s.is_delete=0");
        return $sql->row_array();
    }

    function update_std_profile() {
        $student_id = $this->session->userdata('logged_student_id');
        $sql = "update student set
        present_address={$this->db->escape($_POST['present_address'])},
        permanent_address={$this->db->escape($_POST['permanent_address'])},
        phone={$this->db->escape($_POST['phone'])},
        mobile={$this->db->escape($_POST['mobile'])},
        email={$this->db->escape($_POST['email'])}
        where student_id=$student_id";
        return $this->db->query($sql);
    }

    function get_student_details($user_name='') {
        $sql = $this->db->query("select s.* from student as s where s.user_name='$user_name' and s.is_delete=0");
        return $sql->row_array();
    }

    function get_student_row($student_id='') {
        $sql = $this->db->query("select s.* from student as s where s.student_id='$student_id' and s.is_delete=0");
        return $sql->row_array();
    }

    function get_staffs_modules($staffs_id='') {
        $sql = $this->db->query("select c.class_code,c.class_name,m.module_code,m.module_name,md.* from module_distribution as md
                               join module as m on m.module_id=md.module_id
                               join class as c on c.class_id=md.class_id
                               where md.staffs_id=$staffs_id");
        return $sql->result_array();
    }

}
?>