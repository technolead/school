<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_content
 *
 * @author Anwar
 */
class mod_content extends Model {
    function __construct() {
        parent::Model();
    }
    function get_contentGrid() {
        $sortname = common::getVar('sidx', 'content_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select c.*,m.menu_title from wb_content as c
              join wb_menus as m on m.menu_id=c.menu_id  $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_content','1=1');
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
            $responce->rows[$i]['id']=$row['content_id'];
            $responce->rows[$i]['cell']=array($row['menu_title'],$row['content_title'],$row['content_date'],$status);
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
    function get_menuGrid() {
        $sortname = common::getVar('sidx', 'parent_id');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from wb_menus where parent_id=0 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_menus','parent_id=0');
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
            $responce->rows[$i]['id']=$row['menu_id'];
            $responce->rows[$i]['cell']=array($row['menu_name'],$row['menu_title'],$status);
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
    function get_submenuGrid() {
        $sortname = common::getVar('sidx', 'menu_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from wb_menus where parent_id!=0 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        
        $count = sql::count('wb_menus','parent_id!=0');
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
            $parent=sql::row('wb_menus',"menu_id='{$row['menu_id']}'",'menu_title');
            $responce->rows[$i]['id']=$row['menu_id'];
            $responce->rows[$i]['cell']=array($parent['menu_title'],$row['menu_name'],$row['menu_title'],$status);
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
    function get_menu_options($sub=false,$sel='') {
        $sql=$this->db->query("select * from wb_menus where parent_id=0 and status='1' order by menu_name");
        $categories=$sql->result_array();
        $opt.="<option value=''>Select Menu</option>";
        if(count($categories)>0) {
            foreach($categories as $row) {
                if($row['menu_id']==$sel) {
                    $opt.="<option value='$row[menu_id]' selected='selected'>$row[menu_title]</option>";
                }else {
                    $opt.="<option value='$row[menu_id]'>$row[menu_title]</option>";
                }
                if($sub) {
                    $opt.=$this->get_sub_menu($row['menu_id'], $sel);
                }
            }
        }
        return $opt;
    }
    function get_sub_menu($parent_id,$sel='') {
        $sql=$this->db->query("select * from wb_menus where parent_id=$parent_id and  status='1' order by menu_name");
        $categories=$sql->result_array();
        if(count($categories)>0) {
            foreach($categories as $row) {
                if($row['menu_id']==$sel) {
                    $opt.="<option value='$row[menu_id]' selected='selected' style='padding-left:15px;'>&raquo;&raquo;&nbsp;$row[menu_title]</option>";
                }else {
                    $opt.="<option value='$row[menu_id]' style='padding-left:15px;'>&raquo;&raquo;&nbsp;$row[menu_title]</option>";
                }
            }
        }
        return $opt;
    }
    function get_page_imageGrid() {
        $sortname = common::getVar('sidx', 'image_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select p.*,m.menu_title from wb_page_image as p
              join wb_menus as m on m.menu_id=p.menu_id where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_page_image','1');
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
            $responce->rows[$i]['id']=$row['image_id'];
            $img='<img src="'.$this->config->item('front_url').'uploads/page_image/'.$row[image].'" width="60" />';
            $responce->rows[$i]['cell']=array($row['menu_title'],$row['image_title'],$img,$status);
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
        $param['dir']=FRONT_UPLOAD_PATH."page_image/";
        $param['type']="jpg,png,gif";

        if(class_exists('zupload')) {
            $this->zupload->setUploadDir(FRONT_UPLOAD_PATH.'page_image/');
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

        return $img;
    }
    function get_right_contentGrid() {
        $sortname = common::getVar('sidx', 'title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select p.*,m.menu_title from wb_right_content as p
              join wb_menus as m on m.menu_id=p.menu_id where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;

        $count = sql::count('wb_right_content','1');
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
            $responce->rows[$i]['id']=$row['right_content_id'];
            $img='<img src="'.$this->config->item('front_url').'uploads/right_content/'.$row[image].'" width="60" />';
            $responce->rows[$i]['cell']=array($row['menu_title'],$row['title'],$row['des'],$img,$status);
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
    function add_right_image($pre_image='') {
        $param['dir']=FRONT_UPLOAD_PATH."right_content/";
        $param['type']="jpg,png,gif";

        if(class_exists('zupload')) {
            $this->zupload->setUploadDir(FRONT_UPLOAD_PATH.'right_content/');
        } else {
            $this->load->library('zupload',$param);
        }

        if($pre_image!="") {
            $this->zupload->delFile($pre_image);
        }
        $this->zupload->setFileInputName('image');
        $this->zupload->upload(true);
        $img=$this->zupload->getOutputFileName();

        return $img;
    }


    function add_logo($pre_image='') {
        $param['dir']=FRONT_UPLOAD_PATH."site_logo/";
        $param['type']="jpg,png,gif";

        if(class_exists('zupload')) {
            $this->zupload->setUploadDir(FRONT_UPLOAD_PATH.'site_logo/');
        } else {
            $this->load->library('zupload',$param);
        }

        if($pre_image!="") {
            $this->zupload->delFile($pre_image);
            $this->zupload->delFile("n".$pre_image);
        }
        $this->zupload->setFileInputName('logo');
        $this->zupload->upload(true);
        $img=$this->zupload->getOutputFileName();

        return $img;
    }
}
?>
