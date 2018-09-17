<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('modules/new_module')?>' method='post'>
        <table>
            <tr>
                <th>Subject Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='module_name' value='<?=set_value('module_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('module_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Subject Code <span class='req_mark'>*</span></th>
                <td><input type='text' name='module_code' value='<?=set_value('module_code')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('module_code','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Marks <span class='req_mark'>*</span></th>
                <td><select name="marks" class="required">
                        <option value="100" selected>100</option>
                        <option value="75">75</option>
                        <option value="50">50</option>
                    </select>
                    <?=form_error('marks','<span>','</span>')?>
                </td>
            </tr>

            <tr>
                <th>Subject Type <span class='req_mark'>*</span></th>
                <td><select name="module_type" class="required">
                        <option value="1" selected>Compulsory</option>
                        <option value="0">Optional</option>
                    </select>
                    <?=form_error('module_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>