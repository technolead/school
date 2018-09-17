<div class='form_content' style="width:880px;">
    <form action='<?=site_url('letters/edit_issue_letter/'.$student_letters_id)?>' method='post'>
        <table>
            <tr><th>Issue Date <span class='req_mark'>*</span></th><td><input type="text" name="issue_date" value="<?=$issue_date?>" class="date_picker" /></td></tr>
            <tr></tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td>
                    <textarea name="letter_des" id="content" rows="15" cols="70"><?=$letter_des?></textarea> <br />
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
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>