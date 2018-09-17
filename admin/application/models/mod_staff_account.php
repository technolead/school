<?php

class mod_staff_account extends Model {
    function __construct() {
        parent::Model();
    }
    function get_staff_payments($staffs_id='',$limit='') {
        $month=$this->session->userdata('sel_month');
        $year=$this->session->userdata('sel_year');

        $con='';
        if($month!=''&& $year!='') {
            $con=" and month='$month' and year='$year'";
        }else if($month!='') {
            $con=" and month='$month'";
        }

        $sql=$this->db->query("select p.*,d.details_name,d.pay_effect,concat(u.first_name,' ',u.last_name) as inputed_by from staff_payment as p
                                join payment_details as d on d.pay_details_id=p.pay_details_id
                                join user as u on u.user_id=p.user_id
                                where p.staffs_id=$staffs_id  order by p.paid_date $limit");
        //echo $this->db->last_query();exit();
        return $sql->result_array();
    }
    function save_payment() {
        $staffs_id=$this->session->userdata('sel_staff_id');
        $user_id=$this->session->userdata('user_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
//        $sql="insert into staff_payment set
//				staffs_id=$staffs_id,
//				paid_date={$this->db->escape($_POST['paid_date'])},
//				paid_amount={$_POST['paid_amount']},
//				pay_mood='{$_POST['pay_mood']}',
//				pay_details_id='{$_POST['pay_details_id']}',
//				month='{$_POST['month']}',
//				year='{$_POST['year']}',
//				dur_from_date={$this->db->escape($_POST['dur_from_date'])},
//				dur_to_date={$this->db->escape($_POST['dur_to_date'])},
//				purpose={$this->db->escape($_POST['purpose'])},
//				user_id=$user_id
//                ";
//        return $this->db->query($sql);


        $data=array(
            "staffs_id"=>$staffs_id,
            "paid_date"=> $_POST['paid_date'],
            "paid_amount"=>$_POST['paid_amount'],
            "mpo_amount"=>($_POST['mpo_amount']!='')?$_POST['mpo_amount']:0,
            "pay_mood"=>$_POST['pay_mood'],
            "pay_details_id"=>$_POST['pay_details_id'],
            "month"=>$_POST['month'],
            "year"=>$_POST['year'],
            "user_id"=>$user_id
        );
        $this->db->insert("staff_payment",$data);
        return true;

    }
    function update_payment() {
        $payment_id=$this->session->userdata('payment_id');
        if($payment_id=='') {
            common::redirect();
        }
//        $sql="update staff_payment set
//				paid_date={$this->db->escape($_POST['paid_date'])},
//				paid_amount={$_POST['paid_amount']},
//				pay_mood='{$_POST['pay_mood']}',
//				pay_details_id='{$_POST['pay_details_id']}',
//				month='{$_POST['month']}',
//				year='{$_POST['year']}',
//				dur_from_date={$this->db->escape($_POST['dur_from_date'])},
//				dur_to_date={$this->db->escape($_POST['dur_to_date'])},
//				purpose={$this->db->escape($_POST['purpose'])}
//				where payment_id=$payment_id
//                ";
//        return $this->db->query($sql);

        $data=array(
            "paid_date"=> $_POST['paid_date'],
            "paid_amount"=>$_POST['paid_amount'],
            "mpo_amount"=>($_POST['mpo_amount']!='')?$_POST['mpo_amount']:0,
            "pay_mood"=>$_POST['pay_mood'],
            "pay_details_id"=>$_POST['pay_details_id'],
            "month"=>$_POST['month'],
            "year"=>$_POST['year']
        );
        $this->db->update("staff_payment",$data,array("payment_id"=>$payment_id));
        return true;

    }
    function save_balance() {
        $staffs_id=$this->session->userdata('sel_staff_id');
        $user_id=$this->session->userdata('user_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        $sql="insert into staff_balance set
				staffs_id=$staffs_id,
				month='{$_POST['month']}',
				year='{$_POST['year']}',
				previous_due={$_POST['previous_due']},
				extra_day_hour={$_POST['extra_day_hour']},
				other_add={$_POST['other_add']},
				payable_total={$_POST['payable_total']},
				part_adv_pay={$_POST['part_adv_pay']},
				absent_day_hour={$_POST['absent_day_hour']},
				lunch={$_POST['lunch']},
				other_deduce={$_POST['other_deduce']},
				deduced_total={$_POST['deduced_total']},
				net_pay={$_POST['net_pay']},
				total={$_POST['total']},
				paid_amount={$_POST['paid_amount']},
				paid_date={$this->db->escape($_POST['paid_date'])},
				pay_mood='{$_POST['pay_mood']}',
				pay_details_id='{$_POST['pay_details_id']}',
				due={$_POST['due']},
				paid_holidays={$this->db->escape($_POST['paid_holidays'])},
				paid_absent={$this->db->escape($_POST['paid_absent'])},
				comments={$this->db->escape($_POST['comments'])},
				user_id=$user_id
                ";
        return $this->db->query($sql);
    }
    function update_balance() {
        $staffs_id=$this->session->userdata('sel_staff_id');
        $balance_id=$this->session->userdata('edit_balance_id');
        if($staffs_id=='') {
            redirect('staff_account');
        }
        $sql="update staff_balance set
				month='{$_POST['month']}',
				year='{$_POST['year']}',
				previous_due={$_POST['previous_due']},
				extra_day_hour={$_POST['extra_day_hour']},
				other_add={$_POST['other_add']},
				payable_total={$_POST['payable_total']},
				part_adv_pay={$_POST['part_adv_pay']},
				absent_day_hour={$_POST['absent_day_hour']},
				lunch={$_POST['lunch']},
				other_deduce={$_POST['other_deduce']},
				deduced_total={$_POST['deduced_total']},
				net_pay={$_POST['net_pay']},
				total={$_POST['total']},
				paid_amount={$_POST['paid_amount']},
				paid_date={$this->db->escape($_POST['paid_date'])},
				pay_mood='{$_POST['pay_mood']}',
				pay_details_id='{$_POST['pay_details_id']}',
				due={$_POST['due']},
				paid_holidays={$this->db->escape($_POST['paid_holidays'])},
				paid_absent={$this->db->escape($_POST['paid_absent'])},
				comments={$this->db->escape($_POST['comments'])}
				where balance_id=$balance_id
                ";
        return $this->db->query($sql);
    }
    function get_balance_details($balance_id){
        $sql=$this->db->query("select b.*,d.details_name from staff_balance as b
                               join payment_details as d on d.pay_details_id=b.pay_details_id
                               where b.balance_id=$balance_id");
        return $sql->row_array();
    }


    function get_staff_training($training_id){
        $sql=$this->db->query("select training_title,increment
                               from staff_training where training_id in ($training_id)");
        return $sql->result_array();
    }
}

?>