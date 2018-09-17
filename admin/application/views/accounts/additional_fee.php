<?php
if ($msg != '') {
    echo "<div class='success'>$msg</div>";
}
?>

<?if(count($register)>0){?>
<div class='table_content'>
    <table cellspacing="1" cellpadding="1">
        <tr class="title">

            <th>Session</th>
            <th>Class</th>
            <th>Fee Description</th>
            <th>Amount</th>
            <th>Class Payment Date</th>
            <th>Is Paid</th>
            <th>Student Paid Date</th>
            <th>Action</th>
        </tr>

        <?foreach($register as $row){?>
        <? $additional_fee_row=$this->mod_accounts->get_additional_fee_row($student_id, $row['additional_fee_register_id']); ?>

        <tr class='odd txt_center'>

            <td><?=$session_name ?></td>
            <td><?=$class_name ?></td>
            <td><?=$row['description']?></td>
            <td><?=$additional_fee_row['fee']?></td>
            <td><?=$row['register_date']?></td>
            <td><?=(count($additional_fee_row)!=0 && $additional_fee_row['is_paid']=='1')?'Yes':'No'?></td>
            <td><?=$additional_fee_row['paid_date'] ?></td>
            <td class="view_links">
            <?php if(common::user_permit('add','std_account')){?>               

            <?if(count($additional_fee_row)>0 && $additional_fee_row['is_paid']=='0'){?>
              <!-- Class additional fee is taken, student is listed, but did not pay -->
                <a href="<?=site_url('accounts/update_additional_fee/' .$additional_fee_row['additional_fee_id']."/".$student_id) ?>" class="receive_link" title="Receive Amount"></a>
             <?}
             if(count($additional_fee_row)==0){?>
             <!-- Class additional fee is taken, student is not listed -->
                <a href="<?=site_url('accounts/save_student_additional_fee/' .$row['additional_fee_register_id']."/".$student_id) ?>" class="receive_link" title="Receive Amount"></a>
             <?}
           }?>
            </td>
        </tr>
        <?}?>

    </table>
</div>
<?}?>

