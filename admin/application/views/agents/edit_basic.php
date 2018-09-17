<form id="valid_form" action='<?=site_url('agents/edit_agent/'.$agents_id.'/edit_basic')?>' method='post'>
    <div class='form_content'>
        <h3>Main Contact Person</h3>
        <table>
             <tr>
                <th>Agent ID <span class='req_mark'>*</span></th>
                <td><input type="text" name="user_name" value="<?=set_value('user_name',$user_name)?>" class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('user_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><input type="text" name="title" value="<?=$title?>" class="text ui-widget-content ui-corner-all" /><?=form_error('title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Gender <span class='req_mark'>*</span></th>
                <td><select name="gender" class="required"><?=combo::get_gender_options($gender)?></select><?=form_error('gender','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>First Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='first_name' value='<?=$first_name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('first_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Last Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='last_name' value='<?=$last_name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('last_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Date Of Birth <span class='req_mark'>*</span></th>
                <td><input type='text' name='date_of_birth' value='<?=$date_of_birth?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('date_of_birth','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Nationality <span class='req_mark'>*</span></th>
                <td><select name="nationality" class="required"><?=combo::get_country_list($nationality)?></select><?=form_error('nationality','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Agent Information</h3>
        <table>
            <tr>
                <th>Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=set_value('admission_date',$admission_date)?>' class='text ui-widget-content ui-corner-all required date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Agent Type <span class='req_mark'>*</span></th>
                <td><select name="agent_type" class="required"><?=combo::get_type_options('AGENTS_TYPE',$agent_type)?></select><?=form_error('agent_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Agent Status <span class='req_mark'>*</span></th>
                <td><select name="agent_status" class="required"><?=combo::get_status_options('AGENTS_STATUS',$agent_status)?></select><?=form_error('agent_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td><input type='text' name='status_change' value='<?=$status_change?>' class='input_txt width_160 date_picker' /><?=form_error('status_change','<span>','</span>')?></td>
            </tr>
            
        </table>
    </div>
    <div class='form_content'>
        <h3>Company Information</h3>
        <table>
            <tr>
                <th>Company Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='company_name' value='<?=$company_name?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('company_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><textarea name="address_1" rows="5" cols="40" class="ui-widget-content ui-corner-all"><?=$address_1?></textarea><?=form_error('address_1','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td><input type='text' name='telephone_1' value='<?=$telephone_1?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('telephone_1','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type='text' name='mobile_1' value='<?=$mobile_1?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('mobile_1','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Fax</th>
                <td><input type='text' name='fax' value='<?=$fax?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('fax','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='email' value='<?=$email?>' class='text ui-widget-content ui-corner-all email required width_200' /><?=form_error('email','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Comments</th>
                <td><textarea name="comments" class="ui-widget-content ui-corner-all" rows="5" cols="40" style="padding:0.4em;"><?=set_value('comments',$comments)?></textarea><?=form_error('comments','<span class="block">','</span>')?></td>
            </tr>
        </table>
    </div>
    
    <div class="txt_center">
        <input type='submit' name='update' value='Update' class='button' /> <input type='submit' name='continue' value='Continue to Contact' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>