<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="static_pages/new_page"  class="jadd_button">Add</button>
        <button title="static_pages/edit_page" class="jedit_button">Edit</button>
        <button title="static_pages/delete_page" class="jdelete_button">Delete</button>
        <button title="static_pages/page_status/1" class="jstatus_button">Active</button>
        <button title="static_pages/page_status/0" class="jstatus_button">Deactive</button>
    </div>
    <hr />
<?php echo $grid_data ?>
</div>