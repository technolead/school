<div class='form_content'>
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <th>Date</th><td colspan="3"><?=$date?></td>
        </tr>
        <tr>
            <th>Class Name</th><td colspan="3"><?=$class_name?></td>
        </tr>
         
        <tr>
            <th>Subject Name</th><td colspan="3"><?=$module_name?></td>
        </tr>
        <tr>
            <th>Session</th><td style="border-right:1px solid #333;"><?=$session_name?></td><th>Section</th><td><?=$section?></td>
        </tr>
        <tr>
            <th>Class Type </th><td colspan="3"><?=$attendance_type?></td>
        </tr>
        <tr>
            <th>Taken By </th><td colspan="3"><?=$taken_by?>&nbsp;</td>
        </tr>
    </table>
</div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="b">Student List</div>
    </div>
    <table cellspacing="0" cellpadding="0">
        <tr class='title'>
            <th>SN</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Notes</th>
            <th>Signature</th>
        </tr>
        <?php
        if(count($rows)>0) {
            $inc=1;
            foreach($rows as $row):
                //trouble while fetching attendance, no unique field to distinguish :(
                //$attendance_details=common::get_student_attendance_details($row['student_id'],$row['module_id']);
         ?>
        <tr>
            <th><?=$inc?></th>
            <td><?=$row['user_name']?></td>
            <td><?=$row['student_name']?></td>
            <td>&nbsp;</td>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php $inc++;
    endforeach; ?>
    <?php	}else {
                    echo '<tr><td colspan="7">No Content Found!</td></tr>';
                }
?>
    </table>
</div>