<?php $std_info=$this->mod_agents->get_agents_details($this->session->userdata('sel_agents_id'))?>
<div class='form_content'>
    <h3> Main Contact Person</h3>
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>Agent ID</th><td class="border_right"><?=$std_info['user_name']?></td>
            <th>Agent Name</th><td><?=$std_info['first_name'].' '.$std_info['last_name']?></td>
        </tr>
        <tr>
            <th>Nationality</th><td class="border_right"><?=$std_info['nationality']?></td>
            <th>Company Name</th><td><?=$std_info['company_name']?></td>
        </tr>
        <tr>
            <th>Address</th><td class="border_right"><?=nl2br($std_info['address_1'])?></td>
            <th>Telephone</th><td><?=$std_info['telephone_1']?></td>
        </tr>
        <tr>
            <th>Mobile</th><td class="border_right"><?=$std_info['mobile_1']?></td>
            <th>Email</th><td><?=$std_info['email']?></td>
        </tr>
        <tr>
            <th>Agent Type</th><td class="border_right"><?=$std_info['agent_type']?></td>
            <th>Agent Status</th><td><?=$std_info['agent_status']?></td>
        </tr>
        <tr>
            <th>Admission Date</th><td class="border_right"><?=$std_info['admission_date']?></td>
            <th>Contact Duration</th><td><?=$std_info['contact_duration']?></td>
        </tr>
    </table>
</div>
<div class="clear"></div>
<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <table cellpadding="0" cellspacing="0">
            <tr>
                <th>Student Name </th>
                <td><?=$student_name?></td>
            </tr>
            <tr>
                <th>Student ID </th>
                <td><?=$user_name?></td>
            </tr>
            <tr>
                <th>Paid Date </th>
                <td><?=$paid_date?></td>
            </tr>
            <tr>
                <th>Due Amount </th>
                <td><?=$due_amount?></td>
            </tr>
            <tr>
                <th>Paid Amount </th>
                <td><?=$paid_amount?></td>
            </tr>
            <tr>
                <th>Balance </th>
                <td><?=$agent_balance?></td>
            </tr>
            <tr>
                <th>Pay Mood </th>
                <td><?=$pay_mood?></td>
            </tr>
            <tr>
                <th>Pay Details </th>
                <td><?=$details_name?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><?=nl2br($comments)?></td>
            </tr>
        </table>
</div>