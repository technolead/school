<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div>
        <form action="<?=site_url('staffs/mng_attendance/')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Staff ID</th><td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class="width_160" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=set_value('name')?>" class="width_160" /></td>
                    <th>Staff Status</th><td><select name="staff_status"><?=combo::get_status_options('STAFFS_STATUS',set_value('staff_status'))?></select></td>
                    <th>Date</th>
                    <td><input type="text"  name="from_date" value="<?=set_value('from_date')?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date')?>" class="date_picker width_80" /></td>
                </tr>
                <tr>
                    <td colspan="8" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div>
        <div class="left b">Showing <?=$start?>-<?=$end?> of <?=$total?> Staff Attendance Record</div>
        <div class="clear"></div>
    </div>
    <table>
        <tr class='title'>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Date</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Sick</th>
            <th>Holiday</th>
            <th>Hours Done</th>
            <th>Extra Hours</th>
            <th>Absent Hours</th>
            <th>Late Hours</th>
            <th>Authorize</th>
            <th>Comments</th>
            <th>Action</th>
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
            <td><?=$row['staff_name']?></td>
            <th><?=$row['date']?></th>
            <th><?=$row['present']?></th>
            <th><?=$row['absent']?></th>
            <th><?=$row['sick']?></th>
            <th><?=$row['holiday']?></th>
            <th><?=$row['hours']?></th>
            <th><?=$row['extra_hour']?></th>
            <th><?=$row['absent_hour']?></th>
            <th><?=$row['late']?></th>
            <th><?=$row['authorize']?></th>
            <td><?=$row['comments']?></td>
            <td class='view_links' style="width:50px;">
                <a href='<?=site_url('staffs/edit_attendance/'.$row['attendance_id'])?>' class="edit_link" class="Change"></a>
                <a href='<?=site_url('staffs/delete_attendance/'.$row['attendance_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='33'>No Content Found!!!</td></tr>";
}  ?></table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Staff Attendance Record</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>