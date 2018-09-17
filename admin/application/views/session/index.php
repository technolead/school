
<div style="width:750px;margin:0 auto;">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="session/new_session">Add</button>
        <button class="jedit_button" title="session/edit_session">Edit</button>
        <button class="jdelete_button" title="session/delete_session">Del</button>
        <button class="jstatus_button" title="session/session_status/disabled">Activate</button>
        <button class="jstatus_button" title="session/session_status/enabled">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>