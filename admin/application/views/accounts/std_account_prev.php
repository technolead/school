<?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <h3 class="left">Installment</h3><!--<a href="#print_view" rel="<?=site_url('accounts/print_inspayment')?>" class="button print_view right">Print View</a>-->
    <div class="clear"></div>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            
            <th>Class Name</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
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
        </tr>
         <?php $inc++;
    endforeach;
    echo '<tr class="even"><th colspan="2">Total</th><td class="txt_right">'.number_format($tolins,2,'.',',').'</td><td>&nbsp;</td><td class="txt_right">'.number_format($totpaid,2,'.',',').'</td><td class="txt_right">'.number_format($totdue,2,'.',',').'</td></tr>';
}else {
    echo "<tr><td colspan='6'>No Record Found!</td></tr>";
}?>			
    </table>
</div>
<div class='table_content'>	
    <h3>Payments</h3>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Class Name</th>
            
            <th>Due Date</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <!--
            <th>Agents</th>
            <th>Agent Amount</th>
            -->
            <th>Notes</th>
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
            <!--
            <td><?=$row['agent_name']?></td>
            <td class="txt_right"><?php $totagentamount+=$row['agent_amount']; echo number_format($row['agent_amount'],2,'.',',')?></td>
            -->
            <td><?=$row['notes']?></td>
        </tr>
            <?php endforeach;
            echo '<tr class="even"><th colspan="3">Total</th><td class="txt_right">'.number_format($totamount,2,'.',',').'</td><td colspan="3">&nbsp;</td></tr>';
}else {
    echo '<tr><td colspan="6">No Record Found!</td></tr>';
}?>	</table></div>