<ul class="sf-menu">
    <li><a href="<?=site_url('student')?>" title='Home' class="white">Home</a></li>
    <li class="current"><a href="#a" class="white">Settings</a>
        <ul>
            <li><a href="<?=site_url('settings/change_password')?>">Change Password</a></li>
            <li><a href="<?=site_url('profile/edit_std_profile')?>">Edit My Profile</a></li>
        </ul>
    </li>
    <li><a href="<?=site_url('profile/student')?>" title='Student Profile' class="white">Profile</a></li>
    <li><a href="<?=site_url('letters')?>" title='Letters' class="white">Letters</a></li>
    <li><a href="<?=site_url('module_material')?>" title='Subject Materials' class="white">Subject Materials</a></li>
    <li><a href="<?=site_url('accounts/std_account')?>" title='Accounts' class="white">Accounts</a></li>
    <li><a href="<?=site_url('login/logout')?>" title='Logout' class="white">Logout</a></li>
</ul>