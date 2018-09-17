<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mod_print_attendance
 *
 * @author Anwar
 */
class mod_print_attendance extends Model {
    function  __construct() {
        parent::Model();
    }
    function get_printAttendanceGrid() {
        $sortname = common::getVar('sidx', 'pa.date');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!=''){
            $con.=' and '.$searchField.' like "%'.$searchValue.'%"';
        }
        $sql="select pa.*,m.module_name,c.class_name,s.session_name from print_attendance as pa
                join module as m on m.module_id=pa.module_id
                join class as c on c.class_id=pa.class_id
                join session as s on s.session_id=pa.session_id
                where $con $sort";

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
            $responce->rows[$i]['id']=$row['print_attendance_id'];
            $href='<a href="#print_view" rel="'.site_url('attendance/print_attd_view/'.$row['print_attendance_id']).'" class="print_link print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell']=array($row['class_name'],$row['session_name'],$row['section'],$row['module_name'],$row['date'],$row['attendance_type'],$row['taken_by'],$href);
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
    function get_search_options($sel=''){
        $arr=array(
            'm.module_name'=>'Module Name',
            'c.class_name'=>'Class Name',
            's.session_name'=>'Session Name',
            'pa.section'=>'Section',
            'pa.attendance_type'=>'Class Type',
            'pa.taken_by'=>'Taken By',
            'pa.date'=>'Date'
        );
        
        $opt='<option value="">Select Search Key</option>';
        foreach($arr as $key=>$val){
            if($key==$sel){
                $opt.="<option value='$key' selected='selected'>$val</option>";
            }else{
                $opt.="<option value='$key'>$val</option>";
            }
        }
        return $opt;
    }
}
?>
