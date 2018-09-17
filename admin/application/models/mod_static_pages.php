<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_static_pages
 *
 * @author Anwar
 */
class mod_static_pages extends Model {

    function __construct() {
        parent::Model();
    }

    function get_page_grid() {
        $sortname = common::getVar('sidx', 'page_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql = "select * from wb_static_pages where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('wb_static_pages', $con);
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
            $status = $row[status] == 1 ? 'Active' : 'Inactive';
            $responce->rows[$i]['id'] = $row['page_id'];
            $responce->rows[$i]['cell'] = array($row['page_name'], $row['page_title'], $status);
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

    function save_page() {
        write_file(FRONT_END . "views/static/" . $_POST['page_name'] . ".php", $_POST['page_des'], "w+");
        $sql = "insert into wb_static_pages set
                    page_name={$this->db->escape($_POST['page_name'])},
                    page_title={$this->db->escape($_POST['page_title'])}";
        return $this->db->query($sql);
    }

    function update_page($page_id=''){
        //$page_id=  $this->session->userdata('edit_page_id');
        $data=sql::row('wb_static_pages',"page_id='$page_id'");
        if($data['page_name']!=$_POST['page_name']){
            @unlink(FRONT_END . "views/static/" . $data['page_name'] . '.php');
        }
        write_file(FRONT_END . "views/static/" . $_POST['page_name'] . ".php", $_POST['page_des'], "w+");
        $sql = "update wb_static_pages set
                    page_name={$this->db->escape($_POST['page_name'])},
                    page_title={$this->db->escape($_POST['page_title'])}
                    where page_id='$page_id'";
        return $this->db->query($sql);
    }

}
?>
