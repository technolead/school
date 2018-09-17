<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_alert
 *
 * @author Anwar
 */
class mod_alert extends Model {
    function  __construct() {
        parent::Model();
    }
    function get_attendance_alert($limit='') {
        $sql=$this->db->query("SELECT distinct(s.student_id),rp.student_name,s.mobile,s.phone,s.user_name,rp.class_name,sc.absent,sc.from_date,sc.to_date,
                (sum(sa.present))/(sum(total_class)-sum(sa.total_leave))*100 as percentage FROM student as s
                join view_std_reg as rp on rp.student_id=s.student_id and is_recent=1 and rp.class_status=1
                join `view_std_attd` as sa on sa.student_id=s.student_id and sa.class_map_id=rp.class_map_id
                join std_con_absent as sc on sc.student_id=s.student_id and sc.is_recent=1 and sc.class_map_id=sa.class_map_id
                WHERE rp.student_status like 'Active' and rp.is_recent=1 and sc.absent>=3 group by student_id $limit");
        return $sql->result_array();
    }
    function get_pass_visa_alert() {
        $sql="select rp.class_id,rp.class_name,rp.student_name,s.mobile,s.student_id,s.user_name,s.passport_expiry,s.visa_expiry,s.entry_to_uk,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day
                from student as s
                left join view_std_reg as rp on rp.student_id=s.student_id and rp.is_recent=1
                where rp.student_status like 'Active' and (DATEDIFF(s.passport_expiry,CURDATE())<=45 or DATEDIFF(s.visa_expiry,CURDATE())<=45) order by s.user_name";
        $sql_query=$this->db->query($sql);
        return $sql_query->result_array();
    }
    function get_studentGrid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select rp.class_id,rp.class_name,rp.student_name,s.mobile,s.student_id,s.user_name,s.passport_expiry,s.visa_expiry,s.entry_to_uk,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day
                from student as s
                left join view_std_reg as rp on rp.student_id=s.student_id and rp.is_recent=1
                where rp.student_status like 'Active' and (DATEDIFF(s.passport_expiry,CURDATE())<=45 or DATEDIFF(s.visa_expiry,CURDATE())<=45) $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $r=$this->db->query($sql);
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
            $responce->rows[$i]['id']=$row['student_id'];
            $href="<a href='".site_url('student/student_class/'.$row[student_id])."' class='bold blue'>{$row['student_name']}</a>";
            if($row['pass_day'] < 0)
                $passport_expiry="<span class='dead_color' title='Passport Expiry Before {$row['pass_day']}'>$row[passport_expiry]</span>";
            else if($row['pass_day']<=45 && $row[passport_expiry]!='0000-00-00')
                $passport_expiry="<span class='passport_color' title='Passport Expiry After {$row['pass_day']}'>$row[passport_expiry]</span>";
            else
                $passport_expiry=$row['passport_expiry'];

            if($row['visa_day'] < 0)
                $visa="<span class='dead_color' title='Visa Expiry Before {$row['visa_day']}'>$row[visa_expiry]</span>";
            else if($row['visa_day']<=45 && $row[visa_expiry]!='0000-00-00')
                $visa="<span class='visa_color' title='Visa Expiry After {$row['visa_day']}'>$row[visa_expiry]</span>";
            else
                $visa=$row['visa_expiry'];

            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['class_name'],$passport_expiry,$visa,$row['mobile']);
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

    function get_attd_search_options($sel='') {
        $arr=array(
                's.user_name'=>'Student ID',
                's.first_name'=>'First Name',
                's.last_name'=>'Last Name',
                'rp.class_name'=>'Class Name',
                'sc.absent'=>'Continues miss'
        );

        $opt='<option value="">Select Search Key</option>';
        foreach($arr as $key=>$val) {
            if($key==$sel) {
                $opt.="<option value='$key' selected='selected'>$val</option>";
            }else {
                $opt.="<option value='$key'>$val</option>";
            }
        }
        return $opt;
    }

    function get_attendanceGrid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        //$con='1';
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!='') {
            $con=' and '.$searchField.' like "%'.$searchValue.'%"';
        }

        $branch_id=  $this->session->userdata('branch_id');
        if($branch_id!=''){
            $con.=" and s.branch_id=$branch_id";
        }

        $sql="SELECT distinct(s.student_id),rp.student_name,s.mobile,s.phone,s.user_name,rp.class_name,sc.absent,sc.from_date,sc.to_date,
                (sum(sa.present))/(sum(total_class)-sum(sa.total_leave))*100 as percentage FROM student as s
                join view_std_reg as rp on rp.student_id=s.student_id and is_recent=1 and rp.class_status=1
                join `view_std_attd` as sa on sa.student_id=s.student_id and sa.class_map_id=rp.class_map_id
                join std_con_absent as sc on sc.student_id=s.student_id and sc.is_recent=1 and sc.class_map_id=sa.class_map_id
                WHERE rp.student_status like 'Active' and rp.is_recent=1 and sc.absent>=3 $con and s.is_delete=0 group by student_id $sort";

        //debug::writeLog($sql);
        
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $r=$this->db->query($sql);
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
            if(sql::count('exemption',"student_id=$row[student_id]")>0) {
                $exemption='<a href="'.site_url("?c=attendance&m=exemption&student_id=$row[student_id]").'&height=200&width=300" title="Exemption ['.$row['student_name'].']" class="thickbox">Yes</a>';
            }
            else {
                $exemption= 'No';
            }


            $percentage='<span class="block pad_10 '.common::get_color_code($row['percentage']).'">'.$row['percentage'].'</span>';
            $absent='<span class="block pad_10 '.common::get_attd_status_view($row['absent']).'">'.$row['absent'].'</span>';

            $responce->rows[$i]['id']=$row['student_id'];
            $href="<a href='".site_url('student/student_class/'.$row[student_id])."' class='bold blue'>{$row['student_name']}</a>";
            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['class_name'],$absent,$percentage,$row['mobile'],$exemption);
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

    function staff_visa_passport_alert($limit='') {
        $sql=$this->db->query("select s.staffs_id,s.user_name,s.first_name,s.last_name,s.passport_expiry,s.visa_expiry,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day,s.designation,d.name as department_name from staffs as s
                join staff_department as d on d.staff_department_id=s.department_id
                left join staff_contact as c on c.staffs_id=s.staffs_id
                where DATEDIFF(s.passport_expiry,CURDATE())<=45 or DATEDIFF(s.visa_expiry,CURDATE())<=45");
        return $sql->result_array();
    }

    function get_staffGrid() {
        $sortname = common::getVar('sidx', 'user_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select s.staffs_id,s.user_name,s.first_name,s.last_name,s.passport_expiry,s.visa_expiry,DATEDIFF(s.passport_expiry,CURDATE()) as pass_day,DATEDIFF(s.visa_expiry,CURDATE()) as visa_day,s.designation,d.name as department_name from staffs as s
                join staff_department as d on d.staff_department_id=s.department_id
                left join staff_contact as c on c.staffs_id=s.staffs_id
                where DATEDIFF(s.passport_expiry,CURDATE())<=45 or DATEDIFF(s.visa_expiry,CURDATE())<=45 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $r=$this->db->query($sql);
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
            $responce->rows[$i]['id']=$row['staffs_id'];
            $href="<a href='".site_url('staffs/profile/'.$row[staffs_id])."' class='bold blue'>{$row['first_name']} {$row['last_name']}</a>";
            $responce->rows[$i]['cell']=array($row['user_name'],$href,$row['designation'],$row['department_name'],$row['passport_expiry'],$row[visa_expiry]);
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
}
?>