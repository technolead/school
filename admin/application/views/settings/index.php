<div class="form_content">
    <h3><?=$page_title?></h3>
     <?php if($msg!=''){echo "<div class='message success'>".$msg."</div>";}?>
    <form action='<?=site_url('settings')?>' method='post'>
        <table>
            <tr>
                <th>Admin Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='admin_email' value='<?=$admin_email?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Notification Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='notify_email' value='<?=$notify_email?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            
            <tr>
                <th>Delete Function <span class='req_mark'>*</span></th>
                <td><input type="radio" name="delete" value="1" <?php if($delete==1) echo 'checked';?> /> Enabled <input type="radio" name="delete" value="0" <?php if($delete==0) echo 'checked';?> /> Disabled </td>
            </tr>
            
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="clear"></div>