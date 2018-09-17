<div class='form_content'>
	<table>
		<tr><th>Program Code</th><td><?=$program_code?></td></tr>
		<tr><th>Program Name</th><td><?=$program_name?></td></tr>
		<tr><th>Specialization</th><td><?=$specialization?></td></tr>
		<tr><th>Awarding Body</th><td><?=$awarding_body?></td></tr>
		<tr><th>Duration</th><td><?=$duration?></td></tr>
		<tr><th>Tuition Fees</th><td><?=$tuition_fees?></td></tr>
		<tr><th>Description</th><td><?=nl2br($des)?></td></tr>
	
	<?php $levels=sql::rows('levels',"programs_id=$programs_id");
		if(count($levels)>0){
		echo '<tr><td colspan="2"><h2>Levels</h2></td></tr>';
		$inc=1;
		foreach($levels as $row):
			?>
			<tr><th>Level Code</th><td><?=$row['level_code']?></td></tr>
			<tr><th>Level Name</th><td><a href="<?=site_url('levels/details/'.$row['levels_id'])?>"><?=$row['level_name']?></a></td></tr>
			<tr><th>Level Duration</th><td><?=$row['level_duration']?></td></tr>
			<tr><th>Tuition Fees</th><td><?=$row['tuition_fees']?></td></tr>
			<tr><td colspan="2">
			<div class="table_content">
				<table>
			<tr class='title'>
				<th>Module Code</th>
				<th>Module Name</th>
				<th>Description</th>
			</tr>
			<?php $rows=$this->mod_programs->get_lavel_modules($row['levels_id']);
			if(count($rows)>0){
				$inc=1;
				foreach($rows as $row):?>
					<tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
						<td><?=$row['module_code']?></td>
						<td><?=$row['module_name']?></td>
						<td><?=$row['des']?></td>
					</tr>
				<?php $inc++; endforeach;
			}else{
					echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
			}  ?>
			</table>
			</div>
			</td></tr>
			<?php
			endforeach; } ?>
	</table>
</div>