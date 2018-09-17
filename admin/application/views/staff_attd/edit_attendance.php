<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('staff_attd/edit_attendance/'.$attendance_id)?>' method='post'>
        <table>
            <tr>
                <th>Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='date' value='<?=$date?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Present</th>
                <td><input type="radio" name="attendance" value="1" <?php if($present==1){echo 'checked';}?> /></td>
            </tr>
            <tr>
                <th>Absent</th>
                <td><input type="radio" name="attendance" value="0" <?php if($absent==1){echo 'checked';}?> /></td>
            </tr>
            <tr>
                <th>Sick</th>
                <td><input type="radio" name="attendance" value="2" <?php if($sick==1){echo 'checked';}?> /></td>
            </tr>
            <tr>
                <th>Holiday</th>
                <td><input type="radio" name="attendance" value="3" <?php if($holiday==1){echo 'checked';}?> /></td>
            </tr>
            <tr>
                <th>Hours done <span class='req_mark'>*</span></th>
                <td><input type='text' name='hours' value='<?=$hours?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('hours','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Extra Hours done <span class='req_mark'>*</span></th>
                <td><input type='text' name='extra_hour' value='<?=$extra_hour?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('semester_id','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Absent Hours <span class='req_mark'>*</span></th>
                <td><input type='text' name='absent_hour' value='<?=$absent_hour?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('semester_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Late <span class='req_mark'>*</span></th>
                <td><input type='text' name='late' value='<?=$late?>' class='text ui-widget-content ui-corner-all required width_160' /><?=form_error('semester_id','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>Authorize <span class='req_mark'>*</span></th>
                <td><select name="authorize"><?=$this->mod_staff_attd->get_authorize(set_value('authorize',$authorize))?></select><?=form_error('authorize','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="comments" rows="5" cols="40"><?=$comments?></textarea></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>