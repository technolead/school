<div class="bdr">
    <div class='login_bg'>
        <div class='login_box'>
            <hr />
            <div class="table">
                <form action='<?=site_url('login/forgot_password')?>' method='post'>
                    <?php if($msg!='') {
    echo "<div class='error'>".$msg."</div>";
}?>
                    <table>
                        <tr><th>User Name:</th><td><input type='text' name='user_name' value='<?=set_value('user_name')?>' class='width_180' /><?=form_error('user_name','<span>','</span>')?></td></tr>
                        <tr><th>Email:</th><td><input type='text' name='email' value='<?=set_value('email')?>' class='width_180' /><?=form_error('email','<span>','</span>')?></td></tr>
                        <tr><td></td><td><input type='submit' name='send' value='Send' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>