<?php

/**
 * Description of mod_class
 *
 * @author anwar
 */
class mod_classes extends Model {

    function mod_classes() {
        parent::Model();
    }

    function get_all_class($limit='') {
        $sql = $this->db->query("select c.*,u.user_name,u.first_name,u.last_name from class as c
                                join user as u on u.user_id=p.user_id where 1=1 order by c.class_name $limit");
        return $sql->result_array();
    }

    function get_classGrid() {
        $sortname = common::getVar('sidx', 'class_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql = "select c.*,u.user_name,concat(u.last_name,' ',u.first_name) as inputed_by from class as c
                                join user as u on u.user_id=c.user_id where 1=1 $sort";


        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('class', '1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id'] = $row['class_id'];
            $responce->rows[$i]['cell'] = array($row['class_name'], $row['class_code'], $row['inputed_by'], $status);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mahjabeen");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_class_details($id) {
        $sql = $this->db->query("select * from class where class_id = $id");
        return $sql->row_array();
    }

    function save_class() {
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into class set
			class_code={$this->db->escape($_POST['class_code'])},
			class_name={$this->db->escape($_POST['class_name'])},
			user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }

    function update_class() {
        $class_id = $this->session->userdata('class_id');
        $sql = "update class set
				class_code={$this->db->escape($_POST['class_code'])},
                                class_name={$this->db->escape($_POST['class_name'])}
				where class_id=$class_id";
        return $this->db->query($sql);
    }

    function get_all_mapping($con, $limit='') {
        $sql = $this->db->query("select cm.*,c.class_name,a.awarding_body_name,s.specialization_name from class_map as cm
                                join class as c on c.class_id=cm.class_id
                                join awarding_body as a on a.awarding_body_id=cm.awarding_body_id
                                join specialization as s on s.specialization_id=cm.specialization_id
                                where $con $limit");
        return $sql->result_array();
    }

    function get_classMapGrid($session_id='') {
        $sortname = common::getVar('sidx', 'class_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        if ($session_id == 'all' || $session_id == '' || !is_numeric($session_id)) {
            $con = '1=1';
        } else {
            $con = "cm.session_id=$session_id";
        }
        $sql = "select cm.*,c.class_name,s.session_name from class_map as cm
                join class as c on c.class_id=cm.class_id                
                join session as s on s.session_id=cm.session_id where $con $sort";


        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('class_map', '1=1');
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
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $staff = sql::row("staffs", "staffs_id=$row[staff_id]");
            $responce->rows[$i]['id'] = $row['class_map_id'];
            $responce->rows[$i]['cell'] = array($row['session_name'], $row['class_name'], $row['start_date'], $row['end_date'], $row['class_fee'], $row['monthly_fee'], $staff['first_name'] . " " . $staff['last_name'], $status);
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
        $user_id = $this->session->userdata('user_id');
        $exam_id = '';
        if (count($_POST['exam_id']) > 0) {
            $exam_id = implode(',', $_POST['exam_id']);
        }

        $sql = "insert into class_map set
                        session_id={$this->db->escape($_POST['session_id'])},
			class_id={$this->db->escape($_POST['class_id'])},
			class_duration={$this->db->escape($_POST['class_duration'])},
                        start_date={$this->db->escape($_POST['start_date'])},
                        end_date={$this->db->escape($_POST['end_date'])},
			class_fee={$this->db->escape($_POST['class_fee'])},
                        monthly_fee={$this->db->escape($_POST['monthly_fee'])},
                        staff_id={$this->db->escape($_POST['staff_id'])},
                        exam_id={$this->db->escape($exam_id)},
			user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
        $class_map_id = $this->db->insert_id();
    }

    function update_mapping() {
        $class_map_id = $this->session->userdata('class_map_id');

        $exam_id = '';
        if (count($_POST['exam_id']) > 0) {
            $exam_id = implode(',', $_POST['exam_id']);
        }

        $sql = "update class_map set
                        session_id={$this->db->escape($_POST['session_id'])},
			class_id={$this->db->escape($_POST['class_id'])},
			class_duration={$this->db->escape($_POST['class_duration'])},
                        start_date={$this->db->escape($_POST['start_date'])},
                        end_date={$this->db->escape($_POST['end_date'])},
			class_fee={$this->db->escape($_POST['class_fee'])},
                        monthly_fee={$this->db->escape($_POST['monthly_fee'])},
                        staff_id={$this->db->escape($_POST['staff_id'])},
                        exam_id={$this->db->escape($exam_id)}
			where class_map_id=$class_map_id";
        return $this->db->query($sql);
    }

    function get_lavel_modules($levels_id) {
        if ($levels_id != '') {
            $sql = $this->db->query("select m.* from module as m
                                    join module_map as mp on mp.module_id=m.module_id
                                    where mp.levels_id=$levels_id");
            return $sql->result_array();
        }
    }

    function delete_class($class_id) {
        $sql = "delete from class where class_id=$class_id";
        return $this->db->query($sql);
    }

    function get_examGrid() {
        $sortname = common::getVar('sidx', 'exam_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql = "select e.*,u.user_name,concat(u.last_name,' ',u.first_name) as inputed_by from exam as e
                                join user as u on u.user_id=e.user_id where 1=1 $sort";


        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('exam', '1=1');
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

            $responce->rows[$i]['id'] = $row['exam_id'];
            $responce->rows[$i]['cell'] = array($row['exam_name'], $row['exam_fee'], $row['inputed_by']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mahjabeen");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function save_exam() {
        $user_id = $this->session->userdata('user_id');
        $sql = "insert into exam set
			exam_name={$this->db->escape($_POST['exam_name'])},
                        exam_fee={$this->db->escape($_POST['exam_fee'])},
			user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }

    function update_exam() {
        $exam_id = $this->session->userdata('exam_id');
        $sql = "update exam set exam_name={$this->db->escape($_POST['exam_name'])},
              exam_fee={$this->db->escape($_POST['exam_fee'])}
              where exam_id=$exam_id";
        return $this->db->query($sql);
    }

    function get_routineGrid() {
        $sortname = common::getVar('sidx', 'c.class_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql = "select cr.*,u.user_name,concat(u.last_name,' ',u.first_name) as inputed_by,
                cm.class_duration,s.session_name,c.class_name
                from class_routine as cr
                join user as u on u.user_id=cr.user_id
                join class_map as cm on cr.class_map_id=cm.class_map_id
                join session as s on s.session_id=cm.session_id
                join class as c on cm.class_id=c.class_id
                where 1=1 $sort";



        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('class_routine', '1=1');
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

            $print_href = "<a href='#print_view' rel='" . site_url('classes/print_routine') . "/" . $row['class_routine_id'] . "' class=' print_view' >Print View</a>";
            $responce->rows[$i]['id'] = $row['class_routine_id'];
            $responce->rows[$i]['cell'] = array($row['session_name'], $row['class_name'], $row['inputed_by'], $print_href);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author: Mahjabeen");
        header("Email: anwarworld@gmail.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    function get_class_routine($class_routine_id) {
        $sql = $this->db->query("select cr.*,cm.class_duration,
                               s.session_name,c.class_id,c.class_name
                               from class_routine as cr
                               join user as u on u.user_id=cr.user_id
                               join class_map as cm on cr.class_map_id=cm.class_map_id
                               join session as s on s.session_id=cm.session_id
                               join class as c on cm.class_id=c.class_id
                               where cr.class_routine_id=$class_routine_id");

        return $sql->row_array();
    }

    function save_class_routine() {
        $user_id = $this->session->userdata('user_id');
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $data = array(
            "class_map_id" => $class_map_id,
            "section" => $_POST['section'],
            "user_id" => $user_id
        );
        $this->db->insert("class_routine", $data);
        return $this->db->insert_id();
    }

    function save_routine_details() {
        
        $class_routine_id = $this->session->userdata('class_routine_id');
        $user_id = $this->session->userdata('user_id');
        foreach ($_POST['day'] as $day) {
            for ($i = 0; $i < 8; $i++) {
                $period = $_POST['period_' . $day . "_" . $i];
                $time = $_POST['time_' . $day . "_" . $i];
                $module_id = $_POST['module_id_' . $day . "_" . $i];
                $staffs_id = $_POST['staffs_id_' . $day . "_" . $i];

                if ($period != '' && $time != '' && $module_id != '' && $staffs_id != '') {
                    $data = array(
                        "class_routine_id" => $class_routine_id,
                        "day" => $day,
                        "period" => $period,
                        "time" => $time,
                        "module_id" => $module_id,
                        "staffs_id" => $staffs_id,
                        "user_id" => $user_id
                    );

                    $this->db->insert("routine_details", $data);
                }
            }
        }
    }


    function get_routine_details($class_routine_id){
        $sql=$this->db->query("select distinct rd.day,rd.class_routine_id,
                               cr.class_map_id,cr.section,
                               cm.class_duration,s.session_name,
                               c.class_id,c.class_name
                               from class_routine as cr
                               join routine_details as rd on cr.class_routine_id=rd.class_routine_id
                               join class_map as cm on cr.class_map_id=cm.class_map_id
                               join session as s on cm.session_id=s.session_id
                               join class as c on cm.class_id=c.class_id                               
                               where rd.class_routine_id=$class_routine_id
                               order by rd.day,rd.period asc");

        

        return $sql->result_array();
    }

}
?>