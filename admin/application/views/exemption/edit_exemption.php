<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('exemption/edit_exemption/'.$exemption_id)?>' method='post'>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content required ui-corner-all width_200 jstudent_username'  name='user_name' value='<?=$user_name?>' /><?=form_error('user_name','<span>','</span>')?>
                    <div class="jstudent_list"></div>
                </td>
            </tr>
            <tr>
                <th>From Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='from_date' value='<?=$from_date?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /><?=form_error('from_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='to_date' value='<?=$to_date?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /><?=form_error('to_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Reason <span class='req_mark'>*</span></th>
                <td><input type="text" name="reason" value="<?=$reason?>" class="text ui-widget-content required ui-corner-all width_200" /><?=form_error('reason','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>