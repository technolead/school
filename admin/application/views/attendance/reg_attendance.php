<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='form_content'>
    <table cellpadding="1" cellspacing="1">
        <tr>
            <th>Date</th><td><?=$date?></td>
        </tr>
        <?  $branch_id=$this->session->userdata('branch_id');
            if($branch_id!=''){?>
                <tr>
                    <th>Branch Name</th><td><?=common::get_branch_name($branch_id)?></td>
                </tr>
            <?}?>

        <tr>
            <th>Session Name</th><td><?=$session_name?></td>
        </tr>

        <tr>
            <th>Class Name</th><td><?=$class_name?></td>
        </tr>
        
        
        <tr>
            <th>Section</th><td><?=$section?></td>
        </tr>
        
        <tr>
            <th>Class Type</th><td><?=$type_name?></td>
        </tr>
        <tr>
            <th>No. Present</th> <td><?=$no_present?></td>
        </tr>
        <tr>
            <th>No. Absent</th><td><?=$no_absent?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td><?=$total?></td>
        </tr>
    </table>
</div>

<div class='table_content'>
    <form action="<?=site_url('attendance/reg_attendance/'.$class_attendance_id)?>" method="post">
        <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Leave/Excuse</th>
            </tr>
            <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
            <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
                <td><?=$row['user_name']?></td>
                <td><input type="hidden" name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['student_name']?></td>
                <td align="center"><input type="radio" name="attendance_<?=$row['student_id']?>" value="1" checked /></td>
                <td align="center"><input type="radio" name="attendance_<?=$row['student_id']?>" value="0"  /></td>
                <td align="center"><input type="radio" name="attendance_<?=$row['student_id']?>" value="-1" <?php if(common::is_leave_student($row['student_id'],$date)) {
            echo 'checked';
        }?> /></td>
            </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
}  ?>
        </table>
        <div class="txt_center"><input type="hidden" value="<?=$date?>" name="date" /><input type='submit' name='save_attendance' value='Save Attendance Register' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
    </form>
</div>