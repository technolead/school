<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_scms_config
 *
 * @author Anwar
 */
class mod_scms_config extends Model {
    function __construct() {
        parent::Model();
    }
    function get_types($type_for='all'){
        if($type_for=='all'||$type_for=='') {
            $con='1=1';
        }else {
            $con="type_for='$type_for'";
        }
        $sortname = common::getVar('sidx', 'type_id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from conf_type where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('conf_type',$con);
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

        $sql_query=$this->db->query($sql." limit $start, $limit");
        $rows=$sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        foreach($rows as $row) {
            $responce->rows[$i]['id']=$row['type_id'];
            $responce->rows[$i]['cell']=array($row['type_name'],$row['type_for'],$row['date']);
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
    
    function save_type() {
        $sql="insert into conf_type set
                type_name={$this->db->escape($_POST['type_name'])},
                type_for={$this->db->escape($_POST['type_for'])}";
        return $this->db->query($sql);
    }
    function update_type() {
        $type_id=$this->session->userdata('type_id');
        $sql="update conf_type set
                type_name={$this->db->escape($_POST['type_name'])},
                type_for={$this->db->escape($_POST['type_for'])}
                where type_id=$type_id";
        return $this->db->query($sql);
    }
    function get_status($status_for='all'){
        if($status_for=='all'||$status_for=='') {
            $con='1=1';
        }else {
            $con="status_for='$status_for'";
        }
        $sortname = common::getVar('sidx', 'status_for');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from conf_status where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('conf_status',$con);
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

        $sql_query=$this->db->query($sql." limit $start, $limit");
        $rows=$sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $responce->rows[$i]['id']=$row['status_id'];
            $responce->rows[$i]['cell']=array($row['status_name'],$row['status_for'],$row['date']);
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
    function save_status() {
        $sql="insert into conf_status set
                status_name={$this->db->escape($_POST['status_name'])},
                status_for={$this->db->escape($_POST['status_for'])}";
        return $this->db->query($sql);
    }
    function update_status() {
        $status_id=$this->session->userdata('status_id');
        $sql="update conf_status set
                status_name={$this->db->escape($_POST['status_name'])},
                status_for={$this->db->escape($_POST['status_for'])}
                where status_id=$status_id";
        return $this->db->query($sql);
    }
    function get_country_grid(){
        $sortname = common::getVar('sidx', 'country_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from country where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('country','1=1');
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

        $sql_query=$this->db->query($sql." limit $start, $limit");
        $rows=$sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $responce->rows[$i]['id']=$row['country_id'];
            $responce->rows[$i]['cell']=array($row['country_name'],$row['nationality']);
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
    function save_country() {
        $sql="insert into country set
                country_name={$this->db->escape($_POST['country_name'])},
                nationality={$this->db->escape($_POST['nationality'])}";
        return $this->db->query($sql);
    }
    function update_country() {
        $country_id=$this->session->userdata('country_id');
        $sql="update country set
               country_name={$this->db->escape($_POST['country_name'])},
               nationality={$this->db->escape($_POST['nationality'])}
			   where country_id=$country_id";
        return $this->db->query($sql);
    }

    function type_for_options($sel='') {
        $rows=array('STUDENT_TYPE','EMPLOYMENT_TYPE','EMPLOYMENT_NATURE','SALARY_TYPE','SECTION','SUBJECT_ATTEMPT','SUBJECT_TYPE','STD_ATTENDANCE','NOTICE_TYPE','PAY_MOOD');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function status_for_options($sel='') {
        $rows=array('STUDENT_STATUS','STAFFS_STATUS','CLASS_STATUS','SESSION_STATUS','SUBJECT_STATUS','REPORT_STATUS');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }

    function pay_details_for_options($sel='') {
        $rows=array('STUDENT_PAYMENT','STAFF_PAYMENT','EXPENSE_PAYMENT');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function pay_effect_options($sel='') {
        $rows=array('None','Credit','Debit');
        $opt.="<option value=''>----Select----</option>";
        foreach($rows as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function save_pay_details() {
        $sql="insert into payment_details set
                details_name={$this->db->escape($_POST['details_name'])},
                pay_details_for={$this->db->escape($_POST['pay_details_for'])},
                pay_effect={$this->db->escape($_POST['pay_effect'])}
                ";
        return $this->db->query($sql);
    }
    function update_pay_details() {
        $pay_details_id=$this->session->userdata('pay_details_id');
        $sql="update payment_details set
                details_name={$this->db->escape($_POST['details_name'])},
                pay_details_for={$this->db->escape($_POST['pay_details_for'])},
                pay_effect={$this->db->escape($_POST['pay_effect'])}
				where pay_details_id=$pay_details_id
                ";
        return $this->db->query($sql);
    }




    function get_report_status(){

        $sortname = common::getVar('sidx', 'report_status');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from report_status_mark $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('report_status_mark');
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

        $sql_query=$this->db->query($sql." limit $start, $limit");
        $rows=$sql_query->result_array();

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $responce->rows[$i]['id']=$row['report_status_mark_id'];
            $responce->rows[$i]['cell']=array($row['report_status'],$row['mark']);
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
    function save_report_status() {
        $data=array(
            "report_status"=>$_POST['report_status'],
            "mark"=>$_POST['mark']
        );
        return $this->db->insert("report_status_mark",$data);
    }
    function update_report_status() {
        $report_status_mark_id=$this->session->userdata('report_status_mark_id');
        $data=array(
            "report_status"=>$_POST['report_status'],
            "mark"=>$_POST['mark']
        );
        return $this->db->update("report_status_mark",$data,array("report_status_mark_id"=>$report_status_mark_id));
    }
}?>