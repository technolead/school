<div class='form_content'>
    <?php $std_info=common::student_details()?>
    <table cellpadding="0" cellspacing="0">
        <tr><th>Student ID :</th><td class="border_right"><?=$std_info[user_name]?></td><th>Student Name :</th><td><?=$std_info[first_name].' '.$std_info[last_name]?></td></tr>
        <tr><th>Mobile :</th><td class="border_right"><?=$std_info[mobile]?></td><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Student Status :</th><td class="border_right"><?=$std_info[student_status]?></td><th>Admission Date :</th><td colspan="3"><?=$std_info[admission_date]?></td></tr>
        
    </table>
</div>
<div class='table_content'>
    <h3>Manage Installment</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr class="title">
            
            <th>Class Name</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Received Amount</th>
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
    echo '<tr><th colspan="2">Total</th><td class="txt_right">'.number_format($tolins,2,'.',',').'</td><td>&nbsp;</td><td class="txt_right">'.number_format($totpaid,2,'.',',').'</td><td class="txt_right">'.$totdue.'</td></tr>';
}else {
    echo "<tr><td colspan='6'>No Record Found!&nbsp;</td></tr>";
}?>			
    </table>
</div>
<div class='table_content'>	
    <h3>Manage Payments</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr class="title">
            <th>Class Name</th>
            
            <th>Due Date</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>            
            <th>Notes</th>
        </tr>
<?php if(count($payment_rows)>0) {
    foreach($payment_rows as $row): ?>
        <tr <?php if($inc%2==0) {
            echo "class='even txt_center'";
        }else {
            echo "class='odd txt_center'";
        }?>>
            <td><?=$row['class_name']?>&nbsp;</td>
            
            <td><?=$row['committed_date']?>&nbsp;</td>
            <td><?=$row['paid_date']?>&nbsp;</td>
           <td class="txt_right"><?php $totamount+=$row['paid_amount']; echo number_format($row['paid_amount'],2,'.',',');?>&nbsp;</td>
            <td><?=$row['pay_mood']?>&nbsp;</td>
            <td><?=$row['details_name']?>&nbsp;</td>
            
            <td><?=$row['notes']?>&nbsp;</td>
        </tr>
            <?php endforeach;
            echo '<tr class="title"><th colspan="3">Total</th><td class="txt_right">'.number_format($totamount,2,'.',',').'</td><td colspan="3">&nbsp;</td></tr>';
}else {
    echo '<tr><td colspan="6">No Record Found!&nbsp;</td></tr>';
}?>	</table></div>