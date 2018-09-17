<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_agent_account
 *
 * @author Anwar
 */
class mod_agent_account extends Model {
    function  __construct() {
        parent::Model();
    }
     function get_agents_students($agents_id,$limit='') {
        /*
		$sql=$this->db->query("SELECT s.student_id,s.user_name,s.first_name,s.last_name,s.student_status,s.agents_id,p.program_name,p.program_code  FROM `student` as s
								join reg_program as rp on rp.student_id=s.student_id
								join programs as p on p.programs_id=rp.programs_id
								where s.agents_id=$agents_id $limit");
        */
        $sql=$this->db->query("select p.program_code,p.program_name,l.level_name,concat(s.first_name,' ',s.last_name) as student_name,s.user_name,s.student_status,s.student_id,sp.agent_amount,sp.agents_id,sp.payments_id from std_payments as sp
                                join std_fee_installment as fi on fi.installment_id=sp.installment_id
                                join std_level_fee as lf on lf.level_fee_id=fi.level_fee_id
                                join programs as p on p.programs_id=lf.programs_id
                                join levels as l on l.levels_id=lf.levels_id
                                join student as s on s.student_id=lf.student_id
                                where sp.agents_id=$agents_id $limit");
        return $sql->result_array();
    }
    function save_payment() {
        $agents_id=$this->session->userdata('sel_agents_id');
        $payments_id=$this->session->userdata('payments_id');
        $student_id=$this->session->userdata('agent_student_id');
        $user_id=$this->session->userdata('user_id');
        if($agents_id==''||$payments_id=='') {
            redirect('agents');
        }
        $sql="insert into agent_payment set
				payments_id=$payments_id,
				student_id=$student_id,
				agents_id=$agents_id,
				paid_date={$this->db->escape($_POST['paid_date'])},
				due_amount={$_POST['due_amount']},
				paid_amount={$_POST['paid_amount']},
				agent_balance={$_POST['agent_balance']},
				pay_mood='{$_POST['pay_mood']}',
				pay_details_id='{$_POST['pay_details_id']}',
				comments={$this->db->escape($_POST['comments'])},
				user_id=$user_id
                ";
        return $this->db->query($sql);
    }
    function get_paid_amount($payments_id='') {
        if($payments_id=='') {
            return 0;
        }
        $sql=$this->db->query("select sum(paid_amount) as paid_amount from agent_payment where payments_id=$payments_id");
        $data=$sql->row_array();
        if($data['paid_amount']=='') {
            return 0;
        }
        return $data['paid_amount'];
    }
    function get_payments($agents_id,$limit='') {
        $sql=$this->db->query("select p.*,d.details_name,d.pay_effect,concat(s.first_name,' ',s.last_name) as student_name,s.user_name,concat(u.first_name,' ',u.last_name) as inputed_by from agent_payment as p
                                join payment_details as d on d.pay_details_id=p.pay_details_id
                                join student as s on s.student_id=p.student_id
                                join user as u on u.user_id=p.user_id
                                where p.agents_id=$agents_id order by p.paid_date");
        return $sql->result_array();
    }
    function get_payment_details($payments_id,$agents_id) {
        $sql=$this->db->query("select p.*,d.details_name,d.pay_effect,concat(s.first_name,' ',s.last_name) as student_name,s.user_name from agent_payment as p
                                join payment_details as d on d.pay_details_id=p.pay_details_id
                                join student as s on s.student_id=p.student_id
                                where p.agents_id=$agents_id and p.agent_payment_id =$payments_id");
        return $sql->row_array();
    }
    function update_payment() {
        $payments_id=$this->session->userdata('agent_payment_id');
        if($payments_id=='') {
            redirect('agents');
        }
        $sql="update agent_payment set
				paid_date={$this->db->escape($_POST['paid_date'])},
				due_amount={$_POST['due_amount']},
				paid_amount={$_POST['paid_amount']},
				agent_balance={$_POST['agent_balance']},
				pay_mood='{$_POST['pay_mood']}',
				pay_details_id='{$_POST['pay_details_id']}',
				comments={$this->db->escape($_POST['comments'])}
				where agent_payment_id=$payments_id
                ";
        return $this->db->query($sql);
    }
}
?>
