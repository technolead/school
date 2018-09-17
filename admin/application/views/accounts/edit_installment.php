<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form action="<?=site_url('accounts/edit_installment/'.$installment_id)?>" method="post">
        <table>
            <tr><th>Class Name</th><td><?=$class_name?></td></tr>
            
            <tr><th>Class Fee</th><td><input type="text" name="class_fee" value="<?=$class_fee?>" readonly class="text ui-widget-content ui-corner-all required width_160" /></td></tr>
            <tr><th>Total Fee</th><td><input type="text" name="total_balance" value="<?=$total_balance-$this->mod_accounts->get_installed_amount($class_fee_id,$installment_id)?>" readonly class="text ui-widget-content ui-corner-all required width_160" /></td></tr>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="committed_date" value="<?=$committed_date?>" class="text ui-widget-content ui-corner-all required width_80 date_picker" /><?=form_error('committed_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="amount" value="<?=$amount?>" class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td><textarea name="notes" rows="3" cols="30"><?=$notes?></textarea><?=form_error('notes','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
        </table>
    </form>
</div>