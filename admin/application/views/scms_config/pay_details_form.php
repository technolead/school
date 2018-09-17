<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Payment Details Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='details_name' value='<?=set_value('details_name',$details_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('details_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Payment Details For <span class='req_mark'>*</span></th>
                <td><select name="pay_details_for" class="required"><?=$this->mod_scms_config->pay_details_for_options(set_value('pay_details_for',$pay_details_for))?></select><?=form_error('pay_details_for','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Payment Effect <span class='req_mark'>*</span></th>
                <td><select name="pay_effect" class="required"><?=$this->mod_scms_config->pay_effect_options(set_value('pay_effect',$pay_effect))?></select><?=form_error('pay_effect','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>