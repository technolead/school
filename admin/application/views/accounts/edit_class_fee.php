<div class='form_content'>	
    <h3>Class Fee Registration</h3>
    <form id="valid_form" action="<?=site_url('accounts/edit_class_fee/'.$class_fee_id)?>" method='post'>
        <table>
            <tr>
                <th>Class</th>
                <td><select name="class_id" class="jaccount_class_id"><?=combo::registered_class_options($std_info['student_id'],$class_id)?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Fee</th>
                <td><input type="text" name="class_fee" value="<?=$class_fee?>" readonly class="text ui-widget-content ui-corner-all required width_160 jclass_fee jmapped_value" /><?=form_error('class_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Start Date</th>
                <td><input type="text" name="class_start_date" value="<?=$class_start_date?>" readonly class="text ui-widget-content ui-corner-all required width_160 jstart_date" /></td>
            </tr>
            <tr>
                <th>Class End Date</th>
                <td><input type="text" name="class_end_date" value="<?=$class_end_date?>" readonly class="text ui-widget-content ui-corner-all required width_160 jend_date" /></td>
            </tr>
            
            <tr>
                <th>Registration Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="reg_fee" value="<?=$reg_fee?>" class="text ui-widget-content ui-corner-all required width_160 jreg_fee" autocomplete="off" /><span class="jreg_error"></span><?=form_error('reg_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Scholarship/Discount <span class='req_mark'>*</span></th>
                <td><input type="text" name="discount" value="<?=$discount?>" class="text ui-widget-content ui-corner-all required width_160 jdiscount" autocomplete="off" /><span class="jdiscount_error"></span><?=form_error('discount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Awarding Body Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="awarding_body_fee" value="<?=$awarding_body_fee?>" class="text ui-widget-content ui-corner-all required width_160 jawarding_body_fee" autocomplete="off" /><span class="jawarding_body_fee_error"></span><?=form_error('awarding_body_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Deferral <span class='req_mark'>*</span></th>
                <td><input type="text" name="deferral" value="<?=$deferral?>" class="text ui-widget-content ui-corner-all required width_160 jdeferral" autocomplete="off" /><span class="jdeferral_error"></span><?=form_error('deferral','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Library Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="library_fee" value="<?=$library_fee?>" class="text ui-widget-content ui-corner-all required width_160 jlibrary_fee" autocomplete="off" /><span class="jlibrary_fee_error"></span><?=form_error('library_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Others <span class='req_mark'>*</span></th>
                <td><input type="text" name="others_fee" value="<?=$others_fee?>" class="text ui-widget-content ui-corner-all required width_160 jothers_fee" autocomplete="off" /><span class="jothers_fee_error"></span><?=form_error('others_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Deposit <span class='req_mark'>*</span></th>
                <td><input type="text" name="deposit" value="<?=$deposit?>" class="text ui-widget-content ui-corner-all required width_160 jdeposit" autocomplete="off" /><span class="jdeposit_error"></span><?=form_error('deposit','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Committed Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="committed_amount" value="<?=$committed_amount?>" class="text ui-widget-content ui-corner-all required width_160 jcommitted_amount" autocomplete="off" /><span class="jcommitted_amount_error"></span><?=form_error('committed_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Balance <span class='req_mark'>*</span></th>
                <td><input type="text" name="total_balance" value="<?=$total_balance?>" class="text ui-widget-content ui-corner-all required width_160 jtotal_balance" autocomplete="off" /><span class="jbalance_error"></span><?=form_error('totla_balance','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="class_comment" rows="3" cols="30"><?=$class_comment?></textarea></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td>
                    <input type='submit' name='update' value='Update' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>