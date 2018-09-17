<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div>
        <form action="<?=site_url('agents/manage_agents/')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Agent ID</th><td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class="width_160" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=set_value('name')?>" class="width_160" /></td>
                    <th>Agent Status</th><td><select name="agent_status"><?=combo::get_status_options('AGENTS_STATUS',set_value('agent_status'))?></select></td>
                    <th>Agent Type</th><td><select name="agent_type"><?=combo::get_type_options('AGENTS_TYPE',set_value('agent_type'))?></select></td>
                </tr>
                <tr>
                    <td colspan="8" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Agents</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Agent ID</th>
            <th>Name</th>
            <th>Agent Status</th>
            <th>Agent Type</th>
            <th>Company Name</th>
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
            <td><?=$row['user_name']?></td>
            <td><a href="<?=site_url('agents/profile/'.$row['agents_id'])?>" title="See Profile"><?=$row['first_name'].' '.$row['last_name']?></a></td>
            <td><?=$row['agent_status']?></td>
            <td><?=$row['agent_type']?></td>
            <td><?=$row['company_name']?></td>
            <td class='view_links' style="width:120px;">
                <?php if(common::user_permit('add','agents')){ ?>
                <a href='<?=site_url('agents/agents_status/'.$row['agents_id'].'/'.$row['status'])?>' class="<?=$row['status']?>" title="<?=common::status($row['status'])?>"></a>
                <a href='<?=site_url('agents/edit_agent/'.$row['agents_id'])?>' class="edit_link" title="change"></a>
                <a href='#print_view' rel="<?=site_url('agents/print_view/'.$row['agents_id'])?>" class="print_link print_view" title="Print View"></a>
                <?php }?>
                <?php if(common::user_permit('delete','agents') && $site_data['delete']==1){ ?>
                <a href='<?=site_url('agents/delete_agents/'.$row['agents_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                <?php }?>
            </td>
        </tr>
                <?php $inc++;
            endforeach;
        }else {
            echo "<tr><td colspan='26'>No Content Found!!!</td></tr>";
        }  ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Agents</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>