<?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <h3 class="left">Manage Installment</h3><a href="#print_view" rel="<?=site_url('accounts/print_inspayment')?>" class="button print_view right">Print View</a>
    <div class="clear"></div>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            
            <th>Class Name</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Received Amount</th>
            <th>Due Amount</th>
            <th>Task</th>
        </tr>
<?php if(count($install_rows)>0) {
    $inc=1;
    foreach($install_rows as $row): ?>
        <tr <?php if($inc%2==0) {
            echo "class='even txt_center'";
        }else {
            echo "class='odd txt_center'";
        }?>>
           <td><?=$row['class_name']?>&nbsp;</td>
            
            <td><?=$row['committed_date']?>&nbsp;</td>
            <td class="txt_right"><?php $tolins+=$row['amount']; echo number_format($row['amount'],2,'.',',')?></td>
            <td><?=$row['notes']?>&nbsp;</td>
            <td class="txt_right"><?php $paid_amount=$this->mod_accounts->get_paid_amount($row['installment_id']); $totpaid+=$paid_amount; echo number_format($paid_amount,2,'.',',')?>&nbsp;</td>
            <td class="txt_right"><?php $due=$row['amount']-$paid_amount; $totdue+=$due; echo number_format($due,2,'.',',')?>&nbsp;</td>
            <td class="view_links">
              <?php if(common::user_permit('add','std_account')) {?>
		 <?php if($due==0) {
                echo '<span class="competed_link" title="Received Full Amount"></span>';
            }else {?><a href="<?=site_url('accounts/receive_payment/'.$row['installment_id'])?>" class="receive_link" title="Receive Amount"></a>
                <?php }?>
            <a href="<?=site_url('accounts/edit_installment/'.$row['installment_id'])?>" class="edit_link" title="Change"></a>
            <?php }?>
            <?php if(common::user_permit('delete','std_account')) {?>
            <a href="<?=site_url('accounts/delete_fee_installment/'.$row['installment_id'])?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
	<?php }?>
            </td>
        </tr>
         <?php $inc++;
    endforeach;
    echo '<tr class="even"><th colspan="2">Total</th><td class="txt_right">'.number_format($tolins,2,'.',',').'</td><td>&nbsp;</td><td class="txt_right">'.number_format($totpaid,2,'.',',').'</td><td class="txt_right">'.number_format($totdue,2,'.',',').'</td><td>&nbsp;</td></tr>';
}else {
    echo "<tr><td colspan='6'>No Record Found!</td></tr>";
}?>			
    </table>
</div>
<div class='table_content'>	
    <h3>Manage Payments</h3>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Class Name</th>
            
            <th>Due Date</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            
            <th>Notes</th>
            <th>Action</th>
        </tr>
<?php if(count($payment_rows)>0) {
    foreach($payment_rows as $row): ?>
        <tr <?php if($inc%2==0) {
            echo "class='even txt_center'";
        }else {
            echo "class='odd txt_center'";
        }?>>
            <td><?=$row['class_name']?></td>
            
            <td><?=$row['committed_date']?></td>
            <td><?=$row['paid_date']?></td>
            <td class="txt_right"><?php $totamount+=$row['paid_amount']; echo number_format($row['paid_amount'],2,'.',',');?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['details_name']?></td>
            
            <td><?=$row['notes']?></td>
            <td class="view_links">
        <?php if(common::user_permit('add','std_account')) {?>
                <a href='#print_view' rel="<?=site_url('accounts/print_payment/'.$row['payments_id'])?>" class="print_view print_link" title="Print View"></a
                <a href="<?=site_url('accounts/edit_payment/'.$row['payments_id'])?>" class="edit_link" title="Change"></a>
            <?php }?>
            <?php if(common::user_permit('delete','std_account')) {?>
                <a href="<?=site_url('accounts/delete_payments/'.$row['payments_id'])?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
	    <?php }?>
            </td>
        </tr>
            <?php endforeach;
            echo '<tr class="even"><th colspan="3">Total</th><td class="txt_right">'.number_format($totamount,2,'.',',').'</td><td colspan="3">&nbsp;</td><td class="txt_right"></td></tr>';
}else {
    echo '<tr><td colspan="6">No Record Found!</td></tr>';
}?>	</table></div>