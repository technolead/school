<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('staffs/edit_department/'.$staff_department_id)?>' method='post'>
        <table>
            <tr>
                <th>Department Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='name' value='<?=$name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>