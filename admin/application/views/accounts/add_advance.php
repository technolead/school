<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form action="<?=site_url('accounts/add_advance/')?>" method="post">
        <table>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_id"><?=combo::registered_class_options($std_info['student_id'],set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Agreed Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="agreed_fee" value="<?=set_value('agreed_fee')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('agreed_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="amount" value="<?=set_value('amount')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            <tr>
              <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=set_value('paid_date')?>" class="text ui-widget-content ui-corner-all required width_160 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=set_value('paid_amount')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Mood <span class='req_mark'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',set_value('pay_mood'))?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details <span class='req_mark'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('STUDENT_PAYMENT',set_value('pay_details_id'))?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Notes</th>
                <td><textarea name="notes" rows="3" cols="30"><?=set_value('notes')?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='save' value='Save' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>