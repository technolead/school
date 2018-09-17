<div class="form_content">
     <form action="<?=site_url('events')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_events->get_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
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
        <button id="add" title="events/new_event"  class="jadd_button">Add</button>
        <button title="events/edit_event" class="jedit_button">Edit</button>
        <button title="events/delete_event" class="jdelete_button">Delete</button>
         <button title="events/event_status/disabled" class="jstatus_button">Active</button>
        <button title="events/event_status/enabled" class="jstatus_button">Deactive</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>