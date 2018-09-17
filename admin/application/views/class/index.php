<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div style="width:750px;margin:0 auto;">
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="classes/new_class">Add</button>
        <button class="jedit_button" title="classes/edit_class">Edit</button>
        <button class="jdelete_button" title="classes/delete_class">Del</button>
        <button class="jstatus_button" title="classes/class_status/disabled">Activate</button>
        <button class="jstatus_button" title="classes/class_status/enabled">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>