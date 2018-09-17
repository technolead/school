<?php $std_info=$this->mod_staffs->get_staffs_details($this->session->userdata('sel_staff_id'))?>
<div class="form_content left width_250">
    <h3>Staff Account Management</h3>
    <ul class="left_menu">
        <?php if(common::user_permit('view','staff_payment')) {?><li><a href="<?=site_url('staff_account/manage_payments')?>">Manage Payment</a></li><?php }?>
        <?php if(common::user_permit('add','staff_payment')) {?><li><a href="<?=site_url('staff_account/new_payment')?>">Add Payment</a></li><?php }?>
        <!--<?php if(common::user_permit('view','staff_account')) {?><li><a href="<?=site_url('staff_account/staff_mng_account')?>">Manage Accounts</a></li><?php }?>
        <?php if(common::user_permit('view','staff_balance')) {?><li><a href="<?=site_url('staff_account/mng_staff_balance')?>">Manage Staffs Balance</a></li><?php }?>-->
    </ul>
</div>
<div class='form_content right' style="width:600px;">
    <h3>Staffs Information</h3>
    <table>
        <tr><th>Staff ID :</th><td><?=$std_info[user_name]?></td><th>Staff Name :</th><td><?=$std_info[first_name].' '.$std_info[last_name]?></td></tr>
        <tr><th>Mobile :</th><td><?=$std_info[mobile]?></td><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Employ Type :</th><td><?=$std_info[employ_type]?></td><th>Employ Nature :</th><td><?=$std_info[employ_nature]?></td></tr>
        <tr><th>Department Name :</th><td><?=$std_info[department_name]?></td><th>Designation :</th><td><?=$std_info[designation]?></td></tr>
        <tr><th>Salary Type :</th><td><?=$std_info[salary_type]?></td><th>Amount :</th><td><?=$std_info[amount]?></td></tr>
    </table>
</div>
<div class="clear"></div>