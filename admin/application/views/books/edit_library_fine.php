<div class='form_content'><form action='<?=site_url('books/edit_library_fine/'.$fine_id)?>' method='post'>
	<h3><?=$page_title?></h3>
	<table>
		<tr>
			<th>User Type <span class='required'>*</span></th>
			<td><select name='user_type'><?=$this->mod_books->get_user_type_options($user_type)?></select><?=form_error('user_type','<span>','</span>')?></td>
		</tr>
		<tr>
			<th>Days Permitted <span class='required'>*</span></th>
			<td><select name='days_permitted'><?=$this->mod_books->get_per_days_options($days_permitted)?></select><?=form_error('days_permitted','<span>','</span>')?></td>
		</tr>
		<tr>
			<th>Fine per Day <span class='required'>*</span></th>
			<td><input type="text" name="fine_per_day"  value="<?=$fine_per_day?>" class="width_160" /><?=form_error('fine_per_day','<span>','</span>')?></td>
		</tr>
		<tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
		</tr>
	</table>
	</form>
</div>