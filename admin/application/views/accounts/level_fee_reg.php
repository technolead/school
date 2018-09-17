<?php
if ($msg != '') {
    echo "<div class='success'>$msg</div>";
} ?><div class='table_content'>	<table cellspacing="1" cellpadding="1">		<tr class="title">			<th>Program Name</th>			<th>Level Name</th>			<th>Level Fee</th>			<th>Reg. Fee</th>			<th>Discount Fee</th>			<th>Awarding Body Fee</th>			<th>Deferral Fee</th>			<th>Library Fee</th>			<th>Other Fee</th>			<th>Deposit</th>			<th>Total Fee</th>			<th>Installed Amount</th>			<th>Action</th>		</tr>		<?php
if (count($rows) > 0) {
    $inc = 1;
    foreach ($rows as $row): ?>			<tr <?php
        if ($inc % 2 == 0) {
            echo "class='even txt_center'";
        } else {
            echo "class='odd txt_center'";
        } ?>><td><?=$row['program_name'] ?></td>
             <td><?=$row['level_name'] ?></td>
             <td><?=$row['level_fee'] ?></td>
             <td><?=$row['reg_fee'] ?></td>
             <td><?=$row['discount'] ?></td>
             <td><?=$row['awarding_body_fee'] ?></td>
             <td><?=$row['deferral'] ?></td>
             <td><?=$row['library_fee'] ?></td>
             <td><?=$row['others_fee'] ?></td>
             <td><?=$row['deposit'] ?></td>
             <td><?=$row['total_balance'] ?></td>
             <td><?=$this->mod_accounts->get_installed_amount($row['level_fee_id']) ?></td>
             <td class="view_links" style="width:70px;">
                <?php if (common::user_permit('add', 'std_account')) {?>
                 <a href="<?=site_url('accounts/edit_level_fee/' . $row['level_fee_id']) ?>" class="edit_link" title="Change"></a>
                 <a href="<?=site_url('accounts/set_installment/' . $row['level_fee_id']) ?>" class="install_link" title="Set Installments"></a>
                <?php } ?>
                <?php if (common::user_permit('delete', 'std_account')) {?>
                 <a href="<?=site_url('accounts/delete_level_fee/' . $row['level_fee_id']) ?>" class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>					<?php } ?>				</td>			</tr>		<?php
                $inc++;
            endforeach;
        } else {
            echo "<tr><td colspan='11'>No Record Found!</td></tr>";
        }
?>	</table></div>