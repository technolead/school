<div class="form_content">
    <form action="<?=site_url('agents/manage_agents/')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Agent ID</th><td><input type="text" name="user_name" value="<?=$_REQUEST['user_name']?>" class="text ui-widget-content ui-corner-all" /></td>
                <th>Last Name</th><td><input type="text" name="name" value="<?=$_REQUEST['name']?>" class="text ui-widget-content ui-corner-all" /></td>
            </tr>
            <tr>
                <th>Agent Status</th><td><select name="agent_status" class="ui-corner-all" style="padding:0.4em 0;"><?=combo::get_status_options('AGENTS_STATUS',$_REQUEST['agent_status'])?></select></td>
                <th>Agent Type</th><td><select name="agent_type" class="ui-corner-all" style="padding:0.4em 0;"><?=combo::get_type_options('AGENTS_TYPE',$_REQUEST['agent_type'])?></select></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="agents/new_agent"  class="jadd_button">Add</button>
        <button title="agents/edit_agent" class="jedit_button">Edit</button>
        <button title="agents/delete_agents" class="jdelete_button">Delete</button>
        <button title="agents/agents_status/disabled" class="jstatus_button">Activate</button>
        <button title="agents/agents_status/enabled" class="jstatus_button">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>