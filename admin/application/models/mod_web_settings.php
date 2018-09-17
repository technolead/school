<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_web_settings
 *
 * @author Anwar
 */
class mod_web_settings extends Model {
    function __construct() {
        parent::Model();
    }
    function get_linkGrid() {
        $sortname = common::getVar('sidx', 'link_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from wb_useful_link where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('wb_useful_link','1=1');
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
            $status = $row[status] == '1' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['link_id'];
            $responce->rows[$i]['cell']=array($row['link_title'],$row['link_url'],$status);
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

     function get_featuredGrid() {
        $sortname = common::getVar('sidx', 'featured_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from wb_featured_box where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('wb_featured_box','1=1');
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
            $status = $row[status] == '1' ? 'Enabled' : 'Disabled';
            $img="<img src='".$this->config->item('front_url')."uploads/featured/".$row['featured_image']."' width='60' />";
            $responce->rows[$i]['id']=$row['featured_id'];
            $responce->rows[$i]['cell']=array($row['featured_title'],$row['featured_url'],$img,$status);
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

    function add_image($pre_image='') {
        $param['dir']=FRONT_UPLOAD_PATH."featured/";
        $param['type']="jpg,png,gif";

        if(class_exists('zupload')) {
            $this->zupload->setUploadDir(FRONT_UPLOAD_PATH.'featured/');
        } else {
            $this->load->library('zupload',$param);
        }

        if($pre_image!="") {
            $this->zupload->delFile($pre_image);
            $this->zupload->delFile("n".$pre_image);
        }
        $this->zupload->setFileInputName('image');
        $this->zupload->upload(true);
        $img=$this->zupload->getOutputFileName();
        
//        if(!class_exists('zthumb')) {
//            $this->load->library('zthumb');
//        }
//        $this->zthumb->createThumb($img,"270_230_".$img,$param['dir'],$param['dir'],270,230,true);
        return $img;
    }
    function get_links_opt($sel=''){
        if(is_array($sel)){
            $sel_array=$sel;
        }else{
            $sel_array=explode('#', $sel);
        }
        
        $rows=sql::rows('wb_useful_link','status=1');
        if(count($rows)>0){
            foreach($rows as $row){
                if(in_array($row['link_id'], $sel_array)){
                    $opt.='<option value="'.$row['link_id'].'" selected="selected">'.$row['link_title'].'</option>';
                }else{
                    $opt.='<option value="'.$row['link_id'].'">'.$row['link_title'].'</option>';
                }
            }
        }
        return $opt;
    }
}
?>