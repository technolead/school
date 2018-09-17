<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="content/new_submenu"  class="jadd_button">Add</button>
        <button title="content/edit_submenu" class="jedit_button">Edit</button>
        <button title="content/delete_menu" class="jdelete_button">Delete</button>
         <button title="content/menu_status/1" class="jstatus_button">Active</button>
        <button title="content/menu_status/0" class="jstatus_button">Deactive</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>