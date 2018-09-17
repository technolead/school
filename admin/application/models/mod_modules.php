<?php
/**
 * Description of mod_modules
 *
 * @author anwar
 */

class mod_modules extends Model {
    function mod_modules() {
        parent::Model();
    }

    function get_all_module($limit='') {
        $sql=$this->db->query("select m.*,u.first_name,u.last_name from module as m
				join user as u on u.user_id=m.user_id where 1=1 order by m.module_name $limit");
        return $sql->result_array();
    }
    function get_moduleGrid() {
        $sortname = common::getVar('sidx', 'specialization');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";

//        $query = common::getVar('query');
//        $qtype = common::getVar('qtype');

        $where = "1=1";
//        if ($query)
//        $where = " $qtype LIKE '%$query%' ";

        $sql="select m.*,concat(u.first_name,' ',u.last_name) as inputed_by from module as m
				join user as u on u.user_id=m.user_id where $where $sort";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('module','1=1');
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
            $module_type=($row['is_compulsary']==1)?"Compulsory":"Optional";
            $status = $row[status] == 'enabled' ? 'Enabled' : 'Disabled';
            $responce->rows[$i]['id']=$row['module_id'];
            $responce->rows[$i]['cell']=array($row['module_name'],$row['module_code'],$row['marks'],$module_type,$row['inputed_by'],$status);
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
    function get_module_maps($limit='') {
        $sql=$this->db->query("select map.*,m.module_code,m.module_name,c.class_name,u.first_name,u.last_name from module_map as map
                                join module as m on m.module_id=map.module_id
                                join class as c on c.class_id=map.class_id
                                join user as u on u.user_id=m.user_id where 1=1 order by module_map_id desc $limit");
        return $sql->result_array();
    }
    function get_module_details($id) {
        $sql=$this->db->query("select * from module where module_id = $id");
        return $sql->row_array();
    }

    function save_module() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into module set
                module_code={$this->db->escape($_POST['module_code'])},
                module_name={$this->db->escape($_POST['module_name'])},
                marks={$this->db->escape($_POST['marks'])},
                is_compulsary={$this->db->escape($_POST['module_type'])},
                user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function update_module() {
        $module_id=$this->session->userdata('module_id');
        $sql="update module set
                module_code={$this->db->escape($_POST['module_code'])},
                module_name={$this->db->escape($_POST['module_name'])},
                marks={$this->db->escape($_POST['marks'])},
                is_compulsary={$this->db->escape($_POST['module_type'])}
                where module_id=$module_id";
        return $this->db->query($sql);
    }
    function delete_module($module_id) {
        $sql="delete from module where module_id=$module_id";
        return $this->db->query($sql);
    }
    function get_module_mapping($con,$limit='') {
        $sql=$this->db->query("select mm.*,m.module_name,c.class_name,a.awarding_body_name from module_map as mm
                                join module as m on m.module_id=mm.module_id
                                join class as c on c.class_id=mm.class_id
                                join awarding_body as a on a.awarding_body_id=mm.awarding_body_id
                                where $con $limit");
        return $sql->result_array();
    }
     function get_moduleMapGrid($class_id=''){
        $sortname = common::getVar('sidx', 'class_name');
        $sortorder = common::getVar('sord', 'asc');
        $sort = "ORDER BY $sortname $sortorder";
         if($class_id=='all'||$class_id==''||!is_numeric($class_id)) {
            $con='1=1';
        }else {
            $con="mm.class_id=$class_id";
        }
        $sql="select mm.*,m.module_name,c.class_name from module_map as mm
                join module as m on m.module_id=mm.module_id
                join class as c on c.class_id=mm.class_id                
                where $con $sort";       

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');

        $count = sql::count('module_map','1=1');
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
            $responce->rows[$i]['id']=$row['module_map_id'];
            $responce->rows[$i]['cell']=array($row['class_name'],$row['module_name'],$status);
            
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
    function save_mapping() {
        $user_id=$this->session->userdata('user_id');
        if(count($_POST['module_id'])>0) {
            foreach($_POST['module_id'] as $module_id) {
                $is_compulsary=combo::is_compulsary_module($module_id);
                $sql="insert into module_map set                        
                        class_id={$this->db->escape($_POST['class_id'])},
                        module_id={$this->db->escape($module_id)},
                        is_compulsary=$is_compulsary,
                        user_id={$this->db->escape($user_id)}";
                $flag=$this->db->query($sql);
            }
        }
    }
    function update_mapping() {
        $module_map_id=$this->session->userdata('module_map_id');
        $is_compulsary=combo::is_compulsary_module($_POST['module_id']);
        $sql="update module_map set                
                class_id={$this->db->escape($_POST['class_id'])},
                module_id={$this->db->escape($_POST['module_id'])},
                is_compulsary=$is_compulsary
                where module_map_id=$module_map_id";
        return $this->db->query($sql);
    }
    function save_module_map() {
        $user_id=$this->session->userdata('user_id');
        if(count($_POST['module_id'])>0) {
            foreach($_POST['module_id'] as $module_id) {
                $sql="insert into module_map set
                        levels_id={$this->db->escape($_POST['levels_id'])},
                        module_id=$module_id,
                        user_id=$user_id";
                $this->db->query($sql);
            }
        }
    }
    function update_module_map() {
        $module_map_id=$this->session->userdata('module_map_id');
        $sql="update module_map set
				levels_id={$this->db->escape($_POST['levels_id'])},
				module_id={$this->db->escape($_POST['module_id'])}
				where module_map_id=$module_map_id";
        return $this->db->query($sql);
    }
    /*function get_module_distribution($con,$limit='') {
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and institution_id=$institution_id";
        }
        $sql=$this->db->query("select mm.*,concat(s.first_name,' ',s.last_name) as staff_name,s.designation,s.user_name,m.module_name,p.program_name from module_distribution as mm
                                join module as m on m.module_id=mm.module_id
                                join staffs as s on s.staffs_id=mm.staffs_id
                                join programs as p on p.programs_id=mm.programs_id
                                where $con $ins_con $limit");
        return $sql->result_array();
    }*/
    function get_module_distribution($con,$limit='') {
        
        $branch_id=  $this->session->userdata('branch_id');
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and institution_id=$institution_id";
        }
        if($branch_id!=''){
            $con.=" and s.branch_id=$branch_id";
        }
        $sql=$this->db->query("select mm.*,concat(s.first_name,' ',s.last_name) as staff_name,sd.designation,s.user_name,m.module_name,c.class_name from module_distribution as mm
                                join module as m on m.module_id=mm.module_id
                                join staffs as s on s.staffs_id=mm.staffs_id
                                join staff_designation as sd on s.designation_id=sd.staff_designation_id
                                join class as c on c.class_id=mm.class_id
                                where $con $ins_con $limit");
        
        return $sql->result_array();
    }
    function save_module_distribution() {
        $user_id=$this->session->userdata('user_id');
        if(count($_POST['module_id'])>0) {
            foreach($_POST['module_id'] as $module_id) {
                $sql="insert into module_distribution set
							staffs_id={$_POST['staffs_id']},
							class_id={$this->db->escape($_POST['class_id'])},
							module_id=$module_id,
							user_id=$user_id";
                $this->db->query($sql);
            }
        }
    }
    function update_module_distribution() {
        $distribution_id=$this->session->userdata('distribution_id');
        $sql="update module_distribution set
				staffs_id={$_POST['staffs_id']},
				class_id={$this->db->escape($_POST['class_id'])},
				module_id={$_POST['module_id']}
				where distribution_id=$distribution_id";
        return $this->db->query($sql);
    }
}?>