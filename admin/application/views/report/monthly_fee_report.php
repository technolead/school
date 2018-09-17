<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/view_monthly_fee')."/".$payment_type?>' method='post'>
        <table>
            <tr>
                <th>Date</th>
                <td><input type="text" name="from_date" value="<?=set_value('from_date',$_REQUEST['from_date'])?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date',$_REQUEST['to_date'])?>" class="date_picker width_80" /></td>
            </tr>

            

            <tr>
                <th>Session </th>
                <td><select name="session_id" class="ui-corner-all"><?=combo::get_session_options(set_value('session_id',$_REQUEST['session_id']))?></select></td>
            </tr>


            <tr>
                <th>Class </th>
                <td><select name="class_id" class="ui-corner-all"><?=combo::get_class_options(set_value('class_id',$_REQUEST['class_id']))?></select></td>
            </tr>


            <tr>
                <th>Section </th>
                <td><select name="section"><?=combo::get_type_options('SECTION',set_value('section',$_REQUEST['section']))?></select></td>
            </tr>


            <tr>
                <th>Month </th>
                <td><select class="width_200" name="month"><?=common::get_month_options(set_value('month',$_REQUEST['month']))?></select></td>
            </tr>


            <tr><th>&nbsp;</th>
                <td><input type='submit' name='apply_filter' value='Apply Filter' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<?php if(count($monthly_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">

        <div class="left b">Monthly Fee <?if($payment_type=="paid"){echo "Paid";}else{echo "Due";} ?></div>
        <a href='#print_view' rel="<?=site_url('report/print_monthly_fee')?>" class="print_view right" title="Print View">Print View</a>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            
            <th>Session</th>
            <th>Class</th>
            <th>Section</th>
            <th>Month</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Privilege</th>
            <th><?if($payment_type=="paid"){echo "Payment";}else{echo "Due";} ?></th>
            <?if($payment_type=="paid"){?><th>Fine</th><?}?>

        </tr>
            <?php
    $inc=1;
    foreach($monthly_fee as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            
            <td><?=$row['session_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['section']?></td>
            <td><?=$row['month']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['student_name']?></td>
            <td><?=common::get_privilege_name($row['privilege'])?></td>
            <td class="txt_right"><?=$row['fee']?></td>
            <?if($payment_type=="paid"){?><td class="txt_right"><?=$row['fine']?></td><?}?>
            <?
                $class_fee_total+=$row['fee'];
                $fine_total+=$row['fine'];

            ?>


        </tr>
        <?php $inc++;
    endforeach;
    ?>
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan="7" style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($class_fee_total,2,'.',',')?></th>
            <?if($payment_type=="paid"){?><th style="text-align:right"><?=number_format($fine_total,2,'.',',')?></th><?}?>

        </tr>
    </table>
</div>
<?php }?>


<?php if(count($monthly_fee)>0) {
    $total_credit=$class_fee_total+$fine_total;

    echo'<div class="table_content">
            <table  cellpadding="0" cellspacing="1">
                <tr class="title">
                    <th>Net Total:</th>
                    <th style="text-align:right">Total '.$payment_type.'</th>
		</tr>
		<tr class="odd">
                    <th>Total</th>
                    <th style="text-align:right">'.number_format($total_credit,2,'.',',').'</th>
                    
		</tr>
            </table>
	</div>';
}?>


