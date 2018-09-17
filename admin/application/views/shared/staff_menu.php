<ul class="sf-menu">
    <li><a href="<?=site_url('staffs')?>" title='Home' class="white">Home</a></li>
    <li class="current"><a href="#a" class="white">Settings</a>
        <ul>
            <li><a href="<?=site_url('settings/change_password')?>">Change Password</a></li>
            <!--<li><a href="<?=site_url('profile/edit_std_profile')?>">Edit My Profile</a></li>-->
        </ul>
    </li>
    <li><a href="<?=site_url('profile/staff')?>" title='Staff Profile' class="white">Profile</a></li>
    <li class="current"><a href="#course" class="white">Subject Materials</a>
        <ul>
            <li><a href="<?=site_url('module_material/mng_material')?>">Manage Subject Material</a></li>
            <li><a href="<?=site_url('module_material/new_material')?>">Add New Material</a></li>
        </ul>
    </li>
    <li class="current"><a href="#course" class="white">Notice</a>
        <ul>
            <li><a href="<?=site_url('notice/staff_notice')?>">Manage Notice</a></li>
            <li><a href="<?=site_url('notice/new_staff_notice')?>">Add New Notice</a></li>
        </ul>
    </li>
    <li><a href="<?=site_url('login/logout')?>" title='Logout' class="white">Logout</a></li>
</ul>