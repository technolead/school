<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Anwar
 */
class home extends Controller {

    private $dir = 'home';

    function __construct() {
        parent::Controller();
    }

    function index() {

        
        $data['container'] = 'home';
        $data['slider_rows'] = sql::rows('wb_slider', "status=1 order by sort");
        $data['news_rows'] = sql::rows('wb_news as n', "status=1 order by news_date desc", 'n.*,DATE_FORMAT(n.news_date,"%W %M %d, %Y") as news_date');
        $data['link_rows'] = sql::rows('wb_useful_link', "status=1 order by link_title limit 0,4");
        $data['featured_rows'] = sql::rows('wb_featured_box', "status=1 order by featured_title limit 0,3");
        $data['event_row'] = sql::row('wb_events as n', "status=1 order by event_date desc", 'n.*,DATE_FORMAT(n.event_date,"%a-%d-%b") as event_date');
        $data['slider_view'] = TRUE;
        $data['dir'] = $this->dir;
        $data['page_title'] = 'Home';
        $data['page'] = 'index';
        $this->load->view('main', $data);
    }

    function content() {
        $data['nav_array'] = array(
            array('title' => 'About Us', 'url' => '')
        );
        $data['dir'] = $this->dir;
        $data['page'] = 'content';
        $this->load->view('content', $data);
    }

    

    

}
?>
