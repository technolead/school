<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('staff_attd')?>' method='post'>
        <table>
            <tr>
                <th>Staff ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content ui-corner-all required width_160 jstaff_username'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?><div class="juas_list"></div></td>
            </tr>
            <tr>
                <td colspan="2" class="txt_center">
                    <input type='submit' name='record_attd' value='Add Attendance' class='button' />
                    <input type='submit' name='manage_attd' value='Manage Attendance' class='button' />
                    <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>