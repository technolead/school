<div class="form_content">
     <form action="<?=site_url('attendance/mng_print_attendance')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_print_attendance->get_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
    
</div>
<div class='grid_area' style="width: 880px;">
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <button id="add" title="attendance/print_attendance"  class="jadd_button">Add</button>
        <button title="attendance/edit_print_attendance" class="jedit_button">Edit</button>
        <button title="attendance/del_print_attendance" class="jdelete_button">Delete</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>