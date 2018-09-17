<style type="text/css">
    .form_content{border:1px solid #333;width:700px;margin:0 auto;padding:10px;font-size:9pt;}
    .form_content table{border:1px solid #333;}
    .form_content table td,.form_content table th{border-bottom:1px solid #333;padding:2px 5px;vertical-align:top;}
    .form_content table th{border-right:1px solid #333;width:200px;text-align:left;}
    .form_content legend{font-size:11pt;font-weight:bold;}
</style>
<div class='form_content'>
    <fieldset><legend> Main Contact Person</legend>
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>Title</th>
                <td><?=$title?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?=$gender?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?=$first_name?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?=$last_name?></td>
            </tr>
            <tr>
                <th>Date Of Birth</th>
                <td><?=$date_of_birth?></td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td><?=$nationality?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset><legend>Company Information</legend>
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>Company Name</th>
                <td><?=$company_name?></td>
            </tr>
            <tr>
                <th>Address 1</th>
                <td><?=nl2br($address_1)?></td>
            </tr>
            <tr>
                <th>Address 2</th>
                <td><?=nl2br($address_2)?></td>
            </tr>
            <tr>
                <th>Telephone 1</th>
                <td><?=$telephone_1?></td>
            </tr>
            <tr>
                <th>Telephone 2</th>
                <td><?=$telephone_2?></td>
            </tr>
            <tr>
                <th>Mobile 1</th>
                <td><?=$mobile_1?></td>
            </tr>
            <tr>
                <th>Mobile 2</th>
                <td><?=$mobile_2?></td>
            </tr>
            <tr>
                <th>Fax</th>
                <td><?=$fax?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?=$email?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset><legend>Registration</legend>
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>Agent Type</th>
                <td><?=$agent_type?></td>
            </tr>
            <tr>
                <th>Agent Status</th>
                <td><?=$agent_status?></td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td><?=$status_change?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset><legend>Contact Agreement</legend>
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
    </fieldset>
    <fieldset><legend>Registration Fees</legend>
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
    </fieldset>
</div>