<div class='form_content' style="width:880px;">
    <form action="<?=site_url('prev_attd')?>" method="post">
        <table>
            <tr>
                <th>Student ID</th>
                <td><input type="text" name="user_name" value="<?=$_REQUEST['user_name']?>" class="width_160 text ui-widget-content ui-corner-all" /></td>
                <th>Class</th>
                <td><select name="class_id" class="input_txt width_160"><?=combo::get_class_options($_REQUEST['class_id'])?></select></td>
                <th>Date</th>
                <td width="120"><input type="text" name="attd_date" value="<?=$_REQUEST['attd_date']?>" class="date_picker width_80 text ui-widget-content ui-corner-all" /></td>
            </tr>
            <tr>
                <td colspan="6" align="right"><input type='submit' name='search' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="prev_attd/new_attd"  class="jadd_button">Add</button>
        <button title="prev_attd/edit_attd" class="jedit_button">Edit</button>
        <button title="prev_attd/delete_attd" class="jdelete_button">Delete</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>