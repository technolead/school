<div class='form_content'>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='title' value='<?=$title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>