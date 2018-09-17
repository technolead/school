<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="web_settings/new_featured"  class="jadd_button">Add</button>
        <button title="web_settings/edit_featured" class="jedit_button">Edit</button>
        <button title="web_settings/delete_featured" class="jdelete_button">Delete</button>
         <button title="web_settings/featured_status/1" class="jstatus_button">Active</button>
        <button title="web_settings/featured_status/0" class="jstatus_button">Deactive</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>