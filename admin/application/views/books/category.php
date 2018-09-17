<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="books/new_books_category"  class="jadd_button">Add</button>
        <button title="books/edit_books_category" class="jedit_button">Edit</button>
        <button title="books/delete_books_category" class="jdelete_button">Delete</button>
        <button title="books/books_category_status/disabled" class="jstatus_button">Activate</button>
        <button title="books/books_category_status/enabled" class="jstatus_button">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>