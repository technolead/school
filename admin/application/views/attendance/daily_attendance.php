<div class='form_content'>
	<h3><?=$page_title?></h3>
    <form action='<?=site_url('attendance/daily_attendance')?>' method='post'>
        <table>
			<tr>
                <th>Date <span class='required'>*</span></th>
                <td><input type='text' name='date' value='<?=set_value('date')?>' class='input_txt width_160 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Subject Name<span class='required'>*</span></th>
                <td><select name="module_id" class="input_txt"><option value="">Select Module</option><?=combo::get_modules_options(set_value('module_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Type <span class='required'>*</span></th>
                <td><select name="attd_type_id" class="input_txt"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attd_type_id'))?></select><?=form_error('attd_type_id','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>Class Room No <span class='required'>*</span></th>
                <td><input type='text' name='class_room' value='<?=set_value('class_room')?>' class='input_txt width_160' /><?=form_error('class_room','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='print' value='Print' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>