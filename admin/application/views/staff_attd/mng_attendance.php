<div class="form_content" style="width: 880px;">
        <form action="<?=site_url('staff_attd/mng_attendance/')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Staff ID</th><td><input type="text" name="user_name" value="<?=$_REQUEST['user_name']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=$_REQUEST['name']?>" class="text ui-widget-content  ui-corner-all width_160" /></td>
                    <th>Staff Status</th><td><select name="staff_status"><?=combo::get_status_options('STAFFS_STATUS',$_REQUEST['staff_status'])?></select></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td colspan="2"><input type="text"  name="from_date" value="<?=$_REQUEST['from_date']?>" class="date_picker text ui-widget-content  ui-corner-all width_80" /> To <input type="text" name="to_date" value="<?=$_REQUEST['to_date']?>" class="date_picker text ui-widget-content ui-corner-all width_80" /></td>
                    <td colspan="3" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
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
        <button id="add" title="staff_attd"  class="jadd_button">Add</button>
        <button title="staff_attd/edit_attendance" class="jedit_button">Edit</button>
        <button title="staff_attd/delete_attendance" class="jdelete_button">Delete</button>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>