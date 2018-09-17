<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div>
        <div class="left b">Showing <?=$start?>-<?=$end?> of <?=$total?></div>
        <div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Payment Details Name</th>
            <th>Payment Details For</th>
            <th>Payment Effect</th>
            <th>Task</th>
        </tr>
        <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['details_name']?></td>
            <td><?=$row['pay_details_for']?></td>
            <td><?=$row['pay_effect']?></td>
            <td class='view_links'>
                <?php if(common::user_permit('add','ts_config')){ ?>
                <a href='<?=site_url('scms_config/pay_details_status/'.$row['pay_details_id'].'/'.$row['status'])?>' class="<?=$row['status']?>" title="<?=common::status($row['status'])?>"></a>
                <a href='<?=site_url('scms_config/edit_pay_details/'.$row['pay_details_id'])?>' class="edit_link" title="Change"></a>
                <?php }?>
                <?php if(common::user_permit('delete','ts_config') && $site_data['delete']==1){ ?>
                <a href='<?=site_url('scms_config/delete_pay_details/'.$row['pay_details_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                <?php }?>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
}  ?></table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div>
        <div class="left b">Showing <?=$start?>-<?=$end?> of <?=$total?></div>
        <div class="clear"></div>
    </div>
</div>