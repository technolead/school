<div class="sitemap">
    <div class="fl_left sitemap_content">
        <div class="sitemap_link">
            <h3>SalsaHook Profile</h3>
            <ul>
                <li><a href="<?=site_url('profile')?>" title="My Profile">My Profile</a></li>
                <li><a href="<?=site_url('user/edit_profile')?>" title="Edit Profile">Edit Profile</a></li>
                <li><a href="<?=site_url('user')?>" title="Account Settings">Account Settings</a></li>
                <li><a href="<?=site_url('events/manage_events')?>" title="My Events">My Salsa Events</a></li>
                <li><a href="<?=site_url('lessons/manage_lessons')?>" title="My Lessons">My Slasa Lessons</a></li>
                 <li><a href="<?=site_url('clubs/manage_clubs')?>" title="My Salsa Clubs">My Salsa Clubs</a></li>
                <li><a href="<?=site_url('friends/manage_friends')?>" title="My Salsa Friends">My Salsa Friends</a></li>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook Mails</h3>
            <ul>
                <li><a href="<?=site_url('user/manage_mails/1/inbox')?>" title="Inbox">Inbox</a></li>
                <li><a href="<?=site_url('user/manage_mails/2/compose')?>" title="Compose">Compose</a></li>
                <li><a href="<?=site_url('user/manage_mails/3/sent')?>" title="Sent Mails">Sent Mails</a></li>
                <li><a href="<?=site_url('user/manage_mails/4/request')?>" title="Friend Requests">Friend Requests</a></li>
            </ul>
        </div>
         <div class="sitemap_link">
            <h3>SalsaHook Blogs</h3>
            <ul>
                <li><a href='<?=site_url('blogs')?>' title='SalsaHook Blogs Home Page'>Salsa Blogs Home Page</a></li>
                <?=$this->mod_sitemap->get_blog_links()?>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook Classifieds</h3>
            <ul>
                <li><a href='<?=site_url('classifieds')?>' title='SalsaHook Classifieds Home Page'>Salsa Classifieds Home Page</a></li>
                <?=$this->mod_sitemap->get_classifieds_links()?>
            </ul>
        </div>
         <div class="sitemap_link">
            <h3>SalsaHook Bands</h3>
            <ul>
                <li><a href="<?=site_url('band')?>" title='SalsaHook Bands'>Browse SalsaHook Bands</a></li>
                <?=$this->mod_sitemap->get_band_links()?>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook DJ</h3>
            <ul>
                <li><a href="<?=site_url('dj')?>" title='SalsaHook DJ'>Browse SalsaHook DJ</a></li>
                <?=$this->mod_sitemap->get_dj_links()?>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook Instructors</h3>
            <ul>
                <li><a href="<?=site_url('instructor')?>" title='SalsaHook Instructors'>Browse SalsaHook Instructors</a></li>
                <?=$this->mod_sitemap->get_instructor_links()?>
            </ul>
        </div>
    </div>
    <div class="fl_left sitemap_content">
        <div class="sitemap_link">
            <h3>SalsaHook News &amp; Articles</h3>
            <ul>
                <li><a href="<?=site_url('articles')?>" title='SalsaHook News &amp; Articles'>SalsaHook News &amp; Articles</a></li>
                <?=$this->mod_sitemap->get_article_links()?>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook Discussion Boards</h3>
            <ul>
                <li><a href="<?=site_url('forum')?>" title="SalsaHook Forums">SalsaHook Forums</a></li>
                <?=$this->mod_sitemap->get_topic_links()?>
            </ul>
        </div>
        <div class="sitemap_link">
            <h3>SalsaHook Groups</h3>
            <ul>
                <li><a href="<?=site_url('groups')?>" title="SalsaHook Groups">SalsaHook Groups</a></li>
                <li><a href="<?=site_url('groups/groups/dir')?>" title="SalsaHook Groups">Browse Groups Categories</a></li>
                <?=$this->mod_sitemap->get_groups_links()?>
            </ul>
        </div>
         <div class="sitemap_link">
            <h3>SalsaHook Forums</h3>
            <ul>
                <li><a href='<?=site_url('forum')?>' title='SalsaHook Forum Home Page'>SalsaHook Forum Home Page</a></li>
                <?=$this->mod_sitemap->get_forum_links()?>
            </ul>
        </div>
    </div>
    <div class='clear'></div>
</div>