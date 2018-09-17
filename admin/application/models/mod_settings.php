<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_settings
 *
 * @author Anwar
 */
class mod_settings extends Model {

    function __construct() {
        parent::Model();
    }

    function update_settings($sel_opt=1) {
        if ($sel_opt == 1) {
            $key_list = array('con_start_1', 'con_start_2', 'con_start_3', 'con_end_1', 'con_end_2', 'con_end_3', 'per_start_1', 'per_start_2', 'per_start_3', 'per_end_1', 'per_end_2', 'per_end_3');
        } else if ($sel_opt == 2) {
            $key_list = array("admin_email", "notify_email", 'delete');
        } else if ($sel_opt == 3) {
            $key_list = array("contact_name", "contact_address", "contact_phone", "contact_mobile", "contact_email");
        } else if ($sel_opt == 4) {
            $key_list = array("site_title", "meta_keywords", "meta_description");
        }else if($sel_opt == 5){
            $key_list = array("tutorial", "attendance", "final_exam");
        }
        foreach ($key_list as $key) {
            $sql = "select * from settings where key_flag='$key'";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                $mega_sql = "update settings set key_value=" . $this->db->escape($_POST[$key]) . " where key_flag='$key';";
            } else {
                $mega_sql = "insert into settings set key_flag='$key',key_value=" . $this->db->escape($_POST[$key]) . ";";
            }
            if (!$this->db->query($mega_sql)) {
                return false;
            }
        }
        return true;
    }

    function get_settings_data() {
        $data = null;
        $rows = sql::rows('settings');
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $data[$row['key_flag']] = $row['key_value'];
            }
        }
        return $data;
    }

    function confirm_password() {
        $status = 'enabled';
        $password = md5($_POST['old_password']);
        $user_id = $this->session->userdata('user_id');
        $sql = "SELECT * FROM user WHERE user_id = ? AND password = ? and status= ?";
        $query = $this->db->query($sql, array($user_id, $password, $status));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function do_update_password() {
        $password = md5($_POST['new_password']);
        $user_id = $this->session->userdata('user_id');
        $sql = "update user
                set password={$this->db->escape($password)}
                where user_id=$user_id";
        return $this->db->query($sql);
    }

    function get_branchGrid() {
        $sortname = common::getVar('sidx', 'branch_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql = "select b.*,u.user_name,concat(u.last_name,' ',u.first_name) as inputed_by from branch as b
                                join user as u on u.user_id=b.user_id where 1=1 $sort";


        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('branch', '1=1');
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
            $responce->rows[$i]['id'] = $row['branch_id'];
            $responce->rows[$i]['cell'] = array($row['branch_name'], $row['inputed_by'], $status);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mahjabeen");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_branch_details($id) {
        $sql = $this->db->query("select * from branch where branch_id = $id");
        return $sql->row_array();
    }

    function save_branch() {
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into branch set
			branch_name={$this->db->escape($_POST['branch_name'])},
			user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }

    function update_branch() {
        $branch_id = $this->session->userdata('edit_branch_id');
        $sql = "update branch set branch_name={$this->db->escape($_POST['branch_name'])}
              where branch_id=$branch_id";
        return $this->db->query($sql);
    }

    function update_grade() {
        $inc = 0;
        sql::delete("grade_settings");
        foreach ($_POST['grade'] as $grade) {
            if ($grade != '') {
                $data = array(
                    "grade" => $_POST['grade'][$inc],
                    "grade_point"=>$_POST['grade_point'][$inc],
                    "marks_from" => $_POST['marks_from'][$inc],
                    "marks_to" => $_POST['marks_to'][$inc]
                );
                $this->db->insert("grade_settings", $data);
                $inc++;
            }
        }
        return true;
    }

}
?>
