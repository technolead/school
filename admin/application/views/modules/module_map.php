<?php if($msg!=""){echo "<div class='success'>$msg</div>";}?>
<div class='table_content'>
	<div class="pagination_links">
		<div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Mappings</div><div class="right"><?=$prev_next?></div>
		<div class="clear"></div>
	</div>
	<table>
		<tr class='title'>
			<th>Class Name</th>
			<th>Subject Code</th>
			<th>Subject Name</th>
			<th>Added By</th>
			<th>Task</th>
		</tr>
		<?php if(count($rows)>0){
			$inc=1;
			foreach($rows as $row):?>
				<tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
					<td><?=$row['class_name']?></td>
					<td><?=$row['module_code']?></td>
					<td><?=$row['module_name']?></td>
					<td><?=$row['first_name'].' '.$row['last_name']?></td>
					<td class='width_200 links'>
					<?php if(common::user_permit('update','module')){?>
						<a href='<?=site_url('modules/module_map_status/'.$row['module_map_id'].'/'.$row['status'])?>'><?=common::status($row['status'])?></a>
						<a href='<?=site_url('modules/edit_module_map/'.$row['module_map_id'])?>'>Edit</a>
						<a href='<?=site_url('modules/delete_module_map/'.$row['module_map_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");'>Delete</a>
					<?php }?>
					</td>
				</tr>
			<?php $inc++; endforeach;
		}else{
				echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
		}  ?>
	</table>
	<div class="pagination_links">
		<div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Modules Mapping</div><div class="right"><?=$prev_next?></div>
		<div class="clear"></div>
	</div>
</div>