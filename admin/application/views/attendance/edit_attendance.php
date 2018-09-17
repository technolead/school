<div class='form_content'>
    <form action='<?=site_url('attendance/edit_attendance/'.$module_attendance_id)?>' method='post'>
       <table>
            <?php if(validation_errors()!=''){ echo "<tr><td colspan='2' class='error'>".validation_errors()."</td></tr>";}?>
            <tr>
                <th>Subject <span class='required'>*</span></th>
                <td><input type="hidden" name="module_id" value="<?=$module_id?>" /><select name="module_id" class="input_txt" disabled><option value="">Select Subject</option><?=combo::get_modules_options($module_id)?></select></td>
            </tr>
            <tr>
                <th>Attendance Type <span class='required'>*</span></th>
                <td><select name="attd_type_id" class="input_txt"><?=combo::get_type_options('STD_ATTENDANCE',$attd_type_id)?></select></td>
            </tr>
            <tr>
                <th>Date <span class='required'>*</span></th>
                <td><input type='text' name='date' value='<?=$date?>' class='input_txt width_160 date_picker' /></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>