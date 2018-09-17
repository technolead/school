<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_expense
 *
 * @author Anwar
 */
class mod_expense extends Model {
    function __construct() {
        parent::Model();
    }
    function get_expense_grid() {
        $sortname = common::getVar('sidx', 'exp_date');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $con='1';
        
        $exp_date=common::getVar('exp_date');


        if($exp_date!='') {
            $con.=" and e.exp_date like '$exp_date'";
        }
        $sql = "select u.first_name,u.last_name,e.*,d.details_name,d.pay_effect from expense as e
                join user as u on u.user_id=e.user_id
                join payment_details as d on d.pay_details_id=e.pay_details_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $temp=$this->db->query($sql);
        $count = count($temp->result_array());
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

        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach ($rows as $row) {
            $responce->rows[$i]['id'] = $row['expense_id'];
            $responce->rows[$i]['cell'] = array($i+1,$row['exp_title'],$row['exp_des'],$row['exp_date'],$row['exp_amount'],$row['pay_mood'],$row['details_name'],$row['pay_effect'],$row['first_name'].' '.$row['last_name']);
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
    function get_all_expense($limit='') {
        $sql=$this->db->query("select u.first_name,u.last_name,e.*,d.details_name,d.pay_effect from expense as e
                                join user as u on u.user_id=e.user_id
                                join payment_details as d on d.pay_details_id=e.pay_details_id
                                where 1=1 order by date desc $limit");
        return $sql->result_array();
    }
    function save_expense() {
        $user_id=$this->session->userdata('user_id');

        $sql="insert into expense set
                exp_title={$this->db->escape($_POST['exp_title'])},
                exp_des={$this->db->escape($_POST['exp_des'])},
                exp_date={$this->db->escape($_POST['exp_date'])},
                exp_amount={$this->db->escape($_POST['exp_amount'])},
                pay_mood={$this->db->escape($_POST['pay_mood'])},
                pay_details_id={$this->db->escape($_POST['pay_details_id'])},
                user_id=$user_id";
        return $this->db->query($sql);
    }
    function update_enquiry() {
        $expense_id=$this->session->userdata('expense_id');
        $sql="update expense set
                exp_title={$this->db->escape($_POST['exp_title'])},
                exp_des={$this->db->escape($_POST['exp_des'])},
                exp_date={$this->db->escape($_POST['exp_date'])},
                exp_amount={$this->db->escape($_POST['exp_amount'])},
                pay_mood={$this->db->escape($_POST['pay_mood'])},
                pay_details_id={$this->db->escape($_POST['pay_details_id'])}
                where expense_id=$expense_id";
        return $this->db->query($sql);
    }
}
?>
