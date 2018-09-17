<?php $std_info=$this->mod_staffs->get_staffs_details($this->session->userdata('sel_staff_id'))?>
<div class='form_content'>
    <h3>Staffs Information</h3>
    <table cellpadding="0" cellspacing="0">
        <tr><th>Staff ID :</th><td class="border_right"><?=$std_info[user_name]?></td><th>Staff Name :</th><td><?=$std_info[first_name].' '.$std_info[last_name]?></td></tr>
        <tr><th>Mobile :</th><td class="border_right"><?=$std_info[mobile]?></td><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Employ Type :</th><td class="border_right"><?=$std_info[employ_type]?></td><th>Employ Nature :</th><td><?=$std_info[employ_nature]?></td></tr>
        <tr><th>Department Name :</th><td colspan="3"><?=$std_info[department_name]?></td></tr>
    </table>
</div>
<div class='form_content'>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2" class="border_right">Payable Amount</th>
            <th colspan="2">Amount to be deduce</th>
        </tr>
        <tr>
            <th>Previous Due/Bal </th>
            <td class="border_right"><?=$previous_due?></td>
            <th>Part/Advance Pay </th>
            <td><?=$part_adv_pay?></td>
        </tr>
        <tr>
            <th>For Extra Days/Hours </th>
            <td class="border_right"><?=$extra_day_hour?></td>
            <th>For Absent Days/Hours </th>
            <td><?=$absent_day_hour?></td>
        </tr>
        <tr>
            <th>Others </th>
            <td class="border_right"><?=$other_add?></td>
            <th>Lunch </th>
            <td><?=$lunch?></td>
        </tr>
        <tr>
            <th>Total </th>
            <td class="border_right"><?=$payable_total?></td>
            <th>Others </th>
            <td><?=$other_deduce?></td>
        </tr>
        <tr>
            <th colspan="2" class="border_right">&nbsp;</th>
            <th>Total </th>
            <td><?=$deduced_total?></td>
        </tr>
    </table>
</div>
<div class='form_content'>
    <h3>Total Payment</h3>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Month (mm/yyyy)</th>
            <td>
                <?=$month?>/<?=$year?>
            </td>
        </tr>
        <tr>
            <th>Net Pay </th>
            <td><?=$net_pay?></td>
        </tr>
        <tr>
            <th>To be Added </th>
            <td><?=$payable_total?></td>
        </tr>
        <tr>
            <th>To be Deduce </th>
            <td><?=$deduced_total?></td>
        </tr>
        <tr>
            <th>Total </th>
            <td><?=$total?></td>
        </tr>
    </table>
</div>
<div class='form_content'>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width:200px;">Paid Amount </th>
            <td><?=$paid_amount?></td>
        </tr>
        <tr>
            <th>Paid Date </th>
            <td><?=$paid_date?></td>
        </tr>
        <tr>
            <th>Mode </th>
            <td><?=$pay_mood?></td>
        </tr>
        <tr>
            <th>Pay Details </th>
            <td><?=$details_name?></td>
        </tr>
        <tr>
            <th>Due </th>
            <td><?=$due?></td>
        </tr>
    </table>
</div>
<div class='form_content'>
    <h3>Total Payment</h3>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width:200px;">Paid Holidays (Days/Hours) </th>
            <td><?=$paid_holidays?></td>
        </tr>
        <tr>
            <th>Paid Absent/Sick/Excuse (Days/Hours) </th>
            <td><?=$paid_absent?></td>
        </tr>
        <tr>
            <th>Comments</th>
            <td><?=nl2br($comments)?></td>
        </tr>
    </table>
</div>