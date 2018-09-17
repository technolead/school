<!--<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/staff_report')?>' method='post'>
        <table>
            <tr>
                <th>Passport Date</th>
                <td><input type="text" name="pass_from_date" value="<?=$_REQUEST['pass_from_date']?>" class="date_picker width_80" /> To <input type="text" name="pass_to_date" value="<?=$_REQUEST['pass_to_date']?>" class="date_picker width_80" /></td>
            </tr>
            <tr>
                <th>Visa Date</th>
                <td><input type="text" name="visa_from_date" value="<?=$_REQUEST['visa_from_date']?>" class="date_picker width_80" /> To <input type="text" name="visa_to_date" value="<?=$_REQUEST['visa_to_date']?>" class="date_picker width_80" /></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>-->
<div class="grid_area">
    <?=$grid_data?>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Staffs Report</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1" class="txt_center">
        <tr class='title'>
            <th>Staff Name</th>
            <th>User Name</th>
            <th>Final Status</th>
            <th>Passport Expiry Date</th>
            <th>Visa Expiry Date</th>
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
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['staff_status']?></td>
            <td><?=$row['passport_expiry']?></td>
            <td><?=$row['visa_expiry']?></td>
            <td class='view_links'>
                <a href='#print_view' rel="<?=site_url('staffs/print_view/'.$row['staffs_id'])?>" class="print_link print_view" title="Print View"></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
    ?>
    </table>
</div>
    <?php }?>