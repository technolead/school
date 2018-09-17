<div class='form_content'>
	<h3><?=$page_title?></h3>
	<form action='<?=site_url('modules/new_module_map')?>' method='post'>
		<table>
			<?php if(validation_errors()!=''){ echo "<tr><td colspan='2' class='error'>".validation_errors()."</td></tr>";}?>
			<tr>
				<th>Programs <span class='required'>*</span></th>
				<td><select name="programs_id" class="input_txt jprograms_id"><?=combo::get_programs_options(set_value('programs_id'))?></select></td>
			</tr>
			<tr>
				<th>Levels <span class='required'>*</span></th>
				<td><select name="levels_id" class="jlevels_list input_txt"><?=combo::get_levels_options(set_value('programs_id'),set_value('levels_id'))?></select></td>
			</tr>
			<tr>
				<th>Module <span class='required'>*</span></th>
				<td><select name='module_id[]' multiple size='15' class='input_txt'><?=combo::get_modules_options(set_value('module_id'))?></select></td>
			</tr>
			<tr>
				<th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
			</tr>
		</table>
	</form>
</div>