<!-- Header -->
<div id="header">
    <div class="container">
        <h1>
            <a href="<?=site_url()?>" class="logo" style="background:url(uploads/site_logo/<?=$site_logo?>) top left no-repeat;" title="<?=$site_data['contact_name']?>"></a>
        </h1>
        <div class="fl_right loginInfos">
            <strong><?=date('l F d, Y')?></strong>&nbsp;&nbsp;<input type="text" name="query" value="" style="border:1px solid #7E9DB9;padding:2px;" /><input type="submit" name="search" value="Search" class="searchSubmit" />
        </div>
        <div class="clear"></div>
    </div>
    <div id="primaryNav">
        <ul>
            <li><a href="<?=site_url('student')?>" title='Home'>Home</a></li>
            <?php if(common::is_logged_in()){ ?>
            <li><a href="<?=site_url('student/change_password')?>">Change Password</a></li>
            <li><a href="<?=site_url('student/edit_profile')?>">Edit My Profile</a></li>
            <li><a href="<?=site_url('student/profile')?>" title='Student Profile'>Profile</a></li>
            <li><a href="<?=site_url('letters')?>" title='Letters' class="white">Letters</a></li>
            <li><a href="<?=site_url('module_material')?>" title='Subject Materials'>Subject Materials</a></li>
            <li><a href="<?=site_url('student/accounts')?>" title='Accounts'>Accounts</a></li>
            <li><a href="<?=site_url('login/logout')?>" title='Logout'>Logout</a></li>
            <?php }else{
                echo common::get_top_menu_li();
            }?>
        </ul>
    </div>
</div>
<!-- /Header -->
