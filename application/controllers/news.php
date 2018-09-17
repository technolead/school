<?php
/**
 * Description of news
 *
 * @author Anwar
 */
class news extends Controller {
    private $dir='news';
    function __construct() {
        parent::Controller();
    }
    function index($category_id='',$title='News') {
        if(is_numeric($category_id)) {
            $con=' and category_id='.$category_id;
        }
        $data['rows']=sql::rows('wb_news as n',"status=1 $con order by news_date desc",'n.*,DATE_FORMAT(n.news_date,"%W %M %d, %Y") as news_date');
        $data['nav_array']=array(
                array('title'=>$title,'url'=>'')
        );
        $data['dir']=$this->dir;
        $data['container']='content';
        $data['page']='index';
        $data['page_title']=$title;
        $this->load->view('main',$data);
    }
    function details($news_id='') {
        if($news_id=='' || !is_numeric($news_id)) {
            common::redirect();
        }
        $data['row']=sql::row('wb_news as n',"news_id='$news_id'",'n.*,DATE_FORMAT(n.news_date,"%W %M %d, %Y") as news_date');
        $data['nav_array']=array(
                array('title'=>'News','url'=>site_url('news')),
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