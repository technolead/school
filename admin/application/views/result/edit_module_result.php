<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=site_url('result/edit_result/'.$module_result_id)?>' method='post'>

        <?$mod_row=sql::row("module","module_id=$module_id");?>
        <table>
            <tr><th>Student Name</th><td><?=$first_name.' '.$last_name?></td></tr>
            <tr><th>Student ID</th><td><?=$user_name?></td></tr>
            <tr><th>Session</th><td><?=$session_name?></td></tr>
            <tr><th>Exam</th><td><?=$exam_name?></td></tr>
            <tr><th>Exam Date</th><td><?=$exam_date?></td></tr>
            <tr><th>Subject Code</th><td><?=$module_code?></td></tr>
            <tr><th>Subject Name</th><td><?=$module_name?></td></tr>
            <tr><th>Exam On Marks</th><td class="jmodule_mark"><?=$mod_row['marks']?></td></tr>
            <tr><th>Subject Status</th><td><?=combo::get_class_module_status($module_status)?></td></tr>
            <tr>
                <th>Marks</th><td><input type="text" name="marks"  class='input_txt jmark' title="<?=$student_id?>"  style="width:80px;" value="<?=$marks?>" /><?=form_error('marks','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Grade</th>
                <td><span class="jgrade_<?=$student_id?>"><?=$grade?></span>
                    <input type="hidden" name="grade" value="" class="jgradeInp_<?=$student_id?>" />
                    <?=form_error('grade','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Attempt</th>
                <td><select name='attempt'><?=combo::get_type_options('SUBJECT_ATTEMPT',$attempt)?></select><?=form_error('attempt','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td><input type="text" name="notes" value="<?=$notes?>" class='input_txt width_200' /><?=form_error('notes','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Result</th>
                <td><select name='result_status'  class='input_txt' ><?=$this->mod_result->get_result_options($result_status)?></select><?=form_error('result_status','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
        </table>
    </form>
</div>