<?php 
/**
 * Description of mod_specialization
 *
 * @author anwar
 */

class mod_specialization extends Model {
    function mod_specialization() {
        parent::Model();
    }
    function get_specializationGrid() {
        $sortname = common::getVar('sidx', 'specialization');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from specialization where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('specialization','1=1');
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
            $responce->rows[$i]['id']=$row['specialization_id'];
            $responce->rows[$i]['cell']=array($row['specialization_name'],$status);
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
    function save_specialization() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into specialization set
				specialization_name={$this->db->escape($_POST['specialization_name'])}";
        return $this->db->query($sql);
    }
    function update_specialization() {
        $specialization_id=$this->session->userdata('specialization_id');
        $sql="update specialization set
				specialization_name={$this->db->escape($_POST['specialization_name'])}
				where specialization_id=$specialization_id";
        return $this->db->query($sql);
    }
    function delete_specialization($specialization_id) {
        $sql="delete from specialization where specialization_id=$specialization_id";
        return $this->db->query($sql);
    }
}?>