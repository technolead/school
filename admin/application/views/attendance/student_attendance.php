<div class='form_content' style="width:880px;">
    <table>
        <tr><th>Student ID</th><td><?=$user_name?></td><th>Student Name</th><td><?=$student_name?></td></tr>
        <tr><th>Email</th><td><?=$email?></td><th>Class Name</th><td><?=$class_name?></td></tr>
        <tr><th>Session Name</th><td><?=$session_name?></td><th>Attendance Period</th><td>From: <?php if($from_date=='') echo '0000-00-00';else echo $from_date?> To <?php if($to_date=='')echo '0000-00-00';else echo $to_date?></td></tr>
        
    </table>
    <div class="right"><a href="<?=site_url('attendance/percentage_view')?>" class="button">Percentage View</a></div>
    <div class="clear"></div>
</div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left">
            <?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Attendance Record</span>
        </div>
        <div class="right">
            
            <select name="jattendance_type_id" class="input_txt margin_0_10 right jsort_std_attendance"><?=combo::get_type_options('STD_ATTENDANCE',$attendance_type_id,TRUE)?></select>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>SN</th>
            
            <th>Date</th>
            <th>Attendance Type</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Leave/Excuse</th>
        </tr>
        <?php
        if(count($rows)>0) {
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <th><?=$inc?></th>
            
            <th><?=$row['date']?></th>
            <td><?=$row['type_name']?></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==1) {
                    echo 'checked';
                }?> value="1" /></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['attendance']==0) {
            echo 'checked';
        }?> value="0" /></td>
            <td align="center"><input type="radio" name="attendance_<?=$row['std_attendance_id']?>" <?php if($row['leave_excuse']==1) {
            echo 'checked';
        }?> value="0" /></td>
        </tr>
        <?php $inc++;
    endforeach;
}
?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Attendance Record</span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>