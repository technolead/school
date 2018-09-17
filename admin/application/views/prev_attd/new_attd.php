<form id="valid_form" action='<?=site_url('prev_attd/new_attd')?>' method='post'>
<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
        <table>
            <tr>
                <th>Class <span class="req_mark">*</span></th>
                <td><select name="class_id" class="input_txt required"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Cumulative Attendance to Date <span class="req_mark">*</span></th>
                <td><input type="text" name="attd_date" value="<?=set_value('attd_date')?>" class="required date_picker width_80 text ui-widget-content ui-corner-all" /><?=form_error('attd_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='find' value='Find Student' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="b">Previous cumulative attendance</div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            <th>SN</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Attendance (%)</th>
        </tr>
            <?php
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <th><?=$inc?></th>
            <td><input type="hidden" name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['user_name']?></td>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['class_name']?></td>
            <td align="center"><input type="text" name="attd_attendance[]" value="" class="width_200 text ui-widget-content ui-corner-all" /></td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
    </table>
    <div class="pagination_links">
        <input type="submit" name="save" value="Save Attendance" class='button' />
        <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</div>
    <?php }?>
 </form>