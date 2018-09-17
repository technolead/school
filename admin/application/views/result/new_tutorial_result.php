<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('result/new_tutorial_result')?>' method='post'>
        <table>
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="required"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="required jclass_for_exam jclass_module"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('classs_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Exam <span class='req_mark'>*</span></th>
                <td><select name="exam_id" class="required jexam_list"><?=combo::get_exam_for_class(set_value('session_id',$session_id),  set_value('class_id',$class_id),set_value('exam_id'))?></select><?=form_error('exam_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select class="jmodule_list required width_200" name="module_id"><?=combo::get_class_module(set_value('class_id'),set_value('module_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Title/Description <span class='req_mark'>*</span></th>
                <td><input type="text" name="description" value="<?=set_value('description')?>" class="required text ui-corner-all" /><?=form_error('description','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Total Marks <span class='req_mark'>*</span></th>
                <td><input type="text" name="total_marks" value="<?=set_value('total_marks')?>" class="required text ui-corner-all number" /><?=form_error('total_marks','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Tutorial Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="tutorial_date" value="<?=set_value('tutorial_date')?>" class="date_picker required text ui-widget-content ui-corner-all width_80" /><?=form_error('tutorial_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='continue' value='Continue to Add Student Result' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>