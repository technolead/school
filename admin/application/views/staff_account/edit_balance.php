<form action="<?=site_url('staff_account/edit_balance/'.$balance_id)?>" method="post">
    <div class='form_content'>
        <table>
            <tr>
                <td colspan="2"><h3>Payable Amount</h3></td>
                <td colspan="2"><h3>Amount to be deduce</h3></td>
            </tr>
            <tr>
                <th>Previous Due/Bal <span class='req_mark'>*</span></th>
                <td><input type="text" name="previous_due" value="<?=$previous_due?>" class="text ui-widget-content ui-corner-all required width_160 jprevious_due" /><?=form_error('previous_due','<span>','</span>')?></td>
                <th>Part/Advance Pay <span class='req_mark'>*</span></th>
                <td><input type="text" name="part_adv_pay" value="<?=$part_adv_pay?>" class="text ui-widget-content ui-corner-all required width_160 jpart_adv_pay" /><?=form_error('part_adv_pay','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>For Extra Days/Hours <span class='req_mark'>*</span></th>
                <td><input type="text" name="extra_day_hour" value="<?=$extra_day_hour?>" class="text ui-widget-content ui-corner-all required width_160 jextra_day_hour" /><?=form_error('extra_day_hour','<span>','</span>')?></td>
                <th>For Absent Days/Hours <span class='req_mark'>*</span></th>
                <td><input type="text" name="absent_day_hour" value="<?=$absent_day_hour?>" class="text ui-widget-content ui-corner-all required width_160 jabsent_day_hour" /><?=form_error('absent_day_hour','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="other_add" value="<?=$other_add?>" class="text ui-widget-content ui-corner-all required width_160 jother_add" /><?=form_error('other_add','<span>','</span>')?></td>
                <th>Lunch <span class='req_mark'>*</span></th>
                <td><input type="text" name="lunch" value="<?=$lunch?>" class="text ui-widget-content ui-corner-all required width_160 jlunch" /><?=form_error('lunch','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="payable_total" value="<?=$payable_total?>" class="text ui-widget-content ui-corner-all required width_160 jpayable_total" /><?=form_error('payable_total','<span>','</span>')?></td>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="other_deduce" value="<?=$other_deduce?>" class="text ui-widget-content ui-corner-all required width_160 jother_deduce" /><?=form_error('other_deduce','<span>','</span>')?></td>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="deduced_total" value="<?=$deduced_total?>" class="text ui-widget-content ui-corner-all required width_160 jdeduced_total" /><?=form_error('deduced_total','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Total Payment</h3>
        <table>
            <tr>
                <th style="width:200px;">Month</th>
                <td>
                    <select name="month"><?=ahdate::get_month($month)?></select> <select name="year"><?=ahdate::get_year($year)?></select><?=form_error('month','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Net Pay <span class='req_mark'>*</span></th>
                <td><input type="text" name="net_pay" value="<?=$net_pay?>" class="text ui-widget-content ui-corner-all required width_160 jnet_pay" /><?=form_error('net_pay','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To be Added <span class='req_mark'>*</span></th>
                <td><input type="text" name="to_be_added" value="<?=$payable_total?>" class="text ui-widget-content ui-corner-all required width_160 jtobe_added" /><?=form_error('to_be_added','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To be Deduce <span class='req_mark'>*</span></th>
                <td><input type="text" name="to_be_deduce" value="<?=$deduced_total?>" class="text ui-widget-content ui-corner-all required width_160 jtobe_deduce" /><?=form_error('to_be_deduce','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="total" value="<?=$total?>" class="text ui-widget-content ui-corner-all required width_160 jtotal" /><?=form_error('total','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <table>
            <tr>
                <th style="width:200px;">Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=$paid_amount?>" class="text ui-widget-content ui-corner-all required width_160 js_paid_amount" /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=$paid_date?>" class="text ui-widget-content ui-corner-all required width_160 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Mode <span class='req_mark'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',$pay_mood)?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details <span class='req_mark'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('STAFF_PAYMENT',$pay_details_id)?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Due <span class='req_mark'>*</span></th>
                <td><input type="text" name="due" value="<?=$due?>" class="text ui-widget-content ui-corner-all required width_160 js_due" /><?=form_error('due','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Total Payment</h3>
        <table>
            <tr>
                <th style="width:200px;">Paid Holidays (Days/Hours) <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_holidays" value="<?=$paid_holidays?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_holidays','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Absent/Sick/Excuse (Days/Hours) <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_absent" value="<?=$paid_absent?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_absent','<span>','</span>')?></td>
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
    </div>
</form>