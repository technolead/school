<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
        echo '<div class="error">'.$msg.'</div>';
    }?>
    <form action='<?=site_url('agent_account')?>' method='post'>
        <table>
            <tr>
                <th>Agent ID <span class='req_mark'>*</span></th>
                <td><input type="text" name="user_name" class="jagent_username text ui-widget-content ui-corner-all required width_160" autocomplete="off" value="<?=set_value('user_name')?>" /><div class="juas_list"></div><?=form_error('user_name','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='go' value='Go Account' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>