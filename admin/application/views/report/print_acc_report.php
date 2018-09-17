<div class='form_content'>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>Student ID</th>
            <td><?=$std_info['user_name']?></td>
        </tr>
        <tr><th>Student Name :</th><td><?=$std_info[student_name]?></td></tr>
        <tr><th>Programme :</th><td><?=$std_info[program_name]?></td></tr>
        <tr><th>Level :</th><td><?=$std_info[level_name]?></td></tr>
        <tr><th>Semester :</th><td><?=$std_info[semester_name]?></td></tr>
        <tr><th>Email :</th><td><?=$std_info[email]?></td></tr>
        <tr><th>Final Status:</th><td><?=$std_info[student_status]?></td></tr>
    </table>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b"><?=$page_title?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Program Name</th>
            <th>Level Name</th>
            <th>Commented Amount</th>
            <th>Commented Date</th>
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
            <td><?=$row['program_name']?></td>
            <td><?=$row['level_name']?></td>
            <td class="txt_right"><?php $tot_comitted+=$row['amount'];
                        echo number_format($row['amount'],2,'.',',')?></td>
            <td><?=$row['committed_date']?></td>
            <td class="txt_right"><?php $paid_amount=$this->mod_accounts->get_paid_amount($row['installment_id']);
                        echo number_format($paid_amount,2,'.',',');
                        $tot_paid+=$paid_amount?></td>
            <td class="txt_right"><?php $due=$row['amount']-$paid_amount;
                        echo number_format($due,2,'.',',')?></td>
        </tr>
                <?php $inc++;
            endforeach;
            ?>
        <tr class='title'>
            <th colspan='2' style="text-align:right">Total</th>
            <th style="text-align:right"><?=number_format($tot_comitted,2,'.',',')?></th>
            <th>&nbsp;</th>
            <th style="text-align:right"><?=number_format($tot_paid,2,'.',',')?></th>
            <th style="text-align:right"><?=number_format($tot_comitted-$tot_paid,2,'.',',')?></th>
        </tr>
    </table>
</div>
    <?php }?>