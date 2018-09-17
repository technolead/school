<div class='form_content'>
    <?php $std_info=common::student_details()?>
    <table cellpadding="0" cellspacing="0">
        <tr><th>Student ID :</th><td class="border_right"><?=$std_info[user_name]?></td><th>Student Name :</th><td><?=$std_info[first_name].' '.$std_info[last_name]?></td></tr>
        <tr><th>Mobile :</th><td class="border_right"><?=$std_info[mobile]?></td><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Student Status :</th><td class="border_right"><?=$std_info[student_status]?></td><th>Admission Date :</th><td colspan="3"><?=$std_info[admission_date]?></td></tr>
        
    </table>
</div>
<div class='form_content'>
    <table cellpadding="0" cellspacing="0">
        <tr><th>Class Name</th><td><?=$class_name?></td></tr>
        <tr><th>Class Fee</th><td><?=$class_fee?></td></tr>
        <tr><th>Total Fee</th><td><?=$total_balance?></td></tr>
        <tr><th>Committed Date</th><td><?=$committed_date?></td></tr>
        <tr>
            <th>Installment Amount </th>
            <td><?=$amount-$this->mod_accounts->get_paid_amount($installment_id,$payments_id)?></td>
        </tr>
        <tr>
            <th>Paid Date </th>
            <td><?=$paid_date?></td>
        </tr>
        <tr>
            <th>Paid Amount </th>
            <td><?=$paid_amount?></td>
        </tr>
        <tr>
            <th>Pay Mood</th>
            <td><?=$pay_mood?></td>
        </tr>
        <tr>
            <th>Pay Details</th>
            <td><?=$details_name?></td>
        </tr>
        
        <tr>
            <th>Notes</th>
            <td><?=nl2br($notes)?>&nbsp;</td>
        </tr>
    </table>
</div>