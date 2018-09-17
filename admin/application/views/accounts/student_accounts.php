<?php $std_info=common::student_details()?>
<div class="form_content fl_left width_250">
	<h3>Student Account Management</h3>
	<ul class="left_menu">
                <?php if(common::user_permit('view','admission_fee')) {?><li><a href="<?=site_url('accounts/admission_fee_reg')?>">Manage Admission Fee</a></li><?php }?>
		<?php if(common::user_permit('add','exam_fee')) {?><li><a href="<?=site_url('accounts/exam_fee_reg')?>">Manage Exam Fee</a></li><?php }?>
                <?php if(common::user_permit('view','class_fee')) {?><li><a href="<?=site_url('accounts/class_fee_reg')?>">Manage Monthly Fee</a></li><?php }?>
                <?php if(common::user_permit('view','class_fee')) {?><li><a href="<?=site_url('accounts/additional_fee_reg')?>">Manage Additional Fee</a></li><?php }?>
		
               
		
		<!--<?php if(common::user_permit('view','std_payment')) {?><li><a href="<?=site_url('accounts/installment_payment')?>">Fee Installment/Payments</a></li><?php }?>
                <?php if(common::user_permit('view','std_payment')) {?><li><a href="<?=site_url('accounts/advance_payment')?>">Manage Advance Payments</a></li><?php }?>
                <?php if(common::user_permit('add','level_fee')) {?><li><a href="<?=site_url('accounts/add_advance')?>">Add Advance Payment</a></li><?php }?>-->
	</ul>
</div>
<div class='form_content fl_right' style="width:600px;">
	<h3>Student Information</h3>
    <table>
        <tr><th>Student ID :</th><td><?=$std_info[user_name]?></td><th>Student Name :</th><td><?=$std_info[first_name].' '.$std_info[last_name]?></td></tr>
        <tr><th>Mobile :</th><td><?=$std_info[mobile]?></td><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Student Status :</th><td><?=$std_info[student_status]?></td></tr>
        <tr><th>Admission Date :</th><td><?=$std_info[admission_date]?></td></tr>
    </table>
</div>
<div class="clear"></div>