<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('specialization/edit_specialization/'.$specialization_id)?>' method='post'>
        <table>
            <tr>
                <th>Specialization Name: <span class='req_mark'>*</span></th>
                <td><input type='text' name='specialization_name' value='<?=$specialization_name?>' class='text ui-widget-content ui-corner-all required width_200' /> <?=form_error('specialization_name','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>