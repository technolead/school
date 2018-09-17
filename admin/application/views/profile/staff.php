<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Staff Information</a></li>
        <li><a href="#tabs-2">Students</a></li>
        <li><a href="#tabs-3">Subjects</a></li>
    </ul>
    <div id="tabs-1">
        <div class='form_content'>
            <h3>Personal Information</h3>
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr><th>Title</th><td><?=$title?>&nbsp;</td></tr>
                <tr><th>Gender</th><td><?=$gender?>&nbsp;</td></tr>
                <tr><th>First Name</th><td><?=$first_name?>&nbsp;</td></tr>
                <tr><th>Last Name</th><td><?=$last_name?>&nbsp;</td></tr>
                <tr><th>Date Of Birth</th><td><?=$date_of_birth?>&nbsp;</td></tr>
                <tr><th>Present Address</th><td><?=nl2br($present_address)?>&nbsp;</td></tr>
                <tr><th>Permanent Address</th><td><?=nl2br($permanent_address)?>&nbsp;</td></tr>
                <tr><th>Nationality </th><td><?=$nationality?>&nbsp;</td></tr>
                <tr><th>Marital Status</th><td><?=$marital_status?>&nbsp;</td></tr>
                <tr><th>Telephone</th><td><?=nl2br($phone)?>&nbsp;</td></tr>
                <tr><th>Mobile</th><td><?=nl2br($mobile)?>&nbsp;</td></tr>
                <tr><th>Email</th><td><?=$email?>&nbsp;</td></tr>
            </table>
        </div>
        <div class='form_content'>
            <h3>Registration</h3>
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr><th>Department</th><td><?=$department_name?>&nbsp;</td></tr>
                <tr><th>Staff Status</th><td><?=$staff_status?>&nbsp;</td></tr>
                <tr><th>Status Change Date</th><td><?=$status_change_date?>&nbsp;</td></tr>
            </table>
        </div>
        
        <div class='form_content'>
            <h3>Qualification Information</h3>
            <table class='txt_center'>
                <tr class="title"><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
                <?php if(count($qualifications)>0) {
                    foreach($qualifications as $qua) :?>
                <tr>
                    <td><?=$qua['qualification']?></td>
                    <td><?=$qua['awarding_body']?></td>
                    <td><?=$qua['year']?></td>
                    <td><?=$qua['grade']?></td>
                </tr>
                    <?php endforeach;
                } else {
                    echo '<tr><td colspan="4">No Content Found</td></tr>';
                } ?>
                <tr><th>IELTS Score/Other</th><td><?=$ielts_score?></td></tr>
            </table>
        </div>
        
        
        <div class='form_content'>
            <h3>Contract Agreement</h3>
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr><th>Admission Date</th><td><?=$admission_date?>&nbsp;</td></tr>
                <tr><th>Contract Duration</th><td><?=$employ_duration?>&nbsp;</td></tr>
                <tr><th>Start Date</th><td><?=$start_date?>&nbsp;</td></tr>
                <tr><th>End Date</th><td><?=$end_date?>&nbsp;</td></tr>
                <tr><th>Salary/Commission</th><td><?=$amount?>&nbsp;</td></tr>
                <tr><th>Total Days Per Week</th><td><?=$days_per_week?>&nbsp;</td></tr>
                <tr><th>Total Hours Per Week</th><td><?=$hours_per_week?>&nbsp;</td></tr>
                <tr><th>Salary Type</th><td><?=$salary_type?>&nbsp;</td></tr>
                <tr><th>National ID Number</th><td><?=$ni_number?>&nbsp;</td></tr>
            </table>
        </div>
    </div>
    <div id="tabs-2">
        <div class='table_content'>
            <div class="pagination_links">
                <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?></span></div><div class="right"><?=$prev_next?></div>
                <div class="clear"></div>
            </div>
            <table cellpadding="1" cellspacing="1">
                <tr class='title'>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Class Name</th>
                    <th>Student Status</th>
                    <th>Session Name</th>
                </tr>
                <?php if(count($student_rows)>0) {
                    $inc=1;
                    foreach($student_rows as $row):
                    if(common::student_is_delete($row['student_id'])==false){
                 ?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><a href="<?=site_url('profile/view_student/'.$row['user_name'])?>"><?=$row['student_name']?></a></td>
                    <td><?=$row['user_name']?></td>
                    <td><?=$row['class_name']?></td>
                    <td><?=$row['student_status']?></td>
                    <td><?=$row['session_name']?></td>
                </tr>
                <?}?>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
            <div class="pagination_links">
                <div class="left"><?=$pagination_links?><span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?></span></div><div class="right"><?=$prev_next?></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div id="tabs-3">
        <div class='table_content'>
            <div class="pagination_links">
                <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$mstart?>-<?=$mend?> of <?=$mtotal?></span></div><div class="right"><?=$prev_next?></div>
                <div class="clear"></div>
            </div>
            <table cellpadding="1" cellspacing="1">
                <tr class='title'>
                    <th>Class Name</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                </tr>
                <?php if(count($module_rows)>0) {
                    $inc=1;
                    foreach($module_rows as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><?=$row['class_name']?></td>
                    <td><?=$row['module_code']?></td>
                    <td><?=$row['module_name']?></td>
                </tr>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
            <div class="pagination_links">
                <div class="left"><?=$pagination_links?><span class="b margin_0_10">Showing <?=$mstart?>-<?=$mend?> of <?=$mtotal?></span></div><div class="right"><?=$prev_next?></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>