<div class='table_content'>
    <form method="post" action="#submitForm" onsubmit="javascript:return result.update_std_result(this);" title="result/student_result/<?=$student_id?>">
        <table>
            <tr class='title'>
                <th>Subject Name</th>
                <th>Exam Name</th>
                <th>Exam Date</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Attempt</th>
                <th>Note</th>
                <th>Result</th>
            </tr>
            <tr>
                <th><?=$module_name?></th>
                <th><?=$exam_name?></th>
                <th><input type="text" name="exam_date" style="width:80px;" value="<?=$exam_date?>" readonly class="date_picker" /></th>
                <th><input type="text" name="marks" style="width:80px;" value="<?=$marks?>" class="jmark" title="<?=$student_id?>" /></th>
                <th>
                    <span class="jgrade_<?=$student_id?>"><?=$grade?></span>
                    <input type="hidden" name="grade" value="" class="jgradeInp_<?=$student_id?>" />
                </th>
                <th><select name='attempt'><?=combo::get_type_options('SUBJECT_ATTEMPT',$attempt)?></select></th>
                <td><input type="text" name="notes" value="<?=$notes?>" class="width_80" /></td>
                <th><select name='result_status'><?=$this->mod_result->get_result_options($result_status)?></select></th>
            </tr>
            <tr><th colspan="7"><input type='submit' name='generate' value='Generate Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></th></tr>
        </table>
    </form>
</div>