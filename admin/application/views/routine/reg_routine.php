<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="required jsession_class ui-corner-all"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="required jsession_class_list ui-corner-all"><?=combo::get_session_class(set_value('session_id'),set_value('class_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>


            <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="section" class="required"><?=combo::get_type_options('SECTION',set_value('section',$section))?></select><?=form_error('section','<span>','</span>')?></td>
            </tr>

           


            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>