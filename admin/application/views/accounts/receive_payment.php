<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form action="<?=site_url('accounts/receive_payment/'.$installment_id)?>" method="post">
        <table>
            
            <tr><th>Class Name</th><td><?=$class_name?></td></tr>
            <tr><th>Class Fee</th><td><?=$class_fee?></td></tr>
            <tr><th>Total Fee</th><td><?=$total_balance?></td></tr>
            <tr><th>Committed Date</th><td><?=$committed_date?></td></tr>
            <tr>
                <th>Installment Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="amount" value="<?=$amount-$this->mod_accounts->get_paid_amount($installment_id)?>" class="text ui-widget-content ui-corner-all required width_160" readonly /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=set_value('paid_date')?>" class="text ui-widget-content ui-corner-all required width_80 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=set_value('paid_amount')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Mood</th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',set_value('pay_mood'))?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details</th>
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