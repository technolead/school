<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of mod_sitemap
 *
 * @author anwar
 */
class mod_sitemap extends Model {
    function __construct() {
        parent::Model();
    }
    function get_event_links($limit='limit 0,10',$xml_data=false,$location_id='',$txt_data=false) {
//        if($location_id!=''||is_numeric($location_id)) {$con="and (lc.location_id=$location_id)";}
//        $sql=$this->db->query("select e.title,e.events_id from events as e
//                                left join club as c on e.location=c.club_id
//                                left join location_cities as lc on lc.city=c.city
//                                where e.status='enabled' $con order by e.events_id desc $limit");
//        $res=$sql->result_array();
//        $links=null;
//        $xml='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('events/details/'.$row['events_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('events/details/'.$row['events_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('events/details/'.$row['events_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }

    function get_lesson_links($limit='limit 0,10',$xml_data=false,$location_id='',$txt_data=false) {
//        if($location_id!=''||is_numeric($location_id)) {$con="and (lc.location_id=$location_id)";}
//        $sql=$this->db->query("select l.title,l.lesson_id from lesson as l
//                                left join club as c on l.location=c.club_id
//                                left join location_cities as lc on lc.city=c.city
//                                where l.status='enabled' $con order by l.lesson_id desc $limit");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('lessons/details/'.$row['lesson_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('lessons/details/'.$row['lesson_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                            <loc>".site_url('lessons/details/'.$row['lesson_id'].'/'.url_title($row['title']))."</loc>
//                            <changefreq>daily</changefreq>
//                            <priority>0.5</priority>
//                      </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }

    function get_club_links($limit='limit 0,10',$xml_data=false,$location_id='',$txt_data=false) {
//        if($location_id!=''||is_numeric($location_id)) {$con="and (lc.location_id=$location_id)";}
//        $sql=$this->db->query("select c.title,c.club_id from club as c
//                                left join location_cities as lc on lc.city=c.city
//                                where c.status='enabled' and c.location_type='club' $con order by c.club_id desc $limit");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('clubs/details/'.$row['club_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('clubs/details/'.$row['club_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('clubs/details/'.$row['club_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_band_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select b.title, b.band_id from event_band as b where b.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('bands/details/'.$row['band_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('bands/details/'.$row['band_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('bands/details/'.$row['band_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_dj_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select d.title, d.dj_id from event_dj as d where d.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('dj/details/'.$row['dj_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('dj/details/'.$row['dj_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('dj/details/'.$row['dj_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_instructor_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select i.title, i.instructor_id from instructor as i where i.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('instructor/details/'.$row['instructor_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('instructor/details/'.$row['instructor_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('instructor/details/'.$row['instructor_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_article_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select a.title,a.article_id,a.date from article as a where a.status='enabled' and a.draft_status='publish' order by a.article_id desc $limit");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $link_archive=explode('-',substr($row['date'], 0,10));
//            $links.="<li><a href='".site_url('archive/details/'.$link_archive[0].'/'.$link_archive[1].'/'.$link_archive[2].'/'.$row['article_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('archive/details/'.$link_archive[0].'/'.$link_archive[1].'/'.$link_archive[2].'/'.$row['article_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('archive/details/'.$link_archive[0].'/'.$link_archive[1].'/'.$link_archive[2].'/'.$row['article_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//        if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_topic_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select t.title, t.forum_topics_id from forum_topics as t where t.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('forum/topic/index/'.$row['forum_topics_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('forum/topic/index/'.$row['forum_topics_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('forum/topic/index/'.$row['forum_topics_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_groups_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select g.title, g.groups_id from groups as g where g.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('groups/groups/index/'.$row['groups_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('groups/groups/index/'.$row['groups_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('groups/groups/index/'.$row['groups_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $links;
    }

    function get_blog_links($limit='limit 0,10',$xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select b.title, b.blog_id from salsa_blog as b where b.status='enabled'");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('blogs/details/'.$row['blog_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('blogs/details/'.$row['blog_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('blogs/details/'.$row['blog_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function get_classifieds_links($xml_data=false,$txt_data=false) {
//        $categories=array(1=>"Cars &amp; Vehicles",
//                2=>"Jobs",
//                3=>"Tickets &amp; Events",
//                4=>"Musician XChange",
//                5=>"Housing for Sale",
//                6=>"Pets",
//                7=>"Services",
//                8=>"Filmmakers",
//                9=>"Housing For Rent",
//                10=>"Stuff for Sale",
//                11=>"Community");
//
//        $opt=NULL;
//        foreach($categories as $k=>$value) {
//            $opt.="<li><a href='".site_url('classifieds/classifieds_category/'.$k.'/'.url_title($value))."'>$value Classifieds</a></li>";
//            $txt.=site_url('classifieds/classifieds_category/'.$k.'/'.url_title($value))."\n";
//            $xml.="<url>
//                        <loc>".site_url('classifieds/classifieds_category/'.$k.'/'.url_title($value))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $opt;
    }
    function get_forum_links($xml_data=false,$txt_data=false) {
//        $sql=$this->db->query("select * from forum_categories where status='enabled' and parent_id=0");
//        $res=$sql->result_array();
//        $links='';
//        foreach($res as $row) {
//            $links.="<li><a href='".site_url('forum/category/index/'.$row['forum_categories_id'].'/'.url_title($row['title']))."' title='{$row['title']}'>{$row['title']}</a></li>";
//            $txt.=site_url('forum/category/index/'.$row['forum_categories_id'].'/'.url_title($row['title']))."\n";
//            $xml.="<url>
//                        <loc>".site_url('forum/category/index/'.$row['forum_categories_id'].'/'.url_title($row['title']))."</loc>
//                        <changefreq>daily</changefreq>
//                        <priority>0.5</priority>
//                  </url>\n";
//        }
//        if($xml_data) {
//            return $xml;
//        }
//         if($txt_data){
//            return $txt;
//        }
//        return $links;
    }
    function create_xml() {
        $this->load->helper('file');
        $xml='<?xml version="1.0" encoding="UTF-8"?>';
        $xml.="\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                 <url>
                    <loc>'.site_url().'</loc>
                    <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                <url>
                    <loc>'.site_url('user/edit_profile').'</loc>
                    <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                <url>
                    <loc>'.site_url('user').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                <url>
                    <loc>'.site_url('events/manage_events').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                <url>
                    <loc>'.site_url('lessons/manage_lessons').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                 <url>
                    <loc>'.site_url('clubs/manage_clubs').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>
                <url>
                    <loc>'.site_url('friends/manage_friends').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>
                  <url>
                    <loc>'.site_url('user/inbox').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                <url>
                    <loc>'.site_url('user/compose_mail').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                </url>
                 <url>
                    <loc>'.site_url('user/sent').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>
                <url>
                    <loc>'.site_url('user/request').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>
                  <url>
                    <loc>'.site_url('user/draft').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>
            ';
        $xml.='<url>
                    <loc>'.site_url('events').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_event_links('limit 0,20',true);
         $xml.='<url>
                    <loc>'.site_url('lessons').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_lesson_links('limit 0,20',true);
         $xml.='<url>
                    <loc>'.site_url('clubs').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_club_links('limit 0,20',true);
         $xml.='<url>
                    <loc>'.site_url('articles').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_article_links('limit 0,20',true);
        $xml.=$this->get_band_links('limit 0,20',true);
        $xml.=$this->get_blog_links('limit 0,20',true);
         $xml.='<url>
                    <loc>'.site_url('classifieds').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_classifieds_links(true);
        $xml.='<url>
                    <loc>'.site_url('forum').'</loc>
                     <changefreq>daily</changefreq>
                    <priority>0.5</priority>
                 </url>';
        $xml.=$this->get_forum_links(true);
        $xml.=$this->get_dj_links('limit 0,20',true);
        $xml.='</urlset>';
        //echo $xml;
        write_file(APPPATH."views/sitemap/sitemap.xml",$xml,"w+");
    }
     function create_txt() {
        $this->load->helper('file');
        $xml.=site_url()."\n".site_url('user/edit_profile')
                        ."\n".site_url('user')."\n"
                        .site_url('events/manage_events')."\n"
                        .site_url('lessons/manage_lessons')."\n"
                        .site_url('clubs/manage_clubs')."\n"
                        .site_url('friends/manage_friends')."\n"
                        .site_url('user/inbox')."\n"
                        .site_url('user/compose_mail')."\n"
                        .site_url('user/sent')."\n"
                        .site_url('user/draft')."\n"
                        .site_url('user/request')."\n";
        $xml.=$this->get_event_links('limit 0,20',false,'',true);
        $xml.=$this->get_lesson_links('limit 0,20',false,'',true);
        $xml.=$this->get_club_links('limit 0,20',false,'',true);
        $xml.=$this->get_article_links('limit 0,20',false,true);
        $xml.=$this->get_band_links('limit 0,20',false,true);
        $xml.=$this->get_blog_links('limit 0,20',false,true);
        $xml.=$this->get_classifieds_links(false,true);
        $xml.=$this->get_forum_links(false,true);
        $xml.=$this->get_dj_links('limit 0,20',false,true);
        write_file(APPPATH."views/sitemap/sitemap.txt",$xml,"w+");
    }
}
?>