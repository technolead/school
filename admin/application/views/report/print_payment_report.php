<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Student Account (Payment) Report</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Final Status</th>
            
            <th>Pay Date</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
            <?php
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['student_status']?></td>
            
            <td><?=$row['paid_date']?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['details_name']?></td>
            <td><?php if($row['pay_effect']=='Debit') {
            $tot_debit+=$row['paid_amount'];
            echo $row['paid_amount'];
        }else {
            echo '0';
        }?></td>
            <td><?php if($row['pay_effect']=='Credit') {
            $tot_credit+=$row['paid_amount'];
            echo $row['paid_amount'];
        }else {
            echo '0';
        }?></td>
            <td><?=$balance=$tot_credit-$tot_debit?></td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr class='title'>
            <th colspan='6' style="text-align:right">Total</th>
            <th><?=$tot_debit?>&nbsp;</th>
            <th><?=$tot_credit?></th>
            <th><?=$tot_credit-$tot_debit?></th>
        </tr>
    </table>
</div>
    <?php }?>