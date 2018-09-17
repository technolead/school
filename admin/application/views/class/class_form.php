<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Class Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_name' value='<?=set_value('class_name',$class_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('class_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Code <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_code' value='<?=set_value('class_code',$class_code)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('class_code','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>