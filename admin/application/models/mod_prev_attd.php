<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_prev_attd
 *
 * @author Anwar
 */
class mod_prev_attd extends Model {
    function  __construct() {
        parent::Model();
    }
    function get_attd_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $con='1';
        $user_name=common::getVar('user_name');
        $class_id=common::getVar('class_id');
        $attd_date=common::getVar('attd_date');
        $branch_id=$this->session->userdata('branch_id');
        if($user_name!='') {
            $con.=" and s.user_name like '{$user_name}'";
        }
        if($class_id!='') {
            $con.=" and a.class_id = '$class_id'";
        }
        if($attd_date!='') {
            $con.=" and a.attd_date like '$attd_date'";
        }
        if($branch_id!=''){
            $con.=" and s.branch_id='{$branch_id}'";
        }
        $sql = "select s.first_name,s.last_name,s.user_name,p.class_code,p.class_name,a.* from prev_attd as a
                join student as s on s.student_id=a.student_id
                join class as p on p.class_id=a.class_id
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
            $responce->rows[$i]['id'] = $row['attd_id'];
            $responce->rows[$i]['cell'] = array($i+1,$row['user_name'],$row['first_name'].' '.$row['last_name'],$row['class_name'],$row['attd_date'],$row['attd_attendance']);
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

    function get_class_reg_student() {
        $class_id=$this->session->userdata('sess_class_id');
        $branch_id=$this->session->userdata('branch_id');
        $con='';
        if($branch_id!=''){
            $con.=" and s.branch_id='{$branch_id}'";
        }
        $sql = "select s.first_name,s.last_name,s.user_name,p.class_code,p.class_name,rp.* from reg_class as rp
                join student as s on s.student_id=rp.student_id
                join class as p on p.class_id=rp.class_id
                where rp.class_id='{$class_id}' and s.is_delete=0 $con";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    function save_prev_attd() {
        $class_id=$this->session->userdata('sess_class_id');
        $inc=0;
        if(count($_POST['student_id'])>0) {
            foreach ($_POST['student_id'] as $student_id) {
                $this->db->query("insert into prev_attd set
                                    student_id=$student_id,
                                    class_id='$class_id',
                                    attd_date='{$_POST['attd_date']}',
                                    attd_attendance={$this->db->escape($_POST['attd_attendance'][$inc])}");
                $inc++;
            }
        }
    }
    function get_attd_details($attd_id) {
        $sql=$this->db->query("select s.first_name,s.last_name,s.user_name,p.class_code,p.class_name,a.* from prev_attd as a
                join student as s on s.student_id=a.student_id
                join class as p on p.class_id=a.class_id
                where a.attd_id='$attd_id'");
        return $sql->row_array();
    }
    function update_prev_attd() {
        $attd_id=$this->session->userdata('attd_id');
        $this->db->query("update prev_attd set
                            attd_date='{$_POST['attd_date']}',
                            attd_attendance={$this->db->escape($_POST['attd_attendance'])}
                            where attd_id='$attd_id'");
    }
}
?>
