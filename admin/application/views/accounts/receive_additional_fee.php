<div class='form_content'>
    <h3>Receive Additional Fee</h3>
    <form id="valid_form" action="<?=site_url($action)?>" method='post'>
        <table>
            <tr>
                <th>Student ID :</th>
                <td><?=$student_id?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?=$description?></td>
            </tr>

            <tr>
                <th>Amount <span class="req_mark">*</span></th>
                <td><input type="text" name="fee" value="<?=set_value('fee')?>" class="text ui-widget-content ui-corner-all required width_160" autocomplete="off" /><?=form_error('fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Payment Date <span class="req_mark">*</span></th>
                <td><input type="text" name="date" value="<?=set_value('date')?>" class="text ui-widget-content ui-corner-all required width_160 date_picker" autocomplete="off" /></td>
            </tr>

            <tr>
                <th>&nbsp;</th>
                <td>
                    <input type='submit' name='save' value='Save' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>