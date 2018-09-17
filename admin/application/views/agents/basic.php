<form id="valid_form" action='<?=site_url('agents/new_agent/basic')?>' method='post'>
    <div class='form_content'>
        <h3>Contact Person</h3>
        <table>
             <tr>
                <th>Agent ID <span class='req_mark'>*</span></th>
                <td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class='text ui-widget-content required ui-corner-all width_200' /><?=form_error('user_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Title <span class='req_mark'>*</span></th>
                <td><input type="text" name="title" value="<?=set_value('title')?>" class='text ui-widget-content ui-corner-all width_200' /><?=form_error('title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Gender <span class='req_mark'>*</span></th>
                <td><select name="gender" class="class='ui-widget-content ui-corner-all required'"><?=combo::get_gender_options(set_value('gender'))?></select><?=form_error('gender','<span>','</span>')?></td>
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
                <th>Date Of Birth <span class='req_mark'>*</span></th>
                <td><input type='text' name='date_of_birth' value='<?=set_value('date_of_birth')?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('date_of_birth','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Nationality <span class='req_mark'>*</span></th>
                <td><select name="nationality" class="ui-widget-content ui-corner-all required"><?=combo::get_country_list(set_value('nationality'))?></select><?=form_error('nationality','<span>','</span>')?></td>
            </tr>
        </table>
    </div>
    <div class='form_content'>
        <h3>Agent Information</h3>
        <table>
             <tr>
                <th>Admission Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='admission_date' value='<?=set_value('admission_date')?>' class='text ui-widget-content ui-corner-all required date_picker' /><?=form_error('admission_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Agent Type <span class='req_mark'>*</span></th>
                <td><select name="agent_type" class="ui-widget-content required ui-corner-all"><?=combo::get_type_options('AGENTS_TYPE',set_value('agent_type'))?></select><?=form_error('agent_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Agent Status <span class='req_mark'>*</span></th>
                <td><select name="agent_status" class="ui-widget-content required ui-corner-all"><?=combo::get_status_options('AGENTS_STATUS',set_value('agent_status'))?></select><?=form_error('agent_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td><input type='text' name='status_change' value='<?=set_value('status_change')?>' class='text ui-widget-content ui-corner-all date_picker' /><?=form_error('status_change','<span>','</span>')?></td>
            </tr>
             
        </table>
    </div>
    <div class='form_content'>
        <h3>Address</h3>
        <table>
            <tr>
                <th>Company Name</th>
                <td><input type='text' name='company_name' value='<?=set_value('company_name')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('company_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><textarea name="address_1" rows="5" cols="40" class="ui-widget-content ui-corner-all"><?=set_value('address_1')?></textarea><?=form_error('address_1','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td><input type='text' name='telephone_1' value='<?=set_value('telephone_1')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('telephone_1','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type='text' name='mobile_1' value='<?=set_value('mobile_1')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('mobile_1','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Fax</th>
                <td><input type='text' name='fax' value='<?=set_value('fax')?>' class='text ui-widget-content ui-corner-all width_200' /><?=form_error('fax','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='email' value='<?=set_value('email')?>' class='text ui-widget-content ui-corner-all required email width_200' /><?=form_error('email','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Comments</th>
                <td><textarea name="comments" class="ui-widget-content ui-corner-all" rows="5" cols="40" style="padding:0.4em;"><?=set_value('comments')?></textarea><?=form_error('comments','<span class="block">','</span>')?></td>
            </tr>
        </table>
    </div>
    
    <div class="txt_center">
        <input type='submit' name='continue' value='Continue to Contact' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
    </div>
</form>