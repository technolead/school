<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form  id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Country Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='country_name' value='<?=set_value('country_name',$country_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('country_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Nationality <span class='req_mark'>*</span></th>
                <td><input type='text' name='nationality' value='<?=set_value('nationality',$nationality)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('nationality','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>