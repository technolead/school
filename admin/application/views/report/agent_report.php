<div class='form_content'>
    <h3><?=$page_title?></h3>
	<?php if($msg!=''){echo '<div class="error">'.$msg.'</div>';}?>
	<form action='<?=site_url('report/agent_report')?>' method='post'>
		<table>
			<tr>
				<th>Agent ID <span class='required'>*</span></th>
				<td><input type="text" name="user_name" class="jagent_username" autocomplete="off" value="<?=set_value('user_name')?>" /><div class="juas_list"></div><?=form_error('user_name','<span>','</span>')?></td>
			</tr>
			<tr>
				<th>Programs <span class='required'>*</span></th>
				<td><select name="programs_id" class="input_txt jprograms_id"><?=combo::get_programs_options(set_value('programs_id'))?></select><?=form_error('programs_id','<span>','</span>')?></td>
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
		<div class="left b">Agent Payment Report</div>
		<div class="clear"></div>
	</div>
	<table cellspacing="1" cellpadding="1">
		<tr class='title'>
			<th>Student Name</th>
			<th>Student ID</th>
			<th>Program Code</th>
			<th>Level Name</th>
			<th>Student Status</th>
			<th>Agent Amount</th>
			<th>Due Amount</th>
			<th>Paid Amount</th>
		</tr>
		<?php
			$inc=1;
			foreach($rows as $row):?>
				<tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
					<td><?=$row['student_name']?></td>
					<td><?=$row['user_name']?></td>
					<td><?=$row['program_code']?></td>
					<td><?=$row['level_name']?></td>
					<td><?=$row['student_status']?></td>
					<th><?=$row['agent_amount']?></th>
					<th><?=$row['agent_amount']-$this->mod_agents->get_paid_amount($row['payments_id'])?></th>
					<th><?=$this->mod_agents->get_paid_amount($row['payments_id'])?></th>
				</tr>
			<?php $inc++; endforeach;?>
	</table>
</div>
<?php }?>