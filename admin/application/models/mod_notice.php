<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_notice
 *
 * @author Anwar
 */
class mod_notice extends Model {
    function __construct() {
        parent::Model();
    }
    function get_noticeGrid() {
        $sortname = common::getVar('sidx', 'posted_date');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!='') {
            $con.=' and '.$searchField.' like "%'.$searchValue.'%"';
        }
        $sql="select u.first_name,u.last_name,n.* from notice as n
                join user as u on u.user_id=n.user_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('notice','1=1');
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
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        

        foreach($rows as $row) {
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['notice_id'];
            $href='<a href="'.site_url('notice/details/'.$row['notice_id'].'/'.url_title($row['notice_title'])).'" class="bold blue">'.$row['notice_title'].'</a>';
            $responce->rows[$i]['cell']=array($href,$row['posted_to'],word_limiter(strip_tags($row['des']),10),$row[priority],$row[notice_type],$row[valid_until],$row[posted_date],$status);
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
    function get_notice_search_options($sel='') {
        $arr=array(
                'n.notice_title'=>'Notice Title',
                'n.des'=>'Notice Details',
                'n.notice_type'=>'Notice Type',
                'n.priority'=>'Notice Priority',
                'n.valid_until'=>'Valid Date',
                'n.posted_date'=>'Posted Date',
                'n.posted_to'=>'Posted To'
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
    function get_all_notice($limit='') {

        $sql=$this->db->query("select u.first_name,u.last_name,n.* from notice as n
                                join user as u on u.user_id=n.user_id
                                where 1 order by posted_date desc $limit");
        return $sql->result_array();
    }

    function get_notice_details($notice_id) {
        $sql=$this->db->query("select u.first_name,u.last_name,n.* from notice as n
                                join user as u on u.user_id=n.user_id
                                where notice_id=$notice_id");
        return $sql->row_array();
    }
    function save_notice() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into notice set
                notice_title={$this->db->escape($_POST['notice_title'])},
                des={$this->db->escape($_POST['des'])},
                posted_to={$this->db->escape($_POST['posted_to'])},
                notice_type={$this->db->escape($_POST['notice_type'])},
                priority={$this->db->escape($_POST['priority'])},
                valid_until={$this->db->escape($_POST['valid_until'])},
                posted_date={$this->db->escape($_POST['posted_date'])},
                user_id=$user_id";
        return $this->db->query($sql);
    }
    function update_notice() {
        $notice_id=$this->session->userdata('notice_id');
        $sql="update notice set
                notice_title={$this->db->escape($_POST['notice_title'])},
                des={$this->db->escape($_POST['des'])},
                posted_to={$this->db->escape($_POST['posted_to'])},
                notice_type={$this->db->escape($_POST['notice_type'])},
                priority={$this->db->escape($_POST['priority'])},
                valid_until={$this->db->escape($_POST['valid_until'])},
                posted_date={$this->db->escape($_POST['posted_date'])}
                where notice_id=$notice_id";
        return $this->db->query($sql);
    }
    function get_posted_to($sel='') {
        $status=array('All','Students','Staffs','Admin User');
        $opt.="<option value=''>----Select----</option>";
        foreach($status as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function get_priority($sel='') {
        $status=array('Normal','Average','Good','Highest');
        $opt.="<option value=''>----Select----</option>";
        foreach($status as $row) {
            if($row==$sel) {
                $opt.="<option value='$row' selected='selected'>$row</option>";
            }else {
                $opt.="<option value='$row'>$row</option>";
            }
        }
        return $opt;
    }
    function get_issued_notice($posted_to='',$limit='') {
        if($posted_to!='') {
            $con=" and (posted_to='All' or posted_to='$posted_to') ";
        }

        $sql=$this->db->query("select u.first_name,u.last_name,n.* from notice as n
                                join user as u on u.user_id=n.user_id
                                where valid_until>=CURDATE() $ins_con $con order by posted_date desc $limit");
        return $sql->result_array();
    }
    function get_staffNoticeGrid() {
        $sortname = common::getVar('sidx', 'posted_date');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $staffs_id=$this->session->userdata('logged_staffs_id');
        
        $con='1';
        if($staffs_id!='') {
            $con="staffs_id='$staffs_id'";
        }
        
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!='') {
            $con.=' and '.$searchField.' like "%'.$searchValue.'%"';
        }
        
        $sql="select n.* from staff_notice as n
                where $con $sort";
        $r=$this->db->query($sql);
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

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
$responce = new stdClass();
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;

        foreach($rows as $row) {
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $posted_to=$row['posted_to']==1? 'Allocated Student':($row['posted_to']==2?$row['std_user_name']:'All Students');
            $responce->rows[$i]['id']=$row['notice_id'];
            $responce->rows[$i]['cell']=array($row['notice_title'],$posted_to,word_limiter(strip_tags($row['des']),10),$row[valid_until],$row[posted_date],$status);
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
    function get_staff_search_options($sel='') {
        $arr=array(
                'n.notice_title'=>'Notice Title',
                'n.des'=>'Notice Details',
                'n.notice_type'=>'Notice Type',
                'n.priority'=>'Notice Priority',
                'n.valid_until'=>'Valid Date',
                'n.posted_date'=>'Posted Date',
                'n.posted_to'=>'Posted To',
                'n.std_user_name'=>'Student ID'
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
    function save_staff_notice() {
        $staffs_id=$this->session->userdata('logged_staffs_id');
        $sql="insert into staff_notice set
                notice_title={$this->db->escape($_POST['notice_title'])},
                des={$this->db->escape($_POST['des'])},
                posted_to={$this->db->escape($_POST['posted_to'])},
                priority={$this->db->escape($_POST['priority'])},
                student_id={$this->db->escape($_POST['student_id'])},
                std_user_name={$this->db->escape($_POST['user_name'])},
                valid_until={$this->db->escape($_POST['valid_until'])},
                posted_date={$this->db->escape($_POST['posted_date'])},
                staffs_id=$staffs_id";
        return $this->db->query($sql);
    }
    function update_staff_notice() {
        $notice_id=$this->session->userdata('notice_id');
        $sql="update staff_notice set
                notice_title={$this->db->escape($_POST['notice_title'])},
                des={$this->db->escape($_POST['des'])},
                posted_to={$this->db->escape($_POST['posted_to'])},
                priority={$this->db->escape($_POST['priority'])},
                student_id={$this->db->escape($_POST['student_id'])},
                std_user_name={$this->db->escape($_POST['user_name'])},
                valid_until={$this->db->escape($_POST['valid_until'])},
                posted_date={$this->db->escape($_POST['posted_date'])}
                where notice_id=$notice_id";
        return $this->db->query($sql);
    }
    function get_staff_issued_notice($student_id='') {
        if($student_id!='') {
            $con=" and (posted_to='3' or student_id='$student_id') ";
            $staff=sql::row('view_std_reg',"student_id='$student_id'",'staff_id');
            if($staff['staffs_id']!='') {
                $con=" or (posted_to='2' and n.staffs_id='{$staff['staffs_id']}') ";
            }
        }

        $sql=$this->db->query("select s.first_name,s.last_name,n.* from staff_notice as n
                                join staffs as s on s.staffs_id=n.staffs_id
                                where valid_until>=CURDATE() and n.status='enabled' $con order by posted_date desc $limit");
        return $sql->result_array();
    }
    function get_staff_notice_details($notice_id='') {
        $sql=$this->db->query("select s.first_name,s.last_name,n.* from staff_notice as n
                                join staffs as s on s.staffs_id=n.staffs_id
                                where notice_id='$notice_id'");
        return $sql->row_array();
    }
}
?>
