<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('attendance/manage_attendance')?>' method='post'>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td>
                    <input type="hidden" name="student_id" value="<?=$student_id?>" />
                    <input type='text' autocomplete='off' class='required width_160 jstudent_username text ui-widget-content ui-corner-all'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?>
                    <div class="jstudent_list"></div>
                </td>
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
                <th>Date</th>
                <td><input type='text' name='from_date' value='<?=set_value('from_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('from_date','<span>','</span>')?> To <input type='text' name='from_date' value='<?=set_value('to_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('to_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='view' value='View' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>