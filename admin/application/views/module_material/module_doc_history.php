<div class=''>
    <?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
    <div class="form_content" style="width:880px;">
            <form action="<?=site_url('module_material/module_doc_history')?>" method="post">
                <table>
                    <tr>
                        <th class="txt_right">Posted Date</th><td><input type='text' name='posted_date' value='<?=set_value('posted_date')?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /></td>
                        <th>Valid Date</th><td width="150"><input type='text' name='valid_until' value='<?=set_value('valid_until')?>' class='text ui-widget-content required ui-corner-all width_80 date_picker' /></td>
                        <th>Staff</th><td><select name="staffs_id" class="text ui-widget-content ui-corner-all width_160"><?=combo::get_staff_options(set_value('staffs_id'))?></select></td>
                    </tr>
                    <tr>
                        <th>Subject</th><td><select name="module_id" class="text ui-widget-content ui-corner-all width_160"><option value="">Select Subject</option><?=combo::get_modules_options(set_value('module_id'))?></select></td>
                        <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                    </tr>
                </table>
            </form>
        </div>
    <div class='table_content'>
        <div class="pagination_links">
            <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Module Notes</div><div class="right"><?=$prev_next?></div>
            <div class="clear"></div>
        </div>
        <table cellpadding="1" cellspacing="1">
            <tr class="title">
                <th>Staff Name</th>
                <th>Staff ID</th>
                <th>Subject Name</th>
                <th>Subject Notes</th>
                <th>Lecture File</th>
                <th>Posted Date</th>
                <th>Valid Until</th>
                <th>Action</th>
            </tr>
            <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
            <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
                <td><?=$row['staff_name']?></td>
                <td><?=$row['user_name']?></td>
                <td><?=$row['module_name']?></td>
                <td><?=word_limiter(strip_tags($row['lecture_notes']),10)?></td>
                <td><a href='<?=base_url().'uploads/materials/'.$row[lecture_file]?>' target='_blank'><?=$row['file_name']?></a></td>
                <td><?=$row['posted_date']?></td>
                <td><?=$row['valid_until']?></td>
                <td class='view_links'>
                    <a href='<?=site_url('module_material/material_status/'.$row['module_material_id'].'/'.$row['status'])?>' class="<?=$row['status']?>" title="<?=common::status($row['status'])?>"></a>
                    <a href='<?=site_url('module_material/edit_doc_history/'.$row['module_material_id'])?>' class="edit_link" title="Change"></a>
                    <a href='<?=site_url('module_material/delete_material/'.$row['module_material_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                </td>
            </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
        </table>
        <div class="pagination_links">
            <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Module Notes</div><div class="right"><?=$prev_next?></div>
            <div class="clear"></div>
        </div>
    </div>
</div>