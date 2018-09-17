<?php
/**
 * Description of common_helper
 *
 * @author anwar
 */
class common {

    public static function redirect() {
        $CI =& get_instance();
        $uri=$CI->session->userdata('cur_uri');
        redirect($uri);
    }

    public static function track_uri() {
        $CI =& get_instance();
        $uri=$CI->uri->uri_string();
        $CI->session->set_userdata('cur_uri',$uri);
    }

    public static function is_logged_in() {
        $CI =& get_instance();
        if($CI->session->userdata('logged_in') && $CI->session->userdata('logged_student_id')!='') {
            return true;
        }else {
            return false;
        }
    }

    public static function is_logged() {
        $CI =& get_instance();
        if(!$CI->session->userdata('logged_in')  || $CI->session->userdata('logged_student_id')=='') {
            redirect('login');
        }
    }

    public static function nav_menu_link($nav_array) {
        $link="<div class='nav_menu'>";
        if(is_array($nav_array)) {
            $link.="<a href='".site_url('home')."'>Home</a> &raquo; ";
            foreach($nav_array as $nav) {
                if($nav[url]!='') {
                    $link.="<a href='".$nav[url]."'>$nav[title]</a> &raquo; ";
                }
                else {
                    $link.="<span class='b'>$nav[title]</span>";
                }
            }
        }
        $link.="</div>";
        return $link;
    }

    public static function get_settings_data() {
        $data=null;
        $rows=sql::rows('settings');
        if(count($rows)>0) {
            foreach($rows as $row) {
                $data[$row['key_flag']]=$row['key_value'];
            }
        }
        return $data;
    }

    public static function sending_mail($from,$from_name,$to,$subject,$msg) {
        $CI=& get_instance();
        $CI->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype']='html';
        $CI->email->initialize($config);

        $CI->email->from($from, $from_name);
        $CI->email->to($to);
        //$CI->email->cc('another@another-example.com');
        $CI->email->subject($subject);
        $CI->email->message($msg);
        $CI->email->send();

        //echo $CI->email->print_debugger();
    }
    public static function get_top_menu_li() {
        $rows=sql::rows('wb_menus',"parent_id=0 and status =1 order by sort");
        foreach ($rows as $row) {
            $link.='<li><a href="'.site_url($row['menu_name']).'">'.$row['menu_title'].'</a></li>';
        }
        return $link;
    }
    public static function get_left_menu_ul($menu_id='') {
        $rows=sql::rows('wb_menus',"parent_id='$menu_id' and status =1 order by sort");
        $link.='<ul>';
        foreach ($rows as $row) {
            $link.='<li><a href="'.site_url($row['menu_name']).'">'.$row['menu_title'].'</a></li>';
        }
        $link.='</ul>';
        return $link;
    }

    public static function get_static_pages_li() {
        $rows=sql::rows('wb_static_pages',"status =1 order by page_sort");
        foreach ($rows as $row) {
            $link.='<li>[ <a href="'.site_url('site/'.$row['page_name']).'">'.$row['page_title'].'</a> ]</li>';
        }
        return $link;
    }

    public static function get_featured_links_ul($link_ids='') {
        $ids=explode('#', $link_ids);
        $rows=sql::rows('wb_useful_link',"status =1 limit 0,4");
        $link.='<ul>';
        foreach ($rows as $row) {
            if(in_array($row['link_id'], $ids)) {
                $link.='<li><a href="'.$row['link_url'].'">'.$row['link_title'].'</a></li>';
            }
        }
        $link.='</ul>';
        return $link;
    }
    public static function get_right_data($parent_id=0,$menu_id='') {
        if($parent_id!=0) {
            $data=sql::rows('wb_right_content',"menu_id=$parent_id");
        }else {
            $data=sql::rows('wb_right_content',"menu_id=$menu_id");
        }
        return $data;
    }

    public static function get_student_info($student_id='') {
        $CI =& get_instance();
        $sql=$CI->db->query("select s.student_id,s.user_name,s.title,s.first_name,s.last_name,s.date_of_birth,
                                s.admission_date,s.present_address,s.email,s.permanent_address,
                                s.mobile,s.nationality,s.phone,
                                cr.class_start_date,cr.class_end_date,c.class_code,c.class_name,
                                cm.class_duration,cm.class_fee,a.awarding_body_name
                                from student as s
                                join reg_class as cr on cr.student_id=s.student_id
                                join class as c on c.class_id=cr.class_id
                                join class_map as cm on cm.class_id=c.class_id
                                join awarding_body as a on a.awarding_body_id=cm.awarding_body_id
                                where s.student_id=$student_id");
        return $sql->row_array();
    }

    public static function get_site_logo(){
        $CI= &get_instance();
        $sql=$CI->db->query("select * from site_logo where site_logo_id=1");
        $res=$sql->row_array();
        return $res['site_logo'];
    }

    public static function get_branch_options($sel=''){

        $opt="<option value=''>Select Branch</option>";
        $branch=sql::rows("branch");
        foreach ($branch as $row):
            if($row['branch_id']==$sel){
              $opt.= "<option value='$row[branch_id]' selected>$row[branch_name]</option>";
            }else{
              $opt.= "<option value='$row[branch_id]'>$row[branch_name]</option>";
            }
        endforeach;

        return $opt;
    }

    public static function get_branch_name($branch_id){
        if($branch_id=='' || !is_numeric($branch_id)){
            redirect();
        }
        $branch=sql::row("branch","branch_id=$branch_id");
        return $branch['branch_name'];
    }

    public static function get_class_module_status_options($sel=''){

        $status=array("1"=>"Continue","2"=>"Complete","3"=>"Terminated");

        $opt = "<option value=''>-- Select --</option>";
        foreach($status as $key=>$val):

            if($key==$sel){
                $opt.= "<option value='$key' selected>$val</option>";
            }else{
                $opt.= "<option value='$key'>$val</option>";
            }
        endforeach;
        return $opt;
    }

    public static function get_class_module_status($sel=''){

        $status=array("1"=>"Continue","2"=>"Complete","3"=>"Terminated");

        foreach($status as $key=>$val):
            if($key==$sel){
                return $val;
            }
        endforeach;
        return;
    }

    public static function get_settings_data_with_flag($key_flag) {

        $row=sql::row('settings',"key_flag='$key_flag'");
        return $row['key_value'];
    }

    public static function get_privilege_name($sel=''){


        $arr = array("0" => "None", "1" => "Full Free", "2" => "Half Free");
        $privilege="";
        foreach ($arr as $key => $val) {
            if ($sel == $key) {
                $privilege=$val;
                return $privilege;
            }
        }
        return $privilege;
    }


    
    public static function get_report_status($report_status_mark_id) {
        $row = sql::row("report_status_mark", "report_status_mark_id=$report_status_mark_id");
        return $row['report_status'];
    }
    

}
?>