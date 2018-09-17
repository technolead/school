<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jawarding_body_id ui-widget-content ui-corner-all required"><?=combo::get_awarding_body_options(set_value('awarding_body_id',$awarding_body_id))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_list jclass_id ui-widget-content ui-corner-all required"><?=combo::get_awarding_body_class(set_value('awarding_body_id',$awarding_body_id),set_value('class_id',$class_id))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="ui-widget-content ui-corner-all required"><?=combo::get_session_options(set_value('session_id',$session_id))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session Duration: <span class='req_mark'>*</span></th>
                <td><input type='text' name='session_duration' value='<?=set_value('session_duration',$session_duration)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('session_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='start_date' value='<?=set_value('start_date',$start_date)?>' class='text ui-widget-content ui-corner-all required width_200 date_picker' /><?=form_error('start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='end_date' value='<?=set_value('end_date',$end_date)?>' class='text ui-widget-content ui-corner-all required width_200 date_picker' /><?=form_error('end_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>