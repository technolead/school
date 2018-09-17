<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="news/new_category"  class="jadd_button">Add</button>
        <button title="news/edit_category" class="jedit_button">Edit</button>
        <button title="news/delete_category" class="jdelete_button">Delete</button>
         <button title="news/category_status/1" class="jstatus_button">Active</button>
        <button title="news/category_status/0" class="jstatus_button">Deactive</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>