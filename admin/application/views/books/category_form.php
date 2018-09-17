<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Category Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='category_name' value='<?=$category_name?>' class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('category_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea name='des' rows='5' cols='40' class='input_txt'><?=$des?></textarea><?=form_error('parent_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>