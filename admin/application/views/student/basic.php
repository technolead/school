<form id="valid_form" action='<?=site_url('student/new_student/basic')?>' method='post' enctype="multipart/form-data">
    <div class='form_content'>
        <h3>Basic Information</h3>
        <table>
            <tr>
                <th>Student ID <span class='req_mark'>*</span></th>
                <td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('user_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><input type='text' name='title' value='<?=set_value('title')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Gender <span class='req_mark'>*</span></th>
                <td><select name="gender" class="ui-corner-all required"><?=combo::get_gender_options(set_value('gender'))?></select><?=form_error('gender','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>First Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='first_name' value='<?=set_value('first_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('first_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Last Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='last_name' value='<?=set_value('last_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('last_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Date of Birth <span class='req_mark'>*</span></th>
                <td><input type='text' name='date_of_birth' value='<?=set_value('date_of_birth')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('birth_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Present Address <span class='req_mark'>*</span></th>
                <td><textarea name="present_address" rows='5' cols='40' class='ui-widget-content required ui-corner-all'><?=set_value('present_address')?></textarea><?=form_error('present_address','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Permanent Address</th>
                <td><textarea name="permanent_address" rows='5' cols='40' class='ui-widget-content ui-corner-all'><?=set_value('permanent_address')?></textarea><?=form_error('permanent_address','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Nationality <span class='req_mark'>*</span></th>
                <td><select name="nationality" class="ui-corner-all required"><?=combo::get_country_list(set_value('nationality'))?></select><?=form_error('nationality','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Marital Status <span class='req_mark'>*</span></th>
                <td><select name="marital_status" class="ui-corner-all required"><?=combo::get_marital_status(set_value('marital_status'))?></select><?=form_error('marital_status','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Telephone</th>
                <td><input type='text' name='phone' value='<?=set_value('phone')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('phone','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Mobile</th>
                <td><input type='text' name='mobile' value='<?=set_value('mobile')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('mobile','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email </th>
                <td><input type='text' name='email' value='<?=set_value('email')?>' class='text ui-widget-content ui-corner-all email width_200' /><?=form_error('email','<span>','</span>')?></td>
            </tr>
        </table>
    </div>


    <div class='form_content'>
        <h3>Parent Information</h3>
        <table>
            
            <tr>
                <th>Father's Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='father_name' value='<?=set_value('father_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('father_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Mother's Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='mother_name' value='<?=set_value('mother_name')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('mother_name','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Parent's Address <span class='req_mark'>*</span></th>
                <td><textarea name="parent_address" rows='5' cols='40' class='ui-widget-content required ui-corner-all'><?=set_value('parent_address')?></textarea><?=form_error('parent_address','<span class="block">','</span>')?></td>
            </tr>

            <tr>
                <th>Parent's Phone <span class='req_mark'>*</span></th>
                <td><input type='text' name='parent_phone' value='<?=set_value('parent_phone')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('parent_phone','<span>','</span>')?></td>
            </tr>

            <tr><th>&nbsp;</th><td>(If Applicable)</td></tr>
            <tr>
                <th>Legal Guardian's Name </th>
                <td><input type='text' name='legal_guardian_name' value='<?=set_value('legal_guardian_name')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('legal_guardian_name','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Legal Guardian's Address </th>
                <td><textarea name="legal_guardian_address" rows='5' cols='40' class='ui-widget-content ui-corner-all'><?=set_value('legal_guardian_address')?></textarea><?=form_error('legal_guardian_address','<span class="block">','</span>')?></td>
            </tr>

            <tr>
                <th>Legal Guardian's Phone</th>
                <td><input type='text' name='legal_guardian_phone' value='<?=set_value('legal_guardian_phone')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('legal_guardian_phone','<span>','</span>')?></td>
            </tr>

            
        </table>
    </div>

    <div class='form_content'>
        <h3>Registration</h3>
        <table>
            <tr>
                <th>Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=set_value('admission_date')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>   
            
            <tr>
                <th>Student Status <span class='req_mark'>*</span></th>
                <!--<td><select name="student_status" class="ui-corner-all required"><?=combo::get_status_options('STUDENT_STATUS',set_value('student_status'))?></select><?=form_error('student_status','<span>','</span>')?></td>-->
                <td><select name="student_status" class="ui-corner-all required"><?=combo::get_student_status(set_value('student_status'))?></select><?=form_error('student_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td><input type='text' name='std_status_date' value='<?=set_value('std_status_date')?>' class='text ui-widget-content ui-corner-all  width_80 date_picker' /><?=form_error('std_status_date','<span>','</span>')?></td>
            </tr>

            

            <tr>
                <th>Branch: <span class='req_mark'>*</span></th>
                <td><select name="branch_id" class="required"><?=common::get_branch_options(set_value('branch_id'))?></select><?=form_error('branch_id','<span>','</span>')?></td>
            </tr>
           

            
            <tr>
                <th>Session <span class='req_mark'>*</span></th>
                <td><select name="session_id" class="input_txt jsession_class required"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_details jclass_list jselected_class_id jsession_class_list required"><?=combo::get_session_class(set_value('session_id'),set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class Start Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_start_date' value='<?=$start_date?>' class='text ui-widget-content ui-corner-all  width_80 jc_start_date' readonly /><?=form_error('class_start_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class End Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='class_end_date' value='<?=$end_date?>' class='text ui-widget-content ui-corner-all  width_80 jc_end_date' readonly /><?=form_error('class_end_date','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Section <span class='req_mark'>*</span></th>
                <td><select name="section" class="required"><?=combo::get_type_options('SECTION',set_value('section',$section))?></select><?=form_error('section','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Optional/Elective Subject </th>
                <td>
                    <select name="optional_module_id" class="jclass_optional_module">
                        <option value="" selected="selected">Select Optional Subject</option>
                    </select>
                    
                </td>
            </tr>

            <tr>
                <th>Privilege <span class='req_mark'>*</span></th>
                <td>
                    <select name="privilege" class="required">
                        <?=common::get_privilege_options(set_value('privilege'))?>
                    </select>
                    <?=form_error('privilege','<span>','</span>')?>
                </td>
            </tr>

            
        </table>
    </div>
    
    
    
    
    <div class='form_content'>
        <h3>Qualification Information</h3>
        <table>
            <tr class="title"><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
            <?php for($inc=0;$inc<5;$inc++) { ?>
            <tr>
                <td><input type="text" name="qualifications[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("qualifications[$inc]")?>" /></td>
                <td><input type="text" name="awarding_body[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("awarding_body[$inc]")?>" /></td>
                <td><input type="text" name="year[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("year[$inc]")?>" /></td>
                <td><input type="text" name="grade[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("grade[$inc]")?>" /></td>
            </tr>
                <?php }  ?>
            
        </table>
    </div>
    
    <div class='form_content'>
        <h3>Documents Information</h3>
        <table>
            <tr><th style="width:200px;">Photograph <input type="checkbox" name="document_submitted[]" value="1" /></th><td><input type="file" name="photograph" /><span style="color:blue;" class='b'>NOTE:Valid File(jpg,gif,png)</span></td></tr>
            <tr><th>Copy Of Certificates <input type="checkbox" name="document_submitted[]" value="2" /></th><td><input type="file" name="doc_cirtificate" /><span style="color:blue;" class='b'>NOTE:Valid File(doc, docx, pdf, txt, jpg, gif, png, zip)</span></td></tr>
            <tr>
                <th>Documents Required:</th>
                <td><input type='text' name='doc_required' value='<?=set_value('doc_required')?>' class='text ui-widget-content ui-corner-all  width_200' /><?=form_error('doc_required','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td colspan="3"><textarea name='comments' rows='5' cols='40' class="ui-widget-content ui-corner-all"><?=set_value('comments')?></textarea><?=form_error('comments','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='continue_basic' value='Complete Registration' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>