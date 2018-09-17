<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/view_exam_fee')."/".$payment_type?>' method='post'>
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
                <th>Exam </th>
                <td>
                    <select name="exam_id" >
                        <option value="">-- Select Exam --</option>
                        <?=combo::get_exam_options(set_value('exam_id',$_REQUEST['exam_id']))?>
                    </select>
                </td>
            </tr>
            


            <tr><th>&nbsp;</th>
                <td><input type='submit' name='apply_filter' value='Apply Filter' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<?php if(count($exam_fee)>0) {?>
<div class='table_content'>
    <div class="pagination_links">

        <div class="left b">Monthly Fee <?if($payment_type=="paid"){echo "Paid";}else{echo "Due";} ?></div>
        <a href='#print_view' rel="<?=site_url('report/print_exam_fee')?>" class="print_view right" title="Print View">Print View</a>
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
        <tr style="background:#d4ded3;color:#00f;">
            <th colspan="5" style="text-align:right">Total</th>

            <th style="text-align:right"><?=number_format($exam_fee_total,2,'.',',')?></th>
            

        </tr>
    </table>
</div>
<?php }?>




