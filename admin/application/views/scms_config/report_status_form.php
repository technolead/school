<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Status Name <span class='required'>*</span></th>
                <td><input type='text' name='report_status' value='<?=set_value('report_status',$report_status)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('report_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status Marks <span class='required'>*</span></th>
                <td><input type="text" name="mark" value="<?=$mark?>" /><?=form_error('mark','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>