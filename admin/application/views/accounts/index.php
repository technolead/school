<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('accounts')?>' method='post'>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content ui-corner-all required width_160 jstudent_username'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?><div class="jstudent_list"></div></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='continue' value='Continue to Student Account' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>