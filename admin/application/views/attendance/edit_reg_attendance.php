<?php if($msg!=""){echo "<div class='success'>$msg</div>";}?>
<form action="<?=site_url('attendance/edit_reg_attendance/'.$class_attendance_id)?>" method="post">
<div class='table_content'>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Session</th>
            <th>Class</th>
            <th>Attendance Type</th>
            <th>Date</th>
            <th>No. Present</th>
            <th>No. Absent</th>
            <th>No. Leave</th>
            <th>Total</th>
            <th>Inputed By</th>
        </tr>
        <tr class="odd">
            <td><?=$session_name?></td>
            <td><?=$class_name?></td>
            <td><select name="attendance_type_id" class="input_txt"><?=combo::get_type_options('STD_ATTENDANCE',set_value('attendance_type_id',$attendance_type_id),TRUE)?></select><?=form_error('attendance_type_id','<span>','</span>')?></td>
            <td><input type="text" name="date" value="<?=$date?>" readonly class="width_80 date_picker" /></td>
            <th><?=$no_present?></th>
            <th><?=$no_absent?></th>
            <th><?=$no_leave?></th>
            <th><?=$no_present+$no_absent?></th>
            <td><?=$first_name.' '.$last_name?></td>
        </tr>
   </table>
</div>
<div class='table_content'>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Leave/Excuse</th>
        </tr>
       <?php if(count($rows)>0){
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
            <td><input type="hidden" name="student_id[]" value="<?=$row['student_id']?>" /><input type="hidden" name="prev_attendance[]" value="<?php if($row['leave_excuse']==1)echo '-1';else echo $row['attendance']?>" /><input type="hidden" name="std_attendance_id[]" value="<?=$row['std_attendance_id']?>" /><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['user_name']?></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==1){echo 'checked';}?> value="1" /></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==0){echo 'checked';}?> value="0" /></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['leave_excuse']==1){echo 'checked';}?> value="-1" /></td>
        </tr>
        <?php $inc++; endforeach;
    }else{
        echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
    }  ?>
   </table>
   <div class="txt_center"><input type='submit' name='update_attendance' value='Update Attendance Register' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
</div>
</form>