<div class='form_content' style="width:880px;">
     <h3 class="fl_left"><?=$page_title?></h3><a href='#print_view' rel="<?=site_url('letters/letter_variable/')?>" class="fl_right print_view round" title="Letter Variable List">Letter Variable List</a>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('letters/edit_letter/'.$letters_id)?>' method='post'>
        <table>
            <tr>
                <th>Letters Type <span class='req_mark'>*</span></th>
                <td><select name="letters_type_id" class="required"><?=$this->mod_letters->get_letter_type_options($letters_type_id)?></select></td>
            </tr>
            <tr>
                <th>Letter Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='letter_title' value='<?=$letter_title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td>
                    <textarea name="des" id="content" rows="15" cols="60" class="required"><?=$des?></textarea> <br />
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$user_name');">[Student ID]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$title');">[Title]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$first_name');">[First Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$last_name');">[Last Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$date_of_birth');">[Date of Birth]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$passport_no');">[Passport No]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$passport_expiry');">[Passport Expiry]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$visa_number');">[Visa Number]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$visa_expiry');">[Visa Expiry]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$visa_status');">[Visa Status]</a>

                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$admission_date');">[Admission Date]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$present_address');">[Present Address]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$permanent_address');">[Permanent Address]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$email');">[Email]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$nationality');">[Nationality]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$entry_to_uk');">[Entry to UK]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$mobile');">[Mobile]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$phone_overseas');">[Phone Overseas]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$phone_uk');">[Phone UK]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$mobile');">[Mobile]</a>


                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$program_name');">[Program Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$program_code');">[Program Code]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$pro_start_date');">[Program Start Date]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$pro_end_date');">[Program End Date]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$mood_of_study');">[Program Study Mood]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$program_duration');">[Program Duration]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$program_fee');">[Program Fee]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$awarding_body_name');">[Awarding Body Name]</a>

                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$specialization_name');">[Specialization Name]</a>
                    <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'$letter[issue_date]');">[Letter Issued Date]</a>

                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>