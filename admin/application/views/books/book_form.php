<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>ISBN <span class='req_mark'>*</span></th>
                <td><input type='text' name='isbn' value='<?=$isbn?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('isbn','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Serial No <span class='req_mark'>*</span></th>
                <td><input type='text' name='serial_no' value='<?=$serial_no?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('serial_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Category <span class='req_mark'>*</span></th>
                <td><select name='category_id' class='text ui-widget-content required ui-corner-all width_200'><?=$this->mod_books->category_options($category_id)?></select><?=form_error('category_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Book Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='book_name' value='<?=$book_name?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('book_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Author <span class='req_mark'>*</span></th>
                <td><input type='text' name='author' value='<?=$author?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('author','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Edition <span class='req_mark'>*</span></th>
                <td><input type='text' name='edition' value='<?=$edition?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('edition','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Publication <span class='req_mark'>*</span></th>
                <td><input type='text' name='publication' value='<?=$publication?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('publication','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Book Price <span class='req_mark'>*</span></th>
                <td><input type='text' name='book_price' value='<?=$book_price?>' class='text ui-widget-content required ui-corner-all width_160' /><?=form_error('book_price','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>No Of Copies <span class='req_mark'>*</span></th>
                <td><input type='text' name='no_of_copies' value='<?=$no_of_copies?>' class='text ui-widget-content required ui-corner-all width_160' /><?=form_error('no_of_copies','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Available Copies <span class='req_mark'>*</span></th>
                <td><input type='text' name='available_copies' value='<?=$available_copies?>' class='text ui-widget-content required ui-corner-all width_160' /><?=form_error('available_copies','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Shelf No <span class='req_mark'>*</span></th>
                <td><input type='text' name='shelf_no' value='<?=$shelf_no?>' class='text ui-widget-content required ui-corner-all width_160' /><?=form_error('shelf_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Rack No <span class='req_mark'>*</span></th>
                <td><input type='text' name='rack_no' value='<?=$rack_no?>' class='text ui-widget-content required ui-corner-all width_160' /><?=form_error('rack_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>