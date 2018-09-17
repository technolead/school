<div class='form_content'>
    <h3><?=$page_title?></h3>
	<?php if($msg!=''){echo '<div class="error">'.$msg.'</div>';}?>
	<form action='<?=site_url('report/staff_due')?>' method='post'>
		<table>
			<tr>
				<th>Branch <span class='required'>*</span></th>
				<td><select name="branch_id" class="input_txt jbranch_list"><?=combo::get_branch_options($this->session->userdata('institution_id'),set_value('branch_id'))?></select><?=form_error('branch_id','<span>','</span>')?></td>
			</tr>
			<tr>
				<th>Department</th>
				<td><select name="department_id" class="input_txt"><?=$this->mod_staffs->get_department_options(set_value('department_id'))?></select><?=form_error('department_id','<span>','</span>')?></td>
			</tr>
			<tr>
				<th>Staff Status</th>
				<td><select name="staff_status" class="input_txt"><?=combo::get_status_options('STAFFS_STATUS',set_value('staff_status'))?></select><?=form_error('staff_status','<span>','</span>')?></td>
			</tr>
			<tr>
				<th>Date</th>
				<td><input type="text" name="from_date" value="<?=set_value('from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date',date('Y-m-d'))?>" class="date_picker width_80" /></td>
			</tr>
			<tr><th>&nbsp;</th>
				<td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
			</tr>
		</table>
	</form>
</div>
<?php if(count($rows)>0){?>
<div class='table_content'>
	 <div class="pagination_links">
		<div class="left b"><?=$page_title?></div>
		<div class="clear"></div>
	</div>
<table cellspacing='1' cellpadding='1'>
		<tr class="title">
			<th>Staff ID</th>
			<th>Staff Name</th>
			<th>Department</th>
			<th>Paid Date</th>
			<th>Month/Year</th>
			<th>Paid Amount</th>
			<th>Due</th>
		</tr>
		<?php if(count($rows)>0){
			foreach($rows as $row): ?>
			<tr <?php if($inc%2==0){echo "class='even txt_center'";}else{echo "class='odd txt_center'";}?>>
				<td><?=$row['user_name']?></td>
				<td><?=$row['staff_name']?></td>
				<td><?=$row['name']?></td>
				<td><?=$row['paid_date']?></td>
				<td><?=$row['month'].'/'.$row['year']?></td>
				<td><?=$row['paid_amount']?></td>
				<td><?=$row['due']?></td>
			</tr>
		<?php endforeach;
		}else{
			echo '<tr><td colspan="6">No Record Found!</td></tr>';
		}?>
	</table>
	</div>
<?php }?>