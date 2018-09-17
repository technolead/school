<div class='form_content'>
    <table>
        <tr><th>Student ID</th><td><?=$user_name?></td></tr>
        <tr><th>Student Name</th><td><?=$first_name.' '.$last_name?></td></tr>
        <tr><th>Email</th><td><?=$email?></td></tr>
        <tr><th>Session</th><td><?=$rows[0]['session_name']?></td></tr>
        <tr><th>Class</th><td><?=$rows[0]['class_name']?></td></tr>
    </table>
</div>

<div class='table_content'>
    <?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
    <form action='<?=site_url('attendance/edit_std_attendance')?>' method='post'>
        <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                
                <th>Date</th>
                <th>Attendance Type</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Leave/Excuse</th>
            </tr>
            <?php if(count($rows)>0) {?>
                <?php
    $inc=1;
    foreach($rows as $row):?>
            <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
                
                <th><input type="hidden" name="std_attendance_id[]" value="<?=$row['std_attendance_id']?>" /><input type="hidden" name="date[]" value="<?=$row['date']?>" /><?=$row['date']?></th>
                <td><?=$row['type_name']?></td>
                <td align="center">
                    <input type="hidden" name="prev_attendance[]" value="<?php if($row['leave_excuse']!=0)echo -1;else echo $row['attendance']?>" />
                    <input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==1) {
            echo 'checked';
        }?> value="1" /></td>
                <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==0) {
            echo 'checked';
        }?> value="0" /></td>
                <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['leave_excuse']==1) {
            echo 'checked';
        }?> value="-1" /></td>
            </tr>
        <?php $inc++;
    endforeach;
    ?>
            <tr>
                <th colspan="7"><input type='submit' name='update_reg' value='Update Attendance Registration' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></th>
            </tr>
    <?php }else {
    echo '<tr><td>No Attendance Record Found!!</td></tr>';
}?>
        </table>
    </form>
</div>