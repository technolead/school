<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Date <?if($submit_name!="view"){?><span class='req_mark'>*</span><?}?></th>
                <td><input type='text' name='register_date' value='<?=set_value('register_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker <?if($submit_name!="view")echo 'required' ?> ' /><?=form_error('register_date','<span>','</span>')?></td>
            </tr>
            

            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="required jsession_class ui-corner-all"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="required jclass_details jclass_list jclass_for_exam jsession_class_list ui-corner-all"><?=combo::get_session_class(set_value('session_id'),set_value('class_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Exam <span class='req_mark'>*</span></th>
                <td><select name="exam_id" class="required jexam_list"><?=combo::get_exam_for_class(set_value('session_id',$session_id),  set_value('class_id',$class_id),set_value('exam_id'))?></select><?=form_error('exam_id','<span>','</span>')?></td>
            </tr>


            

            <tr>
                <th>&nbsp;</th><td><input type='submit' name='<?=$submit_name?>' value='<?=$submit_value?>' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>