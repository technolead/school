<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div style="width:750px;margin:0 auto;">
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="settings/new_branch">Add</button>
        <button class="jedit_button" title="settings/edit_branch">Edit</button>
        <button class="jdelete_button" title="settings/delete_branch">Del</button>
        <button class="jstatus_button" title="settings/branch_status/disabled">Activate</button>
        <button class="jstatus_button" title="settings/branch_status/enabled">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>