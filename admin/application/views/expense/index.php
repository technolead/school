<div class='form_content'>
    <form action="<?=site_url('expense')?>" method="post">
        <table>
            <tr>
                <th>Date</th>
                <td width="120"><input type="text" name="exp_date" value="<?=$_REQUEST['exp_date']?>" class="date_picker width_80 text ui-widget-content ui-corner-all" /></td>
                <td><input type='submit' name='search' value='Search' class='button' /></td>
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
        <button id="add" title="expense/new_expense"  class="jadd_button">Add</button>
        <button title="expense/edit_expense" class="jedit_button">Edit</button>
        <button title="expense/delete_expense" class="jdelete_button">Delete</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>