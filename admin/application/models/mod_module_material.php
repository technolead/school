<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_module_material
 *
 * @author Anwar
 */
class mod_module_material extends Model {
    function __construct() {
        parent::Model();
    }

    function get_student_material($limit='') {
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select mm.*,m.module_name, concat(t.first_name,' ',t.last_name) as teacher_name from module_material as mm
                               join reg_module as mr on mr.module_id=mm.module_id
                               join module as m on m.module_id=mm.module_id
                               join staffs as t on t.staffs_id=mm.staffs_id
                               where mr.student_id=$student_id and mm.valid_until>=CURDATE() order by mm.posted_date desc");
        return $sql->result_array();
    }
    function get_material_details($module_material_id) {
        $sql=$this->db->query("select mm.*,m.module_name, concat(t.first_name,' ',t.last_name) as teacher_name from module_material as mm
                               join module as m on m.module_id=mm.module_id
                               join staffs as t on t.staffs_id=mm.staffs_id
                               where mm.module_material_id=$module_material_id");
        return $sql->row_array();
    }
    function get_staff_material($limit='') {
        $staffs_id=$this->session->userdata('logged_staffs_id');
        $sql=$this->db->query("select mm.*,m.module_name,m.module_code from module_material as mm
                                join module as m on m.module_id=mm.module_id
                                where mm.staffs_id=$staffs_id $limit");
        return $sql->result_array();
    }
    function get_staff_module_options($sel='',$staffs_id='') {
        if($staffs_id=='') {
            $staffs_id=$this->session->userdata('logged_staffs_id');
        }
        $sql=$this->db->query("select m.module_name,am.module_id from module_distribution as am
                                 join module as m on m.module_id=am.module_id
                                where am.staffs_id=$staffs_id");
        $modules=$sql->result_array();
        $opt="<option value=''>--Select Subject--</option>";
        if(count($modules)>0) {
            foreach($modules as $m) {
                if($m['module_id']==$sel) {
                    $opt.="<option value='$m[module_id]' selected='selected'>$m[module_name]</option>";
                }else {
                    $opt.="<option value='$m[module_id]'>$m[module_name]</option>";
                }
            }
        }
        return $opt;
    }
    function save_module_material() {
        $staffs_id=$this->session->userdata('logged_staffs_id');
        $lecture_file='';
        $file_name='';
        if($_FILES['lecture_file']['name']!='') {
            $lecture_file=$this->add_lecture_file();
            $file_name=$this->db->escape($_FILES['lecture_file']['name']);
        }
        $sql="insert into module_material set
                staffs_id={$this->db->escape($staffs_id)},
                module_id={$this->db->escape($_POST['module_id'])},
                lecture_notes={$this->db->escape($_POST['lecture_notes'])},
                lecture_file={$this->db->escape($lecture_file)},
                file_name={$file_name},
                posted_date={$this->db->escape($_POST['posted_date'])},
                valid_until={$this->db->escape($_POST['valid_until'])}
                ";
        return $this->db->query($sql);
    }
    function add_lecture_file($pre_file="") {
        $file_name="";
        $param['dir']=UPLOAD_PATH."materials/";
        $param['type']=DOC_EXT;
        $this->load->library('zupload',$param);
        if($pre_file!="") {
            $this->zupload->delFile($pre_file);
        }
        $this->zupload->setFileInputName("lecture_file");
        $this->zupload->upload(true);
        $file_name=$this->zupload->getOutputFileName();

        return $file_name;
    }

    function update_module_material() {
        $lecture_file=$_POST['h_lecture_file'];
        $file_name=$this->db->escape($_POST['h_file_name']);
        if($_FILES['lecture_file']['name']!='') {
            $lecture_file=$this->add_lecture_file($_POST['h_lecture_file']);
            $file_name=$this->db->escape($_FILES['lecture_file']['name']);
        }
        $module_material_id=$this->session->userdata('module_material_id');
        $sql="update module_material set
		module_id={$this->db->escape($_POST['module_id'])},
                lecture_notes={$this->db->escape($_POST['lecture_notes'])},
                lecture_file={$this->db->escape($lecture_file)},
                file_name={$file_name},
                posted_date={$this->db->escape($_POST['posted_date'])},
                valid_until={$this->db->escape($_POST['valid_until'])}
                where module_material_id=$module_material_id
                ";
        return $this->db->query($sql);
    }
    function get_module_material($limit='') {
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and s.institution_id=$institution_id";
        }
        $sql=$this->db->query("select mm.*,m.module_name,m.module_code,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from module_material as mm
                                join module as m on m.module_id=mm.module_id
                                join staffs as s on s.staffs_id=mm.staffs_id
                                where 1=1 $ins_con $limit");
        return $sql->result_array();
    }
    function filter_material() {
        $ins_con='1=1';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con="s.institution_id=$institution_id";
        }
        $con='';
        if($_POST['posted_date']!='') {
            $con.=" and mm.posted_date like '{$_POST['posted_date']}'";
        }
        if($_POST['valid_until']!='') {
            $con.=" and mm.valid_until like '{$_POST['valid_until']}'";
        }
        if($_POST['staffs_id']!='') {
            $con.=" and mm.staffs_id = '{$_POST['staffs_id']}'";
        }

        if($_POST['module_id']!='') {
            $con.=" and mm.module_id like '{$_POST['module_id']}'";
        }
        $sql=$this->db->query("select mm.*,m.module_name,m.module_code,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from module_material as mm
                                join module as m on m.module_id=mm.module_id
                                join staffs as s on s.staffs_id=mm.staffs_id
                                where $ins_con $con");
        return $sql->result_array();
    }
    function get_module_material_row($module_material_id='') {
        $sql=$this->db->query("select mm.*,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from module_material as mm
                                join staffs as s on s.staffs_id=mm.staffs_id
                                where mm.module_material_id=$module_material_id $limit");
        return $sql->row_array();
    }
}
?>
