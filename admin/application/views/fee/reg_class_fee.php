<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='form_content'>
    <table cellpadding="1" cellspacing="1">
        <tr>
            <th>Date</th><td><?=$register_date?></td>
        </tr>
        <?$branch_id=$this->session->userdata('branch_id');?>
        <?if($branch_id!=''){?>
            <tr>
                <th>Branch Name : </th><td><?=common::get_branch_name($branch_id)?></td>
            </tr>
        <?}?>
        

        <tr>
            <th>Session : </th><td><?=$class['session_name']?></td>
        </tr>
        <tr>
            <th>Class : </th><td><?=$class['class_name']?></td>
        </tr>
        
        <tr>
            <th>Section : </th><td><?=$section?></td>
        </tr>

        <tr>
            <th>Month : </th><td><?=$month?></td>
        </tr>

         <tr>
            <th>Monthly Fee : </th><td><?=$monthly_fee?></td>
        </tr>
        
    </table>
</div>

<div class='table_content'>
    <form action="<?=site_url($action)?>" method="post">
        <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Privilege</th>
                <th>Fee</th>
                <th>Paid</th>
                <th>Not Paid</th>
                <th>Payment Date</th>
                <th>Fine</th>
            </tr>
            <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):
            $std_payment=common::get_class_payment_info($row['student_id'],$class_fee_register_id);
            $reg_class=common::get_student_registered_class($row['student_id']);


            if($row['is_delete']==0 || ($row['is_delete']==1 && count($std_payment)>0)){
            ?>
                <input type="hidden" name="class_fee_id_<?=$row['student_id']?>" value="<?=$std_payment['class_fee_id']?>" />
                <input type="hidden" name="privilege_<?=$row['student_id']?>" value="<?=$reg_class['privilege']?>" />
                <input type="hidden" name="monthly_fee_<?=$row['student_id']?>" value="<?=$monthly_fee?>" />
        
            <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else {echo "class='odd txt_center'";}?>>
                <td><?=$row['user_name']?></td>
                <td><input type="hidden" name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['student_name']?></td>
                <td><?=common::get_privilege_name($reg_class['privilege'])?></td>
                <td>
                    <?if($reg_class['privilege']==0){ echo $monthly_fee;}else{?>
                       <input type="text" class="width_80" name="fee_<?=$row['student_id']?>" value="<?=$std_payment['fee']?>" />
                    <?}?>
                    
                </td>
                <td><input type="radio" name="is_paid_<?=$row['student_id']?>" value="1" <?if($std_payment['is_paid']==1) echo 'checked'?>  /></td>
                <td><input type="radio" name="is_paid_<?=$row['student_id']?>" value="0" <?if($std_payment['is_paid']=='' || $std_payment['is_paid']=='0') echo 'checked'?> /></td>
                <td><?=$std_payment['paid_date']?></td>
                <td><input type="text" name="fine_<?=$row['student_id']?>" value="<?=$std_payment['fine']?>" /></td>
            </tr>
            <?}?>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
}  ?>
        </table>
        <div class="txt_center"><input type="hidden" value="<?=$register_date?>" name="date" /> <input type='submit' name='<?=$submit_name?>' value='<?=$submit_value?>' class='button' />
            <?if($submit_name=='update_class_fee'){?><input type="button" name="delete" value="Delete Class Fee" title="fee/delete_reg_class_fee/<?=$class_fee_register_id?>" class="jclass_fee_delete" ><?}?>
            <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
    </form>
</div>