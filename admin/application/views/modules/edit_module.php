<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('modules/edit_module/'.$module_id)?>' method='post'>
        <table>
            <tr>
                <th>Subject Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='module_name' value='<?=$module_name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('module_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Subject Code <span class='req_mark'>*</span></th>
                <td><input type='text' name='module_code' value='<?=$module_code?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('module_code','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Marks <span class='req_mark'>*</span></th>
                <td><select name="marks" class="required">
                        <option value="100" <?if($marks==100)echo 'selected'?>>100</option>
                        <option value="75" <?if($marks==75)echo 'selected'?> >75</option>
                        <option value="50" <?if($marks==50)echo 'selected'?> >50</option>
                    </select>
                    <?=form_error('marks','<span>','</span>')?>
                </td>
            </tr>

             <tr>
                <th>Subject Type <span class='req_mark'>*</span></th>
                <td><select name="module_type" class="required">
                        <option value="1" <?if($is_compulsary==1)echo 'selected'?>>Compulsory</option>
                        <option value="0" <?if($is_compulsary==0)echo 'selected'?>>Optional</option>
                    </select>
                    <?=form_error('module_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>