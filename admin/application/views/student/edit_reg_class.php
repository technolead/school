<div class='form_content'>
    <h3>Class Registration</h3>
    <form action='<?=site_url('student/edit_reg_class/'.$reg_class_id)?>' method='post'>
        
        <table>
            
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="input_txt jsession_class required"><?=combo::get_session_options(set_value('session_id',$session_id))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_details jclass_list jselected_class_id jsession_class_list required"><?=combo::get_session_class(set_value('session_id',$session_id),set_value('class_id',$class_id))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_start_date' value='<?=$class_start_date?>' class='text ui-widget-content ui-corner-all  width_80 jc_start_date' readonly /><?=form_error('class_start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_end_date' value='<?=$class_end_date?>' class='text ui-widget-content ui-corner-all  width_80 jc_end_date' readonly /><?=form_error('class_end_date','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="section" class="required"><?=combo::get_type_options('SECTION',set_value('section',$section))?></select><?=form_error('section','<span>','</span>')?></td>
            </tr>
            
             <tr>
                <th>Optional/Elective Subject </th>
                <td><select name="optional_module_id" class="jclass_optional_module"><?=combo::get_class_optional_module_id(set_value('class_id',$class_id),set_value('optional_module_id',$optional_module_id))?></select></td>
            </tr>


            <tr>
                <th>Privilege <span class='req_mark'>*</span></th>
                <td>
                    <select name="privilege" class="required">
                        <?=common::get_privilege_options(set_value('privilege',$privilege))?>
                    </select>
                    <?=form_error('privilege','<span>','</span>')?>
                </td>
            </tr>

            <tr>
                <th>Class Status<span class='req_mark'>*</span></th>
                <!--<td><select name="class_status" class="input_txt"><?=combo::get_status_options('CLASS_STATUS',$class_status)?></select><?=form_error('class_status','<span>','</span>')?></td>-->
                <td><select name="class_status" class="input_txt"><?=combo::get_class_module_status_options($class_status)?></select><?=form_error('class_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Status Change Date</th>
                <td><input type='text' name='class_status_date' value='<?=$class_status_date?>' class='input_txt width_160 date_picker' /><?=form_error('class_status_date','<span>','</span>')?></td>
            </tr>
           
            <tr>
                <th>Comments</th>
                <td><textarea name='class_comment' rows='5' cols='40' class="input_txt"><?=$class_comment?></textarea></td>
            </tr>
        </table>
        <div class="txt_center">
            <input type='submit' name='update_class' value='Update Class Reg.' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
    </form>
</div>