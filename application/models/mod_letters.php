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
    function get_issued_letters_details($issued_id) {
        $sql=$this->db->query("select l.des,l.letter_title,sl.*,DATE_FORMAT(sl.issue_date,'%M %d, %Y') as issue_date,concat(u.first_name,' ',u.last_name) as issued_by from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join user as u on u.user_id=sl.user_id
                                where sl.student_letters_id=$issued_id");
        return $sql->row_array();
    }
    function issued_letters_data($issued_id) {
        $sql=$this->db->query("select l.des,l.letter_title,sl.*,concat(u.first_name,' ',u.last_name) as issued_by from student_letters as sl
                                join letters as l on l.letters_id=sl.letters_id
                                join user as u on u.user_id=sl.user_id
                                where sl.student_letters_id=$issued_id");
        $letter=$sql->row_array();
        $data=common::get_student_info($letter['student_id']);
        $data['letter']=$letter;
        //print_r($data);
        $msg=$this->load->view('letters/read_letter',$data,TRUE);
        return $msg;
    }
}
?>
