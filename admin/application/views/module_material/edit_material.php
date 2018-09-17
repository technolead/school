<div class='form_content'>
    <form id="valid_form" action='<?=site_url('module_material/edit_material/'.$module_material_id)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select class="text ui-widget-content required ui-corner-all width_200" name="module_id"><?=$this->mod_module_material->get_staff_module_options($module_id)?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Lecture Notes <span class='req_mark'>*</span></th>
                <td><textarea name='lecture_notes' rows='10' cols='50' class="required"><?=$lecture_notes?></textarea><?=form_error('lecture_notes','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Lecture File</th>
                <td>
                    <a href="<?=base_url()?>uploads/materials/<?=$lecture_file?>" target="_blank"><?=$file_name?></a><br />
                    <input type='hidden' name='h_lecture_file' value="<?=$lecture_file?>" />
                    <input type='hidden' name='h_file_name' value="<?=$file_name?>" />
                    <input type='file' name='lecture_file' /><span class="b">NOTE:Valid File(doc, docx, pdf, txt, jpg, gif, png, zip)</span>
                </td>
            </tr>
            <tr>
                <th>Posted Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='posted_date' value='<?=$posted_date?>' class='text ui-widget-content required ui-corner-all width_160 date_picker' /><?=form_error('posted_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Valid Until <span class='req_mark'>*</span></th>
                <td><input type='text' name='valid_until' value='<?=$valid_until?>' class='text ui-widget-content required ui-corner-all width_160 date_picker' /><?=form_error('valid_until','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>