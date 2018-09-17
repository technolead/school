<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_student
 *
 * @author Anwar
 */
class mod_student extends Model {
    function  __construct() {
        parent::Model();
    }
    function update_std_profile() {
        $student_id=$this->session->userdata('logged_student_id');
        $sql="update student set
        present_address={$this->db->escape($_POST['present_address'])},
        permanent_address={$this->db->escape($_POST['permanent_address'])},
        phone={$this->db->escape($_POST['phone'])},
        mobile={$this->db->escape($_POST['mobile'])},
        email={$this->db->escape($_POST['email'])}
        where student_id=$student_id";
        return $this->db->query($sql);
    }
    function get_student_info($student_id='') {
        if($student_id=='') {
            $student_id=$this->session->userdata('logged_student_id');
        }
        $sql=$this->db->query("select s.* from student as s where s.student_id='$student_id'");
        return $sql->row_array();
    }

    function get_registered_class($student_id) {
        $sql=$this->db->query("select rc.reg_class_id,rc.class_status,
                                rc.class_status_date,rc.privilege,cm.*,
                                c.class_name ,s.session_name
                                from reg_class as rc join class_map as cm on cm.class_map_id=rc.class_map_id				
                                join class as c on c.class_id=cm.class_id
                                join session as s on s.session_id=cm.session_id
                                where rc.student_id=$student_id");
        return $sql->result_array();
    }
    function get_registered_levels($student_id) {
        $sql=$this->db->query("select rl.reg_level_id,rl.level_start_date,rl.level_end_date,rl.level_extd_date,rl.level_status,rl.level_status_date,l.level_code,l.level_name from reg_level as rl
                                    join levels as l on l.levels_id=rl.levels_id
                                    where rl.student_id=$student_id");
        return $sql->result_array();
    }
    function get_registered_session($student_id) {
        $sql=$this->db->query("select distinct(rs.reg_session_id),rs.session_id,rs.student_id,rs.reg_session_id,rs.session_status,rs.session_status_date,s.session_name,sm.start_date,sm.end_date,concat(sf.first_name,' ',sf.last_name) as tutor_name from reg_session as rs
                                    join session as s on s.session_id=rs.session_id
                                    join session_map as sm on sm.session_id=rs.session_id
                                    left join staffs as sf on sf.staffs_id=rs.staffs_id
                                    where rs.student_id=$student_id and rs.class_id=sm.class_id");
        return $sql->result_array();
    }
    function get_registered_modules($student_id,$session_id='') {
        $con='';
        if($session_id!='') {
            $con=" and rm.session_id=$session_id";
        }

        $sql=$this->db->query("select m.module_code,m.module_name,m.is_compulsary,
                                    rm.module_id,rm.module_status,rm.module_attempt,rm.reg_module_id
                                    from reg_module as rm join module as m on m.module_id=rm.module_id
                                    where rm.student_id=$student_id $con");
        return $sql->result_array();
    }

    function get_issued_notice($posted_to='',$limit='') {
        if($posted_to!='') {
            $con=" and (posted_to='All' or posted_to='$posted_to') ";
        }

        $sql=$this->db->query("select u.first_name,u.last_name,n.* from notice as n
                                join user as u on u.user_id=n.user_id
                                where valid_until>=CURDATE() $ins_con $con order by posted_date desc $limit");
        return $sql->result_array();
    }
    function get_staff_issued_notice($student_id='') {
        if($student_id!='') {
            $con=" and (posted_to='3' or student_id='$student_id') ";
            $staff=sql::row('view_std_reg',"student_id='$student_id'",'staff_id');
            if($staff['staffs_id']!='') {
                $con=" or (posted_to='2' and n.staffs_id='{$staff['staff_id']}') ";
            }
        }

        $sql=$this->db->query("select s.first_name,s.last_name,n.* from staff_notice as n
                                join staffs as s on s.staffs_id=n.staffs_id
                                where valid_until>=CURDATE() and n.status='enabled' $con order by posted_date desc $limit");
        return $sql->result_array();
    }
    function confirm_password() {
        $status='enabled';
        $password=md5($_POST['old_password']);
        $user_id=$this->session->userdata('user_id');
        $sql = "SELECT * FROM user WHERE user_id = ? AND password = ? and status= ?";
        $query=$this->db->query($sql, array($user_id, $password,$status));
        if($query->num_rows()>0) {
            return true;
        }else {
            return false;
        }
    }
    function do_update_password() {
        $password=md5($_POST['new_password']);
        $user_id=$this->session->userdata('user_id');
        $sql="update user
                set password={$this->db->escape($password)}
                where user_id=$user_id";
        return $this->db->query($sql);
    }
    function get_installments() {
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select p.class_name,fi.* from std_fee_installment as fi
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as p on p.class_id=cf.class_id
                where cf.student_id=$student_id");
        return $sql->result_array();
    }
     function get_payments() {
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select p.class_name,fi.committed_date,d.details_name,sp.* from std_payments as sp
                join std_fee_installment as fi on fi.installment_id=sp.installment_id
                join std_class_fee as cf on cf.class_fee_id=fi.class_fee_id
                join class as p on p.class_id=cf.class_id
                left join payment_details as d on d.pay_details_id=sp.pay_details_id
                where cf.student_id=$student_id");
        return $sql->result_array();
    }
    function get_paid_amount($installment_id,$payments_id='') {
        $con='';
        if($payments_id!='') {
            $con=" and payments_id<$payments_id";
        }
        $amount=0;
        $sql=$this->db->query("select sum(paid_amount) as amount from std_payments where installment_id=$installment_id $con");
        $data=$sql->row_array();
        if($data['amount']!='') {
            $amount=$data['amount'];
        }
        return $amount;
    }

    function get_admission_fee(){
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select af.*,raf.admission_fee,cm.class_id,c.class_name,
                                s.session_name,rc.privilege from std_admission_fee as af
                                join admission_fee_register as raf on af.admission_fee_register_id=raf.admission_fee_register_id
                                join class_map as cm on raf.class_map_id=cm.class_map_id                                
                                join class as c on c.class_id=cm.class_id
                                join session as s on s.session_id=cm.session_id
                                join reg_class as rc on rc.student_id=af.student_id
                                where af.student_id=$student_id");
        return $sql->result_array();

    }


    function get_exam_fee(){
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select ef.*,efr.exam_fee,e.exam_name from std_exam_fee as ef
                                join exam_fee_register as efr on ef.exam_fee_register_id=efr.exam_fee_register_id
                                join exam as e on e.exam_id=efr.exam_id
                                where ef.student_id=$student_id");
        return $sql->result_array();

    }

    function get_monthly_fee(){
        $student_id=$this->session->userdata('logged_student_id');
        $sql=$this->db->query("select cf.*,rcf.month,rcf.monthly_fee,rc.privilege
                                from std_class_fee as cf 
                                join class_fee_register as rcf on rcf.class_fee_register_id=cf.class_fee_register_id
                                join reg_class as rc on rc.student_id=cf.student_id
                                where cf.student_id=$student_id");
        return $sql->result_array();

    }


    function get_additional_fee() {

        $student_id=$this->session->userdata('logged_student_id');
        $sql = $this->db->query("select af.*,raf.description
                                from std_additional_fee as af join additional_fee_register as raf
                                on raf.additional_fee_register_id=af.additional_fee_register_id
                                where af.student_id=$student_id order by raf.description");
        return $sql->result_array();
    }


   function get_student_progress_report($student_id) {
        $sql=$this->db->query("select s.*,pr.final_grade,pr.final_grade_point,
                                pr.attendance,pr.report_id,e.exam_name,
                                u.first_name,u.last_name from progress_report as pr
                                join view_std_reg as s on s.student_id=pr.student_id
                                join exam as e on e.exam_id=pr.exam_id
                                join user as u on u.user_id=pr.user_id
                                where pr.student_id=$student_id order by pr.report_id desc $limit");
        return $sql->result_array();
    }


    function get_std_modules_result($student_id) {
        $sql=$this->db->query("select distinct(m.module_id),mr.*,m.module_code,m.module_name from module_result as mr
                                join module as m on m.module_id=mr.module_id
                                join module_map as mm on mm.module_id=mr.module_id
                                where mr.student_id=$student_id");
        return $sql->result_array();
    }

    function get_reg_module_result($class_map_id='', $session_id='',$exam_id='') {
        $student_id = $this->session->userdata('sel_student_id');
        $con = '';

        if($class_map_id!=''){
            $con.=" and mr.class_map_id=$class_map_id";
        }

        if($exam_id!=''){
            $con.=" and mr.exam_id=$exam_id";
        }

        if ($session_id != '') {
            $con.=" and rm.session_id=$session_id";
        }
        $sql = $this->db->query("select distinct(m.module_id),m.module_name,m.module_code,
                                mr.*,e.exam_name
                                from reg_module as rm
                                join module as m on m.module_id=rm.module_id
                                join module_map as mp on mp.module_id=m.module_id
                                left join module_result as mr on (mr.student_id=rm.student_id and mr.module_id=rm.module_id)
                                join exam as e on mr.exam_id=e.exam_id
                                where rm.student_id=$student_id $con order by m.module_name");


        return $sql->result_array();
    }

    
    function get_attendance_percentage($student_id, $class_map_id) {
        $sql = $this->db->query("SELECT (sum( sa.attendance ) + sum( sa.leave_excuse )) AS present, sum( sa.leave_excuse ) AS total_leave,
                                (count( ca.class_attendance_id )-(sum( sa.attendance )+sum(sa.leave_excuse))) as absent,
                                count( ca.class_attendance_id ) AS total_class
                                FROM `std_attendance` AS sa
                                JOIN class_attendance AS ca ON ca.class_attendance_id = sa.class_attendance_id
                                WHERE sa.student_id=$student_id and ca.class_map_id=$class_map_id group by sa.student_id,ca.class_map_id");

        return $sql->row_array();
    }
}
?>
