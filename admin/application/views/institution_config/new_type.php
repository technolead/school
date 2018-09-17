<div class='form_content'>
	<h3><?=$page_title?></h3>
        <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Type Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='institution_type' value='<?=set_value('institution_type',$institution_type)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('institution_type','<span>','</span>')?></td>
            </tr>
            
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>