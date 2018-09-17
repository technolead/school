<div class="form_content" style="width:860px;">
     <form action="<?=site_url('books')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_books->get_book_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                <th>Category</th>
                <td><select name="category_id" class="width_160"><?=$this->mod_books->category_options($_REQUEST['category_id'])?></select></td>
            </tr>
            <tr>
                <td colspan="6" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='grid_area' style="width:880px;">
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="books/new_book"  class="jadd_button">Add</button>
        <button title="books/edit_book" class="jedit_button">Edit</button>
        <button title="books/delete_book" class="jdelete_button">Delete</button>
        <button title="books/books_status/disabled" class="jstatus_button">Activate</button>
        <button title="books/books_status/enabled" class="jstatus_button">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>