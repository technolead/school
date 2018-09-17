<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Personal Information</a></li>
        <li><a href="#tabs-2">Distributed Subject</a></li>
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
                <tr><th>Branch</th><td><?=common::get_branch_name($branch_id)?>&nbsp;</td></tr>
                <tr><th>Department</th><td><?=$department_name?>&nbsp;</td></tr>
                <tr><th>Designation</th><td><?=$designation?>&nbsp;</td></tr>
                <tr><th>MPO Listed</th><td><?=($mpo_listed==1)?"Yes":"No"?>&nbsp;</td></tr>
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
            <table cellspacing='1' cellpadding='1'>
                <tr class='title'>
                    <th>Staffs ID</th>
                    <th>Staffs Name</th>
                    <th>Designation</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
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
                    <td><?=$row['designation']?></td>
                    <td><?=$row['class_name']?></td>
                    <td><?=$row['module_name']?></td>
                    <td class='width_150 links'>
                        <?php if(common::user_permit('update','module')) {?>
                        <a href='<?=site_url('modules/edit_distribution/'.$row['distribution_id'])?>'>Edit</a>
                        <a href='<?=site_url('modules/delete_distribution/'.$row['distribution_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");'>Delete</a>
            <?php }?>
                    </td>
                </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
}  ?>
            </table>
        </div>
    </div>
</div>