<div class="bdr">
    <div class='login_bg'>
        <div class='login_box'>
            <hr />
            <div class="table">
                <form action='<?=site_url('login/reset_password/'.$verify_code)?>' method='post'>
                    <table>
                        <tr><th>New Password:</th><td><input type='password' name='new_password' value='<?=set_value('new_password')?>' class='width_180' /><?=form_error('new_password','<span>','</span>')?></td></tr>
                        <tr><th>Confirm Password:</th><td><input type='password' name='conf_password' value='<?=set_value('conf_password')?>' class='width_180' /><?=form_error('conf_password','<span>','</span>')?></td></tr>
                        <tr><td></td><td><input type='submit' name='change_password' value='Change Password' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>