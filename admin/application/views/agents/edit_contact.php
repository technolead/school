<form id="valid_form" action='<?=site_url('agents/edit_agent/'.$agents_id.'/edit_contact')?>' method='post'>
    <div class='form_content'>
        <h3>Contact Agreement</h3>
        <table>
            <tr>
                <th style="width:240px;">Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=$admission_date?>' class='text ui-widget-content required ui-corner-all width_160 date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Contact Duration <span class='req_mark'>*</span></th>
                <td><input type='text' name='contact_duration' value='<?=$contact_duration?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('contact_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='start_date' value='<?=$start_date?>' class='text ui-widget-content required ui-corner-all width_160 date_picker' /><?=form_error('start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='end_date' value='<?=$end_date?>' class='text ui-widget-content required ui-corner-all width_160 date_picker' /><?=form_error('end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Salary/Commission <span class='req_mark'>*</span></th>
                <td><select name="salary_commission" class="text ui-widget-content required ui-corner-all"><?=$this->mod_agents->get_salary_commission($salary_commission)?></select><?=form_error('salary_commission','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Days Per Week <span class='req_mark'>*</span></th>
                <td><input type='text' name='total_days_per_week' value='<?=$total_days_per_week?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('total_days_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Total Hours Per Week <span class='req_mark'>*</span></th>
                <td><input type='text' name='total_hours_per_week' value='<?=$total_hours_per_week?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('total_hours_per_week','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Salary Type <span class='req_mark'>*</span></th>
                <td><select name="salary_type" class="text ui-widget-content required ui-corner-all"><?=combo::get_type_options('SALARY_TYPE',$salary_type)?></select><?=form_error('salary_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Gross Pay <span class='req_mark'>*</span></th>
                <td><input type='text' name='gross_pay' value='<?=$gross_pay?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('gross_pay','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Net Pay <span class='req_mark'>*</span></th>
                <td><input type='text' name='net_pay' value='<?=$net_pay?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('net_pay','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>NI Number <span class='req_mark'>*</span></th>
                <td><input type='text' name='ni_number' value='<?=$ni_number?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('ni_number','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Registration Fees</h3>
        <table>
            <tr>
                <th style="width:240px;">Registration Fee <span class='req_mark'>*</span></th>
                <td><input type='text' name='reg_fee' value='<?=$reg_fee?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('reg_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Minimum Deposit <span class='req_mark'>*</span></th>
                <td><input type='text' name='min_deposit' value='<?=$min_deposit?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('min_deposit','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>International Commission <span class='req_mark'>*</span></th>
                <td><select name="int_commission" class="text ui-widget-content required ui-corner-all"><?=$this->mod_agents->get_commission_options($int_commission)?></select><?=form_error('int_commission','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Local Commission <span class='req_mark'>*</span></th>
                <td><select name="local_commission" class="text ui-widget-content required ui-corner-all"><?=$this->mod_agents->get_commission_options($local_commission)?></select><?=form_error('local_commission','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Commission on Reg. Fee ( International ) <span class='req_mark'>*</span></th>
                <td><input type='text' name='int_comm_reg_fee' value='<?=$int_comm_reg_fee?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('int_comm_reg_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Commission on Reg. Fee ( Local ) <span class='req_mark'>*</span></th>
                <td><input type='text' name='local_comm_reg_fee' value='<?=$local_comm_reg_fee?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('local_comm_reg_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Commission on Tuition Fee ( International ) <span class='req_mark'>*</span></th>
                <td><input type='text' name='int_comm_tuition_fee' value='<?=$int_comm_tuition_fee?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('int_comm_tuition_fee','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Commission on Tuition Fee ( Local ) <span class='req_mark'>*</span></th>
                <td><input type='text' name='local_comm_tuition_fee' value='<?=$local_comm_tuition_fee?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('local_comm_tuition_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Fixed Amount Per Student <span class='req_mark'>*</span></th>
                <td><input type='text' name='fixed_amt_per_student' value='<?=$fixed_amt_per_student?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('fixed_amt_per_student','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Contact Comment <span class='req_mark'>*</span></th>
                <td><textarea name="contact_comment" class="text ui-widget-content required ui-corner-all" rows="5" cols="40"><?=$contact_comment?></textarea><?=form_error('contact_comment','<span class="block">','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='finish' value='Finish' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>