<form id="valid_form" action='<?=site_url('staffs/new_staff/contract')?>' method='post'>
    <div class='form_content'>
        <h3>Employment Information</h3>
        <table>
            <tr>
                <th>Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=set_value('admission_date')?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Employment Type <span class='req_mark'>*</span></th>
                <td><select name="employ_type" class="required"><?=combo::get_type_options('EMPLOYMENT_TYPE',set_value('employ_type'))?></select><?=form_error('employ_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Employment Nature <span class='req_mark'>*</span></th>
                <td><select name="employ_nature" class="required"><?=combo::get_type_options('EMPLOYMENT_NATURE',set_value('employ_nature'))?></select><?=form_error('employ_nature','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Duration </th>
                <td><input type='text' name='employ_duration' value='<?=set_value('employ_duration')?>' class='text ui-widget-content ui-corner-all width_250' /><?=form_error('employ_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Start Date </th>
                <td><input type='text' name='start_date' value='<?=set_value('start_date')?>' class='text ui-widget-content ui-corner-all width_160 date_picker' /><?=form_error('start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>End Date </th>
                <td><input type='text' name='end_date' value='<?=set_value('end_date')?>' class='text ui-widget-content ui-corner-all  width_160 date_picker' /><?=form_error('end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Days Per Week </th>
                <td><input type='text' name='days_per_week' value='<?=set_value('days_per_week')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('days_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Hours Per Week </th>
                <td><input type='text' name='hours_per_week' value='<?=set_value('hours_per_week')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('hours_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Salary Type <span class='req_mark'>*</span></th>
                <td><select name="salary_type" class="required"><?=combo::get_type_options('SALARY_TYPE',set_value('salary_type'))?></select><?=form_error('salary_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Amount <span class='req_mark'>*</span></th>
                <td><input type='text' name='amount' value='<?=set_value('amount')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>National ID Number <span class='req_mark'>*</span></th>
                <td><input type='text' name='ni_number' value='<?=set_value('ni_number')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('ni_number','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments <span class='req_mark'>*</span></th>
                <td><textarea name="contract_comment" rows="5" cols="40" class="ui-widget-content ui-corner-all required"><?=set_value('contract_comment')?></textarea><?=form_error('contract_comment','<span class="block">','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Work Schedule</h3>
        <table>
            <tr class="title"><th>Day</th><th>From Time</th><th>To Time</th></tr>
            <?php for($inc=0;$inc<7;$inc++) { ?>
            <tr>
                <td><select name='day[]' class="input_txt width_150"><?=combo::get_day_options(set_value("day[$inc]"))?></select></td>
                <td><input type='text' name='from_time[]' value="<?=set_value("from_time[$inc]")?>" class='text ui-widget-content ui-corner-all' /></td>
                <td><input type='text' name='to_time[]' value="<?=set_value("to_time[$inc]")?>" class='text ui-widget-content ui-corner-all' /></td>
                <!--<td><select name='shift[]' class="input_txt"><?=$this->mod_staffs->get_shift_options(set_value("shift[$inc]"))?></select></td>-->
            </tr>
                <?php }  ?>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='finish' value='Finish' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>