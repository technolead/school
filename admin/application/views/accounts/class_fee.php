<?php
if ($msg != '') {
    echo "<div class='success'>$msg</div>";
}
?>
<div class='table_content'>
    <table cellspacing="1" cellpadding="1">
        <tr class="title">
            
            <th>Session</th>
            <th>Class</th>
            <th>Monthly Fee</th>
            <th>Privilege</th>
        </tr>
        <tr class='odd txt_center'>
            
            <td><?=$session_name ?></td>
            <td><?=$class_name ?></td>
            <td><?=$monthly_fee ?></td>
            <td><?=common::get_privilege_name($privilege)?></td>
        </tr>
    </table>
</div>




<div class='table_content'>
    <h3>Manage Payments</h3>
    <form action="" id="std_fee_form" method="post">
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Month</th>
            <th>Fee</th>
            <th>Fine</th>
            <th>Class Payment Date</th>
            <th>Is Paid</th>
            <th>Student Payment Date</th>
            <th>Action</th>
        </tr>
        <input type="hidden" name="privilege" value="<?=$privilege?>" />
    <?php
        $inc=1;
        $total_paid=0;
        $months=common::get_months();
        foreach($months as $month):
            $register=sql::row("class_fee_register","class_map_id=$class_map_id and section='$section' and month='$month'");

            if(count($register)>0){
                $class_fee_register_id=$register['class_fee_register_id'];
            }else{
                $class_fee_register_id=0;
            }
            $class_fee_row=common::get_std_class_fee($student_id,$class_fee_register_id,$month);
    ?>
        
        <input type="hidden" name="monthly_fee_<?=$month?>" value="<?=$register['monthly_fee']?>" />
        
        <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else {echo "class='odd txt_center'";}?>>
            <td><?=$month?></td>
            <td class="txt_right">
                <?if($class_fee_row['is_paid']=='1') {echo $class_fee_row['fee'];}else{?>
                    <?if($privilege==0){ echo $register['monthly_fee'];}else{?>
                       <input type="text" class="width_80" name="fee_<?=$month?>" value="<?=$class_fee_row['fee']?>" />
                    <?}?>
                <?}?>
            </td>
            <td class="txt_right">
                <?if($class_fee_row['is_paid']=='1') {echo $class_fee_row['fine'];}else{?>                    
                       <input type="text" class="width_80" name="fine_<?=$month?>" value="<?=$class_fee_row['fine']?>" />
                <?}?>
            </td>
            <td><?=(count($register)==0)?'Not taken yet':$register['register_date']?></td>
            <td class="bold blue"><?=(count($class_fee_row)!=0 && $class_fee_row['is_paid']=='1')?'Yes':'No'?></td>
            <td><?=$class_fee_row['paid_date']?></td>
            <td class="view_links">
            <?php if(common::user_permit('add','std_account')){
                if(count($register)==0) { //class monthly fee is not taken yet
            ?>
                    <input type="button" class="jreceive" title="<?=site_url('accounts/receive_monthly_fee/' .$class_map_id."/".$month."/".$student_id) ?>" value="Receive" />
                
            <?} if(count($register)>0){
                    if(count($class_fee_row)>0 && $class_fee_row['is_paid']=='0'){?>
                        <!-- Class monthly fee is taken, student is listed, but did not pay -->
                        <input type="button" class="jreceive" title="<?=site_url('accounts/update_monthly_fee/' .$register['class_fee_register_id']."/".$class_fee_row['class_fee_id']."/".$student_id) ?>" value="Receive" />

                    <?}
                    if(count($class_fee_row)==0){?>
                        <!-- Class monthly fee is taken, student is not listed -->
                        <input type="button" class="jreceive" title="<?=site_url('accounts/save_student_monthly_fee/' .$register['class_fee_register_id']."/".$student_id) ?>" value="Receive" />
                    <?}
                 }
             }?>
            </td>
        </tr>
        <?php
            
            $inc++;
            endforeach;
            
        ?>
    </table>
    </form>
</div>