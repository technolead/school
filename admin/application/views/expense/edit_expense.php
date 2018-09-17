<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('expense/edit_expense/'.$expense_id)?>' method='post'>
        <table>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="exp_date" value="<?=set_value('exp_date',$exp_date)?>" class="text ui-widget-content ui-corner-all required width_80 date_picker" /><?=form_error('exp_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='exp_title' value='<?=set_value('exp_title',$exp_title)?>' class='text ui-widget-content ui-corner-all required width_250' /><?=form_error('exp_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea name="exp_des" rows="3" cols="30"><?=set_value('exp_des',$exp_des)?></textarea><?=form_error('exp_des','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Pay Mood  <span class='req_mark'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',set_value('pay_mood',$pay_mood))?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details  <span class='req_mark'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('EXPENSE_PAYMENT',set_value('pay_details_id',$pay_details_id))?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="exp_amount" value="<?=set_value('exp_amount',$exp_amount)?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('exp_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>