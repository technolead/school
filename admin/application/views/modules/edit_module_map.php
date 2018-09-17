<div class='form_content'>
	<h3><?=$page_title?></h3>
	<form action='<?=site_url('modules/edit_module_map/'.$module_map_id)?>' method='post'>
		<table>
			<?php if(validation_errors()!=''){ echo "<tr><td colspan='2' class='error'>".validation_errors()."</td></tr>";}?>
			<tr>
				<th>Class <span class='required'>*</span></th>
				<td><select name="class_id" class="input_txt jprograms_id"><?=combo::get_class_options($class_id)?></select></td>
			</tr>
			
			<tr>
				<th>Subject <span class='required'>*</span></th>
				<td><select name='module_id' class='input_txt'><?=combo::get_modules_options($module_id)?></select></td>
			</tr>
			<tr>
				<th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
			</tr>
		</table>
	</form>
</div>