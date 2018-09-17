<style type="text/css">
.form_content{border:1px solid #333;width:750px;margin:0 auto;padding:10px;font-size:9pt;}
.form_content table{border:1px solid #333;}
.form_content table td,.form_content table th{border-bottom:1px solid #333;padding:2px 5px;vertical-align:top;}
.form_content table th{border-right:1px solid #333;width:200px;text-align:left;}
.form_content legend{font-size:11pt;font-weight:bold;}
</style>
<div class='form_content'>
	<fieldset><legend>Personal Information</legend>
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr><th>Title</th><td><?=$title?>&nbsp;</td></tr>
			<tr><th>Gender</th><td><?=$gender?>&nbsp;</td></tr>
			<tr><th>First Name</th><td><?=$first_name?>&nbsp;</td></tr>
			<tr><th>Last Name</th><td><?=$last_name?>&nbsp;</td></tr>
			<tr><th>Date Of Birth</th><td><?=$date_of_birth?>&nbsp;</td></tr>
			<tr><th>Present Address</th><td><?=nl2br($present_address)?>&nbsp;</td></tr>
			<tr><th>Permanent Address</th><td><?=nl2br($permanent_address)?>&nbsp;</td></tr>
			<tr><th>Telephone</th><td><?=nl2br($phone)?>&nbsp;</td></tr>
			<tr><th>Mobile</th><td><?=nl2br($mobile)?>&nbsp;</td></tr>
			<tr><th>Email</th><td><?=$email?>&nbsp;</td></tr>
	</table>
	</fieldset>
	<fieldset><legend>Registration</legend>
	<table cellspacing="0" cellpadding="0" width="100%">
			
			<tr><th>Department</th><td><?=$department_name?>&nbsp;</td></tr>
			<tr><th>Staff Status</th><td><?=$staff_status?>&nbsp;</td></tr>
			<tr><th>Status Change Date</th><td><?=$status_change_date?>&nbsp;</td></tr>
	</table>
	</fieldset>
	
	
	<fieldset><legend>Contract Agreement</legend>
	<table cellspacing="0" cellpadding="0" width="100%">
			<tr><th>Admission Date</th><td><?=$admission_date?>&nbsp;</td></tr>
			<tr><th>Contact Duration</th><td><?=$employ_duration?>&nbsp;</td></tr>
			<tr><th>Start Date</th><td><?=$start_date?>&nbsp;</td></tr>
			<tr><th>End Date</th><td><?=$end_date?>&nbsp;</td></tr>
			<tr><th>Salary/Commission</th><td><?=$amount?>&nbsp;</td></tr>
			<tr><th>Total Days Per Week</th><td><?=$days_per_week?>&nbsp;</td></tr>
			<tr><th>Total Hours Per Week</th><td><?=$hours_per_week?>&nbsp;</td></tr>
			<tr><th>Salary Type</th><td><?=$salary_type?>&nbsp;</td></tr>
			
			<tr><th>NI Number</th><td><?=$ni_number?>&nbsp;</td></tr>
		</table>
	</fieldset>
</div>