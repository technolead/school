<form action="<?=site_url('staff_account/staff_mng_account')?>" method="post">
    <div class='table_content'>
        <div class="pagination_links b" style="color:#f00;">First Select the Month &amp; Year from Right Side corner of the Below Form.</div>
        <div class="pagination_links">
            <div class="left"><?=$attd_pagination_links?></div>
            <div class="left b">Showing <?=$attd_start?>-<?=$attd_end?> of <?=$attd_total?> Staff Attendance Record</div>
            <div class="right"><?=form_error('month','<span>','</span>')?><select name="month" class="jsel_month_year"><?=ahdate::get_month($month)?></select> <select name="year" class="jsel_month_year"><?=ahdate::get_year($year)?></select>
            </div>
            <div class="clear"></div>
        </div>
        <table cellspacing="1" cellpadding="1">
            <tr class='title'>
                <th>Date</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Sick</th>
                <th>Holiday</th>
                <th>Hours Done</th>
                <th>Extra Hours</th>
                <th>Absent Hours</th>
                <th>Late Hours</th>
                <th>Authorize</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
            <?php if(count($rows)>0) {
                $inc=1;
                foreach($rows as $row):?>
            <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
                <th><?=$row['date']?></th>
                <th><?=$row['present']?></th>
                <th><?=$row['absent']?></th>
                <th><?=$row['sick']?></th>
                <th><?=$row['holiday']?></th>
                <th><?=$row['hours']?></th>
                <th><?=$row['extra_hour']?></th>
                <th><?=$row['absent_hour']?></th>
                <th><?=$row['late']?></th>
                <th><?=$row['authorize']?></th>
                <td><?=$row['comments']?></td>
                <td class='view_links'>
                    <a href='<?=site_url('staff_attd/edit_attendance/'.$row['attendance_id'])?>' class="edit_link" class="Change"></a>
                    <a href='<?=site_url('staff_attd/delete_attendance/'.$row['attendance_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a></td>
            </tr>
        <?php $inc++;
    endforeach; ?>
            <tr style="background:#d4ded3;color:#00f;">
                <th>Total</th>
                <th><?=$total_attd['tot_present']?></th>
                <th><?=$total_attd['tot_absent']?></th>
                <th><?=$total_attd['tot_sick']?></th>
                <th><?=$total_attd['tot_holiday']?></th>
                <th><?=$total_attd['tot_hours']?></th>
                <th><?=$total_attd['tot_extra_hour']?></th>
                <th><?=$total_attd['tot_absent_hour']?></th>
                <th><?=$total_attd['tot_late']?></th>
                <th colspan='3'>No. of payable hours: <?=$total_attd['tot_hours']+$total_attd['tot_extra_hour']?></th>
            </tr>
    <?php }
else {
    echo "<tr><td colspan='33'>No Content Found!!!</td></tr>";
}  ?>
        </table>
        <div class="pagination_links">
            <div class="left"><?=$attd_pagination_links?></div>
            <div class="left width_500 b">Showing <?=$attd_start?>-<?=$attd_end?> of <?=$attd_total?> Staff Attendance Record</div>
            <div class="right"><?=$prev_next?></div>
            <div class="clear"></div>
        </div>

    </div>
<?php include_once('manage_payments.php')?>
    <div class='form_content'>
