<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Status Name <span class='required'>*</span></th>
                <td><input type='text' name='status_name' value='<?=set_value('status_name',$status_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('status_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status For <span class='required'>*</span></th>
                <td><select name="status_for" class="input_txt"><?=$this->mod_scms_config->status_for_options(set_value('status_for',$status_for))?></select><?=form_error('status_for','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>