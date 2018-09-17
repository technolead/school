<div class="bdr">
    <div class='login_bg'>
        <div class="ui-jqdialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" style="padding:10px;">
            <span class="ui-jqdialog-title" style="float: left;"><?=$page_title?></span>
        </div>
        <div class='login_box'>
            <div class="table">
                <form id="valid_form" action='<?=site_url('login')?>' method='post'>
                    <?php if($msg!='') {
                        echo "<div class='error'>".$msg."</div>";
                    }?>
                    <table>
                        <tr><th>User Name:</th><td><input type='text' name='user_name' value='' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('user_name','<span>','</span>')?></td></tr>
                        <tr><th>Password:</th><td><input type='password' name='password' value='' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('password','<span>','</span>')?></td></tr>
                        <tr><td></td><td><input type='submit' name='login' value='Login' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
                        <tr><th>&nbsp;</th><td><a href="<?=site_url('login/forgot_password')?>">Forgot your Password?</a></td></tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>