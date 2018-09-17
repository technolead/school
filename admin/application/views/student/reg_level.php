<div class='form_content'>
    <h3>Level Registration</h3>
    <form id="valid_form" action='<?=site_url('student/new_student/reg_level')?>' method='post'>
        <table>
            <tr>
                <th style="width:200px;">Programme Name: <span class='req_mark'>*</span></th>
                <td><select name="programs_id" class="jprogram_list jprograms_id jporgrams_details_id required"><?=combo::registered_program_options($con_student_id,set_value('programs_id'))?></select><?=form_error('programs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jp_awarding_body required"><?=combo::get_program_awarding_body(set_value('programs_id'))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Specialization: <span class='req_mark'>*</span></th>
                <td><select name="specialization_id" class="jspecialization_id required"><?=combo::get_program_specialization_options(set_value('programs_id'),set_value('specialization_id'))?></select><?=form_error('specialization_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Current Level <span class='req_mark'>*</span></th>
                <td><select name="levels_id" class="jlevels_list jlevel_id required"><?=combo::get_program_levels(set_value('programs_id'),set_value('levels_id'))?></select><?=form_error('levels_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Duration <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_duration' value='<?=set_value('level_duration')?>' readonly class='required jlevel_duration' /><?=form_error('level_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_start_date' value='<?=set_value('level_start_date')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('level_start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_end_date' value='<?=set_value('level_end_date')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('level_end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Status <span class='req_mark'>*</span></th>
                <td><select name="level_status" class="required"><?=combo::get_status_options('LEVEL_STATUS',set_value('level_status'))?></select><?=form_error('level_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Status Change Date</th>
                <td><input type='text' name='level_status_date' value='<?=set_value('level_status_date')?>' class='text ui-widget-content ui-corner-all  width_80 date_picker' /><?=form_error('level_status_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name='level_comment' rows='5' cols='40' class="input_txt"><?=set_value('level_comment')?></textarea><?=form_error('level_comment','<span>','</span>')?></td>
            </tr>
        </table>
        <div class="txt_center">
            <input type='submit' name='continue_level' value='Continue to Add Semester Reg.' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
    </form>
</div>