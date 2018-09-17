<?php 
/**
 * Description of mod_awarding_body
 *
 * @author anwar
 */

class mod_awarding_body extends Model {
    function mod_awarding_body() {
        parent::Model();
    }
    function get_gridData() {
        $sortname = common::getVar('sidx', 'awarding_body_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from awarding_body where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('awarding_body','1=1');
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
            $responce->rows[$i]['id']=$row['awarding_body_id'];
            $responce->rows[$i]['cell']=array($row['awarding_body_name'],$status);
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
    function save_awarding_body() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into awarding_body set
				awarding_body_name={$this->db->escape($_POST['awarding_body_name'])}";
        return $this->db->query($sql);
    }
    function update_awarding_body() {
        $awarding_body_id=$this->session->userdata('awarding_body_id');
        $sql="update awarding_body set
				awarding_body_name={$this->db->escape($_POST['awarding_body_name'])}
				where awarding_body_id=$awarding_body_id";
        return $this->db->query($sql);
    }
    function delete_awarding_body($awarding_body_id) {
        $sql="delete from awarding_body where awarding_body_id=$awarding_body_id";
        return $this->db->query($sql);
    }
}?>