<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url($action)?>' method='post'>
        <table>
            <tr>
                <th>Designation <span class='req_mark'>*</span></th>
                <td><input type='text' name='designation' value='<?=set_value('designation',$designation)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('designation','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>MPO Scale <span class='req_mark'>*</span></th>
                <td><input type='text' name='mpo_scale' value='<?=set_value('mpo_scale',$mpo_scale)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('mpo_scale','<span>','</span>')?></td>
            </tr>

            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='<?=$submit_value?>' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>