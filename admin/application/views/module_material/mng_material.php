<div class=''>
    <?php if($msg!=""){echo "<div class='success'>$msg</div>";}?>
    <div class='table_content'>
        <div class="pagination_links">
		<div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Notes</div><div class="right"><?=$prev_next?></div>
		<div class="clear"></div>
	</div>
        <table cellpadding="1" cellspacing="1">
            <tr class="title">
                <th>Subject Name</th>
                <th>Subject Notes</th>
                <th>Lecture File</th>
                <th>Posted Date</th>
                <th>Valid Until</th>
                <th>Action</th>
            </tr>
            <?php if(count($rows)>0){
                $inc=1;
                foreach($rows as $row):?>
            <tr <?php if($inc%2==0){echo "class='even'";}else{echo "class='odd'";}?>>
                <td><?=$row['module_name']?></td>
                <td><?=word_limiter(strip_tags($row['lecture_notes']),10)?></td>
                <td><a href='<?=base_url().'uploads/materials/'.$row[lecture_file]?>' target='_blank'><?=$row['file_name']?></a></td>
                <td><?=$row['posted_date']?></td>
                <td><?=$row['valid_until']?></td>
				<td class='view_links'>
                    <a href='<?=site_url('module_material/material_status/'.$row['module_material_id'].'/'.$row['status'])?>' class="<?=$row['status']?>" title="<?=common::status($row['status'])?>"></a>
                    <a href='<?=site_url('module_material/edit_material/'.$row['module_material_id'])?>' class="edit_link" title="Change"></a>
                    <a href='<?=site_url('module_material/delete_material/'.$row['module_material_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                </td>
            </tr>
            <?php $inc++; endforeach;
        }else{
            echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
        }  ?>
        </table>
        <div class="pagination_links">
		<div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Module Notes</div><div class="right"><?=$prev_next?></div>
		<div class="clear"></div>
	</div>
    </div>
</div>