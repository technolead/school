<div class="form_content">
	<h3><?=$page_title?></h3>
        <?php if($msg!=''){echo "<div class='success'>".$msg."</div>";}?>
        <form id="valid_form" action='<?=site_url('settings/websetting')?>' method='post'>
        <table>
            <tr>
                <th>Site Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='site_title' value='<?=$site_title?>' class='required text ui-widget-content ui-corner-all width_200' /></td>
            </tr>
            <tr>
                <th>Meta Keyword <span class='req_mark'>*</span></th>
                <td><textarea name='meta_keywords' rows="5" cols="40" class="required text ui-widget-content ui-corner-all"><?=$meta_keywords?></textarea></td>
            </tr>
            <tr>
                <th>Meta Description <span class='req_mark'>*</span></th>
                <td><textarea name='meta_description' rows="5" cols="40" class="required text ui-widget-content ui-corner-all"><?=$meta_description?></textarea></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="clear"></div>