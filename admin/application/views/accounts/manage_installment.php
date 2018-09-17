<?php if ($msg != '') {
    echo "<div class='success'>$msg</div>";
} ?>
<div class='table_content'>
    <table cellspacing="1" cellpadding="1">
        <tr class="title">
            <th>Class Name</th>
            
            <th>Date</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Received Amount</th>
            <th>Due Amount</th>
            <th>Task</th>
        </tr>
<?php if (count($rows) > 0) {
    $inc = 1;
    foreach ($rows as $row):
    ?><tr <?php if ($inc % 2 == 0) {
        echo "class='even txt_center'";
       } else {
            echo "class='odd txt_center'";
        } ?>><td><?=$row['class_name'] ?></td>
             
             <td><?=$row['committed_date'] ?></td>
             <th><?=$row['amount'] ?></th>
             <td><?=$row['notes'] ?></td>
             <td><?=$paid_amount = $this->mod_accounts->get_paid_amount($row['installment_id']) ?></td>
             <td><?=$due = $row['amount'] - $paid_amount ?></td>
             <td class="view_links">
                <?php if (common::user_permit('add', 'std_account')) { ?>
                    <?php if ($due == 0) {echo '<span class="competed_link" title="Received Full Amount"></span>';
            } else { ?><a href="<?=site_url('accounts/receive_payment/' . $row['installment_id']) ?>" class="receive_link" title="Receive Amount"></a><?php } ?>						<a href="<?=site_url('accounts/edit_installment/' . $row['installment_id']) ?>" class="edit_link" title="Change"></a> 						<?php } ?>						<?php if (common::user_permit('delete', 'std_account')) { ?>						<a href="<?=site_url('accounts/delete_fee_installment/' . $row['installment_id']) ?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>					<?php } ?>					</td>				</tr>			<?php $inc++;
    endforeach;
} else {
    echo "<tr><td colspan='6'>No Record Found!</td></tr>";
} ?>			</table></div>