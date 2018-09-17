<?php include_once 'agent_info.php'?>
<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form action="<?=site_url('agent_account/edit_payment/'.$agent_payment_id)?>" method="post">
        <table>
            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=$paid_date?>" class="text ui-widget-content ui-corner-all required width_160 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Due Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="due_amount" value="<?=$due_amount?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('due_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=$paid_amount?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Balance <span class='req_mark'>*</span></th>
                <td><input type="text" name="agent_balance" value="<?=$agent_balance?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('agent_balance','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Mood <span class='req_mark'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',$pay_mood)?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details <span class='req_mark'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('AGENTS_PAYMENT',$pay_details_id)?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="comments" rows="3" cols="30"><?=$comments?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='update' value='Update' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>