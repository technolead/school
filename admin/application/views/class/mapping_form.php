<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="ui-widget-content ui-corner-all required"><?=combo::get_session_options(set_value('session_id',$session_id))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="ui-widget-content ui-corner-all required"><?=combo::get_class_options(set_value('class_id',$class_id))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Duration <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_duration' value='<?=set_value('class_duration',$class_duration)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('class_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='start_date' value='<?=set_value('start_date',$start_date)?>' class='text ui-widget-content ui-corner-all required width_200 date_picker' /><?=form_error('start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='end_date' value='<?=set_value('end_date',$end_date)?>' class='text ui-widget-content ui-corner-all required width_200 date_picker' /><?=form_error('end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Admission Fee <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_fee' value='<?=set_value('class_fee',$class_fee)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('class_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Monthly Fee <span class='req_mark'>*</span></th>
                <td><input type='text' name='monthly_fee' value='<?=set_value('monthly_fee',$monthly_fee)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('monthly_fee','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class Teacher <span class='req_mark'>*</span></th>
                <td><select name="staff_id" class="input_txt"><?=combo::get_staff_options(set_value('staff_id',$staff_id))?></select><?=form_error('staff_id','<span>','</span>')?></td>
            </tr>

            <?if($exam_id!=''){$exam_id=explode(',',$exam_id);}?>
            <tr>
                <th>Exams <span class='req_mark'>*</span></th>
                <td><select name='exam_id[]' class='ui-widget-content ui-corner-all required' multiple size="5"><?=combo::get_exam_options(set_value('exam_id',$exam_id))?></select><?=form_error('exam_id','<span>','</span>')?></td>
            </tr>

            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='<?=$submit_value?>' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>