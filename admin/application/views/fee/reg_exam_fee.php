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
            <th>Exam Name : </th><td><?=$exam['exam_name']?></td>
        </tr>        

         <tr>
            <th>Exam Fee : </th><td><?=$exam_fee?></td>
        </tr>

    </table>
</div>

<div class='table_content'>
    <form action="<?=site_url($action)?>" method="post">
        <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Paid</th>
                <th>Not Paid</th>
                <th>Payment Date</th>
            </tr>
            <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):
            $std_payment=common::get_exam_payment_info($row['student_id'],$exam_fee_register_id);
            if($row['is_delete']==0 || ($row['is_delete']==1 && count($std_payment)>0)){
    ?>

            <input type="hidden" name="exam_fee_id_<?=$row['student_id']?>" value="<?=$std_payment['exam_fee_id']?>" />
        
            <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
                <td><?=$row['user_name']?></td>
                <td><input type="hidden" name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['student_name']?></td>
                <td align="center"><input type="radio" name="is_paid_<?=$row['student_id']?>" value="1" <?if($std_payment['is_paid']==1) echo 'checked'?>  /></td>
                <td align="center"><input type="radio" name="is_paid_<?=$row['student_id']?>" value="0" <?if($std_payment['is_paid']=='' || $std_payment['is_paid']=='0') echo 'checked'?> /></td>
                <td><?=$std_payment['paid_date']?></td>
            </tr>
        <?}?>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
}  ?>
        </table>
        <div class="txt_center"><input type="hidden" value="<?=$register_date?>" name="date" /> <input type='submit' name='<?=$submit_name?>' value='<?=$submit_value?>' class='button' />
            <?if($submit_name=='update_exam_fee'){?><input type="button" name="delete" value="Delete Exam Fee" title="fee/delete_reg_exam_fee/<?=$exam_fee_register_id?>" class="jclass_fee_delete" ><?}?>
            <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
    </form>
</div>