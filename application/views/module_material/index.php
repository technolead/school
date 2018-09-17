<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <h3><?=$page_title?></h3>
    <table cellpadding="1" cellspacing="1">
        <tr class="title">
            <th>Subject Name</th>
            <th>Subject Notes</th>
            <th>Lecture File</th>
            <th>Posted Date</th>
            <th>Valid Until</th>
            <th>Added By</th>
        </tr>
        <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><a href="<?=site_url('module_material/details/'.$row['module_material_id'].'/'.url_title($row['module_name']))?>" title="View Materials Details"><?=$row['module_name']?></a></td>
            <td><?=word_limiter(strip_tags($row['lecture_notes']),10)?></td>
            <td><a href='<?=base_url().'admin/uploads/materials/'.$row[lecture_file]?>' target='_blank'><?=$row['file_name']?></a></td>
            <td><?=$row['posted_date']?></td>
            <td><?=$row['valid_until']?></td>
            <td><?=$row['teacher_name']?></td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
    </table>
</div>