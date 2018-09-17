<div class='form_content'>
	<h3><?=$page_title?></h3>
    <form action='<?=site_url('attendance/new_attendance')?>' method='post'>
        <table>
            <?php if(validation_errors()!=''){ echo "<tr><td colspan='2' class='error'>".validation_errors()."</td></tr>";}?>
            <tr>
                <th>Subject <span class='required'>*</span></th>
                <td><select name="module_id" class="input_txt"><option value="">Select Module</option><?=combo::get_modules_options(set_value('module_id'))?></select></td>
            </tr>
            <tr>
                <th>Attendance Type <span class='required'>*</span></th>
                <td><select name="attd_type_id" class="input_txt"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attd_type_id'))?></select></td>
            </tr>
            <tr>
                <th>Date <span class='required'>*</span></th>
                <td><input type='text' name='date' value='<?=set_value('date')?>' class='input_txt width_160 date_picker' /></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>