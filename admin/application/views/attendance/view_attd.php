<div class='form_content'>
	<h3><?=$page_title?></h3>
    <form action='<?=site_url('attendance/manage_attendance')?>' method='post'>
        <table>
			<tr>
                <th>Student ID <span class='required'>*</span></th>
                <td><input type='text' name='student_id' value='<?=set_value('student_id')?>' class='input_txt width_200' /><?=form_error('student_id','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>From Date <span class='required'>*</span></th>
                <td><input type='text' name='from_date' value='<?=set_value('from_date')?>' class='input_txt width_160 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>To Date <span class='required'>*</span></th>
                <td><input type='text' name='to_date' value='<?=set_value('to_date')?>' class='input_txt width_160 date_picker' /><?=form_error('date','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Class Type <span class='required'>*</span></th>
                <td><select name="attd_type_id" class="input_txt"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attd_type_id'))?></select><?=form_error('attd_type_id','<span>','</span>')?></td>
            </tr>
			 <tr>
                <th>Mark Type <span class='required'>*</span></th>
                <td><input type="radio" name="mark_type" value='1' checked /> Present <input type="radio" name="mark_type" value='0' /> Absent <input type="radio" name="mark_type" value='-1' /> Leave/Execuse </td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>