<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/letter_report')?>' method='post'>
        <table>
            <tr>
                <th>Letters Type</th>
                <td><select name="letters_type_id"><?=$this->mod_letters->get_letter_type_options($_REQUEST['letters_type_id'])?></select></td>
            </tr>
            <tr>
                <th>Class</th>
                <td><select name="class_id" class="input_txt jclass_id"><?=combo::get_class_options($_REQUEST['class_id'])?></select></td>
            </tr>
            
            <tr>
                <th>Session</th>
                <td><select name="session_id" class="input_txt"><?=combo::get_session_options($_REQUEST['session_id'])?></select></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><input type="text" name="from_date" value="<?=$_REQUEST['from_date']?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=$_REQUEST['to_date']?>" class="date_picker width_80" /></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="grid_area">
    <?=$grid_data?>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b"><?=$page_title?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Final Status</th>
            <th>Session Name</th>
            <th>Letter Title</th>
            <th>Issued Date</th>
            <th>Action</th>
        </tr>
            <?php
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['student_status']?></td>
            <td><?=$row['level_name']?></td>
            <td><?=$row['session_name']?></td>
            <td><?=$row['letter_title']?></td>
            <td><?=$row['issue_date']?></td>
            <td class='view_links'>
                <a href='#print_view' rel="<?=site_url('letters/print_view/'.$row['student_letters_id'])?>" class="print_link print_view" title="Print View"></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
    </table>
</div>
    <?php }?>