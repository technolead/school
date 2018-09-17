<form id="valid_form" action='<?=site_url('staffs/new_staff/basic')?>' method='post' enctype="multipart/form-data">
    <div class='form_content'>
        <h3>Personal Information</h3>
        <table>
            <tr>
                <th>Staff ID <span class='req_mark'>*</span></th>
                <td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('user_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><input type='text' name='title' value='<?=set_value('title')?>' class='text ui-widget-content ui-corner-all  width_160' /><?=form_error('title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Gender <span class='req_mark'>*</span></th>
                <td><select name="gender" class="required"><?=combo::get_gender_options(set_value('gender'))?></select><?=form_error('gender','<span>','</span>')?></td>
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
                <td><input type='text' name='date_of_birth' value='<?=set_value('date_of_birth')?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('date_of_birth','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Present Address <span class='req_mark'>*</span></th>
                <td><textarea name="present_address" rows="5" cols="40" class="ui-widget-content ui-corner-all required"><?=set_value('present_address')?></textarea><?=form_error('present_address','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Permanent Address</th>
                <td><textarea name="permanent_address" rows="5" cols="40" class="ui-widget-content ui-corner-all"><?=set_value('permanent_address')?></textarea><?=form_error('permanent_address','<span class="block">','</span>')?></td>
            </tr>

            <tr>
                <th>Nationality <span class='req_mark'>*</span></th>
                <td><select name="nationality" class="required"><?=combo::get_country_list(set_value('nationality'))?></select><?=form_error('nationality','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Marital Status <span class='req_mark'>*</span></th>
                <td><select name="marital_status" class="required"><?=combo::get_marital_status(set_value('marital_status'))?></select><?=form_error('marital_status','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Telephone</th>
                <td><input type='text' name='telephone' value='<?=set_value('telephone')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('telephone','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Mobile</th>
                <td><input type='text' name='mobile' value='<?=set_value('mobile')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('mobile','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='email' value='<?=set_value('email')?>' class='text ui-widget-content ui-corner-all required email width_200' /><?=form_error('email','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Registration</h3>
        <table>
            <tr>
                <th>Branch: <span class='req_mark'>*</span></th>
                <td><select name="branch_id" class="required"><?=common::get_branch_options(set_value('branch_id'))?></select><?=form_error('branch_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Designation <span class='req_mark'>*</span></th>
                <td><select name='designation_id' class="required"><?=combo::get_designation_options(set_value('designation_id'))?></select><?=form_error('designation_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Department <span class='req_mark'>*</span></th>
                <td><select name="department_id" class="required"><?=$this->mod_staffs->get_department_options(set_value('department_id'))?></select><?=form_error('department_id','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>MPO Listed <span class='req_mark'>*</span></th>
                <td><select name="mpo_listed" class="required">
                        <option value="0" selected>No</option>
                        <option value="1" >Yes</option>
                    </select>
                    <?=form_error('mpo_listed','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Staff Status <span class='req_mark'>*</span></th>
                <td><select name="staff_status" class="required"><?=combo::get_student_status(set_value('staff_status'))?></select><?=form_error('staff_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status Change date</th>
                <td><input type='text' name='status_change_date' value='<?=set_value('status_change_date')?>' class='text ui-widget-content ui-corner-all width_160 date_picker' /><?=form_error('status_change_date','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    
    <div class='form_content'>
        <h3>Qualification Information</h3>
        <table width="100%">
            <tr><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
            <?php for($inc=0;$inc<5;$inc++) { ?>
            <tr>
                <td><input type="text" name="qualifications[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("qualifications[$inc]"); ?>" /></td>
                <td><input type="text" name="awarding_body[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("awarding_body[$inc]")?>" /></td>
                <td><input type="text" name="year[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("year[$inc]")?>" /></td>
                <td><input type="text" name="grade[]" class="text ui-widget-content ui-corner-all width_150" value="<?=set_value("grade[$inc]")?>" /></td>
            </tr>
                <?php }  ?>
            <tr>
                <th>IELTS Score</th>
                <td colspan="3"><input type='text' name='ielts_score' value='<?=set_value('ielts_score')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('ielts_score','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Training</th>
                <td>
                    <select name="training_id[]" multiple>
                        <?=combo::get_training_options(set_value('training_id'))?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Qualification Verification</th>
                <td colspan="3"><input type='text' name='qualification_verification' value='<?=set_value('qualification_verification')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('qualification_verification','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    
    <div class='form_content'>
        <h3>Work Experience</h3>
        <table>
            <?php
            for($inc=0;$inc<3;$inc++) { ?>
            <tr>
                <th>Duration</th>
                <td>From &nbsp;<input type="text" name="duration_from[]" class="text ui-widget-content ui-corner-all width_150" value="" /> &nbsp;To &nbsp;<input type="text" name="duration_to[]" class="text ui-widget-content ui-corner-all width_150" value="<?=$qua[$inc]['duration_to']?>" /></td>
            </tr>
            <tr>
                <th>Position</th>
                <td><input type="text" name="position[]" class="text ui-widget-content ui-corner-all width_200" value="" /></td>
            </tr>
            <tr>
                <th>Employer (Name & Address)</th>
                <td><textarea name="employer_details[]" rows="5" cols="40" class="text ui-widget-content ui-corner-all"></textarea></td>
            </tr>
            <tr>
                <th>Responsibilities</th>
                <td><input type="text" name="responsibilities[]" class="text ui-widget-content ui-corner-all width_200" value="" /></td>
            </tr>
            <tr><td colspan="2"><hr /></td></tr>
                <?php }  ?>
        </table>
    </div>
    
    <div class='form_content'>
        <h3>Documents Information</h3>
        <table>
            <tr><th>Photograph </th><td><input type="file" name="photograph" /><span style="color:blue;" class='b'>NOTE:Valid File(jpg,gif,png)</span></td></tr>
            <tr><th>Documents</th><td><input type="file" name="documents" /><span style="color:blue;" class='b'>NOTE:Valid File(doc, docx, pdf, txt, jpg, gif, png, zip)</span></td></tr>
            <tr>
                <th>Comments</th>
                <td><textarea name='comments' rows='5' cols='40' class="ui-widget-content ui-corner-all"><?=set_value('comments')?></textarea><?=form_error('comments','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class="txt_center">
        <input type='submit' name='continue' value='Continue to Contract' class='button' />
        <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>
