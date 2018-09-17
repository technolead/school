<?php include_once 'view_register.php';?>
<?php if($msg!=""){echo "<div class='success'>$msg</div>";}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left">
            <?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Attendance</span>
        </div>
        <div class="right">
            
            <select name="jattendance_type_id" class="input_txt margin_0_10 right jsort_attendance"><?=combo::get_type_options('STD_ATTENDANCE',$attendance_type_id,TRUE)?></select>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            
            <th>Date</th>
            <th>Session</th>
            <th>Class</th>
            <th>Class Type</th>  <!-- Attendance type id -->
            <th>No. Present</th>
            <th>No. Absent</th>
            <th>No. Leave</th>
            <th>Total</th>
            <th>Inputed By</th>
        <th>Task</th></tr>
        <?php if(count($rows)>0){
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
            
            <th><?=$row['date']?></th>            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
             <td><?=$row['type_name']?></td>
            <th><?=$row['no_present']?></th>
            <th><?=$row['no_absent']-$row['no_leave']?></th>
            <th><?=$row['no_leave']?></th>
            <th><?=$row['no_absent']+$row['no_present']?></th>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td class='view_links'>
                <?php if(common::user_permit('add','arv_attd')){ ?>
                <a href='<?=site_url('attendance/edit_reg_attendance/'.$row['class_attendance_id'])?>' class="edit_link" title="Change"></a>
                <?php }?>
                <?php if(common::user_permit('add','std_attendance')){ ?>
                <a href='<?=site_url('attendance/delete_attendance/'.$row['class_attendance_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                <?php }?>
            </td>
        </tr>
        <?php $inc++; endforeach;
    }else{
        echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
    }  ?></table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Module Attendance</span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>