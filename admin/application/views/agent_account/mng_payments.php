<?php include_once 'agent_info.php'?>
<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Agent Payments</span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
    <table class="txt_center" cellpadding="0" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Date</th>
            <th>Due Amount</th>
            <th>Paid Amount</th>
            <th>Balance</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            <th>Comments</th>
            <th>Action</th>
        </tr>
        <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['paid_date']?></td>
            <td><?=$row['due_amount']?></td>
            <td><?=$row['paid_amount']?></td>
            <td><?=$row['agent_balance']?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['details_name']?></td>
            <td><?=$row['comments']?></td>
            <td class='view_links'>
                <?php if(common::user_permit('add','agent_payment')){ ?>
                <a href='#print_view' rel="<?=site_url('agent_account/print_payment/'.$row['agent_payment_id'])?>" class="print_view print_link" title="Print View"></a
                <a href='<?=site_url('agent_account/edit_payment/'.$row['agent_payment_id'])?>' class="edit_link" title="Change"></a>
                <?php }?>
                <?php if(common::user_permit('delete','agent_payment') && $site_data['delete']==1){ ?>
                <a href='<?=site_url('agent_account/delete_payment/'.$row['agent_payment_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                <?php }?>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?><span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?>  Agent Payments</span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>