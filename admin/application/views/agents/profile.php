<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Agent Information</a></li>
        <li><a href="#tabs-2">Students</a></li>
    </ul>
    <div id="tabs-1">
        <div class='form_content'>
            <h3>Main Contact Person</h3>
            <table>
                <tr><th>Agent ID </th><td><?=$user_name?></td></tr>
                <tr><th>Title</th><td><?=$title?></td></tr>
                <tr><th>Gender </th><td><?=$gender?></td></tr>
                <tr><th>First Name </th><td><?=$first_name?></td></tr>
                <tr><th>Last Name </th><td><?=$last_name?></td></tr>
                <tr><th>Date Of Birth </th><td><?=$date_of_birth?></td></tr>
                <tr><th>Nationality </th><td><?=$nationality?></td></tr>
            </table>
        </div>
        <div class='form_content'>
            <h3>Agent Information</h3>
            <table>
                <tr><th>Admission Date </th><td><?=$admission_date?></td></tr>
                <tr><th>Agent Type </th><td><?=$agent_type?></td></tr>
                <tr><th>Agent Status </th><td><?=$agent_status?></td></tr>
                <tr><th>Status Change Date</th><td><?=$status_change?></td></tr>
            </table>
        </div>
        <div class='form_content'>
            <h3>Company Information</h3>
            <table>
                <tr><th>Company Name </th><td><?=$company_name?></td></tr>
                <tr><th>Address</th><td><?=$address_1?></td></tr>
                <tr><th>Telephone</th><td><?=$telephone_1?></td></tr>
                <tr><th>Mobile</th><td><?=$mobile_1?></td></tr>
                <tr><th>Fax</th><td><?=$fax?></td></tr>
                <tr><th>Email </th><td><?=$email?></td></tr>
                <tr><th>Comments</th><td><?=$comments?></td></tr>
            </table>
        </div>
        <div class='form_content'>
            <h3>Contact Agreement</h3>
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr><th>Admission Date</th><td><?=$admission_date?></td></tr>
                <tr><th>Contact Duration</th><td><?=$contact_duration?></td></tr>
                <tr><th>Start Date</th><td><?=$start_date?></td></tr>
                <tr><th>End Date</th><td><?=$end_date?></td></tr>
                <tr><th>Salary/Commission</th><td><?=$salary_commission?></td></tr>
                <tr><th>Total Days Per Week</th><td><?=$total_days_per_week?></td></tr>
                <tr><th>Total Hours Per Week</th><td><?=$total_hours_per_week?></td></tr>
                <tr><th>Salary Type</th><td><?=$salary_type?></td></tr>
                <tr><th>Gross Pay</th><td><?=$gross_pay?></td></tr>
                <tr><th>Net Pay</th><td><?=$net_pay?></td></tr>
                <tr><th>NI Number</th><td><?=$ni_number?></td></tr>
            </table>
        </div>
        <div class='form_content'>
            <h3>Registration Fees</h3>
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr><th>Registration Fee</th><td><?=$reg_fee?></td></tr>
                <tr><th>Minimum Deposit</th><td><?=$min_deposit?></td></tr>
                <tr><th>International Commission</th><td><?=$int_commission?></td></tr>
                <tr><th>Local Commission</th><td><?=$local_commission?></td></tr>
                <tr><th>Commission on Reg. Fee ( International )</th><td><?=$int_comm_reg_fee?></td></tr>
                <tr><th>Commission on Reg. Fee ( Local )</th><td><?=$local_comm_reg_fee?></td></tr>
                <tr><th>Commission on Tuition Fee ( International )</th><td><?=$int_comm_tuition_fee?></td></tr>
                <tr><th>Commission on Tuition Fee ( Local )</th><td><?=$local_comm_tuition_fee?></td></tr>
                <tr><th>Fixed Amount Per Student</th><td><?=$fixed_amt_per_student?></td></tr>
                <tr><th>Contact Comment</th><td><?=nl2br($contact_comment)?></td></tr>
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
                    <th>Program Code</th>
                    <th>Level Name</th>
                    <th>Student Status</th>
                </tr>
                <?php if(count($rows)>0) {
                    $inc=1;
                    foreach($rows as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><?=$row['student_name']?></td>
                    <td><?=$row['user_name']?></td>
                    <td><?=$row['program_code']?></td>
                    <td><?=$row['level_name']?></td>
                    <td><?=$row['student_status']?></td>
                </tr>
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
</div>