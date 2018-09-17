<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('levels/new_level')?>' method='post'>
        <table>
            <tr>
                <th>Level Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_name' value='<?=set_value('level_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('level_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Code <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_code' value='<?=set_value('level_code')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('level_code','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>