<?php $std_info=$this->mod_agents->get_agents_details($this->session->userdata('sel_agents_id'))?>
<div class="form_content left width_250">
    <h3>Agents Account Management</h3>
    <ul class="left_menu">
        <li><a href="<?=site_url('agent_account/account/'.$std_info['agents_id'])?>">Manage Accounts</a></li>
        <li><a href="<?=site_url('agent_account/mng_payments')?>">Manage Agents Payments</a></li>
    </ul>
</div>
<div class='form_content right' style="width:600px;">
    <h3> Main Contact Person</h3>
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>Agent ID</th><td><?=$std_info['user_name']?></td>
            <th>Agent Name</th><td><?=$std_info['first_name'].' '.$std_info['last_name']?></td>
        </tr>
        <tr>
            <th>Nationality</th><td><?=$std_info['nationality']?></td>
            <th>Company Name</th><td><?=$company_name?></td>
        </tr>
        <tr>
            <th>Address</th><td style="width:200px;"><?=nl2br($std_info['address_1'])?></td>
            <th>Telephone</th><td><?=$std_info['telephone_1']?></td>
        </tr>
        <tr>
            <th>Mobile</th><td><?=$std_info['mobile_1']?></td>
            <th>Email</th><td><?=$std_info['email']?></td>
        </tr>
        <tr>
            <th>Agent Type</th><td><?=$std_info['agent_type']?></td>
            <th>Agent Status</th><td><?=$std_info['agent_status']?></td>
        </tr>
        <tr>
            <th>Admission Date</th><td><?=$std_info['admission_date']?></td>
            <th>Contact Duration</th><td><?=$std_info['contact_duration']?></td>
        </tr>
    </table>
</div>
<div class="clear"></div>