<?php $prev=$previous_due['due'];
if($prev=='') {
    $prev=0;
}?>
        <table>
            <tr>
                <td colspan="2"><h3>Payable Amount</h3></td>
                <td colspan="2"><h3>Amount to be deduce</h3></td>
            </tr>
            <tr>
                <th>Previous Due/Bal <span class='req_mark'>*</span></th>
                <td><input type="text" name="previous_due" value="<?=set_value('previous_due',$prev)?>" class="text ui-widget-content ui-corner-all required width_160 jprevious_due" /><?=form_error('previous_due','<span>','</span>')?></td>
                <th>Part/Advance Pay <span class='req_mark'>*</span></th>
                <td><input type="text" name="part_adv_pay" value="<?=set_value('part_adv_pay','0')?>" class="text ui-widget-content ui-corner-all required width_160 jpart_adv_pay" /><?=form_error('part_adv_pay','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>For Extra Days/Hours <span class='req_mark'>*</span></th>
                <td><input type="text" name="extra_day_hour" value="<?=set_value('extra_day_hour','0')?>" class="text ui-widget-content ui-corner-all required width_160 jextra_day_hour" /><?=form_error('extra_day_hour','<span>','</span>')?></td>
                <th>For Absent Days/Hours <span class='req_mark'>*</span></th>
                <td><input type="text" name="absent_day_hour" value="<?=set_value('absent_day_hour','0')?>" class="text ui-widget-content ui-corner-all required width_160 jabsent_day_hour" /><?=form_error('absent_day_hour','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="other_add" value="<?=set_value('other_add','0')?>" class="text ui-widget-content ui-corner-all required width_160 jother_add" /><?=form_error('other_add','<span>','</span>')?></td>
                <th>Lunch <span class='req_mark'>*</span></th>
                <td><input type="text" name="lunch" value="<?=set_value('lunch','0')?>" class="text ui-widget-content ui-corner-all required width_160 jlunch" /><?=form_error('lunch','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="payable_total" value="<?=set_value('payable_total','0')?>" class="text ui-widget-content ui-corner-all required width_160 jpayable_total" /><?=form_error('payable_total','<span>','</span>')?></td>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="other_deduce" value="<?=set_value('other_deduce','0')?>" class="text ui-widget-content ui-corner-all required width_160 jother_deduce" /><?=form_error('other_deduce','<span>','</span>')?></td>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="deduced_total" value="<?=set_value('deduced_total','0')?>" class="text ui-widget-content ui-corner-all required width_160 jdeduced_total" /><?=form_error('deduced_total','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Total Payment</h3>
        <table>
            <tr>
                <th style="width:200px;">Net Pay <span class='req_mark'>*</span></th>
                <td><input type="text" name="net_pay" value="<?=set_value('net_pay','0')?>" class="text ui-widget-content ui-corner-all required width_160 jnet_pay" /><?=form_error('net_pay','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To be Added <span class='req_mark'>*</span></th>
                <td><input type="text" name="to_be_added" value="<?=set_value('payable_total','0')?>" class="text ui-widget-content ui-corner-all required width_160 jtobe_added" /><?=form_error('to_be_added','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To be Deduce <span class='req_mark'>*</span></th>
                <td><input type="text" name="to_be_deduce" value="<?=set_value('deduced_total','0')?>" class="text ui-widget-content ui-corner-all required width_160 jtobe_deduce" /><?=form_error('to_be_deduce','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total <span class='req_mark'>*</span></th>
                <td><input type="text" name="total" value="<?=set_value('total','0')?>" class="text ui-widget-content ui-corner-all required width_160 jtotal" /><?=form_error('total','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <table>
            <tr>
                <th style="width:200px;">Paid Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=set_value('paid_amount','0')?>" class="text ui-widget-content ui-corner-all required width_160 js_paid_amount" /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=set_value('paid_date')?>" class="text ui-widget-content ui-corner-all required width_160 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Mode <span class='req_mark'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',set_value('pay_mood'))?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details <span class='req_mark'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('STAFF_PAYMENT',set_value('pay_details_id'))?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Due <span class='req_mark'>*</span></th>
                <td><input type="text" name="due" value="<?=set_value('due')?>" class="text ui-widget-content ui-corner-all required width_160 js_due" /><?=form_error('due','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <table>
            <tr>
                <th style="width:200px;">Paid Holidays (Days/Hours) <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_holidays" value="<?=set_value('paid_holidays')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_holidays','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Absent/Sick/Excuse (Days/Hours) <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_absent" value="<?=set_value('paid_absent')?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('paid_absent','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="comments" rows="3" cols="30"><?=set_value('comments')?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='Save' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </div>
</form>