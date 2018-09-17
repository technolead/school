<div class='form_content' style="width:880px;">
    <h3 class="fl_left"><?=$page_title?></h3><a href='#print_view' rel="<?=site_url('letters/letter_variable/')?>" class="fl_right print_view round" title="Letter Variable List">Letter Variable List</a>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('letters/new_letter')?>' method='post'>
        <table>
            <tr>
                <th width="100">Letter Type <span class='req_mark'>*</span></th>
                <td><select name="letters_type_id" class="required"><?=$this->mod_letters->get_letter_type_options(set_value('letters_type_id'))?></select><?=form_error('letters_type_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Letter Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='letter_title' value='<?=set_value('letter_title')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('letter_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td><?=form_error('des','<span class="block">','</span>')?><textarea name="des" id="content" class="required" rows="10" cols="60"><?=set_value('des')?></textarea>
                <br />
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$user_name');">[Student ID]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$title');">[Title]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$first_name');">[First Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$last_name');">[Last Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$date_of_birth');">[Date of Birth]</a>
                    

                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$admission_date');">[Admission Date]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$present_address');">[Present Address]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$permanent_address');">[Permanent Address]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$email');">[Email]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$nationality');">[Nationality]</a>
                    
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$mobile');">[Mobile]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$phone');">[Phone]</a>
                    

                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_name');">[Class Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_code');">[Class Code]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_start_date');">[Class Start Date]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_end_date');">[Class End Date]</a>
                    
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_duration');">[Class Duration]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$class_fee');">[Class Fee]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$awarding_body_name');">[Awarding Body Name]</a>

                    
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$letter[issue_date]');">[Letter Issued Date]</a>

                </td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>