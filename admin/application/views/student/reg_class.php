<div class='form_content'>
    <h3>Class Registration</h3>
    <form id="valid_form" action='<?=site_url('student/new_student/reg_class')?>' method='post'>
        <table>
            <tr>
                <th style="width:240px;">Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jawarding_body_id required"><?=combo::get_awarding_body_options(set_value('awarding_body_id'))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_list jclass_details_id required"><?=combo::get_awarding_body_class(set_value('awarding_body_id'),set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Class Duration <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_duration' readonly value='<?=set_value('class_duration')?>' class='input_txt jclass_duration required width_250' /><?=form_error('class_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_start_date' value='<?=set_value('class_start_date')?>' class='text ui-widget-content ui-corner-all  width_80 required date_picker' /><?=form_error('class_start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_end_date' value='<?=set_value('class_end_date')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('class_end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Status <span class='req_mark'>*</span></th>
                <td><select name="class_status" class="ui-corner-all required"><?=combo::get_status_options('CLASS_STATUS',set_value('class_status'))?></select><?=form_error('class_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Status Change Date</th>
                <td><input type='text' name='class_status_date' value='<?=set_value('class_status_date')?>' class='text ui-widget-content ui-corner-all  width_80 date_picker' /><?=form_error('class_status_date','<span>','</span>')?></td>
            </tr>
           
            <tr>
                <th>Comments</th>
                <td><textarea name='class_comment' rows='5' cols='40' class="ui-widget-content ui-corner-all"><?=set_value('class_comment')?></textarea></td>
            </tr>
        </table>
        <div class="txt_center">
            <input type='submit' name='save_class' value='Save & Continue to Session' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
    </form>
</div>