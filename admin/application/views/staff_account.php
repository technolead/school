<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include_once 'shared/html_header.php';?>
    <body>
        <div id="body_content">
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <div class="loginInfos">
                         <div class="fl_left"><strong><?=date('l F d, Y')?></strong></div>
                         <div class="fl_right">
                            <?php if(common::is_logged_in()) { ?>
                            You're logged in as <strong><?=$this->session->userdata('first_name').' '.$this->session->userdata('last_name')?></strong>.
                            <a href="<?=site_url('login/logout')?>" title="Log out">Log out</a>
                            <?php }?>
                         </div>
                         <div class="clear"></div>
                      </div>
                    <h1>
                        <a href="<?=site_url()?>" class="logo" title="College Management System"></a>
                    </h1>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <?php include_once 'shared/header.php';?>
            <div class="content">
            <?php if($dir=='') { $dir='home';}
            if($page=='') { $page='index';}?>
            <div class="pad_0_10">
<?php include_once 'staff_account/manage_account.php';?>
            </div>
            <?php if(count($nav_array)>0) {echo common::nav_menu_link($nav_array);}?>
            <div class="pad_10 m_height">
<?php include_once $dir.'/'.$page.'.php';?>
            </div>
             </div>
            <div class="clear"></div>
<?php include_once 'shared/footer.php';?>
        </div>
    </body>
</html>