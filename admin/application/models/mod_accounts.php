<?php

/**
 * Description of mod_absent_notice
 *
 * @author anwar
 */
class mod_accounts extends Model {

    function __construct() {
        parent::Model();
    }

    function get_std_class_fee() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select c.class_code,c.class_name,cf.* from std_class_fee as cf
                                join class as c on c.class_id=cf.class_id
                                where cf.student_id=$student_id");
        return $sql->result_array();
    }

    function get_student_class_fee() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select c.class_id,c.class_name,cm.class_fee,cm.monthly_fee,rc.session_id,s.session_name
                               from class as c join class_map as cm on c.class_id=cm.class_id
                               join reg_class as rc on c.class_id=rc.class_id
                               join session as s on s.session_id=rc.session_id
                               where rc.student_id=$student_id");

        return $sql->row_array();
    }

    function get_admission_fee_reg($student_id, $class_map_id) {
        $sql = $this->db->query("select ad.*,cm.class_id,c.class_name,s.session_name
                               from std_admission_fee as ad
                               join class_map as cm on ad.class_map_id=cm.class_map_id
                               join class as c on cm.class_id=c.class_id
                               join session as s on cm.session_id=s.session_id
                               where ad.student_id=$student_id and ad.class_map_id=$class_map_id");
        return $sql->row_array();
    }

    function get_monthly_payment($class_id, $session_id) {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select * from std_class_fee where student_id=$student_id and class_id=$class_id and session_id=$session_id");
        return $sql->result_array();
    }

    function receive_monthly_fee($class_map_id, $month) {
        $class_map = sql::row("class_map", "class_map_id=$class_map_id");
        $student_id = $this->session->userdata('sel_student_id');
        $user_id = $this->session->userdata('user_id');
        $paid_date = date('Y-m-d');

        $sql = "insert into std_class_fee set
        student_id=$student_id,
        class_map_id=$class_map_id,
        monthly_fee={$class_map['monthly_fee']},
        month={$this->db->escape($month)},
        is_paid={$this->db->escape(1)},
        paid_date={$this->db->escape($paid_date)},
        user_id=$user_id";

        return $this->db->query($sql);
    }

    //add/update class fee from student account
    function register_class_fee($class_map_id, $month, $student_id) {

        $class_details = sql::row("class_map", "class_map_id=$class_map_id");
        $reg_class = sql::row("reg_class", "class_map_id=$class_map_id and student_id=$student_id");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "month" => $month,
            "section" => $reg_class['section'],
            "monthly_fee" => $class_details['monthly_fee'],
            "register_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("class_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_class_fee($class_fee_register_id, $class_map_id, $student_id) {

        $user_id = $this->session->userdata('user_id');
        $reg_class = sql::row("reg_class", "class_map_id=$class_map_id and student_id=$student_id");

        $student_rows = common::get_class_reg_student($class_map_id, $reg_class['section']);

        $register=sql::row("class_fee_register","class_fee_register_id=$class_fee_register_id");

        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $register["monthly_fee"];
        } else {
            if ($_POST["fee_".$register['month']] != "") {
                $std_fee = $_POST["fee_".$register['month']];
            } else {
                $std_fee = $register["monthly_fee"];
            }
        }

        if (count($student_rows) > 0) {
            foreach ($student_rows as $student_row) {
                if (common::student_is_delete($student_row['student_id']) == false) {
                    $is_paid = ($student_row['student_id'] == $student_id) ? 1 : 0;
                    $fine=($student_row['student_id'] == $student_id) ? $_POST['fine_'.$register['month']] : 0;
                    $data = array(
                        "class_fee_register_id" => $class_fee_register_id,
                        "student_id" => $student_row['student_id'],
                        "fee"=>$std_fee,
                        "fine"=>$fine,
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_class_fee", $data);
                }
            }
        }

        return;
    }

    function save_student_class_fee($class_fee_register_id, $student_id) {
        $user_id = $this->session->userdata('user_id');

        $register=sql::row("class_fee_register","class_fee_register_id=$class_fee_register_id");
        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $register["monthly_fee"];
        } else {
            if ($_POST["fee_".$register['month']] != "") {
                $std_fee = $_POST["fee_".$register['month']];
            } else {
                $std_fee = $register["monthly_fee"];
            }
        }

        $data = array(
            "class_fee_register_id" => $class_fee_register_id,
            "student_id" => $student_id,
            "fee"=>$std_fee,
            "fine"=>$_POST['fine_'.$register['month']],
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("std_class_fee", $data);
    }

    function save_student_exam_fee($exam_fee_register_id, $student_id) {
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "exam_fee_register_id" => $exam_fee_register_id,
            "student_id" => $student_id,
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("std_exam_fee", $data);
    }

    function update_monthly_fee($class_fee_register_id,$class_fee_id, $student_id) {


        $user_id = $this->session->userdata('user_id');
        $register=sql::row("class_fee_register","class_fee_register_id=$class_fee_register_id");
        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $register["monthly_fee"];
        } else {
            if ($_POST["fee_".$register['month']] != "") {
                $std_fee = $_POST["fee_".$register['month']];
            } else {
                $std_fee = $register["monthly_fee"];
            }
        }


        $data = array(
            "fee"=>$std_fee,
            "fine"=>$_POST['fine_'.$register['month']],
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->update("std_class_fee", $data, array("class_fee_id" => $class_fee_id, "student_id" => $student_id));
        return;
    }

    /* add/update admission fee from student account  */

    function register_admission_fee($class_map_id) {

        $class_details = sql::row("class_map", "class_map_id=$class_map_id");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "admission_fee" => $class_details['class_fee'],
            "register_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("admission_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_admission_fee($admission_fee_register_id, $class_map_id, $student_id) {

        $user_id = $this->session->userdata('user_id');
        $student_rows = common::get_class_reg_student($class_map_id);
        $register=sql::row("admission_fee_register","admission_fee_register_id=$admission_fee_register_id");

        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $register["admission_fee"];
        } else {
            if ($_POST["fee"] != "") {
                $std_fee = $_POST["fee"];
            } else {
                $std_fee = $register["admission_fee"];
            }
        }


        if (count($student_rows) > 0) {
            foreach ($student_rows as $student_row) {
                if (common::student_is_delete($student_row['student_id']) == false) {
                    $is_paid = ($student_row['student_id'] == $student_id) ? 1 : 0;
                    $fee=($student_row['student_id']==$student_id)?$std_fee:$register["admission_fee"];
                    
                    $data = array(
                    "admission_fee_register_id" => $admission_fee_register_id,
                    "student_id" => $student_row['student_id'],
                    "fee"=>$fee,
                    "is_paid" => $is_paid,
                    "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                    "user_id" => $user_id
                    );
                    $this->db->insert("std_admission_fee", $data);
                }
            }
        }

        return;
    }

    function save_student_admission_fee($admission_fee_register_id, $student_id) {
        $user_id = $this->session->userdata('user_id');
        

        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $_POST["admission_fee"];
        } else {
            if ($_POST["fee"] != "") {
                $std_fee = $_POST["fee"];
            } else {
                $std_fee = $_POST["admission_fee"];
            }
        }

        $data = array(
            "admission_fee_register_id" => $admission_fee_register_id,
            "student_id" => $student_id,
            "fee"=>$std_fee,
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("std_admission_fee", $data);
    }

    function update_admission_fee($admission_fee_id, $student_id) {

        $user_id = $this->session->userdata('user_id');
        $privilege = $_POST["privilege"];
        if ($privilege == 0) {
            $std_fee = $_POST["admission_fee"];
        } else {
            if ($_POST["fee"] != "") {
                $std_fee = $_POST["fee"];
            } else {
                $std_fee = $_POST["admission_fee"];
            }
        }


        $data = array(
            "fee"=>$std_fee,
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->update("std_admission_fee", $data, array("admission_fee_id" => $admission_fee_id, "student_id" => $student_id));
        return;
    }

    /* add/update exam fee from student account  */

    function register_exam_fee($class_map_id, $exam_id) {

        $exam_details = sql::row("exam", "exam_id=$exam_id");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "exam_id" => $exam_id,
            "exam_fee" => $exam_details['exam_fee'],
            "register_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->insert("exam_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_exam_fee($exam_fee_register_id, $class_map_id, $student_id) {

        $user_id = $this->session->userdata('user_id');
        $student_rows = common::get_class_reg_student($class_map_id);

        if (count($student_rows) > 0) {
            foreach ($student_rows as $student_row) {
                if (common::student_is_delete($student_row['student_id']) == false) {
                    $is_paid = ($student_row['student_id'] == $student_id) ? 1 : 0;
                    $data = array(
                        "exam_fee_register_id" => $exam_fee_register_id,
                        "student_id" => $student_row['student_id'],
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_exam_fee", $data);
                }
            }
        }

        return;
    }

    function update_exam_fee($exam_fee_id, $student_id) {


        $user_id = $this->session->userdata('user_id');
        $data = array(
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->update("std_exam_fee", $data, array("exam_fee_id" => $exam_fee_id, "student_id" => $student_id));
        return;
    }

    function receive_exam_fee($class_map_id, $exam_id) {

        $exam_fee = sql::row("exam", "exam_id=$exam_id");
        $student_id = $this->session->userdata('sel_student_id');

        $user_id = $this->session->userdata('user_id');
        $paid_date = date('Y-m-d');

        $sql = "insert into std_exam_fee set
                    student_id=$student_id,
                    class_map_id={$class_map_id},
                    exam_id={$exam_id},
                    exam_fee={$exam_fee['exam_fee']},
                    is_paid={$this->db->escape(1)},
                    paid_date='$paid_date',
                    user_id=$user_id";
        return $this->db->query($sql);
    }

    function receive_admission_fee($class_map_id) {

        $class_map = sql::row("class_map", "class_map_id=$class_map_id");
        $student_id = $this->session->userdata('sel_student_id');
        $user_id = $this->session->userdata('user_id');
        $paid_date = date('Y-m-d');

        $sql = "insert into std_admission_fee set
        student_id=$student_id,
        class_map_id={$class_map_id},
        admission_fee={$class_map['class_fee']},
        is_paid={$this->db->escape(1)},
        paid_date='$paid_date',
        user_id=$user_id";
        return $this->db->query($sql);
    }

    function save_class_fee() {
        $student_id = $this->session->userdata('sel_student_id');
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into std_class_fee set
        student_id=$student_id,
        class_id={$_POST['class_id']},
        class_fee={$_POST['class_fee']},
        reg_fee={$_POST['reg_fee']},
        discount={$_POST['discount']},        
        deferral={$_POST['deferral']},
        library_fee={$_POST['library_fee']},
        others_fee={$_POST['others_fee']},
        deposit={$_POST['deposit']},
        committed_amount={$_POST['committed_amount']},
        total_balance={$_POST['total_balance']},
        class_comment={$this->db->escape($_POST['class_comment'])},
        user_id=$user_id";
        return $this->db->query($sql);
    }

    function update_class_fee() {
        $class_fee_id = $this->session->userdata('class_fee_id');
        $sql = "update std_class_fee set
        class_id={$_POST['class_id']},
        class_fee={$_POST['class_fee']},
        
        reg_fee={$_POST['reg_fee']},
        discount={$_POST['discount']},        
        deferral={$_POST['deferral']},
        library_fee={$_POST['library_fee']},
        others_fee={$_POST['others_fee']},
        deposit={$_POST['deposit']},
        committed_amount={$_POST['committed_amount']},
        total_balance={$_POST['total_balance']},
        class_comment={$this->db->escape($_POST['class_comment'])}
        where class_fee_id=$class_fee_id";
        return $this->db->query($sql);
    }

    function get_std_level_fee() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select l.level_name,p.class_code,p.class_name,lf.* from std_level_fee as lf
                join class as p on p.class_id=lf.class_id
                join levels as l on l.levels_id=lf.levels_id
                where lf.student_id=$student_id");
        return $sql->result_array();
    }

    function save_level_fee() {
        $student_id = $this->session->userdata('sel_student_id');
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into std_level_fee set
        student_id=$student_id,
        class_id={$_POST['class_id']},
        levels_id={$_POST['levels_id']},
        level_fee={$_POST['level_fee']},
        level_extd_date={$this->db->escape($_POST['level_extd_date'])},
        extended_fee={$this->db->escape($_POST['extended_fee'])},
        reg_fee={$_POST['reg_fee']},
        discount={$_POST['discount']},
        awarding_body_fee={$_POST['awarding_body_fee']},
        deferral={$_POST['deferral']},
        library_fee={$_POST['library_fee']},
        others_fee={$_POST['others_fee']},
        deposit={$_POST['deposit']},
        committed_amount={$_POST['committed_amount']},
        total_balance={$_POST['total_balance']},
        level_comment={$this->db->escape($_POST['level_comment'])},
        user_id=$user_id";
        return $this->db->query($sql);
    }

    function update_level_fee() {
        $level_fee_id = $this->session->userdata('level_fee_id');
        $sql = "update std_level_fee set
        class_id={$_POST['class_id']},
        levels_id={$_POST['levels_id']},
        level_fee={$_POST['level_fee']},
        level_extd_date={$this->db->escape($_POST['level_extd_date'])},
        extended_fee={$this->db->escape($_POST['extended_fee'])},
        reg_fee={$_POST['reg_fee']},
        discount={$_POST['discount']},
        awarding_body_fee={$_POST['awarding_body_fee']},
        deferral={$_POST['deferral']},
        library_fee={$_POST['library_fee']},
        others_fee={$_POST['others_fee']},
        deposit={$_POST['deposit']},
        committed_amount={$_POST['committed_amount']},
        total_balance={$_POST['total_balance']},
        level_comment={$this->db->escape($_POST['level_comment'])}
        where level_fee_id=$level_fee_id";
        return $this->db->query($sql);
    }

    function get_installed_amount($class_fee_id, $installment_id='') {
        $con = '';
        if ($installment_id != '') {
            $con = " and installment_id<$installment_id";
        }
        $amount = 0;
        $sql = $this->db->query("select sum(amount) as amount from std_fee_installment
                where class_fee_id=$class_fee_id $con");
        $data = $sql->row_array();
        if ($data['amount'] != '') {
            $amount = $data['amount'];
        }
        return $amount;
    }

    function get_paid_amount($installment_id, $payments_id='') {
        $con = '';
        if ($payments_id != '') {
            $con = " and payments_id<$payments_id";
        }
        $amount = 0;
        $sql = $this->db->query("select sum(paid_amount) as amount from std_payments where installment_id=$installment_id $con");
        $data = $sql->row_array();
        if ($data['amount'] != '') {
            $amount = $data['amount'];
        }
        return $amount;
    }

    function get_class_fee_info($class_fee_id) {
        $sql = $this->db->query("select c.class_name,cf.* from std_class_fee as cf
                               join class as c on c.class_id=cf.class_id
                               where cf.class_fee_id=$class_fee_id");
        return $sql->row_array();
    }

    function get_installments() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select c.class_name,fi.* from std_fee_installment as fi
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as c on c.class_id=cf.class_id
                where cf.student_id=$student_id");
        return $sql->result_array();
    }

    function save_installment() {
        $class_fee_id = $this->session->userdata('class_fee_id');
        $student_id = $this->session->userdata('sel_student_id');
        $user_id = $this->session->userdata('user_id');

        $sql = "insert into std_fee_installment set
        student_id=$student_id,
        class_fee_id=$class_fee_id,
        committed_date={$this->db->escape($_POST['committed_date'])},
        amount={$_POST['amount']},
        notes={$this->db->escape($_POST['notes'])},
        user_id=$user_id,
        is_recent=0";
        $flag = $this->db->query($sql);
        $ins_id = $this->db->insert_id();
        $row = sql::row('std_fee_installment', "student_id=$student_id and is_recent=1", 'installment_id,amount');
        if ($row['installment_id'] != '') {
            if ($this->get_paid_amount($row['installment_id']) >= $row['amount']) {
                $this->db->query("update std_fee_installment set is_recent=3 where installment_id=$row[installment_id]");
                $recent_ins = sql::row('std_fee_installment', "student_id=$student_id and is_recent=0 order by committed_date", 'installment_id');
                if ($recent_ins['installment_id'] != '') {
                    $this->db->query("update std_fee_installment set is_recent=1 where installment_id=$recent_ins[installment_id]");
                }
            }
        } else {
            $this->db->query("update std_fee_installment set is_recent=1 where installment_id=$ins_id");
        }
        return $flag;
    }

    function update_installment() {
        $installment_id = $this->session->userdata('installment_id');
        $sql = "update std_fee_installment set
        committed_date={$this->db->escape($_POST['committed_date'])},
        amount={$_POST['amount']},
        notes={$this->db->escape($_POST['notes'])}
        where installment_id=$installment_id";
        return $this->db->query($sql);
    }

    function get_installment_info($installment_id) {
        $sql = $this->db->query("select p.class_name,cf.student_id,cf.class_fee,cf.total_balance,fi.* from std_fee_installment as fi
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as p on p.class_id=cf.class_id
                where fi.installment_id=$installment_id");
        return $sql->row_array();
    }

    function get_payments() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select p.class_name,fi.committed_date,d.details_name,sp.* from std_payments as sp
                join std_fee_installment as fi on fi.installment_id=sp.installment_id
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as p on p.class_id=cf.class_id
                left join payment_details as d on d.pay_details_id=sp.pay_details_id
                where cf.student_id=$student_id");
        return $sql->result_array();
    }

    function save_payments() {
        $user_id = $this->session->userdata('user_id');
        $student_id = $this->session->userdata('sel_student_id');
        $installment_id = $this->session->userdata('installment_id');
        $sql = "insert into std_payments set
        student_id=$student_id,
        installment_id=$installment_id,
        paid_date={$this->db->escape($_POST['paid_date'])},
        paid_amount={$_POST['paid_amount']},
        pay_mood='{$_POST['pay_mood']}',
        pay_details_id='{$_POST['pay_details_id']}',
        notes={$this->db->escape($_POST['notes'])},
        user_id=$user_id";
        $flag = $this->db->query($sql);
        $row = sql::row('std_fee_installment', "installment_id=$installment_id");
        if ($row['installment_id'] != '') {
            if ($this->get_paid_amount($row['installment_id']) >= $row['amount']) {
                $this->db->query("update std_fee_installment set is_recent=3 where installment_id=$row[installment_id]");
                $recent_ins = sql::row('std_fee_installment', "student_id=$student_id and is_recent=0 order by committed_date", 'installment_id');
                if ($recent_ins['installment_id'] != '') {
                    $this->db->query("update std_fee_installment set is_recent=1 where installment_id=$recent_ins[installment_id]");
                }
            }
        }
        return $flag;
    }

    function get_payments_info($payments_id) {
        $sql = $this->db->query("select p.class_name,cf.class_fee,cf.total_balance,fi.committed_date,fi.amount,sp.*,pd.details_name from std_payments as sp
                join std_fee_installment as fi on fi.installment_id=sp.installment_id
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as p on p.class_id=cf.class_id
                join  payment_details as pd on pd.pay_details_id=sp.pay_details_id
                where sp.payments_id=$payments_id");
        return $sql->row_array();
    }

    function update_payments() {
        $payments_id = $this->session->userdata('payments_id');
        $sql = "update std_payments set
        paid_date={$this->db->escape($_POST['paid_date'])},
        paid_amount={$_POST['paid_amount']},
        pay_mood='{$_POST['pay_mood']}',
        pay_details_id='{$_POST['pay_details_id']}',
        notes={$this->db->escape($_POST['notes'])}
        where payments_id=$payments_id";
        return $this->db->query($sql);
    }

    function get_agent_info($agents_id) {
        $sql = $this->db->query("SELECT a.agents_id,concat(a.first_name, ' ',a.last_name) as agent_name,a.nationality,a.agent_type,a.agent_status,c.int_commission,c.local_commission,int_comm_reg_fee,local_comm_reg_fee,int_comm_tuition_fee,local_comm_tuition_fee,c.fixed_amt_per_student FROM `agents` as a
                join agent_contact as c on c.agents_id=a.agents_id 	
                WHERE a.agents_id=$agents_id");
        return $sql->row_array();
    }

    function get_advance_payment() {
        $student_id = $this->session->userdata('sel_student_id');
        $sql = $this->db->query("select c.class_name,d.details_name,sp.* from std_advance_payment as sp
                join class as c on c.class_id=sp.class_id
                join payment_details as d on d.pay_details_id=sp.pay_details_id
                where sp.student_id=$student_id");
        return $sql->result_array();
    }

    function save_advance() {
        $user_id = $this->session->userdata('user_id');
        $student_id = $this->session->userdata('sel_student_id');
        $sql = "insert into std_advance_payment set
        student_id=$student_id,
        class_id='{$_POST['class_id']}',
        agreed_fee={$_POST['agreed_fee']},
        amount={$_POST['amount']},
        paid_date={$this->db->escape($_POST['paid_date'])},
        paid_amount={$_POST['paid_amount']},
        pay_mood='{$_POST['pay_mood']}',
        pay_details_id='{$_POST['pay_details_id']}',
        notes={$this->db->escape($_POST['notes'])},
        user_id=$user_id";

        return $this->db->query($sql);
    }

    function update_advance() {
        $advance_id = $this->session->userdata('sel_advance_id');
        $sql = "update std_advance_payment set
        class_id='{$_POST['class_id']}',
        agreed_fee={$_POST['agreed_fee']},
        amount={$_POST['amount']},
        paid_date={$this->db->escape($_POST['paid_date'])},
        paid_amount={$_POST['paid_amount']},
        pay_mood='{$_POST['pay_mood']}',
        pay_details_id='{$_POST['pay_details_id']}',
        notes={$this->db->escape($_POST['notes'])}
        where advance_id=$advance_id";

        return $this->db->query($sql);
    }

    function get_student_accounts_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        //$con='1';
        $con = '';
        $searchField = common::getVar('searchField');
        $searchValue = common::getVar('searchValue');
        if ($searchField != '' && $searchValue != '') {
            $con.=' and ' . $searchField . ' like "%' . $searchValue . '%"';
        }

        $sql = "select s.*,si.committed_date,si.amount,sum(p.paid_amount) as paid_amount from view_std_reg as s
              join std_fee_installment as si on si.student_id=s.student_id and si.is_recent=1
              left join std_payments as p on p.installment_id=si.installment_id and p.student_id=s.student_id
              where s.is_recent=1 $con group by si.installment_id $sort";


        /* $sql="select s.*,si.committed_date,si.amount,sum(p.paid_amount) as paid_amount from view_std_reg as s
          join std_payments as p on p.student_id=s.student_id
          where s.is_recent=1 $con  $sort"; */

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
            if ($row['committed_date'] < date('Y-m-d')) {
                $com_date = '<span class="dead_color">' . $row['committed_date'] . '</span>';
            } else {
                $com_date = $row['committed_date'];
            }
            $href = "<a href='" . site_url('accounts/student_accounts/' . $row[user_name]) . "' class='bold blue'>{$row['student_name']}</a>";
            $responce->rows[$i]['cell'] = array($row['user_name'], $href, $row['class_name'], $row['session_name'], $row['student_status'], $com_date, $row['amount'] - $row['paid_amount']);
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

    function get_account_search_options($sel='') {
        $arr = array(
            's.student_name' => 'Student Name',
            's.user_name' => 'Student ID',
            's.class_name' => 'Class Name',
            's.session_name' => 'Session Name',
            'si.committed_date' => 'Next Payment Date'
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

    function get_admission_fee() {
        $student_id = $this->session->userdata('logged_student_id');
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

    function get_exam_fee() {
        $student_id = $this->session->userdata('logged_student_id');
        $sql = $this->db->query("select ef.*,efr.exam_fee,e.exam_name from std_exam_fee as ef
                                join exam_fee_register as efr on ef.exam_fee_register_id=efr.exam_fee_register_id
                                join exam as e on e.exam_id=efr.exam_id
                                where ef.student_id=$student_id");
        return $sql->result_array();
    }

    function get_monthly_fee() {
        $student_id = $this->session->userdata('logged_student_id');
        $sql = $this->db->query("select cf.*,rcf.month,rcf.monthly_fee,rc.privilege
                                from std_class_fee as cf
                                join class_fee_register as rcf on rcf.class_fee_register_id=cf.class_fee_register_id
                                join reg_class as rc on rc.student_id=cf.student_id
                                where cf.student_id=$student_id");
        return $sql->result_array();
    }

    function get_additional_fee() {

        $student_id = $this->session->userdata('logged_student_id');
        $sql = $this->db->query("select af.*,raf.description
                                from std_additional_fee as af join additional_fee_register as raf
                                on raf.additional_fee_register_id=af.additional_fee_register_id
                                where af.student_id=$student_id order by raf.description");
        return $sql->result_array();
    }

    function get_additional_fee_row($student_id, $additional_fee_register_id) {

        $sql = $this->db->query("select af.*,raf.description,raf.register_date
                                from std_additional_fee as af join additional_fee_register as raf
                                on raf.additional_fee_register_id=af.additional_fee_register_id
                                where af.student_id=$student_id and raf.additional_fee_register_id=$additional_fee_register_id");
        return $sql->row_array();
    }

    function save_student_additional_fee($additional_fee_register_id, $student_id) {
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "additional_fee_register_id" => $additional_fee_register_id,
            "student_id" => $student_id,
            "fee" => $_POST['fee'],
            "is_paid" => 1,
            "paid_date" => $_POST['date'],
            "user_id" => $user_id
        );
        $this->db->insert("std_additional_fee", $data);
    }

    function update_additional_fee($additional_fee_id, $student_id) {


        $user_id = $this->session->userdata('user_id');
        $data = array(
            "is_paid" => 1,
            "paid_date" => date('Y-m-d'),
            "user_id" => $user_id
        );
        $this->db->update("std_additional_fee", $data, array("additional_fee_id" => $additional_fee_id, "student_id" => $student_id));
        return;
    }

}
?>