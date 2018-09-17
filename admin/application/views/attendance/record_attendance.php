<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('attendance/record_attendance')?>' method='post'>
        <table>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='date' value='<?=set_value('date')?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="required ui-corner-all jsession_class"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>

             <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jsession_class_list required ui-corner-all"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>             
            
            <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="section" class="required"><?=combo::get_type_options('SECTION',set_value('section'))?></select><?=form_error('session_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Type <span class='req_mark'>*</span></th>
                <td><select name="attendance_type_id" class="required ui-corner-all"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attendance_type_id'),TRUE)?></select><?=form_error('attendance_type_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>