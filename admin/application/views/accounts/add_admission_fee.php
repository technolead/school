<div class='form_content'>
    <h3>Admission Fee Registration</h3>
    <form id="valid_form" action="<?=site_url($action)?>" method='post'>
        <table>

            <tr>
                <th >Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jawarding_body_session required"><?=combo::get_awarding_body_options(set_value('awarding_body_id',$awarding_body_id))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="input_txt jsession_list jsession_class required"><?=combo::get_awarding_body_session(set_value('awarding_body_id',$awarding_body_id),set_value('session_id',$session_id))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jaccount_class_id jclass_list jclass_details jsession_class_list"><?=combo::get_session_class(set_value('session_id',$session_id),set_value('awarding_body_id',$awarding_body_id),set_value('class_id',$class_id))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Admission Fee <span class='req_mark'>*</span></th>
                <td><input type="text" name="admission_fee" value="<?=set_value('admission_fee',$class_fee)?>" class="text ui-widget-content ui-corner-all required width_160 jclass_fee " readonly /><?=form_error('admission_fee','<span>','</span>')?></td>
            </tr>
            

            <tr>
                <th>Is Paid <span class='req_mark'>*</span></th>
                <td>
                    <select name="is_paid">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                    <?=form_error('is_paid','<span>','</span>')?>
                </td>
            </tr>

            <tr>
                <th>Paid Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=set_value('paid_date',$paid_date)?>" class="text ui-widget-content ui-corner-all required width_80 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Comments</th>
                <td><textarea name="comments" rows="3" cols="30"><?=set_value('comments',$comments)?></textarea></td>
            </tr>

            <tr>
                <th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='<?=$submit_value?>' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>


