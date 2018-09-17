<div class='form_content'>
    <h3>Student Information</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Student Name:</th><td><?=$student[student_name]?>&nbsp;</td></tr>
        <tr><th>Student ID:</th><td><?=$student[user_name]?>&nbsp;</td></tr>
        <tr><th>Email:</th><td><?=$student[email]?>&nbsp;</td></tr>
        <tr><th>Class Name:</th><td><?=$student[class_name]?>&nbsp;</td></tr><tr></tr>
        <tr><th>Session Name:</th><td><?=$student[session_name]?>&nbsp;</td></tr><tr></tr>
        <tr><th>Exam:</th><td><?=$rows[0]['exam_name']?></td></tr>
        <tr><th>Grade:</th><td><?=$final_grade?></td></tr>
        <tr><th>Grade Point:</th><td><?=$final_grade_point?></td></tr>
    </table>
</div>

<div class='table_content'>
    <h3>Term Final Progress For <?=$student[session_name]?> Session</h3>
    <hr />
    <div class="pagination_links">
        <span class="b margin_0_10">Student Subject Results</span>
    </div>
    <table cellspacing='0' cellpadding='0'>
        <tr class='title'>
            <th>SN</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Exam Date</th>
            <th>Attendance</th>
            <th>Tutorial</th>
            <th>Final Marks</th>
            <th>Grade Letter</th>
            <th>Grade Point</th>
            <th>Attempt</th>
            <th>Result</th>
        </tr>
        <?php if(count($rows)>0) {
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <th><?=$inc?></th>
            <td><?=$row['module_code']?></td>
                <td><?=$row['module_name']?></td>
                <th><?=$row['exam_date']?></th>
                <th><?=$row['attendance']?></th>
                <th><?=$row['tutorial']?></th>
                <th><?=$row['final_marks']?></th>
                <th><?=$row['final_grade']?></th>
                <th><?=$row['final_grade_point']?></th>
                <th><?=$row['attempt']?></th>
                <td><?=$row['result_status']?></td>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!&nbsp;</td></tr>";
    }  ?>
    </table>
</div>
<div class='form_content'>
    <h3>Others</h3>
<?php if($attd_row['total_class']==''||$attd_row['total_class']==0) {
    $attd=0;
}
else {
    $attd=round(($attd_row['present']-$attd_row['total_leave'])/$attd_row['total_class']*100,2);
}?>
    <table cellspacing='0' cellpadding='0'>
        <tr>
            <th>Attendance</th>
            <td><?=$attd?>%<span>[ Absent=<?=$attd_row['absent']?> ] [ Present=<?=$attd_row['present']?> ] [ Leave/Execuse=<?=$attd_row['total_leave']?> ] [Tolal Class=<?=$attd_row['total_class']?>]</span></td>
        </tr>
        <tr><th>Punctuality</th><td><?=common::get_report_status($punctuality)?>&nbsp;</td></tr>
        <tr><th>Class Preparation &amp; Participation</th><td><?=common::get_report_status($class_preparation)?>&nbsp;</td></tr>
        <tr><th>Writing Skills</th><td><?=common::get_report_status($writing_skills)?>&nbsp;</td></tr>
        <tr><th>Overall Academic Performance</th><td><?=common::get_report_status($academic_performance)?>&nbsp;</td></tr>
        <tr><th>Communication Skills</th><td><?=common::get_report_status($communication_skills)?>&nbsp;</td></tr>
        <tr><th>Personal Tutor's Comment</th><td><?=nl2br($tutor_comment)?>&nbsp;</td></tr>
        <tr><th>Suggestions/Comment</th><td><?=nl2br($suggestions)?>&nbsp;</td></tr>
    </table>
</div>