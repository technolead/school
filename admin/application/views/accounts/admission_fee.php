<?php
if ($msg != '') {
    echo "<div class='success'>$msg</div>";
}
?>

<?
    $reg_class=common::get_student_registered_class($student_id);


?>

<div class='table_content'>
    <form action="" id="std_fee_form" method="post">
    <table cellspacing="1" cellpadding="1">
        <tr class="title">
            
            <th>Session</th>
            <th>Class</th>
            <th>Privilege</th>
            <th>Amount</th>
            <th>Class Payment Date</th>
            <th>Is Paid</th>
            <th>Student Paid Date</th>
            <th>Action</th>
        </tr>
        
        <tr class='odd txt_center'>


            
            <input type="hidden" name="privilege" value="<?=$reg_class['privilege']?>" />
            <input type="hidden" name="admission_fee" value="<?=$register['admission_fee']?>" />


            <td><?=$session_name ?></td>
            <td><?=$class_name ?></td>
            <td><?=common::get_privilege_name($reg_class['privilege'])?></td>
            <td>
                <?if($admission_fee_row['is_paid']=='1') {echo $admission_fee_row['fee'];}else{?>
                    <?if($reg_class['privilege']==0){ echo $register['admission_fee'];}else{?>
                       <input type="text" class="width_80" name="fee" value="<?=$admission_fee_row['fee']?>" />
                    <?}?>
                <?}?>
            </td>
            <td><?=(count($register)==0)?'Not taken yet':$register['register_date']?></td>
            <td><?=(count($admission_fee_row)!=0 && $admission_fee_row['is_paid']=='1')?'Yes':'No'?></td>
            <td><?=$admission_fee_row['paid_date'] ?></td>
            <td class="view_links" >
            <?php if(common::user_permit('add','std_account')){
                if(count($register)==0) { //class admission fee is not taken yet
            ?>

                <input type="button" class="jreceive" title="<?=site_url('accounts/receive_admission_fee/' .$class_map_id."/".$student_id) ?>" value="Receive" />

            <?}if(count($register)>0) {
                    if(count($admission_fee_row)>0 && $admission_fee_row['is_paid']=='0'){?>
                        <!-- Class admission fee is taken, student is listed, but did not pay -->
                        <input type="button" class="jreceive"  title="<?=site_url('accounts/update_admission_fee/' .$admission_fee_row['admission_fee_id']."/".$student_id) ?>" value="Receive" />
                    <?}
                    if(count($admission_fee_row)==0)
                    {?>
                        <!-- Class admission fee is taken, student is not listed -->
                        <input type="button" class="jreceive"  title="<?=site_url('accounts/save_student_admission_fee/' .$register['admission_fee_register_id']."/".$student_id) ?>" value="Receive" />
                    <?}
                }

            }?>
            </td>
        </tr>
        
    </table>
    </form>
</div>

