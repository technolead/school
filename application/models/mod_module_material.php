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
    function get_module_material_row($module_material_id='') {
        $sql=$this->db->query("select mm.*,concat(s.first_name,' ',s.last_name) as staff_name,s.user_name from module_material as mm
                                join staffs as s on s.staffs_id=mm.staffs_id
                                where mm.module_material_id=$module_material_id $limit");
        return $sql->row_array();
    }
}
?>
