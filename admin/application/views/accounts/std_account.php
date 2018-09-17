<?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <h3 class="left">Admission Fee</h3><!--<a href="#print_view" rel="<?=site_url('accounts/print_inspayment')?>" class="button print_view right">Print View</a>-->
    <div class="clear"></div>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">

            
            <th>Session</th>
            <th>Class</th>
            <th>Privilege</th>
            <th>Fee</th>
            <th>Is Paid</th>
            <th>Paid Date</th>


        </tr>
<?php if(count($admission_fee_row)>0) {
    $inc=1;
    foreach($admission_fee_row as $row): ?>
        <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else {echo "class='odd txt_center'";}?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=common::get_privilege_name($row['privilege'])?></td>
            <td><?=$row['fee']?></td>
            <td><?=($row['is_paid']==1)?"Yes":"No"?></td>
            <td><?=$row['paid_date']?></td>


        </tr>
         <?php $inc++;
    endforeach;

}else {
    echo "<tr><td colspan='6'>No Record Found!</td></tr>";
}?>
    </table>
</div>
<div class='table_content'>
    <h3>Exam Fee</h3>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Exam Name</th>
            <th>Exam Fee</th>
            <th>Is Paid</th>
            <th>Paid Date</th>

        </tr>
<?php if(count($exam_fee_row)>0) {
    $inc=1;
    foreach($exam_fee_row as $row):

 ?>

        <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else { echo "class='odd txt_center'";}?>>
            <td><?=$row['exam_name']?></td>
            <td><?=$row['exam_fee']?></td>
            <td><?=($row['is_paid']==1)?"Yes":"No"?></td>
            <td><?=$row['paid_date']?></td>

        </tr>
            <?php $inc++;  endforeach;

}else {
    echo '<tr><td colspan="6">No Record Found!</td></tr>';
}?>	</table></div>



<div class='table_content'>
    <h3>Monthly Fee</h3>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Month</th>
            <th>Privilege</th>
            <th>Fee</th>
            <th>Is Paid</th>
            <th>Fine</th>
            <th>Paid Date</th>

        </tr>
<?php if(count($monthly_fee_row)>0) {
    $inc=1;
    foreach($monthly_fee_row as $row):

 ?>
        <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else {echo "class='odd txt_center'";}?>>
            <td><?=$row['month']?></td>
            <td><?=common::get_privilege_name($row['privilege'])?></td>
            <td><?=$row['fee']?></td>
            <td><?=($row['is_paid']==1)?"Yes":"No"?></td>
            <td><?=$row['fine']?></td>
            <td><?=$row['paid_date']?></td>

        </tr>
            <?php $inc++;  endforeach;

}else {
    echo '<tr><td colspan="6">No Record Found!</td></tr>';
}?>	</table></div>


<div class='table_content'>
    <h3>Additional Fee</h3>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Fee Description</th>
            <th>Amount</th>
            <th>Is Paid</th>
            <th>Paid Date</th>

        </tr>
<?php if(count($additional_fee_row)>0) {
    $inc=1;
    foreach($additional_fee_row as $row):

 ?>

        <tr <?php if($inc%2==0) {echo "class='even txt_center'";}else {echo "class='odd txt_center'";}?>>
            <td><?=$row['description']?></td>
            <td><?=$row['fee']?></td>
            <td><?=($row['is_paid']==1)?"Yes":"No"?></td>
            <td><?=$row['paid_date']?></td>

        </tr>
            <?php $inc++; endforeach;

}else {
    echo '<tr><td colspan="6">No Record Found!</td></tr>';
}?>	</table></div>