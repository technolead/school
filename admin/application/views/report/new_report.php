<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('report/new_report')?>' method='post'>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content required ui-corner-all width_160 jstudent_username'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?><div class="jstudent_list"></div></td>
            </tr>

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
            
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='con_report' value='Continue to Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>