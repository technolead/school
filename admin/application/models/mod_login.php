<?php

/**
 * Description of mod_login
 *
 * @author anwar
 */
class mod_login extends Model {

    function mod_login() {
        parent::Model();
    }

    function is_valid_user() {
        $status = 'enabled';
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM user WHERE user_name = ? AND password = ? and status= ?";
        $query = $this->db->query($sql, array($_POST['user_name'], $password, $status));
        if ($query->num_rows() > 0) {
            $this->do_login($query->row_array());
            return true;
        } else {
            return false;
        }
    }

    function do_login($data) {
        if ($data['user_type'] == 'student') {
            $std = sql::row('student', "user_name='{$data['user_name']}' and status='enabled' and is_delete=0", 'student_id,branch_id');
            if ($std['student_id'] == '') {
                $this->session->set_flashdata('msg', 'Invalid User and Password');
                redirect('login');
            }

            //if selected branch is not the student's branch
            if ($std['branch_id'] != $_POST['branch_id']) {
                $this->session->set_flashdata('msg', 'You have no access in the selected branch!');
                redirect('login');
            }



            $this->session->set_userdata('logged_student_id', $std['student_id']);
            $this->session->set_userdata('sel_student_id', $std['student_id']);
            $this->session->set_userdata('branch_id', $std['branch_id']);
        } else if ($data['user_type'] == 'staffs') {
            $staff = sql::row('staffs', "user_name='{$data['user_name']}' and status='enabled'", 'staffs_id,branch_id');
            if ($staff['staffs_id'] == '') {
                $this->session->set_flashdata('msg', 'Invalid User and Password');
                redirect('login');
                exit;
            }

            //if selected branch is not the staff's branch
            if ($staff['branch_id'] != $_POST['branch_id']) {
                $this->session->set_flashdata('msg', 'You have no access in the selected branch!');
                redirect('login');
            }


            $this->session->set_userdata('logged_staffs_id', $staff['staffs_id']);
            $this->session->set_userdata('branch_id', $staff['branch_id']);
        } else if ($data['user_type'] == 'admin') {
            //$this->db->query("update user_log set is_recent=0 where user_id='{$data['user_id']}' and is_recent=1");
            $this->db->query("insert into user_log set user_id='{$data['user_id']}', login=NOW(),ip_address='{$_SERVER['REMOTE_ADDR']}'");
            $this->session->set_userdata('branch_id', $_POST['branch_id']);
        }

        $this->session->set_userdata('user_id', $data['user_id']);
        $this->session->set_userdata('user_name', $data['user_name']);
        $this->session->set_userdata('first_name', $data['first_name']);
        $this->session->set_userdata('last_name', $data['last_name']);
        $this->session->set_userdata('user_type', $data['user_type']);
        $this->session->set_userdata('logged_in', TRUE);
    }

    function do_logout() {
        $user_id = $this->session->userdata('user_id');
        $this->db->query("update user_log set is_recent=0, logout=NOW() where user_id='{$user_id}' and is_recent=1");
        $this->session->sess_destroy();
    }

    function reset_password() {
        $site = common::get_settings_data();
        $verification_code = md5(date("F j, Y, g:i:s a"));
        $sql = "update user set forgot_password_verify='$verification_code' where user_name='{$_POST['user_name']}'";
        $this->db->query($sql);
        $base_url = base_url();
        $msg_content = "<div><a href='$base_url'><img alt='School-College Management' src='" . $base_url . "/images/logo.jpg' border='0'/></a>
                            <br />
                            <h3 style='border-bottom:1px solid #DDD;margin:0;'></h3>";
        $msg_content.="<div style='width:700px;font-family:trebuchet ms;color:#343434;font-size:13px;'>";
        $msg_content.="Thank you for contacting School-College Management Online Account Support.
                        <br /><br />You have asked us to reset your password.
                        <br /><br />Please click on the link below to reset your password.
                        <br /><br />
                        Password Reset URL: <a href='" . site_url('login/reset_password/' . $verification_code) . "'>" . site_url('login/reset_password/' . $verification_code) . "</a>
                        <br />
                        <br />Thank you,
                        <br />School-College Management Account Support";
        $msg_content.='</div></div>';
        $from = $site['admin_email'];
        $from_name = 'School-College Admin';
        $to = $_POST['email'];
        $subject = 'Forgot Password Support';
        common::sending_mail($from, $from_name, $to, $subject, $msg_content);
    }

    function is_password_verfiy($password_verify) {
        $sql = $this->db->query("select * from user where forgot_password_verify='$password_verify'");
        if ($sql->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_password($verification_code) {
        $password = md5($_POST['new_password']);
        $sql = "update user set password='$password' where forgot_password_verify='$verification_code'";
        return $this->db->query($sql);
    }

}
?>