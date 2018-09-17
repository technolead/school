<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('attendance/print_attendance')?>' method='post'>
        <table>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='date' value='<?=set_value('date')?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="required jclass_id jclass_module"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Subject Name<span class='req_mark'>*</span></th>
                <td><select class="jmodule_list required width_150" name="module_id"><?=combo::get_class_module(set_value('class_id'),set_value("module_id"))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="required"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="section" class="required"><?=combo::get_type_options('SECTION',set_value('section'))?></select><?=form_error('session_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Type <span class='req_mark'>*</span></th>
                <td><select name="attendance_type" class="required"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attendance_type'))?></select><?=form_error('attendance_type','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Taken By</th>
                <td><input type='text' name='taken_by' value='<?=set_value('taken_by')?>' class='text ui-widget-content ui-corner-all width_160' /><?=form_error('class_room','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Print' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>