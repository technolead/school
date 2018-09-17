<?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <table cellspacing='1' cellpadding='1'>
        <tr class="title">
            <th>Class Name</th>
            
            <th>Due Date</th>
            <th>Paid Date</th>
            <th>Amount</th>
            <th>Pay Mood</th>
            <th>Pay Details</th>
            
            <th>Notes</th>
            <th>Action</th>
        </tr>
        <?php if(count($rows)>0) {
            foreach($rows as $row): ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even txt_center'";
                }else {
                    echo "class='odd txt_center'";
                    }?>>
            <td><?=$row['class_name']?></td>
           
            <th><?=$row['committed_date']?></th>
            <td><?=$row['paid_date']?></td>
            <td><?=$row['paid_amount']?></td>
            <td><?=$row['pay_mood']?></td>
            <td><?=$row['pay_details']?></td>
            
            <td><?=$row['notes']?></td>
            <td class="view_links" style="width:50px;">
                        <?php if(common::user_permit('add','std_account')) {?>
                <a href="<?=site_url('accounts/edit_payment/'.$row['payments_id'])?>" class="edit_link" title="Change"></a>
                            <?php }?>
                        <?php if(common::user_permit('delete','std_account')) {?>
                <a href="<?=site_url('accounts/delete_payments/'.$row['payments_id'])?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                            <?php }?>
            </td>
        </tr>
            <?php endforeach;
        }else {
            echo '<tr><td colspan="6">No Record Found!</td></tr>';
        }?>
    </table>
</div>