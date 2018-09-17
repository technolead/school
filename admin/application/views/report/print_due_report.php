<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Student Account (Due) Report</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Final Status</th>
            <th>Committed Amount</th>
            <th>Committed Date</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
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
            <td><?=$row['amount']?></td>
            <td><?=$row['committed_date']?></td>
            <td><?=$paid_amount=$this->mod_accounts->get_paid_amount($row['installment_id'])?></td>
            <td><?=$due=$row['amount']-$paid_amount?></td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
    </table>
</div>
    <?php }?>