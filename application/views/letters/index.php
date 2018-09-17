<div class='table_content'>
<h3><?=$page_title?></h3>
	<table>
		<tr class='title'>
			<th>From Name</th>
			<th>Issue Date</th>
			<th>Letter Title</th>
			<th>Description</th>
		</tr>
		<?php if(count($letters)>0){
			$inc=1;
			foreach($letters as $row): ?>
		<tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
			<td><?=$row['first_name'].' '.$row['last_name']?></td>
			<td><?=$row['issue_date']?></td>
			<td><a href="<?=site_url('letters/details/'.$row['student_letters_id'])?>" title="<?=$row['letter_title']?>" style="color:#0202F5"><?=$row['letter_title']?></a></td>
			<td><?=word_limiter(strip_tags($row['des']),10)?></td>
		</tr>
		<?php  $inc++; endforeach;
	}else{
		echo "<tr><td colspan='3'>No Letters Found!!!</td></tr>";
	}?>
	</table>
</div>