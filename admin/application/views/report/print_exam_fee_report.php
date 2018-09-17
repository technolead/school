<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>

</div>
<?php if(count($exam_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">

        <div class="left b">Monthly Fee <?if($payment_type=="paid"){echo "Paid";}else{echo "Due";} ?></div>


        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Exam</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th><?if($payment_type=="paid"){echo "Payment";}else{echo "Due";} ?></th>


        </tr>
            <?php
    $inc=1;
    foreach($exam_fee as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['exam_name']?></td>

            <td><?=$row['user_name']?></td>
            <td><?=$row['student_name']?></td>
            <td class="txt_right"><?=$row['exam_fee']?></td>

            <? $exam_fee_total+=$row['exam_fee'];?>


        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr class="title">
            <th colspan="5" style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($exam_fee_total,2,'.',',')?></th>


        </tr>
    </table>
</div>
<?php }?>




