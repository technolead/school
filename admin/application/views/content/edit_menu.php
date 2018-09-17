<div class='form_content'>
    <form id="valid_form" action='<?=site_url('content/edit_menu/'.$menu_id)?>' method='post'>
        <table>
            <tr>
                <th>Menu Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='menu_name' value='<?=set_value('menu_name',$menu_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('menu_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Menu Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='menu_title' value='<?=set_value('menu_title',$menu_title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('menu_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>