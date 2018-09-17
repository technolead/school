<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_news
 *
 * @author Anwar
 */
class mod_news extends Model {
    function __construct() {
        parent::Model();
    }
    function get_newsGrid() {
        $sortname = common::getVar('sidx', 'news_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
         $con='1';
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!='') {
            $con.=' and '.$searchField.' like "%'.$searchValue.'%"';
        }
        $sql="select l.*,lt.title as category_name from wb_news as l
              join wb_event_category as lt on lt.category_id=l.category_id
              where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_news','1=1');
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
            $status = $row[status] == '1' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['news_id'];
            $responce->rows[$i]['cell']=array($row['category_name'],$row['news_title'],$row['news_date'],$status);
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
    function get_search_options($sel='') {
        $arr=array(
                'l.news_title'=>'News Title',
                'l.news_des'=>'News Details',
                'l.news_date'=>'News Date',
                'lt.title'=>'Category Name'
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
    function get_categoryGrid() {
        $sortname = common::getVar('sidx', 'title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from wb_event_category where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_event_category','1=1');
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
            $status = $row[status] == '1' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['category_id'];
            $responce->rows[$i]['cell']=array($row['title'],$status);
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

    function get_category_options($sel='') {
        $sql=$this->db->query("select * from wb_event_category where status='1' order by title");
        $categories=$sql->result_array();
        $opt.="<option value=''>Select Letter Type</option>";
        if(count($categories)>0) {
            foreach($categories as $row) {
                if($row['category_id']==$sel) {
                    $opt.="<option value='$row[category_id]' selected='selected'>$row[title]</option>";
                }else {
                    $opt.="<option value='$row[category_id]'>$row[title]</option>";
                }
            }
        }
        return $opt;
    }

    function add_image($pre_image='') {
        $param['dir']=FRONT_UPLOAD_PATH."news/";
        $param['type']="jpg,png,gif";

        if(class_exists('zupload')) {
            $this->zupload->setUploadDir(FRONT_UPLOAD_PATH.'news/');
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
        if(!class_exists('zthumb')) {
            $this->load->library('zthumb');
        }

        $this->zthumb->createThumb($img,"270_230_".$img,$param['dir'],$param['dir'],270,230,true);
        return $img;
    }
}
?>
