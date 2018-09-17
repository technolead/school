<div class='form_content'>
	<h3><?=$page_title?></h3>
	<table>
		<tr>
			<th>Subject </th>
			<td><?=$module_name?></td>
		</tr>
		<tr>
			<th>Lecture Notes </th>
			<td><?=nl2br($lecture_notes)?></td>
		</tr>
		<tr>
			<th>Lecture File</th>
			<td>
				<a href="<?=base_url()?>admin/uploads/materials/<?=$lecture_file?>" target="_blank"><?=$file_name?></a><br />
			</td>
		</tr>
		<tr>
			<th>Posted Date </th>
			<td><?=$posted_date?></td>
		</tr>
		<tr>
			<th>Valid Until </th>
			<td><?=$valid_until?></td>
		</tr>
		<tr>
			<th>Added By </th>
			<td><?=$teacher_name?></td>
		</tr>

	</table>
</div>