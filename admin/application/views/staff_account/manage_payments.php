<?php if ($msg != '') {echo "<div class='success'>$msg</div>";} ?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links ?></div>
        <div class="left width_500 b">Showing <?=$start ?>-<?=$end ?> of <?=$total ?> Payments</div>
        <div class="right"><?=$prev_next ?></div>
        <div class="clear"></div>
    </div>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Paid Date</th>
            <th>Amount</th>
            <th>MPO Amount</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <th>Pay Effect</th>
            <th>Month</th>
            <!--<th>Duration</th>
            <th>Purpose</th>-->
            <th>Inputed By</th>
            <th>Action</th>
        </tr>
    <?php if (count($payment_rows) > 0) {
        $inc=1;
        foreach ($payment_rows as $row): ?>
        <tr <?php if ($inc % 2 == 0) {echo "class='even txt_center'";} else {echo "class='odd txt_center'";} ?>>
            <td><?=$row['paid_date'] ?></td>
            <td><?=$row['paid_amount'] ?></td>
            <td><?=$row['mpo_amount'] ?></td>
            <td><?=$row['pay_mood'] ?></td>
            <td><?=$row['details_name'] ?></td>
            <td><?=$row['pay_effect'] ?></td>
            <td><?=$row['month'] . ' / ' . $row['year'] ?></td>
            <!--<td><?=$row['dur_from_date'] . ' To ' . $row['dur_to_date'] ?></td>
            <td><?=$row['purpose'] ?></td>-->
            <td><?=$row['inputed_by'] ?></td>
            <td class="view_links" style="width:50px;">
                <a href="<?=site_url('staff_account/edit_payment/' . $row['payment_id']) ?>" class="edit_link" title="Change"></a>
                <a href="<?=site_url('staff_account/delete_payment/' . $row['payment_id']) ?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
        <?php $inc++; endforeach; } else {echo '<tr><td colspan="6">No Record Found!</td></tr>';} ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links ?></div>
        <div class="left width_500 b">Showing <?=$start ?>-<?=$end ?> of <?=$total ?> Payments</div>
        <div class="right"><?=$prev_next ?></div>
        <div class="clear"></div>
     </div>
</div>