<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Training Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='training_title' value='<?=set_value('training_title',$training_title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('training_title','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Increment Amount <span class='req_mark'>*</span></th>
                <td><input type='text' name='increment' value='<?=set_value('increment',$increment)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('increment','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>