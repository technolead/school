<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='form_content'>
    <h3>Staffs Information</h3>
    <table>
        <tr><th>Staff ID :</th><td><?=$user_name?></td><th>Staff Name :</th><td><?=$first_name.' '.$last_name?></td></tr>
        <tr><th>Mobile :</th><td><?=$mobile?></td><th>Email :</th><td><?=$email?></td></tr>
        <tr><th>Employ Type :</th><td><?=$employ_type?></td><th>Employ Nature :</th><td><?=$employ_nature?></td></tr>
        <tr><th>Department Name :</th><td><?=$department_name?></td></tr>
    </table>
</div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div>
        <div class="left b">Showing <?=$start?>-<?=$end?> of <?=$total?> Staff Attendance Record</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
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
            <td class='view_links'>
                <a href='<?=site_url('staff_attd/edit_attendance/'.$row['attendance_id'])?>' class="edit_link" class="Change"></a>
                <a href='<?=site_url('staff_attd/delete_attendance/'.$row['attendance_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach; ?>
    <tr style="background:#d4ded3;color:#00f;">
                <th>Total</th>
                <th><?=$total_attd['tot_present']?></th>
                <th><?=$total_attd['tot_absent']?></th>
                <th><?=$total_attd['tot_sick']?></th>
                <th><?=$total_attd['tot_holiday']?></th>
                <th><?=$total_attd['tot_hours']?></th>
                <th><?=$total_attd['tot_extra_hour']?></th>
                <th><?=$total_attd['tot_absent_hour']?></th>
                <th><?=$total_attd['tot_late']?></th>
                <th colspan='3'>No. of payable hours: <?=$total_attd['tot_hours']+$total_attd['tot_extra_hour']?></th>
            </tr>
<?php }else {
    echo "<tr><td colspan='33'>No Content Found!!!</td></tr>";
}  ?></table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Staff Attendance Record</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>
<!---
<div class='form_content'>
    <h3>Staffs Attendance Summary</h3>
    <table>
        <tr><th>Total Present days :</th><td><?=$total_attd['tot_present']?></td></tr>
        <tr><th>Total Absent days :</th><td><?=$total_attd['tot_absent']?></td></tr>
        <tr><th>Total sick days :</th><td><?=$total_attd['tot_sick']?></td></tr>
        <tr><th>Total holidays :</th><td><?=$total_attd['tot_holiday']?></td></tr>
        <tr><th>Total Excuse days :</th><td><?=$total_attd['tot_excuse']?></td></tr>
        <tr><th>Total hours done :</th><td><?=$total_attd['tot_hours']?></td></tr>
        <tr><th>Total extra hours :</th><td><?=$total_attd['tot_extra_hour']?></td></tr>
        <tr><th>No. of payable days :</th><td><?=$total_attd['tot_present']?></td></tr>
        <tr><th>No. of payable hours :</th><td><?=$total_attd['tot_hours']+$total_attd['tot_extra_hour']?></td></tr>
    </table>
</div>
-->