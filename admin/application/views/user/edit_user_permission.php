<?php if($msg!=""){echo "<div class='success message'>$msg</div>";}?>
<form action='<?=site_url('user/edit_user/'.$user_id.'/edit_user_permission')?>' method='post'>
	<table cellspacing='1' cellpadding='2' width='100%'>
	<tr>
            <th>Configuration Menu Permission</th>
            <td>
                
                <span class='block b'>Student Attendance Alert</span>
                <label class='block'><input type='checkbox' name='alert[]' value='2' <?php if(common::user_permit('add','alert',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <span class='block b'>Staff Alert</span>
                <label class='block'><input type='checkbox' name='alert[]' value='4' <?php if(common::user_permit('delete','alert',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
            </td>
            <td>
                <span class='block b'>Configuration</span>
                <label class='block'><input type='checkbox' name='ts_config[]' value='1' <?php if(common::user_permit('view','ts_config',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='ts_config[]' value='2' <?php if(common::user_permit('add','ts_config',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='ts_config[]' value='4' <?php if(common::user_permit('delete','ts_config',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            <td>
                <span class='block b'>Class</span>
                <label class='block'><input type='checkbox' name='class[]' value='1' <?php if(common::user_permit('view','class',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='class[]' value='2' <?php if(common::user_permit('add','class',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='class[]' value='4' <?php if(common::user_permit('delete','class',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>

             
	</tr>
        <tr>
            <th>&nbsp;</th>
            <td>
                <span class='block b'>Branch</span>
                <label class='block'><input type='checkbox' name='branch[]' value='1' <?php if(common::user_permit('view','branch',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='branch[]' value='2' <?php if(common::user_permit('add','branch',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='branch[]' value='4' <?php if(common::user_permit('delete','branch',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
             <td>
                <span class='block b'>Grade</span>
                <label class='block'><input type='checkbox' name='grade[]' value='1' <?php if(common::user_permit('view','grade',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='grade[]' value='2' <?php if(common::user_permit('add','grade',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='grade[]' value='4' <?php if(common::user_permit('delete','grade',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
             <td>
                <span class='block b'>Marking</span>
                <label class='block'><input type='checkbox' name='marking[]' value='1' <?php if(common::user_permit('view','marking',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='marking[]' value='2' <?php if(common::user_permit('add','marking',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='marking[]' value='4' <?php if(common::user_permit('delete','marking',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
        </tr>
	<tr>
            <th>&nbsp;</th>
            <td>
                <span class='block b'>Module</span>
                <label class='block'><input type='checkbox' name='module[]' value='1' <?php if(common::user_permit('view','module',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='module[]' value='2' <?php if(common::user_permit('add','module',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='module[]' value='4' <?php if(common::user_permit('delete','module',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            
            <td>
                <span class='block b'>Session</span>
                <label class='block'><input type='checkbox' name='session[]' value='1' <?php if(common::user_permit('view','session',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='session[]' value='2' <?php if(common::user_permit('add','session',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='session[]' value='4' <?php if(common::user_permit('delete','session',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
	</tr>
	<tr>
            <th>Student Menu Permission</th>
            <td>
                <span class='block b'>Student</span>
                <label class='block'><input type='checkbox' name='student[]' value='1' <?php if(common::user_permit('view','student',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='student[]' value='2' <?php if(common::user_permit('add','student',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='student[]' value='4' <?php if(common::user_permit('delete','student',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
             <td>
                <span class='block b'>View Attendance</span>
                <label class='block'><input type='checkbox' name='arv_attd[]' value='1' <?php if(common::user_permit('view','arv_attd',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <span class='block b'>Record Attendance</span>
                <label class='block'><input type='checkbox' name='arv_attd[]' value='2' <?php if(common::user_permit('add','arv_attd',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <span class='block b'>View Register</span>
                <label class='block'><input type='checkbox' name='arv_attd[]' value='4' <?php if(common::user_permit('delete','arv_attd',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
            </td>
             <td>
                <span class='block b'>Print Attendance</span>
                <label class='block'><input type='checkbox' name='print_attd[]' value='1' <?php if(common::user_permit('view','print_attd',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='print_attd[]' value='2' <?php if(common::user_permit('add','print_attd',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='print_attd[]' value='4' <?php if(common::user_permit('delete','print_attd',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
	</tr>
        <tr>
            <th>&nbsp;</th>
             <td>
                <span class='block b'>Student Attendance</span>
                <label class='block'><input type='checkbox' name='std_attendance[]' value='1' <?php if(common::user_permit('view','std_attendance',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='std_attendance[]' value='2' <?php if(common::user_permit('add','std_attendance',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='std_attendance[]' value='4' <?php if(common::user_permit('delete','std_attendance',$permit['user_id'])){echo 'checked';}?> /> View/Delete</label>
            </td>
            <td>
                <span class='block b'>Exemption</span>
                <label class='block'><input type='checkbox' name='exemption[]' value='1' <?php if(common::user_permit('view','exemption',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='exemption[]' value='2' <?php if(common::user_permit('add','exemption',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='exemption[]' value='4' <?php if(common::user_permit('delete','exemption',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            <td>
                <span class='block b'>Result</span>
                <label class='block'><input type='checkbox' name='result[]' value='1' <?php if(common::user_permit('view','result',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='result[]' value='2' <?php if(common::user_permit('add','result',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='result[]' value='4' <?php if(common::user_permit('delete','result',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
	</tr>

        <tr>
            <th>&nbsp;</th>
            <td colspan="3">
                <span class='block b'>Progress Report</span>
                <label class='block'><input type='checkbox' name='progress_rep[]' value='1' <?php if(common::user_permit('view','progress_rep',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='progress_rep[]' value='2' <?php if(common::user_permit('add','progress_rep',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='progress_rep[]' value='4' <?php if(common::user_permit('delete','progress_rep',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
        </tr>
        <tr>
            <th>Fees</th>
            <td>
                <span class='block b'>Admission Fee</span>
                <label class='block'><input type='checkbox' name='admission_fee[]' value='1' <?php if(common::user_permit('view','admission_fee',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='admission_fee[]' value='2' <?php if(common::user_permit('add','admission_fee',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='admission_fee[]' value='4' <?php if(common::user_permit('delete','admission_fee',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            <td>
                <span class='block b'>Class/Monthly Fee</span>
                <label class='block'><input type='checkbox' name='class_fee[]' value='1' <?php if(common::user_permit('view','class_fee',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='class_fee[]' value='2' <?php if(common::user_permit('add','class_fee',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='class_fee[]' value='4' <?php if(common::user_permit('delete','class_fee',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
             <td>
                <span class='block b'>Exam Fee</span>
                <label class='block'><input type='checkbox' name='exam_fee[]' value='1' <?php if(common::user_permit('view','exam_fee',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='exam_fee[]' value='2' <?php if(common::user_permit('add','exam_fee',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='exam_fee[]' value='4' <?php if(common::user_permit('delete','exam_fee',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>

            
	</tr>

        <tr>
            <th>&nbsp;</th>
            <td>
                <span class='block b'>Additional Fee</span>
                <label class='block'><input type='checkbox' name='additional_fee[]' value='1' <?php if(common::user_permit('view','additional_fee',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='additional_fee[]' value='2' <?php if(common::user_permit('add','additional_fee',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='additional_fee[]' value='4' <?php if(common::user_permit('delete','additional_fee',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
        </tr>

        
	<tr>
            <th>Staffs Menu Permission</th>
            <td>
                <span class='block b'>Staffs</span>
                <label class='block'><input type='checkbox' name='staffs[]' value='1' <?php if(common::user_permit('view','staffs',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='staffs[]' value='2' <?php if(common::user_permit('add','staffs',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='staffs[]' value='4' <?php if(common::user_permit('delete','staffs',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            
	</tr>
        <tr>
            <th>Letters &amp; Library</th>
            <td>
                <span class='block b'>Letters</span>
                <label class='block'><input type='checkbox' name='letters[]' value='1' <?php if(common::user_permit('view','letters',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='letters[]' value='2' <?php if(common::user_permit('add','letters',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='letters[]' value='4' <?php if(common::user_permit('delete','letters',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
            <td>
                <span class='block b'>Library</span>
                <label class='block'><input type='checkbox' name='library[]' value='1' <?php if(common::user_permit('view','library',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='library[]' value='2' <?php if(common::user_permit('add','library',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='library[]' value='4' <?php if(common::user_permit('delete','library',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
             <td>
                <span class='block b'>Upload History</span>
                <label class='block'><input type='checkbox' name='up_history[]' value='1' <?php if(common::user_permit('view','up_history',$permit['user_id'])){echo 'checked';}?> /> Only View</label>
                <label class='block'><input type='checkbox' name='up_history[]' value='2' <?php if(common::user_permit('add','up_history',$permit['user_id'])){echo 'checked';}?> /> Add/Update</label>
                <label class='block'><input type='checkbox' name='up_history[]' value='4' <?php if(common::user_permit('delete','up_history',$permit['user_id'])){echo 'checked';}?> /> Delete</label>
            </td>
	</tr>
        <tr>
            <th>Report Permission</th>
            
            <td>
                <span class='block b'>Students Report</span>
                <label class='block'><input type='checkbox' name='std_report[]' value='1' <?php if(common::user_permit('view','std_report',$permit['user_id'])){echo 'checked';}?> /> View Permission</label>
                <span class='block b'>Attendance Report</span>
                <label class='block'><input type='checkbox' name='std_attd_rep[]' value='1' <?php if(common::user_permit('view','std_attd_rep',$permit['user_id'])){echo 'checked';}?> /> View Permission</label>
            </td>
            <td>
                <span class='block b'>Letter Report</span>
                <label class='block'><input type='checkbox' name='letter_rep[]' value='1' <?php if(common::user_permit('view','letter_rep',$permit['user_id'])){echo 'checked';}?> /> View Permission</label>
                <span class='block b'>Library Report</span>
                <label class='block'><input type='checkbox' name='library_rep[]' value='1' <?php if(common::user_permit('view','library_rep',$permit['user_id'])){echo 'checked';}?> /> View Permission</label>
            </td>
            <td>
                <span class='block b'>Staffs Report</span>
                <label class='block'><input type='checkbox' name='staff_report[]' value='1' <?php if(common::user_permit('view','staff_report',$permit['user_id'])){echo 'checked';}?> /> View Permission</label>
                
            </td>
	</tr>
	</table>
    <hr />
	<div class="txt_center"><input type='submit' name='update_permit' value='Finish' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></div>
</form>