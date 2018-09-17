<?php 
/**
 * Description of mod_levels
 *
 * @author anwar
 */

class mod_levels extends Model {
    function mod_levels() {
        parent::Model();
    }
    function get_levelGrid() {
        $sortname = common::getVar('sidx', 'specialization');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        
        $sql="select l.*,u.user_name,concat(u.last_name,' ',u.first_name) as inputed_by from levels as l
                                join user as u on u.user_id=l.user_id where 1=1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('levels','1=1');
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
            $responce->rows[$i]['id']=$row['levels_id'];
            $responce->rows[$i]['cell']=array($row['level_name'],$row['level_code'],$row['inputed_by'],$status);
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
    function get_levels_details($id) {
        $sql=$this->db->query("select l.*,p.program_code,p.program_name from levels as l
				join programs as p on p.programs_id=l.programs_id where l.levels_id= $id");
        return $sql->row_array();
    }

    function save_levels() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into levels set
				level_code={$this->db->escape($_POST['level_code'])},
				level_name={$this->db->escape($_POST['level_name'])},
				user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function update_levels() {
        $levels_id=$this->session->userdata('levels_id');
        $sql="update levels set
				level_code={$this->db->escape($_POST['level_code'])},
				level_name={$this->db->escape($_POST['level_name'])}
				where levels_id=$levels_id";
        return $this->db->query($sql);
    }
    function delete_levels($levels_id) {
        $sql="delete from levels where levels_id=$levels_id";
        return $this->db->query($sql);
    }
    function get_levelMapGrid($programs_id=''){
        $sortname = common::getVar('sidx', 'specialization');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
         if($programs_id=='all'||$programs_id==''||!is_numeric($programs_id)) {
            $con='1=1';
        }else {
            $con="lm.programs_id=$programs_id";
        }
        $sql="select lm.*,l.level_name,p.program_name,a.awarding_body_name,s.specialization_name from level_map as lm
                join levels as l on l.levels_id=lm.levels_id
                join programs as p on p.programs_id=lm.programs_id
                join awarding_body as a on a.awarding_body_id=lm.awarding_body_id
                join specialization as s on s.specialization_id=lm.specialization_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('level_map','1=1');
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
            $responce->rows[$i]['id']=$row['level_map_id'];
            $responce->rows[$i]['cell']=array($row['awarding_body_name'],$row['program_name'],$row['specialization_name'],$row['level_name'],$row['level_duration'],$row['level_fee'],$status);
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
    function get_all_mapping($con,$limit='') {
        $sql=$this->db->query("select lm.*,l.level_name,p.program_name,a.awarding_body_name,s.specialization_name from level_map as lm
								join levels as l on l.levels_id=lm.levels_id
								join programs as p on p.programs_id=lm.programs_id
								join awarding_body as a on a.awarding_body_id=lm.awarding_body_id
								join specialization as s on s.specialization_id=lm.specialization_id
								where $con $limit");
        return $sql->result_array();
    }
    function save_mapping() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into level_map set
				awarding_body_id={$this->db->escape($_POST['awarding_body_id'])},
				programs_id={$this->db->escape($_POST['programs_id'])},
				specialization_id={$this->db->escape($_POST['specialization_id'])},
				levels_id={$this->db->escape($_POST['levels_id'])},
				level_duration={$this->db->escape($_POST['level_duration'])},
				level_fee={$this->db->escape($_POST['level_fee'])},
				user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function update_mapping() {
        $level_map_id=$this->session->userdata('level_map_id');
        $sql="update level_map set
				awarding_body_id={$this->db->escape($_POST['awarding_body_id'])},
				programs_id={$this->db->escape($_POST['programs_id'])},
				specialization_id={$this->db->escape($_POST['specialization_id'])},
				levels_id={$this->db->escape($_POST['levels_id'])},
				level_duration={$this->db->escape($_POST['level_duration'])},
				level_fee={$this->db->escape($_POST['level_fee'])}
				where level_map_id=$level_map_id";
        return $this->db->query($sql);
    }
}?>