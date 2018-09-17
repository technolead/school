<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=site_url('modules/edit_mapping/'.$module_map_id)?>' method='post'>
        <table>
            
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="ui-widget-content ui-corner-all required"><?=combo::get_class_options($class_id)?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select name='module_id' class='ui-widget-content ui-corner-all required'><?=combo::get_modules_options($module_id)?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>