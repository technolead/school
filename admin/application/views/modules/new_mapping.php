<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('modules/new_mapping')?>' method='post'>
        <table>
            
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="ui-widget-content ui-corner-all required"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select name='module_id[]' class='ui-widget-content ui-corner-all required' multiple size="15"><?=combo::get_modules_options(set_value('module_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>