<div class='form_content' style="width:880px;">
    <h3 class="fl_left"><?=$page_title?></h3>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('letters/new_official_letter')?>' method='post' enctype="multipart/form-data">
        <table>
            
            <tr>
                <th>Letter Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='title' value='<?=set_value('title')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('title','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Add Letter By <span class='req_mark'>*</span></th>
                <td>
                    <input type="radio" name="letter_insert_type" value="upload" />Upload
                    <input type="radio" name="letter_insert_type" value="description" checked />Written Description
                </td>
            </tr>

            
            <tr >
                <th>Upload Letter </th>
                <td><input type="file" name="letter_url" /><span style="color:blue;" class='b'>NOTE:Valid File(doc, docx, pdf, txt, jpg, gif, png, zip)</span></td>
                 
            </tr>
            

            
            <tr>
                <th>Description </th>
                <td>
                    <textarea name="description" id="content"  rows="10" cols="60"><?=set_value('description')?></textarea>
                    <?=form_error('description','<span class="block">','</span>')?>
                </td>                
            </tr>
            

            <tr>
                <th>Issue Date <span class='req_mark'>*</span></th>
                <td><input type="text" name="issue_date" value="<?=set_value('issue_date')?>" class="text ui-widget-content ui-corner-all required date_picker"></td>
            </tr>

            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>