<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    
</div>
<?php if(count($monthly_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">

        <div class="left b">Monthly Fee <?if($payment_type=="paid"){echo "Paid";}else{echo "Due";} ?></div>
        
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Section</th>
            <th>Month</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Privilege</th>
            <th><?if($payment_type=="paid"){echo "Payment";}else{echo "Due";} ?></th>
            <?if($payment_type=="paid"){?><th>Fine</th><?}?>

        </tr>
            <?php
    $inc=1;
    foreach($monthly_fee as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['section']?></td>
            <td><?=$row['month']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['student_name']?></td>
            <td><?=common::get_privilege_name($row['privilege'])?></td>
            <td class="txt_right"><?=$row['fee']?></td>
            <?if($payment_type=="paid"){?><td class="txt_right"><?=$row['fine']?></td><?}?>
            <?
                $class_fee_total+=$row['fee'];
                $fine_total+=$row['fine'];

            ?>


        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr class="title">
            <th colspan="7" style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($class_fee_total,2,'.',',')?></th>
            <?if($payment_type=="paid"){?><th style="text-align:right"><?=number_format($fine_total,2,'.',',')?></th><?}?>

        </tr>
    </table>
</div>
<?php }?>


<?php if(count($monthly_fee)>0) {
    $total_credit=$class_fee_total+$fine_total;

    echo'<div class="table_content">
            <table  cellpadding="0" cellspacing="1">
                <tr class="title">
                    <th>Net Total:</th>
                    <th style="text-align:right">Total '.$payment_type.'</th>
		</tr>
		<tr class="odd">
                    <th>Total</th>
                    <th style="text-align:right">'.number_format($total_credit,2,'.',',').'</th>

		</tr>
            </table>
	</div>';
}?>


