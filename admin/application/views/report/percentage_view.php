<div class='form_content'>
    <table cellspacing="0" cellpadding="0">
        <tr><th>Student Name</th><td><?=$student_name?></td></tr>
        <tr><th>Email</th><td><?=$email?></td></tr>
        <tr><th>Program Name</th><td><?=$program_name?></td></tr>
        <tr><th>Level Name</th><td><?=$level_name?></td></tr>
        <tr><th>Semester Name</th><td><?=$semester_name?></td></tr>
        <tr><th>Enrolment Date</th><td><?=$enrolment_date?></td></tr>
        <tr><th>Semester Status</th><td><?=$semester_status?></td></tr>
        <tr><th>Status Change Date</th><td><?=$semester_status_date?></td></tr>
    </table>
    <?php if($print_view) {?>
    <div class="right"><a href='#print_view' rel="<?=site_url('attendance/attd_print_view')?>" class="print_view button" title="Print View">Print View</a></div>
    <div class="clear"></div>
        <?php } ?>
</div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="b">Attendance Summary</div>
    </div>
    <table <?php if(!$print_view) {?> cellspacing="0" cellpadding="0" <?php }?>>
        <tr class='title'>
            <th>SN</th>
            <th>Attendance Type</th>
            <th>Module Code</th>
            <th>Module Name</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Leave/Execuse</th>
            <th>Total Class</th>
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
            <td><?=$row['type_name']?></td>
            <td><?=$row['module_code']?></td>
            <td><?=$row['module_name']?></td>
            <th><?php $tot_present+=$row['present'];
                echo $row['present']?></th>
            <th><?php $tot_absent+=$row['absent'];
        echo $row['absent']?></th>
            <th><?php $tot_leave+=$row['total_leave'];
        echo $row['total_leave']?></th>
            <th><?php $tot_class+=$row['total_class'];
        echo $row['total_class']?></th>
        </tr>
        <?php $inc++;
    endforeach; ?>
        <tr <?php if($inc%2==0) {
        echo "class='even'";
            }else {
                echo "class='odd'";
    }?>>
            <th colspan='4' style="text-align:right;">Cummulative Total</th>
            <th><?=$tot_present?></th>
            <th><?=$tot_absent?></th>
            <th><?=$tot_leave?></th>
            <th><?=$tot_class?></th>
        </tr>
        <tr <?php $inc++;
    if($inc%2==0) {
        echo "class='even'";
    }else {
        echo "class='odd'";
    }?>>
            <th colspan='4' style="text-align:right;">Cumulative Attendance</th>
            <th colspan="4"><?=round($tot_present/$tot_class*100,2)?>%</th>
        </tr>
    <?php	}
?>
    </table>
</div>