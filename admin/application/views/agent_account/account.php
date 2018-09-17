<?php include_once 'agent_info.php'?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?></span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Program Code</th>
            <th>Level Name</th>
            <th>Student Status</th>
            <th>Agent Amount</th>
            <th>Due Amount</th>
            <th>Paid Amount</th>
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
            <td><?=$row['program_code']?></td>
            <td><?=$row['level_name']?></td>
            <td><?=$row['student_status']?></td>
            <th><?=$row['agent_amount']?></th>
            <th><?=$due=$row['agent_amount']-$this->mod_agent_account->get_paid_amount($row['payments_id'])?></th>
            <th><?=$this->mod_agent_account->get_paid_amount($row['payments_id'])?></th>
            <td class='view_links links'>
                        <?php if($due==0) {
                            echo '<span class="competed_link" title="Received Full Amount"></span>';
                        }else { ?>
                <?php if(common::user_permit('add','agent_payment')){?><a href="<?=site_url('agent_account/make_payment/'.$row['payments_id'])?>" style="width:80px;">Make Payment</a><?php }?>
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
        <div class="left"><?=$pagination_links?><span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?></span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>