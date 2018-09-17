<div class="grid_area">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars">
        <button id="add" title="user/new_user"  class="jadd_button">Add</button>
        <button title="user/edit_user" class="jedit_button">Edit</button>
        <button title="user/delete_user" class="jdelete_button">Delete</button>
        <button title="user/user_status/disabled" class="jstatus_button">Activate</button>
        <button title="user/user_status/enabled" class="jstatus_button">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>