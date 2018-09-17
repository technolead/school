<?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Payments</div>
        <div class="clear"></div>
    </div>	
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Month</th>
            <th>Net Pay</th>
            <th>To be Added</th>
            <th>To be deduced</th>
            <th>total</th>
            <th>Paid Date</th>
            <th>Paid Amount</th>
            <th>Pay Mood</th>
            <th>Due</th>
            <th>Paid holidays</th>
            <th>paid absent</th>
            <th>Action</th>
        </tr>
        <?php if(count($rows)>0) {
            foreach($rows as $row): ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even txt_center'";
                }else {
                    echo "class='odd txt_center'";
                    }?>>
            <td><?=$row['month'].' / '.$row['year']?></td>
            <td><?=$row['net_pay']?></td>
            <td><?=$row['payable_total']?></td>
            <td><?=$row['deduced_total']?></td>
            <td><?=$row['total']?></td>
            <td><?=$row['paid_date']?></td>
            <td><?=$row['paid_amount']?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['due']?></td>
            <td><?=$row['paid_holidays']?></td>
            <td><?=$row['paid_absent']?></td>
            <td class="view_links" style="width:80px;">
                <a href='#print_view' rel="<?=site_url('staff_account/print_balance/'.$row['balance_id'])?>" class="print_view print_link" title="Print View"></a
                <a href="<?=site_url('staff_account/edit_balance/'.$row['balance_id'])?>" class="edit_link" title="Change"></a>
                <a href="<?=site_url('staff_account/delete_balance/'.$row['balance_id'])?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
            <?php endforeach;
        }else {
            echo '<tr><td colspan="6">No Record Found!</td></tr>';
        }?>	</table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Payments</div>
        <div class="clear"></div>
    </div>
</div>