<form id="valid_form" action='<?=site_url('student/new_student/reg_session')?>' method='post'>
    <div class='form_content'>
        <h3>Session Registration</h3>
        <table>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_list jclass_id jclass_details_id jclass_module jclass_session required"><?=combo::registered_class_options($con_student_id,set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jc_awarding_body required" readonly><?=combo::get_class_awarding_body(set_value('class_id'))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>
            
            

            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="input_txt jsession_id jclass_session_list required"><?=combo::get_class_session(set_value('class_id'),set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='ses_start_date' value='<?=set_value('ses_start_date')?>' class='text ui-widget-content ui-corner-all date_picker width_80 js_start_date' readonly /><?=form_error('ses_start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='ses_end_date' value='<?=set_value('ses_end_date')?>' class='text ui-widget-content ui-corner-all date_picker width_80 js_end_date' readonly /><?=form_error('ses_end_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session Duration <span class='req_mark'>*</span></th>
                <td><input type='text' name='session_duration' value='<?=set_value('session_duration')?>' class='text ui-widget-content ui-corner-all required width_250 js_session_duration' readonly /><?=form_error('session_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session Status <span class='req_mark'>*</span></th>
                <td><select name="session_status" class="required"><?=combo::get_status_options('SESSION_STATUS',set_value('session_status'))?></select><?=form_error('session_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Session Status Change Date</th>
                <td><input type='text' name='session_status_date' value='<?=set_value('session_status_date')?>' class='text ui-widget-content ui-corner-all  width_80 date_picker' /><?=form_error('session_status_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Personal Tutor <span class='req_mark'>*</span></th>
                <td><select name="staffs_id" class="required"><?=combo::get_staff_options(set_value('staffs_id'))?></select><?=form_error('staffs_id','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="session_section" class="required"><?=combo::get_type_options('SECTION',set_value('session_section'))?></select><?=form_error('session_section','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Module Registration</h3>
        <table>
            <tr><th style="text-align: left">Module</th><th style="text-align: left">Module Status</th><th style="text-align: left">Attempt</th><th style="text-align: left">Module Comment</th></tr>
            <?php for($inc=0;$inc<10;$inc++) { ?>
            <tr>
                <td><select class="jmodule_list jmodule_level input_txt width_150" title="jlevel_name_<?=$inc?>" name="module_id[]"><?=combo::get_class_module(set_value('class_id'),set_value("module_id[$inc]"))?></select></td>
                <td><select name="module_status[]" class="input_txt"><?=combo::get_status_options('MODULE_STATUS',set_value("module_status[$inc]"))?></select></td>
                <td><select name="attempt[]" class="width_80"><?=combo::get_type_options('MODULE_ATTEMPT',set_value("attempt[$inc]"))?></select></td>
                <td><input type="text" name="module_comment[]" class="input_txt width_150" value="<?=set_value("module_comment[$inc]")?>" /></td>
            </tr>
                <?php }  ?>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='finish' value='Finish' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>