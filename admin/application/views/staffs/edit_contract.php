<form id="valid_form" action='<?=site_url('staffs/edit_staff/'.$staffs_id.'/edit_contract')?>' method='post'>
    <div class='form_content'>
        <h3>Employment Information</h3>
        <table>
            <tr>
                <th>Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=$admission_date?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Employment Type <span class='req_mark'>*</span></th>
                <td><select name="employ_type" class="required"><?=combo::get_type_options('EMPLOYMENT_TYPE',$employ_type)?></select><?=form_error('employ_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Employment Nature <span class='req_mark'>*</span></th>
                <td><select name="employ_nature" class="input_txt"><?=combo::get_type_options('EMPLOYMENT_NATURE',$employ_nature)?></select><?=form_error('employ_nature','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Duration </th>
                <td><input type='text' name='employ_duration' value='<?=$employ_duration?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('employ_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Start Date </th>
                <td><input type='text' name='start_date' value='<?=$start_date?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>End Date </th>
                <td><input type='text' name='end_date' value='<?=$end_date?>' class='text ui-widget-content ui-corner-all  width_80 date_picker' /><?=form_error('end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Days Per Week </th>
                <td><input type='text' name='days_per_week' value='<?=$days_per_week?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('days_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Hours Per Week </th>
                <td><input type='text' name='hours_per_week' value='<?=$hours_per_week?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('hours_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Salary Type <span class='req_mark'>*</span></th>
                <td><select name="salary_type" class="ui-corner-all required"><?=combo::get_type_options('SALARY_TYPE',$salary_type)?></select><?=form_error('salary_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Amount <span class='req_mark'>*</span></th>
                <td><input type='text' name='amount' value='<?=$amount?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>National ID Number <span class='req_mark'>*</span></th>
                <td><input type='text' name='ni_number' value='<?=$ni_number?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('ni_number','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments <span class='req_mark'>*</span></th>
                <td><textarea name="contract_comment" rows="5" cols="40" class="ui-widget-content ui-corner-all required"><?=$contract_comment?></textarea><?=form_error('contract_comment','<span class="block">','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Work Schedule</h3>
        <table>
            <tr class="title"><th>Day of Week</th><th>From</th><th>To</th></tr>
            <?php $shifts=sql::rows('staff_shift',"staffs_id=$staffs_id");
            for($inc=0;$inc<7;$inc++) { ?>
            <tr>
                <td><select name='day[]' class="ui-corner-all width_150"><?=combo::get_day_options($shifts[$inc]['day_of_week'])?></select></td>
                <td><input type='text' name='from_time[]' value="<?=$shifts[$inc]['from_time']?>" class='text ui-widget-content ui-corner-all  width_150' /></td>
                <td><input type='text' name='to_time[]' value="<?=$shifts[$inc]['to_time']?>" class='text ui-widget-content ui-corner-all width_150' /></td>
                <!--<td><select name='shift[]' class="ui-corner-all "><?=$this->mod_staffs->get_shift_options($shifts[$inc]['shift'])?></select></td>-->
            </tr>
                <?php }  ?>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='finish' value='Finish' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>