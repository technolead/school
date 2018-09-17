<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_staff_attd
 *
 * @author Anwar
 */
class mod_staff_attd extends Model {

    function  __construct() {
        parent::Model();
    }
    function get_staffs_details($staffs_id='') {
        if($staffs_id=='') {
            return '';
        }
        $sql=$this->db->query("select s.*,c.*,d.name as department_name,s.staffs_id from staffs as s
                                    join staff_department as d on d.staff_department_id=s.department_id
                                    left join staff_contract as c on c.staffs_id=s.staffs_id
                                    where s.staffs_id=$staffs_id");
        return $sql->row_array();
    }
    function save_attendance() {
        $staffs_id=$this->session->userdata('sel_staffs_id');
        $user_id=$this->session->userdata('user_id');
        $attendance=$_POST['attendance'];
        $present=0;
        $absent=0;
        $sick=0;
        $holiday=0;
        $excuse=0;
        if($attendance==1) {
            $present=1;
        }else if($attendance==0) {
            $absent=1;
        }else if($attendance==2) {
            $sick=1;
        }else if($attendance==3) {
            $holiday=1;
        }
        $sql="insert into staffs_attendance set
                staffs_id=$staffs_id,
                date={$this->db->escape($_POST['date'])},
                present=$present,
                absent=$absent,
                sick=$sick,
                holiday=$holiday,
                hours={$_POST['hours']},
                extra_hour={$_POST['extra_hour']},
                absent_hour={$_POST['absent_hour']},
                late={$_POST['late']},
		authorize='{$_POST['authorize']}',
                comments={$this->db->escape($_POST['comments'])},
                user_id=$user_id
                ";
        return $this->db->query($sql);
    }
    function update_attendance() {
        $attendance_id=$this->session->userdata('attendance_id');
        $attendance=$_POST['attendance'];
        $present=0;
        $absent=0;
        $sick=0;
        $holiday=0;
        $excuse=0;
        if($attendance==1) {
            $present=1;
        }else if($attendance==0) {
            $absent=1;
        }else if($attendance==2) {
            $sick=1;
        }else if($attendance==3) {
            $holiday=1;
        }
        $sql="update staffs_attendance set
                date={$this->db->escape($_POST['date'])},
                present=$present,
                absent=$absent,
                sick=$sick,
                holiday=$holiday,
                hours={$_POST['hours']},
                extra_hour={$_POST['extra_hour']},
                absent_hour={$_POST['absent_hour']},
                late={$_POST['late']},
		authorize='{$_POST['authorize']}',
                comments={$this->db->escape($_POST['comments'])}
                where attendance_id=$attendance_id
                ";
        return $this->db->query($sql);
    }
    function get_total_attendance($staffs_id) {
        $data['month']=$this->session->userdata('sel_month');
        $data['year']=$this->session->userdata('sel_year');

        $con='';
        if($data['month']!=''&& $data['year']!='') {
            $date=$data['year'].'-'.$data['month'];
            $con=" and DATE_FORMAT(date,'%Y-%m')='$date'";
        }else if($data['month']!='') {
            $date=$data['month'];
            $con=" and MONTH(date)='$date'";
        }
        $sql=$this->db->query("select sum(present) as tot_present, sum(absent) as tot_absent,sum(sick) as tot_sick,sum(holiday) as tot_holiday,sum(excuse) as tot_excuse,sum(hours) as tot_hours, sum(extra_hour) as tot_extra_hour,sum(absent_hour) as tot_absent_hour,sum(late) as tot_late from staffs_attendance
				where staffs_id=$staffs_id $con group by staffs_id");
        return $sql->row_array();
    }
    function get_attendance($limit='') {

        $sql=$this->db->query("select a.*,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from staffs_attendance as a
                                join staffs as s on s.staffs_id=a.staffs_id
                                where 1=1 $limit");
        return $sql->result_array();
    }
    
    function get_attendance_grid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        
        $con='1';
        $user_name=common::getVar('user_name');
        $name=common::getVar('name');
        $staff_status=common::getVar('staff_status');
        $from_date=common::getVar('from_date');
        $to_date=common::getVar('to_date');
        $branch_id=  $this->session->userdata('branch_id');

        if($user_name!='') {
            $con.=" and s.user_name like '%{$user_name}%'";
        }
        if($name!='') {
            $con.=" and (first_name = '%$name%' or last_name = '%$name%')";
        }
        if($staff_status!='') {
            $con.=" and staff_status like '$staff_status'";
        }
        if($from_date!='') {
            $con.=" and a.date >= '$from_date'";
        }

        if($to_date!='') {
            $con.=" and a.date <= '$to_date'";
        }
        if($branch_id!=''){
            $con.=" and s.branch_id=$branch_id";
        }

        $sql="select a.*,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from staffs_attendance as a
                                join staffs as s on s.staffs_id=a.staffs_id
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
            $href='<a href="'.site_url('staff_attd/manage_attendance/'.$row['staffs_id']).'" class="bold blue">'.$row['staff_name'].'</a>';
            $responce->rows[$i]['id']=$row['attendance_id'];
            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['date'],$row['present'],$row['absent'],$row['sick'],$row['holiday'],$row['hours'],$row['extra_hour'],$row['absent_hour'],$row['late'],$row['authorize'],$row['comments']);
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
    function get_staffs_attendance($staffs_id='',$limit='') {
        if($staffs_id=='') {
            redirect('staffs/view_attendance');
        }
        $from_date=$this->session->userdata('sel_from_date');
        $to_date=$this->session->userdata('sel_to_date');
        $month=$this->session->userdata('sel_month');
        $year=$this->session->userdata('sel_year');

        $con='';
        if($from_date!='') {
            $con=" and date >= '$from_date'";
        }
        if($to_date!='') {
            $con.=" and date <= '$to_date'";
        }
        if($month!=''&& $year!='') {
            $date=$year.'-'.$month;
            $con=" and DATE_FORMAT(date,'%Y-%m')='$date'";
        }else if($month!='') {
            $date=$month;
            $con=" and MONTH(date)='$date'";
        }
        $sql=$this->db->query("select * from staffs_attendance where staffs_id=$staffs_id $con order by date $limit");
        return $sql->result_array();
    }
    function get_authorize($sel='') {
        $arr=array('None','Yes','No');
        $opt="<option value=''>--Select--</option>";
        foreach($arr as $val) {
            if($val==$sel) $opt.="<option value='$val' selected='selected'>$val</option>";
            else $opt.="<option value='$val'>$val</option>";
        }
        return $opt;
    }
}
?>
