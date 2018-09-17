<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('staff_attd/record_attendance/'.$staffs_id)?>' method='post'>
        <table>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='date' value='<?=set_value('date')?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Present</th>
                <td><input type="radio" name="attendance" value="1" checked /></td>
            </tr>
            <tr>
                <th>Absent</th>
                <td><input type="radio" name="attendance" value="0" /></td>
            </tr>
            <tr>
                <th>Sick</th>
                <td><input type="radio" name="attendance" value="2" /></td>
            </tr>
            <tr>
                <th>Holiday</th>
                <td><input type="radio" name="attendance" value="3" /></td>
            </tr>
			<!--
            <tr>
                <th>Excuse</th>
                <td><input type="radio" name="attendance" value="4" /></td>
            </tr>
			-->
            <tr>
                <th>Hours done <span class='req_mark'>*</span></th>
                <td><input type='text' name='hours' value='<?=set_value('hours',0)?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('hours','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Extra Hours done <span class='req_mark'>*</span></th>
                <td><input type='text' name='extra_hour' value='<?=set_value('extra_hour',0)?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('extra_hour','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Absent Hours <span class='req_mark'>*</span></th>
                <td><input type='text' name='absent_hour' value='<?=set_value('absent_hour',0)?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('absent_hour','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Late <span class='req_mark'>*</span></th>
                <td><input type='text' name='late' value='<?=set_value('late',0)?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('late','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>Authorize <span class='req_mark'>*</span></th>
                <td><select name="authorize"><?=$this->mod_staff_attd->get_authorize(set_value('authorize'))?></select><?=form_error('authorize','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="comments" rows="5" cols="40"><?=set_value('comments')?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>