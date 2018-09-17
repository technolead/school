<form id="valid_form" action='<?=site_url('user/new_user/basic')?>' method='post'>
    <table>
        <tr>
            <th>First Name <span class='req_mark'>*</span></th>
            <td><input type='text' name='first_name' value='<?=set_value('first_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('first_name','<span>','</span>')?></td>
        </tr>
        <tr>
            <th>Last Name <span class='req_mark'>*</span></th>
            <td><input type='text' name='last_name' value='<?=set_value('last_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('last_name','<span>','</span>')?></td>
        </tr>
        <tr>
            <th>User ID <span class='req_mark'>*</span></th>
            <td><input type='text' name='user_name' value='<?=set_value('user_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('user_name','<span>','</span>')?></td>
        </tr>
        <tr>
            <th>Email <span class='req_mark'>*</span></th>
            <td><input type='text' name='email' value='<?=set_value('email')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('email','<span>','</span>')?></td>
        </tr>
        <tr>
            <th>Designation <span class='req_mark'>*</span></th>
            <td><input type='text' name='designation' value='<?=set_value('designation')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('designation','<span>','</span>')?></td>
        </tr>
        <tr><th>&nbsp;</th><td><input type='submit' name='continue_part_1' value='Continue to Set Permission' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
        </tr>
    </table>
</form>