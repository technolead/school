<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_notice
 *
 * @author Anwar
 */
class mod_notice extends Model {
    function __construct() {
        parent::Model();
    }
    function get_notice_details($notice_id) {
        $sql=$this->db->query("select u.first_name,u.last_name,n.* from notice as n
                                join user as u on u.user_id=n.user_id
                                where notice_id=$notice_id");
        return $sql->row_array();
    }
    function get_staff_notice_details($notice_id='') {
        $sql=$this->db->query("select s.first_name,s.last_name,n.* from staff_notice as n
                                join staffs as s on s.staffs_id=n.staffs_id
                                where notice_id='$notice_id'");
        return $sql->row_array();
    }
}
?>
