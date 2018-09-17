<div class='form_content'>
    <h3>Monthly Fee Registration</h3>
    <form id="valid_form" action="<?=site_url($action)?>" method='post'>
        <table>

            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="input_txt jsession_class required"><?=combo::get_session_options(set_value('session_id',$session_id))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jaccount_class_id jclass_details jsession_class_list"><?=combo::get_session_class(set_value('session_id',$session_id),set_value('class_id',$class_id))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Monthly Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="monthly_fee" value="<?=set_value('monthly_fee',$monthly_fee)?>" class="text ui-widget-content ui-corner-all required width_160 jmonthly_fee" readonly /><?=form_error('monthly_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Month <span class='req_mark'>*</span></th>
                <td><select name="month"><?=common::get_months(set_value('month',$month));?></select><?=form_error('month','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=set_value('paid_amount',$paid_amount)?>" class="text ui-widget-content ui-corner-all required width_160 " /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>

            
            <tr>
                <th>Pay Mood </th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',set_value('pay_mood',$pay_mood))?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=set_value('paid_date',$paid_date)?>" class="text ui-widget-content ui-corner-all required width_80 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Notes</th>
                <td><textarea name="notes" rows="3" cols="30"><?=set_value('notes')?></textarea></td>
            </tr>
            
            <tr>
                <th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='<?=$submit_value?>' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>