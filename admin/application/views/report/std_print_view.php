<div class='form_content'>
	<h3>Basic Information</h3>
		<table cellspacing='0' cellpadding='0'>
			<tr><th>Title </th><td><?=$title?></td></tr>
			<tr><th>Gender </th><td><?=$gender?></td></tr>
			<tr><th>First Name </th><td><?=$first_name?></td></tr>
			<tr><th>Last Name </th><td><?=$last_name?></td></tr>
			<tr><th>Date of Birth</th><td><?=$date_of_birth?></td></tr>
			<tr><th>Present Address </th><td><?=$present_address?></td></tr>
			<tr><th>Permanent Address</th><td><?=$permanent_address?></td></tr>
                        <tr><th>Nationality </th><td><?=$nationality?></td></tr>
                        <tr><th>Marital Status </th><td><?=$marital_status?></td></tr>
			<tr><th>Telephone</th><td><?=$phone?></td></tr>
			
			<tr><th>Mobile</th><td><?=$mobile?></td></tr>
			<tr><th>Email </th><td><?=$email?></td></tr>
		</table>
	</div>
	<div class='form_content'>
	<h3>Registration</h3>
		<table cellspacing='0' cellpadding='0'>
			<tr><th>Admission Date </th><td><?=$admission_date?></td></tr>
			
			<tr><th>Student Status </th><td><?=$student_status?></td></tr>
			<tr><th>Status Change Date </th><td><?=$std_status_date?></td></tr>
			
		</table>
	</div>
	
	
	
	<div class='form_content'>
	<h3>Qualification Information</h3>
		<table class='txt_center' cellspacing='0' cellpadding='0'>
			<tr class="title"><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
			<?php $qua=sql::rows('std_qualifications',"student_id=$student_id order by std_qualifications_id");
			for($inc=0;$inc<5;$inc++){ ?>
			<tr>
				<td><?=$qua[$inc]['qualification']?></td>
				<td><?=$qua[$inc]['awarding_body']?></td>
				<td><?=$qua[$inc]['year']?></td>
				<td><?=$qua[$inc]['grade']?></td>
			</tr>
			<?php }  ?>
			
		</table>
	</div>
	<div class='form_content'>
	<h3>Documents Information</h3>
		<?php $doc=explode(',',$doc_submitted)?>
		<table cellspacing='0' cellpadding='0'>
			<?php if($doc[0]==1){?>
			<tr>
				<th><input type="checkbox" checked /></th>
				<td><a href="<?=base_url()?>uploads/photograph/<?=$photograph?>" target="_blank">Photograph</a></td>
			</tr>
			<?php }?>
			
			<?php if($doc[2]==2){?>
			<tr>
				<th><input type="checkbox" name="document_submitted[]" value="3" <?php if($doc[2]==3){echo 'checked';}?> /></th>
				<td><a href="<?=base_url()?>uploads/cirtificates/<?=$doc_certificates?>" target="_blank">Copy Of Certificates</a></td>
			</tr>
			<?php }?>
			
			<tr>
				<th>Documents Required:</th>
				<td><?=$doc_required?></td>
			</tr>
			<tr>
				<th>Comments</th>
				<td colspan="3"><?=$comments?></td>
			</tr>
		</table>
	 </div>