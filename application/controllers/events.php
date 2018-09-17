<?php
/**
 * Description of events
 *
 * @author Anwar
 */
class events extends Controller {
    private $dir='events';
    function __construct() {
        parent::Controller();
    }
    function index($category_id='',$title='Events') {
        if(is_numeric($category_id)) {
            $con=' and category_id='.$category_id;
        }
        $data['rows']=sql::rows('wb_events as n',"status=1 $con order by event_date desc",'n.*,DATE_FORMAT(n.event_date,"%W %M %d, %Y") as event_date');
        $data['nav_array']=array(
                array('title'=>$title,'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['container']='content';
        $data['page']='index';
        $data['page_title']=$title;
        $this->load->view('main',$data);
    }
    function details($event_id='') {
        if($event_id=='' || !is_numeric($event_id)) {
            common::redirect();
        }
        $data['row']=sql::row('wb_events as n',"wb_events_id='$event_id'",'n.*,DATE_FORMAT(n.event_date,"%W %M %d, %Y") as event_date');
        $data['nav_array']=array(
                array('title'=>'Events','url'=>site_url('events')),
                array('title'=>$data['row']['news_title'],'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['container']='content';
        $data['page']='details';
        $data['page_title']=$data['row']['news_title'];
        $this->load->view('main',$data);
    }
}
?>