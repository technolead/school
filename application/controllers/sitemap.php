<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sitemap
 *
 * @author anwar
 */
class sitemap extends Controller{
     function __construct(){
         parent::Controller();
         $this->load->model('mod_sitemap');
     }
     function index(){
          $data['link_array']=array(
            array('title'=>'Sitemap','url'=>'')
          );
         $data['page_title']='Sitemap';
         $data['dir']='sitemap';
         $data['page']='index';
         $data['container']='sitemap';
         $this->load->view('main',$data);
     }
     function create_xml(){
         $this->mod_sitemap->create_xml();
         echo 'success';
     }
     function create_txt(){
         $this->mod_sitemap->create_txt();
         echo 'Success';
     }
}
?>
