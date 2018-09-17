<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_letters
 *
 * @author Anwar
 */
class mod_letters extends Model {
    function __construct() {
        parent::Model();
    }
    function get_student_letters($student_id,$limit='') {
        $sql=$this->db->query("select l.*,concat(s.first_name,' ',s.last_name) as student_name,s.user_name,sl.issue_date,sl.student_letters_id,sl.letter_des,u.first_name,u.last_name from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join student as s on s.student_id=sl.student_id
                                join user as u on u.user_id=sl.user_id
                                where sl.student_id=$student_id order by sl.issue_date desc");
        return $sql->result_array();
    }
    function get_letters_details($letters_id) {
        $sql=$this->db->query("select l.*,sl.issue_date,u.first_name,u.last_name from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join user as u on u.user_id=sl.user_id
                                where sl.letters_id=$letters_id");
        return $sql->row_array();
    }
    function get_letterGrid() {
        $sortname = common::getVar('sidx', 'letter_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select l.*,lt.title as letters_type from letters as l
                                join letters_type as lt on lt.letters_type_id=l.letters_type_id $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('letters','1=1');
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
            $responce->rows[$i]['id']=$row['letters_id'];
            $responce->rows[$i]['cell']=array($row['letters_type'],$row['letter_title'],word_limiter(strip_tags($row['des']),10),$status);
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
    function get_LetterTypeGrid() {
        $sortname = common::getVar('sidx', 'title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from letters_type where 1 $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('letters_type','1=1');
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
            $responce->rows[$i]['id']=$row['letters_type_id'];
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
    function get_letters($limit='') {
        $sql=$this->db->query("select l.*,lt.title as letters_type from letters as l
                                join letters_type as lt on lt.letters_type_id=l.letters_type_id");
        return $sql->result_array();
    }
    function save_letters() {
        $sql="insert into letters set
                letters_type_id={$this->db->escape($_POST['letters_type_id'])},
                letter_title={$this->db->escape($_POST['letter_title'])},
                des={$this->db->escape($_POST['des'])}";
        return $this->db->query($sql);
    }
    function update_letters() {
        $letters_id=$this->session->userdata('letters_id');
        $sql="update letters set
                letters_type_id={$this->db->escape($_POST['letters_type_id'])},
                letter_title={$this->db->escape($_POST['letter_title'])},
                des={$this->db->escape($_POST['des'])}
                where letters_id=$letters_id";
        return $this->db->query($sql);
    }
    function get_letter_type_options($sel='') {
        $sql=$this->db->query("select * from letters_type where status='enabled' order by title");
        $letter_type=$sql->result_array();
        $opt.="<option value=''>Select Letter Type</option>";
        if(count($letter_type)>0) {
            foreach($letter_type as $row) {
                if($row['letters_type_id']==$sel) {
                    $opt.="<option value='$row[letters_type_id]' selected='selected'>$row[title]</option>";
                }else {
                    $opt.="<option value='$row[letters_type_id]'>$row[title]</option>";
                }
            }
        }
        return $opt;
    }
    function save_letters_type() {
        $sql="insert into letters_type set
                title={$this->db->escape($_POST['title'])}";
        return $this->db->query($sql);
    }
    function update_letters_type() {
        $letters_type_id=$this->session->userdata('letters_type_id');
        $sql="update letters_type set
                title={$this->db->escape($_POST['title'])}
                where letters_type_id=$letters_type_id";
        return $this->db->query($sql);
    }
    function get_issued_letters($limit='',$student_id='') {
        $con='1=1';
        if($student_id!='') {
            $con='sl.student_id='.$student_id;
        }

        $sql=$this->db->query("select s.first_name,s.last_name,s.user_name,u.first_name as ufirst_name,u.last_name as ulast_name,l.letter_title,l.des,sl.*,DATE_FORMAT(sl.issue_date,'%M %d, %Y') as issue_date from student_letters as sl
                                join student as s on s.student_id=sl.student_id
				join user as u on u.user_id=sl.user_id
                                join letters as l on l.letters_id=sl.letters_id
				where $con order by sl.issue_date desc $limit");
        return $sql->result_array();
    }
    
    function get_issued_letters_details($issued_id) {
        $sql=$this->db->query("select l.des,l.letter_title,sl.*,DATE_FORMAT(sl.issue_date,'%M %d, %Y') as issue_date,concat(u.first_name,' ',u.last_name) as issued_by from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join user as u on u.user_id=sl.user_id
                                where sl.student_letters_id=$issued_id");
        return $sql->row_array();
    }

    function update_issue_letter() {
        $student_letters_id=$this->session->userdata('student_letters_id');
        $sql="update student_letters set
                issue_date={$this->db->escape($_POST['issue_date'])},
                letter_des={$this->db->escape($_POST['letter_des'])}
                where student_letters_id=$student_letters_id";
        return $this->db->query($sql);
    }
    function get_issueLetterGrid() {
        $sortname = common::getVar('sidx', 'letter_title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
        $con='1';
        $searchField=common::getVar('searchField');
        $searchValue=common::getVar('searchValue');
        if($searchField!='' && $searchValue!='') {
            $con.=' and '.$searchField.' like "%'.$searchValue.'%"';
        }
        $branch_id=  $this->session->userdata('branch_id');
        if($branch_id!=''){
            $con.=" and s.branch_id=$branch_id";
        }
        $sql="select s.first_name,s.last_name,s.user_name,concat(u.first_name,' ',u.last_name) as created_by,l.letter_title,sl.*,DATE_FORMAT(sl.issue_date,'%M %d, %Y') as issue_date from student_letters as sl
                join student as s on s.student_id=sl.student_id
                join user as u on u.user_id=sl.user_id
                join letters as l on l.letters_id=sl.letters_id
                where $con $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $temp=$this->db->query($sql);
        $count = count($temp->result_array());
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
            $responce->rows[$i]['id']=$row['student_letters_id'];
            $href='<a href="#print_view" rel="'.site_url('letters/print_view/'.$row['student_letters_id']).'" class="bold blue print_view" title="Print View">Print View</a>';
            $responce->rows[$i]['cell']=array($row['user_name'],$row['first_name'].' '.$row['last_name'],$row['letter_title'],word_limiter(strip_tags($row['letter_des']),10),$row['created_by'],$row['issue_date'],$href);
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
    function get_issue_search_options($sel='') {
        $arr=array(
                's.user_name'=>'Student ID',
                's.first_name'=>'Student First Name',
                's.last_name'=>'Student Last Name',
                'l.letter_title'=>'Letter Title',
                'sl.letter_des'=>'Letter Description',
                'sl.issue_date'=>'Issue Date'
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


    function get_official_letterGrid() {
        $sortname = common::getVar('sidx', 'title');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

        $sql="select * from official_letter $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('official_letter','1=1');
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

            if($row['letter_url']!=''){
                $description="<a href='".base_url()."uploads/official_letter/".$row['letter_url']."' target='_blank'>".$row['letter_url']."</a>";
            }else{
                $description=word_limiter(strip_tags($row['description']),10);
            }
            
            $responce->rows[$i]['id']=$row['official_letter_id'];
            $responce->rows[$i]['cell']=array($row['title'],$description,$row['issue_date']);
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


    function save_official_letters(){
        $letter_url="";
        if($_POST['letter_insert_type']=="upload" ){
            $letter_url=$this->upload_official_letter();
        }

        $data=array(
            "title"=>$_POST['title'],
            "letter_insert_type"=>$_POST['letter_insert_type'],
            "letter_url"=>$letter_url,
            "description"=>($_POST['description']!='')?$_POST['description']:"",
            "issue_date"=>$_POST['issue_date']
        );

        $this->db->insert("official_letter",$data);
    }

    function update_official_letter(){
        $official_letter_id=$this->session->userdata('official_letter_id');

        $letter_url="";
        if($_POST['letter_insert_type']=="upload"){
            $letter_url=$this->upload_official_letter($_POST['prev_letter_url']);
        }

        $data=array(
            "title"=>$_POST['title'],
            "letter_insert_type"=>$_POST['letter_insert_type'],
            "letter_url"=>$letter_url,
            "description"=>($_POST['description']!='')?$_POST['description']:"",
            "issue_date"=>$_POST['issue_date']
        );

        $this->db->update("official_letter",$data,array("official_letter_id"=>$official_letter_id));

    }

    function upload_official_letter($pre_letter="") {

        $file_name = "";
        $param['dir'] = UPLOAD_PATH . "official_letter/";
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        $this->zupload->setUploadDir($param['dir']);
        if ($pre_letter != "") {
            $this->zupload->delFile($pre_letter);
        }
        $this->zupload->setFileInputName("letter_url");
        $this->zupload->upload(true);
        $file_name = $this->zupload->getOutputFileName();

        return $file_name;
    }


    function delete_official_letter($official_letter_id){


        $row = sql::row('official_letter', 'official_letter_id=' . $official_letter_id, 'letter_url');
        $param['dir'] = UPLOAD_PATH;
        $param['type'] = DOC_EXT;
        $this->load->library('zupload', $param);
        if ($row['letter_url'] != '') {
            $this->zupload->delFile($row['letter_url'], UPLOAD_PATH . '/official_letter');
        }

        sql::delete('official_letter','official_letter_id='.$official_letter_id);
        
    }
}
?>
