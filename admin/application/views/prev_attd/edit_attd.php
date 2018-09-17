<form id="valid_form" action='<?=site_url('prev_attd/edit_attd/'.$row[attd_id])?>' method='post'>
<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
        <table>
            <tr>
                <th>Class</th>
                <td><?=$row['class_name']?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?=$row['first_name'].' '.$row['last_name']?></td>
            </tr>
            <tr>
                <th>Cumulative Attendance to Date <span class="req_mark">*</span></th>
                <td><input type="text" name="attd_date" value="<?=set_value('attd_date',$row['attd_date'])?>" class="required date_picker width_80 text ui-widget-content ui-corner-all" /><?=form_error('attd_date','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Attendance<span class="req_mark">*</span></th>
                <td><input type="text" name="attd_attendance" value="<?=set_value('attd_attendance',$row['attd_attendance'])?>" class="required width_200 text ui-widget-content ui-corner-all" /><?=form_error('attd_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='update' value='Update' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
</div>
</form>