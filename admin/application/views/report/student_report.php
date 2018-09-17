<form action='<?=site_url('report/student_report/'.$student_id)?>' method='post'>
    <div class='form_content'>
        <h3>Student Information</h3>
        <table>
            <tr><th>Student Name:</th><td><?=$student_name?></td><th>Email:</th><td><?=$email?></td></tr>            
            <tr><th>Session Name:</th><td><?=$session_name?></td></tr>
            <tr><th>Class Name:</th><td><?=$class_name?></td></tr>
            <tr><th>Exam:</th><td><?=$rows[0]['exam_name']?></td></tr>
            
        </table>
    </div>
    
    <div class='table_content'>
        <h3><?=$rows[0]['exam_name']?> Progress Report For <?=$session_name?> Session</h3>
        <hr />
        <div class="pagination_links">
            <span class="b margin_0_10">Student Subject Results</span>
        </div>
        <?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
        <table>
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

                <input type="hidden" name="final_grade_point[]" value="<?=$row['final_grade_point']?>" />

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
            echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
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
        <table>
            <tr>
                <th style="width:200px;">Attendance</th>
                <td><input type="text" name="attendance" value="<?=$attd?>%" class="text ui-widget-content ui-corner-all width_150" readonly /> <span>[ Absent=<?=$attd_row['absent']?> ] [ Present=<?=$attd_row['present']?> ] [ Leave/Execuse=<?=$attd_row['total_leave']?> ] [Tolal Class=<?=$attd_row['total_class']?>]</span></td>
            </tr>
            <tr>
                <th>Punctuality</th>
                <td><select name="punctuality"><?=combo::get_report_status_options()?></select></td>
            </tr>
            <tr>
                <th>Class Preparation &amp; Participation</th>
                <td><select name="class_preparation"><?=combo::get_report_status_options()?></select></td>
            </tr>
            <tr>
                <th>Writing Skills</th>
                <td><select name="writing_skills"><?=combo::get_report_status_options()?></select></td>
            </tr>
            <tr>
                <th>Overall Academic Performance</th>
                <td><select name="academic_performance"><?=combo::get_report_status_options()?></select></td>
            </tr>
            <tr>
                <th>Communication Skills</th>
                <td><select name="communication_skills"><?=combo::get_report_status_options()?></select></td>
            </tr>

            <tr>
                <th>Result Status <span class='req_mark'>*</span></th>
                <td><select name="result_status">
                        <option value="1" selected>Passed</option>
                        <option value="0">Failed</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Personal Tutor's Comment</th>
                <td><textarea name="tutor_comment" rows="5" cols="40"></textarea></td>
            </tr>
            <tr>
                <th>Suggestions/Comment</th>
                <td><textarea name="suggestions" rows="5" cols="40"></textarea></td>
            </tr>
        </table>
    </div>
    <div class="txt_center"><input type='submit' name='finish' value='Generate Progress Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
</form>