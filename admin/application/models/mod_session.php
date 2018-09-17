<?php 
/**
 * Description of mod_session
 *
 * @author anwar
 */

class mod_session extends Model {
    function mod_session() {
        parent::Model();
    }
    function get_sessionGrid() {
        $sortname = common::getVar('sidx', 'session_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

//        $query = common::getVar('query');
//        $qtype = common::getVar('qtype');

        $where = "1=1";
//        if ($query)
//        $where = " $qtype LIKE '%$query%' ";

        $sql="select s.* from session as s where $where $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('session','1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['session_id'];
            $responce->rows[$i]['cell']=array($row['session_name'],$status);
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
    function save_session() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into session set
			session_name={$this->db->escape($_POST['session_name'])}";
        return $this->db->query($sql);
    }
    function update_session() {
        $session_id=$this->session->userdata('edit_session_id');
        $sql="update session set
                session_name={$this->db->escape($_POST['session_name'])}
                where session_id=$session_id";
        return $this->db->query($sql);
    }
    function delete_session($session_id) {
        $sql="delete from session where session_id=$session_id";
        return $this->db->query($sql);
    }
    function get_session_mapping($con,$limit='') {
        $sql=$this->db->query("select sm.*,s.session_name,c.class_name,a.awarding_body_name from session_map as sm
                                    join session as s on s.session_id=sm.session_id
                                    join class as c on c.class_id=sm.class_id
                                    join awarding_body as a on a.awarding_body_id=sm.awarding_body_id
                                    where $con $limit");
        return $sql->result_array();
    }
    function get_sessionMapGrid($session_id='all') {
        $sortname = common::getVar('sidx', 'session_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        if($session_id=='all'||$session_id==''||!is_numeric($session_id)) {
            $con='1=1';
        }else {
            $con="sm.session_id=$session_id";
        }
        $sql="select sm.*,s.session_name,c.class_name,a.awarding_body_name from session_map as sm
                join session as s on s.session_id=sm.session_id
                join class as c on c.class_id=sm.class_id
                join awarding_body as a on a.awarding_body_id=sm.awarding_body_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('session_map','1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['session_map_id'];
            $responce->rows[$i]['cell']=array($row['awarding_body_name'],$row['class_name'],$row['session_name'],$row['session_duration'],$row['start_date'],$row['end_date'],$status);
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
    function save_mapping() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into session_map set
                awarding_body_id={$this->db->escape($_POST['awarding_body_id'])},
                class_id={$this->db->escape($_POST['class_id'])},
                session_id={$this->db->escape($_POST['session_id'])},
                session_duration={$this->db->escape($_POST['session_duration'])},
                start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])},
                user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function update_mapping() {
        $session_map_id=$this->session->userdata('session_map_id');
        $sql="update session_map set
                awarding_body_id={$this->db->escape($_POST['awarding_body_id'])},
                class_id={$this->db->escape($_POST['class_id'])},
                session_id={$this->db->escape($_POST['session_id'])},
                session_duration={$this->db->escape($_POST['session_duration'])},
                start_date={$this->db->escape($_POST['start_date'])},
                end_date={$this->db->escape($_POST['end_date'])}
                where session_map_id=$session_map_id";
        return $this->db->query($sql);
    }
}?>