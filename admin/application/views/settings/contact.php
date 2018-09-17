<div class="form_content">
    <h3><?=$page_title?></h3>
    <?php if($msg!=''){echo "<div class='success'>".$msg."</div>";}?>
    <form id="valid_form" action='<?=site_url('settings/contact')?>' method='post'>
        <table>
            <tr>
                <th>Contact Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='contact_name' value='<?=$contact_name?>' class='required text ui-widget-content ui-corner-all width_200' /></td>
            </tr>
            <tr>
                <th>Contact Address <span class='req_mark'>*</span></th>
                <td><textarea name='contact_address' rows="5" cols="40" class="required text ui-widget-content ui-corner-all"><?=$contact_address?></textarea></td>
            </tr>
            <tr>
                <th>Phone <span class='req_mark'>*</span></th>
                <td><input type='text' name='contact_phone' value='<?=$contact_phone?>' class='required text ui-widget-content ui-corner-all width_200' /></td>
            </tr>
             <tr>
                <th>Mobile <span class='req_mark'>*</span></th>
                <td><input type='text' name='contact_mobile' value='<?=$contact_mobile?>' class='required text ui-widget-content ui-corner-all width_200' /></td>
            </tr>
            <tr>
                <th>Contact Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='contact_email' value='<?=$contact_email?>' class='required text ui-widget-content ui-corner-all width_200' /></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="clear"></div>