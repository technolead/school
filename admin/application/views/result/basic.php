<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('result/students_grades')?>' method='post'>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content required ui-corner-all width_160 jstudent_username'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?><div class="jstudent_list"></div></td>
            </tr>
            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="required jclass_id"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='continue' value='Continue to Student Result' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>