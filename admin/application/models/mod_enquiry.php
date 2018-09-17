<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_enquiry
 *
 * @author Anwar
 */
class mod_enquiry extends Model {
    function __construct() {
        parent::Model();
    }

    function get_all_enquiry($limit='') {
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and n.institution_id=$institution_id";
        }
        $sql=$this->db->query("select u.first_name,u.last_name,n.*,concat(lf.first_name,' ',lf.last_name) as look_for,DATE_FORMAT(n.date,'%M %d, %Y') as date,concat(s.first_name,' ',s.last_name) as staff_name,d.name as department,concat(a.first_name,' ',a.last_name) as agent_name from enquiry as n
                                join user as u on u.user_id=n.user_id
                                join staffs as lf on lf.staffs_id=n.look_for
                                left join staffs as s on s.staffs_id=n.staffs_id
                                left join staff_department as d on d.staff_department_id=n.department_id
                                left join agents as a on a.agents_id=n.agents_id
                                where 1=1 $ins_con order by date desc $limit");
        return $sql->result_array();
    }
    function get_search_enquiry() {
        $ins_con='';
        $institution_id=$this->session->userdata('institution_id');
        if($institution_id!='' && is_numeric($institution_id)) {
            $ins_con.=" and n.institution_id=$institution_id";
        }
        $sql=$this->db->query("select u.first_name,u.last_name,n.*,concat(lf.first_name,' ',lf.last_name) as look_for,DATE_FORMAT(n.date,'%M %d, %Y') as date,concat(s.first_name,' ',s.last_name) as staff_name,d.name as department,concat(a.first_name,' ',a.last_name) as agent_name from enquiry as n
                                join user as u on u.user_id=n.user_id
                                join staffs as lf on lf.staffs_id=n.look_for
                                left join staffs as s on s.staffs_id=n.staffs_id
                                left join staff_department as d on d.staff_department_id=n.department_id
                                left join agents as a on a.agents_id=n.agents_id
                                where DATE_FORMAT(n.date,'%Y-%m-%d')>='{$_POST['from_date']}' and DATE_FORMAT(n.date,'%Y-%m-%d')<='{$_POST['to_date']}' and look_for='{$_POST['look_for']}' $ins_con order by date desc");
        return $sql->result_array();
    }
    function get_enquiry_details($enquiry_id) {
        $sql=$this->db->query("select u.first_name,u.last_name,n.*,concat(lf.first_name,' ',lf.last_name) as look_for,DATE_FORMAT(n.date,'%M %d, %Y') as date,concat(s.first_name,' ',s.last_name) as staff_name,d.name as department,concat(a.first_name,' ',a.last_name) as agent_name from enquiry as n
                                join user as u on u.user_id=n.user_id
                                join staffs as lf on lf.staffs_id=n.look_for
                                left join staffs as s on s.staffs_id=n.staffs_id
                                left join staff_department as d on d.staff_department_id=n.department_id
                                left join agents as a on a.agents_id=n.agents_id
                                where enquiry_id=$enquiry_id");
        return $sql->row_array();
    }
    function save_enquiry() {
        $user_id=$this->session->userdata('user_id');
        $institution_id=$this->session->userdata('institution_id');
        $sql="insert into enquiry set
                name={$this->db->escape($_POST['name'])},
                organisation={$this->db->escape($_POST['organisation'])},
                messages={$this->db->escape($_POST['messages'])},
                look_for={$this->db->escape($_POST['look_for'])},
                telephone={$this->db->escape($_POST['telephone'])},
                email={$this->db->escape($_POST['email'])},
                comments={$this->db->escape($_POST['comments'])},
		staffs_id={$this->db->escape($_POST['staffs_id'])},
                department_id={$this->db->escape($_POST['department_id'])},
                agents_id={$this->db->escape($_POST['agents_id'])},
                institution_id=$institution_id,
                user_id=$user_id";
        return $this->db->query($sql);
    }
    function update_enquiry() {
        $enquiry_id=$this->session->userdata('enquiry_id');
        $sql="update enquiry set
                name={$this->db->escape($_POST['name'])},
                organisation={$this->db->escape($_POST['organisation'])},
                messages={$this->db->escape($_POST['messages'])},
                look_for={$this->db->escape($_POST['look_for'])},
                telephone={$this->db->escape($_POST['telephone'])},
                email={$this->db->escape($_POST['email'])},
                comments={$this->db->escape($_POST['comments'])},
		staffs_id={$this->db->escape($_POST['staffs_id'])},
                department_id={$this->db->escape($_POST['department_id'])},
                agents_id={$this->db->escape($_POST['agents_id'])}
                where enquiry_id=$enquiry_id";
        return $this->db->query($sql);
    }
    function get_enquiry_msg($staffs_id='',$agents_id='') {
        $con='1!=1';
        if($staffs_id!='') {
            $st_info=sql::row('staffs',"staffs_id=$staffs_id",'department_id');
            $con="n.status='enabled' and (n.staffs_id=$staffs_id or n.department_id=$st_info[department_id])";
        }

        if($agents_id!=''){
            $con="n.status='enabled' and n.agents_id=$agents_id";
        }
        $sql=$this->db->query("select u.first_name,u.last_name,n.*,concat(lf.first_name,' ',lf.last_name) as look_for,DATE_FORMAT(n.date,'%M %d, %Y') as date from enquiry as n
                                join user as u on u.user_id=n.user_id
                                join staffs as lf on lf.staffs_id=n.look_for
                                join staffs as s on s.staffs_id=n.staffs_id
                                where $con order by n.date desc $limit");
        return $sql->result_array();
    }
}
?>
