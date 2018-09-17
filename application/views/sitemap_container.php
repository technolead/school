<div id="body_top">
    <div id="content">
         <?php if(count($nav_array)>0) {
        echo common::nav_menu_link($nav_array);
    }?>
        <h1>SalsaHook Sitemap</h1>
        <div class='sitemap_top'>
            <h2>SalsaHook Quicklinks</h2>
            <div class="left top_link">
                <ul>
                    <li><a href="<?=site_url('home')?>" title='SalsaHook Home'>SalsaHook Home</a></li>
                    <li><a href="<?=site_url('home/sign_up')?>" title='Signup for SalsaHook'>Signup for SalsaHook</a></li>
                    <li><a href="<?=site_url('events')?>" title='SalsaHook Events'>SalsaHook Events</a></li>
                    <li><a href="<?=site_url('clubs')?>" title='SalsaHook Clubs'>SalsaHook Clubs</a></li>
                </ul>
            </div>
            <div class="left top_link">
                <ul>
                    <li><a href="<?=site_url('lessons')?>" title='SalsaHook Lessons'>SalsaHook Lessons</a></li>
                    <li><a href="<?=site_url('videos')?>" title='SalsaHook Videos'>SalsaHook Videos</a></li>
                    <li><a href="<?=site_url('photos')?>" title='SalsaHook Photos'>SalsaHook Photos</a></li>
                    <li><a href="<?=site_url('community')?>" title='SalsaHook Community'>SalsaHook Community</a></li>
                </ul>
            </div>
            <div class="left top_link">
                <ul>
                    <li><a href="<?=site_url('home/about')?>" title='About SalsaHook'>About SalsaHook</a></li>
                    <li><a href="<?=site_url('home/privacy')?>" title='SalsaHook Privacy'>SalsaHook Privacy</a></li>
                    <li><a href="<?=site_url('home/terms')?>" title='SalsaHook Terms of Service'>SalsaHook Terms of Services</a></li>
                    <li><a href="<?=site_url('home/user_tour')?>" title='SalsaHook Quick Tour'>SalsaHook Quick Tour</a></li>
                </ul>
            </div>
            <ul class="left">
                <li><a href="<?=site_url('home/browse_events')?>" title='Browse Events Database'>Browse Events Database</a></li>
                <li><a href="<?=site_url('home/make_profile')?>" title='Make a Profile and network with other people'>Make a Profile and network with other people</a></li>
                <li><a href="<?=site_url('home/watching')?>" title='Watch, Upload, &amp; Share Photos &amp; Videos'>Watch, Upload, &amp; Share Photos &amp; Videos</a></li>
                <li><a href="<?=site_url('home/joinourteam')?>" title='Join Member Discussions &amp; much more'>Join Member Discussions &amp; much more...</a></li>
            </ul>
            <div class='clear'></div>
        </div>
        <?php
        if($dir==''){$dir='home';}
        if($page==''){$page='index';}
        include_once($dir.'/'.$page.'.php');
        ?>
    </div>
</div>