<div class='form_content'><form action='<?=site_url('books/library_fines')?>' method='post'>
	<h3><?=$page_title?></h3>
	<table>
		<tr>
			<th>User Type <span class='required'>*</span></th>
			<td><select name='user_type'><?=$this->mod_books->get_user_type_options(set_value('user_type'))?></select><?=form_error('user_type','<span>','</span>')?></td>
		</tr>
		<tr>
			<th>Days Permitted <span class='required'>*</span></th>
			<td><select name='days_permitted'><?=$this->mod_books->get_per_days_options(set_value('days_permitted'))?></select><?=form_error('days_permitted','<span>','</span>')?></td>
		</tr>
		<tr>
			<th>Fine per Day <span class='required'>*</span></th>
			<td><input type="text" name="fine_per_day"  value="<?=set_value('fine_per_day')?>" class="width_160" /><?=form_error('fine_per_day','<span>','</span>')?></td>
		</tr>
		<tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
		</tr>
	</table>
	</form>
</div>

<?php if($msg!=""){echo "<div class='success'>$msg</div>";}?>
<div class='table_content'>
	<table>
		<tr class='title'>
			<th>User Type</th>
			<th>Days Permitted</th>
			<th>Fine Per Day</th>
			<th>Inputed By</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
		<?php if(count($rows)>0){
			$inc=1;
			foreach($rows as $row):?>
				<tr <?php if($inc%2==0){echo "class='even txt_center'";}else{echo "class='odd txt_center'";}?>>
					<td><?=$row['user_type']?></td>
					<td><?=$row['days_permitted'].' DAY'?></td>
					<td><?=$row['fine_per_day']?></td>
					<td><?=$row['user_name']?></td>
					<td><?=$row['date']?></td>
					<td class='view_links'>
						<a href='<?=site_url('books/edit_library_fine/'.$row['fine_id'])?>' class="edit_link" title="Change"></a>
						<a href='<?=site_url('books/delete_library_fine/'.$row['fine_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
					</td>
				</tr>
			<?php $inc++; endforeach;
		}else{
				echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
		}  ?>
	</table>
</div>