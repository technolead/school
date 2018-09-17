<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/daily_acc_report')?>' method='post'>
        <table>
            <tr>
                <th>Date</th>
                <td><input type="text" name="from_date" value="<?=set_value('from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date',date('Y-m-d'))?>" class="date_picker width_80" /><?=form_error('from_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<?php if(count($admission_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Admission Fee)</div>
        <a href='#print_view' rel="<?=site_url('report/print_daily_report/')?>" class="print_view right" title="Print View">Print View</a>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Admission Fee</th>
            <th>Total Payment</th>
            
            
        </tr>
            <?php
    $inc=1;
    foreach($admission_fee as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td class="txt_right"><?=$row['admission_fee']?></td>
            <?
                $payment=$row['total_admission_fee'];
                $admission_fee_total+=$row['admission_fee'];
                $payment_total+=$payment;
                $std_credit+=$payment;

            ?>
            <td class="txt_right"><?=number_format($payment,2,'.',',')?></td>
            
        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='3' style="text-align:right">Total</th>
            
            <th style="text-align:right"><?=number_format($payment_total,2,'.',',')?></th>
            
        </tr>
    </table>
</div>
    <?php }?>


<?php if(count($monthly_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Monthly Fee)</div>
        
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Monthly Fee</th>
            <th>Total Payment</th>
            <th>Total Fine</th>

        </tr>
            <?php
    $inc=1;
    $payment_total=0;
    foreach($monthly_fee as $row): ?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td class="txt_right"><?=$row['monthly_fee']?></td>
            
            <?
                $payment=$row['total_monthly_fee'];
                $monthly_fee_total+=$row['monthly_fee'];
                $fine_total+=$row['total_fine'];
                $payment_total+=$payment;
                $std_credit+=$payment+$row['total_fine'];

            ?>
            <td class="txt_right"><?=number_format($payment,2,'.',',')?></td>
            <td class="txt_right"><?=$row['total_fine']?></td>

        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='3' style="text-align:right">Total</th>
            <th style="text-align:right"><?=number_format($payment_total,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($fine_total,2,'.',',')?></th>
        </tr>
    </table>
</div>
    <?php }?>



<?php if(count($exam_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Exam Fee)</div>

        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Exam</th>
            <th>Exam Fee</th>
            <th>Total Payment</th>

        </tr>
            <?php
    $inc=1;
    $payment_total=0;
    foreach($exam_fee as $row): ?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['exam_name']?></td>
            <td class="txt_right"><?=$row['exam_fee']?></td>
            <?
                $payment=$row['exam_fee']*$row['total_exam_fee'];
                $exam_fee_total+=$row['exam_fee'];
                $payment_total+=$payment;
                $std_credit+=$payment;

            ?>
            <td class="txt_right"><?=number_format($payment,2,'.',',')?></td>

        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='4' style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($payment_total,2,'.',',')?></th>

        </tr>
    </table>
</div>
    <?php }?>


<?php if(count($additional_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Additional Fee)</div>
        
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>

            <th>Session</th>
            <th>Class</th>
            <th>Fee Description</th>
            <th>Total Payment</th>


        </tr>
            <?php
    $inc=1;
    $payment_total=0;
    foreach($additional_fee as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>

            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['description']?></td>
            <?
                $payment=$row['total_additional_fee'];
                $additional_fee_total+=$row['additional_fee'];
                $payment_total+=$payment;
                $std_credit+=$payment;

            ?>
            <td class="txt_right"><?=number_format($payment,2,'.',',')?></td>

        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='3' style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($payment_total,2,'.',',')?></th>

        </tr>
    </table>
</div>
    <?php }?>




<?php if(count($staff_rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Staffs)</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class="title">
            <th>Staff Name</th>
            <th>Staff ID</th>
            <th>Pay Date</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    <?php
    $inc=1;
    foreach($staff_rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['staff_name']?></td>
            <td><?=$row['staff_user']?></td>
            <td><?=$row['staff_paid_date']?></td>
            <td><?=$row['staff_pay_mood']?></td>
            <td><?=$row['details_name']?></td>
            <td class="txt_right"><?php if($row['pay_effect']=='Debit') {
            $staff_debit+=$row['staff_payment'];
            $balance-=$row['staff_payment'];
            echo number_format($row['staff_payment'],2,'.',',');
        }else {
            echo '0.00';
        }?></td>
            <td class="txt_right"><?php if($row['pay_effect']=='Credit') {
            $staff_credit+=$row['staff_payment'];
            $balance-=$row['staff_payment'];
            echo number_format($row['staff_payment'],2,'.',',');
        }else {
            echo '0.00';
        }?></td>
            <td class="txt_right"><?php echo number_format($staff_credit-$staff_debit,2,'.',',')?></td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='5' style="text-align:right">Total</th>
            <th style="text-align:right"><?=number_format($staff_debit,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($staff_credit,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($staff_credit-$staff_debit,2,'.',',')?></th>
        </tr>
    </table>
</div>
    <?php }?>

<?php if(count($expense_rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Daily Account Management(Expense)</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class="title">
            <th>Expense Title</th>
            <th>Description</th>
            <th>Expense Date</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    <?php
    $inc=1;
    foreach($expense_rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['exp_title']?></td>
            <td><?=$row['exp_des']?></td>
            <td><?=$row['exp_date']?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['details_name']?></td>
            <td class="txt_right"><?php if($row['pay_effect']=='Debit') {
            $exp_debit+=$row['exp_amount'];
            $balance-=$row['exp_amount'];
            echo number_format($row['exp_amount'],2,'.',',');
        }else {
            echo '0.00';
        }?></td>
            <td class="txt_right"><?php if($row['pay_effect']=='Credit') {
            $exp_credit+=$row['exp_amount'];
            $balance+=$row['exp_amount'];
            echo number_format($row['exp_amount'],2,'.',',');
        }else {
            echo '0.00';
        }?></td>
            <td class="txt_right"><?php echo number_format($exp_credit-$exp_debit,2,'.',',')?></td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan='5' style="text-align:right">Total</th>
            <th style="text-align:right"><?=number_format($exp_debit,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($exp_credit,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($exp_credit-$exp_debit,2,'.',',')?></th>
        </tr>
    </table>
</div>
    <?php }?>

<?php if(count($rows)>0 or count($agent_rows)>0 or count($staff_rows) or count($advance_rows)>0) {
    $total_credit=$std_credit+$staff_credit+$exp_credit;
    $total_debit=$std_debit+$adv_debit+$agent_debit+$staff_debit+$exp_debit;
    echo'<div class="table_content">
				<table  cellpadding="0" cellspacing="1">
					<tr class="title">
						<th>Net Total:</th>
						<th>Credit</th>
						<th>Debit</th>
						<th>Balance</th>
					</tr>
					<tr class="odd">
						<th style="text-align:right">Total</th>
						<th style="text-align:right">'.number_format($total_credit,2,'.',',').'</th>
						<th style="text-align:right">'.number_format($total_debit,2,'.',',').'</th>
						<th style="text-align:right">'.number_format($total_credit-$total_debit,2,'.',',').'</th>
					</tr>
				</table>
		</div>';
}?>