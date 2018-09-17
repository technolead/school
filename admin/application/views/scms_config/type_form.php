<div class='form_content'>
	<h3><?=$page_title?></h3>
        <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Type Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='type_name' value='<?=set_value('type_name',$type_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('type_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Type For <span class='req_mark'>*</span></th>
                <td><select name="type_for" class="ui-widget-content ui-corner-all required width_200" style="padding:0.4em;"><?=$this->mod_scms_config->type_for_options(set_value('type_for',$type_for))?></select><?=form_error('type_for','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>