<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('awarding_body/edit_awarding_body/'.$awarding_body_id)?>' method='post'>
        <table>
            <tr>
                <th style="width:200px;">Awarding Body Name: <span class='req_mark'>*</span></th>
                <td><input type='text' name='awarding_body_name' value='<?=$awarding_body_name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('awarding_body_name','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>