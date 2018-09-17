<div class='form_content'>
    <h3>Level Fee Registration</h3>
    <form id="valid_form" action="<?=site_url('accounts/new_level_fee')?>" method='post'>
        <table>
            <tr>
                <th>Programme Name: <span class='req_mark'>*</span></th>
                <td><select name="programs_id" class="jprograms_id"><?=combo::registered_program_options($std_info['student_id'],set_value('programs_id'))?></select><?=form_error('programs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Name <span class='req_mark'>*</span></th>
                <td><select name="levels_id" class="jlevels_list jaccount_level_id"><?=combo::get_program_levels(set_value('programs_id'),set_value('levels_id'))?></select><?=form_error('levels_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Fee</th>
                <td><input type="text" name="level_fee" value="<?=set_value('level_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jmapped_value" readonly /><?=form_error('level_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Extended Date</th>
                <td><input type="text" name="level_extd_date" value="<?=set_value('level_extd_date')?>" class="text ui-widget-content ui-corner-all required width_160 jextended_date date_picker" /><?=form_error('level_extd_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Extended Level Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="extended_fee" value="<?=set_value('extended_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jextended_fee" /><span class="jextended_error"></span><?=form_error('extended_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Registration Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="reg_fee" value="<?=set_value('reg_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jreg_fee" autocomplete="off" /><span class="jreg_error"></span><?=form_error('reg_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Scholarship/Discount <span class='req_mark'>*</span></th>
                <td><input type="text" name="discount" value="<?=set_value('discount')?>" class="text ui-widget-content ui-corner-all required width_160 jdiscount" autocomplete="off" /><span class="jdiscount_error"></span><?=form_error('discount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Awarding Body Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="awarding_body_fee" value="<?=set_value('awarding_body_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jawarding_body_fee" autocomplete="off" /><span class="jawarding_body_fee_error"></span><?=form_error('awarding_body_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Deferral <span class='req_mark'>*</span></th>
                <td><input type="text" name="deferral" value="<?=set_value('deferral')?>" class="text ui-widget-content ui-corner-all required width_160 jdeferral" autocomplete="off" /><span class="jdeferral_error"></span><?=form_error('deferral','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Library Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="library_fee" value="<?=set_value('library_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jlibrary_fee" autocomplete="off" /><span class="jlibrary_fee_error"></span><?=form_error('library_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="others_fee" value="<?=set_value('others_fee')?>" class="text ui-widget-content ui-corner-all required width_160 jothers_fee" autocomplete="off" /><span class="jothers_fee_error"></span><?=form_error('others_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Deposit <span class='req_mark'>*</span></th>
                <td><input type="text" name="deposit" value="<?=set_value('deposit')?>" class="text ui-widget-content ui-corner-all required width_160 jdeposit" autocomplete="off" /><span class="jdeposit_error"></span><?=form_error('deposit','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Committed Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="committed_amount" value="<?=set_value('committed_amount')?>" class="text ui-widget-content ui-corner-all required width_160 jcommitted_amount" autocomplete="off" /><span class="jcommitted_amount_error"></span><?=form_error('committed_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Balance <span class='req_mark'>*</span></th>
                <td><input type="text" name="total_balance" value="<?=set_value('total_balance')?>" class="text ui-widget-content ui-corner-all required width_160 jtotal_balance" autocomplete="off" /><span class="jbalance_error"></span><?=form_error('total_balance','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="level_comment" rows="3" cols="30"><?=set_value('level_comment')?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
        </table>
    </form>
</div>