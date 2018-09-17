<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Exam Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='exam_name' value='<?=set_value('exam_name',$exam_name)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('exam_name','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Exam Fee <span class='req_mark'>*</span></th>
                <td><input type='text' name='exam_fee' value='<?=set_value('exam_fee',$exam_fee)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('exam_fee','<span>','</span>')?></td>
            </tr>
            
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>